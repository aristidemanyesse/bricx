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

                           <div class="col-sm-6 bloc">
                            <div class="ibox border">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Les produits</h5>
                                    <div class="ibox-tools">
                                        <a class="btn_modal btn_modal" data-toggle="modal" data-target="#modal-produit">
                                            <i class="fa fa-plus"></i> Ajouter
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Libéllé</th>
                                                <th>Actif ?</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i =0; foreach (Home\PRODUIT::findBy([], [], ["name"=>"ASC"]) as $key => $item) { ?>
                                                <tr>
                                                    <td ><img style="width: 40px" src="<?= $this->stockage("images", "produits", $item->image); ?>"></td>
                                                    <td class="gras"><?= $item->name(); ?></td>
                                                    <td>
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <input type="checkbox" <?= ($item->isActive())?"checked":""  ?> onchange='changeActive("produit", <?= $item->id ?>)' class="onoffswitch-checkbox" id="produit<?= $item->id ?>">
                                                                <label class="onoffswitch-label" for="produit<?= $item->id ?>">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-toggle="modal" data-target="#modal-produit" title="modifier le produit" onclick="modification('produit', <?= $item->id ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                    <td data-toggle="tooltip" title="modifier le produit" onclick="suppressionWithPassword('produit', <?= $item->id ?>)"><i class="fa fa-close cursor text-danger"></i></td>
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
                                    <h5 class="text-uppercase">Le materiel de construction</h5>
                                    <div class="ibox-tools">
                                        <a class="btn_modal btn_modal" data-toggle="modal" data-target="#modal-materiel">
                                            <i class="fa fa-plus"></i> Ajouter
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Libéllé</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i =0; foreach (Home\MATERIEL::findBy([], [], ["name"=>"ASC"]) as $key => $item) { ?>
                                                <tr>
                                                    <td ><img style="width: 40px" src="<?= $this->stockage("images", "materiels", $item->image); ?>"></td>
                                                    <td class="gras"><?= $item->name(); ?></td>
                                                    <td data-toggle="modal" data-target="#modal-materiel" title="modifier le materiel" onclick="modification('materiel', <?= $item->id ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                    <td data-toggle="tooltip" title="modifier le materiel" onclick="suppressionWithPassword('materiel', <?= $item->id ?>)"><i class="fa fa-close cursor text-danger"></i></td>
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
                                    <h5 class="text-uppercase">Les meteriaux de construction (ressource)</h5>
                                    <div class="ibox-tools">
                                        <button class="btn_modal btn btn-xs btn-white" data-toggle="modal" data-target="#modal-ressource">
                                            <i class="fa fa-plus"></i> Ajouter
                                        </button>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Libéllé</th>
                                                <th>Unité</th>
                                                <th>Abbr</th>
                                                <th>stockable ?</th>
                                                <th>Prix d'achat</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach (Home\RESSOURCE::findBy([], [], ["name"=>"ASC"]) as $key => $item) {
                                                $item->actualise(); ?>
                                                <tr>
                                                    <td class="gras"><?= $item->name(); ?></td>
                                                    <td><?= $item->unite; ?></td>
                                                    <td><?= $item->abbr; ?></td>
                                                    <td>
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <input type="checkbox" <?= ($item->isActive())?"checked":""  ?> onchange='changeActive("ressource", <?= $item->id ?>)' class="onoffswitch-checkbox" id="ressource<?= $item->id ?>">
                                                                <label class="onoffswitch-label" for="ressource<?= $item->id ?>">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width="110px">
                                                        <input type="text" title="Prix Unitaire normal" number class="form-control input-xs text-center ressource" step="0.1" value="<?= $item->price ?>" name="price" id="<?= $item->id ?>" >
                                                    </td>
                                                    <td data-toggle="modal" data-target="#modal-ressource" title="modifier l'élément" onclick="modification('ressource', <?= $item->id ?>)"><i class="fa fa-pencil text-blue cursor"></i></td>
                                                    <td title="supprimer la ressource" onclick="suppressionWithPassword('ressource', <?= $item->id ?>)"><i class="fa fa-close cursor text-danger"></i></td>
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

    <?php include($this->rootPath("composants/assets/modals/modal-produit.php") );  ?>
    <?php include($this->rootPath("composants/assets/modals/modal-ressource.php") );  ?>
    <?php include($this->rootPath("composants/assets/modals/modal-materiel.php") );  ?>


</body>



</html>