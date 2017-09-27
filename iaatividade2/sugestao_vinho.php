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

    // define("DOCURA_PREFERIDA_DOCE", 'DOCE');
	// define("DOCURA_PREFERIDA_SUAVE", 'SUAVE');
    // define("DOCURA_PREFERIDA_SECO", 'SECO');
    
    function search_value_in($needle, $arr)
    {
        $result = [];
        $found = 0;
        if (is_array($arr)) {
            foreach ($arr as $in) {
                if (is_array($in)) {
                   if (array_search($needle, $in) !== false) {
                       $result[] = $found;
                   }
                } 
                $found++;
            }
        }
        return $result;
    }
    
    function get_valores_duplicados($keys, $valores) {
        $temp = array();
        foreach($keys as $key) {
            $temp[] = $valores[$key];
        }

        return $temp;
    }
    // Verifica se todos os tipos são iguais
    function verificaMesmaDocuraRecomentada($valores) {
        $resposta = true;
        if (!empty($valores) && count($valores) > 1) {
            // Verificando se existe duplicidade para DOCE
            $keys = search_value_in(DOCURA_PREFERIDA_DOCE, $valores);
            if ( !empty( $keys ) && count($keys) > 1) {
                echo "* DUPLICIDADE ENCONTRADA PARA: " . DOCURA_PREFERIDA_DOCE . "<br>";
                // Verifica se o array esta triplicado
                if (count($keys) == 3) {
                    $temp = array_sort($valores, "medida_crenca", SORT_DESC);
                    $novo_valor = array($temp[0]);
                    return $novo_valor;
                }
                $temp = get_valores_duplicados($keys, $valores);                
                $novo_valor = calculoPropagandoIncertezaRegra($temp);
                // Adicionando a medida original sem duplicidade
                foreach($valores as $k => $valor) {
                    if (array_search($k, $keys) === false) {
                        $novo_valor[] = $valor;
                    }
                }
                return $novo_valor;
            }
            
            // Verificando se existe duplicidade para SUAVE
            $keys = array();
            $keys = search_value_in(DOCURA_PREFERIDA_SUAVE, $valores);
            if ( !empty( $keys ) && count($keys) > 1) {
                echo "* DUPLICIDADE ENCONTRADA PARA: " . DOCURA_PREFERIDA_SUAVE . "<br>";
                // Verifica se o array esta triplicado
                if (count($keys) == 3) {
                    $temp = array_sort($valores, "medida_crenca", SORT_DESC);
                    $novo_valor = array($temp[0]);
                    return $novo_valor;
                }
                $temp = get_valores_duplicados($keys, $valores);                
                $novo_valor = calculoPropagandoIncertezaRegra($temp);                
                // Adicionando a medida original sem duplicidade
                foreach($valores as $k => $valor) {
                    if (array_search($k, $keys) === false) {
                        $novo_valor[] = $valor;
                    }
                }
                
                return $novo_valor;
            }

            // Verificando se existe duplicidade para SECO
            $keys = array();
            $keys = search_value_in(DOCURA_PREFERIDA_SECO, $valores);
            if ( !empty( $keys ) && count($keys) > 1) {
                echo "* DUPLICIDADE ENCONTRADA PARA: " . DOCURA_PREFERIDA_SECO . "<br>";
                // Verifica se o array esta triplicado
                if (count($keys) == 3) {
                    $temp = array_sort($valores, "medida_crenca", SORT_DESC);
                    $novo_valor = array($temp[0]);
                    return $novo_valor;
                }
                $temp = get_valores_duplicados($keys, $valores);                
                $novo_valor = calculoPropagandoIncertezaRegra($temp);
                // Adicionando a medida original sem duplicidade
                foreach($valores as $k => $valor) {
                    if (array_search($k, $keys) === false) {
                        $novo_valor[] = $valor;
                    }
                }
                return $novo_valor;
            }

            // Verificando se existe duplicidade para COR_RECOMENTADA_TINTO
            $keys = array();
            $keys = search_value_in(COR_RECOMENTADA_TINTO, $valores);
            if ( !empty( $keys ) && count($keys) > 1) {
                echo "* DUPLICIDADE ENCONTRADA PARA: " . COR_RECOMENTADA_TINTO . "<br>";
                // Verifica se o array esta triplicado
                if (count($keys) == 3) {
                    $temp = array_sort($valores, "medida_crenca", SORT_DESC);
                    $novo_valor = array($temp[0]);
                    return $novo_valor;
                }

                $temp = get_valores_duplicados($keys, $valores);  
                $novo_valor = calculoPropagandoIncertezaRegra($temp);
                // Adicionando a medida original sem duplicidade
                foreach($valores as $k => $valor) {
                    if (array_search($k, $keys) === false) {
                        $novo_valor[] = $valor;
                    }
                }
               
                return $novo_valor;
            }

            $keys = array();
            $keys = search_value_in(COR_RECOMENTADA_BRANCO, $valores);
            if ( !empty( $keys ) && count($keys) > 1) {
                echo "* DUPLICIDADE ENCONTRADA PARA: " . COR_RECOMENTADA_BRANCO . "<br>";
                // Verifica se o array esta triplicado
                if (count($keys) == 3) {
                    $temp = array_sort($valores, "medida_crenca", SORT_DESC);
                    $novo_valor = array($temp[0]);
                    return $novo_valor;
                }
                $temp = get_valores_duplicados($keys, $valores);                
                $novo_valor = calculoPropagandoIncertezaRegra($temp);
                // Adicionando a medida original sem duplicidade
                foreach($valores as $k => $valor) {
                    if (array_search($k, $keys) === false) {
                        $novo_valor[] = $valor;
                    }
                }
                return $novo_valor;
            }

            return $valores;
        }
    }

    // Calculo da Melhor Doçura recomentada considerando a maior medida de crença
    function calculoMelhorDocuraRecomentada($retorno) {
        echo "- Calculo Melhor Doçura Recomentada com base na maior medida de crença</br>";
        $retorno = array_sort($retorno, 'medida_crenca', SORT_DESC);
        return $retorno;
    }

    function calculoPropagandoIncertezaRegra($retorno) {

        // Progando a Incerteza na regra
        $fcPropagado = 1;
        $mcPropagado = 1;
        if (!empty($retorno) && count($retorno) > 1) {
            echo "- Calculando a Progando a Incerteza na Regra</br>";
            echo "-- FC = " . $retorno[0]["fator_crenca"] . " * " . $retorno[1]["fator_crenca"] . "</br>";
            echo "-- MC = " . $retorno[0]["medida_crenca"] . " * " . $retorno[1]["medida_crenca"] . "</br>";
            foreach($retorno as $dado) {
                $fcPropagado *= $dado["fator_crenca"]; 
                $mcPropagado *= $dado["medida_crenca"]; 
            }
                        
            $retorno[0]["fator_crenca"] = $fcPropagado;
            $retorno[0]["medida_crenca"] = $mcPropagado;
        }

        unset($retorno[1]);
        return $retorno;
    }

    // Ordenando um array
    function array_sort($array, $on, $order=SORT_ASC) {
        $new_array = array();
        $sortable_array = array();
    
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }
    
            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }
    
            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }
    
        return $new_array;
    }

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

    // Calculo do FC Conseqüente
    function calculaFC($fcRegra, $mcAnterior) {
        echo "- Calculo do FC Consequente: \$mc = " . $fcRegra . " * (1 - " . $mcAnterior . ") + " . $mcAnterior . "</br>";
        return $fcRegra * (1 - $mcAnterior) + $mcAnterior;
    }

    function calculoFCAntecedente($tipo = "or", $valor1, $valor2) {
        echo "- Calculo do FC Antecedente: FC(A and B) = min(" . $valor1 . "," . $valor2 . ") </br>";
        if ($tipo == "and") {
            return min($valor1, $valor2);
        } else {
            return max($valor1, $valor2);
        }
    }

    // Calculo de Geração da Melhor Docura
    function melhorDocura($tem_molho, $molho, $nivel_molho) {
        $dados = array("melhor_docura" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($tem_molho == TEM_MOLHO_NAO) {   
            $fc = 0.7;
            $mc = 0.7;
            $dados["melhor_docura"] = MELHOR_DOCURA_SECO;
            $dados["medida_crenca"] = $mc;
            $dados["fator_crenca"] = $fc;
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
        return $retorno[0];
    }

    // Calculo de Geração da Melhor Cor - e3
    function melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho, $nivel_molho) {        
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
                $mcAnterior = 0.99;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_AVE && $tem_peru == TEM_PERU_NAO) {
                $fc = 0.7;
                $mcAnterior = 0.99;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_BRANCO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_AVE && $tem_peru == TEM_PERU_SIM) {
                $fc = 0.8;
                $mcAnterior = 0.99;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_CARNE && $tem_vitela == TEM_VITELA_NAO) {
                $fc = 0.9;
                $mcAnterior = 0.99;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_TINTO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
            if ($prato_principal == PRATO_PRINCIPAL_CARNE && $tem_vitela == TEM_VITELA_SIM) {
                $fc = 0.6;
                $mcAnterior = 0.99;
                $mc = calculaFC($fc, $mcAnterior);
                $dados["melhor_cor"] = MELHOR_COR_BRANCO;
                $dados["fator_crenca"] = $fc;
                $dados["medida_crenca"] = $mc;
                $retorno[] = $dados;
            }
        }

        if ( empty($retorno) ) {
            echo "- Não foi possível encontrar a melhor cor com os parâmetros encontrados </br>";
            return null;
        }

        if (count($retorno) > 1) {
            return verificaMesmaDocuraRecomentada($retorno);
        } else {
            return $retorno;
        }
    }

    // Calculo da Cor recomentada - e2
    function corRecomendada($cor_preferida, $nivel_cor_preferida, $melhor_cor, $prato_principal) {
        $dados = array("cor_recomendada" => "", "fator_crenca" => 0);
        $retorno = array();
        
        if ($cor_preferida == $melhor_cor["melhor_cor"]) {
            $fcRegra = 1;
            $mcAnterior = calculoFCAntecedente("and", $nivel_cor_preferida, $melhor_cor["fator_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["cor_recomendada"] = $cor_preferida;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($prato_principal == PRATO_PRINCIPAL_VEGETARIANO) {
            $fcRegra = 1;
            $mcAnterior = $nivel_cor_preferida;
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["cor_recomendada"] = $cor_preferida;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($melhor_cor["melhor_cor"] == MELHOR_COR_TINTO) {
            $fcRegra = 0.8;
            $mcAnterior = $melhor_cor["fator_crenca"];
            $fc = $mcAnterior;
            $mc = $fcRegra;
            $dados["cor_recomendada"] = COR_RECOMENTADA_TINTO;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        } 
        if ($melhor_cor["melhor_cor"] == MELHOR_COR_BRANCO) {
            $fcRegra = 0.8;
            $mcAnterior = $melhor_cor["fator_crenca"];
            $fc = $mcAnterior;
            $mc = $fcRegra;
            $dados["cor_recomendada"] = COR_RECOMENTADA_BRANCO;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        
        // Progando a Incerteza na regra
        if (!empty($retorno) && count($retorno) > 1) {
            return verificaMesmaDocuraRecomentada($retorno);
            // return calculoPropagandoIncertezaRegra($retorno);
        } else {
            return $retorno;
        }
    }

    // Calculo da Doçura Recomentada - e2
    function docuraRecomentada($prato_principal, $melhor_docura, $docura_preferida, $nivel_docura_preferida) {
        
        $dados = array("docura_recomendada" => "", "fator_crenca" => 0);
        $retorno = array();
        if ($melhor_docura["melhor_docura"] == $docura_preferida) {
            $fcRegra = 1;
            $mcAnterior = calculoFCAntecedente("and", $nivel_docura_preferida, $melhor_docura["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["docura_recomendada"] = $docura_preferida;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }  
        if ($prato_principal == PRATO_PRINCIPAL_VEGETARIANO) {            
            $fcRegra = 0.7;
            $mcAnterior = $melhor_docura["medida_crenca"];
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["docura_recomendada"] = $melhor_docura["melhor_docura"];
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }  
        if ($melhor_docura["melhor_docura"] == MELHOR_DOCURA_DOCE) {
            $fcRegra = 0.8;
            $mcAnterior = $melhor_docura["fator_crenca"];
            $fc = $mcAnterior;
            $mc = $fcRegra;
            $dados["docura_recomendada"] = DOCURA_RECOMENTADA_DOCE;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }            
        if ($melhor_docura["melhor_docura"] == MELHOR_DOCURA_SECO && $docura_preferida == DOCURA_PREFERIDA_DOCE) {
            $fcRegra = 0.8;
            $mcAnterior = calculoFCAntecedente("and", $melhor_docura["medida_crenca"], $nivel_docura_preferida);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["docura_recomendada"] = DOCURA_RECOMENTADA_SUAVE;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        } 
        if ($melhor_docura["melhor_docura"] == MELHOR_DOCURA_SECO) {
            $fcRegra = 0.8;
            $mcAnterior = $melhor_docura["fator_crenca"];
            $fc = $mcAnterior;
            $mc = $fcRegra;
            $dados["docura_recomendada"] = DOCURA_RECOMENTADA_SECO;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        } if ($melhor_docura["melhor_docura"] == MELHOR_DOCURA_DOCE && $docura_preferida == DOCURA_PREFERIDA_SECO) {
            $fcRegra = 0.8;
            $mcAnterior = calculoFCAntecedente("and", $melhor_docura["medida_crenca"], $nivel_docura_preferida);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["docura_recomendada"] = DOCURA_RECOMENTADA_SUAVE;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        
        // 
        if (!empty($retorno) && count($retorno) > 1) {
           $retorno = verificaMesmaDocuraRecomentada($retorno);
        } 

        return $retorno;
    }

    function melhorVinho($cor_recomendada, $docura_recomendada) {
        $dados = array("vinho" => "", "fator_crenca" => 0);
        $retorno = array();

        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_TINTO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_DOCE) {
            $fcRegra = 0.9;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_GAMAY;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_BRANCO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SECO) {
            $fcRegra = 0.95;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_CHABLIS;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_TINTO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SECO) {
            $fcRegra = 0.85;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_CABERNET_SAUVIGNON;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_BRANCO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_DOCE) {
            $fcRegra = 0.9;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_RIESLING;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_BRANCO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SECO) {
            $fcRegra = 0.8;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_SAUVIGNON_BRANCO;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_BRANCO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_DOCE) {
            $fcRegra = 0.95;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_CHENIN_BLANC;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_TINTO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SUAVE) {
            $fcRegra = 0.9;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_PINOT_NOIR;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_BRANCO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SUAVE) {
            $fcRegra = 0.7;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_SOAVE;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_BRANCO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SUAVE) {
            $fcRegra = 0.9;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_CHARDONAY;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        if ($cor_recomendada["cor_recomendada"] == COR_RECOMENTADA_TINTO && $docura_recomendada["docura_recomendada"] == DOCURA_RECOMENTADA_SUAVE) {
            $fcRegra = 0.85;
            $mcAnterior = calculoFCAntecedente("and", $cor_recomendada["medida_crenca"], $docura_recomendada["medida_crenca"]);
            $fc = $mcAnterior;
            $mc = calculaFC($fcRegra, $mcAnterior);
            $dados["vinho"] = VINHO_ZINFANDEL;
            $dados["fator_crenca"] = $fc;
            $dados["medida_crenca"] = $mc;
            $retorno[] = $dados;
        }
        $retorno = array_sort($retorno, "medida_crenca", SORT_DESC);
        return $retorno;
    }

    // Fazendo os calculos e3
    echo "e3: Calculo Melhor Doçura<br>";
    echo "- tem_molho: " . $tem_molho . " e molho: " . $molho . " e nivel_molho: " . $nivel_molho . "<br>";
    $melhor_docura = melhorDocura($tem_molho, $molho, $nivel_molho);
    var_dump($melhor_docura); 
    
    echo "<br>e3: Calculo da Melhor Cor<br>";
    echo "- prato_principal: " . $prato_principal . " e tem_vitela: " . $tem_vitela . " e tem_peru: " . $tem_peru . " e tem_molho: " . $tem_molho  . " e molho: " . $molho  . "<br>";
    $melhor_cores = melhorCor($prato_principal, $tem_vitela, $tem_peru, $tem_molho, $molho, $nivel_molho);
    var_dump($melhor_cores); 
    
    echo "<br>e2: Calculo Cor Recomentada<br>"; 
    if ($melhor_cores != null) {
        $cores_recomendada = array();
        foreach($melhor_cores as $melhor_cor) {
            echo "- cor_preferida: " . $cor_preferida . " e melhor_cor: " . $melhor_cor["melhor_cor"] . " e prato_principal: " . $prato_principal . "<br>";
            $temp = corRecomendada($cor_preferida, $nivel_cor_preferida, $melhor_cor, $prato_principal);
            foreach($temp as $valor) {
                $cores_recomendada[] = $valor;
            }        
        }
    } else {
        echo "- cor_preferida: " . $cor_preferida . " e melhor_cor: " . " - " . " e prato_principal: " . $prato_principal . "<br>";
        $cores_recomendada = corRecomendada($cor_preferida, $nivel_cor_preferida, null, $prato_principal);
    }
    var_dump($cores_recomendada);

    echo "<br>e2: Calculo Doçura Recomentada<br>";
    echo "- prato_principal: " . $prato_principal . " e melhor_docura: " . $melhor_docura["melhor_docura"] . " e docura_preferida: " . $docura_preferida . " e nivel_docura_preferida: " . $nivel_docura_preferida ."<br>";
    $docuras_recomendada = docuraRecomentada($prato_principal, $melhor_docura, $docura_preferida, $nivel_docura_preferida);
    var_dump($docuras_recomendada);

    echo "<br>e1: Calculo Vinho<br>";
    $vinhos = array();
    foreach($cores_recomendada as $cor_recomendada) {
        foreach($docuras_recomendada as $docura_recomendada) {
            echo "- cor_recomendada: " . $cor_recomendada["cor_recomendada"] . " e docura_recomendada: " . $docura_recomendada["docura_recomendada"] . "<br>";
            $valores = melhorVinho($cor_recomendada, $docura_recomendada);
            var_dump($valores);
            foreach($valores as $valor) {
                $vinhos[] = $valor;
            }
        }
    }

    $vinhos = array_sort($vinhos, "medida_crenca", SORT_DESC);
    echo "<br><br> *** SISTEMA DE RECOMENDAÇÃO DE VINHOS *** <br>";
    var_dump($vinhos);
    
?>