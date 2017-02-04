<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //Orçamento
        $this->load->model('Orcamento_m');
        $this->load->model('Cliente_m');
        $this->load->model('Assessor_m');
        $this->load->model('Mao_obra_m');

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

        //TODO CARREGAR TODOS OS OBJETOS DAS VARIAVEIS DO ORÇAMENTO PARA NÃO DAR ERRRO!!
        init_layout();
        set_layout('titulo', 'Orçamento', FALSE);
        //empty($this->session->orcamento) ? $this->__criar_orcamento() : '';
    }

    public function index() {
        $this->load->view("template/email/novo_usuario");
    }

    public function orcamento() {
        var_dump($this->session->personalizado->descricao);
    }

    public function email() {
        $this->load->helper('template');
        $e = email_send("fellipe6900@gmail.com,fpinheiro@orcasistemas.com.br", "novo_usuario", array('a','b','c'));
        var_dump($e);
    }

}

/* End of file teste.php */
/* Location: ./application/controllers/teste.php */