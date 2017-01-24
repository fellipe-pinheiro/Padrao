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
        $data['estados'] = array("AC"=>"Acre", "AL"=>"Alagoas", "AM"=>"Amazonas", "AP"=>"Amapá","BA"=>"Bahia","CE"=>"Ceará","DF"=>"Distrito Federal","ES"=>"Espírito Santo","GO"=>"Goiás","MA"=>"Maranhão","MT"=>"Mato Grosso","MS"=>"Mato Grosso do Sul","MG"=>"Minas Gerais","PA"=>"Pará","PB"=>"Paraíba","PR"=>"Paraná","PE"=>"Pernambuco","PI"=>"Piauí","RJ"=>"Rio de Janeiro","RN"=>"Rio Grande do Norte","RO"=>"Rondônia","RS"=>"Rio Grande do Sul","RR"=>"Roraima","SC"=>"Santa Catarina","SE"=>"Sergipe","SP"=>"São Paulo","TO"=>"Tocantins");
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
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        if ( $this->Loja_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["loja"] = $this->Loja_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();

            if ($this->Loja_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Loja_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Loja_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function _get_post() {
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

    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        if($action == 'update' && !empty($this->input->post('id'))){
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
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|max_length[18]');
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