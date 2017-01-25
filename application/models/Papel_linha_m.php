<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_linha_m extends CI_Model {

    var $id;
    var $nome;
    var $papel_catalogo;
    var $descricao;
    var $valor_80g;
    var $valor_120g;
    var $valor_180g;
    var $valor_250g;
    var $valor_300g;
    var $valor_350g;
    var $valor_400g;
    // Ajax 
    var $table = 'papel_linha as pl';
    var $column_order = array('id', 'pc.nome', 'pl.nome','pl.valor_80g','pl.valor_120g','pl.valor_180g','pl.valor_250g','pl.valor_300g','pl.valor_350g','pl.valor_400g','descricao'); //set column field database for datatable orderable
    var $column_search = array('pl.nome', 'pc.nome'); //set column field database for datatable searchable just nome , descricao are searchable
    var $order = array('pl.id'=>'asc'); // default order 

    // Ajax Nao alterar
    private function _get_datatables_query() {
        if($this->input->post('filtro_catalogo')){
            $this->db->like('pc.nome', $this->input->post('filtro_catalogo'));
        }
        if($this->input->post('filtro_linha')){
            $this->db->like('pl.nome', $this->input->post('filtro_linha'));
        }
        $this->db->select('pl.id,pl.nome as pl_nome,pl.descricao as pl_descricao,pc.nome as pc_nome,pl.valor_80g as pl_valor_80g,pl.valor_120g as pl_valor_120g,pl.valor_180g as pl_valor_180g,pl.valor_250g as pl_valor_250g,pl.valor_300g as pl_valor_300g,pl.valor_350g as pl_valor_350g,pl.valor_400g as pl_valor_400g');
        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    // Ajax Nao alterar
    public function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->join('papel_catalogo as pc', 'pl.papel_catalogo = pc.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    // Ajax Nao alterar
    public function count_filtered() {
        $this->_get_datatables_query();
        $this->db->join('papel_catalogo as pc', 'pl.papel_catalogo = pc.id', 'left');
        $query = $this->db->get();
        return $query->num_rows();
    }
    // Ajax Nao alterar
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('papel_linha');
        $result =  $this->Papel_linha_m->__changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
            $result = $this->db->get('papel_linha');
        } else {
            $result = $this->db->get('papel_linha');
        }
        return $this->Papel_linha_m->__changeToObject($result->result_array());
    }

    public function inserir(Papel_linha_m $objeto) {
        if (!empty($objeto)) {
            $dados = array(
                'id' => $objeto->id,
                'nome' => $objeto->nome,
                'papel_catalogo' => $objeto->papel_catalogo,
                'descricao' => $objeto->descricao,
                'valor_80g' => str_replace(',', '.', $objeto->valor_80g),
                'valor_120g' => str_replace(',', '.', $objeto->valor_120g),
                'valor_180g' => str_replace(',', '.', $objeto->valor_180g),
                'valor_250g' => str_replace(',', '.', $objeto->valor_250g),
                'valor_300g' => str_replace(',', '.', $objeto->valor_300g),
                'valor_350g' => str_replace(',', '.', $objeto->valor_350g),
                'valor_400g' => str_replace(',', '.', $objeto->valor_400g)
            );
            if ($this->db->insert('papel_linha', $dados)) {
                $this->session->set_flashdata('sucesso', 'Registro inserido com sucesso');
                return $this->db->insert_id();
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível inserir este registro');
                return false;
            }
        } else {
            return false;
        }
    }

    public function editar(Papel_linha_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = array(
                'id' => $objeto->id,
                'nome' => $objeto->nome,
                'papel_catalogo' => $objeto->papel_catalogo,
                'descricao' => $objeto->descricao,
                'valor_80g' => str_replace(',', '.', $objeto->valor_80g),
                'valor_120g' => str_replace(',', '.', $objeto->valor_120g),
                'valor_180g' => str_replace(',', '.', $objeto->valor_180g),
                'valor_250g' => str_replace(',', '.', $objeto->valor_250g),
                'valor_300g' => str_replace(',', '.', $objeto->valor_300g),
                'valor_350g' => str_replace(',', '.', $objeto->valor_350g),
                'valor_400g' => str_replace(',', '.', $objeto->valor_400g)
            );
            $this->db->where('id', $objeto->id);
            if ($this->db->update('papel_linha', $dados)) {
                $this->session->set_flashdata('sucesso', 'Registro editado com sucesso');
                return true;
            }
        } else {
            $this->session->set_flashdata('erro', 'Não foi possível editar este registro');
            return false;
        }
    }

    public function deletar($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('papel_linha')) {
                $this->session->set_flashdata('sucesso', 'Registro excluido com sucesso');
                return true;
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível excluir este registro');
                return false;
            }
        } else {
            return false;
        }
    }

    function __changeToObject($result_db = '') {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_linha_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->descricao = $value['descricao'];
            $object->valor_80g = $value['valor_80g'];
            $object->valor_120g = $value['valor_120g'];
            $object->valor_180g = $value['valor_180g'];
            $object->valor_250g = $value['valor_250g'];
            $object->valor_300g = $value['valor_300g'];
            $object->valor_350g = $value['valor_350g'];
            $object->valor_400g = $value['valor_400g'];
            foreach ($this->Papel_catalogo_m->get_list($value['papel_catalogo']) as $key => $value) {
                $object->papel_catalogo = $value;
            }
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