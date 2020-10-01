<?php 
namespace Home;
use Faker\Factory;
unset_session("produits");
unset_session("commande-encours");
$faker = Factory::create();

if ($this->id != null) {
	$datas = AGENCE::findBy(["id ="=>$this->id]);
	if (count($datas) > 0) {
		$agence = $datas[0];
		$agence->actualise();

		$comptebanque = $agence->comptebanque;

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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$produits = PRODUIT::isActives();
foreach ($produits as $key => $produit) {
	$produit->actualise();
	$produit->veille = $produit->stock(PARAMS::DATE_DEFAULT, dateAjoute1($date1, -1), $agence->id);
	$produit->production = $produit->production($date1, $date2, $agence->id);
	$produit->livraison = $produit->livraison($date1, $date2, $agence->id);
	$produit->achat = $produit->achat($date1, $date2, $agence->id);
	$produit->stock = $produit->stock(PARAMS::DATE_DEFAULT, $date2, $agence->id);
	$produit->perteLivraison = $produit->perteLivraison($date1, $date2, $agence->id);
	$produit->perteRangement = $produit->perteRangement($date1, $date2, $agence->id);
	$produit->perteAutre = $produit->perteAutre($date1, $date2, $agence->id);
	$produit->perte = $produit->perteLivraison + $produit->perteRangement + $produit->perteAutre;

	foreach (RESSOURCE::getAll() as $key => $ressource) {
		$name = trim($ressource->name());
		$produit->$name = $produit->exigence(($produit->production), $ressource->getId());
		$a = "perte-$name";
		$produit->$a = $produit->exigence(intval($produit->perte), $ressource->getId());
	}
}

$perte = comptage($produits, "perte", "somme");
if ($perte > 0) {
	$pertelivraison = round(((LIVRAISON::perte($date1, $date2) / $perte) * 100),2);
}else{
	$pertelivraison = 0;
}

$productions = PRODUCTION::findBy(["ladate >="=>$date1, "ladate <= "=>$date2]);

$tricycles = LIVRAISON::findBy(["DATE(datelivraison) >="=>$date1, "DATE(datelivraison) <= "=>$date2, "etat_id ="=>ETAT::VALIDEE, "vehicule_id ="=>VEHICULE::TRICYCLE]);


$ressources = RESSOURCE::getAll();
usort($produits, "comparerPerte");


$stats = PRODUCTION::stats($date1, $date2, $agence->id);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		$mouvements = $comptebanque->fourni("mouvement", ["DATE(created) >= "=> $date1, "DATE(created) <= "=> $date2]);

		$transferts = TRANSFERTFOND::findBy(["comptebanque_id_source="=>$comptebanque->id, "DATE(created) >= "=> $date1, "DATE(created) <= "=> $date2]);

		$operations = OPERATION::findBy(["DATE(created) >= "=> dateAjoute(-7)]);
		$entrees = $depenses = [];
		foreach ($operations as $key => $value) {
			$value->actualise();
			if ($value->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE) {
				$entrees[] = $value;
			}else{
				$depenses[] = $value;
			}
		}
		$stats3 = $comptebanque->stats($date1, $date2);

		$title = "BRICX | Vue générale sur ".$agence->name();
	}else{
		header("Location: ../master/dashboard");
	}
}else{
	header("Location: ../master/dashboard");
}
?>