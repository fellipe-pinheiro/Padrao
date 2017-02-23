<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_fita_m extends CI_Model {

    var $id;
    var $fita; //Objeto Fita_m()
    var $owner;
    var $quantidade;
    var $espessura;
    var $descricao;

    public function inserir($id) {
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_fita';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_fita';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_fita';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'fita' => $this->fita->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'espessura' => $this->espessura,
            'descricao' => $this->descricao,
            'valor' => $this->get_valor_espessura(),
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
            $tabela = 'cartao_fita';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_fita';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_fita';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $this->db->where($coluna, $id);
        $result = $this->db->get($tabela);
        if (!empty($result->num_rows())) {
            return $result = $this->changeToObject($result->result_array(), $owner);
        }
        return array();
    }

    //CALCULA: valor unitário do acessório
    public function calcula_valor_unitario() {
        //Especificação: o valor que vem é de um único produto já com seu valor unitário
        return $this->get_valor_espessura();
    }

    //retorna o valor referente a espessura
    public function get_valor_espessura() {
        switch ($this->espessura) {
            case 3:
                return $this->fita->valor_03mm;
                break;
            case 7:
                return $this->fita->valor_07mm;
                break;
            case 10:
                return $this->fita->valor_10mm;
                break;
            case 15:
                return $this->fita->valor_15mm;
                break;
            case 22:
                return $this->fita->valor_22mm;
                break;
            case 38:
                return $this->fita->valor_38mm;
                break;
            case 50:
                return $this->fita->valor_50mm;
                break;
            case 70:
                return $this->fita->valor_70mm;
                break;
            default:
                return 0;
                break;
        }
    }

    //Atribui o valor em que foi realizado o orçamento para a espessura correspondente
    public function set_valor_espessura($fita, $espessura, $valor) {
        switch ($espessura) {
            case 3:
                return $fita->valor_03mm = $valor;
                break;
            case 7:
                return $fita->valor_07mm = $valor;
                break;
            case 10:
                return $fita->valor_10mm = $valor;
                break;
            case 15:
                return $fita->valor_15mm = $valor;
                break;
            case 22:
                return $fita->valor_22mm = $valor;
                break;
            case 38:
                return $fita->valor_38mm = $valor;
                break;
            case 50:
                return $fita->valor_50mm = $valor;
                break;
            case 70:
                return $fita->valor_70mm = $valor;
                break;
            default:
                return 0;
                break;
        }
    }

    //CALCULA: valor total
    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_fita_m();
            $object->id = $value['id'];
            $object->fita = $this->Fita_m->get_by_id($value['fita']);
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            $object->espessura = $value['espessura'];
            $object->descricao = $value['descricao'];
            $this->set_valor_espessura($object->fita, $object->espessura, $value['valor']);
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_fita_m.php */
/* Location: ./application/models/Container_fita_m.php */