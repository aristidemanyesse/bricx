<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class LOCATION extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $fournisseurchantier_id;
	public $chantier_id;
	public $engin;
	public $montant;
	public $avance;
	public $started;
	public $finished;
	public $comment;
	public $etat_id = ETAT::ENCOURS;
	public $employe_id = 0;

	public $modepayement_id ;
	public $structure;
	public $numero;


	public function enregistre(){
		$data = new RESPONSE;

		if ($this->engin != "") {
			if ($this->montant > 0) {
				if ($this->started <= $this->finished) {
					if ($this->montant >= $this->avance) {

						$datas = CHANTIER::findBy(["id ="=>getSession("chantier_connecte_id")]);
						if (count($datas) == 1) {
							$chantier = $datas[0];
							$chantier->actualise();
							$datas = FOURNISSEURCHANTIER::findBy(["id ="=>$this->fournisseurchantier_id]);
							if (count($datas) == 1) {
								$fournisseur = $datas[0];


								if (($this->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE && $this->avance > 0) || ($this->modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE)) {
									$data->status = true;
									if ($this->modepayement_id == MODEPAYEMENT::PRELEVEMENT_ACOMPTE){
										$this->avance = 0;
									}
									if ($this->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE){

										if ($this->montant > intval($this->avance)) {
											$fournisseur->dette($this->montant - intval($this->avance));
										}

										$payement = new REGLEMENTFOURNISSEURCHANTIER();
										$payement->cloner($this);
										$payement->id = null;
										$payement->montant = $this->avance;
										$payement->comment = "Réglement de la facture pour la location N°".$this->reference;
										$data = $payement->enregistre();
										if ($data->status) {
											$fournisseur->actualise();
											$payement->acompteClient = $fournisseur->acompte;
											$payement->detteClient = $fournisseur->resteAPayer();
											$payement->save();
										}
									}
									if ($data->status) {
										$this->chantier_id = getSession("chantier_connecte_id");
										$this->employe_id = getSession("employe_connecte_id");
										$this->reference = "LOC/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
										$data = $this->save();
										if ($data->status && $this->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
											$payement->location_id = $this->id;
											$data = $payement->save();
										}
									}

								}else{
									$data->status = false;
									$data->message = "Le montant de l'avance pour cette location est incorrecte, veuillez recommencer !";
								}
							}else{
								$data->status = false;
								$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer 2 !!";
							}
						}else{
							$data->status = false;
							$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer 1 !!";
						}
					}else{
						$data->status = false;
						$data->message = "Le montant de l'avance ne doit pas être plus élévé que le montant de la location !";
					}
				}else{
					$data->status = false;
					$data->message = "Les dates mentionnées pour la location ne sont pas correctes !";
				}
			}else{
				$data->status = false;
				$data->message = "Le montant de la location n'est pas correcte !";
			}
		}else{
			$data->status = false;
			$data->message = "veuillez indiquer le nom de l'engin à louer !";
		}
		return $data;
	}



	public function reste(){
		if ($this->etat_id != ETAT::ANNULEE) {
			return $this->montant - comptage($this->fourni("reglementfournisseurchantier"), "montant", "somme");
		}
		return 0;
	}



	// Supprimer toutes les livraisons programmée qui n'ont pu etre effectuée...
	public static function ResetProgramme(){
		$datas = LIVRAISON::findBy(["etat_id ="=>ETAT::PARTIEL, "DATE(datelivraison) <"=>dateAjoute()]);
		foreach ($datas as $key => $livraison) {
			$livraison->fourni("lignelivraison");
			foreach ($livraison->lignelivraisons as $key => $value) {
				$value->delete();
			}
			$livraison->delete();
		}
		
		// $requette = "DELETE FROM livraison WHERE etat_id = ? AND DATE(datelivraison) < ? ";
		// static::query($requette, [ETAT::PARTIEL, dateAjoute()]);
	}


	public function chauffeur(){
		if ($this->vehicule_id == VEHICULE::AUTO) {
			return "...";
		}else if ($this->vehicule_id == VEHICULE::TRICYCLE) {
			return $this->nom_tricycle;
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
				$this->groupecommande->etat_id = ETAT::ENCOURS;
				$this->groupecommande->save();

				if ($this->chauffeur_id > 0) {
					$this->chauffeur->etatchauffeur_id = ETATCHAUFFEUR::RAS;
					$this->chauffeur->save();
				}

				$this->vehicule->etat_id = ETATVEHICULE::RAS;
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
					$this->chauffeur->etatchauffeur_id = ETATCHAUFFEUR::RAS;
					$this->chauffeur->save();
				}

				$this->vehicule->etatvehicule_id = ETATVEHICULE::RAS;
				$this->vehicule->save();

				$this->groupecommande->etat_id = ETAT::ENCOURS;
				$this->groupecommande->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette livraison !";
		}
		return $data;
	}



	public static function perte(string $date1, string $date2){
		$total = 0;
		$datas = LIVRAISON::findBy(["etat_id ="=>ETAT::VALIDEE, "DATE(datelivraison) >= " => $date1, "DATE(datelivraison) <= " => $date2]);
		foreach ($datas as $key => $livraison) {
			$lots = $livraison->fourni("lignelivraison");
			foreach ($lots as $key => $ligne) {
				$total += $ligne->quantite - $ligne->quantite_livree;
			}
		}
		return $total;
	}




	public function payer(int $montant, Array $post){
		$data = new RESPONSE;
		$solde = $this->reste;
		if ($solde > 0) {
			if ($solde >= $montant) {
				$payement = new OPERATION();
				$payement->hydrater($post);
				if ($payement->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
					$payement->categorieoperation_id = CATEGORIEOPERATION::PAYE_TRICYLE;
					$payement->manoeuvre_id = $this->id;
					$payement->comment = "Réglement de la paye de tricycle ".$this->chauffeur()." pour la commande N°".$this->reference;
					$data = $payement->enregistre();
					if ($data->status) {
						$this->reste -= $montant;
						$this->isPayer = 1;
						$data = $this->save();
					}
				}else{
					$data->status = false;
					$data->message = "Vous ne pouvez pas utiliser ce mode de payement pour effectuer cette opération !";
				}
			}else{
				$data->status = false;
				$data->message = "Le montant à verser est plus élévé que sa paye !";
			}
		}else{
			$data->status = false;
			$data->message = "Vous etes déjà à jour pour la paye de ce tricycle !";
		}
		return $data;
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>