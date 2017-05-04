<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_empastamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_empastamento_m');
        init_layout();
        set_layout('titulo', 'Papel empastamento', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('papel_empastamento/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Papel_empastamento_m->get_datatables();
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
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_empastamento_m->count_all(),
            "recordsFiltered" => $this->Papel_empastamento_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $dados = $this->get_post();
        if ( $this->Papel_empastamento_m->inserir($dados)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["papel_empastamento"] = $this->Papel_empastamento_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario(true);
        if ($this->input->post('id')) {
            $dados = $this->get_post(true);
            if ($this->Papel_empastamento_m->editar($dados)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = FALSE;
        if($this->Papel_empastamento_m->deletar($id)){
            $data["status"] = TRUE;                
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Papel_empastamento_m->get_pesonalizado("id, nome", $this->input->get('ativo'));
        print json_encode($arr);
    }

    private function get_post($update = false) {
        $dados = array(
            'id' => $this->input->post('id'),
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'qtd_minima' => $this->input->post('qtd_minima'),
            'valor' => decimal_to_db($this->input->post('valor'))
        );
        return $dados;
    }

    private function validar_formulario($update = false) {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required|numeric|decimal_positive');
        $this->form_validation->set_rules('qtd_minima', 'Quantidade mínima', 'trim|required|numeric|is_natural_no_zero|no_leading_zeroes');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}