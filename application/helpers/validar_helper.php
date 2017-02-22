<?php
function decimal_positive($value){
	if($value < 0){
		return false;
	}
	return true;
}

function decimal_positive_no_zero($value){
    if($value <= 0){
        return false;
    }
    return true;
}

function validar_cpf($strCPF) {	
	if(!empty($strCPF)){
		$strCPF = preg_replace('/[^0-9]/', '', (string) $strCPF);

		if ($strCPF == '00000000000' || $strCPF == '11111111111' || $strCPF == '22222222222' || $strCPF == '33333333333' || $strCPF == '44444444444' || $strCPF == '55555555555' || $strCPF == '66666666666' || $strCPF == '77777777777' || $strCPF == '88888888888' || $strCPF == '99999999999') {
			return false;
		}
		$arrayCPF = str_split($strCPF);
		if(count($arrayCPF) != 11){
			return false;
		}
		$soma = 0;
		for ($i=1; $i<=9; $i++) {
			$soma = $soma + intval($arrayCPF[$i-1]) * (11 - $i);
		}
		$resto = ($soma * 10) % 11;
		if (($resto === 10) || ($resto === 11))  $resto = 0;
		if ($resto != intval($arrayCPF[9]) ) return false;
		$soma = 0;
		for ($i = 1; $i <= 10; $i++) { 
			$soma = $soma + intval($arrayCPF[$i-1]) * (12 - $i);
		}
		$resto = ($soma * 10) % 11;
		if (($resto === 10) || ($resto === 11))  $resto = 0;
		if ($resto != intval($arrayCPF[10] ) ) return false;
		return true;
	}else{
		return true;
	}
}

function validar_rg($rg){
	$rg = preg_replace('/[^0-9]/', '', (string) $rg);
	$rg = str_split($rg);
	$tamanho = count($rg);
	$vetor = array($tamanho);

	if($tamanho>=1){
		$vetor[0] = intval($rg[0]) * 2; 
	}
	if($tamanho>=2){
		$vetor[1] = intval($rg[1]) * 3; 
	}
	if($tamanho>=3){
		$vetor[2] = intval($rg[2]) * 4; 
	}
	if($tamanho>=4){
		$vetor[3] = intval($rg[3]) * 5; 
	}
	if($tamanho>=5){
		$vetor[4] = intval($rg[4]) * 6; 
	}
	if($tamanho>=6){
		$vetor[5] = intval($rg[5]) * 7; 
	}
	if($tamanho>=7){
		$vetor[6] = intval($rg[6]) * 8; 
	}
	if($tamanho>=8){
		$vetor[7] = intval($rg[7]) * 9; 
	}
	if($tamanho>=9){
		$vetor[8] = intval($rg[8]) * 100; 
	}

	$total = 0;

	if($tamanho>=1){
		$total += $vetor[0];
	}
	if($tamanho>=2){
		$total += $vetor[1]; 
	}
	if($tamanho>=3){
		$total += $vetor[2]; 
	}
	if($tamanho>=4){
		$total += $vetor[3]; 
	}
	if($tamanho>=5){
		$total += $vetor[4]; 
	}
	if($tamanho>=6){
		$total += $vetor[5]; 
	}
	if($tamanho>=7){
		$total += $vetor[6];
	}
	if($tamanho>=8){
		$total += $vetor[7]; 
	}
	if($tamanho>=9){
		$total += $vetor[8]; 
	}


	$resto = $total % 11;
	if($resto!=0){
		
		return false;
	}
	else{
		return true;
	}
}

function validar_cnpj($cnpj){
	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
	if (strlen($cnpj) != 14)
		return false;
	if ($cnpj == "00000000000000" || 
		$cnpj == "11111111111111" || 
		$cnpj == "22222222222222" || 
		$cnpj == "33333333333333" || 
		$cnpj == "44444444444444" || 
		$cnpj == "55555555555555" || 
		$cnpj == "66666666666666" || 
		$cnpj == "77777777777777" || 
		$cnpj == "88888888888888" || 
		$cnpj == "99999999999999")
		return false;
        // Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
        // Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}

function check_white_spaces($string){//Verifica se a string tem espaços PS: utilizado para validar códigos
    if(preg_match('/\s/',$string)){
        return false;
    }
    return true;
}

function date_before_today($date) {
    $date = date_to_db($date);
    $today = date('Y/m/d');
    if (strtotime($date) >= strtotime($today)) {
        return true;
    }
    return false;
}

function validate_date($data) {
	if (strpos($data, '/') !== false) {
    	list($dia, $mes, $ano) = explode('/', $data);
    	if(strlen($dia) === 4){
    		list($ano, $mes, $dia) = explode('/', $data);
    	}
	}else if (strpos($data, '-') !== false) {
		list($dia, $mes, $ano) = explode('-', $data);
		if(strlen($dia) === 4){
    		list($ano, $mes, $dia) = explode('-', $data);
    	}
	}
    return checkdate($mes, $dia, $ano);
}

