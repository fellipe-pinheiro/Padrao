<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adicional extends CI_Controller {

	public function __construct() {
		parent::__construct();

        //Orçamento
		$this->load->model('Orcamento_m');
		$this->load->model('Pedido_m');
		$this->load->model('Cliente_m');
		$this->load->model('Assessor_m');
		$this->load->model('Usuario_m');
		$this->load->model('Mao_obra_m');
		$this->load->model('Loja_m');
		$this->load->model('Evento_m');
		$this->load->model('Forma_pagamento_m');
		$this->load->model('Cliente_conta_m');
		$this->load->model('Adicional_m');
		$this->load->model('Container_adicional_m');

        //Sessão Produto
		$this->load->model('Produto_m');
		$this->load->model('Produto_categoria_m');
		$this->load->model('Container_produto_m');

        //Sessão Convite
		$this->load->model('Convite_m');
		$this->load->model('Convite_modelo_m');        
		$this->load->model('Container_m');
		$this->load->model('Container_papel_m');
		$this->load->model('Container_papel_acabamento_m');
		$this->load->model('Container_impressao_m');
		$this->load->model('Container_acabamento_m');
		$this->load->model('Container_acessorio_m');
		$this->load->model('Container_fita_m');

        //Sessão Personalizado
		$this->load->model('Personalizado_m');
		$this->load->model('Personalizado_modelo_m');        
		$this->load->model('Personalizado_categoria_m');        

        //Materia Prima Convite
		$this->load->model('Papel_m');
		$this->load->model('Papel_linha_m');
		$this->load->model('Papel_catalogo_m');
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
		init_layout();
		set_layout('titulo', 'Adicional',FALSE);
		restrito_logado();
	}

	public function pdf(){
		$id = $this->uri->segment(3);
		$data['adicional'] = $this->Adicional_m->get_by_id($id);
		list($date, $hour) = explode(" ", $data['adicional']->data);
		list($ano, $mes, $dia) = explode("-", $date);
		$data['data'] = $dia."/".$mes."/".$ano." ".$hour;
		set_layout('conteudo', load_content('adicional/pdf',$data));
		load_layout();
	}

}

/* End of file Adicional.php */
/* Location: ./application/controllers/Adicional.php */