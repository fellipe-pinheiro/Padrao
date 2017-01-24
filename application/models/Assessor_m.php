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
    var $column_order = array('id', 'nome', 'sobrenome','empresa','telefone', 'email','comissao','descricao'); //set column field database for datatable orderable
    var $column_search = array('nome', 'sobrenome','email','empresa'); //set column field database for datatable searchable just nome , descricao are searchable
    var $order = array('id'=>'asc'); // default order 

    // Ajax Nao alterar
    private function _get_datatables_query() {
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

        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    // Ajax Nao alterar
    public function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    // Ajax Nao alterar
    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    // Ajax Nao alterar
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('assessor');
        if($result->num_rows() > 0){
            $result =  $this->Assessor_m->_changeToObject($result->result_array());
            return $result[0];
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
            $result =  $this->Assessor_m->_changeToObject($result->result_array());
            return $result[0];
        }
        return new Assessor_m();
    }

    public function get_list($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('assessor');
        return $this->Assessor_m->_changeToObject($result->result_array());
    }
    public function inserir(Assessor_m $objeto) {
        if (!empty($objeto)) {
            $dados = $this->__get_dados($objeto);
            if($this->db->insert('assessor', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }
    public function editar(Assessor_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = $this->__get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('assessor', $dados)) {
                return $objeto->id;
            }
        } else {
            return false;
        }
    }
    private function __get_dados(Assessor_m $objeto){
        $dados = array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'sobrenome' => $objeto->sobrenome,
            'email' => $objeto->email,
            'telefone' => $objeto->telefone,
            'empresa' => $objeto->empresa,
            'descricao' => $objeto->descricao,
            'comissao' => $objeto->comissao,
            );
        return $dados;
    }
    public function deletar($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('assessor')) {
                return true;
            }
        }
        return false;
    }
    function _changeToObject($result_db = '') {
        $object_lista = array();
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
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}