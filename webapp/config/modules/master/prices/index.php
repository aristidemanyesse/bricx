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
                                <a id="onglet-master" href="<?= $this->url("config", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px; margin-right: 10px;"><i class="fa fa-long-arrow-left"></i> Retour au tableau de bord</a>
                            </div>
                        </nav>
                    </div>

                    <br>
                    <div class="wrapper-content">
                        <div class="animated fadeInRightBig container-fluid">

                            <div class="row">


                                <div class="col-sm-12 bloc">
                                    <div class="ibox border">
                                        <div class="ibox-title">
                                            <h5 class="text-uppercase">Prix des produits par zone de livraison</h5>
                                            <div class="ibox-tools">
                                                <a class="btn_modal" data-toggle="modal" data-target="#modal-zonelivraison">
                                                    <i class="fa fa-plus"></i> Ajouter nouvelle zone
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) {  ?>
                                                            <td class="gras text-center"><?= $prod->name(); ?></td>
                                                        <?php } ?>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i =0; foreach (Home\ZONELIVRAISON::findBy([], [], ["name"=>"ASC"]) as $key => $zone) {
                                                        $i++; ?>
                                                        <tr>
                                                             <td title="supprimer la zone"><i class="fa fa-trash text-red cursor" onclick="suppressionWithPassword('zonelivraison', <?= $zone->id ?>)"></i></td>
                                                            <td class="gras"><?= $zone->name(); ?></td>
                                                            <?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $prod) { 
                                                                $pz = new Home\PRIX_ZONELIVRAISON();
                                                                $datas = $prod->fourni("prix_zonelivraison", ["zonelivraison_id ="=>$zone->id]);
                                                                if (count($datas) > 0) {
                                                                    $pz = $datas[0];
                                                                }
                                                                ?>
                                                                <td class="text-center" ><?= money($pz->price); ?> <?= $params->devise ?></td>
                                                            <?php } ?>
                                                            <td data-toggle="modal" data-target="#modal-prix<?= $zone->id ?>" title="modifier les prix"><i class="fa fa-pencil text-blue cursor"></i></td>
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
                                            <h5 class="text-uppercase">Paye par production</h5>
                                            <div class="ibox-tools">
                                                <a data-toggle="modal" data-target="#modal-paye_produit">
                                                    <i class="fa fa-plus"></i> Modifier les prix
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th class="text-center">Production</th>
                                                        <th class="text-center">Rangement</th>
                                                        <th class="text-center">Livraison</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i =0; foreach (Home\PAYE_PRODUIT::findBy() as $key => $item) {
                                                        $item->actualise() ?>
                                                        <tr>
                                                            <td class="gras"><img style="width: 30px; margin-right: 2%" src="<?= $this->stockage("images", "produits", $item->produit->image); ?>"> <?= $item->produit->name(); ?></td>
                                                            <td class="text-center"><?= money($item->price) ?> <?= $params->devise ?></td>
                                                            <td class="text-center"><?= money($item->price_rangement) ?> <?= $params->devise ?></td>
                                                            <td class="text-center"><?= money($item->price_livraison) ?> <?= $params->devise ?></td>
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
                                            <h5 class="text-uppercase">Paye par production <span class="text-red">dimanches & jours fériés</span></h5>
                                            <div class="ibox-tools">
                                                <a data-toggle="modal" data-target="#modal-paye_produit_ferie">
                                                    <i class="fa fa-plus"></i> Modifier les prix
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th class="text-center">Production</th>
                                                        <th class="text-center">Rangement</th>
                                                        <th class="text-center">Livraison</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i =0; foreach (Home\PAYEFERIE_PRODUIT::findBy() as $key => $item) {
                                                        $item->actualise() ?>
                                                        <tr>
                                                            <td class="gras"><img style="width: 30px; margin-right: 2%" src="<?= $this->stockage("images", "produits", $item->produit->image); ?>"> <?= $item->produit->name(); ?></td>
                                                            <td class="text-red text-center"><?= money($item->price) ?> <?= $params->devise ?></td>
                                                            <td class="text-red text-center"><?= money($item->price_rangement) ?> <?= $params->devise ?></td>
                                                            <td class="text-red text-center"><?= money($item->price_livraison) ?> <?= $params->devise ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
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

            <?php include($this->relativePath("modals.php")); ?>


        </body>



        </html>