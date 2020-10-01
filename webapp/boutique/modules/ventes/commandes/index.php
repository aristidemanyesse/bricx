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
                <a class="pull-right btn btn-white btn-sm" style="margin-top: 5%" href="<?= $this->url("boutique", "ventes", "commandes1")  ?>"><i class="fa fa-list"></i> Affichage en tableau</a>
            </div>

        </div>

        <div class="wrapper wrapper-content">
           <div class="row">
            <?php foreach ($encours as $key => $commande) {
                $commande->actualise();
                $datas = $commande->fourni("commande");
                $datas1 = $commande->fourni("livraison", ["etat_id > "=>Home\ETAT::ANNULEE, "etat_id < "=>Home\ETAT::VALIDEE]);
                $client = $commande->client;
                $com = end($datas); ?>
                <div class="col-md-4 col-sm-6">
                    <div class="social-feed-box">
                        <div class="float-right social-action dropdown">
                            <button data-toggle="dropdown" onclick="session('commande-encours', <?= $commande->id ?>)" class="dropdown-toggle btn-white cursor">Options</button>
                            <ul class="dropdown-menu">
                                <li class="text-orange" onclick="newlivraison(<?= $commande->id  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-truck"></i> Faire une livraison</a></li>
                                <li class="text-green" onclick="fairenewcommande(<?= $commande->id ?>)"><a style="padding: 3px" href="#"><i class="fa fa-plus"></i> Lui ajouter commande</a></li>
                                <li class="" onclick="changement(<?= $commande->id ?>)"><a style="padding: 3px" href="#"><i class="fa fa-history"></i> convertir les produits</a></li>
                                <li class="border"></li>
                                <li class="text-green" onclick="fichecommande(<?= $commande->id  ?>)"><a style="padding: 3px" href="#"><i class="fa fa-eye"></i> Voir les détails</a></li>
                            </ul>
                        </div>
                        <div class="social-avatar">
                            <a href="" class="float-left">
                                <img alt="image" src="<?= $this->stockage("images", "societe", $params->image)  ?>">
                            </a>
                            <div class="media-body">
                                <a class="text-capitalize text-dark gras" href="<?= $this->url("boutique", "master", "client", $commande->client_id)  ?>"><?= $commande->client->name() ?> (<?= count($datas) ?>)</a>
                                <small class="text-muted">Livraison prévue pour le <?= datecourt($com->datelivraison) ?></small><br>
                            </div>
                        </div>
                        <div class="social-footer">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <?php foreach ($produits as $key => $produit){ 
                                         $reste = $commande->reste($produit->id);
                                         if ($reste > 0) { ?>
                                            <th class="text-center small gras"><?= $produit->name() ?></th>
                                        <?php }
                                    } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($produits as $key => $produit) {
                                        $reste = $commande->reste($produit->id);
                                        if ($reste > 0) { ?>
                                            <td class="text-center "><?= start0($reste) ?></td>
                                        <?php   } 
                                    } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
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
    foreach ($groupe->fourni("commande") as $key => $commande) {
        include($this->rootPath("composants/assets/modals/modal-reglercommande.php"));
    }
} 
?>

</body>

</html>
