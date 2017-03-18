<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convite_modelo_dimensao_m extends CI_Model {

    var $id;
    var $nome;
    var $modelo;
    var $altura;
    var $largura;
    var $destino; //[0 = dimensao final] / [1= cartao]/ [2 = envelope] / [-1 = cartao/envelope]

    //var $selected = false; //boolean

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('convite_modelo_dimensao');
        if($result->num_rows() > 0){
            $result =  $this->changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_by_modelo_id($id){
        $this->db->where('modelo', $id);
        $this->db->order_by("modelo", "asc");
        $result = $this->db->get('convite_modelo_dimensao');
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return false;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('convite_modelo_dimensao', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('convite_modelo_dimensao', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('convite_modelo_dimensao')) {
                return true;
            }
        }
        return false;
    }

    public function delete_by_modelo_id($id) {
        if (!empty($id)) {
            $this->db->where('modelo', $id);
            if ($this->db->delete('convite_modelo_dimensao')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Convite_modelo_dimensao_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->modelo = $value['modelo'];
            $object->altura = $value['altura'];
            $object->largura = $value['largura'];
            $object->destino = $value['destino'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($id_modelo,$colunas)
    {
        $this->db->select($colunas);
        $this->db->where("modelo",$id_modelo);
        $this->db->order_by("nome", "asc");
        return $this->db->get("convite_modelo_dimensao")->result_array();
    }
}