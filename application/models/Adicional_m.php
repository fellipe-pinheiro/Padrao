<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adicional_m extends CI_Model {

    var $id;
    var $pedido;
    var $data;
    var $usuario;
    var $loja;
    var $desconto;
    var $cancelado;
    var $descricao;
    var $condicoes;
    var $convite;
    var $personalizado;
    var $produto;
    var $assessor;
    var $cliente;
    var $cliente_debitos;
    var $cliente_creditos;

    public function inserir() {
        if ($this->db->insert('adicional', $this->get_dados())) {
            $this->id = $this->db->insert_id();
            return true;
        }
        return false;
    }

    public function cancelar(){

        $valor_total = 0;

        $dados = array('cancelado'=>1);
        $this->db->where('id',$this->id);
        if(!$this->db->update('adicional',$dados)){
            return false;
        }

        if(!empty($this->convite)){
            foreach ($this->convite as $key => $convite) {
                if(!$convite->cancelado){
                    $valor_total += ($convite->calcula_total() * (-1));
                    if(!$convite->cancelar($convite->id,'adicional_convite')){
                        return false;
                    }
                }
            }
        }
        if(!empty($this->personalizado)){
            foreach ($this->personalizado as $key => $personalizado) {
                if(!$personalizado->cancelado){
                    $valor_total += ($personalizado->calcula_total() * (-1));
                    if(!$personalizado->cancelar($personalizado->id,'adicional_personalizado')){
                        return false;
                    }
                }
            }
        }
        if(!empty($this->produto)){
            foreach ($this->produto as $key => $produto) {
                if(!$produto->cancelado){
                    $valor_total += ($produto->calcula_total() * (-1));
                    if(!$produto->cancelar($produto->id,'adicional_produto')){
                        return false;
                    }
                }
            }
        }
        return $valor_total;
    }

    //Cancela o adicional caso seja o último ativo do Adicional
    public function verificar_cancelamento_adicional(){
        
        $ativos = 0;

        if(!empty($this->convite)){
            foreach ($this->convite as $key => $convite) {
                if(!$convite->cancelado){
                    $ativos ++;
                }
            }
        }
        if(!empty($this->personalizado)){
            foreach ($this->personalizado as $key => $personalizado) {
                if(!$personalizado->cancelado){
                    $ativos ++;
                }
            }
        }
        if(!empty($this->produto)){
            foreach ($this->produto as $key => $produto) {
                if(!$produto->cancelado){
                    $ativos ++;
                }
            }
        }

        if(!$ativos){
            $dados = array('cancelado'=>1);
            $this->db->where('id',$this->id);
            $this->db->update('adicional',$dados);
        }
    }

    private function get_dados() {
        $dados = array(
            'id' => $this->id,
            'pedido' => $this->pedido,
            'data' => $this->data,
            'usuario' => $this->usuario,
            'loja' => $this->loja,
            'desconto' => $this->desconto,
            'descricao' => $this->descricao,
            'condicoes' => $this->condicoes,
            'cancelado' => $this->cancelado,
            );
        return $dados;
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('adicional');
        if ($result->num_rows() > 0) {
            $result = $this->changeToObject($result->result_array(), null);
            return $result[0];
        }
        return false;
    }

    public function get_by_pedido_id($id, $orcamento) {
        $this->db->where('pedido', $id);
        $result = $this->db->get('adicional');
        if ($result->num_rows() > 0) {
            $result = $this->changeToObject($result->result_array(), $orcamento);
            return $result;
        }
        return false;
    }

    public function get_numero_documento(){
        
        return 'Adicional N°' . $this->id . '/' . $this->pedido;
    }

    public function calcula_total_debitos() {
        $soma = 0.00;
        if (!empty($this->cliente_debitos)) {
            foreach ($this->cliente_debitos as $key => $debito) {
                $soma += $debito->valor;
            }
        }
        if(round($soma,2) == -0){
            return 0.00;
        }
        return $soma;
    }

    public function calcula_total_creditos() {
        $soma = 0.00;
        if (!empty($this->cliente_creditos)) {
            foreach ($this->cliente_creditos as $key => $credito) {
                $soma += $credito->valor;
            }
        }
        return $soma;
    }

    public function calcula_saldo() {
        $total = $this->calcula_total_creditos() - $this->calcula_total_debitos();
        if(round($total,2) == -0){
            return 0.00;
        }
        return $total;
    }

    public function calcula_total_convites() {
        $total = 0.00;
        if (!empty($this->convite)) {
            foreach ($this->convite as $key => $value) {
                $total += $value->calcula_total();
            }
        }
        return $total;
    }

    public function calcula_total_personalizados() {
        $total = 0;
        if (!empty($this->personalizado)) {
            foreach ($this->personalizado as $key => $value) {
                $total += $value->calcula_total();
            }
        }
        return $total;
    }

    public function calcula_total_produtos() {
        $total = 0;
        if (!empty($this->produto)) {
            foreach ($this->produto as $key => $value) {
                $total += $value->calcula_total();
            }
        }
        return $total;
    }

    public function calcula_custos_administrativos() {
        //esta função não está sendo utilizada. Os cálculos dos custos de comissão já estão sendo cobrados nos convites, nos personalizados e nos produtos.
        return round((($this->calcula_sub_total() / 100) * $this->assessor->comissao), 2);
    }

    public function calcula_sub_total() {

        return $this->calcula_total_convites() + $this->calcula_total_produtos() + $this->calcula_total_personalizados();
    }

    public function calcula_total() {

        $total = $this->calcula_sub_total() - $this->desconto;
        return round($total, 2);
    }

    private function changeToObject($result_db, $orcamento) {
        $object_lista = array();
        if (!empty($orcamento)) {
            $convite = $orcamento->convite;
            $personalizado = $orcamento->personalizado;
            $produto = $orcamento->produto;
            $assessor = $orcamento->assessor;
            $cliente = $orcamento->cliente;
        } else {
            $convite = null;
            $personalizado = null;
            $produto = null;
        }
        foreach ($result_db as $key => $value) {
            $object = new Adicional_m();
            $object->id = $value['id'];
            $object->pedido = $value['pedido'];
            $object->data = $value['data'];
            $object->usuario = $value['usuario'];
            $object->loja = $this->Loja_m->get_by_id($value['loja']);
            $object->desconto = $value['desconto'];
            $object->descricao = $value['descricao'];
            $object->condicoes = $value['condicoes'];
            $object->cancelado = $value['cancelado'];
            if (empty($orcamento)) {
                $assessor = $this->Assessor_m->get_by_pedido_id($value['pedido']);
                $cliente = $this->Cliente_m->get_by_pedido_id($value['pedido']);
            }
            $object->assessor = $assessor;
            $object->cliente = $cliente;

            $object->convite = $this->Container_adicional_m->get_by_adicional_id($value['id'], 'adicional_convite', 'convite', $convite);
            $object->personalizado = $this->Container_adicional_m->get_by_adicional_id($value['id'], 'adicional_personalizado', 'personalizado', $personalizado);
            $object->produto = $this->Container_adicional_m->get_by_adicional_id($value['id'], 'adicional_produto', 'produto', $produto);

            $object->cliente_debitos = $this->Cliente_conta_m->get_by_adicional_id($value['id'], true);
            $object->cliente_creditos = $this->Cliente_conta_m->get_by_adicional_id($value['id'], false);
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Adicional_m.php */
/* Location: ./application/models/Adicional_m.php */