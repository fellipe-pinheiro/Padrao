<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_m extends CI_Model {
    var $id;
    var $pessoa_tipo;
    var $nome;
    var $sobrenome;
    var $email;
    var $telefone;
    var $nome2;
    var $sobrenome2;
    var $email2;
    var $telefone2;
    var $rg;
    var $cpf;
    var $endereco;
    var $numero;
    var $complemento;
    var $estado;
    var $uf;
    var $bairro;
    var $cidade;
    var $cep;
    var $observacao;
    var $razao_social;
    var $cnpj;
    var $ie;
    var $im;

    // Ajax 
    var $table = 'cliente';
    var $column_order = array('id', 'nome', 'sobrenome','email','telefone', 'nome2', 'sobrenome2','email2','telefone2','rg','cpf','endereco','numero','complemento','estado','uf','bairro','cidade','cep','observacao','pessoa_tipo','razao_social','cnpj','ie','im','');
    var $column_search = array('nome', 'sobrenome','cpf','email','telefone','nome2', 'sobrenome2','email2','telefone2','razao_social','cnpj');
    var $order = array('id'=>'asc');

    private function get_datatables_query() {

        if($this->input->post('filtro_id')){
            $this->db->where('id', $this->input->post('filtro_id'));
        }
        if($this->input->post('filtro_nome')){
            $this->db->where('nome', $this->input->post('filtro_nome'));
        }
        if($this->input->post('filtro_sobrenome')){
            $this->db->like('sobrenome', $this->input->post('filtro_sobrenome'));
        }
        if($this->input->post('filtro_telefone')){
            $this->db->where('telefone',$this->input->post('filtro_telefone'));
        }
        if($this->input->post('filtro_email')){
            $this->db->where('email', $this->input->post('filtro_email'));
        }
        if($this->input->post('filtro_cpf')){
            $this->db->where('cpf',$this->input->post('filtro_cpf'));
        }
        if($this->input->post('filtro_cnpj')){
            $this->db->where('cnpj',$this->input->post('filtro_cnpj'));
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
        $result = $this->db->get('cliente');
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return false;
    }

    public function get_pedidos_by_cliente_id($id){
        $this->db->select('
            ped.id as ped_id,
            ped.orcamento as ped_orcamento,
            date_format(ped.data,"%d/%m/%Y") as ped_data
            ');
        $this->db->select('
            orc.id as orc_id, 
            orc.cliente as orc_cli,
            date_format(orc.data_evento,"%d/%m/%Y") as orc_data_evento, 
            ');
        $this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
        $this->db->where('orc.cliente', $id);
        $this->db->order_by("ped.id","desc");
        $this->db->from('pedido as ped');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_adicionais_by_pedido_id($id){
        $this->db->select('
            adc.id as adc_id,
            adc.pedido as adc_pedido,
            date_format(adc.data,"%d/%m/%Y") as adc_data
            ');
        $this->db->where('adc.pedido', $id);
        $this->db->order_by("adc.pedido","asc");
        $this->db->from('adicional as adc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_pedido_id($id){
        $this->db->select('
            ped.id as ped_id,
            ped.orcamento as ped_orcamento,
            orc.id as orc_id, 
            orc.cliente as orc_cli,
            cli.*
            ');
        $this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
        $this->db->join('cliente as cli', 'orc.cliente = cli.id', 'left');
        $this->db->from('pedido as ped');
        $this->db->where('ped.id', $id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $this->changeToObject($result->result_array());
        }
        return new Cliente_m();
    }

    public function inserir($dados) {
        if (empty($dados['id'])) {
            if ($this->db->insert('cliente', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar($dados) {
        if (!empty($dados['id'])) {
            $this->db->where('id', $dados['id']);
            if ($this->db->update('cliente', $dados)) {
                return $dados['id'];
            }
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('cliente')) {
                return true;
            }
        }
        return false;
    }

    private function changeToObject($result_db) {
        foreach ($result_db as $key => $value) {
            $object = new Cliente_m();
            $object->id = $value['id'];
            $object->pessoa_tipo = $value['pessoa_tipo'];
            $object->nome = $value['nome'];
            $object->sobrenome = $value['sobrenome'];
            $object->email = $value['email'];
            $object->telefone = $value['telefone'];
            $object->nome2 = $value['nome2'];
            $object->sobrenome2 = $value['sobrenome2'];
            $object->email2 = $value['email2'];
            $object->telefone2 = $value['telefone2'];
            $object->rg = $value['rg'];
            $object->cpf = $value['cpf'];
            $object->endereco = $value['endereco'];
            $object->numero = $value['numero'];
            $object->complemento = $value['complemento'];
            $object->estado = $value['estado'];
            $object->uf = $value['uf'];
            $object->bairro = $value['bairro'];
            $object->cidade = $value['cidade'];
            $object->cep = $value['cep'];
            $object->observacao = $value['observacao'];
            $object->razao_social = $value['razao_social'];
            $object->cnpj = $value['cnpj'];
            $object->ie = $value['ie'];
            $object->im = $value['im'];
        }
        return $object;
    }

}