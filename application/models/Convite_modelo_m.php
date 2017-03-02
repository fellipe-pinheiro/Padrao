<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convite_modelo_m extends CI_Model {

    var $id;
    var $codigo;
    var $nome;
    var $altura_final;
    var $largura_final;
    var $cartao_altura;
    var $cartao_largura;
    var $envelope_altura;
    var $envelope_largura;
    var $empastamento_borda;
    var $descricao;
    var $ativo;
    // Ajax 
    var $table = 'convite_modelo';
    var $column_order = array('id','codigo','nome','altura_final','largura_final','cartao_altura','cartao_largura','envelope_altura','envelope_largura','empastamento_borda','descricao','ativo');
    var $column_search = array('id','codigo','nome','altura_final','largura_final','cartao_altura','cartao_largura','envelope_altura','envelope_largura','empastamento_borda','descricao','ativo');
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
        $result = $this->db->get('convite_modelo');
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('convite_modelo', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('convite_modelo', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('convite_modelo')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Convite_modelo_m();
            $object->id = $value['id'];
            $object->codigo = $value['codigo'];
            $object->nome = $value['nome'];
            $object->altura_final = $value['altura_final'];
            $object->largura_final = $value['largura_final'];
            $object->cartao_altura = $value['cartao_altura'];
            $object->cartao_largura = $value['cartao_largura'];
            $object->envelope_altura = $value['envelope_altura'];
            $object->envelope_largura = $value['envelope_largura'];
            $object->empastamento_borda = $value['empastamento_borda'];
            $object->descricao = $value['descricao'];
            $object->ativo = $value['ativo'];
        }
        return $object;
    }

    public function get_pesonalizado($colunas){
        $this->db->select($colunas);
        return $this->db->get("convite_modelo")->result_array();
    }

}