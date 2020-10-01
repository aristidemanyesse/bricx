<?php 
namespace Home;

GROUPECOMMANDE::etat();

$groupes__ = GROUPECOMMANDE::encours();
$prospections__ = LIVRAISON::findBy(["etat_id ="=>ETAT::ENCOURS]);
$approvisionnements__ = APPROVISIONNEMENT::encours();

$title = "BRICX | Tableau de bord";

?>