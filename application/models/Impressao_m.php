<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Impressao_m extends CI_Model {

    var $id;
    var $nome;
    var $impressao_area;
    var $descricao;
    var $valor;
    var $ativo;
    // Ajax 
    var $table = 'impressao as i';
    var $column_order = array('i.id','i.nome', 'ia.nome','i.descricao','i.valor','i.ativo');
    var $column_search = array('i.nome', 'ia.nome','i.descricao');
    var $order = array('i.id'=>'asc');

    private function get_datatables_query() {
        $this->db->select('
            i.id as i_id,
            i.nome as i_nome,
            i.descricao as i_descricao,
            i.ativo as i_ativo,
            CONCAT("R$ ", format(valor,2,"pt_BR")) as i_valor,
            ia.nome as ia_nome');
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
        $this->db->join('impressao_area as ia', 'i.impressao_area = ia.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered() {
        $this->get_datatables_query();
        $this->db->join('impressao_area as ia', 'i.impressao_area = ia.id', 'left');
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
        $result = $this->db->get('impressao');
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('impressao', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('impressao', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('impressao')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Impressao_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->impressao_area = $this->Impressao_area_m->get_by_id($value['impressao_area']);
            $object->descricao = $value['descricao'];
            $object->valor = $value['valor'];
            $object->ativo = $value['ativo'];
        }
        return $object;
    }

    public function get_pesonalizado($id_area, $colunas, $ativo = '1'){
        $this->db->select($colunas);
        $this->db->where("impressao_area",$id_area);
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
        $this->db->order_by("nome", "asc");
        return $this->db->get("impressao")->result_array();
    }
}