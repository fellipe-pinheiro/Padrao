<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Impressao_cor_m extends CI_Model {

    var $id;
    var $nome;
    var $referencia;
    var $descricao;
    // Ajax 
    var $table = 'impressao_cor';
    var $column_order = array('id', 'nome','referencia', 'descricao');
    var $column_search = array('nome', 'descricao');
    var $order = array('id'=>'asc');

    private function _get_datatables_query() {
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
        $result = $this->db->get('impressao_cor');
        $result =  $this->Impressao_cor_m->_changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
            $result = $this->db->get('impressao_cor');
        } else {
            $result = $this->db->get('impressao_cor');
        }
        return $this->Impressao_cor_m->_changeToObject($result->result_array());
    }

    public function inserir(Impressao_cor_m $objeto) {
        if (!empty($objeto)) {
            $dados = array(
                'id' => $objeto->id,
                'nome' => $objeto->nome,
                'referencia' => $objeto->referencia,
                'descricao' => $objeto->descricao
                );
            if ($this->db->insert('impressao_cor', $dados)) {
                $this->session->set_flashdata('sucesso', 'Registro inserido com sucesso');
                return $this->db->insert_id();
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível inserir este registro');
                return false;
            }
        } else {
            return false;
        }
    }

    public function editar(Impressao_cor_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = array(
                'id' => $objeto->id,
                'nome' => $objeto->nome,
                'referencia' => $objeto->referencia,
                'descricao' => $objeto->descricao
                );
            $this->db->where('id', $objeto->id);
            if ($this->db->update('impressao_cor', $dados)) {
                $this->session->set_flashdata('sucesso', 'Registro editado com sucesso');
                return true;
            }
        } else {
            $this->session->set_flashdata('erro', 'Não foi possível editar este registro');
            return false;
        }
    }

    public function deletar($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('impressao_cor')) {
                $this->session->set_flashdata('sucesso', 'Registro excluido com sucesso');
                return true;
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível excluir este registro');
                return false;
            }
        } else {
            return false;
        }
    }

    function _changeToObject($result_db = '') {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Impressao_cor_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->referencia = $value['referencia'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}