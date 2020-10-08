<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if ($action == "depotressource") {
	$tests = $listeressources = explode(",", $listeressources);
	foreach ($tests as $key => $value) {
		$lot = explode("-", $value);
		$id = $lot[0];
		$qte = end($lot);
		$datas = RESSOURCE::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$ressource = $datas[0];
			if ($ressource->stock(PARAMS::DATE_DEFAULT, dateAjoute(1), getSession("agence_connecte_id")) >= $qte) {
				unset($tests[$key]);
			}	
		}
	}
	if (count($tests) == 0) {
		$depot = new DEPOTRESSOURCE();
		$depot->hydrater($_POST);
		$depot->etat_id = ETAT::ENCOURS;
		$data = $depot->enregistre();
		if ($data->status) {
			foreach ($listeressources as $key => $value) {
				$lot = explode("-", $value);
				$id = $lot[0];
				$qte = end($lot);
				$datas = RESSOURCE::findBy(["id ="=> $id]);
				if (count($datas) == 1) {
					$ressource = $datas[0];
					if ($qte > 0) {
						$ligne = new LIGNEDEPOTRESSOURCE();
						$ligne->depotressource_id = $depot->id;
						$ligne->ressource_id = $ressource->id;
						$ligne->quantite_depart = intval($qte);
						$data = $ligne->enregistre();
					}

				}
			}
		}
	}else{
		$data->status = false;
		$data->message = "Certains des ressources sont en quantité insuffisantes pour faire cet envoi !";
	}
	echo json_encode($data);
}




if ($action == "annulerDepotProduit") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = DEPOTRESSOURCE::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$prospection = $datas[0];
				$data = $prospection->annuler();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est ressourcee lors de l'opération! Veuillez recommencer";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}

