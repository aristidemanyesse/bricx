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
                <h5 class="text-uppercase">Stock de briques</h5>
                
            </div>
            <div class="ibox-content">
                <div class="row text-center">
                    <?php $total = 0; foreach ($ressources as $key => $ressource) {
                        $stock = $ressource->stockChantier(Home\PARAMS::DATE_DEFAULT, dateAjoute(1), $chantier->id);
                        $prix = $stock;
                        $total += $prix ?>
                        <div class="col-sm-4 col-md-3 border-left border-bottom">
                            <div class="p-xs">
                                <i class="fa fa-cube fa-2x text-dark"></i>
                                <h5 class="m-xs gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= round($stock, 2) ?> <?= $ressource->unite  ?></h5>
                                <h6 class="no-margins text-uppercase gras <?= ($stock > $params->ruptureStock)?"":"clignote" ?>"><?= $ressource->name() ?> </h6>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>


        <div class="wrapper wrapper-content">
            <div class=" animated fadeInRightBig">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="float-left text-uppercase">Historiques du <?= datecourt($date1) ?> au <?= datecourt($date2) ?></h5>
                        <div class="ibox-tools">
                            <form id="formFiltrer" method="POST">
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-5">
                                        <input type="date" value="<?= $date1 ?>" class="form-control input-sm" name="date1">
                                    </div>
                                    <div class="col-5">
                                        <input type="date" value="<?= $date2 ?>" class="form-control input-sm" name="date2">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" onclick="filtrer()" class="btn btn-sm btn-white"><i class="fa fa-search"></i> Filtrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="border-none"></th>
                                    <?php foreach ($ressources as $key => $ressource) {  ?>
                                        <th class="text-center"><small class="gras"><?= $ressource->name() ?></small></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $index = $date1;
                                while ($index <= $date2) { ?>
                                    <tr>
                                        <td class="gras "><?= datecourt($index) ?></td>
                                        <?php foreach ($ressources as $key => $ressource) {
                                            $stock = $ressource->stockChantier(Home\PARAMS::DATE_DEFAULT, $index, $chantier->id);
                                            $achat = $ressource->achat($index, $index, $chantier->id);
                                            $depot = $ressource->depot($index, $index, $chantier->id);
                                            $conso = $ressource->consommeeChantier($index, $index, $chantier->id);
                                            $perte = $ressource->perte($index, $index, $chantier->id);
                                            ?>
                                            <td class="cursor myPopover text-center"
                                            data-toggle="popover"
                                            data-placement="left"
                                            title="<small><b><?= $ressource->name() ?></b> | <?= datecourt($index) ?></small>"
                                            data-trigger="hover"
                                            data-html="true"
                                            data-content="
                                            <span>quantité achetée : <b><?= round($achat, 2) ?> </b></span><br>
                                            <span>quantité déposée : <b><?= round($depot, 2) ?> </b></span><br>
                                            <span>quantité utilisée : <b><?= round($conso, 2) ?> </b></span><br>
                                            <span class='text-red'>Perte du jour: <b><?= round($perte, 2) ?> </b></span>
                                            <hr style='margin:1.5%'>
                                            <span>En stock à ce jour : <b><?= round($stock, 2) ?> </b></span><br> <span>">
                                                <?= round($stock, 2) ?> 
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $index = dateAjoute1($index, 1);
                                }
                                ?>
                                <tr style="height: 18px;"></tr>
                            </tbody>
                        </table> 
                    </div>

                </div>
            </div>


            <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>


        </div>


        <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?>
        
    </div>


    <?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>

</div>

</body>

</html>
