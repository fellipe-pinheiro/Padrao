<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orcamento extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //Orçamento
        $this->load->model('Sistema_m');
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
        $this->load->model('Convite_modelo_dimensao_m');
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
        $this->load->model('Personalizado_modelo_dimensao_m');

        //Materia Prima Convite
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_dimensao_m');
        $this->load->model('Papel_acabamento_m');
        $this->load->model('Papel_gramatura_m');
        $this->load->model('Impressao_m');
        $this->load->model('Impressao_area_m');
        $this->load->model('Acabamento_m');
        $this->load->model('Acessorio_m');
        $this->load->model('Fita_m');
        $this->load->model('Fita_laco_m');
        $this->load->model('Fita_material_m');
        $this->load->model('Fita_espessura_m');

        //TODO CARREGAR TODOS OS OBJETOS DAS VARIAVEIS DO ORÇAMENTO PARA NÃO DAR ERRRO!!
        init_layout();
        set_layout('titulo', 'Orçamento', FALSE);
        empty($this->session->orcamento) ? $this->novo_orcamento() : '';
        restrito_logado();
    }

    public function index() {
        $data['lojas'] = $this->Loja_m->get_pesonalizado("id, unidade");
        $data['eventos'] = $this->Evento_m->get_pesonalizado("id, nome");
        $data['forma_pagamento'] = $this->Forma_pagamento_m->get_pesonalizado("id, nome,parcelamento_maximo,valor_minimo");
        $data['estados'] = get_array_estados();
        $data['estados_json'] = json_encode(get_array_estados());
        set_layout('conteudo', load_content('orcamento/index', $data));
        load_layout();
    }

    public function lista() {
        set_layout('conteudo', load_content('orcamento/lista', ""));
        load_layout();
    }

    public function pdf() {
        $id = $this->uri->segment(3);
        $data['orcamento'] = $this->Orcamento_m->get_by_id($id);
        $data['documento_numero'] = "<h3 class='pull-right'><strong>" . $data['orcamento']->get_numero_documento() . "</strong></h3>";
        $prazo_validade_orcamento = $this->Sistema_m->get_by_nome('prazo_validade_orcamento');
        $data['prazo_validade_orcamento'] = empty($prazo_validade_orcamento) ? 1 : $prazo_validade_orcamento;
        set_layout('titulo', $data['orcamento']->get_numero_documento(), TRUE);
        set_layout('conteudo', load_content('orcamento/pdf', $data));
        load_layout();
    }

    //cria uma sessão com o produto e cliente ja existente. 
    //solicitação vinda da view pedido/editar
    public function ajax_create_order_with_client_and_product() {
        $data["status"] = FALSE;
        $owner = $this->input->post('owner');
        $produto_id = $this->input->post('produto_id');
        $pedido_id = $this->input->post('pedido_id');

        $this->novo_orcamento();
        $pedido = $this->Pedido_m->get_by_id($pedido_id);
        if (!$pedido) {
            $data["status"] = FALSE;
            print json_encode($data);
            exit();
        }

        $pedido->orcamento->desconto = 0;
        if ($owner === 'convite') {
            $pedido->orcamento->personalizado = array();
            $pedido->orcamento->produto = array();

            if (!empty($pedido->orcamento->convite)) {
                foreach ($pedido->orcamento->convite as $key => $convite) {
                    if ($convite->id != $produto_id) {
                        unset($pedido->orcamento->convite[$key]);
                    }
                    if ($convite->id === $produto_id) {
                        $data["status"] = TRUE;
                    }
                }
            }
        } else if ($owner === 'personalizado') {
            $pedido->orcamento->convite = array();
            $pedido->orcamento->produto = array();

            if (!empty($pedido->orcamento->personalizado)) {
                foreach ($pedido->orcamento->personalizado as $key => $personalizado) {
                    if ($personalizado->id != $produto_id) {
                        unset($pedido->orcamento->personalizado[$key]);
                    }
                    if ($personalizado->id === $produto_id) {
                        $data["status"] = TRUE;
                    }
                }
            } else {
                $data["status"] = FALSE;
            }
        } else if ($owner === 'produto') {
            $pedido->orcamento->convite = array();
            $pedido->orcamento->personalizado = array();

            if (!empty($pedido->orcamento->produto)) {
                foreach ($pedido->orcamento->produto as $key => $produto) {
                    if ($produto->id != $produto_id) {
                        unset($pedido->orcamento->produto[$key]);
                    }
                    if ($produto->id === $produto_id) {
                        $data["status"] = TRUE;
                    }
                }
            } else {
                $data["status"] = FALSE;
            }
        }
        $this->session->orcamento = $pedido->orcamento;
        print json_encode($data);
        exit();
    }

    public function ajax_get_session_orcamento() {
        $this->novo_orcamento();
        $id = $this->input->post('id');
        $this->session->orcamento = $this->Orcamento_m->get_by_id($id);
        if ($this->session->orcamento) {
            $data["status"] = TRUE;
            $data["msg"] = "Orcamento numero carregado com sucesso";
            print json_encode($data);
            exit();
        }
        $data["status"] = FALSE;
        $data["msg"] = "Falha ao carregar o orcamento";
        $data["location"] = "Orcamento";
        print json_encode($data);
        exit();
    }

    public function ajax_list() {
        $list = $this->Orcamento_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'cliente_nome' => $item->cliente_nome,
                'cliente_email' => $item->cliente_email,
                'cliente_telefone' => $item->cliente_telefone,
                'cliente_cpf' => $item->cliente_cpf,
                'cliente_cnpj' => $item->cliente_cnpj,
                'cliente_razao_social' => $item->cliente_razao_social,
                'cliente_pessoa_tipo' => $item->cliente_pessoa_tipo,
                'assessor_nome' => $item->assessor_nome,
                'assessor_email' => $item->assessor_email,
                'data' => $item->orc_data,
                'descricao' => $item->orc_descricao,
                'data_evento' => $item->orc_data_evento,
                'evento' => $item->evento_nome,
                'loja' => $item->loja_unidade,
            );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Orcamento_m->count_all(),
            "recordsFiltered" => $this->Orcamento_m->count_filtered(),
            "data" => $data,
        );
        //output to json format
        print json_encode($output);
    }

    public function ajax_session_orcamento_novo() {
        $data['status'] = FALSE;
        if($this->novo_orcamento()){
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    /*
    public function ajax_session_orcamento_excluir() {
        unset($this->session->orcamento);
        $this->novo_orcamento();
        $data['status'] = TRUE;
        $data['msg'] = "Orçamento excluido com sucesso!";
        print json_encode($data);
    }
    */

    private function novo_orcamento() {
        $this->session->pedido = new Pedido_m();
        $this->session->orcamento = new Orcamento_m();
        $this->session->orcamento->cliente = new Cliente_m();
        $this->session->orcamento->assessor = new Assessor_m();
        $this->session->orcamento->usuario = new Usuario_m();
        $this->session->orcamento->usuario->id = $this->session->user_id;
        $this->session->orcamento->loja = new Loja_m();
        $this->session->orcamento->convite = array();
        $this->session->orcamento->personalizado = array();
        $this->session->orcamento->produto = array();
        $this->session->unset_userdata('convite');
        $this->session->unset_userdata('personalizado');
        return true;
    }

    public function ajax_session_cliente_inserir() {
        $data['status'] = FALSE;
        $id = $this->input->post('id');
        $cliente = $this->Cliente_m->get_by_id($id);
        if (is_object($cliente)) {
            $this->session->orcamento->cliente = $cliente;
            $data['status'] = TRUE;
            $data['cliente'] = $cliente;
        }
        print json_encode($data);
    }

    public function ajax_session_orcamento_info() {
        $data['status'] = TRUE;
        $this->validar_formulario_orcamento_info();
        $this->session->orcamento->loja = $this->Loja_m->get_by_id($this->input->post('loja'));
        $this->session->orcamento->evento = $this->input->post('evento');
        $this->session->orcamento->data_evento = date_to_db($this->input->post('data_evento'));
        print json_encode($data);
        exit();
    }

    public function ajax_session_orcamento_descricao(){
        $data['status'] = TRUE;
        $this->session->orcamento->descricao = $this->input->post('descricao');
        print json_encode($data);
    }

    private function validar_formulario_form_descricao(){
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim');
        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    private function validar_formulario_orcamento_info() {
        $this->form_validation->set_rules('evento', 'Evento', 'trim|required');
        $this->form_validation->set_rules('loja', 'Loja', 'trim|required');
        $this->form_validation->set_message('date_before_today', 'A data é anterior a data de hoje ' . date('d/m/Y'));
        $this->form_validation->set_rules('data_evento', 'Data Evento', 'date_before_today');
        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function ajax_session_assessor() {
        $data['status'] = FALSE;    
        $acao = $this->uri->segment(3);
        if ($acao === 'inserir' && $this->input->post('id')) {
            $assessor = $this->Assessor_m->get_by_id($this->input->post('id'));
            if (is_object($assessor)) {
                $this->session->orcamento->assessor = $assessor;
                $data['status'] = TRUE;
                $data['assessor'] = $assessor;
            }
        } else if ($acao === 'excluir') {
            $assessor = new Assessor_m();
            $this->session->orcamento->assessor = $assessor;
            $data['status'] = TRUE;
            $data['assessor'] = $assessor;
        }
        print json_encode($data);
    }

    public function ajax_session_desconto() {
        $data['status'] = FALSE;
        $acao = $this->uri->segment(3);
        if ($acao === 'inserir') {
            $this->validar_formulario_desconto();
            $this->session->orcamento->desconto = $this->input->post('desconto');
            $data['status'] = TRUE;
            print json_encode($data);
        } else if ($acao === 'editar') {
            $this->validar_formulario_desconto();
            $this->session->orcamento->desconto = $this->input->post('desconto');
            $data['status'] = TRUE;
            print json_encode($data);
        } else if ($acao === 'excluir') {
            $this->session->orcamento->desconto = 0;
            $data['status'] = TRUE;
            print json_encode($data);
        }
    }

    private function validar_formulario_desconto() {
        $data['status'] = TRUE;
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('desconto', 'Desconto', 'trim|required|decimal_positive|no_leading_zeroes|numeric');
        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function ajax_is_empty_orcamento_info() {
        $data = array();
        $data['status'] = TRUE;
        $status = array();
        if (empty($this->session->orcamento->loja)) {
            $status[] = array('status' => FALSE, 'location' => 'loja');
        }
        if (empty($this->session->orcamento->evento)) {
            $status[] = array('status' => FALSE, 'location' => 'evento');
        }
        if (empty($this->session->orcamento->data_evento)) {
            $status[] = array('status' => FALSE, 'location' => 'data_evento');
        }
        foreach ($status as $key => $value) {
            if (!$value['status']) {
                $data['status'] = FALSE;
                $data['location'][] = $value['location'];
            }
        }
        print json_encode($data);
    }

    public function ajax_is_editing_container_itens() {
        $data = array();
        $data['status'] = FALSE;
        $status = array();
        if (!empty($this->session->convite)) {
            $cartao = $this->session->convite->cartao;
            $envelope = $this->session->convite->envelope;
            if (!empty($this->session->convite->modelo->id) && !empty($this->session->convite->quantidade)) {
                $status[] = array('status' => TRUE, 'location' => 'convite', 'url' => base_url('convite'));
            }
        }
        if (!empty($this->session->personalizado)) {
            $personalizado = $this->session->personalizado->personalizado;
            if (!empty($this->session->personalizado->modelo->id) && !empty($this->session->personalizado->quantidade)) {
                $status[] = array('status' => TRUE, 'location' => 'personalizado', 'url' => base_url('personalizado'));
            }
        }
        foreach ($status as $key => $value) {
            if ($value['status']) {
                $data['status'] = TRUE;
                $data['location'][] = $value['location'];
                $data['url'][] = $value['url'];
            }
        }
        print json_encode($data);
    }

    public function ajax_is_empty_orcamento_itens() {
        $data['status'] = TRUE;
        if (empty($this->session->orcamento->convite) && empty($this->session->orcamento->personalizado) && empty($this->session->orcamento->produto)) {
            $data['status'] = FALSE;
            $data['msg'] = 'Não existem produtos neste orçamento';
        }
        print json_encode($data);
    }

    public function ajax_is_empty_orcamento_cliente() {
        $data['status'] = TRUE;
        if (empty($this->session->orcamento->cliente->id)) {
            $data['status'] = FALSE;
            $data['msg'] = 'Nenhum cliente foi definido para este orçamento. <p>Clique em cliente para definir um cliente.</p>';
        }
        if ($this->input->post('is_criar_pedido')){
            $data['cliente_id'] = $this->session->orcamento->cliente->id;
            $data['cliente_pessoa_tipo'] = $this->session->orcamento->cliente->pessoa_tipo;
            //Se for um pedido, verificar se o cpf/cnpj estão no setados
            if ($this->session->orcamento->cliente->pessoa_tipo == 'fisica' && empty($this->session->orcamento->cliente->cpf)) {
                $data['status'] = FALSE;
                $data['msg'] = 'Tentativa de criar um pedido sem o CPF do cliente. Edite o CPF e tente novamente.';
            }else if ($this->session->orcamento->cliente->pessoa_tipo == 'juridica' && empty($this->session->orcamento->cliente->cnpj)) {
                $data['status'] = FALSE;
                $data['msg'] = 'Tentativa de criar um pedido sem o CNPJ do cliente. Edite o CNPJ e tente novamente.';
            }
        }
        print json_encode($data);
    }

    public function ajax_is_empty_orcamento_assessor() {
        $data['status'] = TRUE;
        if (empty($this->session->orcamento->assessor->id)) {
            $data['status'] = FALSE;
            $data['msg'] = 'Nenhum assessor foi definido para este orçamento.';
        }
        print json_encode($data);
    }

    public function ajax_salvar() {
        $data['status'] = TRUE;

        $this->db->trans_begin();
        $this->session->orcamento->inserir();
        $data['id'] = $this->session->orcamento->id;

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
    }

    public function ajax_clean_session_orcamento() {
        $data['status'] = TRUE;
        $this->session->unset_userdata('orcamento');
        $this->session->unset_userdata('pedido');
        $this->session->unset_userdata('convite');
        $this->session->unset_userdata('personalizado');
        $this->novo_orcamento();
        print json_encode($data);
    }

}
