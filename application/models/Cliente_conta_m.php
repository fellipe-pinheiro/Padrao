<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_conta_m extends CI_Model {

    var $id;
    var $usuario;
    var $pedido;
    var $data;
    var $vencimento;
    var $forma_pagamento;
    var $descricao;
    var $primeiro_vencimento;
    var $vencimento_dia; //Ex: todo dia 5 do mês
    var $debito;
    var $valor;
    var $n_parcela;
    var $codigo_bancario;
    var $debito_referencia;
    var $cancelado;
    var $adicional;
    var $multa;
    var $adicional_id;
    // Ajax 
    var $table = 'cliente_conta as cc';
    var $column_order = array('cc.id', 'cc.data', 'usr.first_name', 'cc.pedido', 'cc.vencimento', 'fpg.nome', 'cc.descricao', 'cli.nome', 'cli.sobrenome', 'cli.cpf', 'cli.cnpj', 'cli.email', 'cc.debito', 'cc.n_parcela', 'cc.codigo_bancario', 'cc.debito_referencia', 'cc.valor');
    var $column_search = array('usr.first_name', 'cc.pedido', 'cc.debito_referencia', 'date_format(cc.vencimento,"%d/%m/%Y")', 'cc.forma_pagamento', 'date_format(cc.data,"%d/%m/%Y")', 'cli.nome', 'cli.sobrenome', 'cli.cpf', 'cli.cnpj', 'cli.email');
    var $order = array('cc.id' => 'asc');

    private function _get_datatables_query() {
        //Orcamento
        $this->db->select('
            cc.id as cc_id, 
            cc.usuario as cc_usuario,
            cc.pedido as cc_pedido,
            date_format(cc.data,"%d/%m/%Y") as cc_data,
            date_format(cc.vencimento,"%d/%m/%Y") as cc_vencimento,
            CONCAT("R$ ", format(cc.valor,2,"pt_BR")) as cc_valor,
            cc.forma_pagamento as cc_forma_pagamento,
            cc.descricao as cc_descricao,
            cc.debito as cc_debito,
            cc.n_parcela as cc_n_parcela,
            cc.codigo_bancario as cc_codigo_bancario,
            cc.debito_referencia as cc_debito_referencia,
            ');
        $this->db->select('
            usr.first_name as usr_nome,
            usr.last_name as usr_sobrenome
            ');
        $this->db->select('
            fpg.nome as fpg_nome');
        $this->db->select('
            ped.orcamento as ped_orcamento,
            orc.cliente as orc_cliente,
            cli.nome as cli_nome,
            cli.sobrenome as cli_sobrenome,
            cli.cpf as cli_cpf,
            cli.cnpj as cli_cnpj,
            cli.email as cli_email
            ');
        if ($this->input->post('ped_id')) {
            $this->db->where('ped.id', $this->input->post('ped_id'));
        }
        if ($this->input->post('email')) {
            $this->db->where('cli.email', $this->input->post('email'));
        }
        if ($this->input->post('cpf')) {
            $this->db->where('cli.cpf', $this->input->post('cpf'));
        }
        if ($this->input->post('cnpj')) {
            $this->db->where('cli.cnpj', $this->input->post('cnpj'));
        }
        if ($this->input->post('vencimento')) {
            $this->db->where('date_format(cc.vencimento,"%Y-%m-%d")', $this->__format_date($this->input->post('vencimento')));
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
        $this->__join();
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        $this->__join();
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function __join() {
        $this->db->join('users as usr', 'cc.usuario = usr.id', 'left');
        $this->db->join('forma_pagamento as fpg', 'cc.forma_pagamento = fpg.id', 'left');
        $this->db->join('pedido as ped', 'cc.pedido = ped.id', 'left');
        $this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
        $this->db->join('cliente as cli', 'orc.cliente = cli.id', 'left');
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('cliente_conta');
        if ($result->num_rows() > 0) {
            $result = $this->Cliente_conta_m->__changeToObject($result->result_array());
            return $result[0];
        }
        return null;
    }

    public function get_by_debito_referencia_id($id) {
        $this->db->where('debito_referencia', $id);
        $result = $this->db->get('cliente_conta');
        if ($result->num_rows() > 0) {
            $result = $this->Cliente_conta_m->__changeToObject($result->result_array());
            return $result;
        }
        return array();
    }

    public function inserir() {
        $dados = array(
            'id' => $this->id,
            'usuario' => $this->usuario,
            'pedido' => $this->pedido,
            'data' => $this->data,
            'vencimento' => $this->vencimento,
            'forma_pagamento' => $this->forma_pagamento,
            'descricao' => $this->descricao,
            'debito' => $this->debito,
            'valor' => $this->valor,
            'n_parcela' => $this->n_parcela,
            'codigo_bancario' => $this->codigo_bancario,
            'debito_referencia' => $this->debito_referencia,
            'cancelado' => $this->cancelado,
            'adicional' => $this->adicional,
            'multa' => $this->multa,
            'adicional_id' => $this->adicional_id,
            );
        if ($this->db->insert('cliente_conta', $dados)) {
            $this->id = $this->db->insert_id();
            return $this->id;
        }
        return false;
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('cliente_conta')) {
                return true;
            }
        }
        return false;
    }

    public function get_by_pedido($id, $debito = null,$adicional = null) {
        $this->db->where('pedido', $id);
        if ($debito === true) {
            $this->db->where('debito', true);
        } else if ($debito === false) {
            $this->db->where('debito', false);
        }
        if($adicional === true){
            $this->db->where('adicional', true);
        }else if ($adicional === false) {
            $this->db->where('adicional', false);
        }
        $result = $this->db->get('cliente_conta');
        if ($result->num_rows() > 0) {
            $result = $this->Cliente_conta_m->__changeToObject($result->result_array());
            return $result;
        }
        return null;
    }

    public function get_by_adicional_id($id, $debito = null) {
        $this->db->where('adicional_id', $id);
        $this->db->where('adicional', true);
        if ($debito === true) {
            $this->db->where('debito', true);
        } else if ($debito === false) {
            $this->db->where('debito', false);
        }
        $result = $this->db->get('cliente_conta');
        if ($result->num_rows() > 0) {
            $result = $this->Cliente_conta_m->__changeToObject($result->result_array());
            return $result;
        }
        return null;
    }

    private function __format_date($date) {
        list($dia, $mes, $ano) = explode('/', $date);
        return $date = $ano . '-' . $mes . '-' . $dia;
    }

    public function set_vencimento($parcela) {
        if ($parcela == 1 || empty($this->vencimento_dia)) {
            return $this->primeiro_vencimento;
        } else {
            $date = date("Y-m-d", strtotime($this->primeiro_vencimento . " +" . ($parcela - 1) . " month"));
            list($ano, $mes, $dia) = explode('-', $date);

            $date = $ano . '-' . $mes . '-' . $this->vencimento_dia;
            if ($this->__valid_date($date)) {
                return $date;
            } else {
                return $this->primeiro_vencimento;
            }
        }
    }

    public function calcula_debito() {
        if ($this->qtd_parcelas > 1) {
            return $this->valor_pedido / $this->qtd_parcelas;
        }
        return $this->valor_pedido;
    }
    //esta função será inutilizada
    public function calcula_total($cliente_contas){
        $soma = 0.00;
        foreach ($cliente_contas as $key => $conta) {
            $soma += $conta->valor;
        }
        return $soma;
    }

    private function __valid_date($date) {
        list($ano, $mes, $dia) = explode('-', $date);
        return checkdate($mes, $dia, $ano);
    }
    
    private function __changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Cliente_conta_m();
            $object->id = $value['id'];
            $object->usuario = $this->Usuario_m->get_object($value['usuario']);
            //Informações desnecessárias do usuário
            $object->usuario->ip_address = null;
            $object->usuario->password = null;
            $object->usuario->salt = null;
            $object->usuario->activation_code = null;
            $object->usuario->forgotten_password_code = null;
            $object->usuario->forgotten_password_time = null;
            $object->usuario->remember_code = null;
            $object->usuario->created_on = null;
            $object->usuario->last_login = null;
            $object->usuario->active = null;

            $object->pedido = $value['pedido'];
            $object->data = $value['data'];
            $object->vencimento = $value['vencimento'];
            if(!empty($value['forma_pagamento'])){
                $object->forma_pagamento = $this->Forma_pagamento_m->get_by_id($value['forma_pagamento']);
            }else{
                $object->forma_pagamento = new Forma_pagamento_m();
            }
            $object->descricao = $value['descricao'];
            $object->debito = $value['debito'];
            $object->valor = floatval($value['valor']);
            $object->n_parcela = $value['n_parcela'];
            $object->codigo_bancario = $value['codigo_bancario'];
            $object->debito_referencia = $value['debito_referencia'];
            $object->cancelado = $value['cancelado'];
            $object->adicional = $value['adicional'];
            $object->multa = $value['multa'];
            $object->adicional_id = $value['adicional_id'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }
}
/*
//Variaveis $object->primeiro_vencimento e $object->vencimento_dia
if($key === 0){
$primeiro_vencimento = $value['vencimento'];
list($ano, $mes, $dia) = explode("-", $value['vencimento']);
}else{
list($ano, $mes, $dia) = explode("-", $value['vencimento']);
}
$object->primeiro_vencimento = $primeiro_vencimento;
$object->vencimento_dia = $dia;
*/


/*
public function get_debitos(){
$this->db->select('
cc.id as cc_id,
cc.usuario as cc_usuario,
cc.pedido as cc_pedido,
date_format(cc.data,"%d/%m/%Y") as cc_data,
date_format(cc.vencimento,"%d/%m/%Y") as cc_vencimento,
CONCAT("R$ ", format(cc.valor,2,"pt_BR")) as cc_valor,
cc.forma_pagamento as cc_forma_pagamento,
cc.descricao as cc_descricao,
cc.debito as cc_debito,
cc.n_parcela as cc_n_parcela,
cc.codigo_bancario as cc_codigo_bancario,
');
$this->db->select('
usr.first_name as usr_nome,
usr.last_name as usr_sobrenome');
$this->db->select('
fpg.nome as fpg_nome');
$this->db->select('
ped.orcamento as ped_orcamento,
orc.cliente as orc_cliente,
cli.nome as cli_nome,
cli.sobrenome as cli_sobrenome,
cli.cpf as cli_cpf,
cli.cnpj as cli_cnpj,
cli.email as cli_email
');
$this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
$this->db->where('orc.cliente', $id_cliente);
$this->db->order_by("ped.id","desc");
$this->db->from('cliente_conta as cc');
$query = $this->db->get();
return $query->result();
}
*/
/* End of file Cliente_conta_m.php */
/* Location: ./application/models/Cliente_conta_m.php */