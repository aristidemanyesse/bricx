<?php 
namespace Home;

$title = "BRICX | Toutes les livraisons";

$encours = LIVRAISON::findBy(["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$livraisons = LIVRAISON::findBy(["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>