<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_m extends CI_Model {

    var $id;
    var $nome;
    var $produto_categoria;
    var $descricao;
    var $valor;
    // Ajax 
    var $table = 'produto as p';
    var $column_order = array('p.id','pc.nome','p.nome','p.descricao','p.valor');
    var $column_search = array('p.id','pc.nome','p.nome','p.descricao','p.valor');
    var $order = array('p.id'=>'asc');

    private function get_datatables_query() {
        if($this->input->post('filtro_produto_id')){
            $this->db->where('p.id', $this->input->post('filtro_produto_id'));
        }
        if($this->input->post('filtro_categoria')){
            $this->db->like('pc.nome', $this->input->post('filtro_categoria'));
        }
        if($this->input->post('filtro_produto')){
            $this->db->like('p.nome', $this->input->post('filtro_produto'));
        }
        $this->db->select('
            p.id as p_id,
            p.nome as p_nome,
            p.descricao as p_descricao,
            CONCAT("R$ ", format(p.valor,2,"pt_BR")) as p_valor,
            p.produto_categoria as p_produto_categoria,
            pc.id as pc_id,
            pc.nome as pc_nome,
            pc.descricao as pc_descricao'
            );
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
        if ($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
            $this->db->join('produto_categoria as pc', 'p.produto_categoria = pc.id', 'left');
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->get_datatables_query();
        $this->db->join('produto_categoria as pc', 'p.produto_categoria = pc.id', 'left');
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
        $result = $this->db->get('produto');
        if($result->num_rows() > 0){
            return  $this->changeToObject($result->result_array());
        }
        return null;
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('produto', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('produto', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('produto')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Produto_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->produto_categoria = $this->Produto_categoria_m->get_by_id($value['produto_categoria']);
            $object->descricao = $value['descricao'];
            $object->valor = $value['valor'];
        }
        return $object;
    }

    public function get_pesonalizado($id_categoria,$colunas){
        $this->db->select($colunas);
        $this->db->where("produto_categoria",$id_categoria);
        $this->db->order_by("nome", "asc");
        return $this->db->get("produto")->result_array();
    }
}