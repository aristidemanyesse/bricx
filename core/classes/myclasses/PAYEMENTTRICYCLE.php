<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class PAYEMENTTRICYCLE extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $reference;
	public $agence_id;
	public $tricycle_id;
	public $mouvement_id;
	public $montant = 0;
	public $modepayement_id ;
	public $structure;
	public $numero;
	public $employe_id;



	public function enregistre(){
		$data = new RESPONSE;
		$datas = TRICYCLE::findBy(["id ="=>$this->tricycle_id]);
		if (count($datas) == 1) {
			if ($this->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
				if ($this->montant > 0) {
					$mouvement = new MOUVEMENT;
					$mouvement->cloner($this);
					$mouvement->id = null;
					$datas = AGENCE::findBy(["id ="=>getSession("agence_connecte_id")]);
					if (count($datas) > 0) {
						$item = $datas[0];
						$mouvement->comptebanque_id = $item->comptebanque_id;
					}
					$mouvement->comment = "Payement des frais de livraison du tricycle d'un montant de $this->montant F";
					$mouvement->name = "Paye du tricycle";
					$mouvement->typemouvement_id = TYPEMOUVEMENT::RETRAIT;
					$data = $mouvement->enregistre();
					if ($data->status) {
						$this->mouvement_id = $mouvement->id;
						$this->employe_id = getSession("employe_connecte_id");
						$this->agence_id = getSession("agence_connecte_id");
						$data = $this->save();
					}
				}else{
					$data->status = false;
					$data->message = "Veuillez verifiez le montant de la paye du tricycle !!";
				}
			}else{
				$data->status = false;
				$data->message = "Vous ne pouvez pas utiliser ce mode de payement, veuillez recommencer !!";
			}
		}else{
			$data->status = false;
			$data->message = "++Une erreur s'est produite lors de l'opération, veuillez recommencer !!";
		}
		return $data;
	}





	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>