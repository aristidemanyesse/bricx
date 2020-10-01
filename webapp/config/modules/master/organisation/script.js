$(function(){
	
    $('input.i-checks.agence').on('ifChanged', function(event){
        var url = "../../webapp/config/modules/master/organisation/ajax.php";
        var $this = $(this);
        var etat = $(this).is(":checked");
        var agence_id = $(this).attr("agence_id");
        var employe_id = $(this).attr("employe_id");

        $.post(url, {action:"autoriserAgence", etat:etat, agence_id:agence_id, employe_id:employe_id}, (data)=>{
            if (data.status) {
                Alerter.success('Reussite !', "L'employé a maintenant accès à cette agence !");
                button.removeClass('btn-primary');
                button.addClass('btn-white');
            }else{
                Alerter.error('Erreur !', data.message);
            }
        },"json");
    });

})