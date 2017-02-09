<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_gramatura_m extends CI_Model {

    var $id;
    var $papel;
    var $gramatura;
    var $valor;
    var $selected = false; //boolean

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('papel_gramatura');
        if($result->num_rows() > 0){
            $result =  $this->Papel_gramatura_m->changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_by_papel_id($id){
        $this->db->where('papel', $id);
        $this->db->order_by("gramatura", "asc");
        $result = $this->db->get('papel_gramatura');
        if($result->num_rows() > 0){
            return $this->Papel_gramatura_m->changeToObject($result->result_array());
        }
        return false;
    }

    public function get_ids_by_papel_id($id_papel){
        $this->db->select("id");
        $this->db->where('papel', $id);
        return $this->db->get('papel_gramatura')->result_array();;
    }

    /*public function get_by_id_papel($id){
        $this->db->where('papel', $id);
        $result = $this->db->get('papel_gramatura');
        if($result->num_rows() > 0){
            $str = '';
            foreach ($result->result_array() as $value) {
                $str .= $value["papel_gramatura"]."g R$ ".$value["valor"]."; ";
            }
            return $str;
        }
        return false;
    }*/

    public function get_list() {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('papel_gramatura');
        return $this->Papel_gramatura_m->changeToObject($result->result_array());
    }

    public function inserir(Papel_gramatura_m $objeto) {
        if (!empty($objeto)) {
            $dados = $this->get_dados($objeto);
            if ($this->db->insert('papel_gramatura', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar(Papel_gramatura_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = $this->get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('papel_gramatura', $dados)) {
                return true;
            }
        }
        return false;
    }
    public function get_dados(Papel_gramatura_m $objeto){
        $dados = array(
            'id' => $objeto->id,
            'papel' => $objeto->papel,
            'gramatura' => $objeto->gramatura,
            'valor' => str_replace(',', '.', $objeto->valor)
            );
        return $dados;
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

    public function deletar_papel($id) {
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
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($id_papel,$colunas)
    {
        $this->db->select($colunas);
        $this->db->where("papel",$id_papel);
        return $this->db->get("papel_gramatura")->result_array();
    }
}