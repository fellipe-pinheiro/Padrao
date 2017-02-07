<?php 
function date_to_db($data=''){
	if (!empty($data)) {
		list($dia, $mes, $ano) = explode('/', $data);
        return $data = $ano . '-' . $mes . '-' . $dia;
	}
	return "";
}

function number_to_db($number){
	if (!empty($number)) {
		//$number = str_replace(".","",$number);
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