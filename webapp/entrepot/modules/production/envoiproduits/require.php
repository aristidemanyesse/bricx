<?php 
namespace Home;

unset_session("produits");

$title = "GPV | Envoi de briques sur chantier";

$encours = $agence->fourni("depotproduit", [ "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


$datas = $agence->fourni("depotproduit", [ "etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>