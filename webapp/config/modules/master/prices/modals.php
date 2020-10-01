


<div class="modal inmodal fade" id="modal-zonelivraison">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">zone de livraison</h4>
			</div>
			<form method="POST" class="formShamman" classname="zonelivraison">
				<div class="modal-body">
					<div class="">
						<label>Libéllé </label>
						<div class="form-group">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>





<?php $i =0; foreach (Home\ZONELIVRAISON::findBy([], [], ["name"=>"ASC"]) as $key => $zone) { ?>
	<div class="modal inmodal fade" id="modal-prix<?= $zone->id ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Formulaire des prix</h4>
				</div>
				<form method="POST" class="formPrix">
					<div class="modal-body">
						<h3 class="text-uppercase text-center">Pour la zone <b><?= $zone->name() ?></b></h3><br>

						<div class="row justify-content-center">
							<?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) { 
								$pz = new Home\PRIX_ZONELIVRAISON();
								$datas = $prod->fourni("prix_zonelivraison", ["zonelivraison_id ="=>$zone->id]);
								if (count($datas) > 0) {
									$pz = $datas[0];
								}
								?>
								<div class="col-sm-4 col-md-3 col-lg-2 text-center">
									<label><?= $prod->name() ?> </label>
									<div class="form-group">
										<input data-id="<?= $pz->id; ?>" type="number" number class="form-control" value="<?= $pz->price; ?>">
									</div>
								</div>
							<?php } ?>
						</div>						
					</div><hr>
					<div class="container">
						<input type="hidden" name="id">
						<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
						<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
					</div>
					<br>
				</form>
			</div>
		</div>
	</div>
<?php } ?>





<div class="modal inmodal fade" id="modal-paye_produit">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Prix de paye du produit</h4>
			</div>
			<form method="POST" class="formPayeProduit">
				<div class="modal-body">
					<div class="row">
						<?php $i =0; foreach (Home\PAYE_PRODUIT::getAll() as $key => $item) {
							$item->actualise(); ?>
							<div class="col-sm-6 col-md-4 border-right border-bottom" style="margin-bottom: 2%;">
								<p class="text-center text-uppercase gras">1 <?= $item->produit->name() ?> est payé à</p>
								<div class="row">
									<div class="col-sm">
										<label>Production</label>
										<input type="number"  style="font-size: 13px; padding: 3px" data-id="<?= $item->id; ?>" number class="form-control text-center" name="price" value="<?= $item->price ?>">
									</div>
									<div class="col-sm">
										<label>Rangement</label>
										<input type="number"  style="font-size: 13px; padding: 3px" data-id="<?= $item->id; ?>" number class="form-control text-center" name="price_rangement" value="<?= $item->price_rangement ?>">
									</div>
									<div class="col-sm">
										<label>Livraison</label>
										<input type="number"  style="font-size: 13px; padding: 3px" data-id="<?= $item->id; ?>" number class="form-control text-center" name="price_livraison" value="<?= $item->price_livraison ?>">
									</div>
								</div><br>
							</div>					
						<?php } ?>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>



<div class="modal inmodal fade" id="modal-paye_produit_ferie">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title text-red">Prix de paye du produit les jours fériés</h4>
			</div>
			<form method="POST" class="formPayeProduitFerie">
				<div class="modal-body">
					<div class="row">
						<?php $i =0; foreach (Home\PAYEFERIE_PRODUIT::getAll() as $key => $item) {
							$item->actualise(); ?>
							<div class="col-sm-6 col-md-4 border-right border-bottom" style="margin-bottom: 2%;">
								<p class="text-center text-uppercase gras text-red">1 <?= $item->produit->name() ?> est payé à</p>
								<div class="row">
									<div class="col-sm">
										<label>Production</label>
										<input type="number"  style="font-size: 13px; padding: 3px" data-id="<?= $item->id; ?>" number class="form-control text-center" name="price" value="<?= $item->price ?>">
									</div>
									<div class="col-sm">
										<label>Rangement</label>
										<input type="number"  style="font-size: 13px; padding: 3px" data-id="<?= $item->id; ?>" number class="form-control text-center" name="price_rangement" value="<?= $item->price_rangement ?>">
									</div>
									<div class="col-sm">
										<label>Livraison</label>
										<input type="number"  style="font-size: 13px; padding: 3px" data-id="<?= $item->id; ?>" number class="form-control text-center" name="price_livraison" value="<?= $item->price_livraison ?>">
									</div>
								</div><br>
							</div>					
						<?php } ?>
					</div>
				</div><hr>
				<div class="container">
					<input type="hidden" name="id">
					<button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
					<button class="btn btn-sm btn-primary pull-right dim"><i class="fa fa-check"></i> enregistrer</button>
				</div>
				<br>
			</form>
		</div>
	</div>
</div>

