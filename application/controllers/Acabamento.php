<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acabamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Acabamento_m');
        init_layout();
        set_layout('titulo', 'Acabamento', FALSE);
        restrito_logado();
    }

    public function index() {
        restrito_logado();
        set_layout('conteudo', load_content('acabamento/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Acabamento_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'descricao' => $item->descricao,
                'valor' => $item->valor,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Acabamento_m->count_all(),
            "recordsFiltered" => $this->Acabamento_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->get_post();
        if ( $this->Acabamento_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["acabamento"] = $this->Acabamento_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->get_post();

            if ($this->Acabamento_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Acabamento_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Acabamento_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Acabamento_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $objeto = new Acabamento_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->descricao = $this->input->post('descricao');
        $objeto->valor = $this->input->post('valor');
        return $objeto;
    }

    private function validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required|callback_decimal_positive');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
    
    public function decimal_positive($value){
        if($value < 0){
            return false;
        }
        return true;
    }
}