<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //Pedido
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
        set_layout('titulo', 'Pedido', FALSE);
        empty($this->session->pedido) ? $this->__criar_pedido() : '';
        restrito_logado();
    }

    public function index() {
        $data = null;
        set_layout('conteudo', load_content('pedido/index', $data));
        load_layout();
    }

    private function __criar_pedido() {
        $this->session->pedido = new Pedido_m();
        $this->session->pedido->cliente_conta = array();
        $this->session->pedido->cancelado = 0;
    }

    public function ajax_list() {
        $list = $this->Pedido_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->ped_id,
                'ped_data' => $item->ped_data,
                'cli_nome' => $item->cli_nome,
                'cli_sobrenome' => $item->cli_sobrenome,
                'cli_email' => $item->cli_email,
                'cli_telefone' => $item->cli_telefone,
                'cli_cpf' => $item->cli_cpf,
                'cli_cnpj' => $item->cli_cnpj,
                'cli_razao_social' => $item->cli_razao_social,
                'cli_pessoa_tipo' => $item->cli_pessoa_tipo,
                'orc_id' => $item->orc_id,
                'orc_data' => $item->orc_data,
                'descricao' => $item->orc_descricao,
                'condicoes' => $item->ped_condicoes,
                'data_evento' => $item->orc_data_evento,
                'evento' => $item->evento_nome,
                'loja' => $item->loja_unidade,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pedido_m->count_all(),
            "recordsFiltered" => $this->Pedido_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function lista() {
        $data['titulo_painel'] = 'Lista de pedidos';
        set_layout('conteudo', load_content('pedido/lista', $data));
        load_layout();
    }

    public function pdf() {
        $id = $this->uri->segment(3);
        $data['pedido'] = $this->Pedido_m->get_by_id($id);
        list($date, $hour) = explode(" ", $data['pedido']->data);
        list($ano, $mes, $dia) = explode("-", $date);
        $data['data'] = $dia . "/" . $mes . "/" . $ano . " " . $hour;
        $data['documento_numero'] = "<h3 class='pull-right'><strong>Pedido Nº ". $data['pedido']->id ."</strong></h3>";
        set_layout('conteudo', load_content('pedido/pdf', $data));
        load_layout();
    }

    public function resumo() {
        $id = $this->uri->segment(3);
        $data['pedido'] = $this->Pedido_m->get_by_id($id);

        list($date, $hour) = explode(" ", $data['pedido']->data);
        list($ano, $mes, $dia) = explode("-", $date);
        $data['data'] = $dia . "/" . $mes . "/" . $ano;
        $data['documento_numero'] = "<strong>Pedido Nº ".$data['pedido']->id."</strong>";

        $data['total_debitos'] = 0;
        $data['total_creditos'] = 0;
        $data['saldo'] = 0;
        if (!empty($data['pedido']->cliente_debitos)) {
            $soma = 0;
            foreach ($data['pedido']->cliente_debitos as $key => $debito) {
                $soma += $debito->valor;
            }
            $data['total_debitos'] = $soma;
        }
        if (!empty($data['pedido']->cliente_creditos)) {
            $soma = 0;
            foreach ($data['pedido']->cliente_creditos as $key => $credito) {
                $soma += $credito->valor;
            }
            $data['total_creditos'] = $soma;
        }
        $data['saldo'] = $data['total_creditos'] - $data['total_debitos'];
        set_layout('conteudo', load_content('pedido/resumo', $data));
        load_layout();
    }

    public function editar() {
        $id = $this->uri->segment(3);
        $data['pedido'] = $this->Pedido_m->get_by_id($id);
        $data['documento_numero'] = "<strong>Pedido Nº " . sprintf('%08d', $data['pedido']->id) . "</strong>";
        $data['forma_pagamento'] = $this->Forma_pagamento_m->get_list();
        $data['lojas'] = $this->Loja_m->get_list();
        set_layout('conteudo', load_content('pedido/editar', $data));
        load_layout();
    }

    public function ajax_alterar_data_entrega() {
        $data['status'] = TRUE;
        $owner = $this->uri->segment(3);
        $id = $this->input->post('id');
        //$posicao = $this->input->post('posicao');
        $input_post = $this->input->post('input_post');
        $this->__validar_formulario_altera_data_entrega($input_post);
        $data_entrega = $this->__format_date($this->input->post($input_post));

        if ($owner === 'convite') {
            if (!$this->Convite_m->altera_data_entrega($id, $data_entrega)) {
                $data['status'] = FALSE;
            }
        } else if ($owner === 'personalizado') {
            if (!$this->Personalizado_m->altera_data_entrega($id, $data_entrega)) {
                $data['status'] = FALSE;
            }
        } else if ($owner === 'produto') {
            if (!$this->Container_produto_m->altera_data_entrega($id, $data_entrega)) {
                $data['status'] = FALSE;
            }
        }
        print json_encode($data);
        exit();
    }

    public function ajax_alterar_data_entrega_adicional() {
        $data['status'] = TRUE;
        $owner = $this->uri->segment(3);
        $id = $this->input->post('id');
        $input_post = $this->input->post('input_post');
        $this->__validar_formulario_altera_data_entrega($input_post);
        $data_entrega = $this->__format_date($this->input->post($input_post));

        if ($owner === 'convite') {
            if (!$this->Container_adicional_m->altera_data_entrega($id, $data_entrega, 'adicional_convite')) {
                $data['status'] = FALSE;
            }
        } else if ($owner === 'personalizado') {
            if (!$this->Container_adicional_m->altera_data_entrega($id, $data_entrega, 'adicional_personalizado')) {
                $data['status'] = FALSE;
            }
        } else if ($owner === 'produto') {
            if (!$this->Container_adicional_m->altera_data_entrega($id, $data_entrega, 'adicional_produto')) {
                $data['status'] = FALSE;
            }
        }
        print json_encode($data);
        exit();
    }

    public function __validar_formulario_altera_data_entrega($input_post) {
        $this->form_validation->set_rules($input_post, 'Data Entrega', 'callback_validation_date_before_today|callback_validation_valid_date');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function ajax_criar_adicional_pedido() {

        $data['status'] = TRUE;
        $id_pedido = $this->uri->segment(3);
        $pedido = $this->Pedido_m->get_by_id($id_pedido);
        $convites = $pedido->orcamento->convite;
        $personalizados = $pedido->orcamento->personalizado;
        $produtos = $pedido->orcamento->produto;
        $valor_total_pedido_adicional = 0;
        $desconto_pedido_adicional = 0;

        //Valida os convites
        if (!empty($convites)) {
            $this->__validar_formulario_criar_adicional_pedido_produtos($convites, 'convite');
        }
        //Valida os personalizados
        if (!empty($personalizados)) {
            $this->__validar_formulario_criar_adicional_pedido_produtos($personalizados, 'personalizado');
        }
        //Valida os produtos
        if (!empty($produtos)) {
            $this->__validar_formulario_criar_adicional_pedido_produtos($produtos, 'produto');
        }
        $this->__validar_formulario_criar_adicional_pedido();

        if (!empty($this->input->post('input-adicional-desconto'))) {
            $desconto_pedido_adicional = $this->input->post('input-adicional-desconto');
        }

        //criar um Adicional_m
        $adicional = new Adicional_m();
        $adicional->id = null;
        $adicional->pedido = $pedido->id;
        $adicional->data = date('Y-m-d H:i:s');
        $adicional->usuario = $this->session->user_id;
        $adicional->loja = $this->input->post('loja');
        $adicional->descricao = $this->input->post('descricao');
        $adicional->condicoes = $this->input->post('condicoes');
        $adicional->desconto = $desconto_pedido_adicional;
        $adicional->cancelado = 0;

        $this->db->trans_begin();

        //inserir o adicional na tabela
        if (!$adicional->inserir()) {
            $data['status'] = FALSE;
        }

        //Se houver convite para ser inserido como adicional, gravar na tabela
        if (!empty($convites)) {
            foreach ($convites as $key => $convite) {
                $valor_total_pedido_adicional += $this->__get_container_adicional($key, $convite->cancelado, 'convite', $adicional->id, $convite->id, 0, $convite->calcula_unitario());
            }
        }
        if (!empty($personalizados)) {
            foreach ($personalizados as $key => $personalizado) {
                $valor_total_pedido_adicional += $this->__get_container_adicional($key, $personalizado->cancelado, 'personalizado', $adicional->id, $personalizado->id, 0, $personalizado->calcula_unitario());
            }
        }
        if (!empty($produtos)) {
            foreach ($produtos as $key => $produto) {
                $valor_total_pedido_adicional += $this->__get_container_adicional($key, $produto->cancelado, 'produto', $adicional->id, $produto->id, 0, $produto->calcula_unitario());
            }
        }

        //$custos_adm = round(($valor_total_pedido_adicional / 100) * $pedido->orcamento->assessor->comissao, 2); //$custos_adm não esta sendo utilizado, pois ja está embutido nos produtos
        $valor_total_pedido_adicional += -$adicional->desconto;
        $num_total_parcelas = $this->input->post('qtd_parcelas');
        for ($parcela = 1; $parcela <= $this->input->post('qtd_parcelas'); $parcela++) {
            $cliente_conta = $this->__get_cliente_conta($parcela, $valor_total_pedido_adicional, "Parcela " . ($parcela) . "/" . $num_total_parcelas . " do Adicional Nº " . $pedido->id . "/" . $adicional->id, 1, $adicional->id);
            $cliente_conta->pedido = $pedido->id;
            $cliente_conta->inserir();
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
            $data['adicional_id'] = $adicional->id;
        }
        print json_encode($data);
        exit();
    }

    private function __get_container_adicional($key, $objeto_cancelado, $owner, $adicional_id, $objeto_id, $cancelado, $objeto_valor_unitario) {
        $sub_total = 0;
        $valor_extra = $this->input->post('valor_extra-adicional-' . $owner . '-' . $key);
        if (empty($valor_extra)) {
            $valor_extra = 0;
        }
        if ($this->input->post('checkbox-adicional-' . $owner . '-' . $key) && !$objeto_cancelado) {
            $container_adicional = new Container_adicional_m();
            $container_adicional->id = null;
            $container_adicional->owner = $owner;
            $container_adicional->adicional = $adicional_id;
            $container_adicional->objeto = $objeto_id;
            $container_adicional->quantidade = $this->input->post('qtd-adicional-' . $owner . '-' . $key);
            $container_adicional->data_entrega = $this->__format_date($this->input->post('data_entrega-adicional-' . $owner . '-' . $key));
            $container_adicional->valor_extra = $valor_extra;
            $container_adicional->cancelado = $cancelado;

            $container_adicional->inserir();

            //Retorna o sub_total do objeto enviado
            $sub_total = round(($objeto_valor_unitario + $container_adicional->valor_extra) * $container_adicional->quantidade, 2);
            return $sub_total;
        }
    }

    private function __validar_formulario_criar_adicional_pedido() {
        //input-adicional-desconto
        $this->form_validation->set_rules('input-adicional-desconto', 'Desconto', 'trim|callback_validation_decimal_positive');
        $this->form_validation->set_rules('loja', 'Loja', 'trim|required');
        $this->__condicoes_forma_pagamento();

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    private function __validar_formulario_criar_adicional_pedido_produtos($objetos, $produto) {

        foreach ($objetos as $key => $objeto) {
            //Padrão ex: Checkbox checkbox-adicional-convite-0
            if ($this->input->post('checkbox-adicional-' . $produto . '-' . $key) && !$objeto->cancelado) {
                //Padrão ex: Input data_entrega data_entrega-adicional-convite-0
                $this->form_validation->set_rules('data_entrega-adicional-' . $produto . '-' . $key, 'Data Entrega', 'trim|required|callback_validation_date_before_today|callback_validation_valid_date');
                //Padrão ex: Input quantidade qtd-adicional-convite-0
                $this->form_validation->set_rules('qtd-adicional-' . $produto . '-' . $key, 'qtd', 'trim|required|callback_validation_decimal_positive|callback_validation_no_leading_zeroes|is_natural_no_zero');
                //Padrão ex: Input valor_extra valor_extra-adicional-convite-0
                $this->form_validation->set_rules('valor_extra-adicional-' . $produto . '-' . $key, 'Valor extra', 'trim|callback_validation_decimal_positive');
            }
        }
    }

    public function ajax_cancelar_pedido(){
        //Cancela todo o pedido e seus respectivos adicionais
        $data['status'] = TRUE;
        $this->__validar_formulario_ajax_cancelar();
        $this->db->trans_begin();
        $id = $this->input->post('id');
        $pedido = $this->Pedido_m->get_by_id($id);
        $multa_valor = $this->input->post('multa_valor');
        $descricao = $this->input->post('descricao');
        $forma_pagamento = null;
        $produto_nome = "";
        $valor_total = 0.00;
        //$comissao = 0.00;
        //$assessor_comissao = $pedido->orcamento->assessor->comissao;
        //$porcentagem_total = 100 + $assessor_comissao;

        $valor_total = $pedido->cancelar();

        //$comissao = $this->calcula_comissao($valor_total, $assessor_comissao, $porcentagem_total);

        $this->__create_cliente_conta_cancelamento($valor_total, $pedido->id, $forma_pagamento, "Cancelamento do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
        //Insere valor dos custos administrativos (valor negativo)
        //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
        //Insere o valor da multa acumulada somente para o pedido (valor positivo)
        //TODO constante do vencimento
        if (!empty($multa_valor) && $multa_valor > 0) {
            $this->__create_cliente_conta_cancelamento($multa_valor, $pedido->id, $forma_pagamento, "Multa pelo cancelamento do Pedido N° " . $pedido->id, 0, date("Y-m-d", strtotime(date('Y-m-d') . ' + 7 days')), 1, 0, null);
        }

        if(!empty($pedido->adicional)){
            foreach ($pedido->adicional as $key => $adicional) {
                $valor_total = 0.00;
                //$comissao = 0.00;
                if(!$adicional->cancelado){
                    $valor_total = $adicional->cancelar();
                    //$comissao = ($valor_total / 100) * $pedido->orcamento->assessor->comissao;
                    //$comissao = $this->calcula_comissao($valor_total, $assessor_comissao, $porcentagem_total);
                    $this->__create_cliente_conta_cancelamento($valor_total, $adicional->pedido, $forma_pagamento, "Cancelamento do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                    //$this->__create_cliente_conta_cancelamento($comissao, $adicional->pedido, $forma_pagamento, "Cancelamento dos custos adm do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                }
            }
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

    public function ajax_cancelar_adicional(){
        //Cancela o Adicional com todos os produtos que não foram cancelados
        $data['status'] = TRUE;
        $this->__validar_formulario_ajax_cancelar();
        $this->db->trans_begin();
        $id = $this->input->post('id');
        $adicional = $this->Adicional_m->get_by_id($id);
        $multa_valor = $this->input->post('multa_valor');
        $descricao = $this->input->post('descricao');
        $forma_pagamento = null;
        $produto_nome = "";
        $valor_total = 0.00;
        //$comissao = 0.00;
        //$assessor_comissao = $adicional->assessor->comissao;
        //$porcentagem_total = 100 + $assessor_comissao;

        $valor_total = $adicional->cancelar();

        //$comissao = ($valor_total / 100) * $adicional->assessor->comissao;
        //$comissao = $this->calcula_comissao($valor_total, $assessor_comissao, $porcentagem_total);

        $this->__create_cliente_conta_cancelamento($valor_total, $adicional->pedido, $forma_pagamento, "Cancelamento do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
        //Insere valor dos custos administrativos (valor negativo)
        //$this->__create_cliente_conta_cancelamento($comissao, $adicional->pedido, $forma_pagamento, "Cancelamento dos custos adm do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
        //Insere o valor da multa (valor positivo)
        //TODO constante do vencimento
        if (!empty($multa_valor) && $multa_valor > 0) {
            $this->__create_cliente_conta_cancelamento($multa_valor, $adicional->pedido, $forma_pagamento, "Multa pelo cancelamento do Adicional N° " . $adicional->id, 0, date("Y-m-d", strtotime(date('Y-m-d') . ' + 7 days')), 1, 1, $adicional->id);
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

    public function ajax_cancelar_pedido_item() {
        //Cancela todos os itens do pedido e dos adicionais com o mesmo ID
        //Ex: todos os convites que tem o mesmo ID da tabela orcamento_convite
        $this->__validar_formulario_ajax_cancelar();
        $this->db->trans_begin();
        $data['status'] = TRUE;
        $id_pedido = $this->uri->segment(3);
        $pedido = $this->Pedido_m->get_by_id($id_pedido);
        $owner = $this->input->post('owner');
        $id = $this->input->post('id');
        $multa_valor = $this->input->post('multa_valor');
        $descricao = $this->input->post('descricao');
        $forma_pagamento = null;
        $produto_nome = "";
        //$comissao = 0.00;
        //$assessor_comissao = $pedido->orcamento->assessor->comissao;
        //$porcentagem_total = 100 + $assessor_comissao;

        $valor_total_itens = 0;
        if ($owner === "convite") {
            if (!empty($pedido->orcamento->convite)) {
                foreach ($pedido->orcamento->convite as $key => $convite) {
                    if ($id === $convite->id && !$convite->cancelado) {
                        $valor_total_itens = ($convite->calcula_total() * (-1));
                        $produto_nome = $convite->modelo->nome;
                        $produto_nome .= "/ Cod: " . $convite->id;
                        //$comissao = ($valor_total_itens / 100) * $pedido->orcamento->assessor->comissao;
                        //$comissao = $this->calcula_comissao($valor_total_itens, $assessor_comissao, $porcentagem_total);

                        $this->__create_cliente_conta_cancelamento($valor_total_itens, $pedido->id, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . " do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
                        //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . " do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
                        break;
                    }
                }
            }
            if (!empty($pedido->adicional)) {
                foreach ($pedido->adicional as $key => $adicional) {
                    $valor_total_itens = 0; // Sempre zerar o valor para cada adicional
                    if (!empty($adicional->convite)) {
                        foreach ($adicional->convite as $key => $convite) {
                            if ($id === $convite->objeto->id && !$convite->cancelado) {
                                $valor_total_itens += ($convite->calcula_total() * (-1));
                                //$comissao = ($valor_total_itens / 100) * $pedido->orcamento->assessor->comissao;
                                //$comissao = $this->calcula_comissao($valor_total_itens, $assessor_comissao, $porcentagem_total);

                                $this->__create_cliente_conta_cancelamento($valor_total_itens, $pedido->id, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . " do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                                //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . " do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                                break;
                            }
                        }
                    }
                }
            }
            $this->Convite_m->cancelar($id);
            $this->Container_adicional_m->cancel_all($id, 'adicional_convite', 'orcamento_convite');
        } else if ($owner === "personalizado") {
            if (!empty($pedido->orcamento->personalizado)) {
                foreach ($pedido->orcamento->personalizado as $key => $personalizado) {
                    if ($id === $personalizado->id && !$personalizado->cancelado) {
                        $valor_total_itens = ($personalizado->calcula_total() * (-1));
                        $produto_nome = $personalizado->modelo->nome;
                        $produto_nome .= "/ Cod: " . $personalizado->id;
                        //$comissao = ($valor_total_itens / 100) * $pedido->orcamento->assessor->comissao;
                        //$comissao = $this->calcula_comissao($valor_total_itens, $assessor_comissao, $porcentagem_total);

                        $this->__create_cliente_conta_cancelamento($valor_total_itens, $pedido->id, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . " do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
                        //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . " do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
                        break;
                    }
                }
            }
            if (!empty($pedido->adicional)) {
                foreach ($pedido->adicional as $key => $adicional) {
                    $valor_total_itens = 0; // Sempre zerar o valor para cada adicional
                    if (!empty($adicional->personalizado)) {
                        foreach ($adicional->personalizado as $key => $personalizado) {
                            if ($id === $personalizado->objeto->id && !$personalizado->cancelado) {
                                $valor_total_itens += ($personalizado->calcula_total() * (-1));
                                //$comissao = ($valor_total_itens / 100) * $pedido->orcamento->assessor->comissao;
                                //$comissao = $this->calcula_comissao($valor_total_itens, $assessor_comissao, $porcentagem_total);

                                $this->__create_cliente_conta_cancelamento($valor_total_itens, $pedido->id, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . " do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                                //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . " do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                                break;
                            }
                        }
                    }
                }
            }
            $this->Personalizado_m->cancelar($id);
            $this->Container_adicional_m->cancel_all($id, 'adicional_personalizado', 'orcamento_personalizado');
        } else if ($owner === "produto") {
            if (!empty($pedido->orcamento->produto)) {
                foreach ($pedido->orcamento->produto as $key => $produto) {
                    if ($id === $produto->id && !$produto->cancelado) {
                        $valor_total_itens = ($produto->calcula_total() * (-1));
                        $produto_nome = $produto->produto->nome;
                        $produto_nome .= "/ Cod: " . $produto->produto->id;
                        //$comissao = ($valor_total_itens / 100) * $pedido->orcamento->assessor->comissao;
                        //$comissao = $this->calcula_comissao($valor_total_itens, $assessor_comissao, $porcentagem_total);

                        $this->__create_cliente_conta_cancelamento($valor_total_itens, $pedido->id, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . " do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
                        //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . " do Pedido N° " . $pedido->id, 1, null, 0, 0, null);
                        break;
                    }
                }
            }
            if (!empty($pedido->adicional)) {
                foreach ($pedido->adicional as $key => $adicional) {
                    $valor_total_itens = 0; // Sempre zerar o valor para cada adicional
                    if (!empty($adicional->produto)) {
                        foreach ($adicional->produto as $key => $produto) {
                            if ($id === $produto->objeto->id && !$produto->cancelado) {
                                $valor_total_itens += ($produto->calcula_total() * (-1));
                                //$comissao = ($valor_total_itens / 100) * $pedido->orcamento->assessor->comissao;
                                //$comissao = $this->calcula_comissao($valor_total_itens, $assessor_comissao, $porcentagem_total);

                                $this->__create_cliente_conta_cancelamento($valor_total_itens, $pedido->id, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . " do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                                //$this->__create_cliente_conta_cancelamento($comissao, $pedido->id, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . " do Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
                                break;
                            }
                        }
                    }
                }
            }
            //TODO constante do vencimento
            //A multa é acumulada e aplicada somente para o pedido
            if (!empty($multa_valor) && $multa_valor > 0) {
                $this->__create_cliente_conta_cancelamento($multa_valor, $pedido->id, $forma_pagamento, $produto_nome, "Multa pelo cancelamento do produto : " . $produto_nome . " do Pedido N° " . $pedido->id, 0, date("Y-m-d", strtotime(date('Y-m-d') . ' + 7 days')), 1, 0, null);
            }
            $this->Container_produto_m->cancelar($id);
            $this->Container_adicional_m->cancel_all($id, 'adicional_produto', 'orcamento_produto');
        }

        $pedido = $this->Pedido_m->get_by_id($id_pedido);
        $pedido->verificar_cancelamento_pedido();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }

        print json_encode($data);
        exit();
    }

    public function ajax_cancelar_adicional_item() {
        $this->__validar_formulario_ajax_cancelar();
        $this->db->trans_begin();
        $data['status'] = TRUE;
        $id_pedido = $this->uri->segment(3);
        $owner = $this->input->post('owner');
        $id_origem = $this->input->post('id_origem');
        $id = $this->input->post('id');
        $id_adicional = $this->input->post('cancel_numero_documento');
        $adicional = $this->Adicional_m->get_by_id($id_adicional);
        $multa_valor = $this->input->post('multa_valor');
        $descricao = $this->input->post('descricao');
        //$assessor_comissao = $adicional->assessor->comissao;
        //$porcentagem_total = 100 + $adicional->assessor->comissao;

        $forma_pagamento = null;
        $produto_nome = "";
        //$comissao = 0.00;
        $valor_item = 0;

        if ($owner === "convite") {
            foreach ($adicional->convite as $key => $convite) {
                if ($convite->objeto->id === $id_origem && !$convite->cancelado) {
                    $valor_item = ($convite->calcula_total() * (-1));
                    $produto_nome = $convite->objeto->modelo->nome;
                    $produto_nome .= "/ Cod: " . $convite->id;
                    break;
                }
            }
            $this->Container_adicional_m->cancelar($id, 'adicional_convite');
        } else if ($owner === "personalizado") {
            foreach ($adicional->personalizado as $key => $personalizado) {
                if ($personalizado->objeto->id === $id_origem && !$personalizado->cancelado) {
                    $valor_item = ($personalizado->calcula_total() * (-1));
                    $produto_nome = $personalizado->objeto->modelo->nome;
                    $produto_nome .= "/ Cod: " . $personalizado->id;
                    break;
                }
            }
            $this->Container_adicional_m->cancelar($id, 'adicional_personalizado');
        } else if ($owner === "produto") {
            foreach ($adicional->produto as $key => $produto) {
                if ($produto->objeto->id === $id_origem && !$produto->cancelado) {
                    $valor_item = ($produto->calcula_total() * (-1));
                    $produto_nome = $produto->objeto->produto->nome;
                    $produto_nome .= "/ Cod: " . $produto->id;
                    break;
                }
            }
            $this->Container_adicional_m->cancelar($id, 'adicional_produto');
        }

        //Comissão já está com o valor negativo
        //$comissao = ($valor_item / 100) * $adicional->assessor->comissao;
        //$comissao = $this->calcula_comissao($valor_item, $assessor_comissao, $porcentagem_total);

        //Insere valor do produto (valor negativo)
        $this->__create_cliente_conta_cancelamento($valor_item, $id_pedido, $forma_pagamento, "Cancelamento do produto: " . $produto_nome . "/ Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
        //Insere valor dos custos administrativos (valor negativo)
        //$this->__create_cliente_conta_cancelamento($comissao, $id_pedido, $forma_pagamento, "Cancelamento dos custos adm do produto: " . $produto_nome . "/ Adicional N° " . $adicional->id, 1, null, 0, 1, $adicional->id);
        //Insere o valor da multa (valor positivo)
        //TODO constante do vencimento
        if (!empty($multa_valor) && $multa_valor > 0) {
            $this->__create_cliente_conta_cancelamento($multa_valor, $id_pedido, $forma_pagamento, "Multa pelo cancelamento do produto : " . $produto_nome . "/ Adicional N° " . $adicional->id, 0, date("Y-m-d", strtotime(date('Y-m-d') . ' + 7 days')), 1, 1, $adicional->id);
        }

        //se não haver ativos, cancela o adicional
        $adicional = $this->Adicional_m->get_by_id($id_adicional);
        $adicional->verificar_cancelamento_adicional();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }

        print json_encode($data);
        exit();
    }

    private function __validar_formulario_ajax_cancelar() {
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|max_length[100]');
        $this->form_validation->set_rules('multa_valor', 'Valor da multa', 'trim|callback_validation_decimal_positive');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    private function __create_cliente_conta_cancelamento($valor, $id_pedido, $forma_pagamento, $pre_descricao, $cancelado, $vencimento, $multa,$adicional,$adicional_id) {
        $objeto = new Cliente_conta_m();
        $objeto->id = null;
        $objeto->usuario = $this->session->user_id;
        $objeto->pedido = $id_pedido;
        $objeto->data = date('Y-m-d H:i:s');
        $objeto->vencimento = $vencimento;
        $objeto->forma_pagamento = $forma_pagamento;
        $objeto->descricao = $pre_descricao . " (" . $this->input->post('descricao') . " )";
        $objeto->primeiro_vencimento = null;
        $objeto->vencimento_dia = null;
        $objeto->debito = 1;
        $objeto->valor = str_replace(',', '.', $valor);
        $objeto->n_parcela = null;
        $objeto->codigo_bancario = null;
        $objeto->debito_referencia = null;
        $objeto->cancelado = $cancelado;
        $objeto->adicional = $adicional;
        $objeto->multa = $multa;
        $objeto->adicional_id = $adicional_id;
        $objeto->inserir();
    }

    // private function calcula_comissao($valor_total, $assessor_comiisao, $porcentagem_total){
    //     return ($valor_total * $assessor_comiisao) / $porcentagem_total;
    // }
    public function ajax_get_parcelas_pedido() {
        //TODO constante do número máximo de parcelas
        $qtd_parcelas = 12; //numero máximo de parcelas
        $valor_total = $this->session->orcamento->calcula_total();
        $data = array();

        for ($i = 1; $i <= $qtd_parcelas; $i++) {
            $temp["value"] = $i;
            $temp["text"] = $i . " x R$ " . number_format($valor_total / $i, 2, ",", ".");
            $data[] = $temp;
        }
        print json_encode($data);
    }

    public function ajax_set_date_delivery() {
        $posicao = $this->input->post('posicao');
        $data['status'] = FALSE;
        $item = $this->uri->segment(3);
        if ($item === 'convite') {
            $this->__validar_date_delivery('convite-', $posicao);
            $this->session->orcamento->convite[$posicao]->data_entrega = $this->input->post('data_entrega-convite-' . $posicao);
            $data['status'] = TRUE;
        } else if ($item === 'personalizado') {
            $this->__validar_date_delivery('personalizado-', $posicao);
            $this->session->orcamento->personalizado[$posicao]->data_entrega = $this->input->post('data_entrega-personalizado-' . $posicao);
            $data['status'] = TRUE;
        } else if ($item === 'produto') {
            $this->__validar_date_delivery('produto-', $posicao);
            $this->session->orcamento->produto[$posicao]->data_entrega = $this->input->post('data_entrega-produto-' . $posicao);
            $data['status'] = TRUE;
        }
        print json_encode($data);
        exit();
    }

    private function __validar_date_delivery($item, $posicao) {
        $this->form_validation->set_rules('data_entrega-' . $item . $posicao, 'Data Entrega', 'callback_validation_date_before_today|callback_validation_valid_date');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function ajax_is_set_delivery_date() {
        $data['status'] = false;
        $data['date_found'] = false;
        if (!empty($this->session->orcamento->convite)) {
            foreach ($this->session->orcamento->convite as $key => $convite) {
                if (empty($convite->data_entrega) || $convite->data_entrega === '00/00/0000') {
                    $data['status'] = true;
                    print json_encode($data);
                    exit();
                } else {
                    $data['date_found'] = true;
                }
            }
        }
        if (!empty($this->session->orcamento->personalizado)) {
            foreach ($this->session->orcamento->personalizado as $key => $personalizado) {
                if (empty($personalizado->data_entrega) || $personalizado->data_entrega === '00/00/0000') {
                    $data['status'] = true;
                    print json_encode($data);
                    exit();
                } else {
                    $data['date_found'] = true;
                }
            }
        }
        if (!empty($this->session->orcamento->produto)) {
            foreach ($this->session->orcamento->produto as $key => $produto) {
                if (empty($produto->data_entrega) || $produto->data_entrega === '00/00/0000') {
                    $data['status'] = true;
                    print json_encode($data);
                    exit();
                } else {
                    $data['date_found'] = true;
                }
            }
        }
        print json_encode($data);
        exit();
    }

    public function ajax_forma_pagamento() {
        $this->__criar_pedido();
        $data['status'] = TRUE;
        $this->__validar_formulario_forma_pagamento();
        $this->session->pedido->condicoes = $this->input->post('condicoes');
        $num_total_parcelas = $this->input->post('qtd_parcelas');

        for ($parcela = 1; $parcela <= $num_total_parcelas; $parcela++) {
            $cliente_conta = $this->__get_cliente_conta($parcela, $this->session->orcamento->calcula_total(), "Parcela " . ($parcela) . "/" . $num_total_parcelas, 0, null);
            $this->session->pedido->cliente_conta[] = $cliente_conta;
        }
        print json_encode($data);
        exit();
    }

    private function __get_cliente_conta($parcela, $total_pedido, $descricao, $adicional, $adicional_id) {

        $cliente_conta = new Cliente_conta_m();
        $cliente_conta->id = null;
        $cliente_conta->usuario = $this->session->user_id;
        $cliente_conta->pedido = null;
        $cliente_conta->data = date('Y-m-d H:i:s');
        $cliente_conta->n_parcela = $parcela;
        $cliente_conta->primeiro_vencimento = $this->input->post('primeiro_vencimento');
        $cliente_conta->vencimento_dia = $this->input->post('vencimento_dia');
        $cliente_conta->forma_pagamento = $this->input->post('forma_pagamento');
        $cliente_conta->valor = $this->__round_down($total_pedido / $this->input->post('qtd_parcelas'));
        $cliente_conta->vencimento = $cliente_conta->set_vencimento($parcela);
        $cliente_conta->debito = true;
        $cliente_conta->codigo_bancario = null;
        $cliente_conta->descricao = $descricao;
        $cliente_conta->cancelado = 0;
        $cliente_conta->adicional = $adicional;
        $cliente_conta->multa = 0;
        $cliente_conta->adicional_id = $adicional_id;

        if ($parcela == 1) {
            $total_parcelas = $this->__round_down(($total_pedido / $this->input->post('qtd_parcelas'))) * $this->input->post('qtd_parcelas');
            $diferenca = round($total_pedido - $total_parcelas, 2);
            $cliente_conta->valor += round($diferenca, 2);
        }
        return $cliente_conta;
    }

    private function __round_down($number, $precision = 3) {
        $fig = (int) str_pad('1', $precision, '0');
        return (floor($number * $fig) / $fig);
    }

    private function __validar_formulario_forma_pagamento() {
        $this->__condicoes_forma_pagamento();
        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    private function __condicoes_forma_pagamento() {
        $this->form_validation->set_rules('qtd_parcelas', 'Quantidade de parcelas', 'trim|required|max_length[2]|callback_validation_decimal_positive|callback_validation_no_leading_zeroes|is_natural_no_zero');
        if($this->input->post('qtd_parcelas') > 1){
            $this->form_validation->set_rules('vencimento_dia', 'Dias de vencimento', 'trim|required');
        }
        $this->form_validation->set_rules('forma_pagamento', 'Forma de pagamento', 'trim|required');
        $this->form_validation->set_rules('primeiro_vencimento', 'Primeiro vencimento', 'trim|required|callback_validation_date_before_today');
        $this->form_validation->set_rules('condicoes', 'Condições', 'trim');
    }

    public function ajax_salvar() {
        $data['status'] = TRUE;

        $this->db->trans_begin();
        //Salvar orçamento
        $this->session->orcamento->inserir();

        //Salvar pedido
        $pedido = $this->session->pedido;
        $pedido->orcamento = $this->session->orcamento;
        $pedido->inserir();
        $data['id'] = $pedido->id;

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
    }

    public function validation_date_before_today($date) {

        if (strpos($date, '/') !== false) {
            $date = $this->__format_date($date);
        }
        $this->form_validation->set_message('validation_date_before_today', 'A data inserida é anterior a data de hoje ' . date('d/m/Y'));
        $today = date('Y/m/d');
        if (strtotime($date) >= strtotime($today)) {
            return true;
        } else {
            return false;
        }
    }

    public function validation_valid_date($date) {
        $this->form_validation->set_message('validation_valid_date', 'A data inserida é inválida!');
        list($dia, $mes, $ano) = explode('/', $date);
        return checkdate($mes, $dia, $ano);
    }

    public function validation_decimal_positive($value) {
        $this->form_validation->set_message('validation_decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        if ($value < 0) {
            return false;
        }
        return true;
    }

    public function validation_no_leading_zeroes($value) {

        return preg_replace('/^0+/', '', $value);
    }

    private function __format_date($date) {
        list($dia, $mes, $ano) = explode('/', $date);
        return $date = $ano . '-' . $mes . '-' . $dia;
    }

}

/* End of file Pedido.php */
/* Location: ./application/controllers/Pedido.php */