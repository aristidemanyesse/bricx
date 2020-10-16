<?php 
namespace Home;

$datas = CHANTIER::findBy(["id ="=>getSession("chantier_connecte_id")]);
if (count($datas) == 1) {
	$chantier = $datas[0];
	$chantier->actualise();
	$budgetchantier = $chantier->budgetchantier;

	$mouvements = $budgetchantier->fourni("mouvement", ["DATE(created) >= "=> $date1, "DATE(created) <= "=> $date2, "etat_id !="=>ETAT::ANNULEE]);
	$total = VERSEMENTCHANTIER::total($date1, $date2, $chantier->id);


	$entrees = $depenses = [];
	foreach ($mouvements as $key => $value) {
		$value->actualise();
		if ($value->typemouvement_id == TYPEMOUVEMENT::DEPOT) {
			$entrees[] = $value;
		}else{
			$depenses[] = $value;
		}
	}


	$datas = $chantier->fourni("approchantierressource", ["DATE(created) >=" => $date1 , "DATE(created) <=" => $date2, "etat_id !="=>ETAT::ANNULEE]);
	$ressources = comptage($datas, "montant", "somme");

	$datas = $chantier->fourni("approchantierproduit", ["DATE(created) >=" => $date1 , "DATE(created) <=" => $date2, "etat_id !="=>ETAT::ANNULEE]);
	$produits = comptage($datas, "montant", "somme");

	$materiels = 0;
	$datas = $chantier->fourni("approchantiermateriel", ["DATE(created) >=" => $date1 , "DATE(created) <=" => $date2, "etat_id !="=>ETAT::ANNULEE]);
	$materiels += comptage($datas, "montant", "somme");
	$datas = $chantier->fourni("location", ["DATE(created) >=" => $date1 , "DATE(created) <=" => $date2, "etat_id !="=>ETAT::ANNULEE]);
	$materiels += comptage($datas, "montant", "somme");

	$stats = $budgetchantier->stats($date1, $date2);

	$title = "BRIXS | Gestion du budget du chantier";
}else{
	header("Location: ../master/dashboard");
}




?>