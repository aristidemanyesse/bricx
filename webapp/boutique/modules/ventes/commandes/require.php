<?php 
namespace Home;

$title = "BRICX | Toutes les commandes en cours";

GROUPECOMMANDE::etat();
$encours = GROUPECOMMANDE::encours();
$produits = PRODUIT::getAll();

?>