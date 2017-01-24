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
        restrito_logado();
        $data['titulo_painel'] = 'Assessores';
        set_layout('conteudo', load_content('assessor/lista', $data));
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
                'descricao' => $item->descricao
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
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        $result = $this->Assessor_m->inserir($objeto);
        if ($result) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso','id'=>$result));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["assessor"] = $this->Assessor_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();
            $result = $this->Assessor_m->editar($objeto);
            if ($result) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso','id'=>$result));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Assessor_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Assessor_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function _get_post() {
        $objeto = new Assessor_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->sobrenome = $this->input->post('sobrenome');
        $objeto->telefone = $this->input->post('telefone');
        $objeto->email = $this->input->post('email');
        $objeto->empresa = $this->input->post('empresa');
        $objeto->comissao = $this->input->post('comissao');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('empresa', 'Empresa', 'trim|max_length[50]');
        $this->form_validation->set_rules('comissao', 'Comissão', 'required|trim|is_natural');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}