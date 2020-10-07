<?php 
namespace Home;

unset_session("produits");

$title = "GPV | Toutes les approvisionnements de produits";


$encours = $chantier->fourni("approchantierproduit", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$datas = $chantier->fourni("approchantierproduit", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>