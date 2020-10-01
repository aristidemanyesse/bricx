<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/boutique/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/boutique/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/boutique/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content">
            <div class="animated fadeInRightBig">

                <div class=" border-bottom white-bg dashboard-header">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="<?= $this->stockage("images", "societe", $params->image) ?>" style="height: 140px;" alt=""><br>
                                <h2 class="text-uppercase"><?= $agence->name() ?></h2><br>
                            </div>
                            <ul class="list-group clear-list m-t">
                                <li class="list-group-item fist-item">
                                    Commandes en cours <span class="label label-success float-right"><?= start0(count($groupes__)); ?></span> 
                                </li>
                                <li class="list-group-item">
                                    Livraisons en cours <span class="label label-success float-right"><?= start0(count($livraisons__)); ?></span> 
                                </li>
                                <li class="list-group-item"></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="" style="margin-top: 0%">
                                    <div id="ct-chart" style="height: 250px;"></div>
                                </div>
                                <small>Graphe de comparaison des différents modes de ventes</small>
                            </div><hr>
                            <div class="row stat-list text-center">
                                <div class="col-4 ">
                                    <h3 class="no-margins text-green"><?= money($comptebanque->getIn(dateAjoute(), dateAjoute(1))) ?> <small><?= $params->devise ?></small></h3>
                                    <small>Entrées du jour</small>
                                </div>
                                <div class="col-4 border-left border-right">
                                    <h2 class="no-margins gras"><?= money($comptebanque->solde()) ?> <small><?= $params->devise ?></small></h2>
                                    <small>En caisse actuellement</small>
                                </div>
                                <div class="col-4">
                                    <h3 class="no-margins text-red"><?= money($comptebanque->getOut(dateAjoute(), dateAjoute(1))) ?> <small><?= $params->devise ?></small></h3>
                                    <small>Dépenses du jour</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 border-left">
                            <div class="statistic-box" style="margin-top: 0%">
                               <div class="ibox">
                                <div class="ibox-content">
                                    <h5>Courbe des ventes</h5>
                                    <div id="sparkline2"></div>
                                </div>

                                <div class="ibox-content">
                                    <h5>Dette chez les clients</h5>
                                    <h2 class="no-margins"><?= money(Home\CLIENT::dettes()); ?> <?= $params->devise  ?></h2>
                                </div>

                                <div class="ibox-content">
                                    <h5>En rupture de Stock</h5>
                                    <h2 class="no-margins"><?= start0(count(Home\PRODUIT::rupture($agence->id))) ?> produit(s)</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><hr>

            </div>


        </div>
    </div>
    <br>


</div>
</div>


<?php include($this->rootPath("webapp/boutique/elements/templates/script.php")); ?>




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





var sparklineCharts = function(){

   $("#sparkline2").sparkline([24, 43, 43, 55, 44, 62, 44, 72], {
       type: 'line',
       width: '100%',
       height: '60',
       lineColor: '#1ab394',
       fillColor: "#ffffff"
   });

};

var sparkResize;

$(window).resize(function(e) {
    clearTimeout(sparkResize);
    sparkResize = setTimeout(sparklineCharts, 500);
});

sparklineCharts();

});
</script>





</body>

</html>