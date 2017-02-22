<?php 
function date_to_db($data=''){ //[dd/mm/yyyy] [yyyy/mm/dd] [dd-mm-yyyy] [yyyy-mm-dd] => Return [yyyy-mm-dd]
	if (!empty($data)) {
		if (strpos($data, '/') !== false) {
			list($dia, $mes, $ano) = explode('/', $data);
			if(strlen($dia) === 2){
	        	return $ano . '-' . $mes . '-' . $dia;
			}else if(strlen($dia) === 4){
				list($ano, $mes, $dia) = explode('/', $data);
				return $ano . '-' . $mes . '-' . $dia;
			}
		}else if(strpos($data, '-') !== false){
			list($dia, $mes, $ano) = explode('-', $data);
			if(strlen($dia) === 2){
	        	return $ano . '-' . $mes . '-' . $dia;
			}else if(strlen($dia) === 4){
				return $data;
			}
		}
	}
	return "";
}

function date_to_form($data=''){ //[dd/mm/yyyy] [yyyy/mm/dd] [dd-mm-yyyy] [yyyy-mm-dd] => Return [dd/mm/yyyy]
	if (!empty($data)) {
		if(strpos($data, '-') !== false){
			list($ano, $mes, $dia) = explode('-', $data);
			if(strlen($ano) === 4){
	        	return $dia . '/' . $mes . '/' . $ano;
			}else if(strlen($dia) === 4){
				list($dia, $mes, $ano) = explode('-', $data);
				return $dia . '/' . $mes . '/' . $ano;
			}
		}else if(strpos($data, '/') !== false){
			list($ano, $mes, $dia) = explode('/', $data);
			if(strlen($ano) === 4){
	        	return $dia . '/' . $mes . '/' . $ano;
			}else if(strlen($dia) === 4){
				list($dia, $mes, $ano) = explode('/', $data);
				return $dia . '/' . $mes . '/' . $ano;
			}
		}

	}
	return "";
}

function no_leading_zeroes($string){//retira os zeros da frente de um número ex: 0009 => 9
    return preg_replace('/^0+/','', $string);
}

function number_to_db($number){
	if (!empty($number)) {
		$number = str_replace(",",".",$number);
		return $number;
	}
}

function int_to_db($number){
	if (!empty($number)) {
		return round($number, 0);
	}
}

function round_down($number, $precision = 3) {
    $fig = (int) str_pad('1', $precision, '0');
    return (floor($number * $fig) / $fig);
}
