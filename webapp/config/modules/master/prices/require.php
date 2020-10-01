<?php 
namespace Home;

$produits = PRODUIT::findBy(["isActive ="=>TABLE::OUI]);
$ressources = RESSOURCE::getAll([], [], ["name"=>"ASC"]);



$title = "BRICX | Configuration des barèmes de prix";



?>