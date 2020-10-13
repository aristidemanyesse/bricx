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
                    <h2 class="text-uppercase gras">Utilisation de briques</h2>
                    <div class="container">
                    </div>
                </div>
                <div class="col-sm-3 text-right">
                    <button style="margin-top: 5%;" type="button" data-toggle=modal data-target='#modal-useproduit' class="btn btn-primary btn-xs dim"><i class="fa fa-plus"></i> Nouvelle sortie de briques </button>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Toutes les briques sorties sur ce chantier</h5>
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
                                    <th>Chantier</th>
                                    <th>Tâche à effectuer</th>
                                    <th data-hide="all">Briques</th>
                                    <th>Enregistré par</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $use) {
                                    $use->actualise(); 
                                    $use->fourni("ligneuseproduit");
                                    ?>
                                    <tr style="border-bottom: 2px solid black">
                                        <td class="project-status">
                                            <span class="label label-<?= $use->etat->class ?>"><?= $use->etat->name ?></span>
                                        </td>
                                        <td>
                                            <span class="text-uppercase gras">Nouvelle sortie</span><br>
                                        </td>
                                        <td>
                                            <h6 class="text-uppercase text-muted gras" style="margin: 0"><?= $use->chantier->name() ?></h6>
                                        </td>
                                        <td>
                                            <h6 class="text-uppercase text-muted gras" style="margin: 0"><?= $use->tache->name() ?></h6>
                                            <small><?= $use->comment ?></small>
                                        </td>
                                        <td class="border-right">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="no">
                                                        <th></th>
                                                        <?php foreach ($use->ligneuseproduits as $key => $ligne) {
                                                            $ligne->actualise(); ?>
                                                            <th class="text-center" style="padding: 2px">
                                                                <img style="height: 20px" src="<?= $this->stockage("images", "produits", $ligne->produit->image) ?>" >
                                                                <span class="small"><?= $ligne->produit->name() ?></span>
                                                            </th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="no">
                                                        <td><h4 class="mp0">Qté sorties: </h4></td>
                                                        <?php foreach ($use->ligneuseproduits as $key => $ligne) { ?>
                                                            <td class="text-center"><?= start0($ligne->quantite) ?></td>
                                                        <?php   } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td><i class="fa fa-user"></i> <?= $use->employe->name() ?></td>
                                        <td>
                                            <?php if ($employe->isAutoriser("modifier-supprimer") && $use->etat_id != Home\ETAT::ANNULEE) { ?>
                                                <button onclick="annuler('pertechantierproduit', <?= $use->id ?>)" class="btn btn-white btn-sm"><i class="fa fa-trash text-red"></i></button>
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
                        <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune sortie sur cette période</h1>
                    <?php } ?>

                </div>
            </div>
        </div>


        <?php include($this->rootPath("webapp/chantier/elements/templates/footer.php")); ?> 


    </div>
</div>

<?php include($this->rootPath("composants/assets/modals/modal-useproduit.php")); ?>

<?php include($this->rootPath("webapp/chantier/elements/templates/script.php")); ?>


</body>

</html>
