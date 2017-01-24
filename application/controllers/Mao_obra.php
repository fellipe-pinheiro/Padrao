<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mao_obra extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mao_obra_m');
        init_layout();
        set_layout('titulo', 'Mão de obra', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['titulo_painel'] = 'Mão de obra';
        set_layout('conteudo', load_content('mao_obra/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Mao_obra_m->get_datatables();
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
            "recordsTotal" => $this->Mao_obra_m->count_all(),
            "recordsFiltered" => $this->Mao_obra_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        if ( $this->Mao_obra_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["mao_obra"] = $this->Mao_obra_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();

            if ($this->Mao_obra_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Mao_obra_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Mao_obra_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function _get_post() {
        $objeto = new Mao_obra_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->descricao = $this->input->post('descricao');
        $objeto->valor = $this->input->post('valor');
        return $objeto;
    }

    private function _validar_formulario($action) {
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