<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personalizado_m extends CI_Model {

    var $id;
    var $personalizado; //Objeto Personalizado_m
    var $modelo; //Objeto Personalizado_modelo_m
    var $mao_obra; //Objeto Mao_obra_m
    var $quantidade;
    var $descricao;
    var $data_entrega;
    var $cancelado; //Boolean
    var $comissao; //Integer
    var $session_posicao = null; //swap na sessão orçamento
    var $is_edicao = false; //swap na sessão orçamento

    public function inserir() {

        $personalizado = $this->personalizado;
        if (!empty($personalizado->container_papel) || !empty($personalizado->container_impressao) || !empty($personalizado->container_fita) || !empty($personalizado->container_acabamento) || !empty($personalizado->container_acessorio)) {
            if (!$personalizado->inserir()) {
                return false;
            }
        }

        $dados = array(
            'id' => null,
            'modelo' => $this->modelo->id,
            'personalizado' => $this->personalizado->id
        );

        if (!$this->db->insert('personalizado_produto', $dados)) {
            return false;
        } else {
            $this->id = $this->db->insert_id();
        }

        return true;
    }

    public function altera_data_entrega($id, $data_entrega) {
        $dados = array('data_entrega' => $data_entrega);
        $this->db->where('id', $id);
        if ($this->db->update('orcamento_personalizado', $dados)) {
            return true;
        }
        return false;
    }

    public function cancelar($id) {
        $dados = array('cancelado' => 1);
        $this->db->where('id', $id);
        if ($this->db->update('orcamento_personalizado', $dados)) {
            return true;
        }
        return false;
    }

    public function get_by_orcamento_id($id) {
        $this->db->where('orcamento', $id);
        $result = $this->db->get('orcamento_personalizado');
        if ($result->num_rows() > 0) {
            return $this->changeToObject($result->result_array());
        }
        return array();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('orcamento_personalizado');
        if ($result->num_rows() > 0) {
            $result = $this->changeToObject($result->result_array());
            return $result[0];
        }
        return null;
    }

    //Retorna valor total do personalizado com os adicionais
    public function calcula_unitario() {
        return $this->calcula_unitario_parcial() + $this->calcula_custos_administrativos_unitario();
    }

    public function calcula_total() {
        return $this->calcula_unitario() * $this->quantidade;
    }

    public function calcula_unitario_parcial() {
        return $this->personalizado->calcula_total($this->modelo, $this->quantidade) + $this->modelo->valor + $this->calcula_mao_obra();
    }

    //Retorna o valor do personalizado somente com os opcionais
    public function calcula_personalizado() {
        return $this->personalizado->calcula_total($this->modelo, $this->quantidade);
    }

    public function calcula_personalizado_sub_total() {
        return $this->calcula_personalizado() * $this->quantidade;
    }

    public function calcula_mao_obra() {
        return ($this->mao_obra->valor * 2) + $this->mao_obra->valor;
    }

    public function calcula_mao_obra_sub_total() {
        return $this->calcula_mao_obra() * $this->quantidade;
    }

    public function calcula_custos_administrativos_unitario() {
        $total = $this->calcula_unitario_parcial() / ( (100 - $this->comissao) / 100 );
        $total = $total - $this->calcula_unitario_parcial();
        return round($total, 2);
    }

    public function calcula_custos_administrativos_total() {

        return $this->calcula_custos_administrativos_unitario() * $this->quantidade;
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $this->db->where('id', $value['personalizado_produto']);
            $this->db->limit(1);
            $result = $this->db->get('personalizado_produto');
            $result = $result->result()[0];
            $object = new Personalizado_m();
            $object->id = $value['id'];
            $object->personalizado = $this->Container_m->get_by_id($result->personalizado, 'personalizado');
            $object->modelo = $this->Personalizado_modelo_m->get_by_id($result->modelo);
            $object->mao_obra = $this->Mao_obra_m->get_by_id($value['mao_obra']);
            $object->mao_obra->valor = $value['mao_obra_valor'];
            $object->quantidade = $value['quantidade'];
            $object->descricao = $value['descricao'];
            $object->data_entrega = empty($value['data_entrega']) ? "" : date_to_form($value['data_entrega']);
            $object->cancelado = $value['cancelado'];
            $object->comissao = $value['comissao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Personalizado_m.php */
/* Location: ./application/models/Personalizado_m.php */