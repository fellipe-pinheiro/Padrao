<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_papel_m extends CI_Model {

    var $id;
    var $papel; //Objeto Papel_m()
    var $dimensao; //Objeto Convite_modelo_dimensao_m()
    var $owner; //string:'cartao','envelope','personalizado' :definido no get_papel() do Container_m.php
    var $quantidade;
    var $empastamento; // Objeto Papel_empastamento_m()
    var $empastado; //boolean

    public function inserir( $id, $posicao_papel_children , $posicao_papel_parent) {
        //Seto a tabela destino
        if ($this->owner == 'cartao') {
            $tabela = 'cartao_papel';
            $coluna = 'cartao';
        } else if ($this->owner == 'envelope') {
            $tabela = 'envelope_papel';
            $coluna = 'envelope';
        } else if ($this->owner == 'personalizado') {
            $tabela = 'personalizado_papel';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $dados = array(
            'id' => NULL,
            'papel' => $this->papel->id,
            'dimensao' => $this->dimensao->id,
            $coluna => $id,
            'quantidade' => $this->quantidade,
            'gramatura' => $this->papel->get_selected_papel_gramatura()->id,
            'valor' => $this->papel->get_selected_papel_gramatura()->valor,
            'empastamento' => $this->empastamento->id,
            'empastado' => $this->empastado,
            'empastamento_valor' => $this->empastamento->valor,
            'posicao_papel_children' => $posicao_papel_children,
            'posicao_papel_parent' => $posicao_papel_parent
        );
        if ($this->db->insert($tabela, $dados)) {
            $this->id = $this->db->insert_id();
        } else {
            return false;
        }
        return true;
    }

    public function get_by_container_id($id, $owner) {
        //Seto a tabela destino
        if ($owner == 'cartao') {
            $tabela = 'cartao_papel';
            $coluna = 'cartao';
        } else if ($owner == 'envelope') {
            $tabela = 'envelope_papel';
            $coluna = 'envelope';
        } else if ($owner == 'personalizado') {
            $tabela = 'personalizado_papel';
            $coluna = 'personalizado';
        } else {
            return false;
        }
        $this->db->where($coluna, $id);
        $result = $this->db->get($tabela);
        if (!empty($result->num_rows())) {
            $containers = $this->get_posicao_papel_parent_grouped($tabela, $coluna, $id);
            $result_container = array();
            foreach ($containers as $value) {
                $result_container[$value['posicao_papel_parent']] = $this->get_container_papel($tabela, $coluna,$id,$value['posicao_papel_parent'], $owner);
            }
            return $result_container;
        }
        return array();
    }

    public function get_container_papel($tabela, $coluna,$id,$posicao_papel_parent, $owner){
        $this->db->where($coluna, $id);
        $this->db->where('posicao_papel_parent', $posicao_papel_parent);
        $result = $this->db->get($tabela);
        $result_containers = array();
        $result_containers = $this->changeToObject($result->result_array(),$owner);
        return $result_containers;
    }

    public function get_posicao_papel_parent_grouped($tabela, $coluna, $id){
        $this->db->select('posicao_papel_parent');
        $this->db->where($coluna, $id);
        $this->db->group_by('posicao_papel_parent');

        $result = $this->db->get($tabela);
        if (!empty($result->num_rows())) {
            return $result->result_array();
        }else{
            return array();
        }
    }

    //CALCULA: valor unitário do papel
    public function calcula_valor_unitario($modelo, $dimensao, $qtd) {
        if ($this->owner == 'cartao' || $this->owner == 'envelope') {
            return $this->calcula_valor_unitario_convite($modelo, $dimensao, $qtd);
        }
        if ($this->owner == 'personalizado') {
            return $this->calcula_valor_unitario_personalizado($modelo, $dimensao, $qtd);
        }
    }

    private function calcula_valor_unitario_convite($modelo, $dimensao, $qtd) {
        /*
          Especificação: é passado por parametro o tamanho do modelo do convite (AlturaxLargura) e do Papel inteiro (AlturaxLargura)
          1: Calculo quantos pedaços consigo extrair de um papel inteiro
          2: Verifico quantos papeis são necessários para o pedido. Obs: se der fração, arredondo para CIMA
          3: Verifico o valor total de papeis e divido pela quantidade do pedido e retorno este valor
         */
        $altura = $dimensao->altura;
        $largura = $dimensao->largura;

        if ($this->empastado) {
            $altura += $modelo->empastamento_borda;
            $largura += $modelo->empastamento_borda;
        }
        //calcula a quantidade total de papeis para o pedido arredondando para cima
        $qtd_papeis = ceil($qtd / $this->calcula_formato($altura, $largura));
        return round(($qtd_papeis * $this->papel->get_selected_papel_gramatura()->valor) / $qtd, 2);
    }

    private function calcula_valor_unitario_personalizado($modelo, $dimensao, $qtd) {
        $altura = $dimensao->altura;
        $largura = $dimensao->largura;

        //calcula a quantidade total de papeis para o pedido arredondando para cima
        $qtd_papeis = ceil($qtd / $this->calcula_formato($altura, $largura));
        return round(($qtd_papeis * $this->papel->get_selected_papel_gramatura()->valor) / $qtd, 2);
    }

    public function calcula_valor_unitario_empastamento($qtd) {

        if ($qtd < $this->empastamento->qtd_minima) {
            return round($this->empastamento->valor / $qtd, 2);
        } else {
            return round($this->empastamento->valor / $this->empastamento->qtd_minima, 2);
        }
        return 0;
    }

    public function calcula_valor_total_empastamento($qtd, $unitario) {

        return $unitario * $qtd;
    }

    public function calcula_valor_total($qtd, $valor_unitario) {

        return $qtd * $valor_unitario;
    }

    //calculo para saber qual o aproveitamento do papel
    private function calcula_formato($altura, $largura) {
        $formato1 = intval(($this->papel->papel_dimensao->largura / $largura)) * intval(($this->papel->papel_dimensao->altura / $altura));
        $formato2 = intval(($this->papel->papel_dimensao->altura / $largura)) * intval(($this->papel->papel_dimensao->largura / $altura));
        //verifica qual o maior
        if ($formato1 > $formato2) {
            return $formato1;
        }
        return $formato2;
    }

    private function changeToObject($result_db, $owner) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Container_papel_m();
            $object->id = $value['id'];
            $object->papel = $this->Papel_m->get_by_id($value['papel']);
            $object->papel->set_papel_gramatura($value['gramatura'],$value['valor'],true);
            if($owner == 'personalizado'){
                $object->dimensao = $this->Personalizado_modelo_dimensao_m->get_by_id($value['dimensao']);
            }else{
                $object->dimensao = $this->Convite_modelo_dimensao_m->get_by_id($value['dimensao']);
            }
            $object->owner = $owner;
            $object->quantidade = $value['quantidade'];
            if( $value['posicao_papel_children'] == 0){  
                $object->empastamento = new Papel_empastamento_m();
            }else{
                $object->empastamento = $this->Papel_empastamento_m->get_by_id($value['empastamento']);
            }
            $object->empastado = $value['empastado'];
            $object_lista['papel-'.$value['posicao_papel_children']] = $object;
        }
        return $object_lista;
    }

}

/* End of file Container_papel_m.php */
/* Location: ./application/models/Container_papel_m.php */