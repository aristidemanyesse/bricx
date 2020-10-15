<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Native\FICHIER;
/**
 * 
 */
class MATERIEL extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $name;
	public $isActive = TABLE::OUI;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {

				foreach (CHANTIER::getAll() as $key => $exi) {
					$ligne = new INITIALMATERIELCHANTIER();
					$ligne->chantier_id = $exi->id;
					$ligne->materiel_id = $this->id;
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



	public function stock(String $date1, String $date2, int $chantier_id){
		$item = $this->fourni("initialmaterielchantier", ["chantier_id ="=>$chantier_id])[0];
		return $this->achat($date1, $date2, $chantier_id) - $this->depot($date1, $date2, $chantier_id) - $this->perte($date1, $date2, $chantier_id) + $item->quantite;
	}




	public function achat(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite_recu) as quantite  FROM ligneapprochantiermateriel, approchantiermateriel WHERE ligneapprochantiermateriel.materiel_id = ? AND ligneapprochantiermateriel.approchantiermateriel_id = approchantiermateriel.id AND approchantiermateriel.etat_id = ? AND DATE(approchantiermateriel.created) >= ? AND DATE(approchantiermateriel.created) <= ? $paras ";
		$item = LIGNEAPPROCHANTIERMATERIEL::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEAPPROCHANTIERMATERIEL()]; }
		return $item[0]->quantite;
	}



	public function depot(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM lignedepotmateriel, depotmateriel WHERE lignedepotmateriel.materiel_id = ?  AND lignedepotmateriel.depotmateriel_id = depotmateriel.id AND depotmateriel.etat_id = ? AND DATE(depotmateriel.created) >= ? AND DATE(depotmateriel.created) <= ? $paras ";
		$item = LIGNEDEPOTRESSOURCE::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEDEPOTRESSOURCE()]; }
		return $item[0]->quantite;
	}



	public function perte(string $date1, string $date2, int $chantier_id = null){
		$paras = "";
		if ($chantier_id != null) {
			$paras.= "AND chantier_id = $chantier_id ";
		}
		$requette = "SELECT SUM(quantite) as quantite  FROM pertechantiermateriel WHERE pertechantiermateriel.materiel_id = ? AND  pertechantiermateriel.etat_id = ? AND DATE(pertechantiermateriel.created) >= ? AND DATE(pertechantiermateriel.created) <= ? $paras ";
		$item = PERTECHANTIERMATERIEL::execute($requette, [$this->id, ETAT::VALIDEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new PERTECHANTIERMATERIEL()]; }
		return $item[0]->quantite;
	}





	public function price(){
		$requette = "SELECT SUM(quantite_recu) as quantite, SUM(transport) as transport, SUM(ligneapprochantiermateriel.price) as price FROM ligneapprochantiermateriel, approchantiermateriel WHERE ligneapprochantiermateriel.materiel_id = ? AND ligneapprochantiermateriel.approchantiermateriel_id = approchantiermateriel.id AND approchantiermateriel.etat_id = ? ";
		$datas = LIGNEAPPROVISIONNEMENT::execute($requette, [$this->id, ETAT::VALIDEE]);
		if (count($datas) < 1) {$datas = [new LIGNEAPPROVISIONNEMENT()]; }
		$item = $datas[0];

		$requette = "SELECT SUM(quantite_recu) as quantite FROM ligneapprochantiermateriel, approchantiermateriel WHERE ligneapprochantiermateriel.approchantiermateriel_id = approchantiermateriel.id AND approchantiermateriel.id IN (SELECT approchantiermateriel_id FROM ligneapprochantiermateriel WHERE ligneapprochantiermateriel.materiel_id = ? ) AND approchantiermateriel.etat_id = ? ";
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


	public static function rupture(int $chantier_id = null){
		$params = PARAMS::findLastId();
		$datas = static::getAll();
		foreach ($datas as $key => $item) {
			if ($item->stock(PARAMS::DATE_DEFAULT, dateAjoute(1), $chantier_id) > $params->ruptureStock) {
				unset($datas[$key]);
			}
		}
		return $datas;
	}




	public function sentenseCreate(){
		return $this->sentense = "Ajout d'une nouvelle materiel : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du materiel $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive du materiel $this->id : $this->name";
	}


}



?>