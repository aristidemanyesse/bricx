<?php 
namespace Home;

unset_session("produits");

$title = "GPV | Mise en boutique de la production";

$encours = $chantier->fourni("depotproduit", [ "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);;

$datas = $chantier->fourni("depotproduit", [ "etat_id ="=>ETAT::VALIDEE, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>