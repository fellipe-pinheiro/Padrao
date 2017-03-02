<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_dimensao_m');
        $this->load->model('Papel_gramatura_m');
        init_layout();
        set_layout('titulo', 'Papel', FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('papel/lista', ""));
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
                'linha' => $item->linha,
                'papel' => $item->papel,
                'altura' => $item->altura,
                'largura' => $item->largura,
                'gramaturas' => $item->gramaturas,
                'descricao' => $item->descricao,
                'ativo' => $item->ativo,
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
        $dados = $this->get_post();

        $this->db->trans_begin();
        $id_papel = $this->Papel_m->inserir( $dados );
        if ( $id_papel ) {
            $gramaturas = $this->get_array_gramaturas_objects( $id_papel );
            foreach ( $gramaturas as $gramatura ) {
                if( $gramatura['ADD'] ){

                    $this->Papel_gramatura_m->inserir( $gramatura['ADD'] );

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
            $data["papel"] = $this->Papel_m->get_by_id($id);
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
            if ($this->Papel_m->editar($dados)) {
                
                $gramaturas = $this->get_array_gramaturas_objects( $this->input->post('id') );
               
                foreach ($gramaturas as $gramatura) {
                    if ( $gramatura['ADD'] ) { // INSERT

                        $this->Papel_gramatura_m->inserir($gramatura['ADD']);

                    }else if( $gramatura['UPD'] ){ // UPDATE

                        $this->Papel_gramatura_m->editar($gramatura['UPD']);

                    }else if( $gramatura['DEL'] ){ // DELETE

                        $this->Papel_gramatura_m->deletar($gramatura['DEL']['id']);
                        if($this->db->error()['code'] === 1451){
                            $data['db_error_1451'][] = array('msg'=>'Não foi possível excluir a gramatura: ' . $gramatura['DEL']['gramatura'] . ' pois já está sendo utilizada.','name'=>$gramatura['DEL']['name']);
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
        if($this->Papel_gramatura_m->delete_by_papel_id($id)){
            if(!$this->Papel_m->deletar($id)){
                $data["status"] = FALSE;
            }
        }else{
            $data["status"] = FALSE;
            if($this->db->error()['code'] === 1451){
                $data['db_error_1451'] = array('msg'=>'Não foi possível excluir o papel ID: ' . $id . ' pois já esta sendo utilizado.');
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
            'papel_linha' => $this->input->post('papel_linha'),
            'nome' => $this->input->post('nome'),
            'papel_dimensao' => $this->input->post('papel_dimensao'),
            'descricao' => $this->input->post('descricao'),
            'ativo' => empty($this->input->post('ativo')) ? 0 : $this->input->post('ativo')
        );
        return $dados;
    }

    public function ajax_get_personalizado($id_papel_linha){
        $arr = array();
        $arr = $this->Papel_m->get_pesonalizado($id_papel_linha,"id, nome");
        print json_encode($arr);
    }

    public function ajax_get_personalizado_gramatura($id_papel){
        $arr = array();
        $arr = $this->Papel_gramatura_m->get_pesonalizado($id_papel,"id, gramatura");
        print json_encode($arr);
    }

    private function get_array_gramaturas_objects($id_papel) {

        $arr_gramaturas = $this->get_array_inputs_gramaturas("/gramatura_/",$this->input->post());

        $dados_lista = array();
        foreach ($arr_gramaturas as $key => $value) {
            $dados = array(
            'id' => $value['id'],
            'papel' => $id_papel,
            'gramatura' => $value['gramatura'],
            'valor' => decimal_to_db($value['valor']),
            'ativo' => empty($value['ativo']) ? 0 : $value['ativo'],
            );
            if($value['action'] === "ADD"){
                $dados_lista[]['ADD'] = $dados;
            }else if($value['action'] === "UPD"){
                $dados_lista[]['UPD'] = $dados;
            }else if($value['action'] === "DEL"){
                $dados['name'] = $value['name'];
                $dados_lista[]['DEL'] = $dados;
            }
        }
        return $dados_lista;
    }

    private function get_array_inputs_gramaturas( $pattern, $input, $flag = 0 ){//Retorna um array com as chaves: id, gramatura, valor e seus respectivos valores 
        $names = preg_grep( $pattern, array_keys( $input ), $flag);
        $arr_gramaturas = array();
        foreach ( $names as $name ){  
            list( $prefix, $id, $action ) = explode("_",$name);
            switch ($action) {
                case 'ADD':
                    $arr =  array("action"=>"ADD","id"=>null,"gramatura"=>$input[$name],"valor"=>decimal_to_db($input["valor_".$id."_ADD"]),"ativo"=>$input["ativo_".$id."_ADD"]);
                    break;
                case 'UPD':
                    $arr = array("action"=>"UPD","id"=>$id,"gramatura"=>$input[$name],"valor"=>decimal_to_db($input["valor_".$id."_UPD"]),"ativo"=>$input["ativo_".$id."_UPD"]);
                    break;
                case 'DEL':
                    $arr = array("action"=>"DEL","id"=>$id,"gramatura"=>$input[$name],"valor"=>null,"ativo"=>$input["ativo_".$id."_DEL"],"name"=>$name);
                    break;
                
                default:
                    $arr = null;
                    break;
            }
            if(!empty($arr)){
                $arr_gramaturas[] = $arr;
            }
        }

        return $arr_gramaturas;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;
        $names_gramatura = preg_grep( "/gramatura_/", array_keys( $this->input->post() ), 0);
        $names_valor = preg_grep( "/valor_/", array_keys( $this->input->post() ), 0);
        foreach ($names_gramatura as $name) {
            $this->form_validation->set_rules($name, 'Gramatura', 'trim|required|is_natural_no_zero');    
        }
        $this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
        foreach ($names_valor as $name) {
            $this->form_validation->set_rules($name, 'Valor', 'trim|required|decimal_positive');    
        }
        $this->form_validation->set_rules('papel_linha', 'Linha', 'trim|required');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('papel_dimensao', 'Dimensão', 'trim|required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim');
        $this->form_validation->set_message('validar_boolean', 'O Papel ativo deve ser um valor entre 0 e 1');
        $this->form_validation->set_rules('ativo', 'Papel ativo', 'trim|validar_boolean');

        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
}