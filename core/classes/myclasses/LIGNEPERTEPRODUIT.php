<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class LIGNEPERTEPRODUIT extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $perteproduit_id;
	public $produit_id;
	public $quantite;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = PERTEPRODUIT::findBy(["id ="=>$this->perteproduit_id]);
		if (count($datas) == 1) {
			$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
			if (count($datas) == 1) {
				$produit = $datas[0];
				if ($this->quantite > 0) {

					$stock = $produit->enAgence(PARAMS::DATE_DEFAULT, dateAjoute(1), getSession("agence_connecte_id"));
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
					$data->message = "Erreur sur la quantité perdue !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors  de l'opération, veuillez recommencer !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors  de l'opération, veuillez recommencer !";
		}
		return $data;
	}


	public function name(){
		$this->actualise();
		if ($this->produit_id != null) {
			return $this->typeproduit_parfum->name();

		}elseif ($this->produit_id != null) {
			return $this->produit->name();

		}elseif ($this->ressource_id != null) {
			return $this->ressource->name();

		}elseif ($this->emballage_id != null) {
			return $this->emballage->name();
		}
	}





	public function sentenseCreate(){
		return $this->sentense = "Nouvelle perte dans ".$this->agence->name();
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la perte en entrepot $this->id ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la perte en entrepot $this->id";
	}

}

?>