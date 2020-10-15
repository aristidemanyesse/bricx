<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class PRODUIT extends TABLE
{
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $name;
	public $comment;
	public $image;
	public $isActive = TABLE::OUI;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {

				$ligne = new EXIGENCEPRODUCTION();
				$ligne->produit_id = $this->id;
				$ligne->quantite = 0;
				$ligne->enregistre();


				$ligne = new PAYE_PRODUIT();
				$ligne->produit_id = $data->lastid;
				$ligne->price = 0;
				$ligne->enregistre();

				$ligne = new PAYEFERIE_PRODUIT();
				$ligne->produit_id = $data->lastid;
				$ligne->price = 0;
				$ligne->enregistre();



			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du produit !";
		}
		return $data;
	}




	///////////////////////////////////////////////////////////////////////////////////////////



	public static function totalProduit($date1, $date2, int $chantier_id=null, int $produit_id=null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		if ($produit_id != null) {
			$paras.= "AND produit_id = $produit_id ";
		}
		$requette = "SELECT ligneproduction.* FROM ligneproduction, production WHERE ligneproduction.production_id = production.id AND production.ladate >= ? AND production.ladate <= ? $paras";
		$datas = LIGNEPRODUCTION::execute($requette, [$date1, $date2]);
		return comptage($datas, "quantite", "somme");
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function stock(string $date1, string $date2, int $chantier_id = null){
		$total = $this->livrable($date1, $date2, $chantier_id) + $this->attente($chantier_id);
		return $total;
	}



	public function production(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneproductionchantier, productionchantier WHERE ligneproductionchantier.produit_id = ?  AND ligneproductionchantier.productionchantier_id = productionchantier.id AND productionchantier.etat_id != ?  AND productionchantier.ladate >= ? AND productionchantier.ladate <= ? $paras ";
		$item = LIGNEPRODUCTIONCHANTIER::execute($requette, [$this->id, ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONCHANTIER()]; }
		return $item[0]->quantite;
	}


	public function depot(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM lignedepotproduit, depotproduit WHERE lignedepotproduit.produit_id = ?  AND lignedepotproduit.depotproduit_id = depotproduit.id AND depotproduit.etat_id = ? AND DATE(depotproduit.created) >= ? AND DATE(depotproduit.created) <= ? $paras ";
		$item = LIGNEDEPOTPRODUIT::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEDEPOTPRODUIT()]; }
		return $item[0]->quantite;
	}


	public function achat(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneapprochantierproduit, approchantierproduit WHERE ligneapprochantierproduit.produit_id = ? AND ligneapprochantierproduit.approchantierproduit_id = approchantierproduit.id AND approchantierproduit.etat_id = ? AND DATE(approchantierproduit.created) >= ? AND DATE(approchantierproduit.created) <= ? $paras ";
		$item = LIGNEAPPROCHANTIERPRODUIT::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEAPPROCHANTIERPRODUIT()]; }
		return $item[0]->quantite;
	}


	public function perte(string $date1, string $date2, int $chantier_id = null){
		return $this->perteRangement($date1, $date2, $chantier_id) + $this->perteAutre($date1, $date2, $chantier_id);
	}


	public function perteRangement(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(perte) as perte  FROM ligneproductionchantier, productionchantier WHERE ligneproductionchantier.produit_id = ?  AND ligneproductionchantier.productionchantier_id = productionchantier.id AND productionchantier.etat_id = ?  AND productionchantier.ladate >= ? AND productionchantier.ladate <= ? $paras ";
		$item = LIGNEPRODUCTIONCHANTIER::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONCHANTIER()]; }
		return $item[0]->perte;
	}


	public function perteAutre(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM pertechantierproduit WHERE pertechantierproduit.produit_id = ? AND pertechantierproduit.etat_id = ? AND pertechantierproduit.typeperte_id != ?  AND DATE(pertechantierproduit.created) >= ? AND DATE(pertechantierproduit.created) <= ? $paras ";
		$item = PERTECHANTIERPRODUIT::execute($requette, [$this->id, ETAT::VALIDEE, TYPEPERTE::CHARGEMENT, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTECHANTIERPRODUIT()]; }
		return $item[0]->quantite;
	}



	public function attente(int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneproductionchantier, productionchantier WHERE ligneproductionchantier.produit_id = ? AND ligneproductionchantier.productionchantier_id = productionchantier.id AND productionchantier.etat_id = ?  $paras ";
		$item = LIGNEPRODUCTIONCHANTIER::execute($requette, [$this->id, ETAT::PARTIEL]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONCHANTIER()]; }
		return $item[0]->quantite;
	}


	public function livrable(string $date1, string $date2, int $chantier_id = null){
		if ($chantier_id != null) {
			$item = $this->fourni("initialproduitchantier", ["chantier_id ="=>$chantier_id])[0];
			$quantite = $item->quantite;
		}else{
			$item = $this->fourni("initialproduitchantier");
			$quantite = comptage($item, "quantite", "somme");
		}
		$total = $this->production($date1, $date2, $chantier_id) + $this->achat($date1, $date2, $chantier_id) + $this->depot($date1, $date2, $chantier_id) - $this->perte($date1, $date2, $chantier_id) + $quantite - $this->attente($chantier_id);
		return $total;
	}



	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public static function rupture(int $chantier_id = null){
		$params = PARAMS::findLastId();
		$datas = static::isActives();
		foreach ($datas as $key => $item) {
			if ($item->enAgence(PARAMS::DATE_DEFAULT, dateAjoute(1), $chantier_id) > $params->ruptureStock) {
				unset($datas[$key]);
			}
		}
		return $datas;
		
	}



	public function exigence(int $quantite, int $ressource_id){
		$datas = EXIGENCEPRODUCTION::findBy(["produit_id ="=>$this->id]);
		if (count($datas) == 1) {
			$item = $datas[0];
			$element = $item->fourni("ligneexigenceproduction", ["ressource_id ="=>$ressource_id])[0];
			if ($item->quantite > 0) {
				return ($quantite * $element->quantite) / $item->quantite;
			}
			return 0;
		}
		return 0;
	}



	public function coutProduction(String $type, int $quantite){
		if(isJourFerie(dateAjoute())){
			$datas = $this->fourni("payeferie_produit");
		}else{
			$datas = $this->fourni("paye_produit");
		}
		if (count($datas) > 0) {
			$paye = $datas[0];
			switch ($type) {
				case 'production':
				$prix = $paye->price;
				break;

				case 'rangement':
				$prix = $paye->price_rangement;
				break;

				case 'livraison':
				$prix = $paye->price_livraison;
				break;
			}
			return $quantite * $prix;
		}
		return 0;
	}



	public function coutProductionFerie(String $type, int $quantite){
		$datas = $this->fourni("payeferie_produit");
		if (count($datas) > 0) {
			$paye = $datas[0];
			switch ($type) {
				case 'production':
				$prix = $paye->price;
				break;

				case 'rangement':
				$prix = $paye->price_rangement;
				break;

				case 'livraison':
				$prix = $paye->price_livraison;
				break;
			}
			return $quantite * $prix;
		}
		return 0;
	}



	public function changerMode(){
		if ($this->isActive == TABLE::OUI) {
			$this->isActive = TABLE::NON;
		}else{
			$this->isActive = TABLE::OUI;
			$pro = PRODUCTION::today();
			$datas = LIGNEPRODUCTION::findBy(["production_id ="=>$pro->id, "produit_id ="=>$pdv->id]);
			if (count($datas) == 0) {
				$ligne = new LIGNEPRODUCTION();
				$ligne->production_id = $pro->id;
				$ligne->produit_id = $pdv->id;
				$ligne->enregistre();
			}			
		}
		return $this->save();
	}



	public function sentenseCreate(){
		$this->sentense = "enregistrement d'un nouveau produit ".$this->name();
	}
	public function sentenseUpdate(){
		$this->sentense = "Modification des informations du produit ".$this->name();
	}
	public function sentenseDelete(){
		$this->sentense = "Suppression du produit ".$this->name();
	}

}

?>