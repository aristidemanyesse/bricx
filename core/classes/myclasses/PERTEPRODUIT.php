<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class PERTEPRODUIT extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $agence_id;
	public $typeperte_id;
	public $produit_id;
	public $quantite;
	public $comment;
	public $employe_id;
	public $etat_id = ETAT::VALIDEE;


	public function enregistre(){
		$data = new RESPONSE;
			$datas = TYPEPERTE::findBy(["id ="=>$this->typeperte_id]);
			if (count($datas) == 1) {
				$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
				if (count($datas) == 1) {
					$ressource = $datas[0];
					if ($this->quantite > 0) {

						$stock = $ressource->stock(PARAMS::DATE_DEFAULT, dateAjoute(1), getSession("agence_connecte_id"));
						if ($stock >= $this->quantite) {
							$this->employe_id = getSession("employe_connecte_id");
							$this->agence_id = getSession("agence_connecte_id");
							$data = $this->save();
						}else{
							$data->status = false;
							$data->message = "La quantité perdue est plus élévé que celle que vous avez effectivement !";
						}
						
					}else{
						$data->status = false;
						$data->message = "Une erreur s'est produite lors  de l'opération, veuillez recommencer !";
					}
				}else{
					$data->status = false;
					$data->message = "Erreur sur la quantité perdue !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors  de l'opération, veuillez recommencer !";
			}
		return $data;
	}




	public function sentenseCreate(){
		return $this->sentense = "Nouvelle perte de ".$this->produit->name()." dans ".$this->chantier->name();
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la perte sur le chantier N°$this->id ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la perte sur le chantier N°$this->id";
	}
}

?>