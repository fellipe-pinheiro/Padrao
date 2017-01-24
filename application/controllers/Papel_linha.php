<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_linha extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_catalogo_m');
        init_layout();
        set_layout('titulo', 'Papel linha', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['titulo_painel'] = 'Linha de papéis';
        $data['papel_catalogo'] = $this->Papel_catalogo_m->get_list();
        set_layout('conteudo', load_content('papel_linha/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Papel_linha_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->pl_nome,
                'papel_catalogo' => $item->pc_nome,
                'valor_80g' => $item->pl_valor_80g,
                'valor_120g' => $item->pl_valor_120g,
                'valor_180g' => $item->pl_valor_180g,
                'valor_250g' => $item->pl_valor_250g,
                'valor_300g' => $item->pl_valor_300g,
                'valor_350g' => $item->pl_valor_350g,
                'valor_400g' => $item->pl_valor_400g,
                'descricao' => $item->pl_descricao,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_linha_m->count_all(),
            "recordsFiltered" => $this->Papel_linha_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        if ( $this->Papel_linha_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["papel_linha"] = $this->Papel_linha_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();

            if ($this->Papel_linha_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Papel_linha_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Papel_linha_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function _get_post() {
        $objeto = new Papel_linha_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->papel_catalogo = $this->input->post('papel_catalogo');
        $objeto->descricao = $this->input->post('descricao');
        $objeto->valor_80g = $this->input->post('valor_80g');
        $objeto->valor_120g = $this->input->post('valor_120g');
        $objeto->valor_180g = $this->input->post('valor_180g');
        $objeto->valor_250g = $this->input->post('valor_250g');
        $objeto->valor_300g = $this->input->post('valor_300g');
        $objeto->valor_350g = $this->input->post('valor_350g');
        $objeto->valor_400g = $this->input->post('valor_400g');
        return $objeto;
    }

    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('papel_catalogo', 'Papel catalogo', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('valor_80g', 'valor_80g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_120g', 'valor_120g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_180g', 'valor_180g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_250g', 'valor_250g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_300g', 'valor_300g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_350g', 'valor_350g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_400g', 'valor_400g', 'trim|required|callback_decimal_positive');

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