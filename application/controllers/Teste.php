<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function __construct() {
        parent::__construct();
        init_layout();
        set_layout('titulo', 'Teste',FALSE);
        restrito_logado();
    }

    public function index(){
        set_layout('conteudo', load_content('teste/index',""));
        load_layout();
    }

    public function calendario(){
        $this->load->library('calendar');
        $data['janeiro'] = $this->calendar->generate(2017,1);
        $data['fevereiro'] = $this->calendar->generate(2017,2);
        $data['marco'] = $this->calendar->generate(2017,3);
        $data['abril'] = $this->calendar->generate(2017,4);
        $data['maio'] = $this->calendar->generate(2017,5);
        $data['junho'] = $this->calendar->generate(2017,6);
        $data['julho'] = $this->calendar->generate(2017,7);
        $data['agosto'] = $this->calendar->generate(2017,8);
        $data['setembro'] = $this->calendar->generate(2017,9);
        $data['outubro'] = $this->calendar->generate(2017,10);
        $data['novembro'] = $this->calendar->generate(2017,11);
        $data['dezembro'] = $this->calendar->generate(2017,12);
        set_layout('conteudo', load_content('teste/calendario',$data));
        load_layout();
    }

    private function get_gramatura( $pattern, $input, $flags = 0 )
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
