<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class INITIALPRODUITAGENCE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $agence_id;
	public $produit_id;
	public $quantite = 0;

	public function enregistre(){
		$data = new RESPONSE;
		$datas = AGENCE::findBy(["id ="=>$this->agence_id]);
		if (count($datas) == 1) {
			$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
			if (count($datas) == 1) {
				if ($this->quantite >= 0) {
					$data = $this->save();
				}else{
					$data->status = false;
					$data->message = "Veuillez renseigner le nom du type d'operation !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'enregistrement de la vente!";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'enregistrement de la vente!";
		}
		return $data;
	}


	public function sentenseCreate(){
		return $this->sentense = "";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification du stock initial du produit: ".$this->produit->name()." dans ".$this->agence->name();
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de l'element $this->id :$this->id";
	}


}
?>