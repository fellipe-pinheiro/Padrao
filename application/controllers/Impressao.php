<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Impressao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Impressao_m');
        $this->load->model('Impressao_area_m');
        init_layout();
        set_layout('titulo', 'Impressão', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['impressao_area'] = $this->Impressao_area_m->get_list();
        set_layout('conteudo', load_content('impressao/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Impressao_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->i_id,
                'id' => $item->i_id,
                'nome' => $item->i_nome,
                'impressao_area' => $item->ia_nome,
                'valor' => $item->i_valor,
                'descricao' => $item->i_descricao,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Impressao_m->count_all(),
            "recordsFiltered" => $this->Impressao_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
        exit();
    }

    public function ajax_add() {
        $this->validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->get_post();
        if ( $this->Impressao_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["impressao"] = $this->Impressao_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->get_post();

            if ($this->Impressao_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Impressao_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Impressao_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function get_post() {
        $objeto = new Impressao_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->impressao_area = $this->input->post('impressao_area');
        $objeto->descricao = $this->input->post('descricao');
        $objeto->valor = $this->input->post('valor');
        return $objeto;
    }

    public function ajax_get_personalizado($id_area){
        $arr = array();
        $arr = $this->Impressao_m->get_pesonalizado($id_area,"id, nome");
        print json_encode($arr);
    }

    private function validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('impressao_area', 'Impressao área', 'trim|required');
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