<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personalizado_categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Personalizado_categoria_m');
        init_layout();
        set_layout('titulo', 'Categoria de personalizado', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['titulo_painel'] = 'Categoria de personalizado';
        set_layout('conteudo', load_content('personalizado_categoria/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Personalizado_categoria_m->get_datatables();
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
            "recordsTotal" => $this->Personalizado_categoria_m->count_all(),
            "recordsFiltered" => $this->Personalizado_categoria_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $objeto = $this->get_post();
        if ( $this->Personalizado_categoria_m->inserir($objeto)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["personalizado_categoria"] = $this->Personalizado_categoria_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario(true);
        if ($this->input->post('id')) {
            $objeto = $this->get_post();
            if ($this->Personalizado_categoria_m->editar($objeto)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Personalizado_categoria_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Personalizado_categoria_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $objeto = new Personalizado_categoria_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    private function validar_formulario($update = false) {
        $data['status'] = TRUE;
        $data = array();
        if($update && !empty($this->input->post('id'))){
            $object = $this->Personalizado_categoria_m->get_by_id($this->input->post('id'));
            if($this->input->post('nome') != $object->nome){
                $is_unique =  '|is_unique[personalizado_categoria.nome]';
            }else{
                $is_unique =  '';
            }   
        }else{
            $is_unique =  '|is_unique[personalizado_categoria.nome]';
        }
        $this->form_validation->set_message('is_unique','Já exixte um campo com este nome. Dados duplicados não são permitidos.');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]'.$is_unique);
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if(!$this->form_validation->run()){
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}