$(function(){
	
    $('input.i-checks.chantier').on('ifChanged', function(event){
        var url = "../../webapp/config/modules/master/organisation/ajax.php";
        var $this = $(this);
        var etat = $(this).is(":checked");
        var chantier_id = $(this).attr("chantier_id");
        var employe_id = $(this).attr("employe_id");

        $.post(url, {action:"autoriserAgence", etat:etat, chantier_id:chantier_id, employe_id:employe_id}, (data)=>{
            if (data.status) {
                Alerter.success('Reussite !', "L'employé a maintenant accès à cette chantier !");
                button.removeClass('btn-primary');
                button.addClass('btn-white');
            }else{
                Alerter.error('Erreur !', data.message);
            }
        },"json");
    });

})