<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orcamento_m extends CI_Model {

    var $id;
    var $cliente; //objeto Cliente_m()
    var $assessor; //objeto Assessor_m()
    var $data;
    var $convite; //Array de convites Convite_m()
    var $produto; //Array de produtos Produto_m()
    var $personalizado; //Array de personalizados Personalizado_m()
    var $descricao;
    var $desconto;
    var $loja; //objeto Loja_m()
    var $evento; //objeto Evento_m()
    var $data_evento;
    var $usuario;
    // Ajax 
    var $table = 'orcamento as orc';
    var $column_order = array('orc.id', 'cliente_nome', 'orc.data', 'orc.data_evento', 'cliente_email', 'cliente_telefone', 'cliente_cpf', 'cliente_cnpj', 'cliente_razao_social', 'cliente_pessoa_tipo', 'evento_nome', 'loja_unidade', 'orc.descricao');
    var $column_search = array('orc.id', 'CONCAT(cli.nome," ", cli.sobrenome)', 'cli.email', 'cli.cpf', 'cli.telefone', 'cli.cnpj', 'cli.razao_social', 'CONCAT(asr.nome," ", asr.sobrenome)', 'asr.email', 'date_format(orc.data,"%d/%m/%Y")', 'date_format(orc.data_evento,"%d/%m/%Y")', 'evt.nome', 'loj.unidade');
    var $order = array('orc.id' => 'asc');

    private function get_datatables_query() {
        //Orcamento
        $this->db->select(
                'orc.id, 
            orc.cliente as orc_cli, 
            orc.assessor as orc_assessor, 
            date_format(orc.data,"%d/%m/%Y") as orc_data, 
            orc.descricao as orc_descricao, 
            date_format(orc.data_evento,"%d/%m/%Y") as orc_data_evento, 
            orc.evento as orc_evento, 
            orc.loja as orc_loja,  
            evt.nome as evento_nome, 
            loj.unidade as loja_unidade');
        //Assessor
        $this->db->select(
                'CONCAT(asr.nome," ", asr.sobrenome) as assessor_nome,
            asr.sobrenome as assessor_sobrenome, 
            asr.email as assessor_email');
        //Cliente
        $this->db->select(
                'CONCAT(cli.nome," ", cli.sobrenome) as cliente_nome,
            cli.email as cliente_email, 
            cli.telefone as cliente_telefone, 
            cli.cpf as cliente_cpf, 
            cli.razao_social as cliente_razao_social, 
            cli.cnpj as cliente_cnpj, 
            cli.pessoa_tipo as cliente_pessoa_tipo');
        if ($this->input->post('orc_id')) {
            $this->db->where('orc.id', $this->input->post('orc_id'));
        }
        if ($this->input->post('data_orcamento')) {
            $this->db->where('date_format(orc.data,"%Y-%m-%d")', date_to_db($this->input->post('data_orcamento')));
        }
        if ($this->input->post('cli_id')) {
            $this->db->where('cli.id', $this->input->post('cli_id'));
        }
        if ($this->input->post('cli_nome')) {
            $this->db->where('cli.nome', $this->input->post('cli_nome'));
        }
        if ($this->input->post('cli_sobrenome')) {
            $this->db->like('cli.sobrenome', $this->input->post('cli_sobrenome'));
        }
        if ($this->input->post('data_evento')) {
            $this->db->where('date_format(orc.data_evento,"%Y-%m-%d")', date_to_db($this->input->post('data_evento')));
        }
        if ($this->input->post('telefone')) {
            $this->db->where('cli.telefone', $this->input->post('telefone'));
        }
        if ($this->input->post('email')) {
            $this->db->where('cli.email', $this->input->post('email'));
        }
        if ($this->input->post('cpf')) {
            $this->db->where('cli.cpf', $this->input->post('cpf'));
        }
        if ($this->input->post('cnpj')) {
            $this->db->where('cli.cnpj', $this->input->post('cnpj'));
        }
        if ($this->input->post('razao_social')) {
            $this->db->like('cli.razao_social', $this->input->post('razao_social'));
        }
        $this->db->from($this->table);
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
        $this->join();
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->get_datatables_query();
        $this->join();
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function join() {
        $this->db->join('cliente as cli', 'orc.cliente = cli.id', 'left');
        $this->db->join('assessor as asr', 'orc.assessor = asr.id', 'left');
        $this->db->join('evento as evt', 'orc.evento = evt.id', 'left');
        $this->db->join('loja as loj', 'orc.loja = loj.id', 'left');
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function inserir() {
        //orcamento
        date_default_timezone_set('America/Sao_Paulo');
        $dados = array(
            'id' => null,
            'cliente' => $this->cliente->id,
            'assessor' => $this->assessor->id,
            'assessor_comissao' => $this->assessor->comissao,
            'data' => date('Y-m-d H:i:s'),
            'descricao' => $this->descricao,
            'desconto' => $this->desconto,
            'data_evento' => $this->data_evento,
            'evento' => $this->evento,
            'loja' => $this->loja->id,
            'usuario' => $this->session->user_id,
        );
        if ($this->db->insert('orcamento', $dados)) {
            $this->id = $this->db->insert_id();
        } else {
            return false;
        }

        //convite
        if (!empty($this->convite)) {
            $convites = $this->convite;
            foreach ($convites as $convite) {
                if (!$convite->inserir()) {
                    return false;
                } else {
                    if (strpos($convite->data_entrega, '/') !== false) {
                        $data_entrega = date_to_db($convite->data_entrega);
                    } else {
                        $data_entrega = $convite->data_entrega;
                    }
                    $dados = array(
                        'id' => null,
                        'orcamento' => $this->id,
                        'convite' => $convite->id,
                        'quantidade' => $convite->quantidade,
                        'mao_obra' => $convite->mao_obra->id,
                        'mao_obra_valor' => $convite->mao_obra->valor,
                        'comissao' => $convite->comissao,
                        'descricao' => $convite->descricao,
                        'data_entrega' => $data_entrega,
                        'cancelado' => 0,
                    );
                    if (!$this->db->insert('orcamento_convite', $dados)) {
                        return false;
                    }
                }
            }
        }
        //personalizado
        if (!empty($this->personalizado)) {
            $personalizados = $this->personalizado;
            foreach ($personalizados as $personalizado) {
                if (!$personalizado->inserir()) {
                    return false;
                } else {
                    if (strpos($personalizado->data_entrega, '/') !== false) {
                        $data_entrega = date_to_db($personalizado->data_entrega);
                    } else {
                        $data_entrega = $personalizado->data_entrega;
                    }
                    $dados = array(
                        'id' => null,
                        'orcamento' => $this->id,
                        'personalizado_produto' => $personalizado->id,
                        'quantidade' => $personalizado->quantidade,
                        'mao_obra' => $personalizado->mao_obra->id,
                        'mao_obra_valor' => $personalizado->mao_obra->valor,
                        'comissao' => $personalizado->comissao,
                        'descricao' => $personalizado->descricao,
                        'data_entrega' => $data_entrega,
                        'cancelado' => 0,
                    );
                    if (!$this->db->insert('orcamento_personalizado', $dados)) {
                        return false;
                    }
                }
            }
        }
        //produto
        if (!empty($this->produto)) {
            $produtos = $this->produto;
            foreach ($produtos as $produto) {
                if (strpos($produto->data_entrega, '/') !== false) {
                    $data_entrega = date_to_db($produto->data_entrega);
                } else {
                    $data_entrega = $produto->data_entrega;
                }
                $dados = array(
                    'id' => null,
                    'orcamento' => $this->id,
                    'produto' => $produto->produto->id,
                    'quantidade' => $produto->quantidade,
                    'descricao' => $produto->descricao,
                    'valor' => $produto->produto->valor,
                    'comissao' => $produto->comissao,
                    'data_entrega' => $data_entrega,
                    'cancelado' => 0,
                );
                if (!$this->db->insert('orcamento_produto', $dados)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('orcamento');
        if ($result->num_rows() > 0) {
            $result = $this->changeToObject($result->result_array());
            return $result[0];
        }
        return false;
    }

    public function get_numero_documento() {

        return "Orçamento N° " . $this->id;
    }

    public function calcula_total_convites() {
        $total = 0;
        foreach ($this->convite as $key => $value) {
            $total += $value->calcula_total();
        }
        //return $total;
        return round($total, 2);
    }

    public function calcula_total_personalizados() {
        $total = 0;
        foreach ($this->personalizado as $key => $value) {
            $total += $value->calcula_total();
        }
        //return $total;
        return round($total, 2);
    }

    public function calcula_total_produtos() {
        $total = 0;
        foreach ($this->produto as $key => $value) {
            $total += $value->calcula_total();
        }
        //return $total;
        return round($total, 2);
    }

    public function calcula_custos_administrativos() {
        //esta função não está sendo utilizada. Os cálculos dos custos de comissão já estão sendo cobrados nos convites, nos personalizados e nos produtos.
        return ($this->calcula_sub_total() / 100) * $this->assessor->comissao;
    }

    public function calcula_sub_total() {

        return $this->calcula_total_convites() + $this->calcula_total_produtos() + $this->calcula_total_personalizados();
    }

    public function calcula_total() {

        $total = $this->calcula_sub_total() - $this->desconto;
        return round($total, 2);
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Orcamento_m();
            $object->id = $value['id'];
            $object->cliente = $this->Cliente_m->get_by_id($value['cliente']);
            $object->usuario = $this->Usuario_m->get_object($value['usuario']);
            //Informações desnecessárias do usuário
            $object->usuario->ip_address = null;
            $object->usuario->password = null;
            $object->usuario->salt = null;
            $object->usuario->activation_code = null;
            $object->usuario->forgotten_password_code = null;
            $object->usuario->forgotten_password_time = null;
            $object->usuario->remember_code = null;
            $object->usuario->created_on = null;
            $object->usuario->last_login = null;
            $object->usuario->active = null;

            $object->assessor = $this->Assessor_m->get_by_id($value['assessor']);
            $object->assessor->comissao = empty($value['assessor_comissao']) ? 0 : $value['assessor_comissao'];
            $object->convite = $this->Convite_m->get_by_orcamento_id($object->id);
            $object->produto = $this->Container_produto_m->get_by_orcamento_id($object->id);
            $object->personalizado = $this->Personalizado_m->get_by_orcamento_id($object->id);
            $object->data = $value['data'];
            $object->descricao = $value['descricao'];
            $object->desconto = $value['desconto'];
            $object->loja = $this->Loja_m->get_by_id($value['loja']);
            $object->evento = $value['evento'];
            $object->data_evento = $value['data_evento'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

}

/* End of file Orcamento_m.php */
/* Location: ./application/models/Orcamento_m.php */