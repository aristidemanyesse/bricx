<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';
use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);


if ($action == "prix") {
	$items = explode(",", $tableau);
	foreach ($items as $key => $value) {
		$lot = explode("-", $value);
		$id = $lot[0];
		$val = end($lot);
		$datas = PRIX_ZONELIVRAISON::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price = intval($val);
			$data = $pz->save();
		}
	}
	echo json_encode($data);
}




if ($action == "formPayeProduit") {
	$items = explode(",", $tableau);
	foreach ($items as $key => $value) {
		$lot = explode("-", $value);
		$id = $lot[0]; $val = end($lot);

		$datas = PAYE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price = intval($val);
			$data = $pz->save();
		}
	}	

	$items = explode(",", $tableau1);
	foreach ($items as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0]; $val = end($data);

		$datas = PAYE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price_rangement = intval($val);
			$data = $pz->save();
		}
	}

	$items = explode(",", $tableau2);
	foreach ($items as $key => $value) {
		$data = explode("-", $value);
		$id = $data[0]; $val = end($data);

		$datas = PAYE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price_livraison = intval($val);
			$data = $pz->save();
		}
	}
	echo json_encode($data);
}



if ($action == "formPayeProduitFerie") {
	$items = explode(",", $tableau);
	foreach ($items as $key => $value) {
		$lot = explode("-", $value);
		$id = $lot[0]; $val = end($lot);

		$datas = PAYEFERIE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price = intval($val);
			$data = $pz->save();
		}
	}	

	$items = explode(",", $tableau1);
	foreach ($items as $key => $value) {
		$lot = explode("-", $value);
		$id = $lot[0]; $val = end($lot);

		$datas = PAYEFERIE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price_rangement = intval($val);
			$data = $pz->save();
		}
	}

	$items = explode(",", $tableau2);
	foreach ($items as $key => $value) {
		$lot = explode("-", $value);
		$id = $lot[0]; $val = end($lot);

		$datas = PAYEFERIE_PRODUIT::findBy(["id ="=> $id]);
		if (count($datas) == 1) {
			$pz = $datas[0];
			$pz->price_livraison = intval($val);
			$data = $pz->save();
		}
	}
	echo json_encode($data);
}

