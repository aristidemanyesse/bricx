<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/chantier/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/chantier/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/chantier/elements/templates/header.php")); ?>  

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-9">
                    <h2 class="text-uppercase text-success gras">Location d'engins pour le chantier</h2>
                    <div class="container">
                    </div>
                </div>
                <div class="col-sm-3 text-right">
                    <button style="margin-top: 5%;" type="button" data-toggle=modal data-target='#modal-location' class="btn btn-success btn-sm dim"><i class="fa fa-trash"></i> Nouvelle location </button>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Toutes les pertes survenues dans cette agence</h5>
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
                    <?php if (count($datas) > 0) { ?>
                        <table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                                <tr>
                                    <th data-toggle="true">Status</th>
                                    <th>Reference</th>
                                    <th>Engin</th>
                                    <th>Période</th>
                                    <th>Montant</th>
                                    <th>Reste à payer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($encours as $key => $location) {
                                    include($this->rootPath("composants/assets/modals/modal-reglerLocation.php"));
                                    $location->actualise(); 
                                    ?>
                                    <tr style="border-bottom: 2px solid black">
                                        <td class="project-status">
                                            <span class="label label-<?= $location->etat->class ?>"><?= $location->etat->name ?></span>
                                        </td>
                                        <td>
                                            <span class="text-uppercase gras"><?= $location->reference ?></span><br>
                                            <small><?= datelong($location->started) ?></small>
                                        </td>
                                        <td>
                                            <b><?= $location->engin ?></b>
                                        </td>
                                        <td><?= datecourt($location->started) ?> au <?= datecourt($location->finished) ?></td>
                                        <td><?= money($location->montant) ?> <?= $params->devise ?></td>
                                        <td><?= money($location->reste()) ?> <?= $params->devise ?></td>
                                        <td>
                                            <a href="<?= $this->url("fiches", "master", "bonlocationvisionnement", $location->id) ?>" target="_blank" class="btn btn-white btn-sm"><i class="fa fa-file-text text-blue"></i></a>
                                            <?php if ($location->etat_id == Home\ETAT::ENCOURS) { ?>
                                                <button onclick="terminer(<?= $location->id ?>)" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> </button>
                                            <?php } ?>
                                            <?php if ($location->reste() > 0) { ?>
                                                <button data-toggle="modal" data-target="#modal-reglerLocation<?= $location->id  ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Payer</button>
                                            <?php } ?>
                                            <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                                <button data-toggle="modal" data-target="#modal-location" onclick="modification('location', <?= $location->id ?>)" class="btn btn-white btn-sm"><i class="fa fa-pencil text-blue"></i></button>
                                                <button onclick="annuler('location', <?= $location->id ?>)" class="btn btn-white btn-sm"><i class="fa fa-trash text-red"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php  } ?>

                                <tr />
                                <?php foreach ($datas as $key => $location) {
                                    include($this->rootPath("composants/assets/modals/modal-reglerLocation.php"));
                                    $location->actualise(); 
                                    ?>
                                    <tr style="border-bottom: 2px solid black">
                                        <td class="project-status">
                                            <span class="label label-<?= $location->etat->class ?>"><?= $location->etat->name ?></span>
                                        </td>
                                        <td>
                                            <span class="text-uppercase gras"><?= $location->reference ?></span><br>
                                            <small><?= datelong($location->started) ?></small>
                                        </td>
                                        <td>
                                            <b><?= $location->engin ?></b>
                                        </td>
                                        <td><?= datecourt($location->started) ?> au <?= datecourt($location->finished) ?></td>
                                        <td><?= money($location->montant) ?> <?= $params->devise ?></td>
                                        <td><?= money($location->reste()) ?> <?= $params->devise ?></td>
                                        <td>
                                            <?php if ($location->reste() > 0) { ?>
                                                <button data-toggle="modal" data-target="#modal-reglerLocation<?= $location->id  ?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-check"></i> Payer</button>
                                            <?php } ?>
                                            <?php if ($employe->isAutoriser("modifier-supprimer") && $location->etat_id != Home\ETAT::ANNULEE) { ?>
                                                <button onclick="modification('location', <?= $location->id ?>)" class="btn btn-white btn-sm"><i class="fa fa-pencil text-blue"></i></button>
                                                <button onclick="annuler('location', <?= $location->id ?>)" class="btn btn-white btn-sm"><i class="fa fa-trash text-red"></i></button>
                                            <?php } ?>
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
                        <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune perte sur cette période</h1>
                    <?php } ?>

                </div>
            </div>
        </div>


        <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?> 


    </div>
</div>

<?php include($this->rootPath("composants/assets/modals/modal-location.php")); ?>

<?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>


</body>

</html>
