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
                <h2 class="text-uppercase text-green gras">Les commandes en cours</h2>
            </div>
            <div class="col-sm-3">
                <a class="pull-right btn btn-white btn-sm" style="margin-top: 5%" href="<?= $this->url("boutique", "ventes", "commandes")  ?>"><i class="fa fa-table"></i> Affichage par bloc</a>
            </div>

        </div>

        <div class="wrapper wrapper-content">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Toutes les commandes</h5>
                </div>
                <div class="ibox-content">
                    <?php if (count($groupes + $encours) > 0) { ?>
                        <table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                                <tr>
                                    <th data-toggle="true">Status</th>
                                    <th>Reference</th>
                                    <th>Agence</th>
                                    <th>Reste à payer</th>
                                    <th>Client</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($encours as $key => $groupe) {
                                    $groupe->actualise(); 
                                    $datas = $groupe->fourni("commande", ["etat_id != "=>Home\ETAT::ANNULEE]);
                                    $datas1 = $groupe->fourni("livraison", ["etat_id > "=>Home\ETAT::ANNULEE, "etat_id < "=>Home\ETAT::VALIDEE]);
                                    ?>
                                    <tr style="border-bottom: 2px solid black">
                                        <td class="project-status">
                                            <span class="label label-<?= $groupe->etat->class ?>"><?= $groupe->etat->name() ?></span>
                                        </td>
                                        <td>
                                            <span class="text-uppercase gras">Commande (<?= count($groupe->fourni("commande")) ?>)</span><br>
                                            <span><?= depuis($groupe->created) ?></span>
                                            <?php if (count($datas1) > 0) { ?>
                                                <p class="text-blue">(<?= count($datas1) ?>) livraison(s) en cours pour cette commande</p>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <h5 class="text-uppercase"><?= $groupe->agence->name() ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="gras text-orange"><?= money($groupe->resteAPayer()) ?> <?= $params->devise  ?></h3>
                                        </td>
                                        <td>
                                            <h5 class="text-uppercase"><a href="<?= $this->url("boutique", "master", "client", $groupe->client_id)  ?>"><?= $groupe->client->name() ?></a></h5>
                                        </td>
                                        <td>
                                            <div class="social-action dropdown">
                                                <button data-toggle="dropdown" onclick="session('commande-encours', <?= $groupe->id ?>)" class="dropdown-toggle btn-white cursor">Options</button>
                                                <ul class="dropdown-menu">
                                                    <li class="text-orange" onclick="newlivraison(<?= $groupe->id  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-truck"></i> Faire une livraison</a></li>
                                                    <li class="text-dark" onclick="fairenewcommande(<?= $groupe->id ?>)"><a style="padding: 3px" href="#"><i class="fa fa-plus"></i> Lui ajouter commande</a></li>
                                                    <li class="" onclick="changement(<?= $groupe->id ?>)"><a style="padding: 3px" href="#"><i class="fa fa-history"></i> convertir les produits</a></li>
                                                    <li class="border"></li>
                                                    <li class="text-dark" onclick="fichecommande(<?= $groupe->id  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-eye"></i> Voir les détails</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php  } ?>

                                <tr />

                                <?php foreach ($groupes as $key => $groupe) {
                                    $groupe->actualise(); 
                                    $datas = $groupe->fourni("commande", ["etat_id != "=>Home\ETAT::ANNULEE]);
                                    $datas1 = $groupe->fourni("livraison", ["etat_id > "=>Home\ETAT::ANNULEE, "etat_id < "=>Home\ETAT::VALIDEE]);
                                    ?>
                                    <tr style="border-bottom: 2px solid black">
                                        <td class="project-status">
                                            <span class="label label-<?= $groupe->etat->class ?>"><?= $groupe->etat->name() ?></span>
                                        </td>
                                        <td>
                                            <span class="text-uppercase gras">Commande (<?= count($groupe->fourni("commande")) ?>)</span><br>
                                            <span><?= depuis($groupe->created) ?></span>
                                            <?php if (count($datas1) > 0) { ?>
                                                <p class="text-blue">(<?= count($datas1) ?>) livraison(s) en cours pour cette commande</p>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <h5 class="text-uppercase"><?= $groupe->agence->name() ?></h5>
                                        </td>
                                        <td>
                                            <h3 class="gras text-orange"><?= money($groupe->resteAPayer()) ?> <?= $params->devise  ?></h3>
                                        </td>
                                        <td>
                                            <h5 class="text-uppercase"><a href="<?= $this->url("boutique", "master", "client", $groupe->client_id)  ?>"><?= $groupe->client->name() ?></a></h5>
                                        </td>
                                        <td>
                                            <div class="social-action dropdown">
                                                <button data-toggle="dropdown" onclick="session('commande-encours', <?= $groupe->id ?>)" class="dropdown-toggle btn-white cursor">Options</button>
                                                <ul class="dropdown-menu">
                                                    <li class="text-dark" onclick="fairenewcommande(<?= $groupe->id ?>)"><a style="padding: 3px" href="#"><i class="fa fa-plus"></i> Lui ajouter commande</a></li>
                                                    <li class="border"></li>
                                                    <li class="text-dark" onclick="fichecommande(<?= $groupe->id  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-eye"></i> Voir les détails</a></li>
                                                </ul>
                                            </div>
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
                        <h1 style="margin-top: 30% auto;" class="text-center text-muted aucun"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune commande en cours pour le moment !</h1>
                    <?php } ?>

                </div>
            </div>
        </div>


        <?php include($this->rootPath("webapp/boutique/elements/templates/footer.php")); ?> 

    </div>
</div>



<?php include($this->rootPath("composants/assets/modals/modal-clients.php")); ?> 
<?php include($this->rootPath("composants/assets/modals/modal-client.php")); ?> 


<?php include($this->rootPath("webapp/boutique/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


<?php 
foreach ($encours as $key => $groupe) {
    foreach ($groupe->fourni("commande") as $key => $groupe) {
        include($this->rootPath("composants/assets/modals/modal-reglercommande.php"));
    }
} 
?>

</body>

</html>
