
<div class="modal inmodal fade" id="modal-useproduit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Nouvelle sortie de produits</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer la commande</small>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">Les produits de la sortie</h5>
                        </div>
                        <div class="ibox-content"><br>
                            <div class="table-responsive">
                                <table class="table  table-striped">
                                    <tbody class="useproduit">
                                        <!-- rempli en Ajax -->
                                    </tbody>
                                </table>
                            </div>

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
                            <form id="formUseProduit">
                                <div>
                                    <label>Pour quelle tâche <span style="color: red">*</span> </label>
                                    <div class="input-group">
                                        <?php Native\BINDING::html("select-tableau", $chantier->tachesEncours(), null, "tache_id"); ?>
                                    </div>
                                </div><br>
                            
                                <div>
                                    <label>Ajouter une description de la tâche </label>
                                    <textarea class="form-control" rows="4" name="comment"></textarea>
                                </div>

                                <input type="hidden" name="chantier_id" value="<?= getSession("chantier_connecte_id") ?>">
                            </form><br>
                            <hr/>
                            <button onclick="validerUseProduit()" class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> Confirmer la sortie</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


