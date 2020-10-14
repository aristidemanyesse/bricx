<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class LIGNEAPPROCHANTIERMATERIEL extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $approchantiermateriel_id;
	public $materiel_id;
	public $quantite = 0;
	public $quantite_recu = 0;
	public $price = 0;



	public function enregistre(){
		$data = new RESPONSE;
		$datas = APPROCHANTIERMATERIEL::findBy(["id ="=>$this->approchantiermateriel_id]);
		if (count($datas) == 1) {
			$datas = MATERIEL::findBy(["id ="=>$this->materiel_id]);
			if (count($datas) == 1) {
				if ($this->quantite > 0 ) {
					$this->quantite_recu = $this->quantite;
					if ($this->price >= 0 ) {
						$data = $this->save();
					}else{
						$data->status = false;
						$data->message = "La prix d'achat entrée n'est pas correcte !";
					}
				}else{
					$data->status = false;
					$data->message = "La quantité entrée n'est pas correcte !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'ajout du materiel !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'enregistrement de l'approvisionnemnt !";
		}
		return $data;
	}




	public function sentenseCreate(){

	}


	public function sentenseUpdate(){
	}


	public function sentenseDelete(){
	}

}



?>