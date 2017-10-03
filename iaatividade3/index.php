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
    <td align="center" class='cityCell'>Cidade 1</td>
    <td align="center" class='cityCell'>Cidade 2</td>
    <td align="center" class='cityCell'>Cidade 3</td>
    <td align="center" class='cityCell'>Cidade 4</td>
    <td align="center" class='cityCell'>Cidade 5</td>
  </tr>
  <tr>
    <td>Cidade 1</td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="1_2" type="text" class="input" id="textfield" size="4" maxlength="4" value="<?=$_POST['1_2']?>" />
    </div></td>
    <td><div align="center">
      <input name="1_3" type="text" class="input" id="textfield2" size="4" maxlength="4" value="<?=$_POST['1_3']?>" />
    </div></td>
    <td><div align="center">
      <input name="1_4" type="text" class="input" id="textfield3" size="4" maxlength="4" value="<?=$_POST['1_4']?>" />
    </div></td>
    <td><div align="center">
      <input name="1_5" type="text" class="input" id="textfield4" size="4" maxlength="4" value="<?=$_POST['1_5']?>" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 2</td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="2_3" type="text" class="input" id="textfield7" size="4" maxlength="4" value="<?=$_POST['2_3']?>" />
    </div></td>
    <td><div align="center">
      <input name="2_4" type="text" class="input" id="textfield8" size="4" maxlength="4" value="<?=$_POST['2_4']?>" />
    </div></td>
    <td><div align="center">
      <input name="2_5" type="text" class="input" id="textfield9" size="4" maxlength="4" value="<?=$_POST['2_5']?>" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 3</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="3_4" type="text" class="input" id="textfield12" size="4" maxlength="4" value="<?=$_POST['3_4']?>" />
    </div></td>
    <td><div align="center">
      <input name="3_5" type="text" class="input" id="textfield13" size="4" maxlength="4" value="<?=$_POST['3_5']?>" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 4</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>
    <td><div align="center">
      <input name="4_5" type="text" class="input" id="textfield16" size="4" maxlength="4" value="<?=$_POST['4_5']?>" />
    </div></td>
  </tr>
  <tr>
    <td>Cidade 5</td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td bgcolor="#CC3333"><div align="center">0</div></td>    
  </tr>
  
</table>
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
    <td>Elite</td>
    <td align="right"><input name="elitism" type="text" class="input" id="textfield25" value="<?=$_POST['elitism']?>" size="5" maxlength="2" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Calcular Melhor Rota" /></td>
  </tr>
