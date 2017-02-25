<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Sistema_m');
		init_layout();
		set_layout('titulo', 'Sistema');
	}

	public function index() {
		set_layout('conteudo', load_content("sistema/index",$this->Sistema_m->get_list() ));
		load_layout();
	}

	public function ajax_update()
	{
		$this->validar_formulario();
		$dados = $this->get_post();
		print json_encode(array("status"=>$this->Sistema_m->editar($dados)));
	}

	private function get_post() {
		$dados = array(
			'parcelamento_maximo' => $this->input->post('parcelamento_maximo'),
			'valor_minimo_parcelamento' => $this->input->post('valor_minimo_parcelamento'),
			'prazo_validade_orcamento' => $this->input->post('prazo_validade_orcamento'),
			);
		return $dados;
	}
	public function validar_formulario(){
		$data = array();
		$data['status'] = TRUE;
		$this->form_validation->set_message('decimal_positive', 'O valor não pode ser menor que 0 (zero)');
		$this->form_validation->set_rules('parcelamento_maximo', 'Parcelamento maximo', 'trim|required|numeric|no_leading_zeroes|is_natural_no_zero');
		$this->form_validation->set_rules('valor_minimo_parcelamento', 'Valor minimo para parcelamento','trim|required|numeric|no_leading_zeroes|decimal_positive');
		$this->form_validation->set_rules('prazo_validade_orcamento', 'Prazo de validade do orçamento', 'trim|required|numeric|no_leading_zeroes|is_natural_no_zero');

		if (!$this->form_validation->run()) {
			$data['form_validation'] = $this->form_validation->error_array();
			$data['status'] = FALSE;
			print json_encode($data);
			exit();
		}
	}
}
