<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_adicional_m extends CI_Model {

    var $id;
    var $owner;
    var $adicional;
    var $objeto;
    var $quantidade;
    var $data_entrega;
    var $valor_extra;
    var $cancelado;

    public function inserir() {
        $tabela = "";
        if ($this->owner === 'convite') {
            $tabela = 'adicional_convite';
            $coluna = 'orcamento_convite';
        } else if ($this->owner === 'personalizado') {
            $tabela = 'adicional_personalizado';
            $coluna = 'orcamento_personalizado';
        } else if ($this->owner === 'produto') {
            $tabela = 'adicional_produto';
            $coluna = 'orcamento_produto';
        }
        if ($this->db->insert($tabela, $this->__get_dados($coluna))) {
            $this->id = $this->db->insert_id();
            return true;
        }
        return false;
    }

    public function cancelar($id, $tabela) {
        $dados = array('cancelado' => 1);
        $this->db->where('id', $id);
        if ($this->db->update($tabela, $dados)) {
            return true;
        }
        return false;
    }

    public function cancel_all($id, $tabela, $coluna) {
        $dados = array('cancelado' => 1);
        $this->db->where($coluna, $id);
        if ($this->db->update($tabela, $dados)) {
            return true;
        }
        return false;
    }

    private function __get_dados($coluna) {
        $dados = array(
            'id' => $this->id,
            'adicional' => $this->adicional,
            $coluna => $this->objeto,
            'quantidade' => $this->quantidade,
            'data_entrega' => $this->data_entrega,
            'valor_extra' => $this->valor_extra,
            'cancelado' => $this->cancelado
        );
        return $dados;
    }

    public function get_by_adicional_id($id, $tabela, $owner, $objeto) {
        $this->db->where('adicional', $id);
        $result = $this->db->get($tabela);
        if ($result->num_rows() > 0) {
            return $this->changeToObject($result->result_array(), $owner, $objeto);
        }
        return false;
    }

    public function get_by_orcamento_convite($id) {
        $this->db->where('orcamento_convite', $id);
        $this->db->where('cancelado', 0);
        $result = $this->db->get('adicional_convite');
        if ($result->num_rows() > 0) {
            return $this->changeToObject($result->result_array(), 'convite', null);
        }
        return null;
    }

    public function get_adicional_convite() {
        $this->db->where('orcamento_convite', $id);
        $this->db->where('cancelado', 0);
        $result = $this->db->get('adicional_convite');
        if ($result->num_rows() > 0) {
            return $result;
        }
        return null;
    }

    public function altera_data_entrega($id, $data_entrega, $tabela) {
        $dados = array('data_entrega' => $data_entrega);
        $this->db->where('id', $id);
        if ($this->db->update($tabela, $dados)) {
            return true;
        }
        return false;
    }

    public function calcula_unitario() {

        return $this->objeto->calcula_unitario();
    }

    public function calcula_total() {

        return round($this->quantidade * ($this->valor_extra + $this->objeto->calcula_unitario()), 2);
    }

    private function changeToObject($result_db, $owner, $objeto) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_adicional_m();
            $object->id = $value['id'];
            $object->owner = $owner;
            $object->adicional = $value['adicional'];
            if ($owner === 'convite') {
                if (!empty($objeto)) {
                    foreach ($objeto as $key => $convite) {
                        if ($convite->id === $value['orcamento_convite']) {
                            $object->objeto = $convite;
                            break;
                        }
                    }
                } else {
                    $object->objeto = $this->Convite_m->get_by_id($value['orcamento_convite']);
                }
            } else if ($owner === 'personalizado') {
                if (!empty($objeto)) {
                    foreach ($objeto as $key => $personalizado) {
                        if ($personalizado->id === $value['orcamento_personalizado']) {
                            $object->objeto = $personalizado;
                            break;
                        }
                    }
                } else {
                    $object->objeto = $this->Personalizado_m->get_by_id($value['orcamento_personalizado']);
                }
            } else if ($owner === 'produto') {
                if (!empty($objeto)) {
                    foreach ($objeto as $key => $produto) {
                        if ($produto->id === $value['orcamento_produto']) {
                            $object->objeto = $produto;
                            break;
                        }
                    }
                } else {
                    $object->objeto = $this->Container_produto_m->get_by_id($value['orcamento_produto']);
                }
            }
            $object->quantidade = $value['quantidade'];
            $object->data_entrega = date_to_form($value['data_entrega']);
            $object->valor_extra = $value['valor_extra'];
            $object->cancelado = $value['cancelado'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_adicional_m.php */
/* Location: ./application/models/Container_adicional_m.php */