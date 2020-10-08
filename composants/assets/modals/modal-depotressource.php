
<div class="modal inmodal fade" id="modal-depotressource" style="z-index: 9999999999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Nouvel envoi de briques sur chantier</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer la sortie</small>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">Les ressources à envoyer</h5>
                        </div>
                        <div class="ibox-content"><br>
                            <div class="table-responsive">
                                <table class="table  table-striped">
                                    <tbody class="approvisionnement">
                                        <!-- rempli en Ajax -->
                                    </tbody>
                                </table>
                            </div><hr>

                            <div class=" text-center">
                                <?php foreach (Home\RESSOURCE::isActives() as $key => $item) {
                                    $item->actualise();  ?>
                                    <button class="btn btn-white dim newressource2 text-capitalize" data-id="<?= $item->id ?>"><i class="fa fa-cubes"></i> <?= $item->name(); ?></button>                   
                                <?php  } ?>
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
                                        <?php Native\BINDING::html("select", "chantier"); ?>
                                    </div>
                                </div><br>

                                <div>
                                    <label>Véhicule de la livraison <span style="color: red">*</span> </label>                               
                                    <div class="input-group">
                                        <?php Native\BINDING::html("select", "vehicule"); ?>
                                    </div>
                                </div><br>

                                <div class="chauffeur">
                                    <label>Chauffeur de la livraison <span style="color: red">*</span> </label>                              
                                    <div class="input-group">
                                        <?php Native\BINDING::html("select", "chauffeur"); ?>
                                    </div><br>
                                </div>

                                <div class="tricycle">
                                    <div>
                                        <label>Nom du tricycle<span style="color: red">*</span> </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" name="nom_tricycle" class="form-control" >
                                        </div>
                                    </div><br>
                                    <div>
                                        <label>Contact du tricycle<span style="color: red">*</span> </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span><input type="text" name="contact_tricycle" class="form-control" >
                                        </div>
                                    </div><br>
                                    <div>
                                        <label>Montant à payer au chauffeur tricycle<span style="color: red">*</span> </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span><input type="text" name="paye_tricycle" class="form-control" value="0" min="0" >
                                        </div>
                                    </div>
                                </div><br>

                                <div class="chauffeur">
                                    <label><input class="i-checks cursor" type="checkbox" name="chargement" checked > Chargement par nos manoeuvres</label>
                                    <label><input class="i-checks cursor" type="checkbox" name="dechargement" checked > Déchargement par nos manoeuvres</label>
                                </div><br>

                                <div>
                                    <label>Ajouter une note</label>
                                    <textarea class="form-control" name="comment" rows="4"></textarea>
                                </div>

                                <input type="hidden" name="agence_id" value="<?= $agence->id ?>">
                            </form>
                            <hr/>
                            <button onclick="depotressource()" class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> Valider la sortie</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


