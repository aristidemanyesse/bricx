<?php 
namespace Home;

unset_session("materiels");

$title = "BRICX | Envoi de materiels sur ce chantier";

$encours = $chantier->fourni("depotmateriel", [ "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);;

$datas = $chantier->fourni("depotmateriel", [ "etat_id ="=>ETAT::VALIDEE, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>