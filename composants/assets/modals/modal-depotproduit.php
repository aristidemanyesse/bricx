
<div class="modal inmodal fade" id="modal-depotproduit" style="z-index: 9999999999">
    <div class="modal-dialog modal-xll">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Nouvelle mise en boutique</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer la sortie</small>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">Les produits pour la sortie</h5>
                        </div>
                        <div class="ibox-content"><br>
                            <div class="table-responsive">
                                <table class="table  table-striped">
                                    <tbody class="commande">
                                        <!-- rempli en Ajax -->
                                    </tbody>
                                </table>
                            </div><hr>

                            <div class="text-center">
                                <?php foreach (Home\PRODUIT::isActives() as $key => $produit) { ?>
                                    <button class="btn btn-white dim newproduit btn-sm" data-id="<?= $produit->id ?>" ><?= $produit->name(); ?></button>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="ibox"  style="background-color: #eee">
                        <div class="ibox-title" style="padding-right: 2%; padding-left: 3%; ">
                            <h5 class="text-uppercase">Finaliser la sortie</h5>
                        </div>
                        <div class="ibox-content"  style="background-color: #fafafa">
                            <form id="formMiseenboutique">
                                <div>
                                    <label>Chantier de destination <span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <?php Native\BINDING::html("select", "boutique"); ?>
                                    </div>
                                </div><br>

                                <div>
                                    <label>Nom du livreur <span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" name="nom_livreur" class="form-control">
                                    </div>
                                </div><br>

                                <div>
                                    <label>Contant du livreur <span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" name="contact_livreur" class="form-control">
                                    </div>
                                </div><br>

                                <div>
                                    <label>Ajouter une note</label>
                                    <textarea class="form-control" name="comment" rows="4"></textarea>
                                </div>

                                <input type="hidden" name="agence_id" value="<?= $agence->id ?>">

                            </form>
                            <hr/>
                            <button onclick="depotchantier()" class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> Valider la sortie</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


