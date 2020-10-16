<?php 
namespace Home;

$title = "BRIXS | Productions & Rangements sur chantier";

$encours = $chantier->fourni("productionchantier", ["etat_id ="=>ETAT::PARTIEL], [], ["ladate"=>"DESC"]);

$datas = $chantier->fourni("productionchantier", ["etat_id ="=>ETAT::VALIDEE, "DATE(ladate) >="=>$date1, "DATE(ladate) <="=>$date2], [], ["ladate"=>"DESC"]);

$production = PRODUCTIONCHANTIER::today();
$production->actualise();

?>