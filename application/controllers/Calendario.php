<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('calendar');
        $this->load->model('Calendario_m');
        $this->load->model('Loja_m');
        $this->load->model('Container_adicional_m');
        $this->load->model('Producao_convite_m');
        $this->load->model('Papel_lista_compra_m');

        $this->load->model('Convite_m');
        $this->load->model('Container_m');
        $this->load->model('Container_papel_m');
        $this->load->model('Container_papel_acabamento_m');
        $this->load->model('Container_impressao_m');
        $this->load->model('Container_acabamento_m');
        $this->load->model('Container_acessorio_m');
        $this->load->model('Container_fita_m');
        $this->load->model('Convite_modelo_m');
        $this->load->model('Mao_obra_m');

        //Carrego a materia prima para compor convite
        $this->load->model('Papel_m');
        $this->load->model('Papel_linha_m');
        $this->load->model('Papel_dimensao_m');
        $this->load->model('Papel_acabamento_m');
        $this->load->model('Impressao_m');
        $this->load->model('Impressao_area_m');
        $this->load->model('Acabamento_m');
        $this->load->model('Acessorio_m');
        $this->load->model('Fita_m');
        $this->load->model('Fita_laco_m');
        $this->load->model('Fita_material_m');
        $this->load->model('Fita_espessura_m');
        set_layout('titulo', 'Sistema|Calendário', true);
        init_layout();
        restrito_logado();
    }

    public function entrega() {
        $data['lojas'] = $this->Loja_m->get_pesonalizado("id, unidade");
        set_layout('titulo', 'Calendário | Entrega', true);
        set_layout('conteudo', load_content('calendario/entrega', $data));
        load_layout();
    }

    public function producao() {
        $data['lojas'] = $this->Loja_m->get_pesonalizado("id, unidade");
        set_layout('titulo', 'Calendário | Produção', true);
        set_layout('conteudo', load_content('calendario/producao', $data));
        load_layout();
    }

    public function ajax_list() {
        $list = $this->Calendario_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->pedido_id,
                'pedido_id' => $item->pedido_id,
                'documento' => $item->documento,
                'orcamento_id' => $item->orcamento_id,
                'produto_id' => $item->produto_id,
                'adicional' => $item->adicional,
                'adicional_id' => $item->adicional_id,
                'ad_produto_id' => $item->ad_produto_id,
                'produto_tipo' => $item->produto_tipo,
                'produto_nome' => $item->produto_nome,
                'produto_codigo' => $item->produto_codigo,
                'quantidade' => $item->quantidade,
                'data_entrega' => date("d/m/Y", strtotime($item->data_entrega)),
                'cliente_id' => $item->cliente_id,
                'cliente' => $item->cliente,
                'data_evento' => date("d/m/Y", strtotime($item->data_evento)),
                'unidade' => $item->unidade,
                'recebimento_dados' => $this->status_format($item->recebimento_dados),
                'desenvolvimento_layout' => $this->status_format($item->desenvolvimento_layout),
                'envio_layout' => $this->status_format($item->envio_layout),
                'aprovado' => $this->status_format($item->aprovado),
                'producao' => $this->status_format($item->producao),
                'disponivel' => $this->status_format($item->disponivel),
                'retirado' => $this->status_format($item->retirado)
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Calendario_m->count_all(),
            "recordsFiltered" => $this->Calendario_m->count_filtered(),
            "data" => $data,
            "query" => $this->db->last_query(),
            );
        //output to json format
        print json_encode($output);
    }

    private function status_format($json) {
        if (empty($json))
            return "";

        $arr = json_decode($json, TRUE);

        $str = $arr["usuario"] . " " . date("d/m/Y H:i:s", strtotime($arr["data"]));
        return $str;
    }

    private function get_table($produto){
        switch ($produto) {
            case 'convite':
            $tabela_orcamento = 'orcamento_convite';
            $tabela_adicional = 'adicional_convite';
            break;
            case 'personalizado':
            $tabela_orcamento = 'orcamento_personalizado';
            $tabela_adicional = 'adicional_personalizado';
            break;
            case 'produto':
            $tabela_orcamento = 'orcamento_produto';
            $tabela_adicional = 'adicional_produto';
            break;
            
            default:
            return false;
            break;
        }
        $tabelas = array(
            'tabela_orcamento' => $tabela_orcamento,
            'tabela_adicional' => $tabela_adicional
            );
        return $tabelas;
    }

    private function is_adicional_update($status) {
        switch ($status) {
            case 'producao':
            return true;
            break;
            case 'disponivel':
            return true;
            break;
            case 'retirado':
            return true;
            break;

            default:
            return false;
            break;
        }
    }

    public function ajax_set_status() {
        $produto = $this->input->post('produto');
        $action = $this->uri->segment(3);
        $data['status'] = TRUE;
        $selecao = json_decode($_REQUEST['selecao']);
        $orcamentos = $selecao->orcamentos;
        $adicionais = $selecao->adicionais;

        $tabelas = $this->get_table($produto);
        $tabela_orcamento = $tabelas['tabela_orcamento'];
        $tabela_adicional = $tabelas['tabela_adicional'];

        if($action){
            $action = TRUE;
        }else{
            $action = FALSE;
        }

        $this->db->trans_begin();
        if (!empty($orcamentos)) {
            $this->Calendario_m->set_status($orcamentos, $tabela_orcamento,false,$action);
        }
        if (!empty($adicionais)) {
            $this->Calendario_m->set_status($adicionais, $tabela_adicional,true,$action);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data['status'] = FALSE;
        } else {
            $this->db->trans_commit();
        }
        print json_encode($data);
        exit();
    }

    public function ajax_get_papel_lista(){
        $list = $this->Papel_lista_compra_m->get_datatables();

        foreach ($list as $key => $value) {
            if($value->produto_tipo != 'personalizado'){
                if($value->qtd_papel > 1){
                    $altura_final = $value->altura_final + $value->empastamento_borda;
                    $larguar_final = $value->larguar_final + $value->empastamento_borda;
                }else{
                    $altura_final = $value->altura_final;
                    $larguar_final = $value->larguar_final;
                }

                $value->formato = $this->calcula_formato($value->pap_inteiro_alt,$value->pap_inteiro_larg,$altura_final,$larguar_final);
            }

            $list[$key]->folhas = ceil(( $value->qtd_pedido * $value->qtd_papel ) / $value->formato);
        }

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->pedido,
                'pedido' => $item->pedido,
                'cliente_id' => $item->cliente_id,
                'cliente' => $item->cliente,
                'data_evento' => $item->data_evento,
                'produto_id' => $item->produto_id,
                'qtd_pedido' => $item->qtd_pedido,
                'data_entrega' => $item->data_entrega,
                'gramatura' => $item->gramatura,
                'qtd_papel' => $item->qtd_papel,
                'papel_id' => $item->papel_id,
                'papel' => $item->papel,
                'papel_linha' => $item->papel_linha,
                'pap_inteiro_alt' => $item->pap_inteiro_alt,
                'pap_inteiro_larg' => $item->pap_inteiro_larg,
                'modelo_codigo' => $item->modelo_codigo,
                'modelo_nome' => $item->modelo_nome,
                'altura_final' => $item->altura_final,
                'larguar_final' => $item->larguar_final,
                'empastamento_borda' => $item->empastamento_borda,
                'adicional' => $item->adicional,
                'adicional_id' => $item->adicional_id,
                'ad_produto_id' => $item->ad_produto_id,
                'produto_tipo' => $item->produto_tipo,
                'folhas' => $item->folhas,
                'formato' => $item->formato,
                'composicao' => $item->composicao,
                'sobras' => null,
                'qtd_papel_total' => null,
                'add' => null
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Papel_lista_compra_m->count_all(),
            "recordsFiltered" => $this->Papel_lista_compra_m->count_filtered(),
            "data" => $data,
            );
        //output to json format
        print json_encode($output);
    }

    private function calcula_formato($papel_dimensao_altura, $papel_dimensao_largura, $altura,$largura){
        $formato1 = intval(($papel_dimensao_largura / $largura)) * intval(($papel_dimensao_altura / $altura));
        $formato2 = intval(($papel_dimensao_altura / $largura)) * intval(($papel_dimensao_largura / $altura));
        //verifica qual o maior
        if($formato1>$formato2){
            return $formato1;
        }
        return $formato2;
    }

    public function ajax_get_convite_detalhes() {
        $list = $this->Container_m->get_datatables();
        $data = array();
        $no = $_POST['start'];
        if(!empty($list)){
            $list = $this->renomeia_grupo($list);
        }
        foreach ($list as $item) {
            $no++;
            $row = array(
                'DT_RowId' => $item->pedido_id,
                'pedido_id' => $item->pedido_id,
                'orcamento_id' => $item->orcamento_id,
                'produto_id' => $item->produto_id,
                'item_id' => $item->item_id,
                'grupo' => $item->grupo,
                'item' => $item->item,
                'material' => $item->material,
                'quantidade' => $item->quantidade,
                'descricao' => $item->descricao,
                );
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Container_m->count_all(),
            "recordsFiltered" => $this->Container_m->count_filtered(),
            "data" => $data,
            "query" => $this->db->last_query(),
            );
        //output to json format
        print json_encode($output);
    }

    private function renomeia_grupo($list){
        $papel_count = 0;
        $impressao_count = 0;
        $acabamento_count = 0;
        $acessorio_count = 0;
        $fita_count = 0;
        $item_grupo = "";
        
        foreach ($list as $key => $item) {
            list($hash, $grupo) = explode("_",$item->grupo);
            if ($grupo === 'papel') {
                if($item_grupo != $item->grupo){
                    $item_grupo = $item->grupo;
                    $papel_count++;
                }
                $item->grupo = 'Papel '.$papel_count;
            }
            if ($grupo === 'impressao') {
                if($item_grupo != $item->grupo){
                    $item_grupo = $item->grupo;
                    $impressao_count++;
                }
                $item->grupo = 'Impressão '.$impressao_count;
            }
            if ($grupo === 'acabamento') {
                if($item_grupo != $item->grupo){
                    $item_grupo = $item->grupo;
                    $acabamento_count++;
                }
                $item->grupo = 'Acabamento '.$acabamento_count;
            }
            if ($grupo === 'acessorio') {
                if($item_grupo != $item->grupo){
                    $item_grupo = $item->grupo;
                    $acessorio_count++;
                }
                $item->grupo = 'Acessório '.$acessorio_count;
            }
            if ($grupo === 'fita') {
                if($item_grupo != $item->grupo){
                    $item_grupo = $item->grupo;
                    $fita_count++;
                }
                $item->grupo = 'Fita '.$fita_count;
            }
        }
        return $list;
    }
}

/* End of file calendario.php */
/* Location: ./application/controllers/calendario.php */