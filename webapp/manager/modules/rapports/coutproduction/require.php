<?php 
namespace Home;
use Faker\Factory;
$faker = Factory::create();

$produits = PRODUIT::isActives();

$briques = $agences = [];

foreach (PRODUIT::isActives() as $key => $item) {
		$item->vendu = PRODUIT::totalProduit($date1, $date2, null, $item->id);
		$briques[] = $item;
}


foreach (AGENCE::getAll() as $key => $item) {
		$item->vendu = PRODUIT::totalProduit($date1, $date2, $item->id);
		$agences[] = $item;
}


$stats = PRODUCTION::stats($date1, $date2, null);

$title = "BRICX | Rapport de production ";

$lots = [];
?>