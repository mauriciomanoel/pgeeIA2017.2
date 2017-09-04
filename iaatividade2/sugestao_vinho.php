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


    echo "<pre>PARAMETROS:<br>"; 
    var_dump($_POST);
    $mcAnterior = 0;
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

    // Calculo do FC conseqüente
    function calculaFC($fcRegra, $mcAnterior) {
        return $fcRegra * (1 - $mcAnterior) + $mcAnterior;
    }

    function calculoFCAntecedente($tipo = "or", $valor1, $valor2) {
        if ($tipo == "and") {
            return min($valor1, $valor2);
        } else {
            return max($valor1, $valor2);
        }
    }

    // Calculo de Geração da Melhor Docura
    function melhorDocura($tem_molho, $molho, $nivel_molho) {
        global $mcAnterior;
        $dados = array("melhor_docura" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($tem_molho == TEM_MOLHO_NAO) {             
            $dados["melhor_docura"] = MELHOR_DOCURA_SECO;
            $dados["medida_crenca"] = 0.7;
            $dados["fator_crenca"] = 0.7;
            $retorno[] = $dados;
        } else {
            if ($molho == MOLHO_DOCE) {
                $fc = 0.9;
                $mc = calculaFC($fc, $nivel_molho);
                $dados["melhor_docura"] = MELHOR_DOCURA_DOCE;
                $dados["medida_crenca"] = $mc;
                $dados["fator_crenca"] = $fc;
                $retorno[] = $dados;
            } else if ($molho == MOLHO_TEMPERADO) {
                $fc = 0.6;
                $mc = calculaFC($fc, $nivel_molho);
                $dados["melhor_docura"] = MELHOR_DOCURA_SECO;
                $dados["medida_crenca"] = $mc;
                $dados["fator_crenca"] = $fc;
                $retorno[] = $dados;
            } else if ($molho == MOLHO_TOMATE) {
                $fc = 0.5;
                $mc = calculaFC($fc, $nivel_molho);
                $dados["melhor_docura"] = MELHOR_DOCURA_DOCE;
                $dados["medida_crenca"] = $mc;
                $dados["fator_crenca"] = $fc;
                $retorno[] = $dados;
            }
        }
        $mcAnterior = $mc;
        return $retorno[0];
    }

    // Calculo de Geração da Melhor Cor
    function melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho, $nivel_molho) {
        global $mcAnterior;
        $dados = array("melhor_cor" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($prato_principal == PRATO_PRINCIPAL_PEIXE) {
            $fc = 0.9;
            $mc = 0.9;
            $dados["melhor_cor"] = MELHOR_COR_BRANCO;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        } else {
            if ($tem_molho == TEM_MOLHO_SIM && $molho == MOLHO_TOMATE) {
                $fc = 0.7;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_AVE && $tem_peru == TEM_PERU_NAO) {
                $fc = 0.7;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_BRANCO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_AVE && $tem_peru == TEM_PERU_SIM) {
                $fc = 0.8;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_CARNE && $tem_vitela == TEM_VITELA_NAO) {
                $fc = 0.9;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_CARNE && $tem_vitela == TEM_VITELA_SIM) {
                $fc = 0.6;
                var_dump($mcAnterior);
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_BRANCO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
        }
        $mcAnterior = $mc;
        if (!empty($retorno)) {
            return $retorno[0];
        } else return null;
    }

    function corRecomentada($cor_preferida, $melhor_cor, $prato_principal) {
        $dados = array("cor_recomentada" => "", "fator_crenca" => 0);
        $retorno = array();
        
        //var_dump($cor_preferida, $melhor_cor);

        if ($cor_preferida == $melhor_cor) {
            $dados["cor_recomentada"] = $melhor_cor;
            $dados["medida_crenca"] = 1;
            $retorno[] = $dados;
        }
        if ($prato_principal == PRATO_PRINCIPAL_VEGETARIANO) {
            $dados["cor_recomentada"] = $cor_preferida;
            $dados["medida_crenca"] = 1;
            $retorno[] = $dados;
        }
        if ($melhor_cor == MELHOR_COR_TINTO) {
            $dados["cor_recomentada"] = COR_RECOMENTADA_TINTO;
            $dados["medida_crenca"] = 0.8;
            $retorno[] = $dados;
        } else if ($melhor_cor == MELHOR_COR_BRANCO) {
            $dados["cor_recomentada"] = COR_RECOMENTADA_BRANCO;
            $dados["medida_crenca"] = 0.8;
            $retorno[] = $dados;
        }
        
        //$retorno = unique_multidim_array($retorno, "fator_crenca");
        return $retorno;
    }

    function docuraRecomentada($prato_principal, $melhor_docura, $docura_preferida) {
        $dados = array("docura_recomentada" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($melhor_docura == $docura_preferida) {
            $dados["docura_recomentada"] = $melhor_docura;
            $dados["medida_crenca"] = 1;
            $retorno[] = $dados;
        } else if ($prato_principal == PRATO_PRINCIPAL_VEGETARIANO) {
            $dados["docura_recomentada"] = $melhor_docura;
            $dados["medida_crenca"] = 0.7;
            $retorno[] = $dados;
        } else {
            if ($melhor_docura == MELHOR_DOCURA_DOCE) {
                $dados["docura_recomentada"] = DOCURA_RECOMENTADA_DOCE;
                $dados["medida_crenca"] = 0.8;
                $retorno[] = $dados;
            }
            if ($melhor_docura == MELHOR_DOCURA_SECO) {
                $dados["docura_recomentada"] = DOCURA_RECOMENTADA_SECO;
                $dados["medida_crenca"] = 0.8;
                $retorno[] = $dados;
            }
            if ($melhor_docura == MELHOR_DOCURA_SECO && $docura_preferida == DOCURA_PREFERIDA_DOCE) {
                $dados["docura_recomentada"] = DOCURA_RECOMENTADA_SUAVE;
                $dados["medida_crenca"] = 0.8;
                $retorno[] = $dados;
            }
        }

        return $retorno;
    }

    function vinho($cor_recomentada, $docura_recomentada) {
        $dados = array("vinho" => "", "fator_crenca" => 0);
        $retorno = array();

        if ($cor_recomentada == COR_RECOMENTADA_TINTO && $docura_recomentada == DOCURA_RECOMENTADA_DOCE) {
            $dados["vinho"] = VINHO_GAMAY;
            $dados["medida_crenca"] = 0.9;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_BRANCO && $docura_recomentada == DOCURA_RECOMENTADA_SECO) {
            $dados["vinho"] = VINHO_CHABLIS;
            $dados["medida_crenca"] = 0.95;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_TINTO && $docura_recomentada == DOCURA_RECOMENTADA_SECO) {
            $dados["vinho"] = VINHO_CABERNET_SAUVIGNON;
            $dados["medida_crenca"] = 0.85;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_BRANCO && $docura_recomentada == DOCURA_RECOMENTADA_DOCE) {
            $dados["vinho"] = VINHO_RIESLING;
            $dados["medida_crenca"] = 0.9;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_BRANCO && $docura_recomentada == DOCURA_RECOMENTADA_SECO) {
            $dados["vinho"] = VINHO_SAUVIGNON_BRANCO;
            $dados["medida_crenca"] = 0.8;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_BRANCO && $docura_recomentada == DOCURA_RECOMENTADA_DOCE) {
            $dados["vinho"] = VINHO_CHENIN_BLANC;
            $dados["medida_crenca"] = 0.95;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_TINTO && $docura_recomentada == DOCURA_RECOMENTADA_SUAVE) {
            $dados["vinho"] = VINHO_PINOT_NOIR;
            $dados["medida_crenca"] = 0.9;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_BRANCO && $docura_recomentada == DOCURA_RECOMENTADA_SUAVE) {
            $dados["vinho"] = VINHO_SOAVE;
            $dados["medida_crenca"] = 0.7;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_BRANCO && $docura_recomentada == DOCURA_RECOMENTADA_SUAVE) {
            $dados["vinho"] = VINHO_CHARDONAY;
            $dados["medida_crenca"] = 0.9;
            $retorno[] = $dados;
        }
        if ($cor_recomentada == COR_RECOMENTADA_TINTO && $docura_recomentada == DOCURA_RECOMENTADA_SUAVE) {
            $dados["vinho"] = VINHO_ZINFANDEL;
            $dados["medida_crenca"] = 0.85;
            $retorno[] = $dados;
        }
        return $retorno;
    }

    // Fazendo os calculos
    echo "e3: Calculo Melhor Doçura<br>";
    echo "tem_molho: " . $tem_molho . " e molho: " . $molho . " e nivel_molho: " . $nivel_molho . "<br>";
    $melhor_docura = melhorDocura($tem_molho, $molho, $nivel_molho);
    var_dump($mcAnterior, $melhor_docura); 
    
    echo "<br>e3: Calculo da Melhor Cor<br>";
    echo "prato_principal: " . $prato_principal . " e tem_vitela: " . $tem_vitela . " e tem_peru: " . $tem_peru . " e tem_molho: " . $tem_molho  . " e molho: " . $molho  . "<br>";
    $melhor_cor = melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho, $nivel_molho);
    var_dump($melhor_cor);exit;
    
    echo "<br>e2: Calculo Cor Recomentada<br>";
    echo "cor_preferida: " . $cor_preferida . " e melhor_cor: " . $melhor_cor["melhor_cor"] . " e prato_principal: " . $prato_principal . "<br>";
    $cores_recomentada = corRecomentada($cor_preferida, $melhor_cor["melhor_cor"], $prato_principal);
    var_dump($cores_recomentada);
    
    echo "<br>e2: Calculo Doçura Recomentada<br>";
    echo "prato_principal: " . $prato_principal . " e melhor_docura: " . $melhor_docura["melhor_docura"] . " e docura_preferida: " . $docura_preferida . "<br>";
    $docuras_recomentada = docuraRecomentada($prato_principal, $melhor_docura["melhor_docura"], $docura_preferida);
    var_dump($docuras_recomentada);

    echo "<br>e1: Calculo Vinho<br>";
    foreach($cores_recomentada as $cor_recomentada) {
        foreach($docuras_recomentada as $docura_recomentada) {
            echo "cor_recomentada: " . $cor_recomentada["cor_recomentada"] . " e docura_recomentada: " . $docura_recomentada["docura_recomentada"] . "<br>";
            $vinho = vinho($cor_recomentada["cor_recomentada"], $docura_recomentada["docura_recomentada"]);
            var_dump($vinho);
        }
    }
?>