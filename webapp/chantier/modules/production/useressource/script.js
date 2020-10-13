$(function(){

    //nouvel useressource
    $(".newressource").click(function(event) {
        var url = "../../webapp/chantier/modules/production/useressource/ajax.php";
        var id = $(this).attr("data-id");
        $.post(url, {action:"newressource", id:id}, (data)=>{
            $("tbody.useressource").append(data);
            $("button[data-id ="+id+"]").hide(200);
        },"html");
    });


    supprimeRessource = function(id){
        var url = "../../webapp/chantier/modules/production/useressource/ajax.php";
        $.post(url, {action:"supprimeRessource", id:id}, (data)=>{
            $("tbody.useressource tr#ligne"+id).hide(400).remove();
            $("button[data-id ="+id+"]").show(200);
        },"html");
    }



    validerUseRessource = function(){
        var formdata = new FormData($("#formUseRessource")[0]);
        var tableau = new Array();
        $("#modal-useressource .useressource tr").each(function(index, el) {
            var id = $(this).attr('data-id');
            var qte = $(this).find('input[name=quantite]').val();
            var item = id+"-"+qte;
            tableau.push(item);
        });
        formdata.append('tableau', tableau);

        alerty.confirm("Voulez-vous vraiment confirmer cette utilisation ?", {
            title: "Validation de l'utilisation",
            cancelLabel : "Non",
            okLabel : "OUI, confirmer",
        }, function(){
            Loader.start();
            var url = "../../webapp/chantier/modules/production/useressource/ajax.php";
            formdata.append('action', "validerUseRessource");
            $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
                if (data.status) {
                    window.open(data.url, "_blank");
                    window.location.reload();
                }else{
                    Alerter.error('Erreur !', data.message);
                }
            }, 'json')
        })
    }



    $(".formUseRessource").submit(function(event) {
        Loader.start();
        var url = "../../webapp/chantier/modules/production/useressource/ajax.php";
        var formdata = new FormData($(this)[0]);
        var tableau = new Array();
        $(this).find("table tr").each(function(index, el) {
            var id = $(this).attr('data-id');
            var val = $(this).find('input').val();
            var item = id+"-"+val;
            tableau.push(item);
        });
        formdata.append('tableau', tableau);
        formdata.append('action', "validerAppro");
        $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
            if (data.status) {
                window.location.reload()
            }else{
                Alerter.error('Erreur !', data.message);
            }
        }, 'json');
        return false;
    });


})