<?php 
namespace Home;

$produits = PRODUIT::getAll();


$title = "BRIXS | Stock de briques en agence ";


$productionjour = PRODUCTION::today();
$productionjour->actualise();

?>