


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<?php include($this->rootPath("composants/assets/modals/modal-produit.php") );  ?>
<?php include($this->rootPath("composants/assets/modals/modal-ressource.php") );  ?>
<?php include($this->rootPath("composants/assets/modals/modal-vehicule.php") );  ?>
<?php include($this->rootPath("composants/assets/modals/modal-chauffeur.php") );  ?>



<?php foreach ($produits as $key => $type) {
	$lots = $type->fourni('exigenceproduction');
	if (count($lots) > 0) {
		$exi = $lots[0];
		$exi->actualise();
		$lots = $exi->fourni('ligneexigenceproduction'); ?>
		<div class="modal inmodal fade" id="modal-exigence<?= $type->id ?>">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Formulaire des exigence de production</h4>
						<small>Veuillez saisir les quantités de chaque ressources néccessaire pour la production</small>
					</div>
					<form method="POST" class="formExigence">
						<div class="modal-body">
							<div class="text-center">
								<div class="row">
									<div class="offset-sm-5 col-sm-2">
										<input type="number" name="quantite" class="form-control" step="0.1" value="<?= $exi->quantite; ?>">
									</div>	
								</div>
								<h2 class="text-uppercase"><?= $exi->produit->name() ?> </h2>
								<h4>utilise <br><i class=" fa fa-2x fa-long-arrow-right"></i></h4>
							</div>

							<div class="row">
								<?php foreach ($lots as $key => $ligne) { 
									$ligne->actualise(); ?>
									<div class="col-sm-2">
										<label><?= $ligne->ressource->name() ?> (<?= $ligne->ressource->abbr ?>)</label>
										<div class="form-group">
											<input type="number" number step="0.1" name="<?= $ligne->id ?>" class="form-control" value="<?= $ligne->quantite; ?>">
										</div>
									</div>					
								<?php } ?>
							</div>

						</div><hr>
						<div class="container">
							<input type="hidden" name="id" value="<?= $exi->id; ?>">
							<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
							<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
						</div>
						<br>
					</form>
				</div>
			</div>
		</div>

	<?php } 
} ?>


