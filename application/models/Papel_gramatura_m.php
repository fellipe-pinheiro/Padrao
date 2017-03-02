<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_gramatura_m extends CI_Model {

    var $id;
    var $papel;
    var $gramatura;
    var $valor;
    var $ativo;
    var $selected = false; //boolean

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('papel_gramatura');
        if($result->num_rows() > 0){
            $result =  $this->changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_by_papel_id($id){
        $this->db->where('papel', $id);
        $this->db->order_by("gramatura", "asc");
        $result = $this->db->get('papel_gramatura');
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return false;
    }

    public function get_ids_by_papel_id($id_papel){
        $this->db->select("id");
        $this->db->where('papel', $id);
        return $this->db->get('papel_gramatura')->result_array();;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('papel_gramatura', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('papel_gramatura', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('papel_gramatura')) {
                return true;
            }
        }
        return false;
    }

    public function delete_by_papel_id($id) {
        if (!empty($id)) {
            $this->db->where('papel', $id);
            if ($this->db->delete('papel_gramatura')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_gramatura_m();
            $object->id = $value['id'];
            $object->papel = $value['papel'];
            $object->gramatura = $value['gramatura'];
            $object->valor = $value['valor'];
            $object->ativo = $value['ativo'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($id_papel,$colunas)
    {
        $this->db->select($colunas);
        $this->db->where("papel",$id_papel);
        $this->db->where("ativo",true);
        $this->db->order_by("gramatura", "asc");
        return $this->db->get("papel_gramatura")->result_array();
    }
}