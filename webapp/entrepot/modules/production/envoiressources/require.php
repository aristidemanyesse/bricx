<?php 
namespace Home;

unset_session("ressources");

$title = "GPV | Envoi de ressources sur chantier";

$encours = $agence->fourni("depotressource", [ "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


$datas = $agence->fourni("depotressource", [ "etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>