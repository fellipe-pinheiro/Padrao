<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_laser_m extends CI_Model {

    var $id;
    var $laser; //Objeto Laser_m()
    var $owner; //id do cartão/envelope/personalizado
    var $quantidade;
    var $qtd_minutos;
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_laser';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_laser';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_laser';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'laser' => $this->laser->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'qtd_minutos' => $this->qtd_minutos,
            'descricao' => $this->descricao,
            'valor' => $this->laser->valor,
            'minutos' => $this->laser->minutos,
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
            $tabela = 'cartao_laser';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_laser';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_laser';
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

    //CALCULA: valor unitário do laser
    public function calcula_valor_unitario($qtd_convite) {

        return round(($this->laser->valor / $this->laser->minutos) * $this->qtd_minutos, 2);

    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_laser_m();
            $object->id = $value['id'];
            $object->laser = $this->Laser_m->get_by_id($value['laser']);
            $object->laser->valor = $value['valor'];
            $object->laser->minutos = $value['minutos'];
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->qtd_minutos = $value['qtd_minutos'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_laser_m.php */
/* Location: ./application/models/Container_laser_m.php */