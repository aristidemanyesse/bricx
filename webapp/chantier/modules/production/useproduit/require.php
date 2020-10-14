<?php 
namespace Home;

unset_session("produits");

$title = "BRICX | Toutes les sorties de produits";

$datas = $chantier->fourni("useproduit", ["DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>