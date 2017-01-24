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
    set_layout('titulo', 'Orçamento',FALSE);
    //empty($this->session->orcamento) ? $this->__criar_orcamento() : '';
}

public function index(){
         //orcamento
    date_default_timezone_set('America/Sao_Paulo');
    $dados = array(
        'id'=>null,
        'data_hora'=>date('Y-m-d H:i:s'),
        'data'=>date('Y-m-d'),
        'hora'=>date('H:i:s'),
        );
    if($this->db->insert('data_teste',$dados)){
        $id = $this->db->insert_id();
        $query = $this->db->get_where('data_teste', array('id' => $id),1);
        $result = $query->result_array();
        print 'var_dump($result[0]["data_hora"])';
        var_dump($result[0]['data_hora']);

        print '<br>';
        print 'list($get_date, $get_time) = explode(" ", $result[0]["data_hora"]);';
        list($get_date, $get_time) = explode(" ", $result[0]['data_hora']);
        print '<br>';
        print 'Data: '.$get_date;
        print '<br>';
        print 'Hora: '.$get_time;
        print '<br>';

        print '<br>';
        print '$data = date_create($result[0]["data_hora"]);';
        print '<br>';
        print 'date_format($data,"d/m/Y H:i:s")';
        $data = date_create($result[0]['data_hora']);
        print '<br>Resultado: '.date_format($data,"d/m/Y H:i:s");

        print '<br><br> Comparando datas<br>';
        if( strtotime('2016/10/21') == strtotime(date('Y/m/d')) ) {
            print 'Data identica a hoje';
        }else if(strtotime('2016/10/21') > strtotime(date('Y/m/d'))){
            print 'Data posterior a hoje';
        }else{
            print 'Data anterior a hoje';
        }
        print '<br>Agora'.strtotime(date('Y/m/d'));
        print '<br>Data passada'.strtotime('2016/10/22');
        print '<br>';
        //var_dump( explode('','asdasd') );
        //Adicionando 7 dias
        var_dump(date("Y-m-d",strtotime(date('Y-m-d'). ' + 7 days')));
        var_dump($this->Cliente_m->get_by_pedido_id(50)->nome);
        var_dump(date('n'));
        echo date("Y-m-d", strtotime("first day of previous month"));
        print '<br>';
        echo date("Y-m-d", strtotime("last day of previous month"));
        print '<br>';
        echo date("Y-m-d", strtotime('first day of January '.date('Y-m-d') ));
        print '<br>';
        echo date('Y-m-d', strtotime('Dec 31'));
        print '<br>';
        echo date('Y-m-d', strtotime('+1 year'.date("Y-m-d", strtotime('first day of January'))));
        print '<br>';
        echo date('Y-m-d', strtotime('+1 year'.date("Y-m-d", strtotime('Dec 31'))));
        var_dump($this->session);
    }
}
public function orcamento(){
    var_dump($this->session->personalizado->descricao);
}

public function t1() {
    $data = date_create("0000-00-00");
    print date_format($data,"d/m/Y H:i:s");
    define("GREETING","Hello you! How are you today?");
    print GREETING;
}

}

/* End of file teste.php */
/* Location: ./application/controllers/teste.php */