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

	public function ajax_update(){
		$this->validar_formulario();
		$dados = $this->get_post();
		print json_encode(array("status"=>$this->Sistema_m->editar($dados)));
	}

	private function get_post() {
		$dados = array(
			'prazo_validade_orcamento' => $this->input->post('prazo_validade_orcamento'),
			'markup_porcentagem_padrao' => $this->input->post('markup_porcentagem_padrao'),
			);
		return $dados;
	}

	public function get_value_by_name($name)
	{
		print $this->Sistema_m->get_by_nome($name);
	}

	public function validar_formulario(){
		$data = array();
		$data['status'] = TRUE;
		
		$this->form_validation->set_rules('prazo_validade_orcamento', 'Prazo de validade do orçamento', 'trim|required|numeric|no_leading_zeroes|is_natural_no_zero');

		$this->form_validation->set_message('regex_match','O valor deve ser entre 0 e 100');
        $this->form_validation->set_rules('markup_porcentagem_padrao', 'Markup porcentagem padrão', 'trim|required|max_length[3]|is_natural|regex_match[/^(?:100|\d{1,2})?$/]');

		if (!$this->form_validation->run()) {
			$data['form_validation'] = $this->form_validation->error_array();
			$data['status'] = FALSE;
			print json_encode($data);
			exit();
		}
	}
}
