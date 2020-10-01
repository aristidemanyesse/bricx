<?php 
namespace Home;

$title = "BRICX | Toutes les livraisons";

$encours = $agence->fourni("livraison", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$livraisons = $agence->fourni("livraison", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);
?>