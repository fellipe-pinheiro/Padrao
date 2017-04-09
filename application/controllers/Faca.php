<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faca extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Faca_m');
        $this->load->model('Faca_dimensao_m');
        init_layout();
        set_layout('titulo', 'Faca', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('faca/lista', ''));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Faca_m->get_datatables();
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
                'ativo' => $item->ativo,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Faca_m->count_all(),
            "recordsFiltered" => $this->Faca_m->count_filtered(),
            "data" => $data,
            "query" => $this->db->last_query(),
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $data['status'] = FALSE;
        $this->validar_formulario();
        $dados = $this->get_post();
        $this->db->trans_begin();
            $id_faca = $this->Faca_m->inserir($dados);

            if ( $id_faca ) {
                $dimensoes = $this->get_array_dimensoes_objects( $id_faca );

                foreach ( $dimensoes as $dimensao ) {
                    if( !empty($dimensao['ADD']) && $dimensao['ADD'] ){

                        $this->Faca_dimensao_m->inserir( $dimensao['ADD'] );

                    }else if(!empty($dimensao['DEFAULT']) &&  $dimensao['DEFAULT'] ){
                
                        $this->Faca_dimensao_m->inserir( $dimensao['DEFAULT'] );

                    }
                }
                $data['status'] = TRUE;
            }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = FALSE;
        if(!empty($id)){
            $data["faca"] = $this->Faca_m->get_by_id($id);
            $data["status"] = TRUE;
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data = array();
        $data["status"] = FALSE;
        $this->validar_formulario();
                
        if ( $this->input->post('id') ) {
            $dados = $this->get_post();
            // Inicio Trans
            $this->db->trans_begin();
            if ($this->Faca_m->editar($dados)) {
                
                $dimensoes = $this->get_array_dimensoes_objects( $this->input->post('id') );

                foreach ($dimensoes as $dimensao) {
                    if ( !empty($dimensao['ADD']) && $dimensao['ADD'] ) { // INSERT

                        $this->Faca_dimensao_m->inserir($dimensao['ADD']);

                    }else if( !empty($dimensao['UPD']) && $dimensao['UPD']){ // UPDATE

                        $this->Faca_dimensao_m->editar($dimensao['UPD']);

                    }else if( !empty($dimensao['DEFAULT']) && $dimensao['DEFAULT']){ // DEFAULT
                        
                        $this->Faca_dimensao_m->editar($dimensao['DEFAULT']);

                    }else if(!empty($dimensao['DEL']) && $dimensao['DEL'] ){ // DELETE

                        $this->Faca_dimensao_m->deletar($dimensao['DEL']['id']);
                        if($this->db->error()['code'] === 1451){
                            $data['db_error_1451'][] = array('msg'=>'Não foi possível excluir a dimensão: ' . $dimensao['DEL']['nome'] . ' pois já está sendo utilizada.','name'=>$dimensao['DEL']['name']);
                            $this->db->trans_rollback();
                            $data['status'] = FALSE;
                            print json_encode($data);
                            exit();
                        }

                    }
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $data['status'] = FALSE;
            } else {
                $this->db->trans_commit();
                $data["status"] = TRUE;
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = TRUE;
        $this->db->trans_begin();
        if($this->Faca_dimensao_m->delete_by_modelo_id($id)){
            if(!$this->Faca_m->deletar($id)){
                $data["status"] = FALSE;
            }
        }else{
            $data["status"] = FALSE;
            if($this->db->error()['code'] === 1451){
                $data['db_error_1451'] = array('msg'=>'Não foi possível excluir o modelo ID: ' . $id . ' pois já esta sendo utilizado.');
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'nome' => $this->input->post('nome'),
            'qtd_minima' => $this->input->post('qtd_minima'),
            'descricao' => $this->input->post('descricao'),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo'),
            );
        return $dados;
    }

    private function get_array_dimensoes_objects($id_faca) {

        $arr_dimensoes = $this->get_array_inputs_dimensoes("/dimensao_nome/",$this->input->post());

        $dados_lista = array();

        foreach ($arr_dimensoes as $key => $value) {
            $dados = array(
            'id' => $value['id'],
            'faca' => $id_faca,
            'nome' => $value['nome'],
            'valor_servico' => $value['valor_servico'],
            'valor_faca' => $value['valor_faca']
            );
            switch ($value['action']) {
                case "ADD":
                    $dados_lista[]['ADD'] = $dados;
                    break;
                case "UPD":
                    $dados_lista[]['UPD'] = $dados;
                    break;
                case "DEL":
                    $dados['name'] = $value['name'];
                    $dados_lista[]['DEL'] = $dados;
                    break;
            }
        }
        return $dados_lista;
    }

    private function get_array_inputs_dimensoes( $pattern, $input, $flag = 0 ){//Retorna um array com as chaves: id, nome, valor e seus respectivos valores 
        $names = preg_grep( $pattern, array_keys( $input ), $flag);

        $arr_dimesoes = array();
        foreach ( $names as $name){  
            list( $prefix, $dimensao, $id, $action ) = explode("_",$name);
            switch ($action) {
                case 'ADD':
                    $arr =  array(
                        "action"=>"ADD",
                        "id"=>null,
                        "nome"=>$input["dimensao_nome_".$id."_ADD"],
                        "valor_servico"=>$input["dimensao_valorServico_".$id."_ADD"],
                        "valor_faca"=>$input["dimensao_valorFaca_".$id."_ADD"]);

                    break;
                case 'UPD':
                    $arr =  array(
                        "action"=>"UPD",
                        "id"=>$id,
                        "nome"=>$input["dimensao_nome_".$id."_UPD"],
                        "valor_servico"=>$input["dimensao_valorServico_".$id."_UPD"],
                        "valor_faca"=>$input["dimensao_valorFaca_".$id."_UPD"]);
                    break;
                case 'DEL':
                    $arr =  array(
                        "action"=>"DEL",
                        "id"=>$id,
                        "nome"=>$input["dimensao_nome_".$id."_DEL"],
                        "valor_servico"=>$input["dimensao_valorServico_".$id."_DEL"],
                        "valor_faca"=>$input["dimensao_valorFaca_".$id."_DEL"],
                        "name"=>$name);
                    break;
                
                default:
                    $arr = null;
                    break;
            }
            if(!empty($arr)){
                $arr_dimesoes[] = $arr;
            }
        }

        return $arr_dimesoes;
    }

    public function ajax_get_personalizado(){
        $arr = array();
        $arr = $this->Faca_m->get_pesonalizado("id, nome");
        print json_encode($arr);
    }

    public function ajax_get_personalizado_faca_dimensao($id_faca){
        $arr = array();
        $arr = $this->Faca_dimensao_m->get_pesonalizado($id_faca,"id, nome");
        print json_encode($arr);
    }

    private function validar_formulario($update = false) {
        $data = array();
        $data['status'] = TRUE;
        $names_nome = preg_grep( "/dimensao_nome_/", array_keys( $this->input->post() ), 0);
        $names_valor_servico = preg_grep( "/dimensao_valorServico_/", array_keys( $this->input->post() ), 0);
        $names_valor_faca = preg_grep( "/dimensao_valorFaca_/", array_keys( $this->input->post() ), 0);
        foreach ($names_nome as $name) {
            $this->form_validation->set_rules($name, 'Nome', 'trim|required|max_length[50]');  
        }
        foreach ($names_valor_servico as $valor_servico) {
            $this->form_validation->set_rules($valor_servico, 'Valor do serviço', 'trim|required|decimal_positive');    
        }
        foreach ($names_valor_faca as $valor_faca) {
            $this->form_validation->set_rules($valor_faca, 'Valor da faca', 'trim|required|decimal_positive');    
        }
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('qtd_minima', 'Quantidade mínima', 'trim|required|numeric|is_natural_no_zero|no_leading_zeroes');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('validar_boolean', 'O Faca ativo deve ser um valor entre 0 e 1');
        $this->form_validation->set_rules('ativo', 'Faca ativo', 'trim|validar_boolean');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }

}