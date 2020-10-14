<?php 
namespace Home;

unset_session("ressources");

if ($this->id != null) {
	$datas = FOURNISSEURCHANTIER::findBy(["id ="=> $this->id]);
	if (count($datas) > 0) {
		$fournisseur = $datas[0];
		$fournisseur->actualise();

		$encours1 = $fournisseur->fourni("approchantierressource", ["chantier_id ="=>$chantier->id, "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);
		$encours2 = $fournisseur->fourni("approchantierproduit", ["chantier_id ="=>$chantier->id, "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);
		$encours3 = $fournisseur->fourni("approchantiermateriel", ["chantier_id ="=>$chantier->id, "etat_id ="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);
		$encours = array_merge($encours1, $encours2, $encours3);


		$datas1 = $fournisseur->fourni("approchantierressource", ["chantier_id ="=>$chantier->id, "etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);
		$datas2 = $fournisseur->fourni("approchantierproduit", ["chantier_id ="=>$chantier->id, "etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);
		$datas3 = $fournisseur->fourni("approchantiermateriel", ["chantier_id ="=>$chantier->id, "etat_id !="=>ETAT::ENCOURS], [], ["created"=>"DESC"]);
		$datas = array_merge($datas1, $datas2, $datas3);


		$fluxcaisse = $fournisseur->fourni("reglementfournisseurchantier");
		usort($fluxcaisse, "comparerDateCreated2");

		$title = "BRICX | ".$fournisseur->name();

		session("fournisseur_id", $fournisseur->id);
		
	}else{
		header("Location: ../production/fournisseurs");
	}
}else{
	header("Location: ../production/fournisseurs");
}
?>