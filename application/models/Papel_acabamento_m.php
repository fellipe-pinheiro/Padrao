<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_acabamento_m extends CI_Model {

    var $id;
    var $nome;
    var $codigo;
    var $qtd_minima;
    var $descricao;
    var $valor;
    // Ajax 
    var $table = 'papel_acabamento';
    var $column_order = array('id', 'nome','codigo','qtd_minima', 'descricao', 'valor');
    var $column_search = array('nome','codigo', 'descricao');
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
        $result = $this->db->get('papel_acabamento');
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function get_by_codigo($codigo){
        $this->db->where('codigo', $codigo);
        $this->db->limit(1);
        $result = $this->db->get('papel_acabamento');
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return null;
    }    

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('papel_acabamento', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('papel_acabamento', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('papel_acabamento')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Papel_acabamento_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->codigo = $value['codigo'];
            $object->qtd_minima = $value['qtd_minima'];
            $object->descricao = $value['descricao'];
            $object->valor = $value['valor'];
        }
        return $object;
    }

    public function get_pesonalizado($colunas){
        $this->db->select($colunas);
        $this->db->order_by("nome", "asc");
        return $this->db->get("papel_acabamento")->result_array();
    }

    public function get_codigo_nome($colunas){
        $this->db->select($colunas);
        $this->db->order_by("nome", "asc");
        $papel_acabamento = $this->db->get("papel_acabamento")->result_array();
        $array_aux = array();
        foreach ($papel_acabamento as $key => $value) {
            $array_aux[$value['codigo']] = $value['nome'];
        }
        return $array_aux;
    }    

}