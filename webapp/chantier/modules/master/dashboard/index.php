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
                        <h5 class="mp0"><?= $chantier->comment ?></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="flot-chart dashboard-chart">
                            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                        </div>
                        <div class="text-center">
                            <h3><b><?= datecourt($chantier->started) ?></b> --- <b><?= datecourt($chantier->finished) ?></b></h3>
                            <h5>En avance de 5 jours sur les travaux</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="float-right">
                                    09:00 pm
                                </span>
                                <span class="label label-success">1</span> Please contact me
                            </li>
                            <li class="list-group-item">
                                <span class="float-right">
                                    10:16 am
                                </span>
                                <span class="label label-info">2</span> Sign a contract
                            </li>
                            <li class="list-group-item">
                                <span class="float-right">
                                    08:22 pm
                                </span>
                                <span class="label label-primary">3</span> Open new shop
                            </li>
                            <li class="list-group-item">
                                <span class="float-right">
                                    11:06 pm
                                </span>
                                <span class="label label-default">4</span> Call back to Sylvia
                            </li>
                            <li class="list-group-item">
                                <span class="float-right">
                                    12:00 am
                                </span>
                                <span class="label label-primary">5</span> Write a letter to Sandra
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>


</body>

</html>
