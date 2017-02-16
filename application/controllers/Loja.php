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
        $data['titulo_painel'] = 'Lojas';
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
        $objeto = $this->get_post();
        if ( $this->Loja_m->inserir($objeto) ) {
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
            $objeto = $this->get_post();
            if ($this->Loja_m->editar($objeto)) {
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
        $objeto = new Loja_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->unidade = $this->input->post('unidade');
        $objeto->razao_social = $this->input->post('razao_social');
        $objeto->cnpj = $this->input->post('cnpj');
        $objeto->ie = $this->input->post('ie');
        $objeto->im = $this->input->post('im');
        $objeto->telefone = $this->input->post('telefone');
        $objeto->telefone2 = $this->input->post('telefone2');
        $objeto->telefone3 = $this->input->post('telefone3');
        $objeto->email = $this->input->post('email');
        $objeto->endereco = $this->input->post('endereco');
        $objeto->numero = $this->input->post('numero');
        $objeto->complemento = $this->input->post('complemento');
        $objeto->estado = $this->input->post('estado');
        $objeto->bairro = $this->input->post('bairro');
        $objeto->cidade = $this->input->post('cidade');
        $objeto->cep = $this->input->post('cep');
        $objeto->uf = $this->input->post('uf');
        return $objeto;
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
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|max_length[18]|validar_cnpj');
        $this->form_validation->set_rules('ie', 'I.E', 'trim|max_length[30]');
        $this->form_validation->set_rules('im', 'I.M', 'trim|max_length[30]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('telefone2', 'Telefone2', 'trim|max_length[15]');
        $this->form_validation->set_rules('telefone3', 'Telefone3', 'trim|max_length[15]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email');
        $this->form_validation->set_rules('endereco', 'Endereço', 'trim|max_length[50]');
        $this->form_validation->set_rules('numero', 'Número', 'trim');
        $this->form_validation->set_rules('complemento', 'Complemento', 'trim|max_length[100]');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|max_length[50]');
        $this->form_validation->set_rules('uf', 'UF', 'trim|max_length[2]');
        $this->form_validation->set_rules('bairro', 'Bairro', 'trim|max_length[50]');
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|max_length[50]');
        $this->form_validation->set_rules('cep', 'CEP', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}