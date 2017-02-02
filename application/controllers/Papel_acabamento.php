<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_acabamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_acabamento_m');
        init_layout();
        set_layout('titulo', 'Papel acabamento', FALSE);
        restrito_logado();
    }

    public function index() {
        restrito_logado();
        $data['titulo_painel'] = 'Papel acabamento';
        set_layout('conteudo', load_content('papel_acabamento/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Papel_acabamento_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'codigo' => $item->codigo,
                'descricao' => $item->descricao,
                'valor' => $item->valor,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_acabamento_m->count_all(),
            "recordsFiltered" => $this->Papel_acabamento_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario(false);
        $data['status'] = TRUE;
        $objeto = $this->get_post();
        if ( $this->Papel_acabamento_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["papel_acabamento"] = $this->Papel_acabamento_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->validar_formulario(true);
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->get_post();

            if ($this->Papel_acabamento_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Papel_acabamento_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Papel_acabamento_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function get_post() {
        $objeto = new Papel_acabamento_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->codigo = $this->input->post('codigo');
        $objeto->descricao = $this->input->post('descricao');
        $objeto->valor = $this->input->post('valor');
        return $objeto;
    }

    private function validar_formulario($update) {
        $data = array();
        $data['status'] = TRUE;
        if($update && !empty($this->input->post('id'))){
            $object = $this->Papel_acabamento_m->get_by_id($this->input->post('id'));
            if($this->input->post('codigo') != $object->codigo){
                $is_unique =  '|is_unique[papel_acabamento.codigo]';
            }else{
                $is_unique =  '';
            }   
        }else{
            $is_unique =  '|is_unique[papel_acabamento.codigo]';
        }
        //Comentado para não dar erro de validação com o usuário
        
        //$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        //$this->form_validation->set_message('check_white_spaces', 'O código não pode ser uma palavra composta');
        //$this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[30]|strtolower|callback_check_white_spaces'.$is_unique);
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
    public function check_white_spaces($str){
        if(preg_match('/\s/',$str)){
            return false;
        }
        return true;
    }
}