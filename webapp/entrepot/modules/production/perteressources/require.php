<?php 
namespace Home;

$title = "BRICX | Toutes les pertes entrepots";

unset_session("produits");

$datas = $agence->fourni("perteressource", ["DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>