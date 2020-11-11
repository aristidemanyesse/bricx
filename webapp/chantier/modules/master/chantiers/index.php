<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="top-navigation">

    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg">

            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

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

                        <div>
                            <a id="onglet-master" href="<?= $this->url("master", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px;"><i class="fa fa-home"></i> Retour</a>

                            <a id="onglet-master" href="<?= $this->url("chantier", "master", "chantiers") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px;"><i class="fa fa-long-arrow-left"></i> Retour aux chantiers</a>

                            <?php if ($employe->isAutoriser("manager")) { ?>
                                <a id="onglet-manager" href="<?= $this->url("manager", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px;"><i class="fa fa-gears"></i> Manager</a>
                            <?php } ?>
                        </div>
                        
                        <ul class="nav">
                            <li></li>                            
                        </ul> 
                    </div>
                </nav>
            </div>



            <div class="wrapper wrapper-content">
                <div class="text-center animated fadeInRightBig">
                    <div class="row">

                        <?php foreach ($chantiers as $key => $item) {
                            $item->actualise();
                            $chantier = $item->chantier;
                            $images = $chantier->fourni("imagechantier", [], [], ["created"=>"DESC"], 3); ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="ibox">
                                    <div class="ibox-content product-box">
                                        <div class="">
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
                                                            <img class="d-block w-100 img-thumbnail" style="height: 200px" src="<?= $this->stockage("images", "imageschantiers", $image->image) ?>" alt="<?= $image->name() ?>">
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
                                            </div>
                                        </div>
                                        <div class="product-desc">
                                            <small class="text-muted">Autorisation N°<?= $chantier->autorisation ?></small>
                                            <h3><?= $chantier->name() ?></h3>
                                            <div class="small m-t-xs"><?= $chantier->lieu ?></div>
                                            <div class="m-t text-righ">

                                                <a href="<?= $this->url("chantier", "master", "dashboard", $chantier->id) ?>" class="btn btn-xs btn-outline btn-primary">Aller au chantier <i class="fa fa-long-arrow-right"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
            </div>


            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>

    <?php include($this->rootPath("composants/assets/modals/modal-chantier.php")); ?>  

</body>

</html>
