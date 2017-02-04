<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_dimensao_m');
        init_layout();
        set_layout('titulo', 'Papel', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['papel_linha'] = $this->Papel_linha_m->get_list();
        $data['papel_dimensao'] = $this->Papel_dimensao_m->get_list();
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
                'p_nome' => $item->p_nome,
                'pl_nome' => $item->pl_nome,
                'pd_altura' => $item->pd_altura,
                'pd_largura' => $item->pd_largura,
                'p_valor_80g' => $item->p_valor_80g,
                'p_valor_120g' => $item->p_valor_120g,
                'p_valor_180g' => $item->p_valor_180g,
                'p_valor_250g' => $item->p_valor_250g,
                'p_valor_300g' => $item->p_valor_300g,
                'p_valor_350g' => $item->p_valor_350g,
                'p_valor_400g' => $item->p_valor_400g,
                'p_descricao' => $item->p_descricao
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_m->count_all(),
            "recordsFiltered" => $this->Papel_m->count_filtered(),
            "data" => $data,
            "sql"=>$this->db->last_query()
            );
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $objeto = $this->get_post();
        if ( $this->Papel_m->inserir($objeto)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = TRUE;
        $data["papel"] = $this->Papel_m->get_by_id($id);
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $data["status"] = TRUE;
        $this->validar_formulario();
        if ( $this->input->post('id') ) {
            $objeto = $this->get_post();
            if (!$this->Papel_m->editar($objeto)) {
                $data["status"] = FALSE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = TRUE;
        if(!$this->Papel_m->deletar($id)){
            $data["status"] = FALSE;
        }
        print json_encode($data);
    }

    private function get_post() {
        $objeto = new Papel_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->papel_linha = $this->input->post('papel_linha');
        $objeto->nome = $this->input->post('nome');
        $objeto->papel_dimensao = $this->input->post('papel_dimensao');
        $objeto->valor_80g = $this->input->post('valor_80g');
        $objeto->valor_120g = $this->input->post('valor_120g');
        $objeto->valor_180g = $this->input->post('valor_180g');
        $objeto->valor_250g = $this->input->post('valor_250g');
        $objeto->valor_300g = $this->input->post('valor_300g');
        $objeto->valor_350g = $this->input->post('valor_350g');
        $objeto->valor_400g = $this->input->post('valor_400g');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('papel_linha', 'Linha', 'trim|required');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('papel_dimensao', 'Dimensão', 'trim|required');
        $this->form_validation->set_rules('valor_80g', 'valor_80g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_120g', 'valor_120g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_180g', 'valor_180g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_250g', 'valor_250g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_300g', 'valor_300g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_350g', 'valor_350g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('valor_400g', 'valor_400g', 'trim|required|callback_decimal_positive');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

    public function decimal_positive($value){
        if($value < 0){
            $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
            return false;
        }
        return true;
    }
}