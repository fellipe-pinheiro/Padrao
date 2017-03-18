<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personalizado_modelo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Personalizado_modelo_m');
        $this->load->model('Personalizado_categoria_m');
        $this->load->model('Personalizado_modelo_dimensao_m');
        init_layout();
        set_layout('titulo', 'Modelos personalizados', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('personalizado_modelo/lista', ""));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Personalizado_modelo_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->pm_id,
                'id' => $item->pm_id,
                'personalizado_categoria' => $item->pc_nome,
                'nome' => $item->pm_nome,
                'codigo' => $item->pm_codigo,
                'descricao' => $item->pm_descricao,
                'valor' => $item->pm_valor,
                'ativo' => $item->pm_ativo
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Personalizado_modelo_m->count_all(),
            "recordsFiltered" => $this->Personalizado_modelo_m->count_filtered(),
            "data" => $data,
            );
        print json_encode($output);
    }

    public function ajax_add() {
        $this->validar_formulario();
        $data['status'] = FALSE;
        $dados = $this->get_post();
        $this->db->trans_begin();
        $id_modelo = $this->Personalizado_modelo_m->inserir($dados);
        if ( $id_modelo ) {
            $dimensoes = $this->get_array_dimensoes_objects( $id_modelo );

            foreach ( $dimensoes as $dimensao ) {
                if( !empty($dimensao['ADD']) && $dimensao['ADD'] ){

                    $this->Personalizado_modelo_dimensao_m->inserir( $dimensao['ADD'] );

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
            $data["status"] = TRUE;
            $data["personalizado_modelo"] = $this->Personalizado_modelo_m->get_by_id($id);
        }
        print json_encode($data);
    }

    public function ajax_update() {
        $data = array();
        $data["status"] = FALSE;
        $this->validar_formulario(true);
                
        if ( $this->input->post('id') ) {
            $dados = $this->get_post();
            // Inicio Trans
            $this->db->trans_begin();
            if ($this->Personalizado_modelo_m->editar($dados)) {
                
                $dimensoes = $this->get_array_dimensoes_objects( $this->input->post('id') );

                foreach ($dimensoes as $dimensao) {
                    if ( !empty($dimensao['ADD']) && $dimensao['ADD'] ) { // INSERT

                        $this->Personalizado_modelo_dimensao_m->inserir($dimensao['ADD']);

                    }else if( !empty($dimensao['UPD']) && $dimensao['UPD']){ // UPDATE

                        $this->Personalizado_modelo_dimensao_m->editar($dimensao['UPD']);

                    }else if(!empty($dimensao['DEL']) && $dimensao['DEL'] ){ // DELETE

                        $this->Personalizado_modelo_dimensao_m->deletar($dimensao['DEL']['id']);
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
        if($this->Personalizado_modelo_dimensao_m->delete_by_modelo_id($id)){
            if(!$this->Personalizado_modelo_m->deletar($id)){
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

    public function ajax_get_personalizado($id_categoria){
        $arr = array();
        $arr = $this->Personalizado_modelo_m->get_pesonalizado($id_categoria,"id, nome");
        print json_encode($arr);
    }

    private function get_post() {
        $dados = array(
            'id' => empty($this->input->post('id')) ? null:$this->input->post('id'),
            'codigo' => $this->input->post('codigo'),
            'nome' => $this->input->post('nome'),
            'personalizado_categoria' => $this->input->post('personalizado_categoria'),
            'descricao' => $this->input->post('descricao'),
            'valor' => decimal_to_db($this->input->post('valor')),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo')
        );
        return $dados;
    }

    private function get_array_dimensoes_objects($id_modelo) {

        $arr_dimensoes = $this->get_array_inputs_dimensoes("/dimensao_nome/",$this->input->post());

        $dados_lista = array();
        // Dados variaveis
        foreach ($arr_dimensoes as $key => $value) {
            $dados = array(
            'id' => $value['id'],
            'modelo' => $id_modelo,
            'nome' => $value['nome'],
            'altura' => $value['altura'],
            'largura' => $value['largura']
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
                        "altura"=>$input["dimensao_altura_".$id."_ADD"],
                        "largura"=>$input["dimensao_largura_".$id."_ADD"]);

                    break;
                case 'UPD':
                    $arr =  array(
                        "action"=>"UPD",
                        "id"=>$id,
                        "nome"=>$input["dimensao_nome_".$id."_UPD"],
                        "altura"=>$input["dimensao_altura_".$id."_UPD"],
                        "largura"=>$input["dimensao_largura_".$id."_UPD"]);
                    break;
                case 'DEL':
                    $arr =  array(
                        "action"=>"DEL",
                        "id"=>$id,
                        "nome"=>$input["dimensao_nome_".$id."_DEL"],
                        "altura"=>$input["dimensao_altura_".$id."_DEL"],
                        "largura"=>$input["dimensao_largura_".$id."_DEL"],
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

    private function validar_formulario($update = false) {
        $data = array();
        $data['status'] = TRUE;
        if(!empty($this->input->post('id'))){
            $object = $this->Personalizado_modelo_m->get_by_id($this->input->post('id'));
            if($this->input->post('codigo') != $object->codigo){
                $is_unique =  '|is_unique[personalizado_modelo.codigo]';
            }else{
                $is_unique =  '';
            }   
        }else{
            $is_unique =  '|is_unique[personalizado_modelo.codigo]';
        }
        $names_nome = preg_grep( "/dimensao_nome_/", array_keys( $this->input->post() ), 0);
        $names_altura = preg_grep( "/dimensao_altura_/", array_keys( $this->input->post() ), 0);
        $names_largura = preg_grep( "/dimensao_largura_/", array_keys( $this->input->post() ), 0);
        foreach ($names_nome as $name) {
            $this->form_validation->set_rules($name, 'Nome', 'trim|required|max_length[50]');  
        }
        foreach ($names_altura as $altura) {
            $this->form_validation->set_rules($altura, 'Altura', 'trim|required|max_length[5]|is_natural');    
        }
        foreach ($names_largura as $largura) {
            $this->form_validation->set_rules($largura, 'Largura', 'trim|required|max_length[5]|is_natural');    
        }
        $this->form_validation->set_message('is_unique','Já exixte um campo com este código. Dados duplicados não são permitidos.');

        $this->form_validation->set_message('check_white_spaces', 'O código não deve ser uma palavra composta');
        $this->form_validation->set_rules('codigo', 'Código', 'trim|required|min_length[3]|max_length[20]|alpha_numeric_spaces|strtolower|check_white_spaces'.$is_unique);
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('personalizado_categoria', 'Categoria', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        $this->form_validation->set_rules('valor', 'Valor', 'trim|required|decimal_positive');
        $this->form_validation->set_message('validar_boolean', 'O Modelo ativo deve ser um valor entre 0 e 1');
        $this->form_validation->set_rules('ativo', 'Modelo ativo', 'trim|validar_boolean');
        
        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}