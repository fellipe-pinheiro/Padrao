<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['html', 'template']);
        $this->load->library(array('ion_auth', 'form_validation'));
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
            $redirecionar = $this->input->post('redirecionar');

            if ($this->ion_auth->login($this->input->post('login'), $this->input->post('senha'), $remember)) {
                // Logado com sucesso
                redirect($redirecionar, 'refresh');
            } else {
                // Erro ao fazer login
                set_flashdata($this->ion_auth->errors(),"danger");
                redirect('login');
            }
        } else {
            set_flashdata("Usuário ou senha inválido", "danger");
            redirect('login', 'refresh');
        }
    }

    public function logout() {
        $logout = $this->ion_auth->logout();
        redirect(base_url(), 'refresh');
    }

    public function t1($p1 = null, $p2 = null) {
        $this->load->library('email');

        $this->email->from('notificacao@orcasistemas.com.br', 'Notificação', 'erro@orcasistemas.com.br');
        $this->email->to('fpinheiro@orcasistemas.com.br');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');

        $this->email->subject('Notificação da Orca SIstemas');
        $message = $this->load->view("welcome_message", $data = array('a', 'b'), true);
        $this->email->message($message);

        var_dump($this->email->send());
    }

    public function esqueci_senha() {
        set_layout('titulo', 'Redefinir Senha');
        set_layout('menu', '');
        set_layout('breadcrumb', '');
        set_layout('conteudo', load_content('login/esqueci_senha'));
        load_layout();
    }

    public function enviar_senha() {
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_check');

        if ($this->form_validation->run() == true) {
            // gerar o codigo para redenifir a senha
            $email = $this->input->post('email');
            $forgotten = $this->ion_auth->forgotten_password($email);
            // caso nao gere o codigo
            if (!$forgotten) {
                set_flashdata("Usuário desativado", "danger");
                redirect(base_url('login/esqueci_senha'), 'refresh');
            }
            $view_data["codigo"] = $forgotten["forgotten_password_code"];
            $view_data["email"] = $email;
            $envio = email_send($email, "esqueci_senha", $view_data, "Redefinição de senha");
            if ($envio) {
                set_flashdata("Email enviado com sucesso", "success");
                redirect(base_url('login'), 'refresh');
            } else {
                set_flashdata("Erro ao enviar emial. Contate o administrador do sistemas", "danger");
                redirect(base_url('login'), 'refresh');
            }
        } else {
            foreach ($this->form_validation->error_array() as $msg) {
                set_flashdata($msg, "danger");
            }
            $this->session->set_flashdata('message', $this->form_validation->error_array());
            redirect("login/esqueci_senha", "refresh");
        }
    }

    public function redefinir_senha_form($codigo = null) {
        if (empty($codigo)) {
            print "<h1>Codigo não encontrado</h1>";
            die();
        }
        $user = $this->ion_auth->forgotten_password_check($codigo);

        if (empty($user)) {
            print "<h1>Codigo desatualizado.<br>Redefina a senha novamente</h1>";
            die();
        }

        $view_data["id"] = $user->id;
        $view_data["codigo"] = $codigo;
        set_layout('titulo', 'Criar nova senha');
        set_layout('menu', '');
        set_layout('breadcrumb', '');
        set_layout('conteudo', load_content('login/redefinir_senha_form', $view_data));
        load_layout();
    }

    public function redefinir_senha() {
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
        $this->form_validation->set_rules('confirmar_senha', 'Confirmar senha', 'trim|required|matches[senha]');

        if ($this->form_validation->run() == true) {
            $usuario = $this->ion_auth->forgotten_password_check($this->input->post('codigo'));
            $identity = $usuario->{$this->config->item('identity', 'ion_auth')};
            $change = $this->ion_auth->reset_password($identity, $this->input->post('senha'));
            $this->ion_auth->clear_forgotten_password_code($this->input->post('codigo'));

            set_flashdata("Senha redefinida com sucesso", "success");
            redirect("login");
        } else {
            foreach ($this->form_validation->error_array() as $msg) {
                set_flashdata($msg, "danger");
            }
            redirect("login/redefinir_senha_form/" . $this->input->post('codigo'));
        }
    }

    public function email_check($email) {
        $this->db->select('id, email');
        $this->db->where(array('email' => $email));
        $this->db->from("users");
        $count = $this->db->count_all_results();
        if (empty($count)) {
            $this->form_validation->set_message('email_check', 'Email não encontrado');
            return FALSE;
        } elseif ($count > 1) {
            $this->form_validation->set_message('email_check', 'Email duplicado no sistema. Contate o administrador');
            return FALSE;
        } elseif ($count == 1) {
            return TRUE;
        }
    }

}
