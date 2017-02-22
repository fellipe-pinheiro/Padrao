<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fita_espessura_m extends CI_Model {

    var $id;
    var $esp_03mm;
    var $esp_07mm;
    var $esp_10mm;
    var $esp_15mm;
    var $esp_22mm;
    var $esp_38mm;
    var $esp_50mm;
    var $esp_70mm;
    // Ajax 
    var $table = 'fita_espessura';
    var $column_order = array('id', 'esp_03mm', 'esp_07mm', 'esp_10mm', 'esp_15mm', 'esp_22mm', 'esp_38mm', 'esp_50mm', 'esp_70mm');
    var $column_search = array('nome');
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
        $result = $this->db->get('fita_espessura');
        if($result->num_rows() > 0){
            $result =  $this->changeToObject($result->result_array());
            return $result[0];
        }
        return null;
    }

    public function get_list() {
        $result = $this->db->get('fita_espessura');
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('fita_espessura', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('fita_espessura', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('fita_espessura')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Fita_espessura_m();
            $object->id = $value['id'];
            $object->esp_03mm = $value['esp_03mm'];
            $object->esp_07mm = $value['esp_07mm'];
            $object->esp_10mm = $value['esp_10mm'];
            $object->esp_15mm = $value['esp_15mm'];
            $object->esp_22mm = $value['esp_22mm'];
            $object->esp_38mm = $value['esp_38mm'];
            $object->esp_50mm = $value['esp_50mm'];
            $object->esp_70mm = $value['esp_70mm'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}