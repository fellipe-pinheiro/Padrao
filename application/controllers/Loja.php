<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loja extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Loja_m');
        init_layout();
        set_layout('titulo', 'Loja', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['estados'] = get_array_estados();
        $data['estados_json'] = json_encode(get_array_estados());
        set_layout('conteudo', load_content('loja/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Loja_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'unidade' => $item->unidade,
                'razao_social' => $item->razao_social,
                'cnpj' => $item->cnpj,
                'ie' => $item->ie,
                'im' => $item->im,
                'telefone' => $item->telefone,
                'telefone2' => $item->telefone2,
                'telefone3' => $item->telefone3,
                'email' => $item->email,
                'endereco' => $item->endereco,
                'numero' => $item->numero,
                'complemento' => $item->complemento,
                'estado' => $item->estado,
                'bairro' => $item->bairro,
                'cidade' => $item->cidade,
                'cep' => $item->cep,
                'uf' => $item->uf,
                'ativo' => $item->ativo,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Loja_m->count_all(),
            "recordsFiltered" => $this->Loja_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $dados = $this->get_post();
        if ( $this->Loja_m->inserir($dados) ) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["loja"] = $this->Loja_m->get_by_id($id);
            $data["status"] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario(true);
        if ($this->input->post('id')) {
            $dados = $this->get_post();
            if ($this->Loja_m->editar($dados)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Loja_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'unidade' => $this->input->post('unidade'),
            'razao_social' => $this->input->post('razao_social'),
            'cnpj' => $this->input->post('cnpj'),
            'ie' => $this->input->post('ie'),
            'im' => $this->input->post('im'),
            'telefone' => $this->input->post('telefone'),
            'telefone2' => $this->input->post('telefone2'),
            'telefone3' => $this->input->post('telefone3'),
            'email' => $this->input->post('email'),
            'endereco' => $this->input->post('endereco'),
            'numero' => $this->input->post('numero'),
            'complemento' => $this->input->post('complemento'),
            'estado' => $this->input->post('estado'),
            'bairro' => $this->input->post('bairro'),
            'cidade' => $this->input->post('cidade'),
            'cep' => $this->input->post('cep'),
            'uf' => $this->input->post('uf'),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo'),
            );
        return $dados;
    }

    private function validar_formulario($update = false) {
        $data = array();
        $data['status'] = TRUE;
        if($update && !empty($this->input->post('id'))){
            $object = $this->Loja_m->get_by_id($this->input->post('id'));
            if($this->input->post('unidade') != $object->unidade){
                $is_unique =  '|is_unique[loja.unidade]';
            }else{
                $is_unique =  '';
            }  
        }else{
            $is_unique =  '|is_unique[loja.unidade]';
        }

        $this->form_validation->set_message('is_unique','Este campo já exite na tabela.');
        $this->form_validation->set_rules('unidade', 'Unidade', 'trim|required|max_length[50]'.$is_unique);
        $this->form_validation->set_rules('razao_social', 'Razao Social', 'trim|required|max_length[150]');
        $this->form_validation->set_message('validar_cnpj','O CNPJ informado é inválido');
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|max_length[18]|validar_cnpj');
        $this->form_validation->set_rules('ie', 'I.E', 'trim|max_length[30]');
        $this->form_validation->set_rules('im', 'I.M', 'trim|max_length[30]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('telefone2', 'Telefone2', 'trim|max_length[15]');
        $this->form_validation->set_rules('telefone3', 'Telefone3', 'trim|max_length[15]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
        $this->form_validation->set_rules('endereco', 'Endereço', 'trim|max_length[100]');
        $this->form_validation->set_rules('numero', 'Número', 'trim|max_length[10]');
        $this->form_validation->set_rules('complemento', 'Complemento', 'trim|max_length[100]');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|max_length[50]');
        $this->form_validation->set_rules('uf', 'UF', 'trim|max_length[2]');
        $this->form_validation->set_rules('bairro', 'Bairro', 'trim|max_length[50]');
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|max_length[50]');
        $this->form_validation->set_rules('cep', 'CEP', 'trim');
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