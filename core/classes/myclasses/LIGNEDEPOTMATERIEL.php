<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class LIGNEDEPOTMATERIEL extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $depotmateriel_id;
	public $materiel_id;
	public $quantite_depart;
	public $quantite;
	public $perte = 0;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = DEPOTPRODUIT::findBy(["id ="=>$this->depotmateriel_id]);
		if (count($datas) == 1) {
			$datas = PRODUIT::findBy(["id ="=>$this->materiel_id]);
			if (count($datas) == 1) {
				if ($this->quantite_depart >= 0) {
					$this->quantite = $this->quantite_depart;
					$data = $this->save();
				}				
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de la mise en boutique du materiel !";
			}			
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de la mise en boutique du materiel !";
		}
		return $data;
	}




	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}

?>