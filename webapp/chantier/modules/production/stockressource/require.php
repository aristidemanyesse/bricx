<?php 
namespace Home;

$ressources = RESSOURCE::getAll();


$title = "BRIXS | Stock de briques en agence ";


$productionjour = PRODUCTIONCHANTIER::today();
$productionjour->actualise();

?>