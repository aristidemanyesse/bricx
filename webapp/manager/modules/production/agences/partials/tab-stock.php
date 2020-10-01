<div role="tabpanel" id="pan-ventes" class="tab-pane">
	<div class="panel-body">

		<div class="ibox">
			<div class="ibox-title">
				<h5 class="text-uppercase">Stock de briques</h5>
			</div>
			<div class="ibox-content">
				<div class="row text-center">
					<?php $total = 0; foreach ($produits as $key => $produit) {
						$stock = $produit->enAgence(Home\PARAMS::DATE_DEFAULT, dateAjoute(1), $agence->id);
						$prix = $stock;
						$total += $prix ?>
						<div class="col-sm-4 col-md-3 border-left border-bottom">
							<div class="p-xs">
								<i class="fa fa-cube fa-2x text-dark"></i>
								<h5 class="m-xs gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= round($stock, 2) ?> unités</h5>
								<h6 class="no-margins text-uppercase gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= $produit->name() ?> </h6>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>


			<div class="ibox-content">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th rowspan="2" class="border-none"></th>
							<?php foreach ($produits as $key => $produit) {  ?>
								<th class="text-center"><small class="gras"><?= $produit->name() ?></small></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php 
						$index = $date1;
						while ($index <= $date2) { ?>
							<tr>
								<td class="gras "><?= datecourt($index) ?></td>
								<?php foreach ($produits as $key => $produit) {
									$stock = $produit->enAgence(Home\PARAMS::DATE_DEFAULT, $index, $agence->id);
									$production = $produit->production($index, $index, $agence->id);
									$achat = $produit->achat($index, $index, $agence->id);
									$livree = $produit->livraison($index, $index, $agence->id);
									$perteL = $produit->perteLivraison($index, $index, $agence->id);
									$perteR = $produit->perteRangement($index, $index, $agence->id);
									$perteA = $produit->perteAutre($index, $index, $agence->id);
									?>
									<td class="cursor myPopover text-center"
									data-toggle="popover"
									data-placement="right"
									title="<small><b><?= $produit->name() ?></b> | <?= datecourt($index) ?></small>"
									data-trigger="hover"
									data-html="true"
									data-content="
									<span>Production du jour : <b><?= round($production, 2) ?> </b></span><br>
									<span>Stock acheté : <b><?= round($achat, 2) ?> </b></span><br>
									<span>livraison du jour : <b><?= round($livree, 2) ?> </b></span><br>
									<span class='text-red'>Perte Livraison: <b><?= round($perteL, 2) ?> </b></span><br>
									<span class='text-red'>Perte Rangement: <b><?= round($perteR, 2) ?> </b></span><br>
									<span class='text-red'>Autre Perte : <b><?= round($perteA, 2) ?> </b></span>
									<hr style='margin:1.5%'>
									<span>En stock à ce jour : <b><?= round($stock, 2) ?> </b></span><br> <span>">
										<?= round($stock, 2) ?> 
									</td>
								<?php } ?>
							</tr>
							<?php
							$index = dateAjoute1($index, 1);
						}
						?>
						<tr style="height: 18px;"></tr>
					</tbody>
				</table> 
			</div>
		</div>
		
	</div>
</div>