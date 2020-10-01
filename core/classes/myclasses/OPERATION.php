<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
/**
 * 
 */
class OPERATION extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $montant;
	public $categorieoperation_id;
	public $mouvement_id;
	public $modepayement_id ;
	public $structure;
	public $numero;
	public $employe_id;
	public $agence_id ;
	public $etat_id = ETAT::VALIDEE;
	public $comment;
	public $date_approbation;
	public $image;


	public function enregistre(){
		$data = new RESPONSE;
		$this->employe_id = getSession("employe_connecte_id");
		$this->agence_id = getSession("agence_connecte_id");
		
		$datas = EMPLOYE::findBy(["id ="=>$this->employe_id]);
		if (count($datas) == 1) {
			$datas = CATEGORIEOPERATION::findBy(["id ="=>$this->categorieoperation_id]);
			if (count($datas) == 1) {
				$cat = $datas[0];
				if ( $cat->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE || ($cat->typeoperationcaisse_id == TYPEOPERATIONCAISSE::SORTIE && $this->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE)) {

					if (($cat->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE) && !in_array($this->modepayement_id, [MODEPAYEMENT::ESPECE, MODEPAYEMENT::PRELEVEMENT_ACOMPTE]) ) {
						$this->etat_id = ETAT::ENCOURS;
					}else{
						$this->etat_id = ETAT::VALIDEE;
					}


					if (intval($this->montant) > 0) {
						$mouvement = new MOUVEMENT();

						$datas = AGENCE::findBy(["id ="=>getSession("agence_connecte_id")]);
						if (count($datas) > 0) {
							$item = $datas[0];
							$mouvement->comptebanque_id = $item->comptebanque_id;
						}
						
						$mouvement->montant = $this->montant;
						$mouvement->comment = $this->comment;
						$mouvement->modepayement_id = $this->modepayement_id;
						$mouvement->name = $cat->name();
						$mouvement->typemouvement_id = TYPEMOUVEMENT::DEPOT;
						if ($cat->typeoperationcaisse_id == TYPEOPERATIONCAISSE::SORTIE) {
							$mouvement->typemouvement_id = TYPEMOUVEMENT::RETRAIT;
						}
						$data = $mouvement->enregistre();
						if ($data->status) {
							$this->reference = "BCA/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
							$this->mouvement_id = $mouvement->id;
							$data = $this->save();
							if ($data->status) {
								if (!(isset($this->files) && is_array($this->files))) {
									$this->files = [];
								}
								$this->uploading($this->files);
							}
						}
					}else{
						$data->status = false;
						$data->message = "Le montant pour cette opération est incorrecte, verifiez-le !";
					}
				}else{
					$data->status = false;
					$data->message = "Vous ne pouvez pas utiliser ce mode de payement pour effectuer cette opération !!";
				}				
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer 1 !!";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer 2 !!";
		}
		return $data;
	}



	public function uploading(Array $files){
		//les proprites d'images;
		$tab = ["image"];
		if (is_array($files) && count($files) > 0) {
			$i = 0;
			foreach ($files as $key => $file) {
				if ($file["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($file);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "operations", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
			}			
		}
	}


	public function valider(){
		$data = new RESPONSE;
		$this->etat_id = ETAT::VALIDEE;
		$this->date_approbation = date("Y-m-d H:i:s");
		$this->historique("Approbation de l'opération de caisse N° $this->reference");
		return $this->save();
	}


	public function annuler(){
		return $this->supprime();
	}



	public static function entree(string $date1 = "2020-04-01", string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras = "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(montant) as montant  FROM operation, categorieoperation WHERE operation.categorieoperation_id = categorieoperation.id AND categorieoperation.typeoperationcaisse_id = ? AND operation.valide = 1 AND DATE(operation.created) >= ? AND DATE(operation.created) <= ? $paras";
		$item = OPERATION::execute($requette, [TYPEOPERATIONCAISSE::ENTREE, $date1, $date2]);
		if (count($item) < 1) {$item = [new OPERATION()]; }
		return $item[0]->montant;
	}



	public static function sortie(string $date1 = "2020-04-01", string $date2, int $agence_id = null){
		$paras = "";
		if ($agence_id != null) {
			$paras = "AND agence_id = $agence_id ";
		}
		$requette = "SELECT SUM(montant) as montant  FROM operation, categorieoperation WHERE operation.categorieoperation_id = categorieoperation.id AND categorieoperation.typeoperationcaisse_id = ? AND operation.valide = 1 AND DATE(operation.created) >= ? AND DATE(operation.created) <= ? $paras";
		$item = OPERATION::execute($requette, [TYPEOPERATIONCAISSE::SORTIE, $date1, $date2]);
		if (count($item) < 1) {$item = [new OPERATION()]; }
		return $item[0]->montant;
	}




	public static function resultat(string $date1 = "2020-04-01", string $date2, int $agence_id = null){
		return static::entree($date1, $date2, $agence_id) - static::sortie($date1, $date2, $agence_id);
	}





	public static function enAttente(int $agence_id = null){
		if ($agence_id != null) {
			return static::findBy(["etat_id ="=> ETAT::ENCOURS, "agence_id ="=>$agence_id]);
		}else{
			return static::findBy(["etat_id ="=> ETAT::ENCOURS]);
		}
	}





	public function sentenseCreate(){
		return $this->sentense = "enregistrement d'une nouvelle opération de caisse N°$this->reference";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la opération de caisse N°$this->reference ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la opération de caisse N°$this->reference";
	}
}



?>