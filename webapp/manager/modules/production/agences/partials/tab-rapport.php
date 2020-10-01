<div role="tabpanel" id="pan-rapport" class="tab-pane">

   <div class="ibox ">
    <div class="ibox-title">
        <h5 class="float-left">Tableau comparatif des productions par rapport aux pertes sur la période</h5>
        <div class="ibox-tools">
            
        </div>
    </div>
    <div class="ibox-content">

        <div class="">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-uppercase text-center" style="font-size: 11px;">
                        <th rowspan="2"></th>
                        <th rowspan="2">Stock au <?= datecourt2(dateAjoute1($date1, -1)) ?></th>
                        <th rowspan="2">Production</th>
                        <th rowspan="2">acheté</th>
                        <th rowspan="2">Livraison</th>
                        <th colspan="4">Perte</th>
                        <th rowspan="2">Stock au <?= datecourt2($date2) ?></th>
                    </tr>
                    <tr class="text-uppercase text-center" style="font-size: 11px;">
                        <th width="15">Livr.</th>
                        <th width="15">Rang.</th>
                        <th width="15">Autre</th>
                        <th width="15">Prct%</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $key => $produit) { ?>
                        <tr>
                            <td>
                                <span class="gras text-uppercase"><?= $produit->name() ?></span> <br>
                                <small><?= $produit->comment ?></small>
                            </td>
                            <td class="text-center"><h4 class="gras"><?= money($produit->veille) ?></h4></td>
                            <td class="text-center"><h3 class="gras text-green"><?= money($produit->production) ?></h3></td>
                            <td class="text-center"><?= money($produit->achat) ?></td>
                            <td class="text-center"><h3 class="gras text-blue"><?= money($produit->livraison) ?></h3></td>
                            <td class="text-center text-red"><?= money($produit->perteLivraison) ?></td>
                            <td class="text-center text-red"><?= money($produit->perteRangement) ?></td>
                            <td class="text-center text-red"><?= money($produit->perteAutre) ?></td>
                            <td class="text-center text-red gras" ><?= ($produit->production > 0)? round( ($produit->perte / ($produit->production) * 100 ), 2):0 ?> %</td>
                            <td class="text-center"><h2 class="gras"><?= money($produit->stock) ?></h2></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="row stat-list text-center">
                <div class="col-sm-6 col-md-3 ">
                    <h3 class="no-margins text-green"><?= money(comptage($productions, "montant_production", "somme")) ?> <small><?= $params->devise ?></small></h3>
                    <small>Coût de production</small>
                </div>
                <div class="col-sm-6 col-md-3 border-left border-right">
                    <h3 class="no-margins gras"><?= money(comptage($productions, "montant_rangement", "somme")) ?> <small><?= $params->devise ?></small></h3>
                    <small>Coût de rangement</small>
                </div>
                <div class="col-sm-6 col-md-3 border-right">
                    <h3 class="no-margins text-blue"><?= money(comptage($productions, "montant_livraison", "somme")) ?> <small><?= $params->devise ?></small></h3>
                    <small>Coût de livraison</small>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h3 class="no-margins text-red"><?= money(Home\TRICYCLE::total($date1, $date2, $agence->id)) ?> <small><?= $params->devise ?></small></h3>
                    <small>Paye des tricycles</small>
                </div>
            </div><hr>
        </div>

        <hr style="border: dashed 1px orangered"> 
    </div>
</div>





<div class="ibox ">
    <div class="ibox-title">
        <h5 class="float-left text-uppercase">Tableau comparatif de la consommation de ressource sur la période</h5>
        <div class="ibox-tools">

        </div>
    </div>
    <div class="ibox-content">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="text-center" >
                    <th colspan="2">Production</th>
                    <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                        <th>
                            <span style="font-size: 11px;" class="text-uppercase"><?= $ressource->name()  ?></span>
                            <br><small><?= $ressource->unite ?></small>
                        </th>
                    <?php }  ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $key => $produit) { ?>
                    <tr>
                        <td><span class="gras text-uppercase"><?= $produit->name() ?></span> <br> <small><?= $produit->comment ?></small></td>
                        <td class="text-center"><h3 class="gras"><?= money($produit->production) ?></h3></td>
                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                            $name = trim($ressource->name()); ?>
                            <td class="text-center"><?= round($produit->$name, 2); ?> <?= $ressource->abbr  ?></td>
                        <?php } ?>
                    </tr>
                <?php }  ?>

                <tr style="height: 12px;"></tr>
                <tr>
                    <td colspan="2"><h5 class="gras text-uppercase mp0">Consommation totale dûe</h5>
                        <small>(Ce qu'ils auraient normalement dû consommé)</small></td>
                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                            $name = trim($ressource->name()); ?>
                            <td class="text-center text-green gras"><?= round(comptage($produits, $name, "somme"), 2); ?> <?= $ressource->abbr  ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td colspan="2"><h5 class="gras text-uppercase mp0">Consommation totale effective</h5>
                            <small>(Consommation qu'ils ont effectivement déclaré)</small>
                        </td>
                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                            <td class="text-center gras"><?= round($ressource->consommee($date1, $date2), 2); ?> <?= $ressource->abbr  ?></td>
                        <?php } ?>
                    </tr>
                    <tr style="height: 12px;"></tr>
                    <tr>
                        <td colspan="2"><h5 class="gras text-uppercase">Comparatif de la Consommation</h5></td>
                        <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                            $name = trim($ressource->name()); 
                            $a = comptage($produits, $name, "somme") - $ressource->consommee($date1, $date2); ?>
                            <td class="text-center text-<?= ($a >= 0)?"green":"red" ?>"> Conso de <b><?= round(abs($a), 2) ?> <?= $ressource->abbr  ?></b> <br>en <?= ($a >= 0)?"moins":"plus" ?></td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
            <small><i>* Selon la ressource, vous devez considerer une certaine marge de consommation sur la periode. (Ex: -/+ 5 sacs de ciments pour 30 jours)</i></small><br>
            <small><i>* Si cette marge est franchie (positivement ou négativement), alors il y a un problème de production.<br> Soit ils n'utilisent pas les quantités néccéssaires pour une bonne qualité de la production, soit ils font du gaspillage de ressource.</i></small>
        </div>
    </div>



    <div class="ibox ">
        <div class="ibox-title">
            <h5 class="float-left text-uppercase">Estimation des pertes en ressource sur la période</h5>
            <div class="ibox-tools">

            </div>
        </div>
        <div class="ibox-content">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center" >
                        <th colspan="2"></th>
                        <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                            <th>
                                <span style="font-size: 11px;" class="text-uppercase"><?= $ressource->name()  ?></span>
                                <br><small><?= $ressource->unite ?></small>
                            </th>
                        <?php }  ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"><h5 class="gras text-uppercase mp0">Estimation en ressource</h5>
                            <small>(Appréciez par vous-même)</small></td>
                            <?php  foreach (Home\RESSOURCE::getAll() as $key => $ressource) { 
                                $name = trim($ressource->name()); ?>
                                <td class="text-center text-red gras"><?= round(comptage($produits, "perte-$name", "somme"), 2); ?> <?= $ressource->abbr  ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

