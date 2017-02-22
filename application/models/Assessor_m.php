<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_m extends CI_Model {

    var $id;
    var $nome;
    var $sobrenome;
    var $email;
    var $telefone;
    var $empresa;
    var $comissao;
    var $descricao;
    // Ajax
    var $table = 'assessor';
    var $column_order = array('id', 'nome', 'sobrenome','empresa','telefone', 'email','comissao','descricao');
    var $column_search = array('nome', 'sobrenome','email','empresa');
    var $order = array('id'=>'asc');

    private function get_datatables_query() {
        if($this->input->post('filtro_id')){
            $this->db->where('id', $this->input->post('filtro_id'));
        }
        if($this->input->post('filtro_nome')){
            $this->db->where('nome', $this->input->post('filtro_nome'));
        }
        if($this->input->post('filtro_sobrenome')){
            $this->db->like('sobrenome', $this->input->post('filtro_sobrenome'));
        }
        if($this->input->post('filtro_telefone')){
            $this->db->where('telefone',$this->input->post('filtro_telefone'));
        }
        if($this->input->post('filtro_email')){
            $this->db->where('email', $this->input->post('filtro_email'));
        }
        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
                }
                $i++;
            }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables() {
        $this->get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('assessor');
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return new Assessor_m();
    }

    public function get_by_pedido_id($id){
        $this->db->select('
            ped.id as pedido_id,
            ped.orcamento as orcamento_id,
            orc.assessor as assessor_id,
            asr.*,
            ');
        $this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
        $this->db->join('assessor as asr', 'orc.assessor = asr.id', 'left');
        $this->db->where('ped.id', $id);
        $this->db->from('pedido as ped');
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            $result =  $this->changeToObject($result->result_array());
            return $result[0];
        }
        return new Assessor_m();
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if($this->db->insert('assessor', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('assessor', $dados)) {
                return $dados['id'];
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('assessor')) {
                return true;
            }
        }
        return false;
    }
    
    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Assessor_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->sobrenome = $value['sobrenome'];
            $object->email = $value['email'];
            $object->telefone = $value['telefone'];
            $object->empresa = $value['empresa'];
            $object->descricao = $value['descricao'];
            $object->comissao = $value['comissao'];
        }
        return $object;
    }

}