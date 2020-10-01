<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class ZONELIVRAISON extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const MAGASIN = 1;

	public $name;

	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name != "") {
			$data = $this->save();
			if ($data->status) {
				foreach (PRODUIT::getAll() as $key => $produit) {
					$datas = PRIX_ZONELIVRAISON::findBy(["produit_id ="=>$produit->id, "zonelivraison_id ="=>$data->lastid]);
					if (count($datas) == 0) {
						$ligne = new PRIX_ZONELIVRAISON();
						$ligne->zonelivraison_id = $data->lastid;
						$ligne->produit_id = $produit->id;
						$ligne->price = 0;
						$ligne->enregistre();
					}
				}
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez renseigner le nom du zone de vente !";
		}
		return $data;
	}


	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau zone de vente : $this->name dans les paramétrages";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du zone de vente $this->id : $this->name ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive du zone de vente $this->id : $this->name";
	}
	
}
?>