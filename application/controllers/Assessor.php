<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Assessor_m');
        init_layout();
        set_layout('titulo', 'Assessor', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('assessor/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Assessor_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'sobrenome' => $item->sobrenome,
                'telefone' => $item->telefone,
                'email' => $item->email,
                'empresa' => $item->empresa,
                'comissao' => $item->comissao,
                'descricao' => $item->descricao,
                'ativo' => $item->ativo,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Assessor_m->count_all(),
            "recordsFiltered" => $this->Assessor_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario();
        $data['status'] = FALSE;
        $dados = $this->get_post();
        if ($data["id"] = $this->Assessor_m->inserir($dados)) {//Retornando o id para o crud da view do orçamento
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["assessor"] = $this->Assessor_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $dados = $this->get_post();
            if ($data["id"] = $this->Assessor_m->editar($dados)) {//Retornando o id para o crud da view do orçamento
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Assessor_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'nome' => $this->input->post('nome'),
            'sobrenome' => $this->input->post('sobrenome'),
            'email' => $this->input->post('email'),
            'telefone' => $this->input->post('telefone'),
            'empresa' => $this->input->post('empresa'),
            'descricao' => $this->input->post('descricao'),
            'comissao' => $this->input->post('comissao'),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo'),
            );
        return $dados;
    }

    private function validar_formulario() {
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('empresa', 'Empresa', 'trim|max_length[100]');
        $this->form_validation->set_rules('comissao', 'Comissão', 'required|trim|is_natural');
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