<?php 
namespace Home;

$title = "BRIXS | Productions & Rangements";

$encours = PRODUCTION::findBy(["etat_id ="=>ETAT::PARTIEL], [], ["ladate"=>"DESC"]);

$datas = PRODUCTION::findBy(["etat_id ="=>ETAT::VALIDEE, "DATE(ladate) >="=>$date1, "DATE(ladate) <="=>$date2], [], ["ladate"=>"DESC"]);

$production = PRODUCTION::today();
$production->actualise();

?>