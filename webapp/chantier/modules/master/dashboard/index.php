<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/chantier/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/chantier/elements/templates/header.php")); ?>  

            <div class="border-bottom white-bg dashboard-header">
                <div class="row">
                    <div class="col-md-3">
                        <h2><?= $chantier->name()  ?></h2>
                        <small>N° Autorisation</small>
                        <h3 class="mp0"><?= $chantier->autorisation  ?></h3><br>

                        <small>Situé à</small>
                        <h4 class="mp0"><?= $chantier->lieu ?></h4><br>

                        <small>Construction de </small>
                        <h5 class="mp0"><?= $chantier->comment ?></h5><br><br>

                        <button data-toggle="modal" data-target="#modal-chantier" onclick="modification('chantier', <?= $chantier->id ?>)" class="btn btn-xs dim btn-info"><i class="fa fa-pencil"></i> Modifier les infos du chantier</button>
                    </div>
                    <div class="col-md-6">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <?php for ($i=1; $i < count($images) ; $i++) { ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php foreach ($images as $key => $image) { ?>
                                    <div class="carousel-item">
                                        <img class="d-block w-100 img-thumbnail" style="height: 270px" src="<?= $this->stockage("images", "imageschantiers", $image->image) ?>" alt="<?= $image->name() ?>">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p><?= $image->name() ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div><br>
                        <div class="text-center">
                            <h3><?= $chantier->etatchantier->name() ?> // <b><?= datecourt($chantier->started) ?></b> --- <b><?= datecourt($chantier->finished) ?></b></h3>
                            <h5> <?= ceil(dateDiffe(dateAjoute(), $chantier->finished)) ?> jours restants avant la fin des travaux</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                Nombre de tâches <span class="label label-success float-right">1</span>
                            </li><br>
                            <li class="list-group-item">
                                Tâches encours d'opération <span class="label label-success float-right">1</span>
                            </li>
                            <li class="list-group-item">
                                Tâches en attentes <span class="label label-success float-right">1</span>
                            </li>
                            <li class="list-group-item">
                                Tâches déjà éffectuées <span class="label label-success float-right">1</span>
                            </li>
                        </ul><br>

                        <?php if ($chantier->etatchantier_id == Home\ETATCHANTIER::START) { ?>
                            <br><button class="btn btn-xs dim btn-success btn-block"><i class="fa fa-flag"></i> Entamer les traveaux</button><br>
                        <?php } ?>
                        <?php if ($chantier->etatchantier_id == Home\ETATCHANTIER::ENCOURS) { ?>
                            <div class="btn-group">
                                <button class="btn btn-xs dim btn-danger m-0"><i class="fa fa-pencil"></i> Annuler</button>
                                <button class="btn btn-xs dim btn-warning m-0"><i class="fa fa-pencil"></i> Stopper</button>
                                <button class="btn btn-xs dim btn-primary m-0"><i class="fa fa-pencil"></i> Terminer</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <hr style="border-top: dashed 3px #ddd"><br>
                <div class="row">
                    <?php foreach ($tableau as $key => $produit) { ?>
                        <div class="col-sm-6 col-md-3 col-lg-2 border-right " style="margin-bottom: 3%; border-bottom: 2px solid black">
                            <h6 class="text-uppercase text-center"><img class="border" src="<?= $this->stockage("images", "produits", $produit->image) ?>" style="height: 20px;"> Stock de <u class="gras"><?= $produit->name ?></u></h6>
                            <ul class="list-group clear-list m-t">
                                <li class="list-group-item">
                                    <i class="fa fa-cubes"></i> <small>Disponible</small>          
                                    <span class="float-right">
                                        <small title="en boutique" class="gras text-<?= ($produit->livrable > 0)?"green":"danger" ?>"><?= money($produit->livrable) ?></small>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-cubes"></i> <small>Non rangée</small>          
                                    <span class="float-right">
                                        <small title="en boutique"><?= money($produit->attente) ?></small>
                                    </span>
                                </li>
                                <li class="list-group-item"></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div> 
            </div>

            <br><br><br>

            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>
        </div>

    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>


</body>

</html>
