<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class PRODUCTIONCHANTIER extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $chantier_id;
	public $ladate;
	public $montant_production = 0;
	public $montant_rangement = 0;
	public $montant_livraison = 0;
	public $employe_id;
	public $employe_id_rangement;
	public $dateRangement;
	public $comment = "";
	public $etat_id = ETAT::ENCOURS;


	public function enregistre(){
		$this->ladate = dateAjoute();
		$this->chantier_id = getSession("chantier_connecte_id");
		$this->employe_id = getSession("employe_connecte_id");
		$this->reference = "PROD/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
		$data = $this->save();
		return $data;
	}



	public static function today(){
		$datas = static::findBy(["ladate ="=>dateAjoute()]);
		if (count($datas) > 0) {
			$pro = $datas[0];
		}else{
			$pro = new PRODUCTIONCHANTIER();
			$data = $pro->enregistre();

			foreach (PRODUIT::getAll() as $key => $produit) {
				$ligne = new LIGNEPRODUCTION();
				$ligne->production_id = $pro->id;
				$ligne->produit_id = $produit->id;
				$ligne->enregistre();

				$ligne = new LIGNEPRODUCTIONCHANTIER();
				$ligne->productionchantier_id = $pro->id;
				$ligne->produit_id = $produit->id;
				$ligne->enregistre();
			}
			
			foreach (RESSOURCE::getAll() as $key => $ressource) {
				$ligne = new LIGNECONSOMMATION();
				$ligne->production_id = $pro->id;
				$ligne->ressource_id = $ressource->id;
				$ligne->enregistre();

				$ligne = new LIGNECONSOMMATIONCHANTIER();
				$ligne->productionchantier_id = $pro->id;
				$ligne->ressource_id = $ressource->id;
				$ligne->enregistre();
			}
		}

		return $pro;
	}



	public static function stats(string $date1 = "2020-04-01", string $date2, int $chantier_id = null){
		$tableaux = [];
		$nb = ceil(dateDiffe($date1, $date2) / 12);
		$index = $date1;
		if ($chantier_id == null) {
			while ( $index <= $date2 ) {
				
				$data = new \stdclass;
				$data->year = date("Y", strtotime($index));
				$data->month = date("m", strtotime($index));
				$data->day = date("d", strtotime($index));
				$data->nb = $nb;
			////////////

				$data->total = PRODUIT::totalProduit($date1, $index);
				// $data->marge = 0 ;

				$tableaux[] = $data;
			///////////////////////

				$index = dateAjoute1($index, ceil($nb));
			}
		}else{
			while ( $index <= $date2 ) {

				$data = new \stdclass;
				$data->year = date("Y", strtotime($index));
				$data->month = date("m", strtotime($index));
				$data->day = date("d", strtotime($index));
				$data->nb = $nb;
			////////////

				$data->total = PRODUIT::totalProduit($date1, $index, $chantier_id);
				// $data->marge = 0 ;

				$tableaux[] = $data;
			///////////////////////

				$index = dateAjoute1($index, ceil($nb));
			}
		}
		return $tableaux;
	}



	public function sentenseCreate(){
		return $this->sentense = "Nouvelle production : $this->reference";
	}
	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations de la production N°: $this->reference ";
	}
	public function sentenseDelete(){
		return $this->sentense = "Suppression definitive de la production N°: $this->reference";
	}

}
?>