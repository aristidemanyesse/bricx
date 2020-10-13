<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;
use Native\ROOTER;

$data = new RESPONSE;
extract($_POST);
$params = PARAMS::findLastId();
$rooter = new ROOTER;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($action == "newproduit") {
	$produits = [];
	if (getSession("produits") != null) {
		$produits = getSession("produits"); 
	}
	if (!in_array($id, $produits)) {
		$produits[] = $id;
		$datas = PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$produit = $datas[0]; ?>
			<tr class="border-0 border-bottom " id="ligne<?= $id ?>" data-id="<?= $id ?>">
				<td><i class="fa fa-close text-red cursor" onclick="supprimeRessource(<?= $id ?>)" style="font-size: 18px;"></i></td>
				<td class="text-left">
					<h4 class="mp0 text-uppercase"><?= $produit->name() ?></h4>
					<small><?= $produit->comment ?></small>
				</td>
				<td width="140">
					<label>Quantité à utiliser</label>
					<input type="text" number name="quantite" class="form-control text-center gras" value="1" style="padding: 3px">
				</td>
			</tr>
			<?php
		}
	}
	session("produits", $produits);
}


if ($action == "supprimeRessource") {
	$produits = [];
	if (getSession("produits") != null) {
		$produits = getSession("produits"); 
		foreach ($produits as $key => $value) {
			if ($value == $id) {
				unset($produits[$key]);
			}
			session("produits", $produits);
		}
	}
}



if ($action == "validerUseProduit") {

	$produits = explode(",", $tableau);
	if (count($produits) > 0) {
		$tests = $produits;
		foreach ($tests as $key => $value) {
			$lot = explode("-", $value);
			$id = $lot[0];
			$qte = end($lot);

			$datas = PRODUIT::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$produit = $datas[0];
				if ($qte <= $produit->stock(PARAMS::DATE_DEFAULT, dateAjoute(1), getSession("chantier_connecte_id")) ) {
					unset($tests[$key]);
				}
			}
		}
		if (count($tests) == 0) {
			$use = new USEPRODUIT();
			$use->hydrater($_POST);
			$data = $use->enregistre();

			if ($data->status) {
				foreach ($produits as $key => $value) {
					$lot = explode("-", $value);
					$id = $lot[0];
					$qte = end($lot);
					$datas = PRODUIT::findBy(["id ="=> $id]);
					if (count($datas) == 1) {
						$produit = $datas[0];
						$lignecommande = new LIGNEUSEPRODUIT;
						$lignecommande->useproduit_id = $use->id;
						$lignecommande->produit_id = $id;
						$lignecommande->quantite = $qte;
						$lignecommande->enregistre();	
					}
				}
			}

		}else{
			$data->status = false;
			$data->message = "Vous ne disposez pas de certaines ressources en quantite suffisante !";
		}
	}else{
		$data->status = false;
		$data->message = "Veuillez selectionner des produits et leur quantité pour passer la commande !";
	}
	echo json_encode($data);
}
