$(document).ready(function(){

    
    function updateRangeInput(elem) {
        $(elem).next().val($(elem).val());
      }
    //
    function imprimirLegendaNivelMolho(valor) {
        valor*= 10;
        if (valor >= 0 && valor < 2) {
            return "Super Fraco";
        } else if (valor >= 2 && valor < 4) {
            return "Fraco";
        } else if (valor >= 4 && valor < 6) {
            return "Médio";
        } else if (valor >= 6 && valor < 8) {
            return "Forte";
        } else {
            return "Extra Forte";
        }
    }

    function imprimirNivelDocura(valor) {
        valor*= 10;
        if (valor >= 0 && valor < 2) {
            return "Super Fraco";
        } else if (valor >= 2 && valor < 4) {
            return "Fraco";
        } else if (valor >= 4 && valor < 6) {
            return "Médio";
        } else if (valor >= 6 && valor < 8) {
            return "Muito Doce";
        } else {
            return "Extra Doce";
        }
    }

    function imprimirNivelCorPreferida(valor) {
        valor*= 10;
        if (valor >= 0 && valor < 2) {
            return "Não é Relevante";
        } else if (valor >= 2 && valor < 4) {
            return "Pouco Relevante";
        } else if (valor >= 4 && valor < 6) {
            return "Médio";
        } else if (valor >= 6 && valor < 8) {
            return "Importante";
        } else {
            return "Muito Importante";
        }
    }
      
    // on page load, set the text of the label based the value of the range
    $('#range_text_nivel_molho').text(imprimirLegendaNivelMolho($('#nivel_molho').val()));
    $('#range_text_nivel_sabor').text(imprimirLegendaNivelMolho($('#nivel_sabor').val()));
    $('#range_text_nivel_docura_preferida').text(imprimirNivelDocura($('#nivel_docura_preferida').val()));
    $('#range_text_nivel_cor_preferida').text(imprimirNivelCorPreferida($('#nivel_cor_preferida').val()));

    
    $('#nivel_molho').on('input change', function () {
        $('#range_text_nivel_molho').text(imprimirLegendaNivelMolho($(this).val()));
    });

    $('#nivel_sabor').on('input change', function () {
        $('#range_text_nivel_sabor').text(imprimirLegendaNivelMolho($(this).val()));
    });

    $('#nivel_docura_preferida').on('input change', function () {
        $('#range_text_nivel_docura_preferida').text(imprimirNivelDocura($(this).val()));
    });

    $('#nivel_cor_preferida').on('input change', function () {
        $('#range_text_nivel_cor_preferida').text(imprimirNivelCorPreferida($(this).val()));
    });
      
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