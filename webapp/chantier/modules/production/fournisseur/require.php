<?php 
namespace Home;

unset_session("ressources");

if ($this->id != null) {
	$datas = FOURNISSEURCHANTIER::findBy(["id ="=> $this->id]);
	if (count($datas) > 0) {
		$fournisseur = $datas[0];
		$fournisseur->actualise();

		$encours = $fournisseur->fourni("approchantierressource", ["chantier_id ="=>$chantier->id, "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);

		$datas = $fournisseur->fourni("approchantierressource", ["chantier_id ="=>$chantier->id, "etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);


		$fluxcaisse = $fournisseur->fourni("reglementfournisseurchantier");
		usort($fluxcaisse, "comparerDateCreated2");

		$title = "GPV | ".$fournisseur->name();

		session("fournisseur_id", $fournisseur->id);
		
	}else{
		header("Location: ../production/fournisseurs");
	}
}else{
	header("Location: ../production/fournisseurs");
}
?>