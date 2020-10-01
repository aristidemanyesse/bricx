<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/entrepot/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/entrepot/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/entrepot/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content">
            <div class="animated fadeInRightBig">

                <div class="border-bottom white-bg dashboard-header" style="border-top: dashed 3px #ddd">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="<?= $this->stockage("images", "societe", $params->image) ?>" style="height: 70px;" alt=""> 
                                <h3 class="text-uppercase mp0 text-warning"><?= $params->societe ?></h3>                            
                            </div>                      


                            <ul class="list-group clear-list m-t">
                                <li class="list-group-item fist-item cursor" data-toggle="modal" data-target="#modal-listecommande">
                                    Commandes passées aujourd'hui <span class="text-success float-right"><?= start0(count($commandes)); ?></span> 
                                </li>
                                <li class="list-group-item cursor" data-toggle="modal" data-target="#modal-listelivraisons">
                                    Livraisons du jour <span class=" text-success float-right"><?= start0(count($livraisons)); ?> </span>
                                </li>
                                <li class="list-group-item"></li><br>

                            </ul>
                        </div>
                        <div class="col-md-6 border-right border-left text-center">
                            <div class="" style="margin-top: 0%">
                                <div id="ct-chart" style="height: 270px;"></div>
                            </div>
                            <small class="text-uppercase">Courbe représentative du stock de produits en fonction des commandes actuelles</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <h3 class="text-uppercase">Stock des ressources</h3>
                            <ul class="list-group  text-left clear-list m-t">
                                <?php foreach (Home\RESSOURCE::getAll() as $key => $ressource) { ?>
                                    <li class="list-group-item">
                                        <i class="fa fa-truck"></i>&nbsp;&nbsp;&nbsp; <?= $ressource->name() ?>
                                        <span class="float-right">
                                            <span class="text-blue gras"><?= round($ressource->stock(Home\PARAMS::DATE_DEFAULT, dateAjoute(+1), $agence->id), 2) ?> <?= $ressource->abbr ?></span>
                                        </span>
                                    </li>
                                <?php } ?>
                                <li class="list-group-item"></li><br>

                            </ul>

                        </div>
                    </div>   
                    <hr style="border-top: dashed 3px #ddd"><br>
                    <div class="row">
                        <?php foreach ($tableau as $key => $produit) { ?>
                            <div class="col-sm-6 col-md-3 col-lg-2 border-right " style="margin-bottom: 3%; border-bottom: 2px solid black">
                                <h6 class="text-uppercase text-center"><img class="border" src="<?= $this->stockage("images", "produits", $produit->image) ?>" style="height: 20px;"> Stock de <u class="gras"><?= $produit->name ?></u></h6>
                                <ul class="list-group clear-list m-t">
                                    <li class="list-group-item">
                                        <i class="fa fa-cubes"></i> <small>Livrable</small>          
                                        <span class="float-right">
                                            <small title="en boutique" class="gras text-<?= ($produit->livrable > 0)?"green":"danger" ?>"><?= money($produit->livrable) ?></small>
                                        </span>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-cubes"></i> <small>Non rangée</small>          
                                        <span class="float-right">
                                            <small title="en boutique"><?= money($produit->attente) ?></small>
                                        </span>
                                    </li>
                                    <li class="list-group-item"></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div> 
                </div>

            </div>
        </div>
        <br>

        <?php include($this->rootPath("webapp/entrepot/elements/templates/footer.php")); ?>

    </div>
</div>


<?php include($this->rootPath("webapp/entrepot/elements/templates/script.php")); ?>

<script type="text/javascript" src="<?= $this->relativePath("../../production/programmes/script.js") ?>"></script>

<script>
    $(document).ready(function() {

        var id = "<?= $this->id;  ?>";
        if (id == 1) {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Content de vous revoir de nouveau!', 'Bonjour <?= $employe->name(); ?>');
            }, 1300);
        }


 // Stocked horizontal bar

 new Chartist.Bar('#ct-chart', {
    labels: [<?php foreach ($tableau as $key => $data){ ?>"<?= $data->name ?>", " ", " ",<?php } ?>],
    series: [
    [<?php foreach ($tableau as $key => $data){ ?><?= $data->attente ?>, 0, 0,<?php } ?>],
    [<?php foreach ($tableau as $key => $data){ ?><?= $data->livrable ?> , 0, 0,<?php } ?>],
    [<?php foreach ($tableau as $key => $data){ ?>0, <?= $data->commande ?>, 0,<?php } ?>],
    ]
}, {
 stackBars: true,
 axisX: {
    labelInterpolationFnc: function(value) {
        if (value >= 1000) {
            return (value / 1000) + 'k';            
        }
        return value;
    }
},
reverseData:true,
seriesBarDistance: 10,
horizontalBars: true,
axisY: {
    offset: 80
}
});



 var ctx3 = document.getElementById("polarChart").getContext("2d");
 new Chart(ctx3, {type: 'polarArea', data: polarData, options:polarOptions});

 var doughnutData = {
    labels: ["App","Software","Laptop" ],
    datasets: [{
        data: [300,50,100],
        backgroundColor: ["#a3e1d4","#dedede","#b5b8cf"]
    }]
} ;


var doughnutOptions = {
    responsive: true
};


});
</script>


</body>

</html>