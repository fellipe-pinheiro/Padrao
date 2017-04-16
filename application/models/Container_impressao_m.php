<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_impressao_m extends CI_Model {

    var $id;
    var $impressao; //Objeto Impressao_m()
    var $owner; //id do cartão/envelope/personalizado
    var $quantidade;
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_impressao';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_impressao';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_impressao';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'impressao' => $this->impressao->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'descricao' => $this->descricao,
            'impressao_dimensao' => $this->impressao->get_selected_impressao_dimensao()->id,
            'valor_impressao' => $this->impressao->get_selected_impressao_dimensao()->valor_impressao,
            'qtd_minima' => $this->impressao->qtd_minima,
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
            $tabela = 'cartao_impressao';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_impressao';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_impressao';
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

    //CALCULA: valor unitário do impressao
    public function calcula_valor_unitario($qtd_convite) {
        $impressao_dimensao = $this->impressao->get_selected_impressao_dimensao();
        $valor = 0;

        $valor = $impressao_dimensao->valor_impressao;

        if ($qtd_convite < $this->impressao->qtd_minima) {
            return round($valor / $qtd_convite, 2);
        }
        return round($valor / $this->impressao->qtd_minima, 2);
    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_impressao_m();
            $object->id = $value['id'];
            $object->impressao = $this->Impressao_m->get_by_id($value['impressao']);
            $object->impressao->set_impressao_dimensao($value['impressao_dimensao'],$value['valor_impressao'],true);
            $object->impressao->qtd_minima = $value['qtd_minima'];
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_impressao_m.php */
/* Location: ./application/models/Container_impressao_m.php */