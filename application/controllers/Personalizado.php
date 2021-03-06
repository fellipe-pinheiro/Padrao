<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personalizado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Orcamento_m');
        $this->load->model('Personalizado_m');
        $this->load->model('Personalizado_modelo_m');
        $this->load->model('Personalizado_modelo_dimensao_m');
        $this->load->model('Personalizado_categoria_m');
        $this->load->model('Mao_obra_m');
        $this->load->model('Assessor_m');
        
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_gramatura_m');
        $this->load->model('Papel_dimensao_m');
        $this->load->model('Papel_empastamento_m');
        $this->load->model('Impressao_m');
        $this->load->model('Impressao_dimensao_m');
        $this->load->model('Acabamento_m');
        $this->load->model('Acessorio_m');
        $this->load->model('Fita_m');
        $this->load->model('Fita_laco_m');
        $this->load->model('Fita_material_m');
        $this->load->model('Fita_espessura_m');
        $this->load->model('Cliche_m');
        $this->load->model('Cliche_dimensao_m');
        $this->load->model('Faca_m');
        $this->load->model('Faca_dimensao_m');
        $this->load->model('Laser_m');

        $this->load->model('Container_m');
        $this->load->model('Container_papel_m');
        $this->load->model('Container_papel_acabamento_m');
        $this->load->model('Container_impressao_m');
        $this->load->model('Container_acabamento_m');
        $this->load->model('Container_acessorio_m');
        $this->load->model('Container_fita_m');
        $this->load->model('Container_cliche_m');
        $this->load->model('Container_faca_m');
        $this->load->model('Container_laser_m');

        init_layout();
        set_layout('titulo', 'Personalizado', FALSE);
        restrito_logado();
        //Se a session do personalizado estiver vazia, preenche as variaveis do personalizado com os objetos
        if (empty($this->session->personalizado)) {
            $this->criar_personalizado();
        }
    }

    public function index() {
        /*
          irá vir somente 1 array com o objeto na função abaixo: $this->Fita_espessura_m->get_list(),
          caso não venha nada (array{}) crio um novo objeto
          OBS: uso no modal das fitas como espessuras para não deixar o select vazio
         */
        $fita_espessura = $this->Fita_espessura_m->get_list();
        if (empty($fita_espessura)) {
            $data['fita_espessura'] = new Fita_espessura_m();
            $data['fita_espessura']->esp_03mm = '03mm';
            $data['fita_espessura']->esp_07mm = '07mm';
            $data['fita_espessura']->esp_10mm = '10mm';
            $data['fita_espessura']->esp_15mm = '15mm';
            $data['fita_espessura']->esp_22mm = '22mm';
            $data['fita_espessura']->esp_38mm = '38mm';
            $data['fita_espessura']->esp_50mm = '50mm';
            $data['fita_espessura']->esp_70mm = '70mm';
        } else {
            $data['fita_espessura'] = $fita_espessura[0];
        }
        if (empty($this->session->personalizado->quantidade) || empty($this->session->personalizado->modelo)) {
            $this->criar_personalizado();
        }
        
        set_layout('conteudo', load_content('personalizado/index', $data));
        load_layout();
    }

    //NOVO: Personalizado 
    public function session_personalizado_novo() {
        $this->validar_formulario_personalizado();
        unset($this->session->personalizado);
        $this->criar_personalizado();
        $modelo = $this->Personalizado_modelo_m->get_by_id($this->input->post('personalizado_modelo'));
        $this->session->personalizado->modelo = $modelo;
        $this->session->personalizado->quantidade = $this->input->post('quantidade');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Personalizado</strong> criado com sucesso'));
        exit();
    }

    //ALTERAR: Personalizado
    public function session_personalizado_editar() {
        $this->validar_formulario_personalizado();
        $personalizado = $this->session->personalizado;
        if ($personalizado->modelo->id != $this->input->post('personalizado_modelo')) {
            $modelo = $this->Personalizado_modelo_m->get_by_id($this->input->post('personalizado_modelo'));
            $personalizado->modelo = $modelo;
        }
        $personalizado->quantidade = $this->input->post('quantidade');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Personalizado</strong> editado com sucesso'));
        exit();
    }

    public function session_personalizado_excluir() {
        unset($this->session->personalizado);
        $this->criar_personalizado();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Personalizado</strong> excluido com sucesso'));
        exit();
    }

    private function validar_formulario_personalizado() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('personalizado_modelo', 'Personalizado modelo', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function session_personalizado_itens_excluir() {
        unset($this->session->personalizado->personalizado);
        $this->session->personalizado->personalizado = new Container_m();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Itens da personalizado</strong> excluidos com sucesso'));
        exit();
    }

    private function criar_personalizado() {
        $comissao = 0;
        if (!empty($this->session->orcamento->assessor->comissao)) {
            $comissao = $this->session->orcamento->assessor->comissao;
        }
        $this->session->unset_userdata('personalizado');
        $this->session->personalizado = new Personalizado_m();
        $this->session->personalizado->personalizado = new Container_m();
        $this->session->personalizado->mao_obra = new Mao_obra_m();
        $this->session->personalizado->modelo = new Personalizado_modelo_m();
        $this->session->personalizado->comissao = $comissao;
    }

    //FINALIZAR: Personalizado   
    public function finalizar() {
        //faz swap na sessão do orçamento
        if ($this->session->personalizado->is_edicao) {
            $this->session->personalizado->is_edicao = false;
            $posicao = $this->session->personalizado->session_posicao;
            $this->session->personalizado->session_posicao = null;
            unset($this->session->orcamento->personalizado[$posicao]);
            $this->session->orcamento->personalizado[$posicao] = $this->session->personalizado;
        } else {
            $this->session->orcamento->personalizado[] = $this->session->personalizado;
        }
        $this->session->unset_userdata('personalizado');
        redirect(base_url('orcamento'), 'auto');
    }

    public function session_descricao() {
        $this->validar_formulario_descricao();
        $this->session->personalizado->descricao = $this->input->post('descricao');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Descrição</strong> inserido com sucesso'));
        exit();
    }

    public function ajax_session_carregar_dimensoes(){
        $data['status'] = FALSE;
        $owner = $this->uri->segment(3);
        $arr = array();
        $this->dimensoes = $this->Personalizado_modelo_dimensao_m->get_by_modelo_id($this->session->personalizado->modelo->id);
        foreach ($this->dimensoes as $key => $value) {
            $arr[] = array('id'=>$value->id, 'nome'=>$value->nome);
        }
        if(!empty($arr)){
            $data['status'] = true;
            $data['dimensoes'] = $arr;
        }
        print json_encode($data);
        exit();
    }

    private function validar_formulario_descricao() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('descricao', 'Descricao', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //EDITAR: Personalizado (Enviado da página do orcamento)
    public function session_orcamento_personalizado_editar() {
        $posicao = $this->uri->segment(3);
        $this->session->unset_userdata('personalizado');
        $this->criar_personalizado();
        $this->session->personalizado = clone $this->session->orcamento->personalizado[$posicao];
        $this->session->personalizado->is_edicao = true;
        $this->session->personalizado->session_posicao = $posicao;
        redirect(base_url('personalizado'), 'auto');
    }

    public function session_orcamento_personalizado_excluir() {
        $posicao = $this->uri->segment(3);
        unset($this->session->orcamento->personalizado[$posicao]);
        redirect(base_url('orcamento'), 'auto');
    }

    //INSERIR: MAO_OBRA
    public function session_mao_obra_inserir() {
        $this->validar_formulario_mao_obra();
        $personalizado = $this->session->personalizado;
        $mao_obra = $this->Mao_obra_m->get_by_id($this->input->post('mao_obra'));
        $personalizado->mao_obra = $mao_obra;
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Mão de obra</strong> inserido com sucesso'));
        exit();
    }

    public function session_mao_obra_editar() {
        $this->validar_formulario_mao_obra();
        $personalizado = $this->session->personalizado;
        $mao_obra = $this->Mao_obra_m->get_by_id($this->input->post('mao_obra'));
        $personalizado->mao_obra = $mao_obra;
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Mão de obra</strong> editado com sucesso'));
        exit();
    }

    public function session_mao_obra_excluir() {
        $this->session->personalizado->mao_obra = new Mao_obra_m();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Mão de obra</strong> excluida com sucesso'));
        exit();
    }

    private function validar_formulario_mao_obra() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('mao_obra', 'Mão de obra', 'required');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: PAPEL
    public function session_papel_inserir() {
        $this->validar_formulario_papel();
        $this->session->personalizado->personalizado->container_papel[] = $this->set_papel('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Papel</strong> inserido com sucesso'));
        exit();
    }

    public function session_papel_editar() {
        $this->validar_formulario_papel();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_papel[$posicao] = $this->set_papel('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Papel</strong> editado com sucesso'));
        exit();
    }

    public function session_papel_excluir() {
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_papel[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Papel</strong> excluido com sucesso'));
        exit();
    }

    private function set_papel($owner){
        $container = array();
        $quantidade = 1; //qtd de papel

        $empastado = !empty( $this->input->post('papel_action-1') ) ? true : false;

        $container['papel-0'] = $this->Container_m->get_papel($owner, $this->input->post('papel'), $this->input->post('dimensao'), $quantidade, $this->input->post('gramatura'), null,$empastado);

        if(!empty($this->input->post('papel_action-1'))){
            $container['papel-1'] = $this->Container_m->get_papel($owner, $this->input->post('papel-1'), $this->input->post('dimensao'), $quantidade, $this->input->post('gramatura-1'), $this->input->post('empastamento'), $empastado);
        }

        if(!empty($this->input->post('papel_action-2'))){
            $container['papel-2'] = $this->Container_m->get_papel( $owner, $this->input->post('papel-2'), $this->input->post('dimensao'), $quantidade, $this->input->post('gramatura-2'), $this->input->post('empastamento'), $empastado);
        }
        return $container; //array de papeis
    }

    private function validar_formulario_papel() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('dimensao', 'Destino', 'required');
        $this->form_validation->set_rules('empastamento', 'Empastamento', 'required');
        
        //papel-0
        $this->form_validation->set_rules('papel', 'Papel', 'required');
        $this->form_validation->set_rules('gramatura', 'Gramatura', 'required');

        //papel-1
        if( !empty( $this->input->post('papel_action-1') ) ){
            $this->form_validation->set_rules('papel-1', 'Papel', 'required');
            $this->form_validation->set_rules('gramatura-1', 'Gramatura', 'required');
        }
        //papel-2
        if( !empty( $this->input->post('papel_action-2') ) ){
            $this->form_validation->set_rules('papel-2', 'Papel', 'required');
            $this->form_validation->set_rules('gramatura-2', 'Gramatura', 'required');
        }
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: IMPRESSAO
    public function session_impressao_inserir() {
        $this->validar_formulario_impressao();
        $this->session->personalizado->personalizado->container_impressao[] = $this->set_impressao('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Impressão</strong> inserida com sucesso'));
        exit();
    }

    public function session_impressao_editar() {
        $this->validar_formulario_impressao();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_impressao[$posicao] = $this->set_impressao('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Impressão</strong> editada com sucesso'));
        exit();
    }

    public function session_impressao_excluir() {
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_impressao[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Impressão</strong> excluida com sucesso'));
        exit();
    }

    private function set_impressao($owner){
        //busca o impressao pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_impressao($owner,$this->input->post('impressao'),$this->input->post('dimensao'),$this->input->post('quantidade'),$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_impressao() {
        $data = array();
        $data['status'] = TRUE;
        
        $this->form_validation->set_rules('impressao', 'Impressão', 'required');
        $this->form_validation->set_rules('dimensao', 'Dimensão', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: ACABAMENTO
    public function session_acabamento_inserir() {
        $this->validar_formulario_acabamento();
        $this->session->personalizado->personalizado->container_acabamento[] = $this->set_acabamento('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acabamento</strong> inserido com sucesso'));
        exit();
    }

    public function session_acabamento_editar() {
        $this->validar_formulario_acabamento();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_acabamento[$posicao] = $this->set_acabamento('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acabamento</strong> editado com sucesso'));
        exit();
    }

    public function session_acabamento_excluir() {
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_acabamento[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acabamento</strong> excluido com sucesso'));
        exit();
    }

    private function set_acabamento($owner) {
        //busca o acabamento pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_acabamento($owner, $this->input->post('acabamento'), $this->input->post('quantidade'), $this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_acabamento() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('acabamento', 'Acabamento', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: ACESSÓRIO
    public function session_acessorio_inserir() {
        $this->validar_formulario_acessorio();
        $this->session->personalizado->personalizado->container_acessorio[] = $this->set_acessorio('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acessório</strong> inserido com sucesso'));
        exit();
    }

    public function session_acessorio_editar() {
        $this->validar_formulario_acessorio();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_acessorio[$posicao] = $this->set_acessorio('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acessório</strong> editado com sucesso'));
        exit();
    }

    public function session_acessorio_excluir() {
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_acessorio[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acessório</strong> excluido com sucesso'));
        exit();
    }

    private function set_acessorio($owner) {
        //busca o acessorio pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_acessorio($owner, $this->input->post('acessorio'), $this->input->post('quantidade'), $this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_acessorio() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('acessorio', 'Acessório', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: FITA
    public function session_fita_inserir() {
        $this->validar_formulario_fita();
        $this->session->personalizado->personalizado->container_fita[] = $this->set_fita('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Fita</strong> inserido com sucesso'));
        exit();
    }

    public function session_fita_editar() {
        $this->validar_formulario_fita();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_fita[$posicao] = $this->set_fita('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Fita</strong> editado com sucesso'));
        exit();
    }

    public function session_fita_excluir() {
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_fita[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Fita</strong> excluido com sucesso'));
        exit();
    }

    private function set_fita($owner) {
        $container = $this->Container_m->get_fita($owner, $this->input->post('fita'), $this->input->post('quantidade'), $this->input->post('descricao'), $this->input->post('espessura'));
        return $container;
    }

    public function check_espessura_valor() {
        $this->form_validation->set_message('check_espessura_valor', 'Espessura não definida para esta fita');
        if ($this->input->post('fita')) {
            $fita = $this->Fita_m->get_by_id($this->input->post('fita'));

            switch ($this->input->post('espessura')) {
                case '3':
                    if ($fita->valor_03mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '7':
                    if ($fita->valor_07mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '10':
                    if ($fita->valor_10mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '15':
                    if ($fita->valor_15mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '22':
                    if ($fita->valor_22mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '38':
                    if ($fita->valor_38mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '50':
                    if ($fita->valor_50mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                case '70':
                    if ($fita->valor_70mm <= 0.00) {
                        return false;
                    }
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        }
    }

    private function validar_formulario_fita() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('fita', 'Acessório', 'required');
        $this->form_validation->set_rules('espessura', 'Acessório', 'required|callback_check_espessura_valor');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: CLICHÊ
    public function session_cliche_inserir(){
        $this->validar_formulario_cliche();
        $this->session->personalizado->personalizado->container_cliche[] = $this->set_cliche('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Clichê</strong> inserido com sucesso'));
        exit();  
    }

    public function session_cliche_editar(){
        $this->validar_formulario_cliche();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_cliche[$posicao] = $this->set_cliche('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Clichê</strong> editado com sucesso'));
        exit();   
    }

    public function session_cliche_excluir(){
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_cliche[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Clichê</strong> excluido com sucesso'));
        exit(); 
    }

    private function set_cliche($owner){
        //busca o cliche pelo id e seta a quantidade e descrição
        empty($this->input->post('cobrar_servicoCliche'))? $cobrar_servico = 0 : $cobrar_servico = 1;
        empty($this->input->post('cobrar_cliche'))? $cobrar_cliche = 0 : $cobrar_cliche = 1;
        $container = $this->Container_m->get_cliche($owner,$this->input->post('cliche'),$this->input->post('dimensao'),$this->input->post('quantidade'),$cobrar_servico,$cobrar_cliche,$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_cliche(){
        $data = array();
        $data['status'] = TRUE;
        
        $this->form_validation->set_rules('cliche', 'Clichê', 'required');
        $this->form_validation->set_rules('dimensao', 'Dimensão', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: FACA
    public function session_faca_inserir(){
        $this->validar_formulario_faca();
        $this->session->personalizado->personalizado->container_faca[] = $this->set_faca('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Faca</strong> inserido com sucesso'));
        exit();  
    }

    public function session_faca_editar(){
        $this->validar_formulario_faca();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_faca[$posicao] = $this->set_faca('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Faca</strong> editado com sucesso'));
        exit();   
    }

    public function session_faca_excluir(){
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_faca[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Faca</strong> excluido com sucesso'));
        exit(); 
    }

    private function set_faca($owner){
        //busca o faca pelo id e seta a quantidade e descrição
        empty($this->input->post('cobrar_servicoFaca'))? $cobrar_servico = 0 : $cobrar_servico = 1;
        empty($this->input->post('cobrar_faca'))? $cobrar_faca = 0 : $cobrar_faca = 1;
        $container = $this->Container_m->get_faca($owner,$this->input->post('faca'),$this->input->post('dimensao'),$this->input->post('quantidade'),$cobrar_servico,$cobrar_faca,$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_faca(){
        $data = array();
        $data['status'] = TRUE;
        
        $this->form_validation->set_rules('faca', 'Faca', 'required');
        $this->form_validation->set_rules('dimensao', 'Dimensão', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //SESSION: LASER
    public function session_laser_inserir() {
        $this->validar_formulario_laser();
        $this->session->personalizado->personalizado->container_laser[] = $this->set_laser('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Laser</strong> inserido com sucesso'));
        exit();
    }

    public function session_laser_editar() {
        $this->validar_formulario_laser();
        $posicao = $this->uri->segment(4);
        $this->session->personalizado->personalizado->container_laser[$posicao] = $this->set_laser('personalizado');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Laser</strong> editado com sucesso'));
        exit();
    }

    public function session_laser_excluir() {
        $posicao = $this->input->post('posicao');
        unset($this->session->personalizado->personalizado->container_laser[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Laser</strong> excluido com sucesso'));
        exit();
    }

    private function set_laser($owner) {
        //busca o laser pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_laser($owner,$this->input->post('laser'),$this->input->post('quantidade'),$this->input->post('qtd_minutos'),$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_laser() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('laser', 'Laser', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('qtd_minutos', 'Qtd em Minutos', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    //Verifica se existem itens e mão de obra na [personalizado]
    public function is_empty_container_itens() {
        $data = array();
        $data['status'] = TRUE;
        $personalizado = $this->session->personalizado->personalizado;

        if (empty($personalizado->container_papel) && 
            empty($personalizado->container_impressao) && 
            empty($personalizado->container_acabamento) && 
            empty($personalizado->container_acessorio) && 
            empty($personalizado->container_fita) &&
            empty($personalizado->container_cliche) &&
            empty($personalizado->container_faca) &&
            empty($personalizado->container_laser)
            ) {
            $data['status'] = FALSE;
            $data['msg'] = "O produto personalizado está vazio!";
        } else if (empty($this->session->personalizado->mao_obra->id)) {
            $data['status'] = FALSE;
            $data['msg'] = "A mão de obra não foi definida.";
            $data['location'] = "mao_obra";
        } else {
            $data['msg'] = "A personalizado está pronta para ser adicionada";
        }
        print json_encode($data);
        exit();
    }

    //Verifica se há um modelo e quantidade para o Personalizado
    public function is_empty_modelo_quantidade() {
        $data = array();
        $data['status'] = TRUE;
        if (empty($this->session->personalizado->modelo->id) || empty($this->session->personalizado->quantidade)) {
            $data['status'] = FALSE;
            $data['msg'] = "Modelo ou quantidade não foram definidos";
        }
        print json_encode($data);
        exit();
    }

}
