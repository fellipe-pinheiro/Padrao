<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loja_m extends CI_Model {

    var $id;
    var $unidade;
    var $razao_social;
    var $cnpj;
    var $ie;
    var $im;
    var $telefone;
    var $telefone2;
    var $telefone3;
    var $endereco;
    var $email;
    var $numero;
    var $complemento;
    var $estado;
    var $bairro;
    var $cidade;
    var $cep;
    var $uf;
    // Ajax 
    var $table = 'loja';
    var $column_order = array('id', 'unidade','razao_social','cnpj','ie','im','telefone','telefone2','telefone3','email','endereco','numero','complemento','estado','uf','bairro','cidade','cep');
    var $column_search = array('unidade','razao_social','cnpj');
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
        $result = $this->db->get('loja');
        $result =  $this->Loja_m->changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list() {
        $result = $this->db->get('loja');
        return $this->Loja_m->changeToObject($result->result_array());
    }

    public function inserir(Loja_m $objeto) {
        if (!empty($objeto)) {
            $dados = $this->get_dados($objeto);
            if ($this->db->insert('loja', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar(Loja_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = $this->get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('loja', $dados)) {
                return true;
            }
        }
        return false;
    }

    public function get_dados(Loja_m $objeto){
        $dados = array(
            'id' => $objeto->id,
            'unidade' => $objeto->unidade,
            'razao_social' => $objeto->razao_social,
            'cnpj' => $objeto->cnpj,
            'ie' => $objeto->ie,
            'im' => $objeto->im,
            'telefone' => $objeto->telefone,
            'telefone2' => $objeto->telefone2,
            'telefone3' => $objeto->telefone3,
            'email' => $objeto->email,
            'endereco' => $objeto->endereco,
            'numero' => $objeto->numero,
            'complemento' => $objeto->complemento,
            'estado' => $objeto->estado,
            'bairro' => $objeto->bairro,
            'cidade' => $objeto->cidade,
            'cep' => $objeto->cep,
            'uf' => $objeto->uf,
            );
        return $dados;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('loja')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Loja_m();
            $object->id = $value['id'];
            $object->unidade = $value['unidade'];
            $object->razao_social = $value['razao_social'];
            $object->cnpj = $value['cnpj'];
            $object->ie = $value['ie'];
            $object->im = $value['im'];
            $object->telefone = $value['telefone'];
            $object->telefone2 = $value['telefone2'];
            $object->telefone3 = $value['telefone3'];
            $object->email = $value['email'];
            $object->endereco = $value['endereco'];
            $object->numero = $value['numero'];
            $object->complemento = $value['complemento'];
            $object->estado = $value['estado'];
            $object->bairro = $value['bairro'];
            $object->cidade = $value['cidade'];
            $object->cep = $value['cep'];
            $object->uf = $value['uf'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($colunas){
        $this->db->select($colunas);
        $this->db->order_by("unidade", "asc");
        return $this->db->get("loja")->result();
    }
}