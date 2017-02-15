<?php 
function date_to_db($data=''){
	if (!empty($data)) {
		if (strpos($data, '/') !== false) {// Aceita os formatos: dd/mm/yyyy - yyyy/mm/dd
			list($dia, $mes, $ano) = explode('/', $data);
			if(strlen($dia) === 2){
	        	return $data = $ano . '-' . $mes . '-' . $dia;
			}else if(strlen($dia) === 4){
				list($ano, $mes, $dia) = explode('/', $data);
				return $data = $ano . '-' . $mes . '-' . $dia;
			}
		}else if(strpos($data, '-') !== false){// Aceita os formatos: dd-mm-yyyy - yyyy-mm-dd
			list($dia, $mes, $ano) = explode('-', $data);
			if(strlen($dia) === 2){
	        	return $data = $ano . '-' . $mes . '-' . $dia;
			}else if(strlen($dia) === 4){
				return $data;
			}
		}
	}
	return "";
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

 ?>