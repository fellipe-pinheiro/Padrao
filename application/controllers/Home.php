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
    private function __get_gramatura( $pattern, $input, $flags = 0 )
    {
        $keys = preg_grep( $pattern, array_keys( $input ), $flags );
        $vals = array();
        foreach ( $keys as $key )
        {   
            $num = explode("_",$key);
            $vals[] = array("gramatura"=>$input[$key],"valor"=>$input["valor_".$num[1]]);
        }
        return $vals;
    }

    public function t1()
    {
        $arr = array("gramatura_10"=>"10","valor_10"=>"1","gramatura_20"=>"20","valor_20"=>"2");
        var_dump($arr);
        print "<hr>";
        var_dump($this->preg_grep_keys("/gramatura_/",$arr));

    }

    public function validar_cnpj($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function teste_cnpj(){
        var_dump($this->validar_cnpj('11.444.777/0001-62'));
        var_dump($this->validar_cnpj('55.238.037/0001-44'));
        var_dump($this->validar_cnpj('81.888.736/0001-40'));
        var_dump($this->validar_cnpj('81.888.736/0001-41'));
    }

    public function testa_data_db(){
        var_dump(date_to_db('20-04-1982'));
        var_dump(date_to_db('1982-04-20'));
        
        var_dump(date_to_db('20/04/1982'));
        var_dump(date_to_db('1982/04/20'));
    }

    public function testa_no_leading_zeroes(){
        var_dump(no_leading_zeroes('01'));
        var_dump(no_leading_zeroes('010'));
        var_dump(no_leading_zeroes('0111'));
        var_dump(no_leading_zeroes('0111'));
    }

    public function teste_data_to_form(){
        var_dump(date_to_form('1982-04-20'));
        var_dump(date_to_form('20-04-1982'));
        var_dump(date_to_form('20/04/1982'));
        var_dump(date_to_form('1982/04/20'));
    }

    
}
