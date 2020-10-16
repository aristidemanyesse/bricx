

<div class="modal inmodal fade" id="modal-location">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire de location d'engins</h4>
                <small>Veuillez renseigner les informations pour valider l'enregistrement</small>
            </div>
            <form method="POST" class="formShamman" classname="location">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Engin à louer </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="engin" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Début de location </label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="started" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Fin de location </label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="finished" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Etat de la location </label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "etat"); ?>
                            </div>
                        </div>
                        <div class="col-sm-4 unmodified">
                            <label>Montant de la location </label>
                            <div class="form-group">
                                <input type="number" number class="form-control" name="montant" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Ajouter une note </label>
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="4"></textarea>
                            </div>
                        </div>
             
                        <div class="col-sm-4">
                            <label>Fournisseur pour la location</label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select-tableau", $chantier->fourni("fournisseurchantier"), null, "fournisseurchantier_id"); ?>
                            </div>
                        </div>
                        <div class="col-sm-4 no_modepayement_facultatif unmodified">
                            <label>Avance pour la location </label>
                            <div class="form-group">
                                <input type="number" class="form-control" name="avance" required>
                            </div>
                        </div>
                        <div class="col-sm-4 unmodified">
                            <label>Mode de payement </label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "modepayement"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row unmodified">
                        <div class="modepayement_facultatif col-sm-4">
                            <label>Structure d'encaissement <span style="color: red">*</span> </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                <input type="text" name="structure" class="form-control">
                            </div>
                        </div><br>
                        <div class="modepayement_facultatif col-sm-4">
                            <label>N° numero dédié <span style="color: red">*</span> </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" name="numero" class="form-control">
                            </div>
                        </div>
                    </div>
                </div><hr>
                <div class="container">
                    <input type="hidden" name="id" >
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-success dim pull-right"><i class="fa fa-money"></i> Valider la location</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
