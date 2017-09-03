<?php
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
        return $retorno;
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
        return $retorno;

    }
    // Fazendo os calculos
    $melhor_docura = melhorDocura($tem_molho, $molho);
    $melhor_cor = melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho);
    var_dump($melhor_docura, $melhor_cor)
?>