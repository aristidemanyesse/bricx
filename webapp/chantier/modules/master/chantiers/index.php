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
                            <a id="onglet-master" href="<?= $this->url("master", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px;"><i class="fa fa-long-arrow-left"></i> Acceuil</a>
                            <?php if ($employe->agence_id != null && $employe->isAutoriser("boutique")) { ?>
                                <a id="onglet-boutique" href="<?= $this->url("boutique", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px;"><i class="fa fa-bank"></i> Boutique</a>
                            <?php } ?>
                            <?php if ($employe->agence_id != null && $employe->isAutoriser("entrepot")) { ?>
                                <a id="onglet-entrepot" href="<?= $this->url("entrepot", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px;"><i class="fa fa-cubes"></i> Entrepôt</a>
                            <?php } ?>
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

                    <div class="text-right">
                        <button data-toggle="modal" data-target="#modal-chantier" class="btn btn-primary btn-sm dim"><i class="fa fa-home"></i> Ajouter Nouveau chantier</button>
                    </div><br>

                    <div class="row">

                        <?php foreach ($chantiers as $key => $chantier) { ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="ibox">
                                    <div class="ibox-content product-box">
                                        <div class="product-imitation">
                                            [ image chantier ]
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
