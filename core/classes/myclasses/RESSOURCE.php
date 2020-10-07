<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
/**
 * 
 */
class RESSOURCE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $unite;
	public $abbr;
	public $price = 0;
	public $isActive = TABLE::OUI;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				foreach (EXIGENCEPRODUCTION::getAll() as $key => $exi) {
					$ligne = new LIGNEEXIGENCEPRODUCTION();
					$ligne->exigenceproduction_id = $exi->id;
					$ligne->ressource_id = $this->id;
					$ligne->quantite = 0;
					$ligne->enregistre();
				}

				foreach (AGENCE::getAll() as $key => $exi) {
					$ligne = new INITIALRESSOURCEAGENCE();
					$ligne->agence_id = $exi->id;
					$ligne->ressource_id = $this->id;
					$ligne->quantite = 0;
					$ligne->enregistre();
				}

				foreach (CHANTIER::getAll() as $key => $exi) {
					$ligne = new INITIALRESSOURCECHANTIER();
					$ligne->chantier_id = $exi->id;
					$ligne->ressource_id = $this->id;
					$ligne->quantite = 0;
					$ligne->enregistre();
				}
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du produit !";
		}
		return $data;
	}



	public function stock(String $date1, String $date2, int $agence_id){
		$item = $this->fourni("initialressourceagence", ["agence_id ="=>$agence_id])[0];
		return $this->achat($date1, $date2, $agence_id) - $this->consommee($date1, $date2, $agence_id) - $this->perte($date1, $date2, $agence_id) + $item->quantite;
	}




	public function achat(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneapprovisionnement, approvisionnement WHERE ligneapprovisionnement.ressource_id = ? AND ligneapprovisionnement.approvisionnement_id = approvisionnement.id AND approvisionnement.etat_id = ? AND DATE(approvisionnement.created) >= ? AND DATE(approvisionnement.created) <= ? $paras ";
		$item = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEAPPROVISIONNEMENT()]; }
		return $item[0]->quantite;
	}



	public function consommee(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneconsommation, production WHERE ligneconsommation.ressource_id =  ? AND ligneconsommation.production_id = production.id AND production.etat_id != ? AND DATE(production.created) >= ? AND DATE(production.created) <= ? $paras ";
		$item = LIGNECONSOMMATION::execute($requette, [$this->id, ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNECONSOMMATION()]; }
		return $item[0]->quantite;
	}



	public function perte(string $date1, string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras.= "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM perteressource WHERE perteressource.ressource_id = ? AND  perteressource.etat_id = ? AND DATE(perteressource.created) >= ? AND DATE(perteressource.created) <= ? $paras ";
		$item = PERTERESSOURCE::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTERESSOURCE()]; }
		return $item[0]->quantite;
	}




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function stockChantier(String $date1, String $date2, int $chantier_id){
		$item = $this->fourni("initialressourcechantier", ["chantier_id ="=>$chantier_id])[0];
		return $this->achatChantier($date1, $date2, $chantier_id) - $this->consommeeChantier($date1, $date2, $chantier_id) - $this->perteChantier($date1, $date2, $chantier_id) + $item->quantite;
	}



	public function achatChantier(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneapprochantierressource, approchantierressource WHERE ligneapprochantierressource.ressource_id = ? AND ligneapprochantierressource.approchantierressource_id = approchantierressource.id AND approchantierressource.etat_id = ? AND DATE(approchantierressource.created) >= ? AND DATE(approchantierressource.created) <= ? $paras ";
		$item = LIGNEAPPROCHANTIERRESSOURCE::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEAPPROCHANTIERRESSOURCE()]; }
		return $item[0]->quantite;
	}



	public function consommeeChantier(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneconsommationchantier, productionchantier WHERE ligneconsommationchantier.ressource_id =  ? AND ligneconsommationchantier.productionchantier_id = productionchantier.id AND productionchantier.etat_id != ? AND DATE(productionchantier.created) >= ? AND DATE(productionchantier.created) <= ? $paras ";
		$item = LIGNECONSOMMATIONCHANTIER::execute($requette, [$this->id, ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNECONSOMMATIONCHANTIER()]; }
		return $item[0]->quantite;
	}



	public function perteChantier(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM pertechantierressource WHERE pertechantierressource.ressource_id = ? AND  pertechantierressource.etat_id = ? AND DATE(pertechantierressource.created) >= ? AND DATE(pertechantierressource.created) <= ? $paras ";
		$item = PERTECHANTIERRESSOURCE::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTECHANTIERRESSOURCE()]; }
		return $item[0]->quantite;
	}


	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	public function neccessite(int $quantite, int $produit_id){
		$datas = EXIGENCEPRODUCTION::findBy(["produit_id ="=>$produitid]);
		foreach ($datas as $key => $exi) {
			foreach ($exi->fourni("ligneexigenceproduction", ["ressource_id ="=>$this->id]) as $key => $ligne) {
				if ($ligne->quantite > 0) {
					$total += ($quantite * $ligne->quantite) / $exi->quantite ;
				}
			}
		}
		return $total;
	}



	public function price(){
		$requette = "SELECT SUM(quantite_recu) as quantite, SUM(transport) as transport, SUM(ligneapprovisionnement.price) as price FROM ligneapprovisionnement, approvisionnement WHERE ligneapprovisionnement.ressource_id = ? AND ligneapprovisionnement.approvisionnement_id = approvisionnement.id AND approvisionnement.etat_id = ? ";
		$datas = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->id, ETAT::VALIDEE]);
		if (count($datas) < 1) {$datas = [new LIGNEAPPROVISIONNEMENT()]; }
		$item = $datas[0];

		$requette = "SELECT SUM(quantite_recu) as quantite FROM ligneapprovisionnement, approvisionnement WHERE ligneapprovisionnement.approvisionnement_id = approvisionnement.id AND approvisionnement.id IN (SELECT approvisionnement_id FROM ligneapprovisionnement WHERE ligneapprovisionnement.ressource_id = ? ) AND approvisionnement.etat_id = ? ";
		$datas = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->id, ETAT::VALIDEE]);
		if (count($datas) < 1) {$datas = [new LIGNEAPPROVISIONNEMENT()]; }
		$ligne = $datas[0];

		if ($item->quantite == 0) {
			return 0;
		}
		if (intval($this->price) <= 0) {
			$total = ($item->price / $item->quantite) + ($item->transport / $ligne->quantite);
			return $total;
		}
		return $this->price + ($item->transport / $ligne->quantite);
	}


	public static function rupture(int $agence_id = null){
		$params = PARAMS::findLastId();
		$datas = static::getAll();
		foreach ($datas as $key => $item) {
			if ($item->stock(PARAMS::DATE_DEFAULT, dateAjoute(1), $agence_id) > $params->ruptureStock) {
				unset($datas[$key]);
			}
		}
		return $datas;
	}




	public function sentenseCreate(){
		return $this->sentense = "Ajout d'une nouvelle ressource : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la ressource $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la ressource $this->id : $this->name";
	}


}



?>