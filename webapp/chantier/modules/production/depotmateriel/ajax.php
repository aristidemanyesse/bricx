<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




if ($action == "validerDepotMateriel") {
	$id = getSession("depotmateriel_id");
	$datas = DEPOTPRODUIT::findBy(["id ="=>$id, "etat_id = "=>ETAT::ENCOURS]);
	if (count($datas) > 0) {
		$depot = $datas[0];
		$depot->actualise();
		$depot->fourni("lignedepotmateriel");

		$materiels = explode(",", $tableau);
		foreach ($materiels as $key => $value) {
			$lot = explode("-", $value);
			$array[$lot[0]] = end($lot);
		}

		if (count($materiels) > 0) {
			$tests = $array;
			foreach ($tests as $key => $value) {
				foreach ($depot->lignedepotmateriels as $cle => $lgn) {
					if (($lgn->id == $key) && ($lgn->quantite_depart >= $value)) {
						unset($tests[$key]);
					}
				}
			}
			if (count($tests) == 0) {
				foreach ($array as $key => $value) {
					foreach ($depot->lignedepotmateriels as $cle => $lgn) {
						if ($lgn->id == $key) {
							$lgn->quantite = $value;
							$lgn->perte = $lgn->quantite_depart - $value;
							$lgn->save();
							break;
						}
					}					
				}
				$depot->hydrater($_POST);
				$data = $depot->valider();
			}else{
				$data->status = false;
				$data->message = "Veuillez à bien vérifier les quantités des différents materiels, certaines sont incorrectes !";
			}			
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer 0";
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer 1";
	}
	echo json_encode($data);
}