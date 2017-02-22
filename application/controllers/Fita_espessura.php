<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fita_espessura extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Fita_espessura_m');
        init_layout();
        set_layout('titulo', 'Fita Espessura', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('fita_espessura/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Fita_espessura_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'esp_03mm' => $item->esp_03mm,
                'esp_07mm' => $item->esp_07mm,
                'esp_10mm' => $item->esp_10mm,
                'esp_15mm' => $item->esp_15mm,
                'esp_22mm' => $item->esp_22mm,
                'esp_38mm' => $item->esp_38mm,
                'esp_50mm' => $item->esp_50mm,
                'esp_70mm' => $item->esp_70mm,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Fita_espessura_m->count_all(),
            "recordsFiltered" => $this->Fita_espessura_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario();
        $data['status'] = FALSE;
        $dados = $this->get_post();
        if ( $this->Fita_espessura_m->inserir($dados)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["fita_espessura"] = $this->Fita_espessura_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $dados = $this->get_post();
            if ($this->Fita_espessura_m->editar($dados)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Fita_espessura_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'esp_03mm' => $this->input->post('esp_03mm'),
            'esp_07mm' => $this->input->post('esp_07mm'),
            'esp_10mm' => $this->input->post('esp_10mm'),
            'esp_15mm' => $this->input->post('esp_15mm'),
            'esp_22mm' => $this->input->post('esp_22mm'),
            'esp_38mm' => $this->input->post('esp_38mm'),
            'esp_50mm' => $this->input->post('esp_50mm'),
            'esp_70mm' => $this->input->post('esp_70mm'),
            );
        return $dados;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('esp_03mm', 'esp_03mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_07mm', 'esp_07mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_10mm', 'esp_10mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_15mm', 'esp_15mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_22mm', 'esp_22mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_38mm', 'esp_38mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_50mm', 'esp_50mm', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('esp_70mm', 'esp_70mm', 'trim|required|max_length[20]');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}