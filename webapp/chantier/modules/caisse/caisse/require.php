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


	$stats = $budgetchantier->stats($date1, $date2);

	$title = "BRIXS | Gestion du budget du chantier";
}else{
	header("Location: ../master/dashboard");
}




?>