<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Convite_modelo_m extends CI_Model {

    var $id;
    var $codigo;
    var $nome;
    var $altura_final;
    var $largura_final;
    var $cartao_altura;
    var $cartao_largura;
    var $envelope_altura;
    var $envelope_largura;
    var $empastamento_borda;
    var $descricao;
    // Ajax 
    var $table = 'convite_modelo';
    var $column_order = array('id','codigo','nome','altura_final','largura_final','cartao_altura','cartao_largura','envelope_altura','envelope_largura','empastamento_borda','descricao');
    var $column_search = array('id','codigo','nome','altura_final','largura_final','cartao_altura','cartao_largura','envelope_altura','envelope_largura','empastamento_borda','descricao');
    var $order = array('id'=>'asc');

    private function get_datatables_query() {
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

    public function get_by_id($id){
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get('convite_modelo');
        $result =  $this->Convite_modelo_m->changeToObject($result->result_array());
        return $result[0];
    }

    public function get_list() {
        $result = $this->db->get('convite_modelo');
        return $this->Convite_modelo_m->changeToObject($result->result_array());
    }

    public function inserir(Convite_modelo_m $objeto) {
        if (!empty($objeto)) {
            $dados = array(
                'id' => $objeto->id,
                'codigo' => $objeto->codigo,
                'nome' => $objeto->nome,
                'altura_final' => $objeto->altura_final,
                'largura_final' => $objeto->largura_final,
                'cartao_altura' => $objeto->cartao_altura,
                'cartao_largura' => $objeto->cartao_largura,
                'envelope_altura' => $objeto->envelope_altura,
                'envelope_largura' => $objeto->envelope_largura,
                'empastamento_borda' => $objeto->empastamento_borda,
                'descricao' => $objeto->descricao,
                
                );
            if ($this->db->insert('convite_modelo', $dados)) {
                $this->session->set_flashdata('sucesso', 'Registro inserido com sucesso');
                return $this->db->insert_id();
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível inserir este registro');
                return false;
            }
        } else {
            return false;
        }
    }

    public function editar(Convite_modelo_m $objeto) {
        if (!empty($objeto->id)) {
            $dados = array(
                'id' => $objeto->id,
                'codigo' => $objeto->codigo,
                'nome' => $objeto->nome,
                'altura_final' => $objeto->altura_final,
                'largura_final' => $objeto->largura_final,
                'cartao_altura' => $objeto->cartao_altura,
                'cartao_largura' => $objeto->cartao_largura,
                'envelope_altura' => $objeto->envelope_altura,
                'envelope_largura' => $objeto->envelope_largura,
                'empastamento_borda' => $objeto->empastamento_borda,
                'descricao' => $objeto->descricao,
                
                );
            $this->db->where('id', $objeto->id);
            if ($this->db->update('convite_modelo', $dados)) {
                $this->session->set_flashdata('sucesso', 'Registro editado com sucesso');
                return true;
            }
        } else {
            $this->session->set_flashdata('erro', 'Não foi possível editar este registro');
            return false;
        }
    }

    public function deletar($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('convite_modelo')) {
                $this->session->set_flashdata('sucesso', 'Registro excluido com sucesso');
                return true;
            } else {
                $this->session->set_flashdata('erro', 'Não foi possível excluir este registro');
                return false;
            }
        } else {
            return false;
        }
    }

    private function changeToObject($result_db) {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Convite_modelo_m();
            $object->id = $value['id'];
            $object->codigo = $value['codigo'];
            $object->nome = $value['nome'];
            $object->altura_final = $value['altura_final'];
            $object->largura_final = $value['largura_final'];
            $object->cartao_altura = $value['cartao_altura'];
            $object->cartao_largura = $value['cartao_largura'];
            $object->envelope_altura = $value['envelope_altura'];
            $object->envelope_largura = $value['envelope_largura'];
            $object->empastamento_borda = $value['empastamento_borda'];
            $object->descricao = $value['descricao'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_pesonalizado($colunas){
        $this->db->select($colunas);
        return $this->db->get("convite_modelo")->result_array();
    }

}