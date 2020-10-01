<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/boutique/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/boutique/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/boutique/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-9">
                <h2 class="text-uppercase gras">Payement des tricycles</h2>
            </div>
            <div class="col-sm-3">

            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Toutes les livraisons</h5>
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
                <div class="ibox-content" style="min-height: 300px">

                   <?php if (count($datas + $encours) > 0) { ?>
                    <table class="footable table table-stripped toggle-arrow-tiny">
                        <thead>
                            <tr>

                                <th data-toggle="true">Status</th>
                                <th>Reference</th>
                                <th>Nom du tricycle</th>
                                <th>Zone de livraison</th>
                                <th>Reste à payer</th>
                                <th data-hide="all"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($encours as $key => $tricycle) {
                            $tricycle->actualise(); 
                            $livraison = $tricycle->livraison;
                            $lots = $livraison->fourni("lignelivraison");
                            ?>
                            <tr style="border-bottom: 2px solid black">
                                <td class="project-status">
                                    <span class="label label-<?= $tricycle->etat->class ?>"><?= $tricycle->etat->name ?></span>
                                </td>
                                <td>
                                    <span class="text-uppercase gras">Livraison N°<?= $livraison->reference ?></span><br>
                                    <small>Effectué <?= depuis($tricycle->created) ?></small>
                                </td>
                                <td>
                                    <h5 class="text-uppercase text-muted gras" style="margin: 0"><?= $tricycle->name() ?></h5>
                                </td>
                                <td>
                                    <h5 class="mp0"><?= $livraison->zonelivraison->name() ?></h5>
                                    <small><?= $livraison->lieu ?></small>
                                </td>
                                <td>
                                    <h4>
                                        <span class="gras text-orange"><?= money($tricycle->resteAPayer()) ?> <?= $params->devise  ?></span>
                                    </h4>
                                </td>
                                <td class="border-right" style="width: 30%">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="no">
                                                <?php foreach ($livraison->lignelivraisons as $key => $ligne) { 
                                                    $ligne->actualise(); ?>
                                                    <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="no">
                                                <?php foreach ($livraison->lignelivraisons as $key => $ligne) { ?>
                                                    <td class="text-center gras <?= ($livraison->etat_id == Home\ETAT::VALIDEE)?'text-primary':'' ?>"><?= $ligne->quantite_livree ?></td>
                                                <?php   } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <a href="<?= $this->url("fiches", "master", "bonlivraison", $tricycle->id) ?>" target="_blank" class="btn  btn-white btn-sm"><i class="fa fa-file-text text-blue"></i></a>
                                    
                                    <button data-toggle="modal" data-target="#modal-paye-tricycle<?= $tricycle->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Payer le tricycle</button>
                                </td>
                            </tr>
                        <?php  } ?>
                        <tr />
                        <?php foreach ($datas as $key => $tricycle) {
                            $tricycle->actualise(); 
                            $livraison = $tricycle->livraison;
                            $lots = $livraison->fourni("lignelivraison");
                            ?>
                            <tr style="border-bottom: 2px solid black">
                                <td class="project-status">
                                    <span class="label label-<?= $tricycle->etat->class ?>"><?= $tricycle->etat->name ?></span>
                                </td>
                                <td>
                                    <span class="text-uppercase gras">Livraison N°<?= $livraison->reference ?></span><br>
                                    <small>Effectué <?= depuis($tricycle->created) ?></small>
                                </td>
                                <td>
                                    <h5 class="text-uppercase text-muted gras" style="margin: 0"><?= $tricycle->name() ?></h5>
                                </td>
                                <td>
                                    <h5 class="mp0"><?= $livraison->zonelivraison->name() ?></h5>
                                    <small><?= $livraison->lieu ?></small>
                                </td>
                                <td>
                                    <h4>
                                        <span class="gras text-orange"><?= money($tricycle->resteAPayer()) ?> <?= $params->devise  ?></span>
                                    </h4>
                                </td>
                                <td class="border-right" style="width: 30%">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="no">
                                                <?php foreach ($livraison->lignelivraisons as $key => $ligne) { 
                                                    $ligne->actualise(); ?>
                                                    <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="no">
                                                <?php foreach ($livraison->lignelivraisons as $key => $ligne) { ?>
                                                    <td class="text-center gras <?= ($livraison->etat_id == Home\ETAT::VALIDEE)?'text-primary':'' ?>"><?= $ligne->quantite_livree ?></td>
                                                <?php   } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <a href="<?= $this->url("fiches", "master", "bonlivraison", $tricycle->id) ?>" target="_blank" class="btn  btn-white btn-sm"><i class="fa fa-file-text text-blue"></i></a>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <ul class="pagination float-right"></ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            <?php }else{ ?>
                <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Pas de payement en attente pour le moment</h1>
            <?php } ?>



        </div>
    </div>
</div>


<?php include($this->rootPath("webapp/boutique/elements/templates/footer.php")); ?>


<?php 
foreach ($encours as $key => $tricycle) {
    include($this->rootPath("composants/assets/modals/modal-paye-tricycle.php"));
} 
?>

</div>
</div>


<?php include($this->rootPath("webapp/boutique/elements/templates/script.php")); ?>


</body>

</html>
