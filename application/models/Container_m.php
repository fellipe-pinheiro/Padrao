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
    var $container_laser; //Array de objetos laser
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
            foreach ($this->container_papel as $key_parent => $papel_parent) {
                //$key_parent = posição do array
                foreach ($papel_parent as $key_children => $papel_children) {
                    //$key_children = 'papel-0', 'papel-1' ou 'papel-2'
                    switch ($key_children) {
                        case 'papel-1':
                            $posicao_papel_children = 1;
                            break;
                        case 'papel-2':
                            $posicao_papel_children = 2;
                            break;
                        default: //'papel-0'
                            $posicao_papel_children = 0;
                            break;
                    }
                    if ( !$papel_children->inserir( $this->id, $posicao_papel_children , $key_parent) ) {
                        return false;
                    }
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
        if (!empty($this->container_laser)) {
            foreach ($this->container_laser as $laser) {
                if (!$laser->inserir($this->id)) {
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

    public function get_papel($owner, $id, $dimensao, $quantidade, $gramatura, $empastamento, $empastado) {
        //busca o papel pelo id
        $container_papel = new Container_papel_m();
        $container_papel->papel = $this->Papel_m->get_by_id($id);
        if($owner == 'personalizado'){
            $container_papel->dimensao = $this->Personalizado_modelo_dimensao_m->get_by_id($dimensao);
        }else{
            $container_papel->dimensao = $this->Convite_modelo_dimensao_m->get_by_id($dimensao);
        }
        if(!empty($empastamento)){
            $container_papel->empastamento = $this->Papel_empastamento_m->get_by_id($empastamento);
        }else{
            $container_papel->empastamento = new Papel_empastamento_m();
        }
        $container_papel->empastado = $empastado;
        $container_papel->papel->set_papel_gramatura($gramatura);
        $container_papel->quantidade = $quantidade;
        $container_papel->owner = $owner;
        return $container_papel;
    }

    private function is_empty($item) {
        if (empty($item)) {
            return 0;
        }
        return $item;
    }

    public function get_impressao($owner, $id, $dimensao, $quantidade, $descricao) {
        //busca o impressao pelo id
        $container_impressao = new Container_impressao_m();
        $container_impressao->impressao = $this->Impressao_m->get_by_id($id);
        $container_impressao->impressao->set_impressao_dimensao($dimensao);
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

    public function get_laser($owner, $id, $quantidade, $qtd_minutos, $descricao) {
        //busca o laser pelo id
        $container_laser = new Container_laser_m();
        $container_laser->laser = $this->Laser_m->get_by_id($id);
        $container_laser->quantidade = $quantidade;
        $container_laser->qtd_minutos = $qtd_minutos;
        $container_laser->descricao = $descricao;
        $container_laser->owner = $owner;
        return $container_laser;
    }

    //retorna a soma dos valores do array de: PAPEL, IMPRESSÃO, FITA, ACABAMENTO e ACESSÓRIO
    public function calcula_total($modelo, $qtd_pedido) {
        $this->total = 0;
        if (!empty($this->container_papel)) {
            foreach ($this->container_papel as $container_papel) {
                foreach ($container_papel as $value) {
                    $this->total += $value->calcula_valor_total($value->quantidade, $value->calcula_valor_unitario($modelo, $value->dimensao, $qtd_pedido));

                    if(!empty($value->empastamento->id)){
                        $this->total += $value->calcula_valor_total_empastamento(1,$value->calcula_valor_unitario_empastamento($qtd_pedido));
                    }
                }
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
        if (!empty($this->container_laser)) {
            foreach ($this->container_laser as $key => $value) {
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
        if (!empty($this->container_laser)) {
            foreach ($this->container_laser as $key => $value) {
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
        $object->container_laser = $this->Container_laser_m->get_by_container_id($id, $owner);
        return $object;
    }

}

/* End of file Container_m.php */
/* Location: ./application/models/Container_m.php */