<?php 
namespace Home;

$title = "BRICX | Toutes les pertes de ressources sur ce chantier";

unset_session("ressources");


$encours = $chantier->fourni("pertechantierressource", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


$datas = $chantier->fourni("pertechantierressource", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>