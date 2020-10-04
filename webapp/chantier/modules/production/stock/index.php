<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/boutique/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/boutique/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/boutique/elements/templates/header.php")); ?>  

          <div class="ibox">
            <div class="ibox-title">
                <h5 class="text-uppercase">Stock de briques</h5>
                
            </div>
            <div class="ibox-content">
                <div class="row text-center">
                    <?php $total = 0; foreach ($produits as $key => $produit) {
                        $stock = $produit->enAgence(Home\PARAMS::DATE_DEFAULT, dateAjoute(1), $agence->id);
                        $prix = $stock;
                        $total += $prix ?>
                        <div class="col-sm-4 col-md-3 border-left border-bottom">
                            <div class="p-xs">
                                <i class="fa fa-cube fa-2x text-dark"></i>
                                <h5 class="m-xs gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= round($stock, 2) ?> unités</h5>
                                <h6 class="no-margins text-uppercase gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= $produit->name() ?> </h6>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>


        <?php include($this->rootPath("webapp/boutique/elements/templates/footer.php")); ?>
        
    </div>


    <?php include($this->rootPath("webapp/boutique/elements/templates/script.php")); ?>

</div>

</body>

</html>
