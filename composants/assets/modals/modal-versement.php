<div class="modal inmodal fade" id="modal-versement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-green">Nouvel apport financier</h4>
                <small class="font-bold text-green">Renseigner ces champs pour enregistrer les informations</small>
            </div>
            <form method="POST" class="formShamman" classname="versementchantier">
                <div class="modal-body">               
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Montant de l'opération </label>
                            <div class="form-group">
                                <input type="number" number class="form-control" name="montant" required>
                            </div>
                        </div>  
                        <div class="col-sm-4">
                            <label>Mode de versement</label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "modepayement"); ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label>Plus de détails sur l'opération </label>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="comment"></textarea>
                            </div>
                        </div> 
                    </div>

                    <div class=" row">
                        <div class="col-sm-4 modepayement_facultatif">
                            <label>Structure d'encaissement <span style="color: red">*</span> </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bank"></i></span><input type="text" name="structure" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 modepayement_facultatif">
                            <label>N° numero dédié <span style="color: red">*</span> </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span><input type="text" name="numero" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Ajouter une image du reçu</label>
                            <div class="">
                                <img style="width: 80px;" src="" class="img-thumbnail logo">
                                <input class="hide" type="file" name="image">
                                <button type="button" class="btn btn-sm bg-purple pull-right btn_image"><i class="fa fa-image"></i></button>
                            </div>
                        </div>
                    </div>
                </div><hr>
                <div class="container">
                    <input type="hidden" name="id">
                    <button class="btn dim btn-primary btn-xs"><i class="fa fa-refresh"></i> Valider l'opération</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>