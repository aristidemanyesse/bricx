<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class LIGNEDEPOTRESSOURCE extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $depotressource_id;
	public $ressource_id;
	public $quantite_depart;
	public $quantite;
	public $perte = 0;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = DEPOTRESSOURCE::findBy(["id ="=>$this->depotressource_id]);
		if (count($datas) == 1) {
			$datas = RESSOURCE::findBy(["id ="=>$this->ressource_id]);
			if (count($datas) == 1) {
				if ($this->quantite_depart >= 0) {
					$this->quantite = $this->quantite_depart;
					$data = $this->save();
				}				
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est ressourcee lors de la mise en boutique du ressource !";
			}			
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est ressourcee lors de la mise en boutique du ressource !";
		}
		return $data;
	}




	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}

?>