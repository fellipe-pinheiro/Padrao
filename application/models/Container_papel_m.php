<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container_papel_m extends CI_Model {

	var $id;
	var $papel; //Objeto Papel_m()
	var $owner; //string:'cartao','envelope','personalizado' :definido no get_papel() do Container_m.php
	var $quantidade; 
	var $gramatura; //gramatura em números inteiros escolhida

	var $corte_vinco; //Objeto Container_papel_acabamento_m()
	var $empastamento; //Objeto Container_papel_acabamento_m()
	var $laminacao; //Objeto Container_papel_acabamento_m()
	var $douracao; //Objeto Container_papel_acabamento_m()
	var $corte_laser; //Objeto Container_papel_acabamento_m()
	var $relevo_seco; //Objeto Container_papel_acabamento_m()
	var $almofada; //Objeto Container_papel_acabamento_m()
	var $faca; //Objeto Container_papel_acabamento_m()

	public function inserir($id){
		//Seto a tabela destino
		if($this->owner == 'cartao'){
			$tabela = 'cartao_papel';
			$coluna = 'cartao';
		}else if($this->owner == 'envelope'){
			$tabela = 'envelope_papel';
			$coluna = 'envelope';
		}else if($this->owner == 'personalizado'){
			$tabela = 'personalizado_papel';
			$coluna = 'personalizado';
		}else{
			return false;
		}
		$dados = array(
			'id' => NULL,
			'papel' => $this->papel->id,
			$coluna => $id,
			'quantidade' => $this->quantidade,
			'gramatura' => $this->gramatura,
			'valor' => $this->get_valor_gramatura(),
			);
		if ($this->db->insert($tabela, $dados)) {
			$this->id = $this->db->insert_id();
		}else{
			return false;
		}
		//inserir todos papel_acabamento
		//O corte e vinco sempre gravar pois há dependentes dele como: [relevo_seco, almofada]
		if(!$this->corte_vinco->inserir($this->id,$this->owner)){
			return false;
		}
		if(!empty($this->empastamento->adicionar)){
			if(!$this->empastamento->inserir($this->id,$this->owner)){
				return false;
			}
		}
		if(!empty($this->laminacao->adicionar)){
			if(!$this->laminacao->inserir($this->id,$this->owner)){
				return false;
			}
		}
		if(!empty($this->douracao->adicionar)){
			if(!$this->douracao->inserir($this->id,$this->owner)){
				return false;
			}
		}
		if(!empty($this->corte_laser->adicionar)){
			if(!$this->corte_laser->inserir($this->id,$this->owner)){
				return false;
			}
		}
		if(!empty($this->relevo_seco->adicionar)){
			if(!$this->relevo_seco->inserir($this->id,$this->owner)){
				return false;
			}
		}
		if(!empty($this->almofada->adicionar)){
			if(!$this->almofada->inserir($this->id,$this->owner)){
				return false;
			}
		}
		//Faca não é adicionada mas entra para armazenar o valor
		if(!$this->faca->inserir($this->id,$this->owner)){
			return false;
		}
		return true;
	}
	public function get_by_container_id($id,$owner){
		//Seto a tabela destino
		if($owner == 'cartao'){
			$tabela = 'cartao_papel';
			$coluna = 'cartao';
		}else if($owner == 'envelope'){
			$tabela = 'envelope_papel';
			$coluna = 'envelope';
		}else if($owner == 'personalizado'){
			$tabela = 'personalizado_papel';
			$coluna = 'personalizado';
		}else{
			return false;
		}
		$this->db->where($coluna, $id);
		$result = $this->db->get($tabela);
		if(!empty($result->num_rows())){
			return $result =  $this->Container_papel_m->changeToObject($result->result_array(),$owner);
		}
		return array();
	}
	//CALCULA: valor unitário do papel
	public function calcula_valor_unitario($modelo,$qtd){
		if($this->owner =='cartao' || $this->owner =='envelope'){
			return $this->calcula_valor_unitario_convite($modelo,$qtd);
		}
		if($this->owner =='personalizado'){
			return $this->calcula_valor_unitario_personalizado($modelo,$qtd);
		}
	}
	private function calcula_valor_unitario_convite($modelo,$qtd){
		/*
		Especificação: é passado por parametro o tamanho do modelo do convite (AlturaxLargura) e do Papel inteiro (AlturaxLargura)
		1: Calculo quantos pedaços consigo extrair de um papel inteiro
		2: Verifico quantos papeis são necessários para o pedido. Obs: se der fração, arredondo para CIMA
		3: Verifico o valor total de papeis e divido pela quantidade do pedido e retorno este valor
		*/
        //verifica qual variavel do convite_modelo usar
		if($this->owner == 'cartao'){
			$altura = $modelo->cartao_altura;
			$largura = $modelo->cartao_largura;
		}else if($this->owner == 'envelope'){
			$altura = $modelo->envelope_altura;
			$largura = $modelo->envelope_largura;
		}
		if($this->empastamento->adicionar == 1){
			$altura += $modelo->empastamento_borda;
			$largura += $modelo->empastamento_borda;
		}
        //calcula a quantidade total de papeis para o pedido arredondando para cima
		$qtd_papeis = ceil($qtd / $this->calcula_formato($altura,$largura));
		return round(($qtd_papeis * $this->get_valor_gramatura())/$qtd,2); //Arredonda o valor
	}
	private function calcula_valor_unitario_personalizado($modelo,$qtd){
        //calcula a quantidade total de papeis para o pedido arredondando para cima
		$qtd_papeis = ceil($qtd / $modelo->formato);

		//return ($qtd_papeis * $this->get_valor_gramatura())/$qtd;
		return round(($qtd_papeis * $this->get_valor_gramatura())/$qtd,2); //Arredonda o valor
	}
	public function calcula_valor_total($qtd,$valor_unitario){

		return $qtd * $valor_unitario;
	}
	//calculo para saber qual o aproveitamento do papel
	private function calcula_formato($altura,$largura){
		$formato1 = intval(($this->papel->papel_dimensao->largura / $largura)) * intval(($this->papel->papel_dimensao->altura / $altura));
		$formato2 = intval(($this->papel->papel_dimensao->altura / $largura)) * intval(($this->papel->papel_dimensao->largura / $altura));
        //verifica qual o maior
		if($formato1>$formato2){
			return $formato1;
		}
		return $formato2;
	}
	private function get_valor_gramatura(){
		//Define o valor do papel pela gramatura escolhida e atribuo para $cartao_papel->valor 
		switch ($this->gramatura) {
			case '80':
			return $this->papel->valor_80g;
			break;
			case '120':
			return $this->papel->valor_120g;
			break;
			case '180':
			return $this->papel->valor_180g;
			break;
			case '250':
			return $this->papel->valor_250g;
			break;
			case '300':
			return $this->papel->valor_300g;
			break;
			case '350':
			return $this->papel->valor_350g;
			break;
			case '400':
			return $this->papel->valor_400g;
			break;
			default:
			return 0;
			break;
		}
	}
	//Atribui o valor em que foi realizado o orçamento para a gramatura correspondente
	private function set_valor_gramatura($papel,$gramatura,$valor){
		switch ($gramatura) {
			case '80':
			return $papel->valor_80g = $valor;
			break;
			case '120':
			return $papel->valor_120g = $valor;
			break;
			case '180':
			return $papel->valor_180g = $valor;
			break;
			case '250':
			return $papel->valor_250g = $valor;
			break;
			case '300':
			return $papel->valor_300g = $valor;
			break;
			case '350':
			return $papel->valor_350g = $valor;
			break;
			case '400':
			return $papel->valor_400g = $valor;
			break;
			default:
			return 0;
			break;
		}
	}
	public function calcula_valor_unitario_empastamento($qtd){
		if($this->empastamento->adicionar == 1 && $this->empastamento->cobrar_servico ==1){
			if($qtd < 100){
				return round($this->empastamento->papel_acabamento->valor / $qtd,2);
			}else{
				return round($this->empastamento->papel_acabamento->valor / 100,2);
			}
		}
		return 0;
	}
	public function calcula_valor_total_empastamento($unitario,$qtd){

		return $unitario * $qtd;
	}
	public function calcula_valor_unitario_laminacao($qtd){
		if($this->laminacao->adicionar == 1 && $this->laminacao->cobrar_servico ==1){
			if($qtd < 100){
				return round($this->laminacao->papel_acabamento->valor / $qtd,2);
			}else{
				return round($this->laminacao->papel_acabamento->valor / 100,2);
			}
		}
		return 0;
	}
	public function calcula_valor_total_laminacao($unitario,$qtd){

		return $unitario * $qtd;
	}
	//O papel tem que ter uma gramatura acima de x ou o papel tem que estar empastado...
	public function calcula_valor_unitario_douracao($qtd){
		if($this->douracao->adicionar == 1 && $this->douracao->cobrar_servico ==1){
			if($qtd < 100){
				return round($this->douracao->papel_acabamento->valor / $qtd,2);
			}else{
				return round($this->douracao->papel_acabamento->valor / 100,2);
			}
		}
		return 0;
	}
	public function calcula_valor_total_douracao($unitario,$qtd){

		return $unitario * $qtd;
	}
	public function calcula_valor_unitario_corte_laser($qtd){
		if($this->corte_laser->adicionar == 1 && $this->corte_laser->cobrar_servico ==1){
			$valor_hora = $this->corte_laser->papel_acabamento->valor;
			return round(($valor_hora/60)*$this->corte_laser->corte_laser_minutos,2);
		}
		return 0;
	}
	public function calcula_valor_total_corte_laser($unitario,$qtd){

		return $unitario * $qtd;
	}
	// Valor mínimo do cento do corte e vinco e taxa mínima de clichê dividido pelo numero de convites
	public function calcula_valor_unitario_relevo_seco($qtd){
		$valor = 0;
		if($this->relevo_seco->adicionar == 1 && $this->relevo_seco->cobrar_servico ==1){
			//Legenda: cobrar_serviço é cobrar corte_vinco (O serviço de corte e vinco)
			if($qtd < 100){
				$valor = round($this->corte_vinco->papel_acabamento->valor / $qtd,2);
			}else{
				$valor = round($this->corte_vinco->papel_acabamento->valor / 100,2);
			}
		}
		if($this->relevo_seco->adicionar == 1 && $this->relevo_seco->cobrar_faca_cliche ==1){
			//Legenda: cobrar_faca_cliche é cobrar relevo_seco (valor do clichê)
			if($qtd < 100){
				$valor += round($this->relevo_seco->papel_acabamento->valor / $qtd,2);
			}else{
				$valor += round($this->relevo_seco->papel_acabamento->valor / 100,2);
			}
		}
		return $valor;
	}
	public function calcula_valor_total_relevo_seco($unitario,$qtd){

		return $unitario * $qtd;
	}
	public function calcula_valor_unitario_corte_vinco($qtd){
		$valor = 0;
		if($this->corte_vinco->adicionar == 1 && $this->corte_vinco->cobrar_servico ==1){
			//Legenda: cobrar_serviço é cobrar corte_vinco (O serviço de corte e vinco)
			if($qtd < 100){
				$valor = round($this->corte_vinco->papel_acabamento->valor / $qtd,2);
			}else{
				$valor = round($this->corte_vinco->papel_acabamento->valor / 100,2);
			}
		}
		if($this->corte_vinco->adicionar == 1 && $this->corte_vinco->cobrar_faca_cliche ==1){
			//Legenda: cobrar_faca_cliche é cobrar faca (valor da faca)
			if($qtd < 100){
				$valor += round($this->faca->papel_acabamento->valor / $qtd,2);
			}else{
				$valor += round($this->faca->papel_acabamento->valor / 100,2);
			}
		}
		return $valor;
	}
	public function calcula_valor_total_corte_vinco($unitario,$qtd){

		return $unitario * $qtd;
	}
	public function calcula_valor_unitario_almofada($qtd){
		$valor = 0;
		if($this->almofada->adicionar == 1 && $this->almofada->cobrar_servico ==1){
			//Legenda: cobrar_serviço é cobrar corte_vinco (O serviço de corte e vinco)
			if($qtd < 100){
				$valor = round($this->corte_vinco->papel_acabamento->valor / $qtd,2);
			}else{
				$valor = round($this->corte_vinco->papel_acabamento->valor / 100,2);
			}
		}
		if($this->almofada->adicionar == 1 && $this->almofada->cobrar_faca_cliche ==1){
			//Legenda: cobrar_faca_cliche é cobrar faca (valor da faca)
			if($qtd < 100){
				// TODO O valor aqui pode ser o da faca ou almofada (Verificar qual usar)
				$valor += round($this->almofada->papel_acabamento->valor / $qtd,2);
			}else{
				$valor += round($this->almofada->papel_acabamento->valor / 100,2);
			}
		}
		return $valor;
	}
	public function calcula_valor_total_almofada($unitario,$qtd){

		return $unitario * $qtd;
	}
	private function changeToObject($result_db,$owner) {
		$object_lista = array();
		foreach ($result_db as $key => $value) {
			$object = new Container_papel_m();
			$object->id = $value['id'];
			$object->papel = $this->Papel_m->get_by_id($value['papel']);
			$object->owner = $owner;
			$object->quantidade = $value['quantidade'];
			$object->gramatura = $value['gramatura'];
			$this->set_valor_gramatura($object->papel,$object->gramatura,$value['valor']);

			$object->corte_vinco =  $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'corte_vinco');
			$object->empastamento = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'empastamento');
			$object->laminacao = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'laminacao');
			$object->douracao = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'douracao');
			$object->corte_laser = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'corte_laser');
			$object->relevo_seco = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'relevo_seco');
			$object->almofada = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'almofada');
			$object->faca = $this->Container_papel_acabamento_m->get_by_id($value['id'],$owner,'faca');
			$object_lista[] = $object;
		}
		return $object_lista;
	}
}

/* End of file Container_papel_m.php */
/* Location: ./application/models/Container_papel_m.php */