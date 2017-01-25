<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convite_m extends CI_Model {

	var $id;
	var $cartao; //Objeto Container_m()
	var $envelope; //Objeto Container_m()
	var $modelo; //Objeto Convite_modelo_m() x
	var $mao_obra; //Objeto Mao_obra_m() x
	var $quantidade;
	var $descricao; //String
	var $data_entrega;
	var $cancelado; //Boolean
	var $comissao; //Integer
	var $session_posicao = null; //swap na sessão orçamento
	var $is_edicao = false; //swap na sessão orçamento

	public function inserir(){
		
		$cartao = $this->cartao;
		if(!empty($cartao->container_papel) || !empty($cartao->container_impressao) || !empty($cartao->container_fita) || !empty($cartao->container_acabamento) || !empty($cartao->container_acessorio)){
			if(!$cartao->inserir()){
				return false;
			}
		}
		$envelope = $this->envelope;
		if(!empty($envelope->container_papel) || !empty($envelope->container_impressao) || !empty($envelope->container_fita) || !empty($envelope->container_acabamento) || !empty($envelope->container_acessorio)){
			if(!$envelope->inserir()){
				return false;
			}
		}

		$dados = array(
			'id'=>null,
			'modelo'=>$this->modelo->id,
			'cartao'=>$this->cartao->id,
			'envelope'=>$this->envelope->id
			);

		if(!$this->db->insert('convite',$dados)){
			return false;
		}else{
			$this->id = $this->db->insert_id();
		}
		return true;
	}
	public function get_by_orcamento_id($id){
		$this->db->where('orcamento',$id);
		$result = $this->db->get('orcamento_convite');
		if($result->num_rows() > 0){
			return $this->Convite_m->__changeToObject($result->result_array());
		}
		return array();
	}
	public function get_by_id($id){
		$this->db->where('id', $id);
		$this->db->limit(1);
		$result = $this->db->get('orcamento_convite');
		if($result->num_rows() > 0){
			$result =  $this->Convite_m->__changeToObject($result->result_array());
			return $result[0];
		}
		return false;
	}
	public function altera_data_entrega($id,$data_entrega){
		$dados = array('data_entrega'=>$data_entrega);
		$this->db->where('id',$id);
		if($this->db->update('orcamento_convite',$dados)){
			return true;
		}
		return false;
	}
	public function cancelar($id){
		$dados = array('cancelado'=>1);
		$this->db->where('id',$id);
		if($this->db->update('orcamento_convite',$dados)){
			return true;
		}
		return false;
	}
	
	//Retorna valor total do convite com os adicionais
	public function calcula_unitario(){

		return  $this->calcula_unitario_parcial() + $this->calcula_custos_administrativos_unitario();
	}
	public function calcula_total(){

		return $this->calcula_unitario() * $this->quantidade;
	}
	public function calcula_unitario_parcial(){
		return $this->cartao->calcula_total($this->modelo,$this->quantidade) + $this->envelope->calcula_total($this->modelo,$this->quantidade) + $this->calcula_mao_obra();
	}
	//Retorna o valor do convite somente com a mataria prima
	public function calcula_convite(){

		return $this->cartao->calcula_total($this->modelo,$this->quantidade) + $this->envelope->calcula_total($this->modelo,$this->quantidade);
	}
	public function calcula_convite_sub_total(){

		return $this->calcula_convite() * $this->quantidade;
	}
	public function calcula_mao_obra(){

		return ($this->mao_obra->valor * 2) + $this->mao_obra->valor;
	}
	public function calcula_mao_obra_sub_total(){

		return $this->calcula_mao_obra() * $this->quantidade;
	}
	public function calcula_custos_administrativos_unitario(){
		$total = $this->calcula_unitario_parcial() / ( (100 - $this->comissao) / 100 );
		$total = $total - $this->calcula_unitario_parcial();
        return round($total,2);
    }
    public function calcula_custos_administrativos_total(){

        return $this->calcula_custos_administrativos_unitario() * $this->quantidade;
    }
	private function __changeToObject($result_db = '') {
		$object_lista = array();
		foreach ($result_db as $key => $value) {
			$this->db->where('id',$value['convite']);
			$this->db->limit(1);
			$result = $this->db->get('convite');
			$result = $result->result()[0];
			$object = new Convite_m();
			$object->id = $value['id'];
			$object->cartao = $this->Container_m->get_by_id($result->cartao,'cartao');
			$object->envelope = $this->Container_m->get_by_id($result->envelope,'envelope');
			$object->modelo = $this->Convite_modelo_m->get_by_id($result->modelo);
			$object->mao_obra = $this->Mao_obra_m->get_by_id($value['mao_obra']);
			$object->mao_obra->valor = $value['mao_obra_valor'];
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

/* End of file Convite_m.php */
/* Location: ./application/models/Convite_m.php */