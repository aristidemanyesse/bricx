<?php 
namespace Home;

$title = "GPV | Toutes les pertes entrepots";

unset_session("produits");


$encours = $chantier->fourni("pertechantierproduit", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


$datas = $chantier->fourni("pertechantierproduit", ["etat_id !="=>ETAT::ENCOURS, "DATE(created) >="=>$date1, "DATE(created) <="=>$date2], [], ["created"=>"DESC"]);

?>