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
                'linha' => $item->linha,
                'papel' => $item->papel,
                'altura' => $item->altura,
                'largura' => $item->largura,
                'gramaturas' => $item->gramaturas,
                'descricao' => $item->descricao
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
        //$this->validar_formulario();
        $objeto = $this->get_post();
        // Pegar os valordas gramaturas

        //Transaction
        $this->db->trans_begin();
        $id_papel = $this->Papel_m->inserir( $objeto );
        if ( $id_papel ) {
            $gramaturas = $this->get_array_gramaturas_objects( $id_papel );
            foreach ( $gramaturas as $gramatura ) {
                $this->Papel_gramatura_m->inserir( $gramatura );
            }
            $data['status'] = TRUE;
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        //FIM Transaction
        print json_encode($data);
    }

    public function ajax_edit($id) {
        $data["status"] = TRUE;
        $data["papel"] = $this->Papel_m->get_by_id($id);
        print json_encode($data);
    }

    public function ajax_update() {
        $data["status"] = TRUE;
        $this->validar_formulario();
                
        if ( $this->input->post('id') ) {
            $objeto = $this->get_post();
            // Inicio Trans
            $this->db->trans_begin();
            if ($this->Papel_m->editar($objeto)) {
                
                $gramaturas = $this->get_array_gramaturas_objects( $this->input->post('id') );
               
                foreach ($gramaturas as $gramatura) {
                    if (empty($gramatura->id)) {
                        // ADD
                         $this->Papel_gramatura_m->inserir($gramatura);
                    }else{
                        // UPDATE
                         $this->Papel_gramatura_m->editar($gramatura);
                    }
                }
            }
            // fim Trans
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $data['status'] = FALSE;
                $data["msg"] = "Erro ao inserir no banco";
            } else {
                $this->db->trans_commit();
            }
        }
        print json_encode($data);
    }

    public function ajax_delete($id) {
        $data["status"] = TRUE;
        $this->db->trans_begin();
        if(!$this->Papel_m->deletar($id)){
            $data["status"] = FALSE;
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
            $data["msg"] = "Erro ao inserir no banco";
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
    }

    private function get_post() {
        $objeto = new Papel_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->papel_linha = $this->input->post('papel_linha');
        $objeto->nome = $this->input->post('nome');
        $objeto->papel_dimensao = $this->input->post('papel_dimensao');
        $objeto->descricao = $this->input->post('descricao');
        return $objeto;
    }
    private function get_array_gramaturas_objects($id_papel) {
        $arr_gramaturas = $this->get_array_inputs_gramaturas("/gramatura_/",$this->input->post());

        $object_lista = array();
        foreach ($arr_gramaturas as $key => $value) {
            $object = new Papel_gramatura_m();
            $object->id = $value['id'];
            $object->papel = $id_papel;
            $object->gramatura = $value['gramatura'];
            $object->valor = $value['valor'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    private function get_array_inputs_gramaturas( $pattern, $input, $flag = 0 ){//Retorna um array com as chaves: id, gramatura, valor e seus respectivos valores 
        $names = preg_grep( $pattern, array_keys( $input ), $flag);
        $arr_gramaturas = array();
        foreach ( $names as $name ){  
            list( $prefix, $id, $action ) = explode("_",$name);
            switch ($action) {
                case 'ADD':
                    $arr =  array("id"=>null,"gramatura"=>$input[$name],"valor"=>number_to_db($input["valor_".$id."_ADD"]));
                    break;
                case 'UPD':
                    $arr = array("id"=>$id,"gramatura"=>$input[$name],"valor"=>number_to_db($input["valor_".$id."_UPD"]));
                    break;
                case 'DEL':
                    $this->Papel_gramatura_m->deletar($id);
                    break;
                
                default:
                    # code...
                    break;
            }
            $arr_gramaturas[] = $arr;
        }

        return $arr_gramaturas;
    }

    private function validar_formulario() {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('papel_linha', 'Linha', 'trim|required');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('papel_dimensao', 'Dimensão', 'trim|required');
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