<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/manager/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/manager/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/manager/elements/templates/header.php")); ?>  

            <div class="animated fadeInRightBig">

                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="text-uppercase">Vos différents coûts de production</h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-stripped table-bordered">
                            <tbody>
                                <?php foreach ($produits as $key => $produit) {
                                    $total = 0;
                                    $exi = $produit->fourni("exigenceproduction")[0]; ?>
                                    <tr>
                                        <td rowspan="5">
                                            <br>
                                            <h3><?= $produit->name() ?></h3>
                                            <span><?= $produit->comment ?></span>
                                        </td>
                                        <td rowspan="5" class="text-center italic">
                                            <br>
                                            <h3>Pour <?= $exi->quantite ?> unités</h3>
                                            <span>il vout faut</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="row">
                                                <?php foreach ($exi->fourni("ligneexigenceproduction") as $key => $ligne) { 
                                                    $ligne->actualise();
                                                    $prix = $ligne->ressource->price() * $ligne->quantite;
                                                    $total += $prix; ?>
                                                    <div class="col-sm-3 border-right"><?= $ligne->ressource->name()  ?> (<?= $ligne->quantite  ?> <?= $ligne->ressource->abbr ?>) :: <i><b><?= money($prix)  ?></b> <?= $params->devise ?></i></div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coût de production = <i><b><?= money($produit->coutProduction("production", $exi->quantite))  ?></b> <?= $params->devise ?></i> --- <i class="text-red"><b><?= money($produit->coutProductionFerie("production", $exi->quantite))  ?></b> <?= $params->devise ?></i></td>

                                        <td rowspan="3" class="text-center italic">
                                            <br>
                                            <h4>1 <?= $produit->name() ?></h4>
                                            <span>vous coûte environ à</span>
                                            <?php $montant = $produit->coutProductionFerie("production", $exi->quantite) + $produit->coutProductionFerie("rangement", $exi->quantite) + $produit->coutProductionFerie("livraison", $exi->quantite) + $total;  ?>
                                            <h3 class="text-green"><?= money($montant / $exi->quantite) ?> <?= $params->devise ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coût de rangement = <i><b><?= money($produit->coutProduction("rangement", $exi->quantite))  ?></b> <?= $params->devise ?></i> --- <i class="text-red"><b><?= money($produit->coutProductionFerie("rangement", $exi->quantite))  ?></b> <?= $params->devise ?></i></td>
                                    </tr>
                                    <tr>
                                        <td>Coût de livraison = <i><b><?= money($produit->coutProduction("livraison", $exi->quantite))  ?></b> <?= $params->devise ?></i> --- <i class="text-red"><b><?= money($produit->coutProductionFerie("livraison", $exi->quantite))  ?></b> <?= $params->devise ?></i></td>
                                    </tr>
                                    <tr height="40px"></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <br><br>
            <?php include($this->rootPath("webapp/manager/elements/templates/footer.php")); ?>


        </div>
    </div>


    <?php include($this->rootPath("webapp/manager/elements/templates/script.php")); ?>



</body>

</html>
