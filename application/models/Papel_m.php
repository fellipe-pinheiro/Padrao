<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_m extends CI_Model {

    var $id;
    var $nome;
    var $papel_linha;
    var $papel_dimensao;
    var $descricao;
    
    var $table = 'papel as p';
    var $column_order = array('id', 'pc.nome', 'pl.nome', 'p.nome', 'pd.altura', 'pd.largura', 'pl.valor_80g', 'pl.valor_120g', 'pl.valor_180g', 'pl.valor_250g', 'pl.valor_300g', 'pl.valor_350g', 'pl.valor_400g');
    var $column_search = array('p.nome', 'pl.nome', 'pc.nome');
    var $order = array('p.id' => 'asc');

    // Ajax Nao alterar
    private function _get_datatables_query() {
        if ($this->input->post('filtro_catalogo')) {
            $this->db->like('pc.nome', $this->input->post('filtro_catalogo'));
        }
        if ($this->input->post('filtro_linha')) {
            $this->db->like('pl.nome', $this->input->post('filtro_linha'));
        }
        if ($this->input->post('filtro_papel')) {
            $this->db->like('p.nome', $this->input->post('filtro_papel'));
        }
        if ($this->input->post('filtro_papel_altura')) {
            $this->db->where('pd.altura', $this->input->post('filtro_papel_altura'));
        }
        if ($this->input->post('filtro_papel_largura')) {
            $this->db->where('pd.largura', $this->input->post('filtro_papel_largura'));
        }
        $this->db->select('
            p.id,
            p.nome as p_nome,
            p.descricao as p_descricao,
            p.papel_linha,
            p.papel_dimensao,
            pd.altura as pd_altura,
            pd.largura as pd_largura,
            pl.nome as pl_nome,
            pc.nome as pc_nome,
            CONCAT("R$ ", format(pl.valor_80g,2,"pt_BR")) as pl_valor_80g,
            CONCAT("R$ ", format(pl.valor_120g,2,"pt_BR")) as pl_valor_120g,
            CONCAT("R$ ", format(pl.valor_180g,2,"pt_BR")) as pl_valor_180g,
            CONCAT("R$ ", format(pl.valor_250g,2,"pt_BR")) as pl_valor_250g,
            CONCAT("R$ ", format(pl.valor_300g,2,"pt_BR")) as pl_valor_300g,
            CONCAT("R$ ", format(pl.valor_350g,2,"pt_BR")) as pl_valor_350g,
            CONCAT("R$ ", format(pl.valor_400g,2,"pt_BR")) as pl_valor_400g');
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
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
            $this->__join();
        }
        $query = $this->db->get();
        return $query->result();
    }

    // Ajax Nao alterar
    public function count_filtered() {
        $this->_get_datatables_query();
        $this->__join();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function __join() {
        $this->db->join('papel_linha as pl', 'p.papel_linha = pl.id', 'left');
        $this->db->join('papel_catalogo as pc', 'pl.papel_catalogo = pc.id', 'left');
        $this->db->join('papel_dimensao as pd', 'p.papel_dimensao = pd.id', 'left');
    }

    // Ajax Nao alterar
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('papel');
        if ($result->num_rows() > 0) {
            $result = $this->Papel_m->__changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_list($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('papel');
        return $this->Papel_m->__changeToObject($result->result_array());
    }

    public function inserir(Papel_m $objeto) {
        if (!empty($objeto)) {
            $dados = $this->__get_dados($objeto);
            if ($this->db->insert('papel', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar(Papel_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = $this->__get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('papel', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function __get_dados(Papel_m $objeto) {
        $dados = array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'papel_linha' => $objeto->papel_linha,
            'papel_dimensao' => $objeto->papel_dimensao,
            'descricao' => $objeto->descricao,
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

    //CHANGE_TO_OBJECT 
    private function __changeToObject($result_db = '') {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->descricao = $value['descricao'];
            $object->papel_linha = $this->Papel_m->__get_papel_linha($value['papel_linha']); //retorna o objeto: [papel_linha] e seta a variavel
            $object->papel_dimensao = $this->Papel_m->__get_papel_dimensao($value['papel_dimensao']); //retorna o objeto: [papel_dimensao] e seta a variavel
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    /*
      Devido a um problema de fazer mais do que 2 ou mais foreach dentro da funcção: function __changeToObject($result_db = '')
      separei nas funções __get_item que retorna um objeto da classe
     */

    //Retorna um objeto do tipo Papel_linha_m
    private function __get_papel_linha($id) {
        foreach ($this->Papel_linha_m->get_list($id) as $key => $value) {
            $object = $value;
        }
        return $object;
    }

    //Retorna um objeto do tipo Papel_dimensao_m
    private function __get_papel_dimensao($id) {
        foreach ($this->Papel_dimensao_m->get_list($id) as $key => $value) {
            $object = $value;
        }
        return $object;
    }

}
