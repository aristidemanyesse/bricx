$(document).ready(function(){

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
        output = list.data('output');
        if (window.JSON) {
            var url = "../../webapp/chantier/modules/master/planning/ajax.php";
            $.post(url, {action:"miseajour", datas:list.nestable('serialize')}, function(data){
                Alerter.success('Succès !', data.message);

                list.nestable('serialize').forEach(function(elem){
                    console.log(elem)
                })

                // create a data tree
                var treeData = anychart.data.tree([data.data], "as-tree");    
                // create a chart
                var chart = anychart.ganttProject();        
                // set the data
                chart.data(treeData);
                // set the container id
                chart.container("container");    
                // initiate drawing the chart
                chart.draw();    
                // fit elements to the width of the timeline
                chart.fitAll();

            }, 'json')
        } else {
            Alerter.error('Erreur !', 'JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    }).on('change', updateOutput);

});