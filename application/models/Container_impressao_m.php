<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container_impressao_m extends CI_Model {

	var $id;
	var $impressao; //Objeto Impressao_m()
	var $owner; 
	var $quantidade;
	var $descricao;

	public function inserir($id){
		if($this->owner == 'cartao'){
			$tabela = 'cartao_impressao';
			$coluna = 'cartao';
		}else if($this->owner == 'envelope'){
			$tabela = 'envelope_impressao';
			$coluna = 'envelope';
		}else if($this->owner == 'personalizado'){
			$tabela = 'personalizado_impressao';
			$coluna = 'personalizado';
		}else{
			return false;
		}
		$dados = array(
			'id' => NULL,
			'impressao' => $this->impressao->id,
			$coluna => $id,
			'quantidade' => $this->quantidade,
			'descricao' => $this->descricao,
			'valor' => $this->impressao->valor,
			);
		if ($this->db->insert($tabela, $dados)) {
			$this->id = $this->db->insert_id();
		}else{
			return false;
		}
		return true;
	}
	public function get_by_container_id($id,$owner){
		//Seto a tabela destino
		if($owner == 'cartao'){
			$tabela = 'cartao_impressao';
			$coluna = 'cartao';
		}else if($owner == 'envelope'){
			$tabela = 'envelope_impressao';
			$coluna = 'envelope';
		}else if($owner == 'personalizado'){
			$tabela = 'personalizado_impressao';
			$coluna = 'personalizado';
		}else{
			return false;
		}
		$this->db->where($coluna, $id);
		$result = $this->db->get($tabela);
		if(!empty($result->num_rows())){
			return $result =  $this->Container_impressao_m->__changeToObject($result->result_array(),$owner);
		}
		return array();
	}
	
	//CALCULA: valor unitário da impressao
	public function calcula_valor_unitario($qtd){
		if($qtd < 100){
			return round($this->impressao->valor / $qtd,2);
		}
		return round($this->impressao->valor / 100,2);
	}
	//CALCULA: valor total
	public function calcula_valor_total($qtd,$valor_unitario){

		return $qtd * $valor_unitario;
	}
	private function __changeToObject($result_db = '',$owner) {
		$object_lista = array();
		foreach ($result_db as $key => $value) {
			$object = new Container_impressao_m();
			$object->id = $value['id'];
			$object->impressao = $this->Impressao_m->get_by_id($value['impressao']);
			$object->impressao->valor = $value['valor'];
			$object->owner = $owner;
			$object->quantidade = $value['quantidade'];
			$object->descricao = $value['descricao'];
			$object_lista[] = $object;
		}
		return $object_lista;
	}
}

/* End of file Container_impressao_m.php */
/* Location: ./application/models/Container_impressao_m.php */