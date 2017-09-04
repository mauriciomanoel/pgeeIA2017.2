$(document).ready(function(){

    $("#reset").click(function(){
        $( "#div_molho" ).show();
        $( "#div_tem_vitela" ).show();
        $( "#div_tem_peru" ).show();
        $('#tem_vitela_nao').removeAttr('checked');
        $('#tem_peru_nao').removeAttr('checked');
    });

    $("#prato_principal").change(function(){
        var prato_principal = $( "#prato_principal" ).val();
        $( "#div_tem_vitela" ).show();
        $( "#div_tem_peru" ).show();
        //$( "#div_tem_molho" ).show();
        //$( "#div_molho" ).show();
        $('#tem_vitela_nao').removeAttr('checked');
        $('#tem_peru_nao').removeAttr('checked');
        //$('#tem_molho_nao').removeAttr('checked');
        
        if (prato_principal == PRATO_PRINCIPAL_VEGETARIANO || prato_principal == PRATO_PRINCIPAL_PEIXE) {
            $( "#div_tem_vitela" ).hide();
            $( "#div_tem_peru" ).hide();
            //$( "#div_tem_molho" ).hide();
            //$( "#div_molho" ).hide();
            $('#tem_vitela_nao').attr('checked', 'checked');
            $('#tem_peru_nao').attr('checked', 'checked');
            //$('#tem_molho_nao').attr('checked', 'checked');
        } else if (prato_principal == PRATO_PRINCIPAL_CARNE ) {
            $( "#div_tem_peru" ).hide();
            $('#tem_peru_nao').attr('checked', 'checked');
        } else if (prato_principal == PRATO_PRINCIPAL_AVE) {
            $( "#div_tem_vitela" ).hide();
            $('#tem_vitela_nao').attr('checked', 'checked');
        } else {
            $( "#div_tem_vitela" ).show();
            $( "#div_tem_peru" ).show();
            $('#tem_vitela_nao').removeAttr('checked');
            $('#tem_peru_nao').removeAttr('checked');
        }
    });


    $("#tem_molho_nao").change(function(){
        $( "#div_molho" ).hide();
    });

    $("#tem_molho_sim").change(function(){
        $( "#div_molho" ).show();
    });

});