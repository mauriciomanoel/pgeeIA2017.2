<?php
	ini_set("error_reporting", E_ALL & ~E_NOTICE);		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Problema do Caixeiro Viajante - Algoritmo Genético</title>
<style>
body {
	text-align: center;
	margin: 0px; padding: 0px;
}
body, td, th, input {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
h1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	text-align: center;
}
.cityCell {
	width: 60px;
}
.input {
	background-color: #CCFFFF;
	border: 1px solid #ccc;
	padding: 1px;
	margin: 1px;
}
#container {
	margin: 0 auto 0 auto; padding: 10px;
	width: 520px;
	text-align: left;
	border-left: 2px solid #333;
	border-right: 2px solid #333;
	border-bottom: 2px solid #333;
}
form {
	margin: 0px; padding: 0px;
}
.debug td {
	padding: 0 2px 0 2px;
}
</style>
</head>

<body>
<div id="container">
<h1>Problema do Caixeiro Viajante - Algoritmo Genético</h1>
<form method="post">
<table width="500" border="0" cellspacing="2" cellpadding="0" style='border: 1px solid #999;' align="center">
  <tr>
    <td><strong>Cidades</strong></td>
    <td align="center" class='cityCell'>Cidade 1 (A)</td>
    <td align="center" class='cityCell'>Cidade 2 (B)</td>
    <td align="center" class='cityCell'>Cidade 3 (C)</td>
    <td align="center" class='cityCell'>Cidade 4 (D)</td>
    <td align="center" class='cityCell'>Cidade 5 (E)</td>
  </tr>
  <tr>
    <td>Cidade 1 (A)</td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="1_2" type="text" class="input" id="textfield" size="4" maxlength="4" value="2" />
    </div></td>
    <td><div align="center">
      <input name="1_3" type="text" class="input" id="textfield2" size="4" maxlength="4" value="6" />
    </div></td>
    <td><div align="center">
      <input name="1_4" type="text" class="input" id="textfield3" size="4" maxlength="4" value="3" />
    </div></td>
    <td><div align="center">
      <input name="1_5" type="text" class="input" id="textfield4" size="4" maxlength="4" value="6" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 2 (B)</td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="2_3" type="text" class="input" id="textfield7" size="4" maxlength="4" value="4" />
    </div></td>
    <td><div align="center">
      <input name="2_4" type="text" class="input" id="textfield8" size="4" maxlength="4" value="3" />
    </div></td>
    <td><div align="center">
      <input name="2_5" type="text" class="input" id="textfield9" size="4" maxlength="4" value="7" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 3 (C)</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="3_4" type="text" class="input" id="textfield12" size="4" maxlength="4" value="7" />
    </div></td>
    <td><div align="center">
      <input name="3_5" type="text" class="input" id="textfield13" size="4" maxlength="4" value="3" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 4 (D)</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="4_5" type="text" class="input" id="textfield16" size="4" maxlength="4" value="3" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 5 (E)</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>    
  </tr>
  
</table>
<br />
<div align="center">
	<img src="rotas.png">
</div>
<br />
<br />
<table border="0" cellspacing="2" cellpadding="0" style='border: 1px solid #999;' align="center">
  <tr>
    <td>População</td>
    <td align="right"><input name="population" type="text" class="input" id="population" value="<?=$_POST['population']?>" size="5" maxlength="5" /></td>
  </tr>
  <tr>
    <td>Gerações</td>
    <td align="right"><input name="generations" type="text" class="input" id="textfield24" value="<?=$_POST['generations']?>" size="5" maxlength="5" /></td>
  </tr>
  <tr>
    <td>Mutação</td>
    <td align="right"><input name="qtdmutation" type="text" class="input" id="textfield26" value="<?=$_POST['qtdmutation']?>" size="5" maxlength="2" /></td>
  </tr>	
  <tr>
    <td>Elite (Elitism)</td>
    <td align="right"><input name="elitism" type="text" class="input" id="textfield25" value="<?=$_POST['elitism']?>" size="5" maxlength="2" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Calcular Melhor Rota" /></td>
  </tr>
</table>
</form>
<div><a href="http://www.ri.cmu.edu/pub_files/pub2/baluja_shumeet_1995_1/baluja_shumeet_1995_1.pdf" target="_blank"> <strong>Elitism: </strong> A practical variant of the general process of constructing a new population is to allow the best organism(s) from the current generation to carry over to the next, unaltered. This strategy is known as elitist selection and guarantees that the solution quality obtained by the GA will not decrease from one generation to the next. </a></div> </br>
<?php

