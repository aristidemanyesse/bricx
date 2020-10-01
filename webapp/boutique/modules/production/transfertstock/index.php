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
                    <h2 class="text-uppercase text-blue gras">Les conversions de produits</h2>
                    <div class="container">
                    </div>
                </div>
                <div class="col-sm-3 text-right">
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Toutes les conversions de produits survenues dans cette agence</h5>
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
                                    <th>Agence</th>
                                    <th>Client</th>
                                    <th data-hide="all">Produits</th>
                                    <th>Effectué par</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $transfert) {
                                    $transfert->actualise(); 
                                    $transfert->fourni("lignetransfertstock");
                                    ?>
                                    <tr style="border-bottom: 2px solid black">
                                        <td>
                                            <span class="text-uppercase gras">Conversion de briques</span><br>
                                            <small><?= $transfert->reference ?></small>
                                        </td>
                                        <td>
                                            <h6 class="text-uppercase text-muted mp0"> <?= $transfert->agence->name() ?></h6>
                                            <small>effectué <?= depuis($transfert->created) ?></small>
                                        </td>
                                         <td>
                                            <h5 class="text-uppercase"><?= $transfert->groupecommande->client->name() ?></h5>
                                        </td>
                                        <td class="border-right">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="no">
                                                        <th></th>
                                                        <?php foreach ($transfert->lignetransfertstocks as $key => $ligne) { 
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
                                                        <td><h4 class="mp0">Qté avant conversion: </h4></td>
                                                        <?php foreach ($transfert->lignetransfertstocks as $key => $ligne) { ?>
                                                            <td class="text-center"><?= start0($ligne->quantite_avant) ?></td>
                                                        <?php   } ?>
                                                    </tr>
                                                    <tr class="no">
                                                        <td><h4 class="mp0">Qté après conversion: </h4></td>
                                                        <?php foreach ($transfert->lignetransfertstocks as $key => $ligne) { ?>
                                                            <td class="text-center"><?= start0($ligne->quantite_apres) ?></td>
                                                        <?php   } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                         <td>
                                            <h5 class="text-uppercase"><?= $transfert->employe->name() ?></h5>
                                        </td>
                                        <td>
                                            <a href="<?= $this->url("fiches", "master", "bonlivraison", $transfert->id) ?>" target="_blank" class="btn btn-white btn-sm"><i class="fa fa-file-text text-blue"></i></a>
                                            <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                                <button onclick="annulervente(<?= $transfert->id ?>)" class="btn btn-white btn-sm"><i class="fa fa-close text-red"></i></button>
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
                        <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucun conditionnement pour le moment</h1>
                    <?php } ?>

                </div>
            </div>
        </div>


        <?php include($this->rootPath("webapp/boutique/elements/templates/footer.php")); ?> 

    </div>
</div>


<?php include($this->rootPath("webapp/boutique/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->rootPath("webapp/boutique/modules/master/client/script.js") ?>"></script>


</body>

</html>
