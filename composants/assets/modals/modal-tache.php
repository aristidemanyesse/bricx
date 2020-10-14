

<div class="modal inmodal fade" id="modal-tache">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire des tâches du chantier</h4>
                <small>Veuillez renseigner les informations pour enregistrer la perte</small>
            </div>
            <form method="POST" class="formShamman" classname="tache">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Libéllé de la tache </label>
                            <div class="form-group">
                                <input type="text" number class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Nombre de jours (durée) </label>
                            <div class="form-group">
                                <input type="number" number class="form-control" name="duree" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Etat de la tâche </label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "etatchantier"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Tâche parente </label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select-tableau", $chantier->fourni("tache"), null, "tache_id_parent"); ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Description de la tâche </label>
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div><hr>
                <div class="container">
                    <input type="hidden" name="id" >
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm btn-danger dim pull-right"><i class="fa fa-money"></i> Enregistrer la perte</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
