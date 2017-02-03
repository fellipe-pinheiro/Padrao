<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Papel_lista_compra_m extends CI_Model {
    
    var $table = 'v_lista_compra_papel';
    var $column_order = array('pedido', 'cliente', 'data_entrega', 'qtd_pedido', 'qtd_papel', 'add', 'sobras', 'qtd_papel_total', 'papel_linha', 'papel', 'gramatura', 'folhas', 'pap_inteiro_alt', 'pap_inteiro_larg', 'modelo_codigo', 'modelo_nome', 'altura_final', 'larguar_final', 'formato', 'empastamento_borda', 'composicao');
    var $column_search = array('pedido', 'cliente', 'date_format(data_entrega,"%d/%m/%Y")', 'papel_linha', 'papel', 'modelo_codigo', 'modelo_nome', 'composicao');
    var $order = array('gramatura' => 'asc');

    private function _get_datatables_query() {
        if ($this->input->post('agrupar')) {

            $this->db->select('pedido,cliente_id,cliente,data_evento,produto_id,SUM(qtd_pedido) as qtd_pedido,date_format(data_entrega,"%d/%m/%Y") as data_entrega,gramatura,qtd_papel,papel_id,papel,papel_linha,pap_inteiro_alt,pap_inteiro_larg,modelo_codigo,modelo_nome,altura_final,larguar_final,empastamento_borda,adicional,adicional_id,ad_produto_id,produto_tipo,composicao,formato');
        }
        if ($this->input->post('selecao')) {
            $selecao = json_decode($_REQUEST['selecao']);
            $orcamentos = $selecao->orcamentos;
            $adicionais = $selecao->adicionais;
            if (!empty($orcamentos)) {
                $this->db->group_start();
                $this->db->where_in('produto_id', $orcamentos);
                $this->db->where('adicional', false);
                $this->db->group_end();
            }
            if (!empty($adicionais)) {
                $this->db->or_group_start();
                $this->db->where_in('ad_produto_id', $adicionais);
                $this->db->where('adicional', true);
                $this->db->group_end();
            }
        }
        if ($this->input->post('produto_tipo')) {

            $this->db->where('produto_tipo', $this->input->post('produto_tipo'));
        }
        if ($this->input->post('agrupar')) {

            $this->db->group_by('pedido,cliente_id,cliente,data_evento,produto_id,data_entrega,gramatura,papel_id,papel,papel_linha,pap_inteiro_alt,pap_inteiro_larg,modelo_codigo,modelo_nome,altura_final,larguar_final,empastamento_borda,produto_tipo,composicao');
        }

        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
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
}
/* End of file Papel_lista_compra_m.php */
/* Location: ./application/models/Papel_lista_compra_m.php */