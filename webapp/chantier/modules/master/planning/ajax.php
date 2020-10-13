<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function maj(array $tableau, $parent){
	$lot = TACHE::findBy(["id ="=>$tableau["id"]]);
	if (count($lot) == 1) {
		$tache = $lot[0];
		$tache->tache_id_parent = $parent;
		$tache->rang = TACHE::getRang($parent);
		$data = $tache->save();
		$tableau["name"] = $tache->name();
		if ($data->status && array_key_exists("children", $tableau)) {
			foreach ($tableau["children"] as $key => $item) {
				return maj($item, $tableau["id"]);
			}
		}
	}
}


if ($action === "miseajour") {
	TACHE::query("UPDATE tache SET rang = 0 WHERE id = ?", [getSession("chantier_connecte_id")]);
	maj($datas[0], null);
	$data->status = true;
	$data->message = "Mise à jour des tâches enregistrées avec succes !";

	$datas = CHANTIER::findBy(["id = "=> getSession("chantier_connecte_id")]);
	if (count($datas)) {
		$chantier = $datas[0];
		$data->data = $chantier->retourJsons();
	}
	echo json_encode($data);
}
