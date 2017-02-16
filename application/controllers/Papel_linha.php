<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_linha extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_linha_m');
        init_layout();
        set_layout('titulo', 'Linha de papéis', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('papel_linha/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Papel_linha_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'descricao' => $item->descricao,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_linha_m->count_all(),
            "recordsFiltered" => $this->Papel_linha_m->count_filtered(),
            "data" => $data,
            );
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $objeto = $this->get_post();
        if ( $this->Papel_linha_m->inserir($objeto) ) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["linha"] = $this->Papel_linha_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $objeto = $this->get_post();
            if ( $this->Papel_linha_m->editar($objeto) ) {
               $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Papel_linha_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Papel_linha_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $objeto = new Papel_linha_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
        }
    }
}