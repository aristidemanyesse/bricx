<?php 
namespace Home;

$title = "BRICX | Espace de configuration des elements de production ";

$produits = PRODUIT::findBy(["isActive ="=>TABLE::OUI]);
$ressources = RESSOURCE::getAll([], [], ["name"=>"ASC"]);




?>