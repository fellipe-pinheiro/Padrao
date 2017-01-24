<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cliente_m');
        $this->load->model('Pedido_m');
        init_layout();
        set_layout('titulo', 'Cliente', FALSE);
        restrito_logado();
    }

    public function index() {
        $data['titulo_painel'] = 'Clientes';
        $data['estados'] = array("AC"=>"Acre", "AL"=>"Alagoas", "AM"=>"Amazonas", "AP"=>"Amapá","BA"=>"Bahia","CE"=>"Ceará","DF"=>"Distrito Federal","ES"=>"Espírito Santo","GO"=>"Goiás","MA"=>"Maranhão","MT"=>"Mato Grosso","MS"=>"Mato Grosso do Sul","MG"=>"Minas Gerais","PA"=>"Pará","PB"=>"Paraíba","PR"=>"Paraná","PE"=>"Pernambuco","PI"=>"Piauí","RJ"=>"Rio de Janeiro","RN"=>"Rio Grande do Norte","RO"=>"Rondônia","RS"=>"Rio Grande do Sul","RR"=>"Roraima","SC"=>"Santa Catarina","SE"=>"Sergipe","SP"=>"São Paulo","TO"=>"Tocantins");
        set_layout('conteudo', load_content('cliente/lista', $data));
        load_layout();
    }

    public function profile(){
        $id = $this->uri->segment(3);
        $pedidos = array();
        $data["cliente"] = $this->Cliente_m->get_by_id($id);
        $data['pedidos'] = $this->Cliente_m->get_pedidos_by_cliente_id($id);
        foreach ($data['pedidos'] as $key => $pedido) {
            $pedidos[] = $this->Cliente_m->get_adicionais_by_pedido_id($pedido->ped_id);
        }
        foreach ($pedidos as $key => $pedido) {
            foreach ($pedido as $key => $adicional) {
                $data['adicionais'][] = $adicional;
            }
        }
        set_layout('conteudo', load_content('cliente/profile', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Cliente_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->id,
                'id' => $item->id,
                'pessoa_tipo' => $item->pessoa_tipo,
                'nome' => $item->nome,
                'sobrenome' => $item->sobrenome,
                'email' => $item->email,
                'telefone' => $item->telefone,
                'nome2' => $item->nome2,
                'sobrenome2' => $item->sobrenome2,
                'email2' => $item->email2,
                'telefone2' => $item->telefone2,
                'rg' => $item->rg,
                'cpf' => $item->cpf,
                'endereco' => $item->endereco,
                'numero' => $item->numero,
                'complemento' => $item->complemento,
                'estado' => $item->estado,
                'uf' => $item->uf,
                'bairro' => $item->bairro,
                'cidade' => $item->cidade,
                'cep' => $item->cep,
                'observacao' => $item->observacao,
                'razao_social' => $item->razao_social,
                'cnpj' => $item->cnpj,
                'ie' => $item->ie,
                'im' => $item->im,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Cliente_m->count_all(),
            "recordsFiltered" => $this->Cliente_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    public function ajax_add() {
        $this->_validar_formulario("add");
        $data['status'] = TRUE;
        $objeto = $this->_get_post();
        $result = $this->Cliente_m->inserir($objeto);
        if ($result) {
            print json_encode(array("status" => TRUE, 'msg' => 'Registro adicionado com sucesso','id'=>$result));
        } else {
            $data['status'] = FALSE;
            $data['status'] = "Erro ao executar o metodo Ajax_add()";
        }
    }

    public function ajax_edit($id) {
        $data["cliente"] = $this->Cliente_m->get_by_id($id);
        $data["status"] = TRUE;
        print json_encode($data);
        exit();
    }

    public function ajax_update() {
        $this->_validar_formulario("update");
        $id = $this->input->post('id');
        if ($id) {
            $objeto = $this->_get_post();
            $result = $this->Cliente_m->editar($objeto);
            if ($result) {
                print json_encode(array("status" => TRUE, 'msg' => 'Registro alterado com sucesso','id'=>$result));
            } else {
                print json_encode(array("status" => FALSE, 'msg' => 'Erro ao executar o metodo Cliente_m->editar()'));
            }
        } else {
            print json_encode(array("status" => FALSE, 'msg' => 'ID do registro não foi passado'));
        }
    }

    public function ajax_delete($id) {
        $this->Cliente_m->deletar($id);
        print json_encode(array("status" => TRUE, "msg" => "Registro excluido com sucesso"));
    }

    private function _get_post() {
        $objeto = new Cliente_m();
        $objeto->id = empty($this->input->post('id')) ? null:$this->input->post('id') ;
        $objeto->pessoa_tipo = $this->input->post('pessoa_tipo');
        $objeto->nome = $this->input->post('nome');
        $objeto->sobrenome = $this->input->post('sobrenome');
        $objeto->email = $this->input->post('email');
        $objeto->telefone = $this->input->post('telefone');
        $objeto->nome2 = $this->input->post('nome2');
        $objeto->sobrenome2 = $this->input->post('sobrenome2');
        $objeto->email2 = $this->input->post('email2');
        $objeto->telefone2 = $this->input->post('telefone2');
        $objeto->rg = $this->input->post('rg');
        $objeto->cpf = $this->input->post('cpf');
        $objeto->endereco = $this->input->post('endereco');
        $objeto->numero = $this->input->post('numero');
        $objeto->complemento = $this->input->post('complemento');
        $objeto->estado = $this->input->post('estado');
        $objeto->uf = $this->input->post('uf');
        $objeto->bairro = $this->input->post('bairro');
        $objeto->cidade = $this->input->post('cidade');
        $objeto->cep = $this->input->post('cep');
        $objeto->observacao = $this->input->post('observacao');
        $objeto->razao_social = $this->input->post('razao_social');
        $objeto->cnpj = $this->input->post('cnpj');
        $objeto->ie = $this->input->post('ie');
        $objeto->im = $this->input->post('im');
        return $objeto;
    }

    private function _validar_formulario($action) {
        $data = array();
        $data['status'] = TRUE;
        if($action == 'update' && !empty($this->input->post('id'))){
            $object = $this->Cliente_m->get_by_id($this->input->post('id'));
            ($this->input->post('email') != $object->email) ? $is_unique_email =  '|is_unique[cliente.email]' : $is_unique_email =  '';
            ($this->input->post('email2') != $object->email2) ? $is_unique_email2 =  '|is_unique[cliente.email2]' : $is_unique_email2 =  '';
            ($this->input->post('cpf') != $object->cpf) ? $is_unique_cpf =  '|is_unique[cliente.cpf]' : $is_unique_cpf =  ''; 
            ($this->input->post('cnpj') != $object->cnpj) ? $is_unique_cnpj =  '|is_unique[cliente.cnpj]' : $is_unique_cnpj =  ''; 
        }else{
            $is_unique_email =  '|is_unique[cliente.email]';
            $is_unique_email2 =  '|is_unique[cliente.email2]';
            $is_unique_cpf =  '|is_unique[cliente.cpf]';
            $is_unique_cnpj =  '|is_unique[cliente.cnpj]';
        }
        if($this->input->post('pessoa_tipo') == 'juridica'){
            $required = '|required';
        }else{
            $required = '';
        }
        //Dados do cliente
        $this->form_validation->set_rules('pessoa_tipo', 'Pessoa', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required|max_length[50]');
        $this->form_validation->set_message('is_unique','Já exixte um campo com este email. Dados duplicados não são permitidos.');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[100]|valid_email'.$is_unique_email);
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|max_length[15]');
        //Contato 2
        $this->form_validation->set_rules('nome2', 'Nome2', 'trim');
        $this->form_validation->set_rules('sobrenome2', 'Sobrenome2', 'trim');
        $this->form_validation->set_rules('email2', 'Email2', 'trim|max_length[100]|valid_email'.$is_unique_email2);
        $this->form_validation->set_rules('telefone2', 'Telefone2', 'trim|max_length[15]');
        //Documentos
        $this->form_validation->set_rules('rg', 'RG', 'trim|callback_validation_is_valid_rg');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|callback_validation_is_valid_cpf'.$is_unique_cpf);
        //Endereço
        $this->form_validation->set_rules('endereco', 'Endereco', 'trim|max_length[50]');
        $this->form_validation->set_rules('numero', 'Número', 'trim');
        $this->form_validation->set_rules('complemento', 'Complemento', 'trim|max_length[100]');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|max_length[50]');
        $this->form_validation->set_rules('uf', 'UF', 'trim|max_length[2]');
        $this->form_validation->set_rules('bairro', 'Bairro', 'trim|max_length[50]');
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|max_length[50]');
        $this->form_validation->set_rules('cep', 'CEP', 'trim');
        $this->form_validation->set_rules('observacao', 'Observação', 'trim');
        //Dados da empresa
        $this->form_validation->set_rules('razao_social', 'Razao Social', 'trim|max_length[150]'.$required);
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|max_length[18]'.$is_unique_cnpj);
        $this->form_validation->set_rules('ie', 'I.E', 'trim|max_length[30]');
        $this->form_validation->set_rules('im', 'I.M', 'trim|max_length[30]');


        if (!$this->form_validation->run()) {
            $data['form_validation'] = $this->form_validation->error_array();
            $data['status'] = FALSE;
            print json_encode($data);
            exit();
        }
    }
    public function validation_is_valid_cpf($strCPF) {
        $this->form_validation->set_message('validation_is_valid_cpf','O CPF informado é inválido');
        if(!empty($strCPF)){
            $strCPF = preg_replace('/[^0-9]/', '', (string) $strCPF);

            if ($strCPF == '00000000000' || $strCPF == '11111111111' || $strCPF == '22222222222' || $strCPF == '33333333333' || $strCPF == '44444444444' || $strCPF == '55555555555' || $strCPF == '66666666666' || $strCPF == '77777777777' || $strCPF == '88888888888' || $strCPF == '99999999999') {
                return false;
            }
            $arrayCPF = str_split($strCPF);
            if(count($arrayCPF) != 11){
                return false;
            }
            $soma = 0;
            for ($i=1; $i<=9; $i++) {
                $soma = $soma + intval($arrayCPF[$i-1]) * (11 - $i);
            }
            $resto = ($soma * 10) % 11;
            if (($resto === 10) || ($resto === 11))  $resto = 0;
            if ($resto != intval($arrayCPF[9]) ) return false;
            $soma = 0;
            for ($i = 1; $i <= 10; $i++) { 
                $soma = $soma + intval($arrayCPF[$i-1]) * (12 - $i);
            }
            $resto = ($soma * 10) % 11;
            if (($resto === 10) || ($resto === 11))  $resto = 0;
            if ($resto != intval($arrayCPF[10] ) ) return false;
            return true;
        }else{
            return true;
        }
    }
    public function validation_is_valid_rg($rg){
        $rg = preg_replace('/[^0-9]/', '', (string) $rg);
        $rg = str_split($rg);
        $tamanho = count($rg);
        $vetor = array($tamanho);

        if($tamanho>=1){
            $vetor[0] = intval($rg[0]) * 2; 
        }
        if($tamanho>=2){
            $vetor[1] = intval($rg[1]) * 3; 
        }
        if($tamanho>=3){
            $vetor[2] = intval($rg[2]) * 4; 
        }
        if($tamanho>=4){
            $vetor[3] = intval($rg[3]) * 5; 
        }
        if($tamanho>=5){
            $vetor[4] = intval($rg[4]) * 6; 
        }
        if($tamanho>=6){
            $vetor[5] = intval($rg[5]) * 7; 
        }
        if($tamanho>=7){
            $vetor[6] = intval($rg[6]) * 8; 
        }
        if($tamanho>=8){
            $vetor[7] = intval($rg[7]) * 9; 
        }
        if($tamanho>=9){
            $vetor[8] = intval($rg[8]) * 100; 
        }

        $total = 0;

        if($tamanho>=1){
            $total += $vetor[0];
        }
        if($tamanho>=2){
            $total += $vetor[1]; 
        }
        if($tamanho>=3){
            $total += $vetor[2]; 
        }
        if($tamanho>=4){
            $total += $vetor[3]; 
        }
        if($tamanho>=5){
            $total += $vetor[4]; 
        }
        if($tamanho>=6){
            $total += $vetor[5]; 
        }
        if($tamanho>=7){
            $total += $vetor[6];
        }
        if($tamanho>=8){
            $total += $vetor[7]; 
        }
        if($tamanho>=9){
            $total += $vetor[8]; 
        }


        $resto = $total % 11;
        if($resto!=0){
            $this->form_validation->set_message('validation_is_valid_rg','O RG informado é inválido');
            return false;
        }
        else{
            return true;
        }
    }
}
