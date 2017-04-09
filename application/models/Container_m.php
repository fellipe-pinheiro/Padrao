<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Container_m extends CI_Model {

    var $id;
    var $owner; //string 'cartao'/'envelope'/'personalizado' =>definido na view container_itens.php
    var $container_papel; //Array de objetos papeis
    var $container_impressao; //Array de objetos impressao
    var $container_acabamento; //Array de objetos acabamento
    var $container_acessorio; //Array de objetos acessorio
    var $container_fita; //Array de objetos fita
    var $container_cliche; //Array de objetos cliche
    var $container_faca; //Array de objetos faca
    var $table;
    var $column_order = array('pedido_id', 'orcamento_id', 'produto_id', 'item_id', 'grupo', 'item', 'material', 'quantidade', 'descricao');
    var $column_search = array('pedido_id', 'orcamento_id', 'produto_id', 'item_id', 'grupo', 'item', 'material', 'quantidade', 'descricao');
    var $order = array('prioridade' => 'asc');

    private function get_datatables_query() {
        $this->db->where('quantidade > 0');
        if ($this->input->post('produto_id')) {
            $this->db->where('produto_id', $this->input->post('produto_id'));
        }
        if ($this->input->post('componente')) {
            switch ($this->input->post('componente')) {
                case 'cartao':
                    $this->table = 'v_materiais_servicos_cartao';
                    break;
                case 'envelope':
                    $this->table = 'v_materiais_servicos_envelope';
                    break;
                case 'personalizado':
                    $this->table = 'v_materiais_servicos_personalizado';
                    break;
                default:
                    # code...
                    break;
            }
        }
        $this->db->from($this->table);
        $this->db->group_by('pedido_id,orcamento_id,produto_id,item_id,grupo,item,material');
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
        $this->get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function inserir() {
        if ($this->owner == 'cartao') {
            $tabela = $this->owner;
        } else if ($this->owner == 'envelope') {
            $tabela = $this->owner;
        } else if ($this->owner == 'personalizado') {
            $tabela = $this->owner;
        } else {
            return false;
        }
        $dados = array('id' => NULL);
        if ($this->db->insert($tabela, $dados)) {
            $this->id = $this->db->insert_id();
        } else {
            return false;
        }
        if (!empty($this->container_papel)) {
            foreach ($this->container_papel as $papel) {
                if (!$papel->inserir($this->id)) {
                    return false;
                }
            }
        }
        if (!empty($this->container_impressao)) {
            foreach ($this->container_impressao as $impressao) {
                if (!$impressao->inserir($this->id)) {
                    return false;
                }
            }
        }
        if (!empty($this->container_acabamento)) {
            foreach ($this->container_acabamento as $acabamento) {
                if (!$acabamento->inserir($this->id)) {
                    return false;
                }
            }
        }
        if (!empty($this->container_acessorio)) {
            foreach ($this->container_acessorio as $acessorio) {
                if (!$acessorio->inserir($this->id)) {
                    return false;
                }
            }
        }
        if (!empty($this->container_fita)) {
            foreach ($this->container_fita as $fita) {
                if (!$fita->inserir($this->id)) {
                    return false;
                }
            }
        }
        if (!empty($this->container_cliche)) {
            foreach ($this->container_cliche as $cliche) {
                if (!$cliche->inserir($this->id)) {
                    return false;
                }
            }
        }
        if (!empty($this->container_faca)) {
            foreach ($this->container_faca as $faca) {
                if (!$faca->inserir($this->id)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function get_by_id($id, $owner) {
        if (empty($id)) {
            return new Container_m();
        }
        return $this->changeToObject($id, $owner);
    }

    public function get_papel($owner, $id, $dimensao, $quantidade, $gramatura, $empastamento_adicionar, $empastamento_quantidade, $empastamento_cobrar, $laminacao_adicionar, $laminacao_quantidade, $laminacao_cobrar, $douracao_adicionar, $douracao_quantidade, $douracao_cobrar, $corte_laser_adicionar, $corte_laser_quantidade, $corte_laser_cobrar, $corte_laser_minutos, $relevo_seco_adicionar, $relevo_seco_quantidade, $relevo_seco_cobrar, $relevo_seco_cobrar_faca_cliche, $hot_stamping_adicionar,$hot_stamping_quantidade,$hot_stamping_cobrar,$hot_stamping_cobrar_faca_cliche, $corte_vinco_adicionar, $corte_vinco_quantidade, $corte_vinco_cobrar, $corte_vinco_cobrar_faca_cliche, $almofada_adicionar, $almofada_quantidade, $almofada_cobrar, $almofada_cobrar_faca_cliche) {
        //busca o papel pelo id
        $container_papel = new Container_papel_m();
        $container_papel->papel = $this->Papel_m->get_by_id($id);
        if($owner == 'personalizado'){
            $container_papel->dimensao = $this->Personalizado_modelo_dimensao_m->get_by_id($dimensao);
        }else{
            $container_papel->dimensao = $this->Convite_modelo_dimensao_m->get_by_id($dimensao);
        }
        $container_papel->papel->set_papel_gramatura($gramatura);
        $container_papel->quantidade = $quantidade;
        //$container_papel->gramatura = $gramatura;
        $container_papel->owner = $owner;

        //FACA
        //Este bloco existe somente para obter o valor da faca
        $container_papel->faca = new Container_papel_acabamento_m();
        $container_papel->faca->owner = 'faca';
        $container_papel->faca->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('faca');
        $container_papel->faca->adicionar = 0;
        $container_papel->faca->quantidade = 0;
        $container_papel->faca->cobrar_servico = 0;
        $container_papel->faca->cobrar_faca_cliche = 0;
        $container_papel->faca->corte_laser_minutos = 0;

        //CORTE_VINCO
        $container_papel->corte_vinco = new Container_papel_acabamento_m();
        $container_papel->corte_vinco->owner = 'corte_vinco';
        $container_papel->corte_vinco->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('corte_vinco');
        $container_papel->corte_vinco->adicionar = $this->is_empty($corte_vinco_adicionar);
        $container_papel->corte_vinco->quantidade = $this->is_empty($corte_vinco_quantidade);
        $container_papel->corte_vinco->cobrar_servico = $this->is_empty($corte_vinco_cobrar);
        $container_papel->corte_vinco->cobrar_faca_cliche = $this->is_empty($corte_vinco_cobrar_faca_cliche);
        $container_papel->corte_vinco->corte_laser_minutos = 0;

        //EMPASTAMENTO
        $container_papel->empastamento = new Container_papel_acabamento_m();
        $container_papel->empastamento->owner = 'empastamento';
        $container_papel->empastamento->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('empastamento');
        $container_papel->empastamento->adicionar = $this->is_empty($empastamento_adicionar);
        $container_papel->empastamento->quantidade = $this->is_empty($empastamento_quantidade);
        $container_papel->empastamento->cobrar_servico = $this->is_empty($empastamento_cobrar);
        $container_papel->empastamento->cobrar_faca_cliche = 0;
        $container_papel->empastamento->corte_laser_minutos = 0;

        //LAMINACAO
        $container_papel->laminacao = new Container_papel_acabamento_m();
        $container_papel->laminacao->owner = 'laminacao';
        $container_papel->laminacao->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('laminacao');
        $container_papel->laminacao->adicionar = $this->is_empty($laminacao_adicionar);
        $container_papel->laminacao->quantidade = $this->is_empty($laminacao_quantidade);
        $container_papel->laminacao->cobrar_servico = $this->is_empty($laminacao_cobrar);
        $container_papel->laminacao->cobrar_faca_cliche = 0;
        $container_papel->laminacao->corte_laser_minutos = 0;

        //DOURAÇÃO
        $container_papel->douracao = new Container_papel_acabamento_m();
        $container_papel->douracao->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('douracao');
        $container_papel->douracao->adicionar = $this->is_empty($douracao_adicionar);
        $container_papel->douracao->quantidade = $this->is_empty($douracao_quantidade);
        $container_papel->douracao->cobrar_servico = $this->is_empty($douracao_cobrar);
        $container_papel->douracao->cobrar_faca_cliche = 0;
        $container_papel->douracao->corte_laser_minutos = 0;

        //CORTE LASER
        $container_papel->corte_laser = new Container_papel_acabamento_m();
        $container_papel->corte_laser->owner = 'corte_laser';
        $container_papel->corte_laser->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('corte_laser');
        $container_papel->corte_laser->adicionar = $this->is_empty($corte_laser_adicionar);
        $container_papel->corte_laser->quantidade = $this->is_empty($corte_laser_quantidade);
        $container_papel->corte_laser->cobrar_servico = $this->is_empty($corte_laser_cobrar);
        $container_papel->corte_laser->cobrar_faca_cliche = 0;
        $container_papel->corte_laser->corte_laser_minutos = $this->is_empty($corte_laser_minutos);

        //RELEVO SECO
        $container_papel->relevo_seco = new Container_papel_acabamento_m();
        $container_papel->relevo_seco->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('relevo_seco');
        $container_papel->relevo_seco->adicionar = $this->is_empty($relevo_seco_adicionar);
        $container_papel->relevo_seco->quantidade = $this->is_empty($relevo_seco_quantidade);
        $container_papel->relevo_seco->cobrar_servico = $this->is_empty($relevo_seco_cobrar);
        $container_papel->relevo_seco->cobrar_faca_cliche = $this->is_empty($relevo_seco_cobrar_faca_cliche);
        $container_papel->relevo_seco->corte_laser_minutos = 0;

        //HOT STAMPING
        $container_papel->hot_stamping = new Container_papel_acabamento_m();
        $container_papel->hot_stamping->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('hot_stamping');
        $container_papel->hot_stamping->adicionar = $this->is_empty($hot_stamping_adicionar);
        $container_papel->hot_stamping->quantidade = $this->is_empty($hot_stamping_quantidade);
        $container_papel->hot_stamping->cobrar_servico = $this->is_empty($hot_stamping_cobrar);
        $container_papel->hot_stamping->cobrar_faca_cliche = $this->is_empty($hot_stamping_cobrar_faca_cliche);
        $container_papel->hot_stamping->corte_laser_minutos = 0;

        //ALMOFADA
        $container_papel->almofada = new Container_papel_acabamento_m();
        $container_papel->almofada->papel_acabamento = $this->Papel_acabamento_m->get_by_codigo('almofada');
        $container_papel->almofada->adicionar = $this->is_empty($almofada_adicionar);
        $container_papel->almofada->quantidade = $this->is_empty($almofada_quantidade);
        $container_papel->almofada->cobrar_servico = $this->is_empty($almofada_cobrar);
        $container_papel->almofada->cobrar_faca_cliche = $this->is_empty($almofada_cobrar_faca_cliche);
        $container_papel->almofada->corte_laser_minutos = 0;
        return $container_papel;
    }

    private function is_empty($item) {
        if (empty($item)) {
            return 0;
        }
        return $item;
    }

    public function get_impressao($owner, $id, $quantidade, $descricao) {
        //busca a impressão pelo id
        $container_impressao = new Container_impressao_m();
        $container_impressao->impressao = $this->Impressao_m->get_by_id($id);
        $container_impressao->quantidade = $quantidade;
        $container_impressao->descricao = $descricao;
        $container_impressao->owner = $owner;
        return $container_impressao;
    }

    public function get_acabamento($owner, $id, $quantidade, $descricao) {
        //busca o acabamento pelo id
        $container_acabamento = new Container_acabamento_m();
        $container_acabamento->acabamento = $this->Acabamento_m->get_by_id($id);
        $container_acabamento->quantidade = $quantidade;
        $container_acabamento->descricao = $descricao;
        $container_acabamento->owner = $owner;
        return $container_acabamento;
    }

    public function get_acessorio($owner, $id, $quantidade, $descricao) {
        //busca o acessório pelo id
        $container_acessorio = new Container_acessorio_m();
        $container_acessorio->acessorio = $this->Acessorio_m->get_by_id($id);
        $container_acessorio->quantidade = $quantidade;
        $container_acessorio->descricao = $descricao;
        $container_acessorio->owner = $owner;
        return $container_acessorio;
    }

    public function get_fita($owner, $id, $quantidade, $descricao, $espessura) {
        //busca a fita pelo id
        $container_fita = new Container_fita_m();
        $container_fita->fita = $this->Fita_m->get_by_id($id);
        $container_fita->espessura = $espessura;
        $container_fita->quantidade = $quantidade;
        $container_fita->descricao = $descricao;
        $container_fita->owner = $owner;
        return $container_fita;
    }

    public function get_cliche($owner, $id, $dimensao, $quantidade, $cobrar_servico, $cobrar_cliche, $descricao) {
        //busca o cliche pelo id
        $container_cliche = new Container_cliche_m();
        $container_cliche->cliche = $this->Cliche_m->get_by_id($id);
        $container_cliche->cliche->set_cliche_dimensao($dimensao);
        $container_cliche->quantidade = $quantidade;
        $container_cliche->cobrar_servico = $cobrar_servico;
        $container_cliche->cobrar_cliche = $cobrar_cliche;
        $container_cliche->descricao = $descricao;
        $container_cliche->owner = $owner;
        return $container_cliche;
    }

    public function get_faca($owner, $id, $dimensao, $quantidade, $cobrar_servico, $cobrar_faca, $descricao) {
        //busca o faca pelo id
        $container_faca = new Container_faca_m();
        $container_faca->faca = $this->Faca_m->get_by_id($id);
        $container_faca->faca->set_faca_dimensao($dimensao);
        $container_faca->quantidade = $quantidade;
        $container_faca->cobrar_servico = $cobrar_servico;
        $container_faca->cobrar_faca = $cobrar_faca;
        $container_faca->descricao = $descricao;
        $container_faca->owner = $owner;
        return $container_faca;
    }

    //retorna a soma dos valores do array de: PAPEL, IMPRESSÃO, FITA, ACABAMENTO e ACESSÓRIO
    public function calcula_total($modelo, $qtd_pedido) {
        $this->total = 0;
        if (!empty($this->container_papel)) {
            foreach ($this->container_papel as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($modelo, $value->dimensao, $qtd_pedido));
                $this->total += $value->calcula_valor_total_empastamento($value->calcula_valor_unitario_empastamento($qtd_pedido), $value->empastamento->quantidade);
                $this->total += $value->calcula_valor_total_laminacao($value->calcula_valor_unitario_laminacao($qtd_pedido), $value->laminacao->quantidade);
                $this->total += $value->calcula_valor_total_douracao($value->calcula_valor_unitario_douracao($qtd_pedido), $value->douracao->quantidade);
                $this->total += $value->calcula_valor_total_corte_laser($value->calcula_valor_unitario_corte_laser($qtd_pedido), $value->corte_laser->quantidade);
                $this->total += $value->calcula_valor_total_relevo_seco($value->calcula_valor_unitario_relevo_seco($qtd_pedido), $value->relevo_seco->quantidade);
                $this->total += $value->calcula_valor_total_corte_vinco($value->calcula_valor_unitario_corte_vinco($qtd_pedido), $value->corte_vinco->quantidade);
                $this->total += $value->calcula_valor_total_almofada($value->calcula_valor_unitario_almofada($qtd_pedido), $value->almofada->quantidade);
            }
        }
        if (!empty($this->container_impressao)) {
            foreach ($this->container_impressao as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }

        if (!empty($this->container_acabamento)) {
            foreach ($this->container_acabamento as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }
        if (!empty($this->container_acessorio)) {
            foreach ($this->container_acessorio as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario());
            }
        }
        if (!empty($this->container_fita)) {
            foreach ($this->container_fita as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario());
            }
        }
        if (!empty($this->container_cliche)) {
            foreach ($this->container_cliche as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }
        if (!empty($this->container_faca)) {
            foreach ($this->container_faca as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }
        return $this->total;
    }

    public function calcula_total_personalizado($modelo, $qtd_pedido) {
        $this->total = 0;
        if (!empty($this->container_papel)) {
            foreach ($this->container_papel as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario_personalizado($modelo, $qtd_pedido));
                $this->total += $value->calcula_valor_total_empastamento($value->calcula_valor_unitario_empastamento($qtd_pedido), $value->empastamento->quantidade);
                $this->total += $value->calcula_valor_total_laminacao($value->calcula_valor_unitario_laminacao($qtd_pedido), $value->laminacao->quantidade);
                $this->total += $value->calcula_valor_total_douracao($value->calcula_valor_unitario_douracao($qtd_pedido), $value->douracao->quantidade);
                $this->total += $value->calcula_valor_total_corte_laser($value->calcula_valor_unitario_corte_laser($qtd_pedido), $value->corte_laser->quantidade);
                $this->total += $value->calcula_valor_total_relevo_seco($value->calcula_valor_unitario_relevo_seco($qtd_pedido), $value->relevo_seco->quantidade);
                $this->total += $value->calcula_valor_total_corte_vinco($value->calcula_valor_unitario_corte_vinco($qtd_pedido), $value->corte_vinco->quantidade);
                $this->total += $value->calcula_valor_total_almofada($value->calcula_valor_unitario_almofada($qtd_pedido), $value->almofada->quantidade);
            }
        }
        if (!empty($this->container_impressao)) {
            foreach ($this->container_impressao as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }

        if (!empty($this->container_acabamento)) {
            foreach ($this->container_acabamento as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }
        if (!empty($this->container_acessorio)) {
            foreach ($this->container_acessorio as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario());
            }
        }
        if (!empty($this->container_fita)) {
            foreach ($this->container_fita as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario());
            }
        }
        if (!empty($this->container_cliche)) {
            foreach ($this->container_cliche as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }
        if (!empty($this->container_faca)) {
            foreach ($this->container_faca as $key => $value) {
                $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($qtd_pedido));
            }
        }
        return $this->total;
    }

    private function changeToObject($id, $owner) {
        $object = new Container_m();
        $object->id = $id;
        $object->owner = $owner;
        $object->container_papel = $this->Container_papel_m->get_by_container_id($id, $owner);
        $object->container_impressao = $this->Container_impressao_m->get_by_container_id($id, $owner);
        $object->container_acabamento = $this->Container_acabamento_m->get_by_container_id($id, $owner);
        $object->container_acessorio = $this->Container_acessorio_m->get_by_container_id($id, $owner);
        $object->container_fita = $this->Container_fita_m->get_by_container_id($id, $owner);
        $object->container_cliche = $this->Container_cliche_m->get_by_container_id($id, $owner);
        $object->container_faca = $this->Container_faca_m->get_by_container_id($id, $owner);
        return $object;
    }

}

/* End of file Container_m.php */
/* Location: ./application/models/Container_m.php */