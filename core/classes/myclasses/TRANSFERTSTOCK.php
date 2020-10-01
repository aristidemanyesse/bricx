<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class TRANSFERTSTOCK extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $agence_id;
	public $reference;
	public $groupecommande_id;
	public $groupecommande_id_new;
	public $client_id;
	public $employe_id;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = GROUPECOMMANDE::findBy(["id ="=>$this->groupecommande_id]);
		if (count($datas) == 1) {
			$datas = CLIENT::findBy(["id ="=>$this->client_id]);
			if (count($datas) == 1) {
				$this->reference = "TRANSFERT/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
				$this->agence_id = getSession("agence_connecte_id");
				$this->employe_id = getSession("employe_connecte_id");
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
		}
		return $data;
	}




	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'achat de stock en reference $this->reference vient d'être annulée !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				if ($this->operation_id > 0) {
					$this->operation->supprime();
					$this->fournisseur->dette -= $this->montant - $this->avance;
					$this->fournisseur->save();
				}else{
						//paymenet par prelevement banquaire
					$this->fournisseur->acompte += $this->avance;
					$this->fournisseur->dette -= $this->montant - $this->avance;
					$this->fournisseur->save();
				}
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet achat de stock !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::VALIDEE;
			$this->employe_id_reception = getSession("employe_connecte_id");
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'achat de stock en reference $this->reference vient d'être terminé !");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet achat de stock !";
		}
		return $data;
	}


	
	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>