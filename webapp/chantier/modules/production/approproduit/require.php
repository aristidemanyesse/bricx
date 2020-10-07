<?php 
namespace Home;

unset_session("produits");

$title = "GPV | Toutes les approvisionnements de produits";


$encours = $entrepot->fourni("approproduit", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$datas = $entrepot->fourni("approproduit", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>