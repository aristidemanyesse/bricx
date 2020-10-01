<?php 
namespace Home;

if ($this->id != null) {
	$datas = AGENCE::findBy(["id ="=>$this->id]);
	if (count($datas) > 0) {
		$agence = $datas[0];
		$agence->actualise();
		
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