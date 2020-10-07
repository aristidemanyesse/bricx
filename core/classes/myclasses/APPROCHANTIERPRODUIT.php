<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class APPROCHANTIERPRODUIT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $montant = 0;
	public $avance = 0;
	public $reste = 0;
	public $transport;
	public $reglementfournisseurchantier_id ;
	public $fournisseurchantier_id;
	public $chantier_id;
	public $employe_id;
	public $etat_id;
	public $employe_id_reception;
	public $comment;
	public $datelivraison;

	public $acompteFournisseur = 0;
	public $detteFournisseur = 0;
	
	public function enregistre(){
		$data = new RESPONSE;
		$datas = FOURNISSEURCHANTIER::findBy(["id ="=>$this->fournisseurchantier_id]);
		if (count($datas) == 1) {
			if ($this->montant >= 0 ) {
				$this->reference = "APP/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
				$this->employe_id = getSession("employe_connecte_id");
				$this->chantier_id = getSession("chantier_connecte_id");
				$data = $this->save();
				if ($data->status && $this->transport > 0) {
					$mouvement = new OPERATIONCHANTIER();
					$mouvement->montant = $this->transport;
					$mouvement->categorieoperation_id = CATEGORIEOPERATION::FRAISTRANSPORT;
					$mouvement->modepayement_id = MODEPAYEMENT::ESPECE;
					$mouvement->comment = "Frais de transport pour l'approvisionnement de ressource pour le chantier N° ".$this->reference;
					$data = $mouvement->enregistre();
				}
			}else{
				$data->status = false;
				$data->message = "Le montant de la commande n'est pas correcte !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
		}
		return $data;
	}


	public static function encours(){
		return static::findBy(["etat_id ="=>ETAT::ENCOURS]);
	}
	

	public function reste(){
		return $this->montant - comptage($this->fourni("reglementfournisseurchantier"), "montant", "somme");
	}


	public function reglement(){
		$data = new RESPONSE;
		$this->actualise();
		if ($this->reste() > 0) {
			$solde = $this->agence->comptebanque->solde();
			if ($this->agence->comptebanque->solde() > 0) {
				$reglement = new REGLEMENTFOURNISSEURCHANTIER();
				$reglement->recouvrement = TABLE::OUI;
				$reglement->idd = $this->id;
				$reglement->approchantierressource_id = $this->id;
				$reglement->fournisseurchantier_id = $this->fournisseurchantier->id;
				$reglement->classe = "approvisionnement";
				$reglement->montant = ($solde >= $this->reste())? $this->reste() : $solde;
				$reglement->modepayement_id = MODEPAYEMENT::ESPECE;
				$reglement->comment = "Recouvrement d'approvisionnement de matieres premières N°$this->reference ";

				$reglement->historique("Recouvrement d'approvisionnement de ressource N°$this->reference pour un montant de $reglement->montant ");
				$data = $reglement->enregistre();
			}else{
				$data->status = false;
				$data->message = "L'acompte du fournisseur est épuisé pour recouvrir la/les approvisionnements restante(s) !!";
			}
		}else{
			$data->status = false;
			$data->message = "Cet approvisionnement à déjà été réglé entièrement !";
		}
		return $data ;
	}


	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'approvisionnement en reference $this->reference vient d'être annulée !");
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
			$data->message = "Vous ne pouvez plus faire cette opération sur cet approvisionnement !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::VALIDEE;
			$this->employe_id_reception = getSession("employe_connecte_id");
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'approvisionnement en reference $this->reference vient d'être terminé !");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet approvisionnement !";
		}
		return $data;
	}


	
	public function sentenseCreate(){
		$this->sentense = "enregistrement d'un nouvel approvisionnement de ressource N°$this->reference ";
	}
	public function sentenseUpdate(){
		$this->sentense = "Modification des informations de l'approvisionnement de ressource N°$this->reference ";
	}
	public function sentenseDelete(){
		$this->sentense = "Suppression de l'approvisionnement de ressource N°$this->reference ";
	}
}



?>