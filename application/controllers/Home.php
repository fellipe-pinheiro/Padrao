<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        init_layout();
        set_layout('titulo', 'Home',FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('home/index',NULL));
        load_layout();
    }
    
    public function create() {
        set_layout('conteudo', load_content('home/Create',$dados));
        load_layout();
    }
    
    public function email() {
        set_layout('conteudo', load_content('home/email'));
        load_layout();
    }
    public function teste()
    {
        //Orçamento
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

        $obj = $this->Orcamento_m->get_by_id(187);
        var_dump($obj);
    }
}
