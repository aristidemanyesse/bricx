<?php 
namespace Home;

if ($this->id != null) {
	$datas = CHANTIER::findBy(["id ="=> $this->id]);
	if (count($datas) > 0) {
		$chantier = $datas[0];
		$chantier->actualise();

		// $encours = $chantier->fourni("groupecommande", ["etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

		// $groupes = $chantier->fourni("groupecommande", ["etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


		$title = "BRICX | ".$chantier->name();

		session("chantier_connecte_id", $chantier->id);

	}else{
		header("Location: ../master/chantiers");
	}
}else{
	header("Location: ../master/chantiers");
}