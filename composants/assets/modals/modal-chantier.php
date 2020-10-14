<div class="modal inmodal fade" id="modal-chantier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire des chantiers</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer les informations</small>
            </div>
            <form method="POST" class="formShamman" classname="chantier">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <label>Donner un nom au chantier </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Situation géographique </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lieu">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Autorisation N° </label>
                            <div class="form-group">
                                <input type="text" class="form-control" uppercase name="autorisation" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <label>Date de début des travaux </label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="started" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Date de fin estimée </label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="finished" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Budget total prévisionnel </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="previsionnel" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                            <label>Que faut-il y construire</label>
                            <div class="form-group">
                                <textarea class="form-control" rows="2" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Etat actuel du chantier</label>
                            <div class="form-group">
                                <?php Native\BINDING::html("select", "etatchantier") ?>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <label>Nom du client </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="client_name" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Contact </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label>Adresse email </label>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" >
                            </div>
                        </div>
                    </div>

                </div><hr>
                <div class="container">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn dim btn-primary pull-right"><i class="fa fa-refresh"></i> Valider le formulaire</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>