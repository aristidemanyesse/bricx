<?php 
namespace Home;

unset_session("produits");

$title = "GPV | Toutes les approvisionnements de produits";

$datas = $chantier->fourni("useproduit", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>