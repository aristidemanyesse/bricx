<?php 
namespace Home;

unset_session("ressources");

$title = "BRICX | Envoi de ressources sur ce chantier";

$encours = $chantier->fourni("depotressource", [ "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);;

$datas = $chantier->fourni("depotressource", [ "etat_id ="=>ETAT::VALIDEE, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>