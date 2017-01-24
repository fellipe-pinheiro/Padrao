<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producao_convite_m extends CI_Model {

	var $id;
	var $convite_id;
	
	public function inserir_ids($ids,$adicional){
		if($adicional){
			foreach ($ids as $key => $id) {
				$dados = array(
					'id' => null,
					'adicional_convite' => $id
					);
				$this->db->insert('producao_adicional_convite', $dados);
			}
		}else{
			foreach ($ids as $key => $id) {
				$dados = array(
					'id' => null,
					'orcamento_convite' => $id
					);
				$this->db->insert('producao_orcamento_convite', $dados);
			}
		}
	}

}

/* End of file Producao_convite_m.php */
/* Location: ./application/models/Producao_convite_m.php */