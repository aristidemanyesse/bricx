<div role="tabpanel" id="pan-global" class="tab-pane">
	<div class=" border-bottom white-bg dashboard-header">
		<div class="ibox">
			<div class="ibox-title">
				<h5 class="float-left">Du <?= datecourt($date1) ?> au <?= datecourt($date2) ?></h5>
				<div class="ibox-tools">
					<form id="formFiltrer" method="POST">
						<div class="row" style="margin-top: -1%">
							<div class="col-5">
								<input type="date" value="<?= $date1 ?>" class="form-control input-sm" name="date1">
							</div>
							<div class="col-5">
								<input type="date" value="<?= $date2 ?>" class="form-control input-sm" name="date2">
							</div>
							<div class="col-2">
								<button type="button" onclick="filtrer()" class="btn btn-sm btn-white"><i class="fa fa-search"></i> Filtrer</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<br>
			<div class="ibox-content">
				<div class="row">
					<div class="col-md-4">
						<div class="text-center">
							<img src="<?= $this->stockage("images", "societe", $params->image) ?>" style="height: 140px;" alt=""><br>
							<h2 class="text-uppercase"><?= $agence->name() ?></h2><br>
						</div>
						<ul class="list-group clear-list m-t">
							<li class="list-group-item fist-item">
								Commandes en cours <span class="label label-success float-right"><?= start0(count($groupes__)); ?></span> 
							</li>
							<li class="list-group-item">
								Livraisons en cours <span class="label label-success float-right"><?= start0(count($livraisons__)); ?></span> 
							</li>
							<li class="list-group-item"></li>
						</ul>
					</div>
					<div class="col-md-8">
						<div class="text-center">
							<div class="" style="margin-top: 0%">
								<div id="ct-chart" style="height: 250px;"></div>
							</div>
							<small>Graphe de comparaison des différents modes de ventes</small>
						</div><hr>
						<div class="row stat-list text-center">
							<div class="col-4 ">
								<h3 class="no-margins text-green"><?= money($comptebanque->getIn(dateAjoute(), dateAjoute(1))) ?> <small><?= $params->devise ?></small></h3>
								<small>Entrées du jour</small>
							</div>
							<div class="col-4 border-left border-right">
								<h2 class="no-margins gras"><?= money($comptebanque->solde()) ?> <small><?= $params->devise ?></small></h2>
								<small>En caisse actuellement</small>
							</div>
							<div class="col-4">
								<h3 class="no-margins text-red"><?= money($comptebanque->getOut(dateAjoute(), dateAjoute(1))) ?> <small><?= $params->devise ?></small></h3>
								<small>Dépenses du jour</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><hr>
</div>




<script>
	$(document).ready(function() {

 // Stocked horizontal bar

 new Chartist.Bar('#ct-chart', {
 	labels: [<?php foreach ($tableau as $key => $data){ ?>"<?= $data->name ?>", " ", " ",<?php } ?>],
 	series: [
 	[<?php foreach ($tableau as $key => $data){ ?><?= $data->attente ?>, 0, 0,<?php } ?>],
 	[<?php foreach ($tableau as $key => $data){ ?><?= $data->livrable ?> , 0, 0,<?php } ?>],
 	[<?php foreach ($tableau as $key => $data){ ?>0, <?= $data->commande ?>, 0,<?php } ?>],
 	]
 }, {
 	stackBars: true,
 	axisX: {
 		labelInterpolationFnc: function(value) {
 			if (value >= 1000) {
 				return (value / 1000) + 'k';            
 			}
 			return value;
 		}
 	},
 	reverseData:true,
 	seriesBarDistance: 10,
 	horizontalBars: true,
 	axisY: {
 		offset: 80
 	}
 });



});
</script>
