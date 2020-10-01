<?php 
namespace Home;

$title = "BRICX | Tableau de bord";

GROUPECOMMANDE::etat();
LIVRAISON::ResetProgramme();

$title = "BRIXS | Tableau de bord";

$tableau = [];
foreach (PRODUIT::getAll() as $key => $prod) {
	$data = new \stdclass();
	$data->name = $prod->name();
	$data->image = $prod->image;
	$data->livrable = $prod->livrable(PARAMS::DATE_DEFAULT, dateAjoute(1), $agence->id);
	$data->attente = $prod->attente($agence->id);
	$data->commande = $prod->commandee($agence->id);
	$tableau[] = $data;
}



$commandes = COMMANDE::findBy(["DATE(created) ="=>dateAjoute(), "etat_id !="=>ETAT::ANNULEE]);
$livraisons = LIVRAISON::programmee(dateAjoute());

?>