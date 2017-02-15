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
        $data['titulo_painel'] = 'Produtos';
        $data["produto"] = empty($this->Produto_m->get_list())? $data["produto"] = array() : $data["produto"] = $this->Produto_m->get_list();
        $data['produto_categoria'] = $this->Produto_categoria_m->get_list();
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
                'produto_categoria' => $item->pc_nome,
                'valor' => $item->p_valor,
                'descricao' => $item->p_descricao,
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
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        if ( $this->Produto_m->inserir($objeto)) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso'));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }
    public function ajax_edit($id) {
        $data["produto"] = $this->Produto_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }
    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();

            if ($this->Produto_m->editar($objeto)) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso'));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Produto_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }
    public function ajax_delete($id) {
        $this->Produto_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }
    public function ajax_get_personalizado($id_categoria){
        $arr = array();
        $arr = $this->Produto_m->get_pesonalizado($id_categoria,"id, nome");
        print json_encode($arr);
    }
    private function _get_post() {
        $objeto = new Produto_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->nome = $this->input->post('nome');
        $objeto->produto_categoria = $this->input->post('produto_categoria');
        $objeto->descricao = $this->input->post('descricao');
        $objeto->valor = $this->input->post('valor');
        return $objeto;
    }
    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('produto_categoria', 'Produto categoria', 'trim|required');
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
    public function session_produto_inserir(){
        $this->__validar_formulario_produto();
        $this->session->orcamento->produto[] = $this->set_produto();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Produto</strong> inserido com sucesso'));
    }
    public function session_produto_editar(){
        $posicao = $this->uri->segment(3);
        $this->session->orcamento->produto[$posicao] = $this->set_produto();
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Produto</strong> editado com sucesso'));
    }
    public function session_produto_excluir(){
        $posicao = $this->uri->segment(3);
        unset($this->session->orcamento->produto[$posicao]);
        print json_encode(array("status" => TRUE, 'msg' => '<strong>Produto</strong> excluido com sucesso'));
    }
    private function set_produto(){
        $comissao = 0;
        if(!empty($this->session->orcamento->assessor->comissao)){
            $comissao = $this->session->orcamento->assessor->comissao;
        }
        $produto = $this->Container_produto_m->get_produto($this->input->post('produto'),$this->input->post('quantidade'),$this->input->post('descricao'),$comissao);
        return $produto;
    }
    private function __validar_formulario_produto(){
        $data = array();
        $data['status'] = TRUE;
        
        $this->form_validation->set_rules('produto', 'Produto', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required|is_natural_no_zero|callback_no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
    public function no_leading_zeroes($value){
        return preg_replace('/^0+/','', $value);
    }
}