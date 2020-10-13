<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class USEPRODUIT extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $chantier_id;
	public $tache_id;
	public $comment;
	public $employe_id;
	public $etat_id = ETAT::VALIDEE;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = CHANTIER::findBy(["id ="=>$this->chantier_id]);
		if (count($datas) == 1) {
			$this->employe_id = getSession("employe_connecte_id");
			$data = $this->save();			
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'operation, veuillez recommencer !";
		}
		return $data;
	}




	public function sentenseCreate(){
		return $this->sentense = "enregistrement d'une nouvelle sortie de briques N°$this->id";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la sortie de briques N°$this->id ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la sortie de briques N°$this->id";
	}
}

?>