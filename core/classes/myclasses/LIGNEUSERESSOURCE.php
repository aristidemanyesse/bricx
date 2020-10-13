<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class LIGNEUSERESSOURCE extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $useressource_id;
	public $ressource_id;
	public $quantite;
	public $perte = 0;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = USERESSOURCE::findBy(["id ="=>$this->useressource_id]);
		if (count($datas) == 1) {
			$datas = RESSOURCE::findBy(["id ="=>$this->ressource_id]);
			if (count($datas) == 1) {
				if ($this->quantite >= 0) {
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