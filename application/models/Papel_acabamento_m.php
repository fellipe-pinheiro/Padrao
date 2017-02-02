<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_acabamento_m extends CI_Model {

    var $id;
    var $nome;
    var $codigo;
    var $descricao;
    var $valor;
    // Ajax 
    var $table = 'papel_acabamento';
    var $column_order = array('id', 'nome','codigo', 'descricao', 'valor'); //set column field database for datatable orderable
    var $column_search = array('nome','codigo', 'descricao'); //set column field database for datatable searchable just nome , descricao are searchable
    var $order = array('id'=>'asc'); // default order 

    // Ajax Nao alterar
    private function _get_datatables_query() {
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
        $query = $this->db->get();
        return $query->result();
    }
    // Ajax Nao alterar
    public function count_filtered() {
        $this->_get_datatables_query();
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
        $result = $this->db->get('papel_acabamento');
        $result =  $this->Papel_acabamento_m->_changeToObject($result->result_array());
        return $result[0];
    }

    public function get_by_codigo($codigo){
        $this->db->where('codigo', $codigo);
        $this->db->limit(1);
        $result = $this->db->get('papel_acabamento');
        $result =  $this->Papel_acabamento_m->_changeToObject($result->result_array());
        return $result[0];
    }    

    public function get_list($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('papel_acabamento');
        return $this->Papel_acabamento_m->_changeToObject($result->result_array());
    }

    public function inserir($objeto) {
        if (!empty($objeto)) {
            $dados = array(
                'id' => $objeto->id,
                'nome' => $objeto->nome,
                'codigo' => $objeto->codigo,
                'descricao' => $objeto->descricao,
                'valor' => str_replace(',', '.', $objeto->valor)
                );
            if ($this->db->insert('papel_acabamento', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($objeto) {
        if (!empty($objeto->id)) {
            $dados = array(
                'id' => $objeto->id,
                //Comentado para o usuário não excluir
                //'nome' => $objeto->nome,
                //'codigo' => $objeto->codigo,
                'descricao' => $objeto->descricao,
                'valor' => str_replace(',', '.', $objeto->valor)
                );
            $this->db->where('id', $objeto->id);
            if ($this->db->update('papel_acabamento', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('papel_acabamento')) {
                return true;
            }
        }
        return false;
    }

    function _changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_acabamento_m();
            $object->id = $value['id'];
            $object->nome = $value['nome'];
            $object->codigo = $value['codigo'];
            $object->descricao = $value['descricao'];
            $object->valor = $value['valor'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}