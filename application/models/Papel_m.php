<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_m extends CI_Model {

    var $id;
    var $nome;
    var $papel_linha; // Object Papel_linha_m()
    var $papel_dimensao; // Object Papel_dimensao_m()
    var $papel_gramaturas; // array Object Papel_gramatura_m()

    var $descricao;
    // Ajax 
    var $table = 'v_papel_gramatura_group';
    var $column_order = array('id','linha','papel','altura','largura','gramaturas','descricao');
    var $column_search = array('id','linha','papel','altura','largura','gramaturas','descricao');
    var $order = array('papel'=>'asc');

    private function get_datatables_query() {
        if($this->input->post('filtro_papel')){
            $this->db->like('papel', $this->input->post('filtro_papel'));
        }
        if($this->input->post('filtro_linha')){
            $this->db->where('linha', $this->input->post('filtro_linha'));
        }
        if($this->input->post('filtro_altura')){
            $this->db->where('altura', $this->input->post('filtro_altura'));
        }
        if($this->input->post('filtro_largura')){
            $this->db->where('largura', $this->input->post('filtro_largura'));
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
        $result = $this->db->get('papel');
        $result =  $this->Papel_m->changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list() {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('papel');
        return $this->Papel_m->changeToObject($result->result_array());
    }

    /*
    public function __get_list_to_select(){
        //TODO verificar se está em uso....
        $arr = array();
        $papel_linha = $this->Papel_linha_m->get_list();
        foreach ($papel_linha as $linha) {
            $arr[$linha->nome] = "$linha->nome $this->nome $this->cor";
        }
        return $arr;
    }
    */

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
            'descricao' => $objeto->descricao
        );
        return $dados;
    }

    public function deletar($id) {
        if (!empty($id)) {
            if($this->Papel_gramatura_m->deletar_papel($id)){
                $this->db->where('id', $id);
                if ($this->db->delete('papel')) {
                    return true;
                }
            }
        }
        return false;
    }

    public function set_papel_gramatura($id){
        foreach ($this->papel_gramaturas as $value) {
            if($value->id === $id){
                $value->selected = true;
            }else{
                $value->selected = false;
            }
        }
    }

    public function set_papel_gramatura_and_valor($id,$valor){
        foreach ($this->papel_gramaturas as $value) {
            if($value->id === $id){
                $value->selected = true;
                $value->valor = $valor;
            }else{
                $value->selected = false;
            }
        }
    }

    public function get_selected_papel_gramatura(){
        foreach ($this->papel_gramaturas as $object) {
            if($object->selected){
                return $object;
            }
        }
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Papel_m();
            $object->id = $value['id'];
            $object->papel_linha = $this->Papel_linha_m->get_by_id($value['papel_linha']);
            $object->nome = $value['nome'];
            $object->papel_dimensao = $this->Papel_dimensao_m->get_by_id($value['papel_dimensao']);
            $object->papel_gramaturas = $this->Papel_gramatura_m->get_by_papel_id($object->id);
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_papel_gramaturas_json(){
        return json_encode($this->papel_gramaturas);
    }

    public function get_object_json(){
        $arr = array(
            /*
            "80" => $this->valor_80g,
            "120" => $this->valor_120g,
            "180" => $this->valor_180g,
            "250" => $this->valor_250g,
            "300" => $this->valor_300g,
            "350" => $this->valor_350g,
            "400" => $this->valor_400g,
            */
            );
        return json_encode($arr);
    }

}