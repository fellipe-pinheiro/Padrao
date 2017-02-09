<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acessorio_m extends CI_Model {

    var $id;
    var $nome;
    var $descricao;
    var $valor;
    // Ajax 
    var $table = 'acessorio';
    var $column_order = array('id', 'nome', 'descricao', 'valor');
    var $column_search = array('id', 'nome', 'descricao', 'valor');
    var $order = array('id'=>'asc');

    private function get_datatables_query() {
        $this->db->select('id,nome,descricao,CONCAT("R$ ", format(valor,2,"pt_BR")) as valor');
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
        $result = $this->db->get('acessorio');
        if($result->num_rows() > 0 ){
            $result =  $this->Acessorio_m->changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_list() {
        $result = $this->db->get('acessorio');
        return $this->Acessorio_m->changeToObject($result->result_array());
    }

    public function inserir(Acessorio_m $objeto) {
        if (!empty($objeto)) {
            $dados = $this-> get_dados($objeto);
            if ($this->db->insert('acessorio', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar(Acessorio_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = $this-> get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('acessorio', $dados)) {
                return true;
            }
        }
        return false;
    }

    private function get_dados(Acessorio_m $objeto){
        $dados = array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'descricao' => $objeto->descricao,
            'valor' => str_replace(',', '.', $objeto->valor)
            );
        return $dados;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('acessorio')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Acessorio_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->descricao = $value['descricao'];
            $object->valor = $value['valor'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($colunas){
        $this->db->select($colunas);
        return $this->db->get("acessorio")->result_array();
    }

}