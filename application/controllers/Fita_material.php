<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fita_material extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Fita_material_m');
        init_layout();
        set_layout('titulo', 'Fita material', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['titulo_painel'] = 'Fita material';
        set_layout('conteudo', load_content('fita_material/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Fita_material_m->get_datatables();
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
            "recordsTotal" => $this->Fita_material_m->count_all(),
            "recordsFiltered" => $this->Fita_material_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario();
        $data['status'] = FALSE;
        $objeto = $this->get_post();
        if ( $this->Fita_material_m->inserir($objeto) ) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["fita_material"] = $this->Fita_material_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $objeto = $this->get_post();
            if ($this->Fita_material_m->editar($objeto)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Fita_material_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Fita_material_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $objeto = new Fita_material_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}