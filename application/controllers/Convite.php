<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convite extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Orcamento_m');
        $this->load->model('Convite_m');

        $this->load->model('Convite_modelo_m');
        $this->load->model('Convite_modelo_dimensao_m');
        $this->load->model('Mao_obra_m');
        $this->load->model('Assessor_m');

        //Carrego a materia prima para compor convite
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_gramatura_m');
        $this->load->model('Papel_dimensao_m');
        $this->load->model('Papel_acabamento_m');
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
        set_layout('titulo', 'Convite',FALSE);
        restrito_logado();
        //Se a session do convite estiver vazia, preenche as variaveis do convite com os objetos
        if(empty($this->session->convite)){
            $this->criar_convite();
        }
    }

    public function index() {
        /*
        irá vir somente 1 array com o objeto na função abaixo: $this->Fita_espessura_m->get_list(), 
        caso não venha nada (array{}) crio um novo objeto 
        OBS: uso no modal das fitas como espessuras para não deixar o select vazio
        */
        $fita_espessura = $this->Fita_espessura_m->get_list();
        if(empty($fita_espessura)){
            $data['fita_espessura'] = new Fita_espessura_m();
            $data['fita_espessura']->esp_03mm = '03mm';
            $data['fita_espessura']->esp_07mm = '07mm';
            $data['fita_espessura']->esp_10mm = '10mm';
            $data['fita_espessura']->esp_15mm = '15mm';
            $data['fita_espessura']->esp_22mm = '22mm';
            $data['fita_espessura']->esp_38mm = '38mm';
            $data['fita_espessura']->esp_50mm = '50mm';
            $data['fita_espessura']->esp_70mm = '70mm';
        }
        else{
            $data['fita_espessura'] = $fita_espessura[0];
        }
        if(empty($this->session->convite->quantidade) || empty($this->session->convite->modelo)){
            $this->criar_convite();
        }
        $data['papel_acabamento'] = $this->Papel_acabamento_m->get_codigo_nome('nome,codigo');

        set_layout('conteudo', load_content('convite/index',$data));
        load_layout();
    }

    public function session_convite_novo() {
        $this->validar_formulario_convite();
        $this->criar_convite();
        $modelo = $this->Convite_modelo_m->get_by_id($this->input->post('convite_modelo'));
        $this->session->convite->modelo = $modelo;
        $this->session->convite->quantidade = $this->input->post('quantidade');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Convite</strong> criado com sucesso'));
        exit();
    }

    public function session_convite_editar() {
        $this->validar_formulario_convite();
        $convite = $this->session->convite;
        if($convite->modelo->id != $this->input->post('convite_modelo')){
            $modelo = $this->Convite_modelo_m->get_by_id($this->input->post('convite_modelo'));
            $convite->modelo = $modelo;
        }
        $convite->quantidade = $this->input->post('quantidade');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Convite</strong> editado com sucesso'));
        exit();
    }

    public function session_convite_excluir(){
        unset($this->session->convite);
        $this->criar_convite();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Convite</strong> excluido com sucesso'));
        exit(); 
    }

    private function validar_formulario_convite(){
        $data = array();
        $data['status'] = TRUE;
        
        $this->form_validation->set_rules('convite_modelo', 'Convite modelo', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    private function criar_convite(){
        $comissao = 0;
        if(!empty($this->session->orcamento->assessor->comissao)){
            $comissao = $this->session->orcamento->assessor->comissao;
        }
        $this->session->unset_userdata('convite');
        $this->session->convite = new Convite_m();
        $this->session->convite->cartao = new Container_m();
        $this->session->convite->envelope = new Container_m();
        $this->session->convite->mao_obra = new Mao_obra_m();
        $this->session->convite->modelo = new Convite_modelo_m();
        $this->session->convite->comissao = $comissao;
    }

    public function finalizar(){
        //faz swap na sessão do orçamento
        if($this->session->convite->is_edicao){
            $this->session->convite->is_edicao = false;
            $posicao = $this->session->convite->session_posicao;
            $this->session->convite->session_posicao = null;
            unset($this->session->orcamento->convite[$posicao]);
            $this->session->orcamento->convite[$posicao] = $this->session->convite;
        }else{
            $this->session->orcamento->convite[] = $this->session->convite;
        }
        $this->session->unset_userdata('convite');
        redirect(base_url('orcamento'), 'auto');
    }

    public function session_descricao(){
        $this->validar_formulario_descricao();
        $this->session->convite->descricao = $this->input->post('descricao');
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Descrição</strong> inserido com sucesso'));
        exit();
    }

    public function ajax_session_carregar_dimensoes(){
        $data['status'] = FALSE;
        $owner = $this->uri->segment(3);
        $arr = array();
        $this->dimensoes = $this->Convite_modelo_dimensao_m->get_by_modelo_id($this->session->convite->modelo->id);
        switch ($owner) {
            case 'cartao':
                foreach ($this->dimensoes as $key => $value) {
                    if($value->destino == '1' || $value->destino == '-1'){
                        $arr[] = array('id'=>$value->id, 'nome'=>$value->nome);
                    }
                }
                break;
            case 'envelope':
                foreach ($this->dimensoes as $key => $value) {
                    if($value->destino == '2' || $value->destino == '-1'){
                        $arr[] = array('id'=>$value->id, 'nome'=>$value->nome);
                    }
                }
                break;
        }
        if(!empty($arr)){
            $data['status'] = true;
            $data['dimensoes'] = $arr;
        }
        print json_encode($data);
        exit();
    }

    private function validar_formulario_descricao(){
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

    //EDITAR: CONVITE (Enviado da página do orcamento)
    public function session_orcamento_convite_editar(){
        $posicao = $this->uri->segment(3);
        $this->criar_convite();
        $this->session->convite = clone $this->session->orcamento->convite[$posicao];
        $this->session->convite->is_edicao = true;
        $this->session->convite->session_posicao = $posicao;
        redirect(base_url('convite'), 'auto');
    }

    public function session_orcamento_convite_excluir(){
        $posicao = $this->uri->segment(3);
        unset($this->session->orcamento->convite[$posicao]);
        redirect(base_url('orcamento'), 'auto');
    }

    public function session_mao_obra_inserir() {
        $this->validar_formulario_mao_obra();
        $convite = $this->session->convite;
        $mao_obra = $this->Mao_obra_m->get_by_id($this->input->post('mao_obra'));
        $convite->mao_obra = $mao_obra;
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Mão de obra</strong> inserido com sucesso'));
        exit();
    }

    public function session_mao_obra_editar() {
        $this->validar_formulario_mao_obra();
        $convite = $this->session->convite;
        $mao_obra = $this->Mao_obra_m->get_by_id($this->input->post('mao_obra'));
        $convite->mao_obra = $mao_obra;
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Mão de obra</strong> editado com sucesso'));
        exit();
    }

    public function session_mao_obra_excluir() {
        $this->session->convite->mao_obra = new Mao_obra_m();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Mao de obra</strong> excluido com sucesso'));
        exit();
    }

    private function validar_formulario_mao_obra(){
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
    public function session_papel_inserir(){
        $this->validar_formulario_papel();
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_papel[] = $this->set_papel('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_papel[] = $this->set_papel('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Papel</strong> inserido com sucesso'));
        exit();
    }

    public function session_papel_editar(){
        $this->validar_formulario_papel();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_papel[$posicao] = $this->set_papel('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_papel[$posicao] = $this->set_papel('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Papel</strong> editado com sucesso'));
        exit();
    }

    public function session_papel_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_papel[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_papel[$posicao]);
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Papel</strong> excluido com sucesso'));
        exit();
    }

    private function set_papel($owner){
        //Papel:
        $papel = $this->input->post('papel');
        $dimensao = $this->input->post('dimensao');
        $gramatura = $this->input->post('gramatura');
        //$owner = $this->input->post('owner'); //variável inutilizada para teste. Recebendo desta vêz por parâmetro.
        //Empastamento:
        empty($this->input->post('empastamento_quantidade'))? $empastamento_quantidade = 0 : $empastamento_quantidade = $this->input->post('empastamento_quantidade');
        empty($this->input->post('empastamento_adicionar'))? $empastamento_adicionar = 0 : $empastamento_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('empastamento_cobrar'))? $empastamento_cobrar = 0 : $empastamento_cobrar = 1;
        
        //Laminação:
        empty($this->input->post('laminacao_quantidade'))? $laminacao_quantidade = 0 : $laminacao_quantidade = $this->input->post('laminacao_quantidade');
        empty($this->input->post('laminacao_adicionar'))? $laminacao_adicionar = 0 : $laminacao_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('laminacao_cobrar'))? $laminacao_cobrar = 0 : $laminacao_cobrar = 1;
        
        //Douração:
        empty($this->input->post('douracao_quantidade'))? $douracao_quantidade = 0 : $douracao_quantidade = $this->input->post('douracao_quantidade');
        empty($this->input->post('douracao_adicionar'))? $douracao_adicionar = 0 : $douracao_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('douracao_cobrar'))? $douracao_cobrar = 0 : $douracao_cobrar = 1;

        //Corte Laser:
        empty($this->input->post('corte_laser_quantidade'))? $corte_laser_quantidade = 0 : $corte_laser_quantidade = $this->input->post('corte_laser_quantidade');
        empty($this->input->post('corte_laser_adicionar'))? $corte_laser_adicionar = 0 : $corte_laser_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('corte_laser_cobrar'))? $corte_laser_cobrar = 0 : $corte_laser_cobrar = 1;
        empty($this->input->post('corte_laser_minutos'))? $corte_laser_minutos = 0 : $corte_laser_minutos = $this->input->post('corte_laser_minutos');

        //Relevo Seco:
        empty($this->input->post('relevo_seco_quantidade'))? $relevo_seco_quantidade = 0 : $relevo_seco_quantidade = $this->input->post('relevo_seco_quantidade');
        empty($this->input->post('relevo_seco_adicionar'))? $relevo_seco_adicionar = 0 : $relevo_seco_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('relevo_seco_cobrar'))? $relevo_seco_cobrar = 0 : $relevo_seco_cobrar = 1;
        empty($this->input->post('relevo_seco_cobrar_faca_cliche'))? $relevo_seco_cobrar_faca_cliche = 0 : $relevo_seco_cobrar_faca_cliche = 1;

        //Hot Stamping:
        empty($this->input->post('hot_stamping_quantidade'))? $hot_stamping_quantidade = 0 : $hot_stamping_quantidade = $this->input->post('hot_stamping_quantidade');
        empty($this->input->post('hot_stamping_adicionar'))? $hot_stamping_adicionar = 0 : $hot_stamping_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('hot_stamping_cobrar'))? $hot_stamping_cobrar = 0 : $hot_stamping_cobrar = 1;
        empty($this->input->post('hot_stamping_cobrar_faca_cliche'))? $hot_stamping_cobrar_faca_cliche = 0 : $hot_stamping_cobrar_faca_cliche = 1;

        //Corte Vinco:
        empty($this->input->post('corte_vinco_quantidade'))? $corte_vinco_quantidade = 0 : $corte_vinco_quantidade = $this->input->post('corte_vinco_quantidade');
        empty($this->input->post('corte_vinco_adicionar'))? $corte_vinco_adicionar = 0 : $corte_vinco_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('corte_vinco_cobrar'))? $corte_vinco_cobrar = 0 : $corte_vinco_cobrar = 1;
        empty($this->input->post('corte_vinco_cobrar_faca_cliche'))? $corte_vinco_cobrar_faca_cliche = 0 : $corte_vinco_cobrar_faca_cliche = 1;

        //Almofada:
        empty($this->input->post('almofada_quantidade'))? $almofada_quantidade = 0 : $almofada_quantidade = $this->input->post('almofada_quantidade');
        empty($this->input->post('almofada_adicionar'))? $almofada_adicionar = 0 : $almofada_adicionar = 1;
        $quantidadePapel = 1;
        empty($this->input->post('almofada_cobrar'))? $almofada_cobrar = 0 : $almofada_cobrar = 1;
        empty($this->input->post('almofada_cobrar_faca_cliche'))? $almofada_cobrar_faca_cliche = 0 : $almofada_cobrar_faca_cliche = 1;


        /*========================================================================================*/
        (!empty($empastamento_quantidade))? $quantidadePapel += $empastamento_quantidade:'';
        //busca o papel pelo id e seta a gramatura
        $container = $this->Container_m->get_papel($owner,$papel,$dimensao,$quantidadePapel,$gramatura,$empastamento_adicionar,$empastamento_quantidade,$empastamento_cobrar,$laminacao_adicionar,$laminacao_quantidade,$laminacao_cobrar,$douracao_adicionar,$douracao_quantidade,$douracao_cobrar,$corte_laser_adicionar,$corte_laser_quantidade,$corte_laser_cobrar,$corte_laser_minutos,$relevo_seco_adicionar,$relevo_seco_quantidade,$relevo_seco_cobrar,$relevo_seco_cobrar_faca_cliche,$hot_stamping_adicionar,$hot_stamping_quantidade,$hot_stamping_cobrar,$hot_stamping_cobrar_faca_cliche,$corte_vinco_adicionar,$corte_vinco_quantidade,$corte_vinco_cobrar,$corte_vinco_cobrar_faca_cliche,$almofada_adicionar,$almofada_quantidade,$almofada_cobrar,$almofada_cobrar_faca_cliche);
        return $container;
    }

    private function validar_formulario_papel() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('papel', 'Papel', 'required');
        $this->form_validation->set_rules('dimensao', 'Destino', 'required');
        $this->form_validation->set_rules('gramatura', 'Gramatura', 'required');
        if(!empty($this->input->post('empastamento_adicionar'))){
            $this->form_validation->set_rules('empastamento_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
        }
        if(!empty($this->input->post('laminacao_adicionar'))){
            $this->form_validation->set_rules('laminacao_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
        }
        if(!empty($this->input->post('douracao_adicionar'))){
            $this->form_validation->set_rules('douracao_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
        }
        if(!empty($this->input->post('corte_laser_adicionar'))){
            $this->form_validation->set_rules('corte_laser_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
            $this->form_validation->set_rules('corte_laser_minutos', 'Minutos', 'required|is_natural_no_zero|no_leading_zeroes');    
        }
        if(!empty($this->input->post('relevo_seco_adicionar'))){
            $this->form_validation->set_rules('relevo_seco_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
        }
        if(!empty($this->input->post('corte_vinco_adicionar'))){
            $this->form_validation->set_rules('corte_vinco_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
        }
        if(!empty($this->input->post('almofada_adicionar'))){
            $this->form_validation->set_rules('almofada_quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');    
        }

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
    //SESSION: IMPRESSÃO
    public function session_impressao_inserir(){
        $this->validar_formulario_impressao();
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_impressao[] = $this->set_impressao('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_impressao[] = $this->set_impressao('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Impressão</strong> inserido com sucesso'));
        exit();  
    }

    public function session_impressao_editar(){
        $this->validar_formulario_impressao();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_impressao[$posicao] = $this->set_impressao('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_impressao[$posicao] = $this->set_impressao('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Impressão</strong> editado com sucesso'));
        exit();   
    }

    public function session_impressao_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_impressao[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_impressao[$posicao]);
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Impressão</strong> excluido com sucesso'));
        exit(); 
    }

    private function set_impressao($owner){
        //busca o impressao pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_impressao($owner,$this->input->post('impressao'),$this->input->post('dimensao'),$this->input->post('quantidade'),$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_impressao(){
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
    public function session_acabamento_inserir(){
        $this->validar_formulario_acabamento();
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_acabamento[] = $this->set_acabamento('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_acabamento[] = $this->set_acabamento('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acabamento</strong> inserido com sucesso'));
        exit();  
    }

    public function session_acabamento_editar(){
        $this->validar_formulario_acabamento();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_acabamento[$posicao] = $this->set_acabamento('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_acabamento[$posicao] = $this->set_acabamento('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acabamento</strong> editado com sucesso'));
        exit();   
    }

    public function session_acabamento_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_acabamento[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_acabamento[$posicao]);
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acabamento</strong> excluido com sucesso'));
        exit(); 
    }

    private function set_acabamento($owner){
        //busca o acabamento pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_acabamento($owner,$this->input->post('acabamento'),$this->input->post('quantidade'),$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_acabamento(){
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
    public function session_acessorio_inserir(){
        $this->validar_formulario_acessorio();
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_acessorio[] = $this->set_acessorio('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_acessorio[] = $this->set_acessorio('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acessório</strong> inserido com sucesso'));
        exit();  
    }

    public function session_acessorio_editar(){
        $this->validar_formulario_acessorio();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_acessorio[$posicao] = $this->set_acessorio('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_acessorio[$posicao] = $this->set_acessorio('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acessório</strong> editado com sucesso'));
        exit();  
    }

    public function session_acessorio_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner  == 'cartao'){
            unset($this->session->convite->cartao->container_acessorio[$posicao]);
        }else if($owner  == 'envelope'){
            unset($this->session->convite->envelope->container_acessorio[$posicao]);
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Acessório</strong> excluido com sucesso'));
        exit();
    }

    private function set_acessorio($owner){
        //busca o acessorio pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_acessorio($owner,$this->input->post('acessorio'),$this->input->post('quantidade'),$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_acessorio(){
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
    public function session_fita_inserir(){
        $this->validar_formulario_fita();
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_fita[] = $this->set_fita('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_fita[] = $this->set_fita('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Fita</strong> inserido com sucesso'));
        exit();   
    }

    public function session_fita_editar(){
        $this->validar_formulario_fita();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_fita[$posicao] = $this->set_fita('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_fita[$posicao] = $this->set_fita('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Fita</strong> editado com sucesso'));
        exit();   
    }

    public function session_fita_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_fita[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_fita[$posicao]);
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Fita</strong> excluido com sucesso'));
        exit(); 
    }

    private function set_fita($owner){
        $container = $this->Container_m->get_fita($owner,$this->input->post('fita'),$this->input->post('quantidade'),$this->input->post('descricao'),$this->input->post('espessura'));
        return $container;
    }

    public function check_espessura_valor(){
        $this->form_validation->set_message('check_espessura_valor','Espessura não definida para esta fita');
        if($this->input->post('fita')){
            $fita = $this->Fita_m->get_by_id($this->input->post('fita'));

            switch ($this->input->post('espessura')) {
                case '3':
                    if($fita->valor_03mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '7':
                    if($fita->valor_07mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '10':
                    if($fita->valor_10mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '15':
                    if($fita->valor_15mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '22':
                    if($fita->valor_22mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '38':
                    if($fita->valor_38mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '50':
                    if($fita->valor_50mm <= 0.00){
                        return false;
                    }
                    return true;
                    break;
                case '70':
                    if($fita->valor_70mm <= 0.00){
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

    private function validar_formulario_fita(){
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
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_cliche[] = $this->set_cliche('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_cliche[] = $this->set_cliche('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Clichê</strong> inserido com sucesso'));
        exit();  
    }

    public function session_cliche_editar(){
        $this->validar_formulario_cliche();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_cliche[$posicao] = $this->set_cliche('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_cliche[$posicao] = $this->set_cliche('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Clichê</strong> editado com sucesso'));
        exit();   
    }

    public function session_cliche_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_cliche[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_cliche[$posicao]);
        }
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
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_faca[] = $this->set_faca('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_faca[] = $this->set_faca('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Faca</strong> inserido com sucesso'));
        exit();  
    }

    public function session_faca_editar(){
        $this->validar_formulario_faca();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_faca[$posicao] = $this->set_faca('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_faca[$posicao] = $this->set_faca('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Faca</strong> editado com sucesso'));
        exit();   
    }

    public function session_faca_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_faca[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_faca[$posicao]);
        }
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
    public function session_laser_inserir(){
        $this->validar_formulario_laser();
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_laser[] = $this->set_laser('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_laser[] = $this->set_laser('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Laser</strong> inserido com sucesso'));
        exit();  
    }

    public function session_laser_editar(){
        $this->validar_formulario_laser();
        $posicao = $this->uri->segment(4);
        if($this->uri->segment(3) == 'cartao'){
            $this->session->convite->cartao->container_laser[$posicao] = $this->set_laser('cartao');
        }else if($this->uri->segment(3) == 'envelope'){
            $this->session->convite->envelope->container_laser[$posicao] = $this->set_laser('envelope');
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Laser</strong> editado com sucesso'));
        exit();   
    }

    public function session_laser_excluir(){
        $posicao = $this->input->post('posicao');
        $owner = $this->input->post('owner');
        if($owner == 'cartao'){
            unset($this->session->convite->cartao->container_laser[$posicao]);
        }else if($owner == 'envelope'){
            unset($this->session->convite->envelope->container_laser[$posicao]);
        }
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Laser</strong> excluido com sucesso'));
        exit(); 
    }

    private function set_laser($owner){
        //busca o laser pelo id e seta a quantidade e descrição
        $container = $this->Container_m->get_laser($owner,$this->input->post('laser'),$this->input->post('quantidade'),$this->input->post('qtd_minutos'),$this->input->post('descricao'));
        return $container;
    }

    private function validar_formulario_laser(){
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

    //Verifica se existem itens e mão de obra no [cartão, envelope]
    public function is_empty_container_itens(){
        $data = array();
        $data['status'] = TRUE;
        $cartao = $this->session->convite->cartao;
        $envelope = $this->session->convite->envelope;

        if( empty($cartao->container_papel) &&
            empty($cartao->container_impressao) &&
            empty($cartao->container_acabamento) &&
            empty($cartao->container_acessorio)  &&
            empty($cartao->container_fita) &&
            empty($cartao->container_cliche) &&
            empty($cartao->container_faca) &&
            empty($cartao->container_laser) &&
            empty($envelope->container_papel) &&
            empty($envelope->container_impressao) &&
            empty($envelope->container_acabamento) &&
            empty($envelope->container_acessorio)  &&
            empty($envelope->container_fita) &&
            empty($envelope->container_cliche) &&
            empty($envelope->container_faca) &&
            empty($envelope->container_laser)
        ){
            $data['status'] = FALSE;
            $data['msg'] = "O cartão e envelope estão vazios";
        }else if(empty($this->session->convite->mao_obra->id)){
            $data['status'] = FALSE;
            $data['msg'] = "A mão de obra não foi definida.";
            $data['location'] = "mao_obra";
        }else{
            $data['msg'] = "O convite está pronto para ser adicionado";
        }
        print json_encode($data);
        exit(); 
    }

    //Verifica se há um modelo e quantidade para o convite
    public function is_empty_modelo_quantidade(){
        $data = array();
        $data['status'] = TRUE;
        if(empty($this->session->convite->modelo->id) || empty($this->session->convite->quantidade)){
            $data['status'] = FALSE;
            $data['msg'] = "Modelo ou quantidade não foram definidos";
        }  
        print json_encode($data);
        exit();  
    }

}
