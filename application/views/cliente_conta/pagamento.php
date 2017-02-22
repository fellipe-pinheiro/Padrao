<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$debitos = $dados['pedido_debitos'];
$creditos = $dados['pedido_creditos'];
$cliente = $dados['cliente'];
$adicionais = $dados['adicional'];
$pedido_id = $dados['numero_pedido'];
?>
<div class="row" id="panel_resumo">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Pedido Nº <?=$pedido_id?>
				<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<!-- Cliente -->
					<div class="col-md-6">
						<div class="table-responsive">
							<caption><h4>Cliente</h4></caption>
							<table class="table table-hover table-condensed">
								<tbody>
									<tr>
										<td><strong>ID</strong></td>
										<td><?=$cliente->id?></td>
									</tr>
									<tr>
										<td><strong>Nome</strong></td>
										<td><?=$cliente->nome?> <?=$cliente->sobrenome?></td>
									</tr>
									<tr>
										<td><strong>Email</strong></td>
										<td><?=$cliente->email?></td>
									</tr>
									<tr>
										<td><strong>Telefone</strong></td>
										<td><?=$cliente->telefone?></td>
									</tr>
									<tr>
										<td><strong>CPF</strong></td>
										<td><?=$cliente->cpf?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Saldo geral -->
					<div class="col-md-6">
						<div class="table-responsive">
							<caption><h4>Resumo Geral</h4></caption>
							<table class="table table-hover table-condensed">
								<tbody>
									<tr>
										<td><strong>Débitos</strong></td>
										<td>R$ <?=number_format($dados['sub_total_debitos'],2,',','.')?></td>
									</tr>
									<tr>
										<td><strong>Créditos</strong></td>
										<td>R$ <?=number_format($dados['sub_total_creditos'],2,',','.')?></td>
									</tr>
									<tr>
										<td><strong>Saldo</strong></td>
										<td>R$ <?=number_format($dados['saldo_total'],2,',','.')?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="panel_credito_debito">
	<div class="col-md-12">
		<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist" id="tab-indice">
				<li role="presentation" class="active">
					<a href="#pedido" aria-controls="pedido" role="tab" data-toggle="tab">Pedido N° <?=$pedido_id?></a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active row" id="pedido">
					<!-- Saldo -->
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">Saldo Pedido N° <?=$pedido_id?>
								<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover table-condensed">
										<tbody>
											<tr>
												<td><strong>Total de débitos</strong></td>
												<td>R$ <?=number_format($dados['total_debitos_pedido'],2,',','.')?></td>
												<td></td>
											</tr>
											<tr>
												<td><strong>Total de créditos</strong></td>
												<td>R$ <?=number_format($dados['total_creditos_pedido'],2,',','.')?></td>
												<td></td>
											</tr>
											<tr>
												<td><strong>Saldo</strong></td>
												<td class="td-saldo_geral" id="td-saldo_geral-<?=$pedido_id?>">R$ <?=number_format($dados['saldo_pedido'],2,',','.')?></td>
												<td><button onclick="modal_quitar_parcelas('pedido',<?=$pedido_id?>,<?=$dados['saldo_pedido']?>)" class="btn btn-default btn-sm">Quitar</button></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Débitos -->
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Débitos</h3>
							</div>
							<div class="panel-body">
								<div class="table-responsive row">
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th></th>
												<th>Lançamento</th>
												<th>Vencimento</th>
												<th>Pagamento</th>
												<th>Valor</th>
												<th>Pagar</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (!empty($debitos)) {
												foreach ($debitos as $key => $debito) {
													//verifica se a parcela já está paga
													$soma = 0;
													if(!empty($creditos)){
														foreach ($creditos as $key2 => $credito) {
															if($credito->debito_referencia === $debito->id){
																$soma += $credito->valor; 
															}
														}
													}
													if(round($soma, 2) == round($debito->valor, 2)) {
														$btn_class = "disabled";
														$btn_text = "Pago";
														$tr_class = "success";
													}else{
														$btn_class = "";
														$btn_text = "Pagar";
														$tr_class = "";
													}

													$today = date('Y/m/d');
													if(!empty($debito->vencimento) && strtotime($debito->vencimento) < strtotime($today) && round($soma, 2) != round($debito->valor, 2)) {
														$tr_class = "warning";
													}
													if($debito->cancelado){
														$tr_class = "active";
													}


													if(empty($debito->vencimento)){
														$vencimento = "";	
													}else{
														list($ano, $mes, $dia) = explode("-", $debito->vencimento);
														$vencimento = $dia."/".$mes."/".$ano;
													}

													list($ano, $mes, $dia) = explode("-", $debito->data);
													$data = $dia."/".$mes."/".$ano;
													?>

													<tr class="<?=$tr_class?>">
														<td onclick="show_datails('dt-pedido-<?=$pedido_id?>-debito-<?=$key?>')">
															<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
														</td>
														<td><?=$debito->id?></td>
														<td><?=$vencimento?></td>
														<td><?=$debito->forma_pagamento->nome?></td>
														<td>R$ <?=number_format($debito->valor,2,',','.')?></td>
														<td>
															<?php
															if(!$debito->cancelado){
																?>
																<button onclick="show_modal_pagamento('pedido', <?=$debito->id?>, <?=$dados['saldo_pedido']?>, <?=$debito->pedido?>)" class="btn btn-default btn-sm" <?=$btn_class?>><?=$btn_text?>
																</button>
																<?php
															}
															?>
														</td>
														<tr class="hidden" id="dt-pedido-<?=$pedido_id?>-debito-<?=$key?>">
															<td colspan="6">
																<strong>Data Lançamento:</strong> <?=$data?><br>
																<strong>Descrição:</strong> <?=$debito->descricao?>
															</td>
														</tr>
													</tr>
													<?php
												}
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th>R$ <?=number_format($dados['total_debitos_pedido'],2,',','.')?></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- Créditos -->
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Créditos</h3>
							</div>
							<div class="panel-body">
								<div class="table-responsive row">
									<table class="table table-condensed table-hover">
										<thead>
											<tr>
												<th></th>
												<th>Data</th>
												<th>Pagamento</th>
												<th>Valor</th>
												<th>Excluir</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (!empty($creditos)) {
												foreach ($creditos as $key => $credito) {
													list($ano, $mes, $dia) = explode("-", $credito->data);
													$data = $dia."/".$mes."/".$ano;
													?>
													<tr>
														<td onclick="show_datails('dt-pedido-<?=$pedido_id?>-credito-<?=$key?>')">
															<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
														</td>
														<td><?=$data?></td>
														<td><?=$credito->forma_pagamento->nome?></td>
														<td>R$ <?=number_format($credito->valor,2,',','.')?></td>
														<td><button onclick="excluir_credito(<?=$credito->id?>)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></button></td>
													</tr>
													<tr class="hidden" id="dt-pedido-<?=$pedido_id?>-credito-<?=$key?>">
														<td colspan="5">
															<strong>Descrição:</strong> <?=$credito->descricao?><br>
															<strong>Cód Bancário/ N° Recibo:</strong> <?=$credito->codigo_bancario?>
														</td>
													</tr>
													<?php
												}
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th>R$ <?=number_format($dados['total_creditos_pedido'],2,',','.')?></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				if(!empty($adicionais)){
					foreach ($adicionais as $key => $adicional) {
						?>
						<script>
							var a1 = $('<a href="#adicional-<?=$adicional->id?>" aria-controls="adicional-<?=$adicional->id?>" role="tab" data-toggle="tab" >').html("<?=$adicional->get_numero_documento()?>");
							var li1 = $('<li role="presentation" />').html(a1);
							li1.appendTo("#tab-indice");
						</script>
						<div role="tabpanel" class="tab-pane row" id="adicional-<?=$adicional->id?>">
							<!-- Saldo -->
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Saldo <?=$adicional->get_numero_documento()?>
										<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-hover table-condensed">
												<tbody>
													<tr>
														<td><strong>Total de débitos</strong></td>
														<td>R$ <?=number_format($adicional->calcula_total_debitos(),2,',','.')?></td>
														<td></td>
													</tr>
													<tr>
														<td><strong>Total de créditos</strong></td>
														<td>R$ <?=number_format($adicional->calcula_total_creditos(),2,',','.')?></td>
														<td></td>
													</tr>
													<tr>
														<td><strong>Saldo</strong></td>
														<td class="td-saldo_geral" id="td-saldo_geral-<?=$pedido_id?>-<?=$adicional->id?>">R$ <?=number_format($adicional->calcula_saldo(),2,',','.')?></td>
														<td><button onclick="modal_quitar_parcelas('adicional',<?=$adicional->id?>,<?=$adicional->calcula_saldo()?>)" class="btn btn-default btn-sm">Quitar</button></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- Débitos -->
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Débitos</h3>
									</div>
									<div class="panel-body">
										<div class="table-responsive row">
											<table class="table table-hover table-condensed">
												<thead>
													<tr>
														<th></th>
														<th>Lançamento</th>
														<th>vencimento</th>
														<th>Pagamento</th>
														<th>Valor</th>
														<th>Pagar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (!empty($adicional->cliente_debitos)) {
														foreach ($adicional->cliente_debitos as $key => $debito) {
														//verifica se a parcela já está paga
															$soma = 0;
															if(!empty($adicional->cliente_creditos)){
																foreach ($adicional->cliente_creditos as $key2 => $credito) {
																	if($credito->debito_referencia === $debito->id){
																		$soma += $credito->valor; 
																	}
																}
															}
															if(round($soma, 2) == round($debito->valor, 2)) {
																$btn_class = "disabled";
																$btn_text = "Pago";
																$tr_class = "success";
															}else{
																$btn_class = "";
																$btn_text = "Pagar";
																$tr_class = "";
															}

															$today = date('Y/m/d');
															if(!empty($debito->vencimento) && strtotime($debito->vencimento) < strtotime($today) && round($soma, 2) != round($debito->valor, 2)) {
																$tr_class = "warning";
															}
															if($debito->cancelado){
																$tr_class = "active";
															}

															if(empty($debito->vencimento)){
																$vencimento = "";	
															}else{
																list($ano, $mes, $dia) = explode("-", $debito->vencimento);
																$vencimento = $dia."/".$mes."/".$ano;
															}

															list($ano, $mes, $dia) = explode("-", $debito->data);
															$data = $dia."/".$mes."/".$ano;
															?>

															<tr class="<?=$tr_class?>">
																<td onclick="show_datails('dt-adicional-<?=$adicional->id?>-debito-<?=$key?>')">
																	<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
																</td>
																<td><?=$debito->id?></td>
																<td><?=$vencimento?></td>
																<td><?=$debito->forma_pagamento->nome?></td>
																<td>R$ <?=number_format($debito->valor,2,',','.')?></td>
																<td>
																	<?php
																	if(!$debito->cancelado){
																		?>
																		<button onclick="show_modal_pagamento('adicional',<?=$debito->id?>,<?=$adicional->calcula_saldo()?>,<?=$adicional->id?>)" class="btn btn-default btn-sm" <?=$btn_class?>><?=$btn_text?>
																		</button>
																		<?php
																	}
																	?>
																</td>
																<tr class="hidden" id="dt-adicional-<?=$adicional->id?>-debito-<?=$key?>">
																	<td colspan="6">
																		<strong>Data Lançamento:</strong> <?=$data?><br>
																		<strong>Descrição:</strong> <?=$debito->descricao?>
																	</td>
																</tr>
															</tr>
															<?php
														}
													}
													?>
												</tbody>
												<tfoot>
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th>R$ <?=number_format($adicional->calcula_total_debitos(),2,',','.')?></th>
														<th></th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- Créditos -->
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Créditos</h3>
									</div>
									<div class="panel-body">
										<div class="table-responsive row">
											<table class="table table-condensed table-hover">
												<thead>
													<tr>
														<th></th>
														<th>Data</th>
														<th>Pagamento</th>
														<th>Valor</th>
														<th>Excluir</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (!empty($adicional->cliente_creditos)) {
														foreach ($adicional->cliente_creditos as $key => $credito) {
															list($ano, $mes, $dia) = explode("-", $credito->data);
															$data = $dia."/".$mes."/".$ano;
															?>
															<tr>
																<td onclick="show_datails('dt-adicional-<?=$adicional->id?>-credito-<?=$key?>')">
																	<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
																</td>
																<td><?=$data?></td>
																<td><?=$credito->forma_pagamento->nome?></td>
																<td>R$ <?=number_format($credito->valor,2,',','.')?></td>
																<td><button onclick="excluir_credito(<?=$credito->id?>)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></button></td>
															</tr>
															<tr class="hidden" id="dt-adicional-<?=$adicional->id?>-credito-<?=$key?>">
																<td colspan="5">
																	<strong>Descrição:</strong> <?=$credito->descricao?><br>
																	<strong>Cód Bancário/ N° Recibo:</strong> <?=$credito->codigo_bancario?>
																</td>
															</tr>
															<?php
														}
													}
													?>
												</tbody>
												<tfoot>
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th>R$ <?=number_format($adicional->calcula_total_creditos(),2,',','.')?></th>
														<th></th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="md_form_pagamento">
	<form id="form_pagamento" class="form" method="POST" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Efetuar Pagamento</h4>
				</div>
				<div class="modal-body row">
					<?= form_hidden('data') ?>
					<!--Id do documento-->
					<div class="form-group">
						<?= form_label('*ID: ', 'id', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input name="id" id="id" class="form-control" readonly/>
							<span class="help-block"></span>
						</div>
					</div>
					<!--Pedido / Adicional ID-->
					<div class="form-group">
						<label for="pagamento_numero_documento" id="pagamento_label_numero_documento" class="control-label col-sm-4">Pedido Nº</label>
						<div class="col-sm-8">
							<input name="pagamento_numero_documento" id="pagamento_numero_documento" class="form-control" readonly />
							<span class="help-block"></span>
						</div>
					</div>
					<!--Descrição-->
					<div class="form-group">
						<?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input name="descricao" id="descricao" class="form-control" placeholder="Descrição" readonly />
							<span class="help-block"></span>
						</div>
					</div>
					<!--Valor do documento-->
					<div class="form-group">
						<?= form_label('*Valor do documento: ', 'valor', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input name="valor" id="valor" class="form-control" placeholder="valor" readonly />
							<span class="help-block"></span>
						</div>
					</div>
					<!--Data vencimento-->
					<div class="form-group">
						<?= form_label('*Data vencimento: ', 'vencimento', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input type="date" name="vencimento" id="vencimento" class="form-control" placeholder="vencimento" readonly>
							<span class="help-block"></span>
						</div>
					</div>
					<!--Data pagamento-->
					<div class="form-group">
						<?= form_label('*Data pagamento: ', 'data_pagamento', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input type="text" name="data_pagamento" id="data_pagamento" class="form-control datetimepicker" placeholder="Data pagamento" value="<?=date("d/m/Y")?>">
							<span class="help-block"></span>
						</div>
					</div>
					<!--Forma pagamento-->
					<div class="form-group">
						<?= form_label('*Forma de pagamento: ', 'forma_pagamento', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<select name="forma_pagamento" id="forma_pagamento" class="form-control">
								<option value="" selected disabled="true">Selecione</option>
								<?php 
								foreach ($dados['forma_pagamento'] as $key => $forma_pagamento) {
									?>
									<option value="<?=$forma_pagamento->id?>"><?=$forma_pagamento->nome?></option>
									<?php
								}
								?>
							</select>
							<span class="help-block"></span>
						</div>
					</div>
					<!--Código Bancário-->
					<div class="form-group">
						<?= form_label('Código Bancário / recibo: ', 'codigo_bancario', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<?= form_textarea(array('name'=>'codigo_bancario','rows'=>'4','id'=>'codigo_bancario', 'class'=>'form-control', 'placeholder'=>'Código Bancário ou número do recibo')) ?>
							<span class="help-block"></span>
						</div>
					</div>
					<!--Valor pagamento-->
					<div class="form-group">
						<?= form_label('*Valor pagamento: ', 'valor_pagamento', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input type="number" step="0.01" min="0.00" value="" name="valor_pagamento" id="valor_pagamento" class="form-control" placeholder="Valor pagamento" autofocus="true" />
							<span class="help-block"></span>
							<p id="info_valor_pagamento"></p>
						</div>
					</div>
				</div>  
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-default btnSubmit" id="btnSubmit_form_pagamento">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal fade" id="md_form_quitacao">
	<form id="form_quitacao" class="form" method="POST" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Quitar parcelas</h4>
				</div>
				<div class="modal-body row">
					<input type="hidden" name="quitacao_owner" id="quitacao_owner" class="form-control" value="">
					<!--Pedido / Adicional ID-->
					<div class="form-group">
						<label for="quitacao_numero_documento" id="quitacao_label_numero_documento" class="control-label col-sm-4">Pedido Nº</label>
						<div class="col-sm-8">
							<input name="id" id="quitacao_numero_documento" class="form-control" readonly />
							<span class="help-block"></span>
						</div>
					</div>
					<!--Valor restante-->
					<div class="form-group">
						<?= form_label('*Valor restante: ', 'quitacao_valor', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input name="valor" id="quitacao_valor" class="form-control" readonly />
							<span class="help-block"></span>
						</div>
					</div>
					<!--Data pagamento-->
					<div class="form-group">
						<?= form_label('*Data pagamento: ', 'quitacao_data_pagamento', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<input type="text" name="data_pagamento" id="quitacao_data_pagamento" class="form-control datetimepicker" placeholder="Data pagamento" value="<?=date('d/m/Y')?>">
							<span class="help-block"></span>
						</div>
					</div>
					<!--Forma pagamento-->
					<div class="form-group">
						<?= form_label('*Forma de pagamento: ', 'quitacao_forma_pagamento', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<select name="forma_pagamento" id="quitacao_forma_pagamento" class="form-control">
								<option value="" selected>Selecione</option>
								<?php 
								foreach ($dados['forma_pagamento'] as $key => $forma_pagamento) {
									?>
									<option value="<?=$forma_pagamento->id?>"><?=$forma_pagamento->nome?></option>
									<?php
								}
								?>
							</select>
							<span class="help-block"></span>
						</div>
					</div>
					<!--Código Bancário-->
					<div class="form-group">
						<?= form_label('Código Bancário / recibo: ', 'quitacao_codigo_bancario', array('class' => 'control-label col-sm-4')) ?>
						<div class="col-sm-8">
							<?= form_textarea(array('name'=>'codigo_bancario','rows'=>'4','id'=>'quitacao_codigo_bancario', 'class'=>'form-control', 'placeholder'=>'Código Bancário ou número do recibo')) ?>
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-default btnSubmit" id="btn_md_form_quitacao">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<style>
	.tab-pane{
		margin-top: 30px;
	}
</style>
<script type="text/javascript">
	var pedido_id = <?=$pedido_id?>;

	$(document).ready(function() {
		sinalizar_quitado();
	});

	function modal_quitar_parcelas(owner,id,saldo) {
		reset_forms();
		if(owner === 'pedido'){
			if(saldo >= 0){
				$.alert('O Pedido N° ' + id + ' já está quitado.');
				return false;
			}
			$('#btn_md_form_quitacao').attr("onclick", "quitar_parcelas(" + id + ", 'pedido')");
			$("#quitacao_label_numero_documento").text('Pedido');
			$("#quitacao_owner").val('pedido');
		}else if(owner === 'adicional'){
			if(saldo >= 0){
				$.alert('O Adicional N° ' + id + ' já está quitado.');
				return false;
			}
			$('#btn_md_form_quitacao').attr("onclick", "quitar_parcelas(" + id + ", 'adicional')");
			$("#quitacao_label_numero_documento").text('Adicional');
			$("#quitacao_owner").val('adicional');
		}

		saldo = parseFloat(saldo * (-1)).toFixed(2);
		saldo = saldo.replace(".",",");
		$("#quitacao_numero_documento").val(id);
		$("#quitacao_valor").val(saldo);
		$("#md_form_quitacao").modal();
	}
	function quitar_parcelas(id,owner) {
		reset_errors_validation();
		disable_button_salvar();
		$.confirm({
			title: 'Atenção!',
			content: 'Deseja realmente quitar todas as parcelas do ' + owner + ' N° ' + id,
			confirmButton: 'Sim',
			cancelButton: 'Não',
			confirm: function(){
				$.ajax({
					url: '<?=base_url('cliente_conta/ajax_quitar_parcelas')?>',
					type: 'POST',
					dataType: 'JSON',
					data: $("#form_quitacao").serialize(),
				})
				.done(function(data) {
					console.log("success");
					if(data.status){
						$.alert('Parcelas quitadas com sucesso!');
						$("#md_form_quitacao").modal('hide');
						atualizar();
					}else{
						$.map(data.form_validation, function (value, index) {
							$('[name="' + index + '"]').parent().parent().addClass('has-error');
							$('[name="' + index + '"]').next().text(value);
						});
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					enable_button_salvar();
					console.log("complete");
				});
				
			},
			cancel: function(){
				$.alert('Ação cancelada');
				enable_button_salvar();
				$("#md_form_quitacao").modal('hide');
			}
		});
	}
	function show_modal_pagamento(owner,id,saldo,owner_id) {
		reset_errors_validation();
		reset_forms();
		if(owner === 'pedido'){
			$("#pagamento_label_numero_documento").text('Pedido N°');
			if(saldo >= 0){
				$.alert('O Pedido N° ' + owner_id + ' já está quitado.');
				return false;
			}
		}else if(owner === 'adicional'){
			$("#pagamento_label_numero_documento").text('Adicional N°');
			if(saldo >= 0){
				$.alert('O Adicional ' + owner_id + ' já está quitado.');
				return false;
			}
		}
		$("#pagamento_numero_documento").val(owner_id);
		$.ajax({
			url: '<?=base_url('cliente_conta/ajax_edit/')?>'+id,
			type: 'POST',
			dataType: 'JSON'
		})
		.done(function(data) {
			console.log("success");
			if(data.status){
				$.map(data.debito, function (value, index) {
					if(index === 'valor'){
						value = parseFloat(value).toFixed(2);
					}
					if($('[name="' + index + '"]').is("input, textarea")){
						$('[name="' + index + '"]').val(value);
					}else if($('[name="' + index + '"]').is("select")){
						$('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
					};
				});
				$("#info_valor_pagamento").text(" Restam R$ " + parseFloat(data.valor_restante).toFixed(2) + " para completar o pagamento da parcela").prepend("<span class='glyphicon glyphicon-info-sign'></span>");
				$("#valor_pagamento").val(parseFloat(data.valor_restante).toFixed(2));
				$('#md_form_pagamento').modal('show');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
	function excluir_credito(id) {
		$.confirm({
			title: 'Confirme!',
			content: 'Deseja realmente excluir este registro?',
			confirmButton: 'Excluir',
			confirm: function () {
				$.ajax({
					url: '<?=base_url('cliente_conta/ajax_excluir_pagamento')?>',
					type: 'POST',
					dataType: 'json',
					data: {id: id},
				})
				.done(function(data) {
					console.log("success");
					if(data.status){
						atualizar();
						$.alert({
							title: "Sucesso!",
							content: "Registro excluido com sucesso!"
						});
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

			},
			cancel: function () {
				$.alert('Cancelado!');
			}
		});
	}
	$("#btnSubmit_form_pagamento").click(function (e) {
		reset_errors_validation();
		disable_button_salvar();
		$.ajax({
			url: '<?=base_url('cliente_conta/ajax_efetuar_pagamento')?>',
			type: 'POST',
			dataType: 'JSON',
			data: $('#form_pagamento').serialize(),
		})
		.done(function(data) {
			console.log("success");
			if (data.status)
			{
				atualizar();
				$('#md_form_pagamento').modal('hide');
			}
			else
			{
				$.map(data.form_validation, function (value, index) {
					$('[name="' + index + '"]').parent().parent().addClass('has-error');
					$('[name="' + index + '"]').next().text(value);
				});
			}
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			console.log("error");
			$.alert({
				title: 'Alerta!',
				content: 'Não foi possível Adicionar ou Editar o registro. Tente novamente.',
			});
		})
		.always(function() {
			console.log("complete");
			enable_button_salvar();
		});
		e.preventDefault();
	});
	function reset_errors_validation() {
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
	}
	function reset_forms() {
		$.each($('.form'), function( index, value ) {
			value.reset();
		});
	}
	function disable_button_salvar(){
		$('.btnSubmit').text('Salvando...');
		$('.btnSubmit').attr('disabled', true);
	}
	function enable_button_salvar() {
		$('.btnSubmit').text('Salvar');
		$('.btnSubmit').attr('disabled', false);
	}
	function atualizar() {
		call_loadingModal('Atualizando dados...');
		console.log("Função: atualizar()");
		$.ajax({
			url: '<?=base_url('cliente_conta/pagamento/')?>'+pedido_id,
			type: 'POST',
			dataType: 'html',
		})
		.done(function(data) {
			console.log("success: atualizar()");
			hash = $('#tab-indice li.active').children()[0].hash;
			$('#panel_resumo').html($('#panel_resumo' , data).html());
			$('#panel_credito_debito').html($('#panel_credito_debito' , data).html());
			$("#tab-indice a[href='"+hash+"']").tab('show');
		})
		.fail(function() {
			console.log("error: atualizar()");
		})
		.always(function(data) {
			$('.form')[0].reset();
			close_loadingModal();
			sinalizar_quitado();
			console.log("complete: atualizar()");
		});	
	}
	function call_loadingModal(msg=""){
		if(msg ===""){
			msg = "Processando os dados..."
		}
		$('body').loadingModal({
			position: 'auto',
			text: msg,
			color: '#fff',
			opacity: '0.7',
			backgroundColor: 'rgb(0,0,0)',
			animation: 'threeBounce'
		});
	}
	function close_loadingModal() {
		// hide the loading modal
		$('body').loadingModal('hide');
		// destroy the plugin
		$('body').loadingModal('destroy');
	}
	function sinalizar_quitado() {
		$('.td-saldo_geral').each(function(index, el) {
			a_id = $($("#"+el.id)[0]).closest(".tab-pane")[0].id;
			if(numberFormat($("#"+el.id)[0].innerText) < 0){
				$("a[href$='#"+a_id+"']").css("color", "#d9534f");
			}else{
				$("a[href$='#"+a_id+"']").css("color", "#5cb85c");
			}
		});
	}
</script>