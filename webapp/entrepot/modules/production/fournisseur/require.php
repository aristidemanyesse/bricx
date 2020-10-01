<?php 
namespace Home;

unset_session("ressources");

if ($this->id != null) {
	$datas = FOURNISSEUR::findBy(["id ="=> $this->id]);
	if (count($datas) > 0) {
		$fournisseur = $datas[0];
		$fournisseur->actualise();

		$encours = $fournisseur->fourni("approvisionnement", ["agence_id ="=>$agence->id, "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);



		$datas = $fournisseur->fourni("approvisionnement", ["agence_id ="=>$agence->id, "etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);



		$fluxcaisse = $fournisseur->fourni("reglementfournisseur");
		usort($fluxcaisse, "comparerDateCreated2");

		$title = "BRICX | ".$fournisseur->name();

		session("fournisseur_id", $fournisseur->id);
		
	}else{
		header("Location: ../master/fournisseurs");
	}
}else{
	header("Location: ../master/fournisseurs");
}
?>