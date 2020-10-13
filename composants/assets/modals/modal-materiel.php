<div class="modal inmodal fade" id="modal-materiel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulaire des materiels</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer les informations</small>
            </div>
            <form method="POST" class="formShamman" classname="materiel">
                <div class="modal-body">

                    <div class="">
                        <label>Donner un nom au materiel <span1>*</span1></label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" required>
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