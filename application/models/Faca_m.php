<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faca_m extends CI_Model {

    var $id;
    var $nome;
    var $qtd_minima;
    var $dimensoes; // Array de Objetos Faca_dimensao_m
    var $descricao;
    var $ativo;
    // Ajax 
    var $table = 'faca';
    var $column_order = array('id','nome','qtd_minima','descricao','ativo');
    var $column_search = array('id','nome','ativo');
    var $order = array('id'=>'asc');

    private function get_datatables_query() {

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
        $result = $this->db->get($this->table);
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert($this->table, $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update($this->table, $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete($this->table)) {
                return true;
            }
        }
        return false;
    }

    public function set_faca_dimensao($id,$valor_servico = 0,$valor_faca = 0,$atualizar = false){
        foreach ($this->dimensoes as $value) {
            if($value->id === $id){
                $value->selected = true;
                if($atualizar){
                    $value->valor_servico = $valor_servico;
                    $value->valor_faca = $valor_faca;
                }
            }else{
                $value->selected = false;
            }
        }
    }

    public function get_selected_faca_dimensao(){
        foreach ($this->dimensoes as $object) {
            if($object->selected){
                return $object;
            }
        }
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Faca_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->qtd_minima = $value['qtd_minima'];
            $object->dimensoes = $this->Faca_dimensao_m->get_by_modelo_id($object->id);
            $object->descricao = $value['descricao'];
            $object->ativo = $value['ativo'];
        }
        return $object;
    }

    public function get_pesonalizado($colunas, $ativo = '1'){
        $this->db->select($colunas);
        switch ($ativo) {
            case '-1':
            break;
            case '0':
            $this->db->where("ativo", false);
            break;
            case '1':
            $this->db->where("ativo", true);
            break;
            default:
            $this->db->where("ativo", true);
            break;
        }
        return $this->db->get($this->table)->result_array();
    }

}