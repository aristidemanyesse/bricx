<?php 

namespace Home;

if ($this->id != null) {
	$datas = LIVRAISON::findBy(["id ="=> $this->id, 'etat_id !='=>ETAT::ANNULEE]);
	if (count($datas) > 0) {
		$livraison = $datas[0];
		$livraison->actualise();

		$livraison->fourni("lignelivraison");

		$title = "BRICX | Bon de livraison ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>