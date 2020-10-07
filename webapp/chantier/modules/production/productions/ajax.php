<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($action == "calcul") {
	$tab = [];
	$params = PARAMS::findLastId();
	if ($params->productionAuto == TABLE::OUI) {
		foreach (PRODUIT::isActives() as $key => $produit) {
			if (isset($_POST["prod-".$produit->id])) {
				foreach (RESSOURCE::isActives() as $key => $ressource) {
					if (isset($tab[$ressource->id])) {
						$tab[$ressource->id] += $produit->exigence($_POST["prod-".$produit->id], $ressource->id);
					}else{
						$tab[$ressource->id] = $produit->exigence($_POST["prod-".$produit->id], $ressource->id);					
					}
				}
			}
		}
		?>
		<div class="row justify-content-center">
			<?php foreach (RESSOURCE::isActives() as $key => $ressource) { ?>
				<div class="col-sm text-center border-right">
					<label>Quantité de <?= $ressource->name()  ?></label>
					<h4 class="mp0"><?= round($tab[$ressource->id], 2) ?> <?= $ressource->abbr  ?></h4>
				</div>	
			<?php } ?>
		</div><br>
	<?php }else{

		foreach (RESSOURCE::getAll() as $key => $ressource) {
			if (isset($_POST["conso-".$ressource->id])) {
				$tab[$ressource->id] = $_POST["conso-".$ressource->id];
			}
		}

	}
	session("tab", $tab);
}





if ($action === "productionjour") {

	if (getSession("tab") != null) {
		$production = PRODUCTIONCHANTIER::today();
		$tab = getSession("tab");

		$test = true;
		foreach (RESSOURCE::getAll() as $key => $ressource) {
			$datas = $production->fourni("ligneconsommationchantier", ["ressource_id ="=>$ressource->id]);
			if (count($datas) == 1) {
				$ligne = $datas[0];
				if ($tab[$ressource->id] > ($ressource->stockChantier(PARAMS::DATE_DEFAULT, dateAjoute(), getSession("chantier_connecte_id")) + $ligne->quantite) ) {
					$test = false;
					break;
				}
			}
		}


		if ($test) {
			$montant = 0;
			$production->fourni("ligneproductionchantier");
			foreach ($production->ligneproductionchantiers as $cle => $ligne) {
				$ligne->quantite = intval($_POST["prod-".$ligne->produit_id]);
				$ligne->save();
				$ligne->actualise();
				$montant += $ligne->produit->coutProduction("production", $_POST["prod-".$ligne->produit_id]);
			}


			$production->fourni("ligneconsommationchantier");
			foreach ($production->ligneconsommationchantiers as $cle => $ligne) {
				$ligne->quantite = $tab[$ligne->ressource_id];
				$ligne->save();
			}


			$production->hydrater($_POST);
			$production->etat_id = ETAT::PARTIEL;
			$production->montant_production = $montant;
			$production->employe_id = getSession("employe_connecte_id");
			$data = $production->save();

		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez pas consommé plus de quantité de <b>$ressource->name</b> que ce que vous n'en possédez !";
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'st produite lors de l'opération, veuillez recommencer !";
	}
	echo json_encode($data);
}






if ($action === "rangement") {
	$datas = PRODUCTIONCHANTIER::findBy(["id="=>$id]);
	if (count($datas) == 1) {
		$production = $datas[0];

		$test = true;
		$production->fourni("ligneproductionchantier");
		foreach ($production->ligneproductionchantiers as $cle => $ligne) {
			$range = intval($_POST["range-".$ligne->produit_id]);
			if (!($ligne->quantite >= $range)) {
				$test = false;
				break;
			}
		}

		if ($test) {
			$montant = 0;
			foreach ($production->ligneproductionchantiers as $cle => $ligne) {
				$range = intval($_POST["range-".$ligne->produit_id]);
				$ligne->perte = $ligne->quantite - $range;
				$ligne->save();

				$ligne->actualise();
				$montant += $ligne->produit->coutProduction("rangement", $range);
			}


			$production->hydrater($_POST);
			$production->dateRangement = dateAjoute();
			$production->employe_id_rangement = getSession("employe_connecte_id");
			$production->montant_rangement = $montant;
			$production->etat_id = ETAT::VALIDEE;
			$data = $production->save();

		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez pas rangé plus de quantité que ce que vous en avez produit !";
		}
	}else{
		$data->status = false;
		$data->message = "Erreur lors du processus de valisation, Veuillez recommencer !";
	}

	echo json_encode($data);
}

