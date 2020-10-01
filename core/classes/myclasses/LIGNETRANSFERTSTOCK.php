<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class LIGNETRANSFERTSTOCK extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $transfertstock_id;
	public $produit_id;
	public $quantite_avant = 0;
	public $quantite_apres = 0;



	public function enregistre(){
		$data = new RESPONSE;
		$datas = TRANSFERTSTOCK::findBy(["id ="=>$this->transfertstock_id]);
		if (count($datas) == 1) {
			$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
			if (count($datas) == 1) {
				if ($this->quantite_avant >= 0 ) {
					$data = $this->save();
				}else{
					$data->status = false;
					$data->message = "La quantité entrée n'est pas correcte !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
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