if (!empty($_POST)) {
	ini_set('memory_limit', '-1');
	define('CITY_COUNT', 6);
	$population = $_POST['population'] + 0;
	if ($population > 999) 
		$population = 999;
		
	$generations = $_POST['generations'] + 0;
	$elitism = $_POST['elitism'] + 0;
	$qtdmutation = $_POST['qtdmutation'] + 0;
	$ratemutation = 0;
	$names = array();
	$distances = array();
	
	$initialPopulation = array();
	$currentPopulation = array();
	
	# Carregando os nomes das cidades no array
	for ($i = 1; $i <= CITY_COUNT; $i++) {
		$names[$i] = $_POST['name'.$i];
	}
	
	# Montando um array com as ditâncias entre as cidades 
	for ($i = 1; $i <= CITY_COUNT; $i++) {
		for ($j = 1; $j <= CITY_COUNT; $j++) {
			if (!empty($_POST[$i . '_' . $j]))
				$distances[$i][$j] = $_POST[$i . '_' . $j];
			else if (!empty($_POST[$j . '_' . $i]))
				$distances[$i][$j] = $_POST[$j . '_' . $i];
			else
				$distances[$i][$j] = 1979;
		}
	}
	
	$sem_repeticao = array();
	# Construindo uma população aleatoriamente sem repetição
  $i = 0;
	while($i<100) {
		$sequence = pickRandom();
		if ( empty($sem_repeticao[$sequence])) {
				$sem_repeticao[$sequence] = 1;				
		}
		$i++;	
		if (count($sem_repeticao) == $population) break;		
	}

	# Gerando População inicial com repetição (população maior que 24)
	for($i = 0; $i < $population; $i++) {
		if (!empty( $sem_repeticao[$i] )) {
				$initialPopulation[$i] = $sem_repeticao[$i];
		} else {
			$initialPopulation[$i] = pickRandom();
		}
	}
	
	for ($k = 1; $k <= $generations; $k++) {
		echo "<div><strong>Geração $k</strong></div>\n";
		# Classificando a População
		echo "<pre>";
		$i = 0;
		$distanceSum = 0;
		$biggest = 0;
		
		foreach ($initialPopulation AS $entity) {
			$currentPopulation[$i]['chromosome'] = $entity;
			$currentPopulation[$i]['rate'] = rate($entity, $distances); // calculando a taxa
			$distanceSum += $currentPopulation[$i]['rate']; // somatório da taxa
			if ($currentPopulation[$i]['rate'] > $biggest)
				$biggest = $currentPopulation[$i]['rate']; // pegando o maior valor
			$i++;
		}

		$biggest += 1;
		$chancesSum = 0;
		// Calculando a métrica para cada indivíduo da população
		for ($i = 0; $i < $population; $i++ ) {
			$currentPopulation[$i]['metric'] = $biggest - $currentPopulation[$i]['rate'];
			$chancesSum += $currentPopulation[$i]['metric'];
		}

		// Calculando as changes de cada indivíduo da população
		for ($i = 0; $i < $population; $i++ ) {
			$currentPopulation[$i]['chances'] = $currentPopulation[$i]['metric'] / $chancesSum;
		}

		// Redefinindo rates de população baixo clero
		for ($i = 0; $i < $population; $i++ ) {
			if (substr_count($currentPopulation[$i]['chromosome'], "B") != 1 || 
					substr_count($currentPopulation[$i]['chromosome'], "C") != 1 || 
					substr_count($currentPopulation[$i]['chromosome'], "D") != 1 || 
					substr_count($currentPopulation[$i]['chromosome'], "E") != 1) {
					$currentPopulation[$i]['chances'] = 0;
					$currentPopulation[$i]['floor'] = 1;
					$currentPopulation[$i]['rate'] = 1979;
			}
		}

		util::sort($currentPopulation, 'rate');
		$ceilSum = 0;
		for ($i = 0; $i < $population; $i++ ) {
			$currentPopulation[$i]['floor'] = $ceilSum;
			$ceilSum += $currentPopulation[$i]['chances'];
		}
		//var_dump($currentPopulation); exit;
		imprimirResultado($currentPopulation);

		echo "</pre>\n";
		if (converging($initialPopulation)) // Critério de parada: Quando a população for igual.
			break;

		$initialPopulation = array();
		for ($j = 0; $j < $elitism; $j++) {
			$initialPopulation[] = $currentPopulation[$j]['chromosome'];
		}

		// $moment = mt_rand(0, $population - $elitism);
		$posicaoMutacao = getPositionMutation($mutation, $population - $elitism);

		// Definindo o pai da população
		for ($j = 0; $j < $population - $elitism; $j++) {
			$rouletteMale = mt_rand(0, 100) / 100;
			
			// var_dump($rouletteMale);
			// echo "<pre>"; var_dump($currentPopulation); exit;
			for ($i = $population - 1; $i >= 0; $i--) {
				if ($currentPopulation[$i]['floor'] < $rouletteMale && $currentPopulation[$i]['chances'] != 0) {
					$dad = $currentPopulation[$i]['chromosome'];
					break;
				}
			}
			
			// Definindo a mãe da população
			$rouletteFemale = mt_rand(0, 100) / 100;
			for ($i = $population - 1; $i >= 0; $i--) {
				if ($currentPopulation[$i]['floor'] < $rouletteFemale && $currentPopulation[$i]['chances'] != 0) {
					$mom = $currentPopulation[$i]['chromosome'];
					break;
				}
			}
			
			$child = crossing($mom, $dad); // Cruzamento: gerando um novo filho

				// Mutação
				if ($ratemutation < $qtdmutation) {
					if (!empty ( $posicaoMutacao[$j] ) ) {
						$child = mutation($child);
						$ratemutation++;
					}
				}						
			$initialPopulation[] = $child;
		}
	}

	echo "<div>A melhor solução encontrada foi <strong>{$currentPopulation[0]['chromosome']}</strong> com distância total de  <strong>".rate($currentPopulation[0]['chromosome'], $distances)."</strong> que levou <strong>$k</strong> generations.</div>\n";
}
?>
</div>
</body>
</html>
<?php

