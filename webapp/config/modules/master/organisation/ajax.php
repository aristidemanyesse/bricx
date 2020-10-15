<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';
use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


if ($action == "autoriserAgence") {
	$datas = ACCES_CHANTIER::findBy(["employe_id ="=> $employe_id, "chantier_id ="=> $chantier_id]);
	if ($etat == "true") {
		if (count($datas) == 0) {
			$rem = new ACCES_CHANTIER();
			$rem->hydrater($_POST);
			$data = $rem->enregistre();
		}else{
			$data->status = false;
			$data->message = "L'employé à déjà accès à cette chantier !";
		}
	}else{
		if (count($datas) == 1) {
			$rem = $datas[0];
			if (!$rem->isProtected()) {
				$rem = $datas[0];
				$data = $rem->delete();
			}else{
				$data->status = false;
				$data->message = "Vous ne pouvez pas supprimer cet accès, il est protégé !";
			}
		}else{
			$data->status = false;
			$data->message = "L'accès est déjà refusé à cet employé !";
		}
	}
	echo json_encode($data);
}

