<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Impressao_area extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Impressao_area_m');
        init_layout();
        set_layout('titulo', 'Impressões área', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('impressao_area/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Impressao_area_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'descricao' => $item->descricao,
                'ativo' => $item->ativo,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Impressao_area_m->count_all(),
            "recordsFiltered" => $this->Impressao_area_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $dados = $this->get_post();
        if ( $this->Impressao_area_m->inserir($dados)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["impressao_area"] = $this->Impressao_area_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $dados = $this->get_post();
            if ($this->Impressao_area_m->editar($dados)) {
                $data['status'] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data['status'] = FALSE;
        if(!empty($id)){
            if($this->Impressao_area_m->deletar($id)){
                $data['status'] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Impressao_area_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo'),
            );
        return $dados;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('validar_boolean', 'O Ativo deve ser um valor entre 0 e 1');
        $this->form_validation->set_rules('ativo', 'Ativo', 'trim|validar_boolean');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}