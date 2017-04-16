<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Laser_m');
        init_layout();
        set_layout('titulo', 'Laser', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('laser/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Laser_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'nome' => $item->nome,
                'qtd_minima' => $item->qtd_minima,
                'descricao' => $item->descricao,
                'valor' => $item->valor,
                'ativo' => $item->ativo,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Laser_m->count_all(),
            "recordsFiltered" => $this->Laser_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $dados = $this->get_post();
        if ( $this->Laser_m->inserir($dados)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["laser"] = $this->Laser_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $dados = $this->get_post();
            if ($this->Laser_m->editar($dados)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Laser_m->deletar($id)){
            $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Laser_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'nome' => $this->input->post('nome'),
            'qtd_minima' => $this->input->post('qtd_minima'),
            'descricao' => $this->input->post('descricao'),
            'valor' => decimal_to_db($this->input->post('valor')),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo'),
        );
        return $dados;
    }

    private function validar_formulario() {
        $data['status'] = TRUE;

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('qtd_minima', 'Quantidade mínima', 'trim|required|numeric|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required|decimal_positive');
        $this->form_validation->set_message('validar_boolean', 'O Ativo deve ser um valor entre 0 e 1');
        $this->form_validation->set_rules('ativo', 'Ativo', 'trim|validar_boolean');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}