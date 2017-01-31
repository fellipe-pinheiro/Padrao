<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_catalogo_m');
        $this->load->model('Papel_dimensao_m');
        init_layout();
        set_layout('titulo', 'Papel', FALSE);
        restrito_logado();
    }

    public function index() {
        $data["papel_linha"] = $this->Papel_linha_m->get_list();
        $data["papel_dimensao"] = $this->Papel_dimensao_m->get_list();
        $data['papel_catalogo'] = $this->Papel_catalogo_m->get_list();
        set_layout('conteudo', load_content('papel/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Papel_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->p_nome,
                'descricao' => $item->p_descricao,
                'papel_linha' => $item->pl_nome,
                'pd_altura' => $item->pd_altura,
                'pd_largura' => $item->pd_largura,
                'papel_catalogo' => $item->pc_nome,
                'valor_80g' => $item->pl_valor_80g,
                'valor_120g' => $item->pl_valor_120g,
                'valor_180g' => $item->pl_valor_180g,
                'valor_250g' => $item->pl_valor_250g,
                'valor_300g' => $item->pl_valor_300g,
                'valor_350g' => $item->pl_valor_350g,
                'valor_400g' => $item->pl_valor_400g,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_m->count_all(),
            "recordsFiltered" => $this->Papel_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
        exit();
    }

    public function ajax_add() {
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        if ( $this->Papel_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["papel"] = $this->Papel_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();

            if ($this->Papel_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Papel_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Papel_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function _get_post() {
        $objeto = new Papel_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->papel_linha = $this->input->post('papel_linha');
        $objeto->papel_dimensao = $this->input->post('papel_dimensao');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('papel_linha', 'Papel linha', 'trim|required');
        $this->form_validation->set_rules('papel_dimensao', 'Papel dimensão', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}