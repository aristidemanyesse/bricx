$(function(){



    $(".formExigence").submit(function(event) {
        Loader.start();
        var url = "../../webapp/config/modules/master/production/ajax.php";
        var formdata = new FormData($(this)[0]);
        formdata.append('action', "exigence");
        $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
            if (data.status) {
                window.location.reload();
            }else{
                Alerter.error('Erreur !', data.message);
            }
        }, 'json')
        return false;
    });




    $("input.ressource").change(function(){
        var url = "../../webapp/config/modules/master/production/ajax.php";
        var id = $(this).attr("id")
        var name = $(this).attr("name")
        var val = $(this).val()
        $.post(url, {action:"changement", name:name, id:id, val:val}, (data)=>{
            if (data.status) {
                Alerter.success('Reussite !', "Modification prise en compte avec succès !");
            }else{
                Alerter.error('Erreur !', data.message);
            }
        },"json");
    })



    changeProductionAuto = function(table, id){
        var url = "../../webapp/config/modules/master/production/ajax.php";
        $.post(url, {action:"changeProductionAuto"}, (data)=>{
            if (data.status) {
                Alerter.success('Mise à jour !', "Modification effectuée avec succès !");
            }else{
                Alerter.error('Erreur !', data.message);
            }
        },"json");
    }


})