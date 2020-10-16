<?php 
namespace Home;

$title = "BRICX | Toutes les locations d'engins pour ce chantier";

unset_session("produits");


$encours = $chantier->fourni("location", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


$datas = $chantier->fourni("location", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>