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


if ($action == "newressource") {
	$ressources = [];
	if (getSession("ressources") != null) {
		$ressources = getSession("ressources"); 
	}
	if (!in_array($id, $ressources)) {
		$ressources[] = $id;
		$datas = RESSOURCE::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$ressource = $datas[0]; ?>
			<tr class="border-0 border-bottom " id="ligne<?= $id ?>" data-id="<?= $id ?>">
				<td><i class="fa fa-close text-red cursor" onclick="supprimeRessource(<?= $id ?>)" style="font-size: 18px;"></i></td>
				<td class="text-left">
					<h4 class="mp0 text-uppercase"><?= $ressource->name() ?></h4>
					<small><?= $ressource->unite ?></small>
				</td>
				<td width="140">
					<label>Quantité à utiliser</label>
					<input type="text" number name="quantite" class="form-control text-center gras" value="1" style="padding: 3px">
				</td>
			</tr>
			<?php
		}
	}
	session("ressources", $ressources);
}


if ($action == "supprimeRessource") {
	$ressources = [];
	if (getSession("ressources") != null) {
		$ressources = getSession("ressources"); 
		foreach ($ressources as $key => $value) {
			if ($value == $id) {
				unset($ressources[$key]);
			}
			session("ressources", $ressources);
		}
	}
}



if ($action == "validerUseRessource") {

	$ressources = explode(",", $tableau);
	if (count($ressources) > 0) {
		$tests = $ressources;
		foreach ($tests as $key => $value) {
			$lot = explode("-", $value);
			$id = $lot[0];
			$qte = end($lot);

			$datas = RESSOURCE::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$ressource = $datas[0];
				if ($qte <= $ressource->stockChantier(PARAMS::DATE_DEFAULT, dateAjoute(1), getSession("chantier_connecte_id")) ) {
					unset($tests[$key]);
				}
			}
		}
		if (count($tests) == 0) {
			$use = new USERESSOURCE();
			$use->hydrater($_POST);
			$data = $use->enregistre();

			if ($data->status) {
				foreach ($ressources as $key => $value) {
					$lot = explode("-", $value);
					$id = $lot[0];
					$qte = end($lot);
					$datas = RESSOURCE::findBy(["id ="=> $id]);
					if (count($datas) == 1) {
						$ressource = $datas[0];
						$lignecommande = new LIGNEUSERESSOURCE;
						$lignecommande->useressource_id = $use->id;
						$lignecommande->ressource_id = $id;
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
		$data->message = "Veuillez selectionner des ressources et leur quantité pour passer la commande !";
	}
	echo json_encode($data);
}
