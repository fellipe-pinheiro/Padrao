<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('html');
        init_layout();
        set_layout('titulo', 'Login', FALSE);
    }

    public function index() { 
        set_layout('titulo', 'Login');
        set_layout('menu', '');
        set_layout('breadcrumb', '');
        set_layout('conteudo', load_content('login/login'));
        load_layout();
    }

    public function logar() {
        $this->form_validation->set_rules('login', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('senha', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

        if ($this->form_validation->run() == true) {
            $remember = (bool) $this->input->post('remember');
            $redirecionar  = $this->input->post('redirecionar');

            if ($this->ion_auth->login($this->input->post('login'), $this->input->post('senha'), $remember)) {
                
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect($redirecionar, 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }else{
            print "Formulario invalido";
            //var_dump($this->input->post());
        }
    }
    public function logout() {
        $logout = $this->ion_auth->logout();
        redirect(base_url(), 'refresh');
    }
    public function esqueci_senha() {
        set_layout('titulo', 'Redefinir Senha');
        set_layout('menu', '');
        set_layout('breadcrumb', '');
        set_layout('conteudo', load_content('login/esqueci_senha'));
        load_layout();
    }

}
