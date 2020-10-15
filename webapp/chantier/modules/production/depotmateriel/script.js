$(function(){

    annulerMiseenboutique = function(id){
        alerty.confirm("Voulez-vous vraiment annuler cette mise en boutique ?", {
            title: "Annuler la mise en boutique",
            cancelLabel : "Non",
            okLabel : "OUI, annuler",
        }, function(){
            var url = "../../webapp/chantier/modules/production/depotmateriel/ajax.php";
            alerty.prompt("Entrer votre mot de passe pour confirmer l'opération !", {
                title: 'Récupération du mot de passe !',
                inputType : "password",
                cancelLabel : "Annuler",
                okLabel : "Valider"
            }, function(password){
                Loader.start();
                $.post(url, {action:"annulerMiseenboutique", id:id, password:password}, (data)=>{
                    if (data.status) {
                        window.location.reload()
                    }else{
                        Alerter.error('Erreur !', data.message);
                    }
                },"json");
            })
        })
    }


    terminer = function(id){
        alerty.confirm("Voulez-vous vraiment confirmer la reception de l'envoi de materiels ?", {
            title: "Confirmer reception de l'envoi de materiels",
            cancelLabel : "Non",
            okLabel : "OUI, terminer",
        }, function(){
            session("depotmateriel_id", id);
            modal("#modal-depotmateriel-"+id);
        })
    }


    $("#formValiderDepotMateriel").submit(function(event) {
        Loader.start();
        $(this).find("input.vendus").last().change();
        var url = "../../webapp/chantier/modules/production/depotmateriel/ajax.php";
        var formdata = new FormData($(this)[0]);
        var tableau = new Array();
        $(this).find("table tr input.recu").each(function(index, el) {
            var id = $(this).attr('data-id');
            
            var vendu = $(this).val();
            tableau.push(id+"-"+vendu);
        });
        formdata.append('tableau', tableau);

        formdata.append('action', "validerDepotMateriel");
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