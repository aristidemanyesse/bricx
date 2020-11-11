<?php 
namespace Home;

if ($this->id != null) {
	$datas = CHANTIER::findBy(["id ="=> $this->id]);
	if (count($datas) > 0) {
		$chantier = $datas[0];
		$chantier->actualise();

		$images = $chantier->fourni("imagechantier", [], [], ["created"=>"DESC"], 4);

		// $encours = $chantier->fourni("groupecommande", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

		// $groupes = $chantier->fourni("groupecommande", ["etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


		$tableau = [];
		foreach (PRODUIT::getAll() as $key => $prod) {
			$data = new \stdclass();
			$data->name = $prod->name();
			$data->image = $prod->image;
			$data->livrable = $prod->livrable(PARAMS::DATE_DEFAULT, dateAjoute(1), $chantier->id);
			$data->attente = $prod->attente($chantier->id);
			$tableau[] = $data;
		}



		$title = "BRICX | ".$chantier->name();

		session("chantier_connecte_id", $chantier->id);

	}else{
		header("Location: ../master/chantiers");
	}
}else{
	header("Location: ../master/chantiers");
}