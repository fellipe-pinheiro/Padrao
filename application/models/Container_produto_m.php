<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container_produto_m extends CI_Model {

	var $id;
	var $produto; //Objeto Produto_m()
	var $quantidade;
	var $descricao;
	var $data_entrega;
	var $cancelado; //Boolean
	var $comissao; //Integer

	public function get_produto($id,$quantidade,$descricao,$comissao){
		//busca a impressão pelo id
		$result = $this->Produto_m->get_list($id);
		$produto = $result[0];
		$container_produto = new Container_produto_m();
		$container_produto->produto = $produto;
		$container_produto->quantidade = $quantidade;
		$container_produto->descricao = $descricao;
		$container_produto->comissao = $comissao;
		return $container_produto;
	}
	public function get_by_orcamento_id($id){
		$this->db->where('orcamento',$id);
		$result = $this->db->get('orcamento_produto');
		if($result->num_rows() > 0){
			return $this->Container_produto_m->__changeToObject($result->result_array());
		}
		return array();
	}
	public function get_by_id($id){
		$this->db->where('id', $id);
		$this->db->limit(1);
		$result = $this->db->get('orcamento_produto');
		if($result->num_rows() > 0){
			$result =  $this->Container_produto_m->__changeToObject($result->result_array());
			return $result[0];
		}
		return false;
	}
	public function altera_data_entrega($id,$data_entrega){
		$dados = array('data_entrega'=>$data_entrega);
		$this->db->where('id',$id);
		if($this->db->update('orcamento_produto',$dados)){
			return true;
		}
		return false;
	}
	public function cancelar($id){
		$dados = array('cancelado'=>1);
		$this->db->where('id',$id);
		if($this->db->update('orcamento_produto',$dados)){
			return true;
		}
		return false;
	}
	public function calcula_unitario(){
		
		return $this->produto->valor + $this->calcula_custos_administrativos_unitario();
	}
	public function calcula_total(){

		return $this->quantidade * $this->calcula_unitario();
	}
	public function calcula_custos_administrativos_unitario(){

        return ($this->produto->valor /100) * $this->comissao;
    }
	private function __changeToObject($result_db = '') {
		$object_lista = array();
		foreach ($result_db as $key => $value) {
			$object = new Container_produto_m();
			$object->id = $value['id'];
			$object->produto = $this->Produto_m->get_by_id($value['produto']);
			$object->produto->valor = $value['valor'];
			$object->quantidade = $value['quantidade'];
			$object->descricao = $value['descricao'];
			$object->data_entrega = $this->__format_date($value['data_entrega']);
			$object->cancelado = $value['cancelado'];
			$object->comissao = $value['comissao'];
			$object_lista[] = $object;
		}
		return $object_lista;
	}
	private function __format_date($date){
		if(!empty($date)){
			list($ano,$mes,$dia) = explode('-', $date);
			return $date = $dia.'/'.$mes.'/'.$ano;
		}
		return null;
	}
}

/* End of file Container_produto_m.php */
/* Location: ./application/models/Container_produto_m.php */