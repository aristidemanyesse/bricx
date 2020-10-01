<?php 
namespace Home;

if ($this->id != "") {
	$date = $this->id;
}else{
	$date = dateAjoute();
}

$commandes = $agence->fourni("commande", ["DATE(created) = " => $date, "etat_id !="=>ETAT::ANNULEE]);
$livraisons = $agence->fourni("livraison", ["DATE(created) = " => $date, "etat_id > "=>ETAT::ANNULEE, "etat_id !="=>ETAT::PARTIEL]);
$approvisionnements = $agence->fourni("approvisionnement", ["DATE(created) = " => $date, "etat_id !="=>ETAT::ANNULEE]);

$comptebanque = $agence->comptebanque;

$operations = $comptebanque->fourni("mouvement", ["DATE(created) = " => $date]);
$entrees = $depenses = [];
foreach ($operations as $key => $value) {
	$value->actualise();
	if ($value->typemouvement_id == TYPEMOUVEMENT::DEPOT) {
		$entrees[] = $value;
	}else{
		$depenses[] = $value;
	}
}


$production = new PRODUCTION;
$datas = PRODUCTION::findBy(["ladate = " => $date]);
if (count($datas) == 1) {
	$productionjour = $datas[0];
	$productionjour->actualise();
}


$employes = [];
$connexions = CONNEXION::listeConnecterDuJour($date);
foreach ($connexions as $key => $value) {
	$datas = EMPLOYE::findBy(["id ="=>$value->employe_id]);
	if (count($datas) == 1) {
		$employes[] = $datas[0];
	}
}



$title = "BRIXS | Rapport général de la journée ";
?>