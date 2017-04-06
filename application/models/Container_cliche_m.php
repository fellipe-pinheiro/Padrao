<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_cliche_m extends CI_Model {

    var $id;
    var $cliche; //Objeto Cliche_m()
    var $owner; //id do cartão/envelope/personalizado
    var $quantidade;
    var $cobrarServico; //boolean
    var $cobrarCliche; //boolean
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_cliche';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_cliche';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_cliche';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'cliche' => $this->cliche->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'cobrar_servico' => $this->cobrarServico,
            'cobrar_cliche' => $this->cobrarCliche,
            'descricao' => $this->descricao,
            'cliche_dimensao' => $this->cliche->get_selected_cliche_dimensao()->id,
            'valor_servico' => $this->cliche->get_selected_cliche_dimensao()->valorServico,
            'valor_cliche' => $this->cliche->get_selected_cliche_dimensao()->valorCliche,
            'qtd_minima' => $this->cliche->qtd_minima,
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
            $tabela = 'cartao_cliche';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_cliche';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_cliche';
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

    //CALCULA: valor unitário do cliche
    public function calcula_valor_unitario($qtd_convite) {
        $cliche_dimensao = $this->cliche->get_selected_cliche_dimensao();
        $valor = 0;

        if($this->cobrar_servico){
            $valor = $cliche_dimensao->valorServico;
        }
        if($this->cobrar_cliche){
            $valor += $cliche_dimensao->valorCliche;
        }

        if ($qtd_convite < $this->cliche->qtd_minima) {
            return round($valor / $qtd_convite, 2);
        }
        return round($valor / $this->cliche->qtd_minima, 2);
    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_cliche_m();
            $object->id = $value['id'];
            $object->cliche = $this->Cliche_m->get_by_id($value['cliche']);
            $object->cliche->set_cliche_dimensao($value['cliche_dimensao'],$value['valor_servico'],$value['valor_cliche'],true);
            $object->cliche->qtd_minima = $value['qtd_minima'];
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->cobrar_servico = $value['cobrar_servico'];
            $object->cobrar_cliche = $value['cobrar_cliche'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_cliche_m.php */
/* Location: ./application/models/Container_cliche_m.php */