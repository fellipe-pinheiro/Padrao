<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario_m extends CI_Model {

    // Ajax 
    var $table = 'v_calendario_entrega';
    var $column_order = array('data_entrega','pedido_id','documento','cliente','cliente_id','data_evento','orcamento_id','produto_id', 'adicional','adicional_id','ad_produto_id','produto_tipo','produto_nome','produto_codigo', 'quantidade','unidade','recebimento_dados','desenvolvimento_layout','envio_layout','aprovado','producao','disponivel','retirado');
    var $column_search = array('pedido_id','orcamento_id','produto_id', 'adicional','adicional_id','ad_produto_id','produto_nome', 'quantidade', 'DATE_FORMAT("data_entrega", "%d/%m/%Y")', 'cliente_id','cliente','DATE_FORMAT("data_evento", "%d/%m/%Y")','unidade','recebimento_dados','desenvolvimento_layout','envio_layout','aprovado','producao','disponivel','retirado');
    var $order = array('data_entrega'=>'asc');
    
    private function _get_datatables_query() {
        if($this->input->post('agrupar')){
            $this->db->select('pedido_id,documento,orcamento_id,produto_id,adicional,adicional_id,ad_produto_id,produto_tipo,produto_nome,produto_codigo,SUM(quantidade) as quantidade,data_entrega,cliente_id,cliente,data_evento,unidade,recebimento_dados,desenvolvimento_layout,envio_layout,aprovado,producao,disponivel,retirado');
        }
        if($this->input->post('filtro_documento')){
            $this->db->where('documento', $this->input->post('filtro_documento'));
        }
        if($this->input->post('filtro_pedido_id')){
            $this->db->where('pedido_id', $this->input->post('filtro_pedido_id'));
        }
        if($this->input->post('filtro_cliente_id')){
            $this->db->where('cliente_id', $this->input->post('filtro_cliente_id'));
        }
        if($this->input->post('filtro_cliente')){
            $this->db->like('cliente', $this->input->post('filtro_cliente'));
        }
        if($this->input->post('filtro_produto_tipo')){
            $this->db->where('produto_tipo', $this->input->post('filtro_produto_tipo'));
        }
        if($this->input->post('filtro_produto_nome')){
            $this->db->like('produto_nome', $this->input->post('filtro_produto_nome'));
        }
        if($this->input->post('filtro_produto_codigo')){
            $this->db->where('produto_codigo', $this->input->post('filtro_produto_codigo'));
        }
        if($this->input->post('filtro_data_evento')){
            $this->db->where('data_evento', $this->__format_date($this->input->post('filtro_data_evento')));
        }
        if($this->input->post('filtro_data_entrega')){
            $this->db->where('data_entrega', $this->__format_date($this->input->post('filtro_data_entrega')));
        }
        if($this->input->post('filtro_data_inicio') && $this->input->post('filtro_data_final')){
            $this->db->where("data_entrega BETWEEN '" . $this->__format_date($this->input->post('filtro_data_inicio'))."' AND '" . $this->__format_date($this->input->post('filtro_data_final')) . "' ", NULL, FALSE );
        }
        if($this->input->post('filtro_unidade')){
            $this->db->where('unidade', $this->input->post('filtro_unidade'));
        }
        if($this->input->post('filtro_periodo')){
            $this->__set_where_periodo($this->input->post('filtro_periodo'));
        }
        if($this->input->post('filtro_status')){
            switch ($this->input->post('filtro_status')) {
                case 'recebimento_dados':
                $this->db->where('recebimento_dados IS NOT NULL', null);
                $this->db->where('desenvolvimento_layout IS NULL', null);
                $this->db->where('envio_layout IS NULL', null);
                $this->db->where('aprovado IS NULL', null);
                $this->db->where('producao IS NULL', null);
                $this->db->where('disponivel IS NULL', null);
                $this->db->where('retirado IS NULL', null);
                break;
                case 'desenvolvimento_layout':
                $this->db->where('desenvolvimento_layout IS NOT NULL', null);
                $this->db->where('envio_layout IS NULL', null);
                $this->db->where('aprovado IS NULL', null);
                $this->db->where('producao IS NULL', null);
                $this->db->where('disponivel IS NULL', null);
                $this->db->where('retirado IS NULL', null);
                break;
                case 'envio_layout':
                $this->db->where('envio_layout IS NOT NULL', null);
                $this->db->where('aprovado IS NULL', null);
                $this->db->where('producao IS NULL', null);
                $this->db->where('disponivel IS NULL', null);
                $this->db->where('retirado IS NULL', null);
                break;
                case 'aprovado':
                $this->db->where('aprovado IS NOT NULL', null);
                $this->db->where('producao IS NULL', null);
                $this->db->where('disponivel IS NULL', null);
                $this->db->where('retirado IS NULL', null);
                break;
                case 'producao':
                $this->db->where('producao IS NOT NULL', null);
                $this->db->where('disponivel IS NULL', null);
                $this->db->where('retirado IS NULL', null);
                break;
                case 'disponivel':
                $this->db->where('disponivel IS NOT NULL', null);
                $this->db->where('retirado IS NULL', null);
                break;
                case 'retirado':
                $this->db->where('retirado IS NOT NULL', null);
                break;

                default:
                break;
            }
        }
        $this->db->from($this->table);
        if($this->input->post('agrupar')){
            $this->db->group_by('pedido_id,orcamento_id,produto_id,produto_tipo,produto_nome,produto_codigo,data_entrega,cliente_id,cliente,data_evento');
        }

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }  
    public function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }  
    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }   
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function set_status($ids,$tabela,$adicional,$action){
        $colunas = array();
        if(!$adicional){
            if($this->input->post('clear_recebimento_dados')){
                $colunas[] = 'recebimento_dados';
            }
            if($this->input->post('clear_desenvolvimento_layout')){
                $colunas[] = 'desenvolvimento_layout';
            }
            if($this->input->post('clear_envio_layout')){
                $colunas[] = 'envio_layout';
            }
            if($this->input->post('clear_aprovado')){
                $colunas[] = 'aprovado';
            }
        }
        if($this->input->post('clear_producao')){
            $colunas[] = 'producao';
        }
        if($this->input->post('clear_disponivel')){
            $colunas[] = 'disponivel';
        }
        if($this->input->post('clear_retirado')){
            $colunas[] = 'retirado';
        }
        if($action){
            $str_json = json_encode(array("data"=>date('Y-m-d H:i:s'),"usuario"=>get_dados_usuario('first_name')." ".get_dados_usuario('last_name')));
        }else{
            $str_json = null;
        }
        foreach ($colunas as $key => $coluna) {
            $dados = array( $coluna => $str_json);
            $this->db->where_in('id',$ids);
            $this->db->update($tabela,$dados);
        }
    }
    public function get_convite_detalhes($id,$tabela){
        $this->db->where('produto_id',$id);
        $query = $this->db->get($tabela);
        return $query->result(); 
    }
    private function __format_date($date){
        list($dia,$mes,$ano) = explode('/', $date);
        return $date = $ano.'-'.$mes.'-'.$dia;
    }
    private function __set_where_periodo($periodo){
        switch ($periodo) {
            case 'mes_passado':
            $this->__rangeMonth(date('Y-m-d', strtotime('-1 month')));
            break;

            case 'semana_passada':
            $this->__rangeWeek(date("Y-m-d", strtotime("-1 week")));
            break;

            case 'ontem':
            $this->db->where('data_entrega', date("Y-m-d",strtotime('-1 days')));
            break;

            case 'hoje':
            $this->db->where('data_entrega', date("Y-m-d",strtotime(date('Y-m-d'))));
            break;

            case 'amanha':
            $this->db->where('data_entrega', date("Y-m-d",strtotime(date('Y-m-d'). ' + 1 day')));
            break;

            case 'esta_semana':
            $this->__rangeWeek(date('Y-m-d'));
            break;

            case 'proxima_semana':
            $this->__rangeWeek(date("Y-m-d", strtotime("+1 week")));
            break;

            case 'este_mes':
            $this->__rangeMonth(date("Y-m-d"));
            break;

            case 'proximo_mes':
            $this->__rangeMonth(date('Y-m-d', strtotime('+1 month')));
            break;

            case 'este_mes_e_proximo_mes':
            $start = date("Y-m-d");
            $end = date('Y-m-d', strtotime('+1 month'));
            $this->__rangeBetweenMonths($start,$end);
            break;

            case 'este_mes_mais_dois_meses':
            $start = date("Y-m-d");
            $end = date('Y-m-d', strtotime('+2 month'));
            $this->__rangeBetweenMonths($start,$end);
            break;

            case 'este_mes_mais_cinco_meses':
            $start = date("Y-m-d");
            $end = date('Y-m-d', strtotime('+5 month'));
            $this->__rangeBetweenMonths($start,$end);
            break;
            
            case 'este_ano':
            $start = date("Y-m-d", strtotime('first day of January'));
            $end = date('Y-m-d', strtotime('Dec 31'));
            $this->__rangeBetweenMonths($start,$end);
            break;

            case 'proximo_ano':
            $start = date('Y-m-d', strtotime('+1 year'.date("Y-m-d", strtotime('first day of January'))));
            $end = date('Y-m-d', strtotime('+1 year'.date("Y-m-d", strtotime('Dec 31'))));
            $this->__rangeBetweenMonths($start,$end);
            break;

            default:
                # code...
            break;
        }
    }
    private function __rangeWeek($datestr) {
        $dt = strtotime($datestr);
        $range['start'] = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
        $range['end'] = date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
        $this->__apply_where_range($range);
    }
    private function __rangeMonth($datestr) {
        $dt = strtotime($datestr);
        $range['start'] = date('Y-m-d', strtotime('first day of this month', $dt));
        $range['end'] = date('Y-m-d', strtotime('last day of this month', $dt));
        $this->__apply_where_range($range);
    }
    private function __rangeBetweenMonths($start,$end) {
        $start = strtotime($start);
        $end = strtotime($end);
        $range['start'] = date('Y-m-d', strtotime('first day of this month', $start));
        $range['end'] = date('Y-m-d', strtotime('last day of this month', $end));
        $this->__apply_where_range($range);
    }
    private function __apply_where_range($range){

        $this->db->where("data_entrega BETWEEN '" . $range['start'] ."' AND '" . $range['end'] . "' ", NULL, FALSE );
    }
}