// Função que retorna se todos os elementos do array são iguais
function converging($pop) {
	$items = count(array_unique($pop));
	if ($items == 1)
		return true;
	else
		return false;
}

// Função para criar rodas aleatoriamente
function pickRandom() {
	// global $sem_repeticao;
	$choices = array('B', 'C', 'D', 'E');
	srand((float)microtime()*1000000);
	shuffle($choices); // Mistura os elementos no array http://php.net/manual/pt_BR/function.shuffle.php
	array_unshift($choices, "A"); // Adiciona no inicio do array
	array_push($choices, "A"); // Adiciona no fim do array
	$sequence = implode('',$choices);

// var_dump($sequence);
	// if (!empty($sem_repeticao[$sequence])) pickRandom(); 
	// else $sem_repeticao[$sequence] = '1';
	// $sem_repeticao[$sequence] = '1';
	// return true;
	return $sequence; // transforma de array para string
}

// Função para Calcular a distância com base no DNA
function rate($dna, $distances) {
	$mileage = 0;
	$letters = str_split($dna);
	for ($i = 0; $i < CITY_COUNT - 1; $i++) {
		$mileage += $distances[string_to_number($letters[$i])][string_to_number($letters[$i+1])];
	}
	return $mileage;
}

// função para imprimir os dados
function imprimirResultado($elements) {
	echo "<table class='debug'>";
	echo "<tr><th>ID&nbsp;</th><th>DNA</th><th>Distancia</th><th>Change</th></tr>\n";
	foreach($elements as $element => $value) {
		echo "<tr><td>" . sprintf("%03s",   $element)  . "</td><td>" . $value['chromosome'] . "</td><td>" . $value['rate'] . "</td><td>" . sprintf("%01.2f", $value['chances'] * 100) . "%</td></tr>\n";
	}
	echo "</table>\n";
}

// Fazendo o cruzamento entre a mãe e o pai
function crossing($mommy, $daddy) { 
	$baby = "AAAAAA";
	
	while (substr_count($baby, 'A') != 2 || substr_count($baby, 'B') != 1 || substr_count($baby, 'C') != 1 || substr_count($baby, 'D') != 1 || substr_count($baby, 'E') != 1) {
		$baby = "";
		for($i = 0; $i < CITY_COUNT; $i++) {
			$chosen = mt_rand(0,1);
			if ($chosen)
				$baby .= substr($mommy, $i, 1);
			else
				$baby .= substr($daddy, $i, 1);
		}
	}

	return $baby;
}

// Fazendo a mutação de um filho
function mutation($baby) {
	$chosen = mt_rand(1, CITY_COUNT-2);
	echo "Mutação: " . $baby;
	$baby[$chosen] = number_to_string($chosen);
	echo " - Mutado: " . $baby;
	echo " - Elemento Mutado: " . $chosen . "<br>";
	return $baby;
}

// Converter de string para número
function string_to_number($char) {
	if ($char == 'A')
		return 1;
	else if ($char == 'B')
		return 2;
	else if ($char == 'C')
		return 3;
	else if ($char == 'D')
		return 4;
	else if ($char == 'E')
		return 5;
	else
		die("ERRO");
}

// Converter de número para string
function number_to_string($number) {
	if ($number == 0)
		return 'A';
	else if ($number == 1)
		return 'B';
	else if ($number == 2)
		return 'C';
	else if ($number == 3)
		return 'D';
	else if ($number == 4)
		return 'E';
	else
		die("ERRO");
}
// Gerar aleatoriamente o endereço da população que será feita a mutação
function getPositionMutation($mutation, $population) {
	$position = array();
	while($i<$population) {

		$chosen = mt_rand(0, $population-1);
		if (empty( $position[$chosen] )) {
			$position[$chosen] = 1;			
		} 
		$i++;

		if ( count($position) == $mutation) break;
	}	
	return $position;
}

class util {
    static private $sortfield = null;
    static private $sortorder = 1;
    static private function sort_callback(&$a, &$b) {
        if($a[self::$sortfield] == $b[self::$sortfield]) return 0;
        return ($a[self::$sortfield] < $b[self::$sortfield])? -self::$sortorder : self::$sortorder;
    }
    static function sort(&$v, $field, $asc=true) {
        self::$sortfield = $field;
        self::$sortorder = $asc? 1 : -1;
        usort($v, array('util', 'sort_callback'));
    }
}