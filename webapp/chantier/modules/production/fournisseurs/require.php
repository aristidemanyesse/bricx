<?php 
namespace Home;

$title = "BRICX | Tous les fournisseurs";

$fournisseurs = FOURNISSEURCHANTIER::findBy(["chantier_id ="=>$chantier->id]);


?>