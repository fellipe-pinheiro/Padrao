<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_acessorio_m extends CI_Model {

    var $id;
    var $acessorio; //Objeto Acessorio_m()
    var $owner; //id do cartão 
    var $quantidade;
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_acessorio';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_acessorio';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_acessorio';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'acessorio' => $this->acessorio->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'descricao' => $this->descricao,
            'valor' => $this->acessorio->valor,
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
            $tabela = 'cartao_acessorio';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_acessorio';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_acessorio';
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

    //CALCULA: valor unitário do acessório
    public function calcula_valor_unitario() {
        //Especificação: o valor que vem é de um único produto já com seu valor unitário
        return $this->acessorio->valor;
    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_acessorio_m();
            $object->id = $value['id'];
            $object->acessorio = $this->Acessorio_m->get_by_id($value['acessorio']);
            $object->acessorio->valor = $value['valor'];
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_acessorio_m.php */
/* Location: ./application/models/Container_acessorio_m.php */