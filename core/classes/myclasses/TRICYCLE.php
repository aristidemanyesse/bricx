<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class TRICYCLE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $agence_id;
	public $livraison_id;
	public $name;
	public $contact;
	public $montant = 0;
	public $etat_id = ETAT::ENCOURS;


	

	public function enregistre(){
		$data = new RESPONSE;
		$datas = LIVRAISON::findBy(["id ="=>$this->livraison_id]);
		if (count($datas) == 1) {
			if ($this->name != "" ) {
				if ($this->montant > 0) {
					$this->agence_id = getSession("agence_connecte_id");
					$data = $this->save();
				}else{
					$data->status = false;
					$data->message = "Veuillez renseigner le montant de la location du tricycle";
				}
			}else{
				$data->status = false;
				$data->message = "Veuillez renseigner le nom du chauffeur de tricycle !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'enregistrement de la livraison!";
		}
		return $data;
	}



	public function resteAPayer(){
		return $this->montant - comptage($this->fourni("payementtricycle"), "montant", "somme");
	}



	public static function dettes(int $agence_id = null){
		$total = 0;
		if ($agence_id != null) {
			foreach (static::findBy(["agence_id ="=> $agence_id]) as $key => $tri) {
				$total += $tri->resteAPayer();
			}
		}else{
			foreach (static::findBy([]) as $key => $tri) {
				$total += $tri->resteAPayer();
			}
		}
		return $total;
	}


	public static function total($date1, $date2, int $agence_id = null){
		$total = 0;
		if ($agence_id != null) {
			$datas = static::findBy(["agence_id ="=> $agence_id, "DATE(created) >= "=>$date1, "DATE(created) <= "=>$date2, "etat_id != "=>ETAT::ANNULEE]);
		}else{
			$datas = static::findBy(["DATE(created) >= "=>$date1, "DATE(created) <= "=>$date2, "etat_id != "=>ETAT::ANNULEE]);
		}
		return comptage($datas, "montant", "somme");
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>