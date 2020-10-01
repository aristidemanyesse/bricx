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
                                <a id="onglet-master" href="<?= $this->url("config", "master", "dashboard") ?>" class="onglets btn btn-xs btn-white" style="font-size: 12px; margin-right: 10px;"><i class="fa fa-long-arrow-left"></i> Retour à l'acceuil</a>
                            </div>
                        </nav>
                    </div>

                    <br>
                    <div class="wrapper-content">
                        <div class="animated fadeInRightBig text-center container-fluid">
                            <img src="<?= $this->stockage("images", "societe", "logo.png")  ?>" alt="logo de devaris 21" style="height: 150px;"><br><br><br>
                            <h3><a target="_blank" href="https://www.devaris21.pro">www.devaris21.pro</a></h3>
                            <hr>
                            <h2 class="text-uppercase gras italic">website - logiciel - conseils</h2>

                            <br><br><br>

                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <a href="<?= $this->url("config", "master", "about")  ?>">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-3 text-left">
                                                        <i class="fa fa-map-marker fa-4x text-muted"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h4 class="text-uppercase gras text-orange">Situation géographique</h4>
                                                        <h5 class="no-margins text-muted">Port-bouet, rue de la baltique</h5>
                                                        <h5 class="no-margins text-muted">Abidjan, Côte d'Ivoire</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <a href="<?= $this->url("config", "master", "about")  ?>">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-3 text-left">
                                                        <i class="fa fa-clock-o fa-4x text-muted"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h4 class="text-uppercase gras text-orange">Horaires de travail</h4>
                                                        <h5 class="no-margins text-muted">Lundi au Vendredi de 08h à 19h</h5>
                                                        <h5 class="no-margins text-muted">Samedi de 08h à 12h</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <a href="<?= $this->url("config", "master", "about")  ?>">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-3 text-left">
                                                        <i class="fa fa-phone fa-4x text-muted"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h4 class="text-uppercase gras text-orange">Contacts Téléphoniques</h4>
                                                        <h5 class="no-margins text-muted"><a href="tel:+225 59 57 33 07">+225 59 57 33 07</a></h5>
                                                        <h5 class="no-margins text-muted"><a href="tel:+225 02 28 59 67">+225 02 28 59 67</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3">
                                    <a href="<?= $this->url("config", "master", "about")  ?>">
                                        <div class="ibox">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-3 text-left">
                                                        <i class="fa fa-envelope fa-4x text-muted"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h4 class="text-uppercase gras text-orange">Courrier électronique</h4>
                                                        <h5 class="no-margins text-muted"><a href="mailto:info@devaris21.pro">info@devaris21.pro</a></h5>
                                                        <h5 class="no-margins text-muted"><a href="mailto:sav@devaris21.pro">sav@devaris21.pro</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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