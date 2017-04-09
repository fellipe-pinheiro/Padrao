<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_faca_m extends CI_Model {

    var $id;
    var $faca; //Objeto Faca_m()
    var $owner; //id do cartão/envelope/personalizado
    var $quantidade;
    var $cobrar_servico; //boolean
    var $cobrar_faca; //boolean
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_faca';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_faca';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_faca';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'faca' => $this->faca->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'cobrar_servico' => $this->cobrar_servico,
            'cobrar_faca' => $this->cobrar_faca,
            'descricao' => $this->descricao,
            'faca_dimensao' => $this->faca->get_selected_faca_dimensao()->id,
            'valor_servico' => $this->faca->get_selected_faca_dimensao()->valor_servico,
            'valor_faca' => $this->faca->get_selected_faca_dimensao()->valor_faca,
            'qtd_minima' => $this->faca->qtd_minima,
        );
        if ($this->db->insert($tabela, $dados)) {
            $this->id = $this->db->insert_id();
        } else {
            return false;
        }
        return true;
    }

    public function get_by_container_id($id, $owner) {
        if ($owner == 'cartao') {
            $tabela = 'cartao_faca';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_faca';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_faca';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $this->db->where($coluna, $id);
        $result = $this->db->get($tabela);
        if (!empty($result->num_rows())) {
            return $this->changeToObject($result->result_array(), $owner);
        }
        return array();
    }

    //CALCULA: valor unitário do faca
    public function calcula_valor_unitario($qtd_convite) {
        $faca_dimensao = $this->faca->get_selected_faca_dimensao();
        $valor = 0;

        if($this->cobrar_servico){
            $valor = $faca_dimensao->valor_servico;
        }
        if($this->cobrar_faca){
            $valor += $faca_dimensao->valor_faca;
        }

        if ($qtd_convite < $this->faca->qtd_minima) {
            return round($valor / $qtd_convite, 2);
        }
        return round($valor / $this->faca->qtd_minima, 2);
    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_faca_m();
            $object->id = $value['id'];
            $object->faca = $this->Faca_m->get_by_id($value['faca']);
            $object->faca->set_faca_dimensao($value['faca_dimensao'],$value['valor_servico'],$value['valor_faca'],true);
            $object->faca->qtd_minima = $value['qtd_minima'];
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->cobrar_servico = $value['cobrar_servico'];
            $object->cobrar_faca = $value['cobrar_faca'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_faca_m.php */
/* Location: ./application/models/Container_faca_m.php */