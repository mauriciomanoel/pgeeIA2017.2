<?php
/*
 DUVIDAS: Qual o comportamento para calcular a melhor cor se o prato principal for vegetariano
*/
	require( 'config.ini.php' );

    $prato_principal            = $_POST["prato_principal"];
    $tem_vitela                 = @$_POST["tem_vitela"];
    $tem_peru                   = @$_POST["tem_peru"];
    $tem_molho                  = $_POST["tem_molho"];
    $molho                      = $_POST["molho"];
    $nivel_molho                = $_POST["nivel_molho"];
    $sabor                      = $_POST["sabor"];
    $nivel_sabor                = $_POST["nivel_sabor"];
    $docura_preferida           = $_POST["docura_preferida"];
    $nivel_docura_preferida     = $_POST["nivel_docura_preferida"];
    $cor_preferida              = $_POST["cor_preferida"];
    $nivel_cor_preferida        = $_POST["nivel_cor_preferida"];

    echo "<pre>"; var_dump($_POST);

    // Função auxiliar para remover os array's duplicados
    function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    } 

    // Calculo de Geração da Melhor Docura
    function melhorDocura($tem_molho, $molho) {
        $dados = array("melhor_docura" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($tem_molho == TEM_MOLHO_NAO) {
            $dados["melhor_docura"] = MELHOR_DOCURA_SECO;
            $dados["fator_crenca"] = 0.7;
            $retorno[] = $dados;
        } else {
            if ($molho == MOLHO_DOCE) {
                $dados["melhor_docura"] = MELHOR_DOCURA_DOCE;
                $dados["fator_crenca"] = 0.9;
                $retorno[] = $dados;
            } else if ($molho == MOLHO_TEMPERADO) {
                $dados["melhor_docura"] = MELHOR_DOCURA_SECO;
                $dados["fator_crenca"] = 0.6;
                $retorno[] = $dados;
            } else if ($molho == MOLHO_TOMATE) {
                $dados["melhor_docura"] = MELHOR_DOCURA_DOCE;
                $dados["fator_crenca"] = 0.5;
                $retorno[] = $dados;
            }
        }
        return $retorno[0];
    }

    // Calculo de Geração da Melhor Cor
    function melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho) {
        $dados = array("melhor_cor" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($prato_principal == PRATO_PRINCIPAL_PEIXE) {
            $dados["melhor_cor"] = MELHOR_COR_BRANCO;
            $dados["fator_crenca"] = 0.9;
            $retorno[] = $dados;
        } else {
            if ($tem_molho == TEM_MOLHO_SIM && $molho = MOLHO_TOMATE) {
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = 0.7;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_AVE && $tem_peru = TEM_PERU_NAO) {
                $dados["melhor_cor"] = MELHOR_COR_BRANCO;
                $dados["fator_crenca"] = 0.7;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_AVE && $tem_peru = TEM_PERU_SIM) {
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = 0.8;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_CARNE && $tem_vitela = TEM_VITELA_NAO) {
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = 0.9;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_CARNE && $tem_vitela = TEM_VITELA_SIM) {
                $dados["melhor_cor"] = MELHOR_COR_BRANCO;
                $dados["fator_crenca"] = 0.6;
                $retorno[] = $dados;
            }
        }
        var_dump($retorno);
        return $retorno[0];
    }

    function corRecomentada($cor_preferida, $melhor_cor, $prato_principal) {
        $dados = array("cor_recomentada" => "", "fator_crenca" => 0);
        $retorno = array();
        
        var_dump($cor_preferida, $melhor_cor);

        if ($cor_preferida == $melhor_cor) {
            $dados = array("cor_recomentada" => $melhor_cor, "fator_crenca" => 1);
            $retorno[] = $dados;
        }
        if ($prato_principal == PRATO_PRINCIPAL_VEGETARIANO) {
            $dados = array("cor_recomentada" => $cor_preferida, "fator_crenca" => 1);
            $retorno[] = $dados;
        }
        if ($melhor_cor == MELHOR_COR_TINTO) {
            $dados = array("cor_recomentada" => MELHOR_COR_TINTO, "fator_crenca" => 0.8);
            $retorno[] = $dados;
        } else if ($melhor_cor == MELHOR_COR_BRANCO) {
            $dados = array("cor_recomentada" => MELHOR_COR_BRANCO, "fator_crenca" => 0.8);
            $retorno[] = $dados;
        }
        
        //$retorno = unique_multidim_array($retorno, "fator_crenca");
        return $retorno;

    }

    // Fazendo os calculos
    $melhor_docura = melhorDocura($tem_molho, $molho);
    $melhor_cor = melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho);
    $cor_recomentada = corRecomentada($cor_preferida, $melhor_cor["melhor_cor"], $prato_principal);
    var_dump($cor_recomentada);
?>