<?php 
namespace Home;

unset_session("ressources");

$title = "GPV | Toutes les approvisionnements de ressources";


$encours = $chantier->fourni("approchantierressource", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

$datas = $chantier->fourni("approchantierressource", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>