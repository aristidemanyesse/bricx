<?php 

namespace Home;

if ($this->id != null) {
	$datas = APPROCHANTIERPRODUIT::findBy(["id ="=> $this->id, 'etat_id !='=>ETAT::ANNULEE]);
	if (count($datas) > 0) {
		$appro = $datas[0];
		$appro->actualise();

		$appro->fourni("ligneapprochantierproduit");

		$title = "BRICX | Bon d'achat de briques ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>