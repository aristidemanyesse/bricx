<?php 
namespace Home;

unset_session("ressources");

$title = "BRICX | Toutes les sorties de ressources";

$datas = $chantier->fourni("useressource", ["DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);


?>