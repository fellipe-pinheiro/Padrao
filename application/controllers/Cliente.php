<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cliente_m');
        $this->load->model('Pedido_m');
        init_layout();
        set_layout('titulo', 'Cliente', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['estados'] = get_array_estados();
        $data['estados_json'] = json_encode(get_array_estados());
        set_layout('conteudo', load_content('cliente/lista', $data));
        load_layout();
    }

    public function profile(){
        $id = $this->uri->segment(3);
        $pedidos = array();
        $data["cliente"] = $this->Cliente_m->get_by_id($id);
        $data['pedidos'] = $this->Cliente_m->get_pedidos_by_cliente_id($id);
        foreach ($data['pedidos'] as $key => $pedido) {
            $pedidos[] = $this->Cliente_m->get_adicionais_by_pedido_id($pedido->ped_id);
        }
        foreach ($pedidos as $key => $pedido) {
            foreach ($pedido as $key => $adicional) {
                $data['adicionais'][] = $adicional;
            }
        }
        set_layout('conteudo', load_content('cliente/profile', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Cliente_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'pessoa_tipo' => $item->pessoa_tipo,
                'nome' => $item->nome,
                'sobrenome' => $item->sobrenome,
                'email' => $item->email,
                'telefone' => $item->telefone,
                'nome2' => $item->nome2,
                'sobrenome2' => $item->sobrenome2,
                'email2' => $item->email2,
                'telefone2' => $item->telefone2,
                'rg' => $item->rg,
                'cpf' => $item->cpf,
                'endereco' => $item->endereco,
                'numero' => $item->numero,
                'complemento' => $item->complemento,
                'estado' => $item->estado,
                'uf' => $item->uf,
                'bairro' => $item->bairro,
                'cidade' => $item->cidade,
                'cep' => $item->cep,
                'observacao' => $item->observacao,
                'razao_social' => $item->razao_social,
                'cnpj' => $item->cnpj,
                'ie' => $item->ie,
                'im' => $item->im,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Cliente_m->count_all(),
            "recordsFiltered" => $this->Cliente_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario();
        $data['status'] = FALSE;
        $objeto = $this->get_post();
        if ($data["id"] = $this->Cliente_m->inserir($objeto)) {//Retornando o id para o crud da view do orçamento
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["cliente"] = $this->Cliente_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario(true);
        if ($this->input->post('id')) {
            $objeto = $this->get_post();
            if ($data["id"] = $this->Cliente_m->editar($objeto)) {//Retornando o id para o crud da view do orçamento
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Cliente_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    private function get_post() {
        $objeto = new Cliente_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->pessoa_tipo = $this->input->post('pessoa_tipo');
        $objeto->nome = $this->input->post('nome');
        $objeto->sobrenome = $this->input->post('sobrenome');
        $objeto->email = $this->input->post('email');
        $objeto->telefone = $this->input->post('telefone');
        $objeto->nome2 = $this->input->post('nome2');
        $objeto->sobrenome2 = $this->input->post('sobrenome2');
        $objeto->email2 = $this->input->post('email2');
        $objeto->telefone2 = $this->input->post('telefone2');
        $objeto->rg = $this->input->post('rg');
        $objeto->cpf = $this->input->post('cpf');
        $objeto->endereco = $this->input->post('endereco');
        $objeto->numero = $this->input->post('numero');
        $objeto->complemento = $this->input->post('complemento');
        $objeto->estado = $this->input->post('estado');
        $objeto->uf = $this->input->post('uf');
        $objeto->bairro = $this->input->post('bairro');
        $objeto->cidade = $this->input->post('cidade');
        $objeto->cep = $this->input->post('cep');
        $objeto->observacao = $this->input->post('observacao');
        $objeto->razao_social = $this->input->post('razao_social');
        $objeto->cnpj = $this->input->post('cnpj');
        $objeto->ie = $this->input->post('ie');
        $objeto->im = $this->input->post('im');
        return $objeto;
    }

    private function validar_formulario($update = false) {
        $data = array();
        $data['status'] = TRUE;
        if($update && !empty($this->input->post('id'))){
            $object = $this->Cliente_m->get_by_id($this->input->post('id'));
            ($this->input->post('email') != $object->email) ? $is_unique_email =  '|is_unique[cliente.email]' : $is_unique_email =  '';
            ($this->input->post('email2') != $object->email2) ? $is_unique_email2 =  '|is_unique[cliente.email2]' : $is_unique_email2 =  '';
            ($this->input->post('cpf') != $object->cpf) ? $is_unique_cpf =  '|is_unique[cliente.cpf]' : $is_unique_cpf =  ''; 
            ($this->input->post('cnpj') != $object->cnpj) ? $is_unique_cnpj =  '|is_unique[cliente.cnpj]' : $is_unique_cnpj =  ''; 
        }else{
            $is_unique_email =  '|is_unique[cliente.email]';
            $is_unique_email2 =  '|is_unique[cliente.email2]';
            $is_unique_cpf =  '|is_unique[cliente.cpf]';
            $is_unique_cnpj =  '|is_unique[cliente.cnpj]';
        }
        if($this->input->post('pessoa_tipo') == 'juridica'){
            $required = '|required';
        }else{
            $required = '';
        }
        //Dados do cliente
        $this->form_validation->set_rules('pessoa_tipo', 'Pessoa', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required|max_length[50]');
        $this->form_validation->set_message('is_unique','Já exixte um cadastro com este valor.');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email'.$is_unique_email);
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|max_length[15]');
        //Contato 2
        $this->form_validation->set_rules('nome2', 'Nome2', 'trim');
        $this->form_validation->set_rules('sobrenome2', 'Sobrenome2', 'trim');
        $this->form_validation->set_rules('email2', 'Email2', 'trim|max_length[100]|valid_email'.$is_unique_email2);
        $this->form_validation->set_rules('telefone2', 'Telefone2', 'trim|max_length[15]');
        //Documentos
        $this->form_validation->set_message('validar_rg','O RG informado é inválido');
        $this->form_validation->set_rules('rg', 'RG', 'trim|validar_rg');
        $this->form_validation->set_message('validar_cpf','O CPF informado é inválido');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|validar_cpf'.$is_unique_cpf);
        //Endereço
        $this->form_validation->set_rules('endereco', 'Endereco', 'trim|max_length[50]');
        $this->form_validation->set_rules('numero', 'Número', 'trim');
        $this->form_validation->set_rules('complemento', 'Complemento', 'trim|max_length[100]');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|max_length[50]');
        $this->form_validation->set_rules('uf', 'UF', 'trim|max_length[2]');
        $this->form_validation->set_rules('bairro', 'Bairro', 'trim|max_length[50]');
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|max_length[50]');
        $this->form_validation->set_rules('cep', 'CEP', 'trim');
        $this->form_validation->set_rules('observacao', 'Observação', 'trim');
        //Dados da empresa
        $this->form_validation->set_rules('razao_social', 'Razao Social', 'trim|max_length[150]'.$required);
        $this->form_validation->set_message('validar_cnpj','O CNPJ informado é inválido');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|max_length[18]|validar_cnpj'.$is_unique_cnpj);
        $this->form_validation->set_rules('ie', 'I.E', 'trim|max_length[30]');
        $this->form_validation->set_rules('im', 'I.M', 'trim|max_length[30]');


        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}
