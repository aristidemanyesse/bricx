<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/chantier/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/chantier/elements/templates/header.php")); ?>  

            <div class="ibox">
                <div class="ibox-title">
                    <h5 class="text-uppercase">Matériels engagés sur le chantier</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php foreach ($mats as $key => $mat) {
                            $mat->actualise();
                            $materiel = $mat->materiel;
                            $stock = $materiel->stock(Home\PARAMS::DATE_DEFAULT, dateAjoute(1), $chantier->id); ?>
                            <div class="col-lg-3">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <h5 class=""><?= $materiel->name() ?></h5>
                                        <h2 class="text-navy"><?= $stock ?></h2>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>

            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>

        </div>


        <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>

    </div>

</body>

</html>
