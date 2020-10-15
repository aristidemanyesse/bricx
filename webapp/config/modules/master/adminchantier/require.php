<?php 
namespace Home;

if ($this->id != null) {
	$datas = CHANTIER::findBy(["id ="=>$this->id]);
	if (count($datas) > 0) {
		$chantier = $datas[0];
		$chantier->actualise();
		
		$produits = PRODUIT::findBy(["isActive ="=>TABLE::OUI]);
		$ressources = RESSOURCE::getAll([], [], ["name"=>"ASC"]);

		$title = "BRICX | Espace de configuration des stocks initiaux ";

	}else{
		header("Location: ../master/dashboard");
	}
}else{
	header("Location: ../master/dashboard");
}






?>