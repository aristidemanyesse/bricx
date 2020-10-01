
<div class="modal inmodal fade" id="modal-newlivraison" style="z-index: 99999999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Nouveau bon de livraison</h4>
            <small class="font-bold">Renseigner ces champs pour enregistrer la livraison</small>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5 class="text-uppercase">Les produits de la livraison</h5>
                    </div>
                    <div class="ibox-content"><br>
                        <div class="table-responsive">
                            <table class="table  table-striped">
                                <tbody class="commande">
                                    <?php
                                    $datas = $groupecommande->toutesLesLignes();
                                    foreach ($datas as $key => $lig) {
                                        $reste = $groupecommande->reste($lig->produit_id);
                                        if ($reste > 0) {
                                            $produit = new Home\PRODUIT;
                                            $produit->id = $lig->produit_id;
                                            $produit->actualise(); ?>
                                            <tr class="border-0 border-bottom " id="ligne<?= $produit->id ?>" data-id="<?= $produit->id ?>">
                                                <td><i class="fa fa-close text-red cursor" onclick="supprimeProduit(<?= $produit->id ?>)" style="font-size: 18px;"></i></td>
                                                <td >
                                                    <img style="width: 40px" src="<?= $rooter->stockage("images", "produits", $produit->image) ?>">
                                                </td>
                                                <td class="text-left">
                                                    <h4 class="mp0 text-uppercase"><?= $produit->name() ?></h4>
                                                    <small><?= $produit->comment ?></small>
                                                </td>
                                                <td width="105">
                                                    <label>Qté à livrer</label>
                                                    <input type="number" name="livree" number class="form-control text-center gras" value="<?= $reste ?>" max="<?= $reste ?>">
                                                </td>
                                                <td><br> <h5>/ <?= $reste ?></h5></td>
                                                <td width="100">
                                                    <label>Surplus</label>
                                                    <input type="number" number name="surplus" class="form-control text-center gras text-blue" value="0">
                                                </td>
                                                <td width="130">
                                                    <label>Perte chargement</label>
                                                    <input type="number" number name="perte" class="form-control text-center gras text-danger" value="0">
                                                </td>
                                            </tr>
                                        <?php }   
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 ">
                <div class="ibox"  style="background-color: #eee">
                    <div class="ibox-title" style="padding-right: 2%; padding-left: 3%; ">
                        <h5 class="text-uppercase">Finaliser la livraison</h5>
                    </div>
                    <div class="ibox-content"  style="background-color: #fafafa">
                        <form id="formLivraison">
                            <div>
                                <label>zone de livraison <span style="color: red">*</span> </label>
                                <div class="input-group">
                                    <select class="select2 form-control" name="zonelivraison_id" style="width: 100%">
                                        <?php 
                                        $datas = $groupecommande->commandes;
                                        $datas2 = $dt = [];
                                        foreach ($datas as $key => $value) {
                                            if (!in_array($value->zonelivraison_id, $dt)) {
                                                $dt[] = $value->zonelivraison_id;
                                                $datas2[] = $datas[$key];
                                            }
                                        }
                                        foreach ($datas2 as $key => $commande) {
                                            $commande->actualise(); ?>
                                            <option value="<?= $commande->zonelivraison_id ?>"><?= $commande->zonelivraison->name()  ?></option>
                                        <?php } ?>                                        
                                    </select>
                                </div>
                            </div><br>
                            <div>
                                <label>Lieu de livraison <span style="color: red">*</span> </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span><input type="text" name="lieu" class="form-control" required>
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

                            <input type="hidden" name="client_id" value="<?= $groupecommande->client_id ?>">

                        </form>
                        <hr/>
                        <button onclick="validerLivraison()" class="btn btn-primary btn-block dim"><i class="fa fa-check"></i> Valider la livraison</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>


