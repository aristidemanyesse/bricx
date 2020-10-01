<?php 
namespace Home;

$title = "BRICX | Tous les fournisseurs";

$fournisseurs = FOURNISSEUR::findBy(["agence_id ="=>$agence->id]);


?>