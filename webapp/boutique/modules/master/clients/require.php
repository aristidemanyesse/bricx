<?php 
namespace Home;

$title = "BRICX | Tous les clients !";
$clients = CLIENT::findBy(["agence_id ="=>$agence->id],[],["name"=>"ASC"]);

?>