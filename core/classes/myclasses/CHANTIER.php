<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class CHANTIER extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const PRINCIPAL = 1;

	public $name;
	public $lieu;
	public $autorisation;
	public $started;
	public $finished;
	public $previsionnel;
	public $comment;
	public $budgetchantier_id;
	public $etatchantier_id =  ETATCHANTIER::START;

	public $client_name;
	public $contact;
	public $email;

	public $montant;


	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			if ($this->started <= $this->finished) {
				$data = $this->save();
				if ($data->status) {

					foreach (PRODUIT::getAll() as $key => $prod) {
						$ligne = new INITIALPRODUITCHANTIER();
						$ligne->produit_id = $prod->id;
						$ligne->chantier_id = $this->id;
						$ligne->quantite = 0;
						$ligne->enregistre();
					}

					foreach (RESSOURCE::getAll() as $key => $prod) {
						$ligne = new INITIALRESSOURCECHANTIER();
						$ligne->ressource_id = $prod->id;
						$ligne->chantier_id = $this->id;
						$ligne->quantite = 0;
						$ligne->enregistre();
					}

					foreach (MATERIEL::getAll() as $key => $prod) {
						$ligne = new INITIALMATERIELCHANTIER();
						$ligne->materiel_id = $prod->id;
						$ligne->chantier_id = $this->id;
						$ligne->quantite = 0;
						$ligne->enregistre();
					}

					$compte = new BUDGETCHANTIER;
					$compte->name = "Compte budget de ".$this->name();
					$data = $compte->enregistre();
					if ($data->status) {
						$this->budgetchantier_id = $data->lastid;
						$this->save();
					}

					$tache = new TACHE();
					$tache->name = "Contruction du chantier '$this->name' ";
					$tache->chantier_id = $this->id;
					$tache->duree = dateDiffe($this->started, $this->finished);
					$tache->typeduree_id = TYPEDUREE::JOUR;
					$tache->etatchantier_id = $this->etatchantier_id;
					$tache->enregistre();

					$client = new CLIENTCHANTIER;
					$client->name = $this->client_name;
					$client->email = $this->email;
					$client->contact = $this->contact;
					$data = $client->enregistre();
					if ($data->status) {
						$this->clientchantier_id = $data->lastid;
						$this->save();
					}
				}
			}else{
				$data->status = false;
				$data->message = "Vérifiez la date de debut et de fin estimée du chantier !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez donner un nom à ce nouveau chantier !";
		}
		return $data;
	}



	public function affichageTaches(){
		foreach ($this->getInitalTaches() as $key => $tache) { ?>
			<ol class="dd-list">
				<?php $tache->affichageTache(); ?>
			</ol>
		<?php } 
	}


	public function retourJsons(){
		foreach ($this->getInitalTaches() as $key => $tache) { 
			$tableau = $tache->retourJson();
		} 
		return $tableau;
	}

	public function getInitalTaches(){
		return $this->fourni("tache", ["tache_id_parent IS "=> NULL], [], ["rang"=>"ASC"]);
	}


	public function tachesEncours(){
		return $this->fourni("tache", ["etatchantier_id = "=> ETATCHANTIER::ENCOURS], [], ["rang"=>"ASC"]);
	}


	public function sentenseCreate(){
		return $this->sentense = "Creation d'une nouvelle boutique : $this->name";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la boutique $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la boutique $this->id : $this->name";
	}

}
?>