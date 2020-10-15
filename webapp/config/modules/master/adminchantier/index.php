<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/config/elements/templates/head.php")); ?>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">
                    <!--<div class="navbar-header">-->
                        <!--<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">-->
                            <!--<i class="fa fa-reorder"></i>-->
                            <!--</button>-->

                            <a href="#" class="navbar-brand " style="padding: 3px 15px;"><h1 class="mp0 gras" style="font-size: 45px">BRICX</h1></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-reorder"></i>
                            </button>

                            <!--</div>-->
                            <div class="navbar-collapse collapse" id="navbar">
                                <ul class="nav navbar-nav mr-auto">
                                    <li class="gras <?= (isJourFerie(dateAjoute(1)))?"text-red":"text-muted" ?>">
                                        <span class="m-r-sm welcome-message text-uppercase" id="date_actu"></span> 
                                        <span class="m-r-sm welcome-message gras" id="heure_actu"></span> 
                                    </li>

                                </ul>
                                <a id="onglet-master" href="<?= $this->url("config", "master", "organisation") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px; margin-right: 10px;"><i class="fa fa-long-arrow-left"></i> Retour</a>
                            </div>
                        </nav>
                    </div>


                    <div class="wrapper-content">
                        <div class="animated fadeInRightBig container-fluid">

                            <h1 class="text-center display-4 text-uppercase"><?= $chantier->name()  ?></h1><br>

                            <div class="row">

                                <div class="col-sm-6 bloc">
                                    <div class="ibox border">
                                        <div class="ibox-title">
                                            <h5 class="text-uppercase">Stock initial des matières premières</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Libéllé</th>
                                                        <th>Unité</th>
                                                        <th>Stock initial</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach (Home\INITIALRESSOURCECHANTIER::findBy(["chantier_id ="=>$chantier->id]) as $key => $item) {
                                                        $item->actualise(); ?>
                                                        <tr>
                                                            <td class="gras"><?= $item->ressource->name(); ?></td>
                                                            <td><?= $item->ressource->unite; ?></td>
                                                            <td width="110px">
                                                                <?php if ($item->ressource->isActive()) { ?>
                                                                    <input type="text" title="Stock initial" number class="form-control input-xs text-center maj" value="<?= $item->quantite ?>" name="initialressourcechantier" id="<?= $item->id ?>">
                                                                <?php }  ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 bloc">
                                    <div class="ibox border">
                                        <div class="ibox-title">
                                            <h5 class="text-uppercase">Stock initial des matériels engagés</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Libéllé</th>
                                                        <th>Stock initial</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach (Home\INITIALMATERIELCHANTIER::findBy(["chantier_id ="=>$chantier->id]) as $key => $item) {
                                                        $item->actualise(); ?>
                                                        <tr>
                                                            <td class="gras"><?= $item->materiel->name(); ?></td>
                                                            <td width="110px">
                                                                <?php if ($item->materiel->isActive()) { ?>
                                                                    <input type="text" title="Stock initial" number class="form-control input-xs text-center maj" value="<?= $item->quantite ?>" name="initialmaterielchantier" id="<?= $item->id ?>">
                                                                <?php }  ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-12 bloc">
                                    <div class="ibox border">
                                        <div class="ibox-title">
                                            <h5 class="text-uppercase">Stock initial par produit dans cette chantier</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row text-center">
                                                <?php foreach ($produits as $key => $produit) {
                                                    $item = $produit->fourni("initialproduitchantier", ["chantier_id ="=>$chantier->id])[0]; ?>
                                                    <div class="col-sm-4 col-md-3 col-lg-2 border-left border-bottom">
                                                        <div class="p-xs">
                                                            <i class="fa fa-cube fa-2x text-dark"></i>
                                                            <h6 class="text-uppercase gras"><?= $produit->name() ?> </h6>

                                                            <input type="text" title="Stock initial" number class="form-control input-xs text-center maj" value="<?= $item->quantite ?>" name="initialproduitchantier" id="<?= $item->id ?>">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <br>

                    <?php include($this->rootPath("webapp/config/elements/templates/footer.php")); ?>

                </div>
            </div>

            <?php include($this->rootPath("webapp/config/elements/templates/script.php")); ?>

        </body>



        </html>