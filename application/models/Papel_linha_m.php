<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_linha_m extends CI_Model {

    var $id;
    var $nome;
    var $descricao;
    // Ajax 
    var $table = 'papel_linha';
    var $column_order = array('id', 'nome', 'descricao');
    var $column_search = array('nome', 'descricao');
    var $order = array('id'=>'asc');

    private function _get_datatables_query() {
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
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered() {
        $this->_get_datatables_query();
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
        $result = $this->db->get('papel_linha');
        $result =  $this->Papel_linha_m->changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list() {
        $result = $this->db->get('papel_linha');
        return $this->Papel_linha_m->changeToObject($result->result_array());
    }

    public function inserir($objeto) {
        if (!empty($objeto)) {
            $dados = $this->get_dados($objeto);
            if ($this->db->insert('papel_linha', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($objeto) {
        if (!empty($objeto->id)) {
            $dados = $this->get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('papel_linha', $dados)) {
                return true;
            }
        }
        return false;
    }

    private function get_dados($objeto){
        $dados = array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'descricao' => $objeto->descricao
            );
        return $dados; 
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('papel_linha')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_linha_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($colunas){
        $this->db->select($colunas);
        $this->db->order_by("nome", "asc");
        return $this->db->get("papel_linha")->result_array();
    }
}