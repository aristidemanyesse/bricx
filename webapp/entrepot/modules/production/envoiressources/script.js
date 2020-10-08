$(function(){


    depotressource = function(){
        var formdata = new FormData($("#formMiseenboutique")[0]);
        tableau = new Array();
        $("#modal-depotressource tr").each(function(index, el) {
            var id = $(this).attr('data-id');
            var val = $(this).find('input').val();
            if (val > 0) {
                var item = id+"-"+val;
                tableau.push(item);
            }      
        });
        formdata.append('listeressources', tableau);

        alerty.confirm("Voulez-vous vraiment effectuer l'envoi de ces ressources ?", {
            title: "Confirmation de l'envoi",
            cancelLabel : "Non",
            okLabel : "OUI, Valider",
        }, function(){
            Loader.start();
            var url = "../../webapp/entrepot/modules/production/envoiressources/ajax.php";
            formdata.append('action', "depotressource");
            $.post({url:url, data:formdata, contentType:false, processData:false}, function(data){
                if (data.status) {
                    window.location.reload();
                }else{
                    Alerter.error('Erreur !', data.message);
                }
            }, 'json')
        })
    }


    
    annulerDepotRessource = function(id){
        alerty.confirm("Voulez-vous vraiment annuler cette mise en boutique ?", {
            title: "Annuler la mise en boutique",
            cancelLabel : "Non",
            okLabel : "OUI, annuler",
        }, function(){
            var url = "../../webapp/entrepot/modules/production/envoiressource/ajax.php";
            alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
                title: 'Récupération du mot de passe !',
                inputType : "password",
                cancelLabel : "Annuler",
                okLabel : "Valider"
            }, function(password){
                Loader.start();
                $.post(url, {action:"annulerDepotRessource", id:id, password:password}, (data)=>{
                    if (data.status) {
                        window.location.reload()
                    }else{
                        Alerter.error('Erreur !', data.message);
                    }
                },"json");
            })
        })
    }


    $("#formValiderDepotRessource").submit(function(event) {
        Loader.start();
        $(this).find("input.vendus").last().change();
        var url = "../../webapp/entrepot/modules/production/envoiressource/ajax.php";
        var formdata = new FormData($(this)[0]);
        var tableau = new Array();
        $(this).find("table tr input.recu").each(function(index, el) {
            var id = $(this).attr('data-id');
            
            var vendu = $(this).val();
            tableau.push(id+"-"+vendu);
        });
        formdata.append('tableau', tableau);

        formdata.append('action', "validerDepotRessource");
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