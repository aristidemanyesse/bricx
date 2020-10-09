
<div class="modal inmodal fade" id="modal-depotproduit-<?= $depot->id ?>" style="z-index: 1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox-content">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <div class="text-center">
                        <h1 class="title text-uppercase gras text-green">Validation de l'envoi de briques </h1>
                        <small>Veuillez renseigner la quantité de chaque type de produit que vous avez reçu !</small>
                    </div><hr>

                    <form id="formValiderDepotProduit" classname="depotproduit">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table  table-striped">
                                    <tbody class="">
                                        <?php foreach ($depot->lignedepotproduits as $key => $ligne) { ?>
                                            <tr class="border-0 border-bottom ">
                                                <td class="text-left">
                                                    <h4 class="mp0 text-uppercase"><?= $ligne->produit->name() ?></h4>
                                                </td>
                                                <td><?= $ligne->quantite_depart ?></td>
                                                <td width="130" class="text-center">
                                                    <img style="height: 20px" src="<?= $this->stockage("images", "produits", $ligne->produit->image) ?>"><br>
                                                    <small> <?= $ligne->quantite_depart ?></small>
                                                    <input type="text" data-id="<?= $ligne->id ?>" number class="form-control text-center gras text-green recu" value="<?= $ligne->quantite_depart ?>" max="<?= $ligne->quantite_depart ?>">
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4"  style="background-color: #eee">
                                <div class="ibox">
                                    <br>
                                    <div class="">
                                        <label>Ajouter une note</label>
                                        <textarea class="form-control" name="comment" value="<?= $depot->comment ?>" rows="4"></textarea>
                                    </div><br><br>

                                    <div class="text-center">
                                        <button class="btn dim btn-primary btn-block" ><i class="fa fa-check"></i> Valider la reception</button>
                                    </div><br>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
