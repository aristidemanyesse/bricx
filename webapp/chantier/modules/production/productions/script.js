$(function(){


    $("#modal-production input").change(function(){
        $this = $(this);
        var url = "../../webapp/chantier/modules/production/productions/ajax.php";
        var formdata = new FormData($("#formProduction")[0]);
        formdata.append('action', "calcul");
        $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
            $this.parent().parent().parent().find("div.ajax").html(data);
        }, 'html')
        return false;
    });


    $("#formProduction").submit(function(event) {
        var formdata = new FormData($(this)[0]);
        alerty.confirm("Voulez-vous vraiment mettre à jour la production de ce jour ?", {
            title: "Confirmation de la production",
            cancelLabel : "Non",
            okLabel : "OUI, Valider",
        }, function(){
            Loader.start();
            var url = "../../webapp/chantier/modules/production/productions/ajax.php";
            formdata.append('action', "productionjour");
            $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
                if (data.status) {
                    window.location.reload();
                }else{
                    Alerter.error('Erreur !', data.message);
                }
            }, 'json')
        });
        return false;
    });




    $(".formRangement").submit(function(event) {
        var formdata = new FormData($(this)[0]);
        alerty.confirm("Voulez-vous vraiment valider le rangement de ce jour ?", {
            title: "Confirmation de la production",
            cancelLabel : "Non",
            okLabel : "OUI, Valider",
        }, function(){
            Loader.start();
            var url = "../../webapp/chantier/modules/production/productions/ajax.php";
            formdata.append('action', "rangement");
            $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
                if (data.status) {
                    window.location.reload();
                }else{
                    Alerter.error('Erreur !', data.message);
                }
            }, 'json')
        });
        return false;
    });

})