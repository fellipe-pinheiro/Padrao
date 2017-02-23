<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_papel_acabamento_m extends CI_Model {

    var $id;
    var $papel_acabamento; //Objeto Papel_acabamento_m;
    var $quantidade;
    var $adicionar; //Boolean 
    var $cobrar_servico; // Boolean
    var $cobrar_faca_cliche; // Boolean
    var $corte_laser_minutos; // Int

    public function inserir($id, $owner) {
        $suffix = $this->papel_acabamento->codigo;
        //seta o prefixo para a tabela onde será inserida
        if ($owner == 'cartao') {
            $prefix_table = 'cartao_papel_';
            $coluna_fk = 'cartao_papel';
        } else if ($owner == 'envelope') {
            $prefix_table = 'envelope_papel_';
            $coluna_fk = 'envelope_papel';
        } else if ($owner == 'personalizado') {
            $prefix_table = 'personalizado_papel_';
            $coluna_fk = 'personalizado_papel';
        } else {
            return false;
        }
        if ($this->db->insert($prefix_table . $suffix, $this->get_data_to_insert($id, $coluna_fk))) {
            return true;
        }
        return false;
    }

    public function get_by_id($id, $owner, $suffix) {
        if ($owner == 'cartao') {
            $prefix_table = 'cartao_papel_';
            $coluna_fk = 'cartao_papel';
        } else if ($owner == 'envelope') {
            $prefix_table = 'envelope_papel_';
            $coluna_fk = 'envelope_papel';
        } else if ($owner == 'personalizado') {
            $prefix_table = 'personalizado_papel_';
            $coluna_fk = 'personalizado_papel';
        } else {
            return false;
        }
        $this->db->where($coluna_fk, $id);
        $this->db->limit(1);
        $result = $this->db->get($prefix_table . $suffix);
        if ($result->num_rows() > 0) {
            return $this->changeToObject($result->result_array());
        } else {
            return $this->changeToObject(null);
        }
    }

    private function get_data_to_insert($id, $coluna_fk) {
        $dados = array(
            'id' => null,
            'papel_acabamento' => $this->papel_acabamento->id,
            $coluna_fk => $id,
            'quantidade' => $this->quantidade,
            'adicionar' => $this->adicionar,
            'cobrar_servico' => $this->cobrar_servico,
            'cobrar_faca_cliche' => $this->cobrar_faca_cliche,
            'corte_laser_minutos' => $this->corte_laser_minutos,
            'valor' => $this->papel_acabamento->valor,
        );
        return $dados;
    }

    private function changeToObject($result_db) {
        if (empty($result_db)) {
            $object = new Container_papel_acabamento_m();
            $object->id = null;
            $object->papel_acabamento = new Papel_acabamento_m();
            $object->papel_acabamento->valor = 0;
            $object->quantidade = 0;
            $object->adicionar = 0;
            $object->cobrar_servico = 0;
            $object->cobrar_faca_cliche = 0;
            $object->corte_laser_minutos = 0;
            return $object;
        }
        foreach ($result_db as $key => $value) {
            $object = new Container_papel_acabamento_m();
            $object->id = $value['id'];
            $object->papel_acabamento = $this->Papel_acabamento_m->get_by_id($value['papel_acabamento']);
            $object->papel_acabamento->valor = $value['valor'];
            $object->quantidade = $value['quantidade'];
            $object->adicionar = $value['adicionar'];
            $object->cobrar_servico = $value['cobrar_servico'];
            $object->cobrar_faca_cliche = $value['cobrar_faca_cliche'];
            $object->corte_laser_minutos = $value['corte_laser_minutos'];
        }
        return $object;
    }

}

/* End of file Container_papel_acabamento_m.php */
/* Location: ./application/models/Container_papel_acabamento_m.php */