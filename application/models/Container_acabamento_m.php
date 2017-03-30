<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_acabamento_m extends CI_Model {

    var $id;
    var $acabamento; //Objeto Acabamento_m()
    var $owner; //id do cartão/envelope/personalizado
    var $quantidade;
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_acabamento';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_acabamento';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_acabamento';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'acabamento' => $this->acabamento->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'descricao' => $this->descricao,
            'valor' => $this->acabamento->valor,
            'qtd_minima' => $this->acabamento->qtd_minima,
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
            $tabela = 'cartao_acabamento';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_acabamento';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_acabamento';
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

    //CALCULA: valor unitário do acabamento
    public function calcula_valor_unitario($qtd_convite) {
        if ($qtd_convite < $this->acabamento->qtd_minima) {
            return round($this->acabamento->valor / $qtd_convite, 2);
        }
        return round($this->acabamento->valor / $this->acabamento->qtd_minima, 2);
    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_acabamento_m();
            $object->id = $value['id'];
            $object->acabamento = $this->Acabamento_m->get_by_id($value['acabamento']);
            $object->acabamento->valor = $value['valor'];
            $object->acabamento->qtd_minima = $value['qtd_minima'];
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_acabamento_m.php */
/* Location: ./application/models/Container_acabamento_m.php */