<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_dimensao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_dimensao_m');
        init_layout();
        set_layout('titulo', 'Dimensão dos papéis', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('papel_dimensao/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Papel_dimensao_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'altura' => $item->altura,
                'largura' => $item->largura,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_dimensao_m->count_all(),
            "recordsFiltered" => $this->Papel_dimensao_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $objeto = $this->get_post();
        if ( $this->Papel_dimensao_m->inserir($objeto)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["papel_dimensao"] = $this->Papel_dimensao_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $objeto = $this->get_post();
            if ($this->Papel_dimensao_m->editar($objeto)) {
                $data['status'] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data['status'] = FALSE;
        if(!empty($id)){
            if($this->Papel_dimensao_m->deletar($id)){
                $data['status'] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Papel_dimensao_m->get_pesonalizado("id, concat(altura,' x ',largura) as nome");
        print json_encode($arr);
    }

    private function get_post() {
        //gravando a altura como o menor valor para ordenação na query que será altura asc
        if($this->input->post('altura') >= $this->input->post('largura')){
            $dimensao_menor = $this->input->post('largura');
            $dimensao_maior = $this->input->post('altura');
        }else{
            $dimensao_menor = $this->input->post('altura');
            $dimensao_maior = $this->input->post('largura');
        }
        $objeto = new Papel_dimensao_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->altura = $dimensao_menor;
        $objeto->largura = $dimensao_maior;
        return $objeto;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('altura', 'Altura', 'trim|required|max_length[4]|alpha_numeric_spaces|decimal_positive|is_natural_no_zero');
        $this->form_validation->set_rules('largura', 'Largura', 'trim|required|max_length[4]|alpha_numeric_spaces|decimal_positive|is_natural_no_zero');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}