</table>
</form>
<?php
if (!empty($_POST)) {
	define('CITY_COUNT', 6);
	$population = $_POST['population'] + 0;
	if ($population > 999) # Gotta protect my CPU...
		$population = 999;
		
	$generations = $_POST['generations'] + 0;
	$elitism = $_POST['elitism'] + 0;
	$names = array();
	$distances = array();
	
	$initialPopulation = array();
	$currentPopulation = array();
	
	# Take user city names and put it into an array
	for ($i = 1; $i <= CITY_COUNT; $i++) {
		$names[$i] = $_POST['name'.$i];
	}
	
	# Take user distance data and put it into a multidimensional array
	for ($i = 1; $i <= CITY_COUNT; $i++) {
		for ($j = 1; $j <= CITY_COUNT; $j++) {
			// var_dump($_POST[$i . '_' . $j]);
			if (!empty($_POST[$i . '_' . $j]))
				$distances[$i][$j] = $_POST[$i . '_' . $j];
			else if (!empty($_POST[$j . '_' . $i]))
				$distances[$i][$j] = $_POST[$j . '_' . $i];
			else
				$distances[$i][$j] = 32767;
		}
	}
	
	// echo "<pre>"; var_dump($distances); exit;
	// A = 1
	// D = 4
	// C = 3
	// E = 5
	// B = 2

	# Building our initial population
	for($i = 0; $i < $population; $i++) {
		$initialPopulation[$i] = pickRandom();
	}
	
	for ($k = 1; $k <= $generations; $k++) {
		echo "<div><strong>Generation $k</strong></div>\n";
		# Rating population (I do some weird math to figure out their goodness level, not sure if it is good).
		echo "<pre>";
		$i = 0;
		$distanceSum = 0;
		$biggest = 0;
		
		foreach ($initialPopulation AS $entity) {
			$currentPopulation[$i]['dna'] = $entity;
			$currentPopulation[$i]['rate'] = rate($entity, $distances);
			$distanceSum += $currentPopulation[$i]['rate'];
			if ($currentPopulation[$i]['rate'] > $biggest)
				$biggest = $currentPopulation[$i]['rate'];
			$i++;
		}
		$biggest += 1;
		$chancesSum = 0;
		for ($i = 0; $i < $population; $i++ ) {
			$currentPopulation[$i]['metric'] = $biggest - $currentPopulation[$i]['rate'];
			$chancesSum += $currentPopulation[$i]['metric'];
		}
		for ($i = 0; $i < $population; $i++ ) {
			$currentPopulation[$i]['chances'] = $currentPopulation[$i]['metric'] / $chancesSum;
		}
		util::sort($currentPopulation, 'rate');
		$ceilSum = 0;
		for ($i = 0; $i < $population; $i++ ) {
			$currentPopulation[$i]['floor'] = $ceilSum;
			$ceilSum += $currentPopulation[$i]['chances'];
		}
		debug($currentPopulation);

		echo "</pre>\n";
		if (converging($initialPopulation))
			break;
		#Breeding time
		$initialPopulation = array();
		for ($j = 0; $j < $elitism; $j++) {
			$initialPopulation[] = $currentPopulation[$j]['dna'];
		}
		for ($j = 0; $j < $population - $elitism; $j++) {
			$rouletteMale = rand(0, 100) / 100;
			
			for ($i = $population - 1; $i >= 0; $i--) {
				if ($currentPopulation[$i]['floor'] < $rouletteMale) {
					$dad = $currentPopulation[$i]['dna'];
					break;
				}
			}
			
			$rouletteFemale = rand(0, 100) / 100;
			
			for ($i = $population - 1; $i >= 0; $i--) {
				if ($currentPopulation[$i]['floor'] < $rouletteFemale) {
					$mom = $currentPopulation[$i]['dna'];
					break;
				}
			}
			
			$child = mate($mom, $dad);
			$initialPopulation[] = $child;
		}
		
	}

	echo "<div>A melhor solução encontrada foi <strong>{$currentPopulation[0]['dna']}</strong> com distância total de  <strong>".rate($currentPopulation[0]['dna'], $distances)."</strong> que levou <strong>$k</strong> generations.</div>\n";
}
?>
</div>
</body>
</html>
<?php
function converging($pop) {
	$items = count(array_unique($pop));
	if ($items == 1)
		return true;
	else
		return false;
}
function pickRandom() {
	$choices = array('B', 'C', 'D', 'E');
	shuffle($choices);
	array_unshift($choices, "A");
	array_push($choices, "A");
	return implode('',$choices);
}

function rate($dna, $distances) {
	$mileage = 0;
	$letters = str_split($dna);
	for ($i = 0; $i < CITY_COUNT - 1; $i++) {
		$mileage += $distances[let2num($letters[$i])][let2num($letters[$i+1])];
	}
	return $mileage;
}

function debug($ar) {
	echo "<table class='debug'>";
	echo "<tr><th>&nbsp;</th><th>DNA</th><th>Fit</th><th>Roulette</th></tr>\n";
	foreach($ar as $element => $value) {
		echo "<tr><td>" . leadingZero($element) . "</td><td>" . $value['dna'] . "</td><td>" . $value['rate'] . "</td><td>" . sprintf("%01.2f", $value['chances'] * 100) . "%</td></tr>\n";
	}
	echo "</table>\n";
}

function leadingZero($value) {
	if ($value < 10)
		$value = '00' . $value;
	else if ($value < 100)
		$value = '0' . $value;
	return $value;
}

function mate($mommy, $daddy) { # VERY INEFFICIENT! Combines genes randomly from both parents and if genes are repeated we do it again.
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

function let2num($char) {
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