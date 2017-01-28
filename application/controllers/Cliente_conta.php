<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_conta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Orcamento_m');
        $this->load->model('Pedido_m');
        $this->load->model('Cliente_m');
        $this->load->model('Assessor_m');
        $this->load->model('Usuario_m');
        $this->load->model('Mao_obra_m');
        $this->load->model('Loja_m');
        $this->load->model('Evento_m');
        $this->load->model('Forma_pagamento_m');
        $this->load->model('Cliente_conta_m');
        $this->load->model('Adicional_m');
        $this->load->model('Container_adicional_m');

        //Sessão Produto
        $this->load->model('Produto_m');
        $this->load->model('Produto_categoria_m');
        $this->load->model('Container_produto_m');

        //Sessão Convite
        $this->load->model('Convite_m');
        $this->load->model('Convite_modelo_m');        
        $this->load->model('Container_m');
        $this->load->model('Container_papel_m');
        $this->load->model('Container_papel_acabamento_m');
        $this->load->model('Container_impressao_m');
        $this->load->model('Container_acabamento_m');
        $this->load->model('Container_acessorio_m');
        $this->load->model('Container_fita_m');

        //Sessão Personalizado
        $this->load->model('Personalizado_m');
        $this->load->model('Personalizado_modelo_m');        
        $this->load->model('Personalizado_categoria_m');        

        //Materia Prima Convite
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_catalogo_m');
        $this->load->model('Papel_dimensao_m');
        $this->load->model('Papel_acabamento_m');
        $this->load->model('Impressao_m');
        $this->load->model('Impressao_area_m');
        $this->load->model('Acabamento_m');
        $this->load->model('Acessorio_m');
        $this->load->model('Fita_m');
        $this->load->model('Fita_laco_m');
        $this->load->model('Fita_material_m');
        $this->load->model('Fita_espessura_m');

        init_layout();
        set_layout('titulo', 'Cliente_conta', FALSE);
        restrito_logado();
    }
    
    public function pagamento(){
        $id = $this->uri->segment(3); //número do pedido
        $data['pedido_debitos'] = $this->Cliente_conta_m->get_by_pedido($id,true,false);
        $data['pedido_creditos'] = $this->Cliente_conta_m->get_by_pedido($id,false,false);
        $data['adicional'] = $this->Adicional_m->get_by_pedido_id($id,null);
        $data['cliente'] = $this->Cliente_m->get_by_pedido_id($id);
        $data['forma_pagamento'] = $this->Forma_pagamento_m->get_list();
        $data['numero_pedido'] = $id;

        $data['total_debitos_pedido'] = 0;
        $data['total_creditos_pedido'] = 0;
        $data['saldo_pedido'] = 0;

        $data['adicional_debitos'] = 0;
        $data['adicional_creditos'] = 0;
        $data['saldo_total'] = 0;

        //Acumula valores de debitos e creditos de todos adicionais
        if(!empty($data['adicional'])){
            foreach ($data['adicional'] as $key => $adicional) {
                $data['adicional_debitos'] += $adicional->calcula_total_debitos();
                $data['adicional_creditos'] += $adicional->calcula_total_creditos();
            }
        }
        
        //Inicio: Débitos, Créditos e Saldo do Pedido para view
        if(!empty($data['pedido_debitos'])){
            $data['total_debitos_pedido'] = $this->Cliente_conta_m->calcula_total($data['pedido_debitos']);
        }
        if(!empty($data['pedido_creditos'])){
            $data['total_creditos_pedido'] = $this->Cliente_conta_m->calcula_total($data['pedido_creditos']);
        }
        $data['saldo_pedido'] = $data['total_creditos_pedido'] - $data['total_debitos_pedido'];

        //Total geral: Débitos, creditos e saldo
        $data['sub_total_debitos'] = $data['adicional_debitos'] + $data['total_debitos_pedido'];
        $data['sub_total_creditos'] = $data['adicional_creditos'] + $data['total_creditos_pedido'];
        $data['saldo_total'] = $data['sub_total_creditos'] - $data['sub_total_debitos'];

        set_layout('conteudo', load_content('cliente_conta/pagamento', $data));
        load_layout();
    }

    public function ajax_quitar_parcelas(){
        $this->__validar_formulario_quitacao();
        $data["status"] = TRUE;
        $id = $this->input->post('id');
        $owner = $this->input->post('quitacao_owner');
        $forma_pagamento = $this->input->post('forma_pagamento');
        $codigo_bancario = $this->input->post('codigo_bancario');

        if($owner === 'pedido'){
            $debitos = $this->Cliente_conta_m->get_by_pedido($id, true,false);
            $creditos = $this->Cliente_conta_m->get_by_pedido($id, false,false);
            $descricao = "Quitação do Pedido N° " . $id;
        }else if($owner === 'adicional'){
            $descricao = "Quitação do Adicional N° " . $id;
            $debitos = $this->Cliente_conta_m->get_by_adicional_id($id, true);
            $creditos = $this->Cliente_conta_m->get_by_adicional_id($id, false);
        }
        $parcelas = array();
        $valor_total_cancelado = 0;
        if(!empty($debitos)){
            foreach ($debitos as $key => $debito) {
                if(!$debito->cancelado){
                    $soma = 0;
                    $diferenca = 0;
                    if(!empty($creditos)){
                        foreach ($creditos as $key => $credito) {
                            if($credito->debito_referencia === $debito->id){
                                $soma += $credito->valor; 
                            }
                        }
                    }
                    //Armazenar os ID's dos débitos que não estão pagos integralmente
                    if($soma != $debito->valor){
                        $diferenca = $debito->valor - $soma;
                        $parcelas[] = array('id'=>$debito->id,'valor'=>round($diferenca,2));
                    }
                }else{
                    //$cancelados[] = array('id'=>$debito->id,'valor'=>round($debito->valor,2));
                    $valor_total_cancelado += $debito->valor;
                }
            }
        }


        $this->db->trans_begin();
        foreach ($parcelas as $key => $parcela) {
            // 40 - 20 = 20
            $restante = $parcela['valor'] + $valor_total_cancelado;

            if($restante > 0){
                $parcela['valor'] = $restante;
                $valor_total_cancelado = 0;
                $pos_descricao = " referente ao Débito ID: " . $parcela['id']."; Valor da parcela(".$parcela['valor'].") menos montante cancelado(".$valor_total_cancelado.")";
            }else{
                $parcela['valor'] = 0;
                $valor_total_cancelado = $restante ;
                $pos_descricao = " referente ao Débito ID: " . $parcela['id']. "; Valor referente a parcela menos os cancelamentos; Saldo restante do cancelamento: ".$restante;
            }

            //$pos_descricao = " referente ao Débito ID: " . $parcela['id'];
            $cliente_conta = $this->__get_post_efetuar_pagamento( $parcela['id'], $parcela['valor'], $forma_pagamento, $descricao.$pos_descricao, $codigo_bancario);
            $cliente_conta->inserir();
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
        exit();
    }

    private function __validar_formulario_quitacao(){
        $data['status'] = TRUE;

        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('data_pagamento', 'Data de pagamento', 'trim|required');
        $this->form_validation->set_rules('forma_pagamento', 'Forma de pagamento', 'trim|required');
        $this->form_validation->set_rules('codigo_bancario', 'Codigo bancário', 'trim|max_length[50]');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function ajax_excluir_pagamento(){
        $data["status"] = TRUE;
        $id = $this->input->post('id');
        if(!$this->Cliente_conta_m->deletar($id)){
            $data["status"] = FALSE;
        }
        print json_encode($data);
        exit();
    }

    public function ajax_list() {
        $list = $this->Cliente_conta_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId'=>$item->cc_id,
                'cc_data'=>$item->cc_data,
                'usr_nome'=>$item->usr_nome,
                'cc_pedido'=>$item->cc_pedido,
                'cc_vencimento'=>$item->cc_vencimento,
                'fpg_nome'=>$item->fpg_nome,
                'cc_descricao'=>$item->cc_descricao,
                'cli_nome'=>$item->cli_nome,
                'cli_sobrenome'=>$item->cli_sobrenome,
                'cli_cpf'=>$item->cli_cpf,
                'cli_cnpj'=>$item->cli_cnpj,
                'cli_email'=>$item->cli_email,
                'cc_debito'=>$item->cc_debito,
                'cc_n_parcela'=>$item->cc_n_parcela,
                'cc_codigo_bancario'=>$item->cc_codigo_bancario,
                'cc_debito_referencia'=>$item->cc_debito_referencia,
                'cc_valor'=>$item->cc_valor,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Cliente_conta_m->count_all(),
            "recordsFiltered" => $this->Cliente_conta_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_edit($id) {
        $data["debito"] = $this->Cliente_conta_m->get_by_id($id);
        $creditos = $this->Cliente_conta_m->get_by_debito_referencia_id($id);
        $soma = 0;
        if(!empty($creditos)){
            foreach ($creditos as $key => $credito) {
                $soma += $credito->valor;
            }
        }
        $valor_restante = $data["debito"]->valor - $soma;
        $data["valor_restante"] = $valor_restante;
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_efetuar_pagamento(){
        $data["status"] = TRUE;
        $this->__validar_formulario_efetuar_pagamento();
        $id = $this->input->post('id');
        $valor_pagamento = $this->input->post('valor_pagamento');
        $forma_pagamento = $this->input->post('forma_pagamento');
        $descricao = 'Pagamento do débito ID: '.$id;
        $codigo_bancario = $this->input->post('codigo_bancario');

        $cliente_conta = $this->__get_post_efetuar_pagamento( $id, $valor_pagamento, $forma_pagamento, $descricao, $codigo_bancario);
        if(!$cliente_conta->inserir()){
            $data["status"] = FALSE;
        }
        //$data['id_pedido'] = $this->input->post('pedido');
        print json_encode($data);
        exit();
    }

    private function __validar_formulario_efetuar_pagamento() {
        $data['status'] = TRUE;

        $this->form_validation->set_rules('id', 'ID', 'trim|required|callback_validation_chk_parcela_pagamento');
        $this->form_validation->set_rules('data_pagamento', 'Data de pagamento', 'trim|required|callback_validation_chk_data_pagamento');
        $this->form_validation->set_rules('forma_pagamento', 'Forma de pagamento', 'trim|required');
        $this->form_validation->set_rules('valor_pagamento', 'Valor pagamento', 'trim|required|callback_validation_decimal_positive_no_zero|callback_validation_chk_valor_pagamento');
        $this->form_validation->set_rules('codigo_bancario', 'Codigo bancário', 'trim|max_length[50]');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    private function __get_post_efetuar_pagamento( $id, $valor_pagamento, $forma_pagamento, $descricao, $codigo_bancario ) {
        $objeto = $this->Cliente_conta_m->get_by_id($id);
        $objeto->debito_referencia = $objeto->id;
        $objeto->id = null;
        $objeto->usuario = $this->session->user_id;
        $objeto->debito = 0;
        $objeto->valor = str_replace(',', '.', $valor_pagamento);
        $objeto->data = date('Y-m-d H:i:s');
        $objeto->forma_pagamento = $forma_pagamento;
        $objeto->descricao = $descricao;
        $objeto->codigo_bancario = $codigo_bancario;
        $objeto->cancelado = 0;
        return $objeto;
    }

    public function validation_decimal_positive_no_zero($value){
        $this->form_validation->set_message('validation_decimal_positive_no_zero', 'Insira um valor positivo');
        if($value <= 0){
            return false;
        }
        return true;
    }

    public function validation_chk_data_pagamento($date){
        $today = date('Y/m/d');
        $data_pedido = $this->input->post('data');
        if( strtotime($date) <= strtotime($today) && strtotime($date) >= strtotime($data_pedido)) {
            return true;
        }else{
            list($ano,$mes,$dia) = explode('-', $data_pedido);
            $data_pedido = $dia.'/'.$mes.'/'.$ano;
            $this->form_validation->set_message('validation_chk_data_pagamento','A data é inválida! A data é anterior a data do pedido '.$data_pedido.' ou posterior a data de hoje'.date('d/m/Y'));
            return false;
        }
    }

    public function validation_chk_parcela_pagamento($id){
        $debito = $this->Cliente_conta_m->get_by_id($id);
        $creditos = $this->Cliente_conta_m->get_by_debito_referencia_id($id);
        $soma = 0;
        $arr = "";
        if(!empty($creditos)){
            foreach ($creditos as $key => $credito) {
                $arr .=  "[ ID: " . $credito->id . " ] ";
                $soma += $credito->valor;
            }
        }
        $valor_restante = $debito->valor - $soma;
        if($valor_restante == 0){
            $this->form_validation->set_message('validation_chk_parcela_pagamento','Esta parcela já está paga. Confira as seguintes entradas de credito: '.$arr);
            return false;
        }
        return true;
    }

    public function validation_chk_valor_pagamento($valor){
        $id_pedido = $this->input->post('pedido');
        $id = $this->input->post('id');
        $debito = $this->Cliente_conta_m->get_by_id($id);

        $creditos = $this->Cliente_conta_m->get_by_pedido($id_pedido,false,false);
        $soma = 0;
        
        if(!empty($creditos)){
            foreach ($creditos as $key => $credito) {
                if($credito->debito_referencia === $id){
                    $soma += $credito->valor; 
                }
            }
        }
        if(round(($soma + $valor), 2) <= round($debito->valor, 2)){
            return true;
        }
        $diferenca = round($debito->valor, 2) - round($soma, 2);
        $this->form_validation->set_message('validation_chk_valor_pagamento','O valor inserido ultrapassa o montante restante. Restam R$ ' . $diferenca . ' para completar o valor da parcela total.');
        return false;
    }
}