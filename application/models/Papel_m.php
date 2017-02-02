<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_m extends CI_Model {

    var $id;
    var $nome;
    var $papel_linha; // Object Papel_linha_m()
    var $papel_dimensao; // Object Papel_dimensao_m()
    var $valor_80g;
    var $valor_120g;
    var $valor_180g;
    var $valor_250g;
    var $valor_300g;
    var $valor_350g;
    var $valor_400g;
    var $descricao;
    // Ajax 
    var $table = 'v_papel';
    var $column_order = array('id','pl_nome','p_nome','pd_altura','pd_largura','p_valor_80g','p_valor_120g','p_valor_180g','p_valor_250g','p_valor_300g','p_valor_350g','p_valor_400g','p_descricao',);
    var $column_search = array('pl_nome','p_nome','pd_altura','pd_largura','p_descricao',);
    var $order = array('p.nome'=>'asc');

    private function _get_datatables_query() {
        if($this->input->post('filtro_catalogo')){
            //$this->db->like('pl.nome', $this->input->post('filtro_catalogo'));
        }
        if($this->input->post('filtro_linha')){
            //$this->db->like('p.nome', $this->input->post('filtro_linha'));
        }
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
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_filtered() {
        $this->_get_datatables_query();
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
        $result = $this->db->get('papel');
        $result =  $this->Papel_m->changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('papel');
        return $this->Papel_m->changeToObject($result->result_array());
    }

    public function get_list_to_select(){
        $arr = array();
        $papel_catalogo = $this->Papel_catalogo_m->get_list();
        foreach ($papel_catalogo as $catalogo) {
            $arr[$catalogo->nome] = "$catalogo->nome $$this->nome $$this->cor";
        }
        return $arr;
    }

    public function inserir($objeto) {
        if (!empty($objeto)) {
            $dados = $this->get_dados($objeto);
            if ($this->db->insert('papel', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($objeto) {
        if ( !empty($objeto->id) ) {
            $dados = $this->get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ( $this->db->update('papel', $dados) ) {
                return true;
            }
        }
        return false;
    }

    private function get_dados($objeto){
        $dados = array(
            'id' => $objeto->id,
            'papel_linha' => $objeto->papel_linha,
            'nome' => $objeto->nome,
            'papel_dimensao' => $objeto->papel_dimensao,
            'valor_80g' => str_replace(',', '.', $objeto->valor_80g),
            'valor_120g' => str_replace(',', '.', $objeto->valor_120g),
            'valor_180g' => str_replace(',', '.', $objeto->valor_180g),
            'valor_250g' => str_replace(',', '.', $objeto->valor_250g),
            'valor_300g' => str_replace(',', '.', $objeto->valor_300g),
            'valor_350g' => str_replace(',', '.', $objeto->valor_350g),
            'valor_400g' => str_replace(',', '.', $objeto->valor_400g),
            'descricao' => $objeto->descricao
        );
        return $dados;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('papel')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_m();
            $object->id = $value['id'];
            $object->papel_linha = $this->Papel_linha_m->get_by_id($value['papel_linha']);
            $object->nome = $value['nome'];
            $object->papel_dimensao = $this->Papel_dimensao_m->get_by_id($value['papel_dimensao']);
            $object->valor_80g = $value['valor_80g'];
            $object->valor_120g = $value['valor_120g'];
            $object->valor_180g = $value['valor_180g'];
            $object->valor_250g = $value['valor_250g'];
            $object->valor_300g = $value['valor_300g'];
            $object->valor_350g = $value['valor_350g'];
            $object->valor_400g = $value['valor_400g'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_object_json(){
        $arr = array(
            "80" => $this->valor_80g,
            "120" => $this->valor_120g,
            "180" => $this->valor_180g,
            "250" => $this->valor_250g,
            "300" => $this->valor_300g,
            "350" => $this->valor_350g,
            "400" => $this->valor_400g,
            );
        return json_encode($arr);
    }

}