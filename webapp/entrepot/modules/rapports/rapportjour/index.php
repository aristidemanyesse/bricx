<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/entrepot/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/entrepot/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/entrepot/elements/templates/header.php")); ?>  


            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">
                    <div class="ibox">
                       <div class="ibox-title">
                        <h5>Recapitulatif de la journée</h5>
                        <div class="ibox-tools">
                            <form id="formFiltrer" method="POST">
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-8">
                                        <input type="date" value="<?= $date ?>" class="form-control input-sm" name="date">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" onclick="filtrer()" class="btn btn-sm btn-white"><i class="fa fa-search"></i> Filtrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <img style="width: 20%" src="<?= $this->stockage("images", "societe", $params->image) ?>">
                            </div>
                            <div class="col-sm-8 text-right">
                                <h2 class="title text-uppercase gras">Recapitulatif de la journée</h2>
                                <h3>Du <?= datecourt3($date) ?></h3>
                            </div>
                        </div><hr><br>

                        <div class="row">
                            <div class="col-sm-9" style="border-right: 2px solid black">

                                <?php if ($employe->isAutoriser("production")) { ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="text-uppercase text-center">production</h3>
                                            <table class="table table-bordered mp0">
                                                <thead>
                                                    <tr>
                                                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {  ?>
                                                            <th colspan="2" class="text-center"><?= $produit->name() ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                                            $datas = $produit->fourni("ligneproduction", ["DATE(created) = " => $date]);  ?>
                                                            <td data-toogle="tooltip" title="production" class="text-center gras"><?= money(comptage($datas, "quantite", "somme")) ?></td>
                                                            <td data-toogle="tooltip" title="perte" class="text-center text-red"><?= money($produit->perte($date, $date, $agence->id)) ?></td>
                                                        <?php   }  ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-6">
                                            <h3 class="text-uppercase text-center">consommation des ressources</h3>
                                            <table class="table table-bordered mp0">
                                                <thead>
                                                    <tr>
                                                        <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) {  ?>
                                                            <th class="text-center"><?= $ressource->name() ?></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) {
                                                            $datas = $ressource->fourni("ligneconsommation", ["DATE(created) = " => $date]);  ?>
                                                            <td data-toogle="tooltip" title="production" class="text-center"><?= (comptage($datas, "quantite", "somme")) ?> <?= $ressource->abbr  ?></td>
                                                        <?php   }  ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><hr><hr>


                                    <br><h3 class="text-uppercase text-center">Approvisionnements</h3><br>
                                    <div class="">
                                        <?php if (count($approvisionnements) > 0) { ?>
                                            <div class="row">
                                                <?php foreach ($approvisionnements as $key => $approvisionnement) { 
                                                    $approvisionnement->actualise();
                                                    $datas = $approvisionnement->fourni("ligneapprovisionnement"); ?>
                                                    <div class="col-md-4 col-sm-6">
                                                        <div class="text-left">
                                                            <h6 class="mp0"><span>Fournisseur :</span> <span class="text-uppercase"><?= $approvisionnement->fournisseur->name() ?></span></h6>                            
                                                            <h6 class="mp0"><span>Etat :</span> <span class="text-uppercase"><?= $approvisionnement->etat->name() ?></span></h6>
                                                        </div>
                                                        <table class="table table-bordered mp0">
                                                            <thead>
                                                                <tr>
                                                                    <?php foreach ($approvisionnement->ligneapprovisionnements as $key => $ligne) { 
                                                                        if ($ligne->quantite > 0) {
                                                                            $ligne->actualise(); ?>
                                                                            <th class="text-center"><?= $ligne->ressource->name() ?></th>
                                                                        <?php }
                                                                    } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <?php foreach ($approvisionnement->ligneapprovisionnements as $key => $ligne) {
                                                                        if ($ligne->quantite > 0) { ?>
                                                                            <td class="text-center"><?= $ligne->quantite ?></td>
                                                                        <?php   } 
                                                                    } ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <span class="mp0 pull-right"><span>Coût :</span> <span class="text-uppercase"><?= money($approvisionnement->montant) ?> <?= $params->devise ?></span></span>
                                                        <hr>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php }else{ ?>
                                            <p class="text-center text-muted italic">Aucune approvisionnement ce jour </p>
                                        <?php } ?>
                                    </div>
                                    <?php } ?><hr><br>


                                </div>
                                <div class="col-sm-3 text-right">
                                    <h4 class="text-uppercase">Employés connectés</h4>
                                    <ul>
                                        <?php foreach ($employes as $key => $emp) { 
                                            $emp->actualise();  ?>
                                            <li><?= $emp->name(); ?></li>
                                        <?php } ?>
                                    </ul><br>
                                    <hr>


                                    <h4 class="text-uppercase">Coût de la production</h4><br>   

                                    <h6 class="text-uppercase">Coût de production</h6>
                                    <h3 class="text-info"><?= money($productionjour->montant_production); ?> <?= $params->devise ?></h3>

                                    <h6 class="text-uppercase">Coût de Rangement</h6>
                                    <h3 class="text-blue"><?= money($productionjour->montant_rangement); ?> <?= $params->devise ?></h3>

                                    <h6 class="text-uppercase">Coût de livraison</h6>
                                    <h3 class="text-warning"><?= money($productionjour->montant_livraison); ?> <?= $params->devise ?></h3>
                                    <hr>


                                    <h4 class="text-uppercase">COMMENTAIRE</h4>
                                    <p class="text-justify"><?= $productionjour->comment ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php include($this->rootPath("webapp/entrepot/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/entrepot/elements/templates/script.php")); ?>


</body>

</html>
