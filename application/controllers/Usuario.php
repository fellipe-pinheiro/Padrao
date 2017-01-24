<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model("Usuario_m");
        init_layout();
        set_layout('titulo', 'Usuário', FALSE);
        restrito_logado();
    }

    public function index() {
        $view_data = $this->Usuario_m->get_object();
        set_layout('conteudo', load_content("usuario/detalhes", $view_data));
        load_layout();
    }

    public function detalhes() {
        $id = $this->uri->segment(3);
        $view_data["usuario"] = $this->Usuario_m->get_object();
        set_layout('conteudo', load_content("usuario/detalhes", $view_data));
        load_layout();
    }

    public function gestao_usuarios() {
        $view_data["grupos"] = $this->Usuario_m->get_groups_all();
        set_layout('conteudo', load_content("usuario/lista", $view_data));
        load_layout();
    }

    public function restrito_grupo() {
        set_layout('conteudo', load_content("usuario/restrito_grupo"));
        load_layout();
    }

    public function form() {
        $id = $this->uri->segment(3);
        if (empty($id)) {
            $view_data['acao'] = 'inserir';
        } else {
            $view_data['acao'] = 'editar';
            $view_data['usuario'] = $this->Usuario_m->get_object($id);
        }
        set_layout('conteudo', load_content("usuario/form", $view_data));
        load_layout();
    }

    public function inserir() {
        $view_data['acao'] = 'inserir';
        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('company', 'Empresa', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $view_data['form_validation'] = $this->form_validation->error_array();
            set_layout('conteudo', load_content("usuario/gestao_usuarios", $view_data));
            load_layout();
        } else {
            $email = strtolower($this->input->post('email'));
            $identity = $email;
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );

            $password = "$email";

            if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {

                $this->session->set_flashdata('sucesso', 'Registro inserido com sucesso');
                redirect(base_url("Usuario/gestao_usuarios"));
            } else {

                $this->session->set_flashdata('erro', 'Erro ao registrar os dados');
                redirect(base_url("Usuario/gestao_usuarios"));
            }
        }
    }

    public function editar() {
        $view_data['acao'] = 'editar';

        $this->form_validation->set_rules('id', 'ID', 'trim|required');
        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('company', 'Empresa', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            $view_data['usuario'] = $this->Usuario_m->get_object($this->input->post('id'));

            set_layout('conteudo', load_content("usuario/form", $view_data));
            load_layout();
        } else {
            print "Formulario aceito";
        }
    }

    public function ajax_add() {
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $data = $this->_get_post();
        if ($this->ion_auth->register($data['email'], "", $data['email'], $data)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo ion_auth->register()";
        }
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');

        // verificar os grupos selecionados
        $grupos = $this->Usuario_m->get_groups_all();
        $post = $this->input->post();
        $in = array();
        $out = array();
        for ($i = 0; $i < count($grupos); $i++) {
            if (array_key_exists("gp_" . $grupos[$i]["id"], $post)) {
                $in[] = $grupos[$i]["id"];
            } 
            $out[] = $grupos[$i]["id"];
        }

        if ($id) {
            $data = $this->_get_post();

            if ($this->ion_auth->update($id, $data)) {
                // atualizar os grupos do usuario
                $this->Usuario_m->remove_from_group($out,$id);
                
                $this->Usuario_m->add_to_group($in,$id);
                
                print json_encode(array("status" => TRUE, 'msg' => 'Registro auterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo ion_auth->update()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro nao foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->ion_auth->deactivate($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro desativado com sucesso"));
    }

    public function ajax_edit($id) {
        $data["usuario"] = $this->Usuario_m->get_object($id);
        $data["usuario"]->groups = $this->Usuario_m->get_groups($data["usuario"]->id);
        $data["status"] = TRUE;
        print json_encode($data);
    }

    public function ajax_list() {
        $list = $this->Usuario_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $usuario) {
            $no++;
            $row = array(
                'DT_RowId' => $usuario->id,
                'id' => $usuario->id,
                'name' => $usuario->first_name,
                'last_name' => $usuario->last_name,
                'email' => $usuario->email,
                'phone' => $usuario->phone,
                'active' => $usuario->active ? "Ativo" : "Inativo",
                'created_on' => date("d/m/Y", $usuario->created_on),
                'last_login' => date("d/m/Y H:i:s", $usuario->last_login),
                'groups' => $this->Usuario_m->get_groups($usuario->id),
            );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Usuario_m->count_all(),
            "recordsFiltered" => $this->Usuario_m->count_filtered(),
            "data" => $data,
        );
        //output to json format
        print json_encode($output);
    }

    private function _get_post() {
        $post = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'company' => $this->input->post('company')
        );
        return $post;
    }

    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        $tables = $this->config->item('tables', 'ion_auth');

        if ($action == 'add') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[' . $tables['users'] . '.email]');
        }
        if ($action == 'edit') {
            $this->form_validation->set_rules('id', 'id', 'trim|required');
        }

        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');

        $this->form_validation->set_rules('company', 'Empresa', 'trim|required');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

}
