<?php 
namespace Home;

$title = "BRICX | Tous les clients !";
$clients = CLIENT::findBy([],[],["name"=>"ASC"]);

?>