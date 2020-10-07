<?php 
namespace Home;

$title = "BRIXS | Productions & Rangements sur chantier";

$encours = PRODUCTIONCHANTIER::findBy(["etat_id ="=>ETAT::PARTIEL], [], ["ladate"=>"DESC"]);

$datas = PRODUCTIONCHANTIER::findBy(["etat_id ="=>ETAT::VALIDEE, "DATE(ladate) >="=>$date1, "DATE(ladate) <="=>$date2], [], ["ladate"=>"DESC"]);

$production = PRODUCTIONCHANTIER::today();
$production->actualise();

?>