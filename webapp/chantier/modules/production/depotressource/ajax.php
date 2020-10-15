<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




if ($action == "validerDepotProduit") {
	$id = getSession("depotproduit_id");
	$datas = DEPOTPRODUIT::findBy(["id ="=>$id, "etat_id = "=>ETAT::ENCOURS]);
	if (count($datas) > 0) {
		$depot = $datas[0];
		$depot->actualise();
		$depot->fourni("lignedepotproduit");

		$produits = explode(",", $tableau);
		foreach ($produits as $key => $value) {
			$lot = explode("-", $value);
			$array[$lot[0]] = end($lot);
		}

		if (count($produits) > 0) {
			$tests = $array;
			foreach ($tests as $key => $value) {
				foreach ($depot->lignedepotproduits as $cle => $lgn) {
					if (($lgn->id == $key) && ($lgn->quantite_depart >= $value)) {
						unset($tests[$key]);
					}
				}
			}
			if (count($tests) == 0) {
				foreach ($array as $key => $value) {
					foreach ($depot->lignedepotproduits as $cle => $lgn) {
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
				$data->message = "Veuillez à bien vérifier les quantités des différents produits, certaines sont incorrectes !";
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