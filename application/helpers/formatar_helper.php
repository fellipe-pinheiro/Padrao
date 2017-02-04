<?php 
function date_to_db($data=''){
	if (!empty($data)) {
		list($dia, $mes, $ano) = explode('/', $data);
        return $data = $ano . '-' . $mes . '-' . $dia;
	}
	return "";
}


 ?>