<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personalizado_modelo_m extends CI_Model {

    var $id;
    var $codigo;
    var $nome;
    var $dimensoes; // Array de Objetos Personalizado_modelo_dimensao_m
    var $personalizado_categoria;
    var $descricao;
    var $valor;
    var $ativo;
    // Ajax 
    var $table = 'personalizado_modelo as pm';
    var $column_order = array('pm.id','pm.personalizado_categoria','pc.nome','pm.nome','pm.codigo', 'pm.descricao', 'pm.valor','pm.ativo');
    var $column_search = array('pm.id','pm.personalizado_categoria','pc.nome','pm.nome','pm.codigo', 'pm.descricao', 'pm.valor','pm.ativo'); 
    var $order = array('pm.id'=>'asc');

    private function get_datatables_query() {
        $this->db->select('
            pm.id as pm_id,
            pm.personalizado_categoria as pm_personalizado_categoria,
            pm.codigo as pm_codigo,
            pm.nome as pm_nome,
            pm.descricao as pm_descricao,
            pm.ativo as pm_ativo,
            CONCAT("R$ ", format(pm.valor,2,"pt_BR")) as pm_valor,
            pc.nome as pc_nome,
            ');
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
        $this->db->join('personalizado_categoria as pc', 'pm.personalizado_categoria = pc.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered() {
        $this->get_datatables_query();
        $this->db->join('personalizado_categoria as pc', 'pm.personalizado_categoria = pc.id', 'left');
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
        $result = $this->db->get('personalizado_modelo');
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('personalizado_modelo', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('personalizado_modelo', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('personalizado_modelo')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Personalizado_modelo_m();
            $object->id = $value['id'];
            $object->codigo = $value['codigo'];
            $object->nome = $value['nome'];
            $object->dimensoes = $this->Personalizado_modelo_dimensao_m->get_by_modelo_id($object->id);
            $object->descricao = $value['descricao'];
            $object->valor = $value['valor'];
            $object->personalizado_categoria = $this->Personalizado_categoria_m->get_by_id($value['personalizado_categoria']);
            $object->ativo = $value['ativo'];
        }
        return $object;
    }

    public function get_pesonalizado($id_categoria,$colunas, $ativo = '1'){
        $this->db->select($colunas);
        $this->db->where("personalizado_categoria",$id_categoria);
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
        return $this->db->get("personalizado_modelo")->result_array();
    }

}