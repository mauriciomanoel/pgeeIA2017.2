$(document).ready(function(){

    $("#reset").click(function(){
        $( "#div_molho" ).show();
        $( "#div_tem_vitela" ).show();
        $( "#div_tem_peru" ).show();
        $('#tem_vitela_nao').removeAttr('checked');
        $('#tem_peru_nao').removeAttr('checked');
    });

    $("#prato_principal").change(function(){
    
        if ($( "#prato_principal" ).val() == 4) {
            $( "#div_tem_vitela" ).hide();
            $( "#div_tem_peru" ).hide();
            $('#tem_vitela_nao').attr('checked', 'checked');
            $('#tem_peru_nao').attr('checked', 'checked');
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