<?php 
namespace Home;

unset_session("produits");

$title = "BRIXS | Toutes les achats de stock";

$encours = $agence->fourni("achatstock", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$datas = $agence->fourni("achatstock", ["etat_id ="=>ETAT::VALIDEE, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>