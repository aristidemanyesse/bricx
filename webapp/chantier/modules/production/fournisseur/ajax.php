<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);



if ($action == "acompte") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = FOURNISSEUR::findBy(["id=" => $fournisseur_id]);
			if (count($datas) > 0) {
				$fournisseur = $datas[0];
				$data = $fournisseur->crediter(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
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



if ($action == "dette") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = FOURNISSEUR::findBy(["id=" => $fournisseur_id]);
			if (count($datas) > 0) {
				$fournisseur = $datas[0];
				$data = $fournisseur->reglerDette(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
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




if ($action == "reglerToutesDettes") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = FOURNISSEUR::findBy(["id=" => $id]);
			if (count($datas) > 0) {
				$fournisseur = $datas[0];
				$fournisseur->actualise();
				if ($fournisseur->entrepot->comptebanque->solde() > 0) {
					foreach ($fournisseur->fourni("approvisionnement", ["etat_id !="=>ETAT::ANNULEE]) as $key => $commande) {
						$data = $commande->reglement();
					}	
					foreach ($fournisseur->fourni("approetiquette", ["etat_id !="=>ETAT::ANNULEE]) as $key => $commande) {
						$data = $commande->reglement();
					}	
					foreach ($fournisseur->fourni("approemballage", ["etat_id !="=>ETAT::ANNULEE]) as $key => $commande) {
						$data = $commande->reglement();
					}		
				}else{
					$data->status = false;
					$data->message = "Le solde compte de caisse est de 0F. Veuillez le crediter pour effectuer cette opération !!";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
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



if ($action == "rembourser") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = FOURNISSEUR::findBy(["id=" => $fournisseur_id]);
			if (count($datas) > 0) {
				$fournisseur = $datas[0];
				$data = $fournisseur->rembourser(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
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


