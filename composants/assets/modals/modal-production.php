
<div class="modal inmodal fade" id="modal-production" style="z-index: 9999999999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">La production du <?= datecourt(dateAjoute())  ?></h4>
                <small class="font-bold">Enregistrez les quantités produites de briques</small>
            </div>
            
            <form id="formProduction" class="formShamman" classname="production">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                <div class="row text-center">
                                    <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                        <div class="col-sm-4 col-md-3" style="margin-bottom: 2%">
                                            <label><b><?= $produit->name() ?></b></label>
                                            <input type="number" value="0" min=0 number class="gras quantite form-control text-center" name="prod-<?= $produit->id ?>">
                                        </div>
                                    <?php } ?>
                                </div><hr>

                                <?php if ($params->productionAuto == Home\TABLE::OUI) { ?>
                                    <div class="ajax">

                                    </div>
                                <?php }else{ ?>
                                    <h3 class="text-uppercase text-center"><u>Consommation des matières premières pour toute la productionr</u></h3><br>
                                    <div class="row">
                                        <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                            <div class="col-md text-center">
                                                <label class=" text-red"><?= $ressource->name() ?> (<?= $ressource->abbr ?>)</label>
                                                <input step="0.01" type="number" value="0" min=0 number class="gras form-control text-center text-red" name="conso-<?= $ressource->getId() ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-4 ">
                                <div class="ibox"  style="background-color: #eee">
                                    <div class="ibox-title" style="padding-right: 2%; padding-left: 3%; ">
                                        <h5 class="text-uppercase">Finaliser la production</h5>
                                    </div>
                                    <div class="ibox-content"  style="background-color: #fafafa">
                                        <div>
                                            <label>Ajouter une note</label>
                                            <textarea class="form-control" name="comment" rows="4"></textarea>
                                        </div>

                                        <input type="hidden" name="agence_id" value="<?= $agence->id ?>">

                                        <hr/>
                                        <button class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> valider la production</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

