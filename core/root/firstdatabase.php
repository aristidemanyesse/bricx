<?php 
namespace Home;


$item = new AGENCE();
$item->name = "Agence principale";
$item->comptebanque_id = COMPTEBANQUE::COURANT;
$item->setProtected(1);
$item->enregistre();



$datas = ["Entrée de caisse", "Sortie de caisse"];
foreach ($datas as $key => $value) {
	$item = new TYPEOPERATIONCAISSE();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}


$datas = ["Dépôt", "Retrait"];
foreach ($datas as $key => $value) {
	$item = new TYPEMOUVEMENT();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}


$datas = ["Caisse courante"];
foreach ($datas as $key => $value) {
	$item = new COMPTEBANQUE();
	$item->name = $value;
	$item->etablissement = "Caisse principale";
	$item->setProtected(1);
	$item->save();
}



$datas = ["Sable", "Ciment", "Terre", "Gravier"];
foreach ($datas as $key => $value) {
	$item = new RESSOURCE();
	$item->unite = "kilos";
	$item->abbr = "kg";
	$item->name = $value;
	$item->setProtected(1);
	$item->enregistre();
}



$datas = ["BTC", "Hourdis", "AP 15", "AP 20", "HOURDIS FR"];
foreach ($datas as $key => $value) {
	$item = new PRODUIT();
	$item->name = $value;
	$item->setProtected(1);
	$item->enregistre();
}




$datas = ["Entreprise", "Particulier", "Personnel"];
foreach ($datas as $key => $value) {
	$item = new TYPECLIENT();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}

$item = new SEXE();
$item->name = "Homme";
$item->abreviation = "H";
$item->setProtected(1);
$item->save();

$item = new SEXE();
$item->name = "Femme";
$item->abreviation = "F";
$item->setProtected(1);
$item->save();


$datas = ["master", "manager", "boutique", "entrepot", "chantier", "config",
 "production", "ventes", "stock", "caisse", "rapports", "files", "Location",
  "modifier-supprimer", "roles", "mycompte"];
foreach ($datas as $key => $value) {
	$item = new ROLE();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}



$datas = ["Perte au chargement", "Surplus de la production", "Perte au déchargement", "Vol"];
foreach ($datas as $key => $value) {
	$item = new TYPEPERTE();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}


$item = new PARAMS();
$item->societe = "DEVARIS 21";
$item->email = "info@devaris21.pro";
$item->devise = "Fcfa";
$item->image = "logo.png";
$item->tva = 0;
$item->seuilCredit = 0;
$item->minImmobilisation = 350000;
$item->setProtected(1);
$item->enregistre();


$item = new MYCOMPTE();
$item->identifiant = strtoupper(substr(uniqid(), 5, 7));
$item->tentative = 0;
$item->expired = dateAjoute(30);
$item->setProtected(1);
$item->enregistre();



$item = new MODEPAYEMENT();
$item->name = "Espèces";
$item->initial = "ES";
$item->etat_id = ETAT::VALIDEE;
$item->setProtected(1);
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Prelevement sur acompte";
$item->initial = "PA";
$item->etat_id = ETAT::VALIDEE;
$item->setProtected(1);
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Chèque";
$item->initial = "CH";
$item->etat_id = ETAT::ENCOURS;
$item->setProtected(1);
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Virement banquaire";
$item->initial = "VB";
$item->etat_id = ETAT::ENCOURS;
$item->setProtected(1);
$item->save();

$item = new MODEPAYEMENT();
$item->name = "Mobile money";
$item->initial = "MM";
$item->etat_id = ETAT::ENCOURS;
$item->setProtected(1);
$item->save();



$item = new ETAT();
$item->name = "Annulé";
$item->class = "danger";
$item->setProtected(1);
$item->save();

$item = new ETAT();
$item->name = "En cours";
$item->class = "warning";
$item->setProtected(1);
$item->save();

$item = new ETAT();
$item->name = "StandBy";
$item->class = "info";
$item->setProtected(1);
$item->save();

$item = new ETAT();
$item->name = "Validé";
$item->class = "success";
$item->setProtected(1);
$item->save();



$item = new ETATCHANTIER();
$item->name = "Annulé";
$item->class = "danger";
$item->setProtected(1);
$item->save();

$item = new ETATCHANTIER();
$item->name = "Pas encore entamé";
$item->class = "default";
$item->setProtected(1);
$item->save();

$item = new ETATCHANTIER();
$item->name = "En cours";
$item->class = "info";
$item->setProtected(1);
$item->save();

$item = new ETATCHANTIER();
$item->name = "stoppé";
$item->class = "warning";
$item->setProtected(1);
$item->save();

$item = new ETATCHANTIER();
$item->name = "terminé";
$item->class = "success";
$item->setProtected(1);
$item->save();



$item = new DISPONIBILITE();
$item->name = "Indisponible";
$item->class = "danger";
$item->setProtected(1);
$item->save();

$item = new DISPONIBILITE();
$item->name = "Libre";
$item->class = "warning";
$item->setProtected(1);
$item->save();

$item = new DISPONIBILITE();
$item->name = "En mission";
$item->class = "info";
$item->setProtected(1);
$item->save();




$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::ENTREE;
$item->name = "Retour de fonds par le fournisseur";
$item->setProtected(1);
$item->save();


$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::ENTREE;
$item->name = "Autre entrée en caisse";
$item->setProtected(1);
$item->save();



$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Frais de Transport";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Main d'oeuvre de production";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Paye du loyer des locaux";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Réglement de facture CIE / SODECI";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Retour de fonds au client";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Réglement d'autres factures";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Autre dépense";
$item->setProtected(1);
$item->save();






$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::ENTREE;
$item->name = "Retour de fonds par le fournisseur";
$item->setProtected(1);
$item->save();


$item = new CATEGORIEOPERATION();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::ENTREE;
$item->name = "Autre entrée en caisse";
$item->setProtected(1);
$item->save();



$item = new CATEGORIEOPERATIONCHANTIER();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Location d'engins pour le chantier";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATIONCHANTIER();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Paye des manoeuvres";
$item->setProtected(1);
$item->save();

$item = new CATEGORIEOPERATIONCHANTIER();
$item->typeoperationcaisse_id = TYPEOPERATIONCAISSE::SORTIE;
$item->name = "Autre dépense sur chantier";
$item->setProtected(1);
$item->save();




$item = new VEHICULE();
$item->immatriculation = "LE ";
$item->modele = "VEHICULE DU CLIENT";
$item->setProtected(1);
$item->save();

$item = new VEHICULE();
$item->immatriculation = "UN";
$item->modele = "TRICYCLE";
$item->setProtected(1);
$item->save();




$item = new EMPLOYE();
$item->name = "Super Administrateur";
$item->email = "info@devaris21.pro";
$item->adresse = "Grand Bassam, Rue congo";
$item->contact = "+225 59573307";
$item->login = "root";
$item->password = "5e9795e3f3ab55e7790a6283507c085db0d764fc";
$item->setProtected(1);
$data = $item->save();
foreach (ROLE::getAll() as $key => $value) {
	$tr = new ROLE_EMPLOYE();
	$tr->employe_id = $data->lastid;
	$tr->role_id = $value->id;
	$tr->setProtected(1);
	$tr->enregistre();
}

?>