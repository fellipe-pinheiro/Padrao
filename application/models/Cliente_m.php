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
    var $column_order = array('id', 'nome', 'sobrenome','email','telefone', 'nome2', 'sobrenome2','email2','telefone2','rg','cpf','endereco','numero','complemento','estado','uf','bairro','cidade','cep','observacao','pessoa_tipo','razao_social','cnpj','ie','im',''); //set column field database for datatable orderable
    var $column_search = array('nome', 'sobrenome','cpf','email','telefone','nome2', 'sobrenome2','email2','telefone2','razao_social','cnpj'); //set column field database for datatable searchable just nome , descricao are searchable
    var $order = array('id'=>'asc'); // default order 

    // Ajax Nao alterar
    private function _get_datatables_query() {

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
        $result = $this->db->get('cliente');
        if($result->num_rows() > 0){
            $result =  $this->Cliente_m->_changeToObject($result->result_array());
            return $result[0];
        }
        $data["location"] = "Cliente_m/get_by_id()";
        return false;
    }

    public function get_list($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->limit(1);
        }
        $result = $this->db->get('cliente');
        if($result->num_rows() > 0){
            return $this->Cliente_m->_changeToObject($result->result_array());
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
            $result =  $this->Cliente_m->_changeToObject($result->result_array());
            return $result[0];
        }
    }

    public function inserir(Cliente_m $objeto) {
        if (!empty($objeto)) {
            $dados = $this->__get_dados($objeto);
            if ($this->db->insert('cliente', $dados)) {
                return $this->db->insert_id();
            }
        }
        return false;
    }

    public function editar(Cliente_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = $this->__get_dados($objeto);
            $this->db->where('id', $objeto->id);
            if ($this->db->update('cliente', $dados)) {
                return $objeto->id;
            }
        }
        return false;
    }

    private function __get_dados(Cliente_m $objeto){
        $dados = array(
            'id' => $objeto->id,
            'pessoa_tipo' => $objeto->pessoa_tipo,
            'nome' => $objeto->nome,
            'sobrenome' => $objeto->sobrenome,
            'email' => $objeto->email,
            'telefone' => $objeto->telefone,
            'nome2' => $objeto->nome2,
            'sobrenome2' => $objeto->sobrenome2,
            'email2' => $objeto->email2,
            'telefone2' => $objeto->telefone2,
            'rg' => $objeto->rg,
            'cpf' => $objeto->cpf,
            'endereco' => $objeto->endereco,
            'numero' => $objeto->numero,
            'complemento' => $objeto->complemento,
            'estado' => $objeto->estado,
            'uf' => $objeto->uf,
            'bairro' => $objeto->bairro,
            'cidade' => $objeto->cidade,
            'cep' => $objeto->cep,
            'observacao' => $objeto->observacao,
            'razao_social' => $objeto->razao_social,
            'cnpj' => $objeto->cnpj,
            'ie' => $objeto->ie,
            'im' => $objeto->im,
            );
        return $dados;
    }
    public function deletar($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('cliente')) {
                return true;
            }
        }
        return false;
    }

    function _changeToObject($result_db = '') {
        $object_lista = array();
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
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}