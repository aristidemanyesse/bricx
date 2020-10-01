<?php 
namespace Home;

$title = "BRIXS | Toutes les livraisons par tricycle en cours";

$encours = $agence->fourni("tricycle", ["etat_id !="=>ETAT::VALIDEE], [], ["created"=>"DESC"]);

$datas = $agence->fourni("tricycle", ["etat_id ="=>ETAT::VALIDEE, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>