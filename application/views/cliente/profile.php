<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$cliente = $dados['cliente'];
$pedidos = $dados['pedidos'];
$adicionais = empty($dados['adicionais'])? $adicionais = array() : $adicionais = $dados['adicionais'];
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Cliente</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<caption><h4>Dados pessoais</h4></caption>
								<table class="table table-hover table-condensed table-user-information">
									<tbody>
										<tr>
											<td>ID</td>
											<td><?=$cliente->id?></td>
										</tr>
										<tr>
											<td>Pessoa</td>
											<td><?=$cliente->pessoa_tipo?></td>
										</tr>
										<tr>
											<td>Nome</td>
											<td><?=$cliente->nome?> <?=$cliente->sobrenome?></td>
										</tr>
										<tr>
											<td>Email</td>
											<td><?=$cliente->email?></td>
										</tr>
										<tr>
											<td>Telefone</td>
											<td><?=$cliente->telefone?></td>
										</tr>
										<tr>
											<td>RG</td>
											<td><?=$cliente->rg?></td>
										</tr>
										<tr>
											<td>CPF</td>
											<td><?=$cliente->cpf?></td>
										</tr>
									</tbody>
								</table>
								<caption><h4>Contato</h4></caption>
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>Nome</td>
											<td><?=$cliente->nome2?></td>
										</tr>
										<tr>
											<td>Email</td>
											<td><?=$cliente->email2?></td>
										</tr>
										<tr>
											<td>Telefone</td>
											<td><?=$cliente->telefone2?></td>
										</tr>
									</tbody>
								</table>
								<caption><h4>Endereço</h4></caption>
								<table class="table table-hover table-condensed table-user-information">
									<tbody>
										<tr>
											<td>Logradouro</td>
											<td><?=$cliente->endereco?>, <?=$cliente->numero?></td>
										</tr>
										<tr>
											<td>Complemento</td>
											<td><?=$cliente->complemento?></td>
										</tr>
										<tr>
											<td>Bairro</td>
											<td><?=$cliente->bairro?></td>
										</tr>
										<tr>
											<td>Cidade</td>
											<td><?=$cliente->cidade?></td>
										</tr>
										<tr>
											<td>Estado</td>
											<td><?=$cliente->estado?> - <?=$cliente->uf?></td>
										</tr>
										<tr>
											<td>CEP</td>
											<td><?=$cliente->cep?></td>
										</tr>
									</tbody>
								</table>
								<caption><h4>Empresa</h4></caption>
								<table class="table table-hover table-condensed table-user-information">
									<tbody>
										<tr>
											<td>Razão Social</td>
											<td><?=$cliente->razao_social?></td>
										</tr>
										<tr>
											<td>CNPJ</td>
											<td><?=$cliente->cnpj?></td>
										</tr>
										<tr>
											<td>Inscrição Estadual</td>
											<td><?=$cliente->ie?></td>
										</tr>
										<tr>
											<td>Inscrição Municipal</td>
											<td><?=$cliente->im?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-info">
				<div class="panel-heading">Pedidos 
					<span class="badge"><?=count($pedidos)?></span>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="pedido" class="table table-hover table-condensed" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Pedido Nº</th>
											<th>Data Evento</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($pedidos as $key => $pedido) {
											?>
											<tr>
												<td><?=$pedido->ped_id?></td>
												<td><?=$pedido->ped_data?></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
															Ações
															<span class="caret"></span>
														</button>
														<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															<li>
																<a href="<?=base_url('pedido/pdf/'.$pedido->ped_id)?>" target="__blank">PDF</a>
															</li>
															<li>
																<a href="<?=base_url('cliente_conta/pagamento/'.$pedido->ped_id)?>">Pagamento</a>
															</li>
															<li>
																<a href="<?=base_url('pedido/editar/'.$pedido->ped_id)?>">Alterar</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">Adicionais <span class="badge"><?=count($adicionais)?></span>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="adicional" class="table table-hover table-condensed" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th class="th_search">Adicional Nº</th>
											<th class="th_search">Data</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($adicionais as $key => $adicional) {
											?>
											<tr>
												<td><?=$adicional->adc_pedido?>/<?=$adicional->adc_id?></td>
												<td><?=$adicional->adc_data?></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
															Ações
															<span class="caret"></span>
														</button>
														<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															<li>
																<a href="<?=base_url('adicional/pdf/'.$adicional->adc_id)?>" target="__blank">PDF</a>
															</li>
															<li>
																<a href="<?=base_url('cliente_conta/pagamento/'.$adicional->adc_pedido)?>">Pagamento</a>
															</li>
															<li>
																<a href="<?=base_url('pedido/editar/'.$adicional->adc_pedido)?>">Alterar</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<style>
	.table-user-information > tbody > tr:first-child {
		border-top: 0;
	}
	.dataTables_filter {
		display: none; 
	}
	.input_search{
		max-width: 120px;
	}
</style>
<script>
	$(document).ready(function() {
		//Pedido DataTable
		$('#pedido').DataTable( {
			"paging":   true,
			"ordering": false,
			"info":     true,
		} );

		$('#pedido thead th').each( function (index) {
			var title = $(this).text();
			if(index != 2){
				$(this).html( '<input class="form-control input-sm input_search_pedido input_search" type="text" placeholder="'+title+'" />' );
			}
		} );

		var tabela_pedido = $('#pedido').DataTable();

		tabela_pedido.columns().every( function () {
			var that = this;

			$( '.input_search_pedido', this.header() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
					.search( this.value )
					.draw();
				}
			} );
		} );

		//Adicional DataTable
		$('#adicional').DataTable( {
			"paging":   true,
			"ordering": false,
			"info":     true,
		} );

		$('#adicional thead th').each( function (index) {
			var title = $(this).text();
			if(index != 2){
				$(this).html( '<input class="form-control input-sm input_search_adicional input_search" type="text" placeholder="'+title+'" />' );
			}
		} );

		var tabela_adicional = $('#adicional').DataTable();

		tabela_adicional.columns().every( function () {
			var that = this;

			$( '.input_search_adicional', this.header() ).on( 'keyup change', function () {
				if ( that.search() !== this.value ) {
					that
					.search( this.value )
					.draw();
				}
			} );
		} );
	} );
</script>