<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido_m extends CI_Model {

	var $id;
	var $orcamento; //Objeto Orcamento_m()
    var $data;
    var $condicoes; //String Condições de pagamento
    var $cancelado;// Boolean

    var $cliente_conta; //Array Objeto Cliente_conta_m() utilizada na sessão para criar o pedido
    var $cliente_debitos; //Array Objeto Cliente_conta_m() somete debitos
    var $cliente_creditos; //Array Objeto Cliente_conta_m() somente creditos
    var $adicional;// Array de adicionais Adiconal_m()

	// Ajax 
    var $table = 'pedido as ped';
    var $column_order = array('ped.id','ped.data','cli_nome','cli_sobrenome','orc.id','orc.data','orc.data_evento','cli_email','cli_telefone','cli_cpf','cli_cnpj','cli_razao_social','cli_pessoa_tipo','evento_nome','loja_unidade','orc.descricao','ped.condicoes'); //set column field database for datatable orderable
    var $column_search = array('ped.id','orc.id','cli.nome','cli.sobrenome','cli.email','cli.cpf','cli.telefone','cli.cnpj','cli.razao_social','asr.email','date_format(orc.data,"%d/%m/%Y")','date_format(ped.data,"%d/%m/%Y")','date_format(orc.data_evento,"%d/%m/%Y")','evt.nome','loj.unidade'); //set column field database for datatable searchable just nome , descricao are searchable
    var $order = array('ped.id'=>'asc'); // default order 

    private function _get_datatables_query() {
    	$this->db->select(
    		'ped.id as ped_id,
            ped.orcamento as ped_orcamento,
            ped.condicoes as ped_condicoes,
            date_format(ped.data,"%d/%m/%Y") as ped_data');
        //Orcamento
    	$this->db->select(
    		'orc.id as orc_id, 
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
    		'asr.nome  as assessor_nome,
    		asr.sobrenome as assessor_sobrenome, 
    		asr.email as assessor_email');
        //Cliente
    	$this->db->select(
    		'cli.nome as cli_nome,
    		cli.sobrenome as cli_sobrenome,
    		cli.email as cli_email, 
    		cli.telefone as cli_telefone, 
    		cli.cpf as cli_cpf, 
    		cli.razao_social as cli_razao_social, 
    		cli.cnpj as cli_cnpj, 
    		cli.pessoa_tipo as cli_pessoa_tipo');
    	if($this->input->post('ped_id')){
    		$this->db->where('ped.id', $this->input->post('ped_id'));
    	}
    	if($this->input->post('data_pedido')){
    		$this->db->where('date_format(ped.data,"%Y-%m-%d")', $this->__format_date($this->input->post('data_pedido')));
    	}
        if($this->input->post('cli_id')){
            $this->db->where('cli.id', $this->input->post('cli_id'));
        }
        if($this->input->post('cli_nome')){
            $this->db->where('cli.nome', $this->input->post('cli_nome'));
        }
        if($this->input->post('cli_sobrenome')){
            $this->db->like('cli.sobrenome', $this->input->post('cli_sobrenome'));
        }
        if($this->input->post('data_evento')){
            $this->db->where('date_format(orc.data_evento,"%Y-%m-%d")', $this->__format_date($this->input->post('data_evento')));
        }
        if($this->input->post('telefone')){
            $this->db->where('cli.telefone',$this->input->post('telefone'));
        }
        if($this->input->post('email')){
            $this->db->where('cli.email', $this->input->post('email'));
        }
        if($this->input->post('cpf')){
            $this->db->where('cli.cpf',$this->input->post('cpf'));
        }
        if($this->input->post('cnpj')){
            $this->db->where('cli.cnpj',$this->input->post('cnpj'));
        }
        if($this->input->post('razao_social')){
            $this->db->like('cli.razao_social', $this->input->post('razao_social'));
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
    private function __format_date($date){
    	list($dia,$mes,$ano) = explode('/', $date);
    	return $date = $ano.'-'.$mes.'-'.$dia;
    }
    public function get_datatables() {
    	$this->_get_datatables_query();
    	if ($_POST['length'] != -1)
    		$this->db->limit($_POST['length'], $_POST['start']);
    	$this->__join();
    	$query = $this->db->get();
    	return $query->result();
    }
    public function count_filtered() {
    	$this->_get_datatables_query();
    	$this->__join();
    	$query = $this->db->get();
    	return $query->num_rows();
    }
    private function __join(){
    	$this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
    	$this->db->join('cliente as cli', 'orc.cliente = cli.id', 'left');
    	$this->db->join('assessor as asr', 'orc.assessor = asr.id', 'left');
    	$this->db->join('evento as evt', 'orc.evento = evt.id', 'left');
    	$this->db->join('loja as loj', 'orc.loja = loj.id', 'left');
    }
    public function count_all() {
    	$this->db->from($this->table);
    	return $this->db->count_all_results();
    }
    public function inserir(){
    	date_default_timezone_set('America/Sao_Paulo');
    	$dados = array(
    		'id'=>null,
            'orcamento'=>$this->orcamento->id,
            'data'=>date('Y-m-d H:i:s'),
            'condicoes'=>$this->condicoes,
            'cancelado'=>$this->cancelado,
            );
    	if($this->db->insert('pedido',$dados)){
    		$this->id = $this->db->insert_id();
            foreach ($this->cliente_conta as $key => $cliente_conta) {
                $cliente_conta->pedido = $this->id;
                if(!$cliente_conta->inserir()){
                    return false;
                }
            }
            return true;
        }
        return false;
    }
    public function cancelar(){

        $valor_total = 0;

        $dados = array('cancelado'=>1);
        $this->db->where('id',$this->id);
        if(!$this->db->update('pedido',$dados)){
            return false;
        }

        if(!empty($this->orcamento->convite)){
            foreach ($this->orcamento->convite as $key => $convite) {
                if(!$convite->cancelado){
                    $valor_total += ($convite->calcula_total() * (-1));
                    if(!$convite->cancelar($convite->id)){
                        return false;
                    }
                }
            }
        }
        if(!empty($this->orcamento->personalizado)){
            foreach ($this->orcamento->personalizado as $key => $personalizado) {
                if(!$personalizado->cancelado){
                    $valor_total += ($personalizado->calcula_total() * (-1));
                    if(!$personalizado->cancelar($personalizado->id)){
                        return false;
                    }
                }
            }
        }
        if(!empty($this->orcamento->produto)){
            foreach ($this->orcamento->produto as $key => $produto) {
                if(!$produto->cancelado){
                    $valor_total += ($produto->calcula_total() * (-1));
                    if(!$produto->cancelar($produto->id)){
                        return false;
                    }
                }
            }
        }
        return $valor_total;
    }

    //Cancela o adicional caso seja o último ativo do Adicional
    public function verificar_cancelamento_pedido(){
        
        $ativos = 0;

        if(!empty($this->orcamento->convite)){
            foreach ($this->orcamento->convite as $key => $convite) {
                if(!$convite->cancelado){
                    $ativos ++;
                }
            }
        }
        if(!empty($this->orcamento->personalizado)){
            foreach ($this->orcamento->personalizado as $key => $personalizado) {
                if(!$personalizado->cancelado){
                    $ativos ++;
                }
            }
        }
        if(!empty($this->orcamento->produto)){
            foreach ($this->orcamento->produto as $key => $produto) {
                if(!$produto->cancelado){
                    $ativos ++;
                }
            }
        }

        if(!$ativos){
            $dados = array('cancelado'=>1);
            $this->db->where('id',$this->id);
            $this->db->update('pedido',$dados);
        }
    }

    public function get_by_id($id){
    	$this->db->where('id', $id);
    	$this->db->limit(1);
    	$result = $this->db->get('pedido');
    	if($result->num_rows() > 0){
    		$result =  $this->Pedido_m->__changeToObject($result->result_array());
    		return $result[0];
    	}
    	return false;
    }
    public function get_by_id_cliente($id){
        if (empty($id)) {
            return null;
        }
        $this->db->join('orcamento as orc', 'ped.orcamento = orc.id', 'left');
        $this->db->where('orc.cliente', $id);
        $this->db->limit(3);
        $this->db->order_by("ped.id","desc");
        $result = $this->db->get('pedido as ped');
        if($result->num_rows() > 0){
            return  $this->Pedido_m->__changeToObject($result->result_array());
        }
        return false;
    }
    public function calcula_total_debitos(){
        $soma = 0;
        foreach ($this->cliente_debitos as $key => $debito) {
            $soma += $debito->valor;
        }
        if(round($soma,2) == -0){
            return 0.00;
        }
        return $soma;
    }

    public function calcula_total_creditos(){
        $soma = 0;
        foreach ($this->cliente_creditos as $key => $credito) {
            $soma += $credito->valor;
        }
        return $soma;
    }

    public function calcula_saldo() {
        $total =  $this->calcula_total_creditos() - $this->calcula_total_debitos();
        if(round($total,2) == -0){
            return 0.00;
        }
        return $total;
    }
    private function __changeToObject($result_db) {
    	$object_lista = array();
    	foreach ($result_db as $key => $value) {
    		$object = new Pedido_m();
            $object->id = $value['id'];
            $object->orcamento = $this->Orcamento_m->get_by_id($value['orcamento']);
            $object->data = $value['data'];
            $object->condicoes = $value['condicoes'];
            $object->cancelado = $value['cancelado'];
            //$object->cliente_conta = $this->Cliente_conta_m->get_by_pedido($value['id']);
            $object->cliente_debitos = $this->Cliente_conta_m->get_by_pedido($value['id'],true,false);
            $object->cliente_creditos = $this->Cliente_conta_m->get_by_pedido($value['id'],false,false);
            $object->adicional = $this->Adicional_m->get_by_pedido_id($value['id'],$object->orcamento);
            $object_lista[] = $object;
        }
        return $object_lista;
    }
}

/* End of file Pedido_m.php */
/* Location: ./application/models/Pedido_m.php */