<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convite_modelo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Convite_modelo_m');
        init_layout();
        set_layout('titulo', 'Modelo de Convites', FALSE);
        restrito_logado();
    }

    public function index() {
        $data = null;
        set_layout('conteudo', load_content('convite_modelo/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Convite_modelo_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'codigo' => $item->codigo,
                'altura_final' => $item->altura_final,
                'largura_final' => $item->largura_final,
                'cartao_altura' => $item->cartao_altura,
                'cartao_largura' => $item->cartao_largura,
                'envelope_altura' => $item->envelope_altura,
                'envelope_largura' => $item->envelope_largura,
                'empastamento_borda' => $item->empastamento_borda,
                'descricao' => $item->descricao,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Convite_modelo_m->count_all(),
            "recordsFiltered" => $this->Convite_modelo_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $objeto = $this->get_post();
        if ( $this->Convite_modelo_m->inserir($objeto)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if($id){
            $data["convite_modelo"] = $this->Convite_modelo_m->get_by_id($id);
            $data["status"] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $this->validar_formulario(true);
        if ($this->input->post('id')) {
            $objeto = $this->get_post();
            if ($this->Convite_modelo_m->editar($objeto)) {
                $data["status"] = TRUE;
            }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $this->Convite_modelo_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function get_post() {
        $objeto = new Convite_modelo_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->codigo = $this->input->post('codigo');
        $objeto->nome = $this->input->post('nome');
        $objeto->altura_final = $this->input->post('altura_final');
        $objeto->largura_final = $this->input->post('largura_final');
        $objeto->cartao_altura = $this->input->post('cartao_altura');
        $objeto->cartao_largura = $this->input->post('cartao_largura');
        $objeto->envelope_altura = $this->input->post('envelope_altura');
        $objeto->envelope_largura = $this->input->post('envelope_largura');
        $objeto->empastamento_borda = $this->input->post('empastamento_borda');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Convite_modelo_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function validar_formulario($update) {
        $data = array();
        $data['status'] = TRUE;
        if($update && !empty($this->input->post('id'))){
            $object = $this->Convite_modelo_m->get_by_id($this->input->post('id'));
            if($this->input->post('codigo') != $object->codigo){
                $is_unique =  '|is_unique[convite_modelo.codigo]';
            }else{
                $is_unique =  '';
            }   
        }else{
            $is_unique =  '|is_unique[convite_modelo.codigo]';
        }
        $this->form_validation->set_message('is_unique','Já exixte um campo com este nome. Dados duplicados não são permitidos.');
        $this->form_validation->set_message('check_white_spaces', 'O código não pode ser uma palavra composta');
        $this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[20]|alpha_numeric_spaces|strtolower|callback_check_white_spaces'.$is_unique);
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('altura_final', 'Altura final', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('largura_final', 'Largura final', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('cartao_altura', 'Cartao altura', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('cartao_largura', 'Cartao largura', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('envelope_altura', 'Envelope altura', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('envelope_largura', 'Envelopelargura', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('empastamento_borda', 'Empastamento borda', 'trim|required|max_length[5]|is_natural');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

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