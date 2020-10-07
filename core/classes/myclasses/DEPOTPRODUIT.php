<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class DEPOTPRODUIT extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $agence_id;
	public $zonelivraison_id;
	public $lieu;
	public $vehicule_id;
	public $chauffeur_id;
	public $etat_id = ETAT::ENCOURS;
	public $chargement;
	public $dechargement;
	public $employe_id;

	public $datelivraison;
	public $comment;
	public $nom_receptionniste;
	public $contact_receptionniste;

	public $nom_tricycle = "";
	public $contact_tricycle = "";
	public $paye_tricycle = 0;

	

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->lieu != "") {
			$datas = ZONELIVRAISON::findBy(["id ="=>$this->zonelivraison_id]);
			if (count($datas) == 1) {
				$datas = VEHICULE::findBy(["id ="=>$this->vehicule_id]);
				if (count($datas) == 1) {
					if ($this->vehicule_id == VEHICULE::AUTO || ($this->vehicule_id == VEHICULE::TRICYCLE && $this->nom_tricycle != "" && $this->paye_tricycle > 0) || ($this->vehicule_id > VEHICULE::TRICYCLE && $this->chauffeur_id > 0)) {

						$this->agence_id = getSession("agence_connecte_id");
						$this->employe_id = getSession("employe_connecte_id");
						$this->reference = "BLI/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
						$data = $this->save();

						if ($data->status && $this->vehicule_id == VEHICULE::TRICYCLE) {
							$tri = new TRICYCLE;
							$tri->livraison_id = $this->id;
							$tri->name = $this->nom_tricycle;
							$tri->contact = $this->contact_tricycle;
							$tri->montant = $this->paye_tricycle;
							$data = $tri->enregistre();
						}

					}else{
						$data->status = false;
						$data->message = "Veuillez renseigner tous les champs pour valider la livraison !";
					}
				}else{
					$data->status = false;
					$data->message = "veuillez selectionner un véhicule pour la livraison!";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'enregistrement de la livraison!";
			}
		}else{
			$data->status = false;
			$data->message = "veuillez indiquer la destination précise de la livraison *!";
		}
		return $data;
	}




	public function chauffeur(){
		if ($this->vehicule_id == VEHICULE::AUTO) {
			return "le client même";
		}else if ($this->vehicule_id == VEHICULE::TRICYCLE) {
			$datas = $this->fourni("tricycle");
			if (count($datas) > 0) {
				$item = $datas[0];
				return $item->name();
			}
			return "";
		}else{
			return $this->chauffeur->name();
		}
	}


	public function vehicule(){
		if ($this->vehicule_id == VEHICULE::AUTO) {
			return "SON PROPRE VEHICULE";
		}else if ($this->vehicule_id == VEHICULE::TRICYCLE) {
			return "TRICYCLE";
		}else{
			return $this->vehicule->name();
		}
	}



	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->historique("La livraison en reference $this->reference vient d'être annulée !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();

				if ($this->chauffeur_id > 0) {
					$this->chauffeur->disponibilite_id = DISPONIBILITE::LIBRE;
					$this->chauffeur->save();
				}

				$this->vehicule->etat_id = DISPONIBILITE::LIBRE;
				$this->vehicule->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette livraison !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::VALIDEE;
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("La livraison en reference $this->reference vient d'être terminé !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				if ($this->chauffeur_id > 0) {
					$this->chauffeur->disponibilite_id = DISPONIBILITE::LIBRE;
					$this->chauffeur->save();
				}

				$this->vehicule->disponibilite_id = DISPONIBILITE::LIBRE;
				$this->vehicule->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette livraison !";
		}
		return $data;
	}

	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}