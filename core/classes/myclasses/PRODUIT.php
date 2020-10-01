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

				foreach (ZONELIVRAISON::getAll() as $key => $zonelivraison) {
					$datas = PRIX_ZONELIVRAISON::findBy(["zonelivraison_id ="=>$zonelivraison->id, "produit_id ="=>$data->lastid]);
					if (count($datas) == 0) {
						$ligne = new PRIX_ZONELIVRAISON();
						$ligne->produit_id = $data->lastid;
						$ligne->zonelivraison_id = $zonelivraison->id;
						$ligne->price = 0;
						$ligne->enregistre();
					}
				}

				foreach (AGENCE::getAll() as $key => $exi) {
					$ligne = new INITIALPRODUITAGENCE();
					$ligne->agence_id = $exi->id;
					$ligne->produit_id = $this->id;
					$ligne->quantite = 0;
					$ligne->enregistre();
				}


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



	public static function totalProduit($date1, $date2, int $agence_id=null, int $produit_id=null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		if ($produit_id != null) {
			$paras.= "AND produit_id = $produit_id ";
		}
		$requette = "SELECT ligneproduction.* FROM ligneproduction, production WHERE ligneproduction.production_id = production.id AND production.ladate >= ? AND production.ladate <= ? $paras";
		$datas = LIGNEPRODUCTION::execute($requette, [$date1, $date2]);
		return comptage($datas, "quantite", "somme");
	}


	public static function totalVendu($date1, $date2, int $agence_id=null, int $produit_id=null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		if ($produit_id != null) {
			$paras.= "AND produit_id = $produit_id ";
		}
		$paras.= " AND livraison.created BETWEEN '$date1' AND '$date2'";
		$requette = "SELECT lignelivraison.* FROM lignelivraison, livraison, produit WHERE lignelivraison.livraison_id = livraison.id AND lignelivraison.produit_id = produit.id  $paras";
		$datas = LIGNELIVRAISON::execute($requette, []);
		return comptage($datas, "quantite", "somme");
	}



	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function stock(string $date1, string $date2, int $agence_id = null){
		$total = $this->livrable($date1, $date2, $agence_id) + $this->attente($agence_id);
		return $total;
	}



	public function production(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneproduction, production WHERE ligneproduction.produit_id = ?  AND ligneproduction.production_id = production.id AND production.etat_id != ?  AND production.ladate >= ? AND production.ladate <= ? $paras ";
		$item = LIGNEPRODUCTION::execute($requette, [$this->id, ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTION()]; }
		return $item[0]->quantite;
	}


	public function achat(string $date1 ="2020-05-01", string $date2, int $agence_id = null){
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneachatstock, achatstock WHERE ligneachatstock.produit_id = ? AND ligneachatstock.achatstock_id = achatstock.id AND achatstock.etat_id = ? AND DATE(achatstock.created) >= ? AND DATE(achatstock.created) <= ? ";
		$item = LIGNEACHATSTOCK::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEACHATSTOCK()]; }
		return $item[0]->quantite;
	}


	public function livraison(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM lignelivraison, livraison WHERE lignelivraison.produit_id = ?  AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id IN (?,?) AND DATE(livraison.created) >= ? AND DATE(livraison.created) <= ? $paras ";
		$item = LIGNELIVRAISON::execute($requette, [$this->id, ETAT::VALIDEE, ETAT::ENCOURS, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		return $item[0]->quantite;
	}


	public function surplus(int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(surplus) as surplus  FROM lignelivraison, livraison WHERE lignelivraison.produit_id = ?  AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id = ? $paras ";
		$item = LIGNELIVRAISON::execute($requette, [$this->id, ETAT::ENCOURS]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		return $item[0]->surplus;
	}


	public function perte(string $date1, string $date2, int $agence_id = null){
		return $this->perteLivraison($date1, $date2, $agence_id) + $this->perteRangement($date1, $date2, $agence_id) + $this->perteAutre($date1, $date2, $agence_id);
	}

	public function perteLivraison(string $date1, string $date2, int $agence_id = null){
		$total = 0;
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(perte - quantite + quantite_livree) as perte  FROM lignelivraison, livraison WHERE lignelivraison.produit_id = ?  AND lignelivraison.livraison_id = livraison.id AND livraison.etat_id = ?  AND DATE(livraison.created) >= ? AND DATE(livraison.created) <= ? $paras ";
		$item = LIGNELIVRAISON::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNELIVRAISON()]; }
		$total += $item[0]->perte;

		$requette = "SELECT SUM(quantite) as quantite  FROM perteproduit WHERE perteproduit.produit_id = ? AND perteproduit.etat_id = ? AND perteproduit.typeperte_id = ?  AND DATE(perteproduit.created) >= ? AND DATE(perteproduit.created) <= ? $paras ";
		$item = PERTEPRODUIT::execute($requette, [$this->id, ETAT::VALIDEE, TYPEPERTE::CHARGEMENT, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTEPRODUIT()]; }
		$total += $item[0]->quantite;
		return $total;
	}


	public function perteRangement(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(perte) as perte  FROM ligneproduction, production WHERE ligneproduction.produit_id = ?  AND ligneproduction.production_id = production.id AND production.etat_id = ?  AND production.ladate >= ? AND production.ladate <= ? $paras ";
		$item = LIGNEPRODUCTION::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTION()]; }
		return $item[0]->perte;
	}

	public function perteAutre(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM perteproduit WHERE perteproduit.produit_id = ? AND perteproduit.etat_id = ? AND perteproduit.typeperte_id != ?  AND DATE(perteproduit.created) >= ? AND DATE(perteproduit.created) <= ? $paras ";
		$item = PERTEPRODUIT::execute($requette, [$this->id, ETAT::VALIDEE, TYPEPERTE::CHARGEMENT, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTEPRODUIT()]; }
		return $item[0]->quantite;
	}



	public function attente(int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneproduction, production WHERE ligneproduction.produit_id = ? AND ligneproduction.production_id = production.id AND production.etat_id = ?  $paras ";
		$item = LIGNEPRODUCTION::execute($requette, [$this->id, ETAT::PARTIEL]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTION()]; }
		return $item[0]->quantite;
	}


	public function livrable(string $date1, string $date2, int $agence_id = null){
		if ($agence_id != null) {
			$item = $this->fourni("initialproduitagence", ["agence_id ="=>$agence_id])[0];
			$quantite = $item->quantite;
		}else{
			$item = $this->fourni("initialproduitagence");
			$quantite = comptage($item, "quantite", "somme");
		}
		$total = $this->production($date1, $date2, $agence_id) + $this->achat($date1, $date2, $agence_id) - $this->livraison($date1, $date2, $agence_id) - $this->perte($date1, $date2, $agence_id) + $quantite - $this->surplus($agence_id) - $this->attente($agence_id);
		return $total;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function enAgence(string $date1, string $date2, int $agence_id = null){
		return $this->livrable($date1, $date2, $agence_id) + $this->attente($agence_id);
	}




	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function commandee(int $agence_id = null){
		$total = 0;
		$datas = GROUPECOMMANDE::findBy(["etat_id ="=>ETAT::ENCOURS, "agence_id ="=> $agence_id]);
		foreach ($datas as $key => $comm) {
			$total += $comm->reste($this->id);
		}
		return $total;
	}



	public static function rupture(int $agence_id = null){
		$params = PARAMS::findLastId();
		$datas = static::isActives();
		foreach ($datas as $key => $item) {
			if ($item->enAgence(PARAMS::DATE_DEFAULT, dateAjoute(1), $agence_id) > $params->ruptureStock) {
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