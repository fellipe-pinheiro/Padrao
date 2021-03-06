<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Orcamento_m');
        $this->load->model('Produto_m');
        $this->load->model('Produto_categoria_m');
        $this->load->model('Container_produto_m');
        $this->load->model('Assessor_m');
        init_layout();
        set_layout('titulo', 'Produto', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['categorias'] = $this->Produto_categoria_m->get_pesonalizado("id, nome");
        set_layout('conteudo', load_content('produto/lista', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Produto_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->p_id,
                'id' => $item->p_id,
                'nome' => $item->p_nome,
                'qtd_minima' => $item->p_qtd_minima,
                'produto_categoria' => $item->pc_nome,
                'valor' => $item->p_valor,
                'descricao' => $item->p_descricao,
                'ativo' => $item->p_ativo,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Produto_m->count_all(),
            "recordsFiltered" => $this->Produto_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
        exit();
    }

    public function ajax_add() {
        $this->validar_formulario();
        $data['status'] = FALSE;
        $dados = $this->get_post();
        if ( $this->Produto_m->inserir($dados)) {
            $data['status'] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["status"] = TRUE;
            $data["produto"] = $this->Produto_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = FALSE;
        $this->validar_formulario();
        if ($this->input->post('id')) {
            $dados = $this->get_post();
            if ($this->Produto_m->editar($dados)) {
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id){
        $data["status"] = FALSE;
        if(!empty($id)){
            if($this->Produto_m->deletar($id)){
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_get_personalizado($id_categoria){
        $arr = array();
        $arr = $this->Produto_m->get_pesonalizado($id_categoria,"id, nome, qtd_minima");
        print json_encode($arr);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'nome' => $this->input->post('nome'),
            'qtd_minima' => $this->input->post('qtd_minima'),
            'produto_categoria' => $this->input->post('produto_categoria'),
            'descricao' => $this->input->post('descricao'),
            'valor' => decimal_to_db($this->input->post('valor')),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo'),
            );
        return $dados;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('qtd_minima', 'Quantidade mínima', 'trim|required|numeric|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('produto_categoria', 'Produto categoria', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
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
    
    public function session_produto_inserir(){
        $data["status"] = FALSE;
        $this->validar_formulario_session_produto();
        $this->session->orcamento->produto[] = $this->set_produto();
        $data["status"] = TRUE;
        print json_encode($data);
    }

    public function session_produto_editar(){
        $data["status"] = FALSE;
        $this->validar_formulario_session_produto();
        $posicao = $this->uri->segment(3);
        $this->session->orcamento->produto[$posicao] = $this->set_produto();
        $data["status"] = TRUE;
        print json_encode($data);
    }

    public function session_produto_excluir(){
        $data["status"] = TRUE;
        $posicao = $this->uri->segment(3);
        unset($this->session->orcamento->produto[$posicao]);
        print json_encode($data);
    }

    private function set_produto(){
        $comissao = 0;
        if(!empty($this->session->orcamento->assessor->comissao)){
            $comissao = $this->session->orcamento->assessor->comissao;
        }
        $produto = $this->Container_produto_m->get_produto($this->input->post('produto'),$this->input->post('quantidade'),$this->input->post('descricao'),$comissao);
        return $produto;
    }

    private function validar_formulario_session_produto(){
        $data = array();
        $data['status'] = TRUE;
        
        $this->form_validation->set_rules('produto', 'Produto', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}