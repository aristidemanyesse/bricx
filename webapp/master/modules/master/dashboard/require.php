<?php 
namespace Home;
unset_session("chantier_connecte_id");

GROUPECOMMANDE::etat();

$groupes__ = GROUPECOMMANDE::encours();
$prospections__ = LIVRAISON::findBy(["etat_id ="=>ETAT::ENCOURS]);
$approvisionnements__ = APPROVISIONNEMENT::encours();


$title = "BRICX | Tableau de bord";

?>