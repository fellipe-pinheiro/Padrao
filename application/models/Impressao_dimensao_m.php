<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Impressao_dimensao_m extends CI_Model {

    var $id;
    var $nome;
    var $impressao;
    var $valor_impressao;
    var $table = 'impressao_dimensao';
    var $selected = false; //boolean : setado dentro do objeto Cliche_m

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get($this->table);
        if($result->num_rows() > 0){
            $result =  $this->changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_by_modelo_id($id){
        $this->db->where('impressao', $id);
        $this->db->order_by("impressao", "asc");
        $result = $this->db->get($this->table);
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return false;
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

    public function delete_by_impressao_id($id) {
        if (!empty($id)) {
            $this->db->where('impressao', $id);
            if ($this->db->delete($this->table)) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Impressao_dimensao_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->impressao = $value['impressao'];
            $object->valor_impressao = $value['valor_impressao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($id_impressao,$colunas){
        $this->db->select($colunas);
        $this->db->where("impressao",$id_impressao);
        $this->db->order_by("nome", "asc");
        return $this->db->get($this->table)->result_array();
    }
}