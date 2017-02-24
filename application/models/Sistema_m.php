<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_m extends CI_Model {

    var $id;
    var $nome;
    var $valor;

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('sistema');
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function get_by_nome($nome){
        $this->db->where('nome', $nome);
        $this->db->limit(1);
        $result = $this->db->get('sistema');
        if($result->num_rows() > 0){
            return $result->result()[0]->valor;
        }
        return null;
    }

    public function get_list(){
        $result = $this->db->get('sistema');
        if($result->num_rows() > 0){
            $data = array();
            foreach ($result->result() as $key => $value) {
                $data[$value->nome] = $value->valor;
            }
            return $data;
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('sistema', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados)) {
            $this->db->trans_start();
            foreach ($dados as $key => $value) {
                $data = array("nome" =>$key,"valor"=>$value);
                $this->db->replace('sistema', $data);
            }
            $this->db->trans_complete();
            return $this->db->trans_status();
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('sistema')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Sistema_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->valor = $value['valor'];
        }
        return $object;
    }
}