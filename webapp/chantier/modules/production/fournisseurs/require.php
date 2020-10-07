<?php 
namespace Home;

$title = "GPV | Tous les fournisseurs";

$fournisseurs = FOURNISSEURCHANTIER::findBy(["chantier_id ="=>$chantier->id]);


?>