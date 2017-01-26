<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row" id="painel_principal">
	<!-- Carrinho -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Orçamento</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-2">
				<div class="btn-group-vertical" role="group" aria-label="...">
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="glyphicon glyphicon-cog"></i> Opções
							<span class="caret" ></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<?php 
							empty($this->session->orcamento->descricao)? $descricao = '': $descricao = $this->session->orcamento->descricao;
							empty($this->session->orcamento->desconto)? $desconto = "''": $desconto = $this->session->orcamento->desconto;
							$pedido = $this->session->pedido;
							?>
							<li class="dropdown-header">Orçamento</li>
							<li><a onclick="orcamento_modal('novo')" href="javascript:void(0)"><i class="glyphicon glyphicon-plus"></i> Novo</a></li>
							<li><a onclick="orcamento_modal('excluir')" href="javascript:void(0)"><i class="glyphicon glyphicon-erase"></i> Limpar</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Opções do orçamento</li>
							<li><a onclick="orcamento_cliente('Clientes')" href="javascript:void(0)"><i class="glyphicon glyphicon-user"></i> Cliente</a></li>
							<li><a onclick="orcamento_assessor('inserir','Assessores')" href="javascript:void(0)"><i class="glyphicon glyphicon-user"></i> Assessor</a></li>
							<li><a onclick="orcamento_desconto('inserir',<?=$desconto?>)" href="javascript:void(0)"><i class="glyphicon glyphicon-piggy-bank"></i> Desconto</a></li>

							<li><a data-toggle="modal" href='#md_calendario'><span class="glyphicon glyphicon-calendar"></span> Calendário</a></li>
							<li role="separator" class="divider"></li>
							<li><a onclick="criar_orcamento()" href="javascript:void(0)"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar como orçamento</a></li>
							<li><a onclick="criar_pedido()" href="javascript:void(0)"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar como pedido</a></li>
						</ul>
					</div>
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							Produtos
							<span class="caret" ></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?=base_url('convite')?>"><i class="glyphicon glyphicon-plus"></i> Convite</a></li>
							<li><a href="<?=base_url('personalizado')?>"><i class="glyphicon glyphicon-plus"></i> Personalizado</a></li>
							<li><a onclick="produto_modal('inserir','','','','','')" href="javascript:void(0)"><i class="glyphicon glyphicon-plus"></i> Produto</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-sm-1">
						<button onclick="session_orcamento_info()" type="button" class="btn btn-default pull-right" style="margin-top: 20px"><i class="glyphicon glyphicon-info-sign"></i></button>
					</div>
					<div class="col-sm-3">
						<?= form_label('Cliente: ', '', array('class' => 'control-label')) ?>
						<?= form_input('', $this->session->orcamento->cliente->nome . ' '. $this->session->orcamento->cliente->sobrenome, 'id="" readonly class="form-control input-sm"') ?>
					</div>
					<div class="col-sm-3">
						<?= form_label('E-mail:', '', array('class' => 'control-label')) ?>
						<?= form_input('', $this->session->orcamento->cliente->email, 'readonly class="form-control input-sm"') ?>
					</div>
					<div class="col-sm-2">
						<?= form_label('Assessor(a): ', '', array('class' => 'control-label')) ?>
						<?= form_input('', $this->session->orcamento->assessor->nome . ' '. $this->session->orcamento->assessor->sobrenome, 'id="" readonly class="form-control input-sm"') ?>
					</div>
					<div class="col-sm-3">
						<?= form_label('E-mail: ', '', array('class' => 'control-label')) ?>
						<?= form_input('', $this->session->orcamento->assessor->email, 'id="" readonly class="form-control input-sm"') ?>
					</div>
				</div>
				<br>
				<div class="table-responsive">
					<table class="table table-hover table-condensed">
						<tr>
							<th>#</th>
							<th>Categoria</th>
							<th>Produto</th>
							<th class="data_entrega">Data Entrega</th>
							<th>Qtd</th>
							<th>Unitário</th>
							<th>Sub-total</th>
							<th>Editar</th>
							<th>Excluir</th>
						</tr>
						<tbody>
							<?php
							$count = 1;
							//CONVITES
							foreach ($this->session->orcamento->convite as $key => $convite) {
								?>
								<tr>
									<td><?=$count?></td>
									<td>Convite</td>
									<td><?=$convite->modelo->nome?></td>
									<td class="data_entrega form-group">
										<form id="convite-<?=$key?>">
											<input onchange="delivery_date('convite','#convite-<?=$key?>')" type="text" name="data_entrega-convite-<?=$key?>" class="form-control input-sm date" value="<?=$convite->data_entrega?>" placeholder="dd/mm/yyyy">
											<span class="help-block"></span>
											<input type="hidden" name="posicao" id="posicao-<?=$key?>" class="form-control" value="<?=$key?>">
										</form>
									</td>
									<td><?=$convite->quantidade?></td>
									<td>R$ <span class="pull-right"><?=number_format($convite->calcula_unitario(),2,',','.')?></span></td>
									<td>R$ <span class="pull-right"><?=number_format($convite->calcula_total(),2,',','.')?></span></td>
									<td><a href="<?=base_url('convite/session_orcamento_convite_editar/'.$key)?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a onclick="convite_excluir_posicao(<?=$key?>)" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php
								$count ++;
							}
							//PERSONALIZADOS
							foreach ($this->session->orcamento->personalizado as $key => $personalizado) {
								?>
								<tr>
									<td><?=$count?></td>
									<td>Personalizado</td>
									<td><?=$personalizado->modelo->nome?></td>
									<td class="data_entrega form-group">
										<form id="personalizado-<?=$key?>">
											<input onchange="delivery_date('personalizado','#personalizado-<?=$key?>')" type="text" name="data_entrega-personalizado-<?=$key?>" class="form-control input-sm date" value="<?=$personalizado->data_entrega?>" placeholder="dd/mm/yyyy">
											<span class="help-block"></span>
											<input type="hidden" name="posicao" id="posicao-<?=$key?>" class="form-control" value="<?=$key?>">
										</form>
									</td>
									<td><?=$personalizado->quantidade?></td>
									<td>R$ <span class="pull-right"><?=number_format($personalizado->calcula_unitario(),2,',','.')?></span></td>
									<td>R$ <span class="pull-right"><?=number_format($personalizado->calcula_total(),2,',','.')?></span></td>
									<td><a href="<?=base_url('personalizado/session_orcamento_personalizado_editar/'.$key)?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a onclick="personalizado_excluir_posicao(<?=$key?>)" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php
								$count ++;
							}
							//PRODUTOS
							foreach ($this->session->orcamento->produto as $key => $container) {
								?>
								<tr>
									<td><?=$count?></td>
									<td><?=$container->produto->produto_categoria->nome?></td>
									<td><?=$container->produto->nome?></td>
									<td class="data_entrega form-group">
										<form id="produto-<?=$key?>">
											<input onchange="delivery_date('produto','#produto-<?=$key?>')" type="text" name="data_entrega-produto-<?=$key?>" class="form-control input-sm date" value="<?=$container->data_entrega?>" placeholder="dd/mm/yyyy">
											<span class="help-block"></span>
											<input type="hidden" name="posicao" id="posicao-<?=$key?>" class="form-control" value="<?=$key?>">
										</form>
									</td>
									<td><?=$container->quantidade?></td>
									<td>R$ <span class="pull-right"><?=number_format($container->calcula_unitario(),2,',','.')?></span></td>
									<td>R$ <span class="pull-right"><?=number_format($container->calcula_total(),2,',','.')?></span></td>
									<td><a onclick="produto_modal('editar',<?=$key?>,<?=$container->produto->id?>,'<?=$container->produto->nome?>',<?=$container->quantidade?>,'<?=$container->descricao?>')" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a onclick="produto_excluir_posicao(<?=$key?>)" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></button></td>
								</tr>
								<?php
								$count ++;
							} 
							?>
						</tbody>
						<tfoot>
							<?php
							if(!empty($this->session->orcamento->desconto)){
								?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td class="data_entrega"></td>
									<td></td>
									<td>Desconto</td>
									<td>R$ <span class="pull-right"><?=number_format($this->session->orcamento->desconto,2,',','.')?></span></td>
									<td><a onclick="orcamento_desconto('editar',<?=$this->session->orcamento->desconto?>)" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a onclick="orcamento_desconto('excluir','')" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></button></td>
								</tr>
								<?php 
							}
							?>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th class="data_entrega"></th>
								<th></th>
								<th>Total a pagar</th>
								<th>R$ <span class="pull-right"><?=number_format($this->session->orcamento->calcula_total(),2,',','.')?></span></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal: Produto -->
<div class="modal fade" id="md_produto">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_produto" action="" method="post" accept-charset="utf-8" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Produto</h4>
				</div>			
				<div class="modal-body row">
					<div class="form-group col-md-8">
						<?= form_label('Produto: ', 'produto', array('class' => 'control-label')) ?>
						<select name="produto" id="produto" class="form-control selectpicker" data-live-search="true" autofocus="true">
							<option disabled selected>Selecione</option>
							<?php 
							foreach ($dados['produto_categoria'] as $categoria) {
								?>
								<optgroup label="<?=$categoria->nome?>">
									<?php
									foreach ($dados['produto'] as $produto) {
										if($categoria->id == $produto->produto_categoria->id){
											?>
											<option value="<?=$produto->id?>"><?=$produto->nome?></option>
											<?php 
										}  
									}  
									?>
								</optgroup>
								<?php 
							}
							?>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-md-4">
						<?= form_label('Quantidade: ', 'quantidade_produto', array('class' => 'control-label')) ?>
						<input type="number" name="quantidade" id="quantidade_produto" step="1" class="form-control" value="" placeholder="Quantidade de produtos" />
						<span class="help-block"></span>
					</div>
					<div class="form-group col-md-12">
						<?= form_label('Descrição: ', 'descricao', array('class' => 'control-label')) ?>
						<textarea id="descricao_produto" name="descricao" class="form-control" placeholder="Descrição"></textarea>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit">Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Modal: Clientes Tabela-->
<div class="modal fade" id="md_clientes">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Clientes</h4>
			</div>
			<div class="modal-body">
				<button onclick="pre_crud('cliente','adicionar','#form_cliente','#md_clientes','#md_form_cliente','<?=base_url('cliente/ajax_add')?>')" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
				<button onclick="pre_crud('cliente','editar','#form_cliente','#md_clientes','#md_form_cliente','<?=base_url('cliente/ajax_update')?>')" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i></button>
				<button class="btn btn-default" data-toggle="modal" href='#md_filtro_cliente'><span class="glyphicon glyphicon-search"></span></button>
				<button type="button" id="" class="btn btn-default btn-reset">Limpar Filtro</button>
				<hr>  
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table id="tabela_cliente" class="table display compact table-bordered " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nome</th>
									<th>Sobrenome</th>
									<th>Email</th>
									<th>Telefone</th>
									<th>Nome2</th>
									<th>Sobrenome2</th>
									<th>Email2</th>
									<th>Telefone2</th>
									<th>Rg</th>
									<th>Cpf</th>
									<th>Endereço</th>
									<th>Número</th>
									<th>Complemento</th>
									<th>Estado</th>
									<th>UF</th>
									<th>Bairro</th>
									<th>Cidade</th>
									<th>Cep</th>
									<th>Observacao</th>
									<th>Pessoa</th>
									<th>Razão Social</th>
									<th>CNPJ</th>
									<th>I.E</th>
									<th>I.M</th>
								</tr>
							</thead>
							<tbody id="fbody">
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button class="btn btn-default" id="md_cliente_selecionar" ><i class="glyphicon glyphicon-circle-arrow-right"></i> Selecionar</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal: Cliente Form e Filtro-->
<?php $this->load->view('cliente/cliente_modal'); ?>
<!-- Modal: Assessor Filtro -->
<?php $this->load->view('assessor/assessor_modal'); ?>
<!-- Modal: Orcamento Info -->
<div class="modal fade" id="md_orcamento_info">
	<form class="form_ajax" id="form_orcamento_info"  action="#" method="POST" accept-charset="utf-8">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="glyphicon glyphicon-info-sign"></i> Informações do orçamento</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-4">
								<h4><i class="glyphicon glyphicon-map-marker"></i> Loja*</h4>
								<div class="form-group">
									<select name="loja" id="loja" class="form-control">
										<option value="" selected >Selecione</option>
										<?php foreach ($dados['lojas'] as $loja): ?>
											<option value="<?=$loja->id?>" <?php ($loja->id === $this->session->orcamento->loja->id)? print 'selected':'' ?>><?=$loja->unidade?></option>
										<?php endforeach ?>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<h4><i class="glyphicon glyphicon-edit"></i> Evento*</h4>
								<div class="form-group">
									<select name="evento" id="evento" class="form-control">
										<option value="" selected >Selecione</option>
										<?php foreach ($dados['eventos'] as $evento): ?>
											<option value="<?=$evento->id?>" <?php ($evento->id === $this->session->orcamento->evento)? print 'selected':'' ?>><?=$evento->nome?></option>
										<?php endforeach ?>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<h4><i class="glyphicon glyphicon-calendar"></i> Data Evento*</h4>
								<?php empty($this->session->orcamento->data_evento)? $data_evento = "": $data_evento = $this->session->orcamento->data_evento?>
								<div class="form-group">
									<input type="date" name="data_evento" id="data_evento" class="form-control" value="<?=$data_evento?>">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<hr>
						<div id="orcamento_info">
							<!-- Cliente -->
							<div class="row">
								<h4 class="col-sm-12"><i class="glyphicon glyphicon-user"></i> Cliente*</h4>
								<div class="col-sm-1">
									<button onclick="orcamento_cliente('Clientes')" type="button" class="btn btn-default pull-right" style="margin-top: 20px"><i class="glyphicon glyphicon-plus"></i></button>
								</div>
								<div class="col-sm-3">
									<?= form_label('Cliente: ', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->cliente->nome . ' '. $this->session->orcamento->cliente->sobrenome, 'id="" readonly class="form-control input-sm"') ?>
								</div>
								<div class="col-sm-3">
									<?= form_label('E-mail:', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->cliente->email, 'readonly class="form-control input-sm"') ?>
								</div>
								<div class="col-sm-3">
									<?= form_label('Telefone:', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->cliente->telefone, 'readonly class="form-control input-sm"') ?>
								</div>
								<div class="col-sm-2">
									<?= form_label('CPF:', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->cliente->cpf, 'readonly class="form-control input-sm"') ?>
								</div>
							</div>
							<hr>
							<!-- Assessor -->
							<div class="row">
								<h4 class="col-sm-12"><i class="glyphicon glyphicon-user"></i> Assessor</h4>
								<div class="col-sm-1">
									<button onclick="orcamento_assessor('inserir','Assessores')" type="button" class="btn btn-default pull-right" style="margin-top: 20px"><i class="glyphicon glyphicon-plus"></i></button>
								</div>
								<div class="col-sm-1">
									<button onclick="orcamento_assessor('excluir','')" type="button" class="btn btn-default pull-right" style="margin-top: 20px"><i class="glyphicon glyphicon-trash"></i></button>
								</div>
								<div class="col-sm-2">
									<?= form_label('Assessor(a): ', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->assessor->nome . ' '. $this->session->orcamento->assessor->sobrenome, 'id="" readonly class="form-control input-sm"') ?>
								</div>
								<div class="col-sm-3">
									<?= form_label('Empresa: ', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->assessor->empresa, 'id="" readonly class="form-control input-sm"') ?>
								</div>
								<div class="col-sm-3">
									<?= form_label('E-mail: ', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->assessor->email, 'id="" readonly class="form-control input-sm"') ?>
								</div>
								<div class="col-sm-2">
									<?= form_label('Telefone: ', '', array('class' => 'control-label')) ?>
									<?= form_input('', $this->session->orcamento->assessor->telefone, 'id="" readonly class="form-control input-sm"') ?>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
								<form  class="form_ajax" id="form_descricao" action="" method="post" accept-charset="utf-8" role="form">
									<div class="form-group">
										<?= form_label('Descrição: ', 'descricao', array('class' => 'control-label')) ?>
										<textarea name="descricao" id="form_descricao_txt" class="form-control" rows="3"><?=$this->session->orcamento->descricao?></textarea>
										<span class="help-block"></span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- Modal: Assessores Tabela -->
<div class="modal fade" id="md_assessores">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Assessores</h4>
			</div>
			<div class="modal-body">
				<button onclick="pre_crud('assessor','adicionar','#form_assessor','#md_assessores','#md_form_assessor','<?=base_url('assessor/ajax_add')?>')" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
				<button onclick="pre_crud('assessor','editar','#form_assessor','#md_assessores','#md_form_assessor','<?=base_url('assessor/ajax_update')?>')" class="btn btn-default" id="editar_assessor"><i class="glyphicon glyphicon-pencil"></i></button>
				<button class="btn btn-default" data-toggle="modal" href='#md_filtro_assessor'><span class="glyphicon glyphicon-search"></span></button>
				<button type="button" id="" class="btn btn-default btn-reset">Limpar Filtro</button>
				<hr>  
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table id="tabela_assessor" class="table display compact table-bordered " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nome</th>
									<th>Sobrenome</th>
									<th>Empresa</th>
									<th>Telefone</th>
									<th>Email</th>
									<th>Comissão(%)</th>
									<th>Descrição</th>
								</tr>
							</thead>
							<tbody id="fbody">
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button class="btn btn-default" id="md_assessor_selecionar" ><i class="glyphicon glyphicon-circle-arrow-right"></i> Selecionar</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal: Assessor Form -->
<div class="modal fade" id="md_form_assessor">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Assessor</h4>
			</div>
			<?= form_open("#", 'class="form-horizontal form_crud" id="form_assessor" role="form"') ?>
			<div class="modal-body form">
				<!--ID-->
				<?= form_hidden('id') ?>

				<!--Nome-->
				<div class="form-group">
					<?= form_label('*Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
						<span class="help-block"></span>
					</div>
				</div>

				<!--Sobrenome-->
				<div class="form-group">
					<?= form_label('*Sobrenome: ', 'sobrenome', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_input('sobrenome', '', 'id="sobrenome" class="form-control" placeholder="Sobrenome"') ?>
						<span class="help-block"></span>
					</div>
				</div>

				<!--Empresa-->
				<div class="form-group">
					<?= form_label('Empresa: ', 'empresa', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_input('empresa', '', 'id="empresa" class="form-control" placeholder="Empresa"') ?>
						<span class="help-block"></span>
					</div>
				</div>

				<!--Email-->
				<div class="form-group">
					<?= form_label('*E-mail: ', 'email', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_input('email', '', 'id="email" class="form-control" placeholder="Email"') ?>
						<span class="help-block"></span>
					</div>
				</div>

				<!--Telefone-->
				<div class="form-group">
					<?= form_label('*Telefone: ', 'telefone', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_input('telefone', '', 'id="telefone1" class="form-control sp_celphones" placeholder="Telefone"') ?>
						<span class="help-block"></span>
					</div>
				</div>

				<!--Comissão-->
				<div class="form-group">
					<?= form_label('Comissão / BV (%): ', 'comissao', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_input(array('name'=>'comissao','type'=>'number', 'id'=>'comissao', 'class'=>'form-control', 'placeholder'=>'Comissão em porcentagem. EX: 10'), '') ?>
						<span class="help-block"></span>
					</div>
				</div>

				<!--Descrição-->
				<div class="form-group">
					<?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
					<div class="col-sm-10">
						<?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descrição"') ?>
						<span class="help-block"></span>
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="submit" class="btn btn-default btnSubmit">Salvar</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<!-- Modal: Desconto -->
<div class="modal fade" id="md_desconto">
	<div class="modal-dialog modal-sm">
		<form  class="form_ajax" id="form_desconto" action="" method="post" accept-charset="utf-8" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Desconto</h4>
				</div>			
				<div class="modal-body">
					<div class="form-group">
						<?= form_label('Desconto: ', 'desconto', array('class' => 'control-label')) ?>
						<input type="number" name="desconto" id="desconto" class="form-control" value="" step="0.01">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit">Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="md_forma_pagamento">
	<form  class="form-horizontal" id="form_forma_pagamento" action="" method="post" accept-charset="utf-8" role="form">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Forma de pagamento</h4>
				</div>
				<div class="modal-body">
					<!-- Forma de pagamento -->
					<div class="form-group">
						<?= form_label('Forma de pagamento: ', 'forma_pagamento', array('class' => 'control-label col-sm-3')) ?>
						<div class="col-sm-9">
							<select name="forma_pagamento" id="forma_pagamento" class="form-control"  autofocus="true">
								<option value="" selected >Selecione</option>
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
					<!-- Quantidade de parcelas -->
					<div class="form-group">
						<?= form_label('Quantidade de Parcelas: ', 'qtd_parcelas', array('class' => 'control-label col-sm-3')) ?>
						<div class="col-sm-9">
							<select name="qtd_parcelas" id="qtd_parcelas" class="form-control">
								<option value="" selected disabled>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
					</div>
					<!-- Primeiro vencimento -->
					<div class="form-group">
						<?= form_label('1º Vencimento: ', 'primeiro_vencimento', array('class' => 'control-label col-sm-3')) ?>
						<div class="col-sm-9">
							<input type="date" name="primeiro_vencimento" id="primeiro_vencimento" class="form-control">
							<span class="help-block"></span>
						</div>
					</div>
					<!-- Próximos vencimentos -->
					<div class="form-group">
						<?= form_label('Próximos vencimentos: ', 'vencimento_dia', array('class' => 'control-label col-sm-3')) ?>
						<div class="col-sm-9">
							<select name="vencimento_dia" id="vencimento_dia" class="form-control">
								<option value="" selected >Selecione</option>
								<option value="01">Todo dia 1</option>
								<option value="05">Todo dia 5</option>
								<option value="10">Todo dia 10</option>
								<option value="15">Todo dia 15</option>
								<option value="20">Todo dia 20</option>
								<option value="25">Todo dia 25</option>
							</select>
							<span class="help-block"></span>
						</div>
					</div>
					<!--Condições-->
					<div class="form-group">
						<?= form_label('Condições: ', 'condicoes', array('class' => 'control-label col-sm-3')) ?>
						<div class="col-sm-9">
							<?= form_textarea(array('name'=>'condicoes','rows'=>'4','id'=>'condicoes', 'class'=>'form-control', 'placeholder'=>'Condições')) ?>
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button onclick="finalizar_pedido()" type="button" class="btn btn-default btnSubmit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal fade" id="md_calendario">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Calendário</h4>
			</div>
			<div class="modal-body">
				<div id="calendario" data-provide="calendar">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<script>

	var tabela_cliente;
	var tabela_assessor;

	$(document).ready(function() {
		(function($){
			$.fn.calendar.dates['pt'] = {
				days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
				daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
				daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"],
				months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
				monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
				weekShort: 'S',
				weekStart:0
			};
		}(jQuery));
		//Verifica se o orçamento info já foi preechido
		(function(){
			session_orcamento_info(false);
			is_empty_orcamento_info(false);
			is_set_delivery_date();
		})();
		$('#form_orcamento_info').on('submit', function(e){

			is_empty_orcamento_cliente(false);
		});
		$("#qtd_parcelas").click(function(event) {
			if($("#qtd_parcelas").val() == 1){
				$("#vencimento_dia").attr("disabled",true);
				$("#vencimento_dia option[value='']").prop("selected", true);
			}else{
				$("#vencimento_dia").attr("disabled",false);
			}
		});

        //button filter event click
        $('#btn-filter-cliente').click(function(){
            //just reload table
            tabela_cliente.ajax.reload(null,false);
            $("#md_filtro_cliente").modal('hide');
        });
        //button reset event click
        $('.btn-reset').click(function(){

        	$('#form-filter-cliente')[0].reset();
        	tabela_cliente.ajax.reload(null,false);

        	$('#form-filter-assessor')[0].reset();
        	tabela_assessor.ajax.reload(null,false);
        });
        //button filter event click
        $('#btn-filter-assessor').click(function(){
            //just reload table
            tabela_assessor.ajax.reload(null,false);
            $("#md_filtro_assessor").modal('hide');
        });
        // Resaltar a linha selecionada
        $("#tabela_cliente tbody").on("click", "tr", function () {
        	if ($(this).hasClass("selected")) {
        		$(this).removeClass("selected");
        		disable_buttons_crud();
        	}
        	else {
        		tabela_cliente.$("tr.selected").removeClass("selected");
        		$(this).addClass("selected");
        		enable_buttons_crud();
        	}
        });
        // Resaltar a linha selecionada
        $("#tabela_assessor tbody").on("click", "tr", function () {
        	if ($(this).hasClass("selected")) {
        		$(this).removeClass("selected");
        		disable_button();
        	}
        	else {
        		tabela_assessor.$("tr.selected").removeClass("selected");
        		$(this).addClass("selected");
        		enable_button();
        	}
        });
        //Inserir o cliente no orçamento
        $('#md_assessor_selecionar').click(function () {
        	var id = tabela_assessor.row(".selected").id();
        	if (id != "") {
        		session_assessor_inserir(id);
        	}
        });
        //Inserir o cliente no orçamento
        $('#md_cliente_selecionar').click(function () {
        	var id = tabela_cliente.row(".selected").id();
        	if (id != "") {
        		session_cliente_inserir(id);
        	}
        });
        $(".form_crud").submit(function (e) {
        	console.log('Função: $(".form_crud").submit');
        	//call_loadingModal();
        	disable_button();
        	reset_errors();
        	var form = form_crud;
        	var url = url_crud;
        	var modal_form = md_form_crud;
        	var owner = owner_crud;
        	console.log('agora');
        	console.log(form);
        	console.log(url);
        	console.log(modal_form);
        	console.log(owner);
        	$.ajax({
        		url: url,
        		type: "POST",
        		data: $(form).serialize(),
        		dataType: "JSON",
        	})
        	.done(function(data) {
        		console.log("success");
        		if (data.status)
        		{
        			$(modal_form).modal('hide');
        			if(owner === 'assessor'){
        				session_assessor_inserir(data.id);
        				reload_table_assessor()
        			}else if(owner === 'cliente'){
        				session_cliente_inserir(data.id);
        				reload_table_cliente();
        			}
        		}
        		else
        		{
        			close_loadingModal();
        			reset_errors_crud();
        			console.log(data.form_validation);
        			$.map(data.form_validation, function (value, index) {
        				$('[name="' + index + '"]').closest(".form-group").addClass('has-error');
        				$('[name="' + index + '"]').next().text(value);
        				var juridica = [ "razao_social", "cnpj", "ie", "im" ];
        				var fisica = [ "nome", "sobrenome", "email", "telefone","nome2", "sobrenome2", "email2", "telefone2","rg","cpf" ];
        				var endereco = ['endereco','numero','complemento','estado','uf','bairro','cidade','cep','observacao'];
        				if($.inArray(index,fisica) !== -1){
        					$('a[href="#fisica"]').children().addClass('glyphicon glyphicon-remove');
        				}
        				if($.inArray(index,juridica) !== -1){
        					$('a[href="#juridica"]').children().addClass('glyphicon glyphicon-remove');
        				}
        				if($.inArray(index,endereco) !== -1){
        					$('a[href="#endereco"]').children().addClass('glyphicon glyphicon-remove');
        				}
        			});
        		}
        	})
        	.fail(function(jqXHR, textStatus, errorThrown) {
        		console.log("error: Erro ao Adicionar ou Editar Crud");
        	})
        	.always(function() {
        		console.log("complete");
        		enable_button();
        	});
        	e.preventDefault();
        });
        function reload_table_cliente() {

        	tabela_cliente.ajax.reload(null, false);
        }
        function reload_table_assessor() {

        	tabela_assessor.ajax.reload(null, false);
        }
        function enable_buttons_crud() {
        	$("#editar").attr("disabled", false);
        	$("#deletar").attr("disabled", false);
        }
        function disable_buttons_crud() {
        	$("#editar").attr("disabled", true);
        	$("#deletar").attr("disabled", true);
        }
        /*FIM: dataTable CRUD*/
    });
function reset_form_crud() {
	$('#form_cliente')[0].reset();
	$('.form-group').removeClass('has-error');
	$('.error_validation').removeClass('glyphicon-remove');
	$('.help-block').empty();
}
function reset_errors_crud() { 
	$('.form-group').removeClass('has-error');
	$('.error_validation').removeClass('glyphicon-remove');
	$('.help-block').empty();
}
/*Inicio: CRUD*/
/*Variaveis globais para o crud do cliente e assessor*/
var form_crud;
var url_crud;
var url_edit_id;
var md_form_crud;
var md_tb_crud;
var owner_crud;
var criarPedido = false;
function pre_crud(owner,action,form,md_tb,md_form,url) {
	console.log('Função: pre_crud()');
	reset_errors_crud();
	form_crud = form;
	url_crud = url;
	md_tb_crud = md_tb;
	md_form_crud = md_form;
	owner_crud = owner;
	var id = "";
	if(owner == 'assessor'){
		console.log('owner: Assessor');
		id = tabela_assessor.row(".selected").id();
		if(action == 'adicionar'){
			console.log('action: adicionar');
			adicionar(form,md_tb_crud,md_form_crud);
		}else if(action == 'editar'){
			console.log('action: editar');
			url_edit_id = "<?= base_url('assessor/ajax_edit/') ?>" + id;
			editar(id,md_tb_crud,md_form_crud);
		}else{
			console.log('Nenhuma action foi definida!');
		}
	}
	else if(owner == 'cliente'){
		console.log('owner: Cliente');
		id = tabela_cliente.row(".selected").id();
		if(action == 'adicionar'){
			console.log('action: adicionar');
			adicionar(form,md_tb_crud,md_form_crud);
		}else if(action == 'editar'){
			console.log('action: editar');
			url_edit_id = "<?= base_url('cliente/ajax_edit/') ?>" + id;
			editar(id,md_tb_crud,md_form_crud,'Editar Cliente');
		}else{
			console.log('Nenhuma action foi definida!');
		}
	}else{
		console.log('Nenhum owner foi definido!');
	}
}
function adicionar(form,md_tb_crud,md_form_crud) {
	console.log('Função: adicionar()');
	reset_form(form);
	$(md_tb_crud).modal('hide');

	save_method = 'add';
	$("input[name='id']").val("");

	$(md_form_crud).modal('show');
}
function editar(id,md_tb_crud,md_form_crud) {
	console.log('Função: editar()');
	var form = form_crud;
	var url = url_crud;
	var url_edit = url_edit_id;
	var md_tb = md_tb_crud;
	var md_form = md_form_crud;
	var owner = owner_crud;
	if (!id) {
		return;
	}
	reset_form(form);

	save_method = 'edit';
	$("input[name='id']").val(id);
	$.ajax({
		url: url_edit,
		type: "POST",
		dataType: "JSON",
		success: function (data)
		{
			console.log('success: preenchendo o formulário com o id que foi passado...');
			if(owner == 'assessor'){
				console.log('owner: assessor');
				$.map(data.assessor, function (value, index) {
					$('[name="' + index + '"]').val(value);
				});
			}else if(owner == 'cliente'){
				console.log('owner: cliente');
				$.map(data.cliente, function (value, index) {
					$('[name="' + index + '"]').val(value);
				});
			}
			$(md_form).modal('show');
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Erro ao buscar os dados');
		}
	});
}
/*Fim: CRUD*/
function orcamento_info_modal() {

	$('#md_orcamento_info').modal();
}
function orcamento_assessor(acao) {
	if ( ! $.fn.DataTable.isDataTable( '#tabela_assessor' ) ) {
	  	tabela_assessor = $("#tabela_assessor").DataTable({
			scrollX: true,
            dom: 'lBfrtip',
            buttons: [
            {   
                extend:'colvis',
                text:'Visualizar colunas'
            }],
			language: {
				url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
			},
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            ajax: {
            	url: "<?= base_url('assessor/ajax_list') ?>",
            	type: "POST",
            	data: function ( data ) {
            		data.filtro_id = $('#filtro_assessor_id').val();
            		data.filtro_nome = $('#filtro_assessor_nome').val();
            		data.filtro_sobrenome = $('#filtro_assessor_sobrenome').val();
            		data.filtro_telefone = $('#filtro_assessor_telefone').val();
            		data.filtro_email = $('#filtro_assessor_email').val();
            	},
            },
            columns: [
            {data: "id","visible": true},
            {data: "nome","visible": true},
            {data: "sobrenome","visible": true},
            {data: "empresa","visible": true},
            {data: "telefone","visible": true},
            {data: "email","visible": true},
            {data: "comissao","visible": false},
            {data: "descricao","visible": true},
            ]
        });
	}
	if(acao === 'inserir'){	
		$("#md_assessores").modal();
	}else if(acao === 'excluir'){
		main_excluir("<?=base_url('orcamento/ajax_session_assessor/excluir')?>");
	}
}
function orcamento_cliente() {
	if ( ! $.fn.DataTable.isDataTable( '#tabela_cliente' ) ) {
		tabela_cliente = $("#tabela_cliente").DataTable({
			scrollX: true,
            dom: 'lBfrtip',
            buttons: [
            {   
                extend:'colvis',
                text:'Visualizar colunas'
            }],
            order: [[0, 'desc']],
			language: {
				url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
			},
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            ajax: {
            	url: "<?= base_url('cliente/ajax_list') ?>",
            	type: "POST",
            	data: function ( data ) {
            		data.filtro_id = $('#filtro_id').val();
            		data.filtro_email = $('#filtro_email').val();
            		data.filtro_nome = $('#filtro_nome').val();
            		data.filtro_sobrenome = $('#filtro_sobrenome').val();
            		data.filtro_telefone = $('#filtro_telefone').val();
            		data.filtro_cpf = $('#filtro_cpf').val();
            		data.filtro_cnpj = $('#filtro_cnpj').val();
            		data.filtro_razao_social = $('#filtro_razao_social').val();
            	},
            },
            columns: [
	            {data: "id" , "visible": true},
	            {data: "nome" , "visible": true},
	            {data: "sobrenome" , "visible": true},
	            {data: "email" , "visible": true},
	            {data: "telefone" , "visible": true},
	            {data: "nome2" , "visible": false},
	            {data: "sobrenome2" , "visible": false},
	            {data: "email2" , "visible": false},
	            {data: "telefone2" , "visible": false},
	            {data: "rg" , "visible": false},
	            {data: "cpf" , "visible": true},
	            {data: "endereco" , "visible": false},
	            {data: "numero" , "visible": false},
	            {data: "complemento" , "visible": false},
	            {data: "estado" , "visible": false},
	            {data: "uf" , "visible": false},
	            {data: "bairro" , "visible": false},
	            {data: "cidade" , "visible": false},
	            {data: "cep" , "visible": false},
	            {data: "observacao" , "visible": false},
	            {data: "pessoa_tipo" , "visible": false},
	            {data: "razao_social" , "visible": false},
	            {data: "cnpj" , "visible": false},
	            {data: "ie" , "visible": false},
	            {data: "im" , "visible": false},
            ]
        });
	}else{
		tabela_cliente.ajax.reload(null,false);
	}
	$("#md_clientes").modal();
}
function session_orcamento_info(modal_open = true) {
	pre_submit('#form_orcamento_info','<?=base_url('orcamento/ajax_session_orcamento_info')?>','#md_orcamento_info');
	if(modal_open){
		$('#md_orcamento_info').modal();
	}
}
function session_cliente_inserir(id) {
	$.ajax({
		url: '<?= base_url("orcamento/ajax_session_cliente_inserir") ?>',
		type: 'POST',
		dataType: 'JSON',
		data: { id: id}
	})
	.done(function(data) {
		console.log("success: session_cliente_inserir()");
		reload_table();
		$("#md_clientes").modal('hide');
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		console.log('error: session_cliente_inserir()');
		$.alert({
			title: 'Aviso!',
			content: 'Não foi possível inserir o cliente no orçamento! Tente novamente.',
		});
	})
	.always(function() {
		console.log("complete: session_cliente_inserir()");
	});
}
function session_assessor_inserir(id){
	console.log('Função: session_assessor_inserir()');
	$.ajax({
		url: '<?= base_url("orcamento/ajax_session_assessor/inserir") ?>',
		type: 'POST',
		dataType: 'JSON',
		data: { id: id}
	})
	.done(function(data) {
		console.log("success: session_assessor_inserir()");
		if(data.status){
			reload_table();
			$("#md_assessores").modal('hide');
		}
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		console.log("error: session_assessor_inserir()");
	})
	.always(function() {
		console.log("complete: session_assessor_inserir()");
	});
}
function orcamento_desconto(acao,valor) {
	if(acao === 'inserir'){
		pre_submit("#form_desconto","<?=base_url('orcamento/ajax_session_desconto/inserir')?>","#md_desconto");
		$("#desconto").val(valor);
		$("#md_desconto").modal();
	}else if(acao === 'editar'){
		pre_submit("#form_desconto","<?=base_url('orcamento/ajax_session_desconto/editar')?>","#md_desconto");
		$("#desconto").val(valor);
		$("#md_desconto").modal();
	}else if(acao === 'excluir'){
		main_excluir("<?=base_url('orcamento/ajax_session_desconto/excluir')?>");
	}
}
function orcamento_modal(acao) {
	if(acao === "novo"){
		console.log("orcamento_modal()");
		console.log("orcamento/ajax_session_orcamento_novo");
		$.confirm({
			title: 'Confirmação!',
			content: 'Deseja iniciar um novo orçamento?',
			confirm: function(){
				call_loadingModal('Criando um novo orcamento...');
				$.ajax({
					url: '<?=base_url('orcamento/ajax_session_orcamento_novo')?>',
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					if(data.status){
						console.log("success: orcamento/ajax_session_orcamento_novo");
						reload_table();
						session_orcamento_info();
					}else{
						console.log(data.msg);
					}
				})
				.fail(function() {
					console.log("error:orcamento/ajax_session_orcamento_novo");
				})
				.always(function() {
					console.log("complete: orcamento_modal()");
				});
			},
			cancel: function(){
				$.alert({
					title:'Cancelado!',
					content:'A operação foi cancelada.'
				});
			}
		});
	}else if(acao === "excluir"){
		console.log("orcamento/ajax_session_orcamento_excluir");
		$.confirm({
			title: 'Confirmação!',
			content: 'Deseja excluir o orçamento?',
			confirm: function(){
				console.log("orcamento_excluir");
				call_loadingModal('Excluindo orcamento...');
				$.ajax({
					url: '<?=base_url('orcamento/ajax_session_orcamento_excluir')?>',
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					if(data.status){
						console.log("success: orcamento/ajax_session_orcamento_excluir");
						clear_all_forms();
						reload_table();
						session_orcamento_info();
					}else{
						console.log(data.msg);
					}
				})
				.fail(function() {
					console.log("error: orcamento/ajax_session_orcamento_excluir");
				})
				.always(function() {
					console.log("complete: orcamento_modal()");
				});
			},
			cancel: function(){
				$.alert({
					title: 'Cancelado',
					content:'A operação cancelada com exito!'
				});
			}
		});
	}
}
function produto_modal(acao,posicao,id,nome,quantidade,descricao){
	console.log('Função: produto_modal()');
	if(acao === "inserir"){
		console.log('ação: inserir');
		reset_form("#form_produto");
		$(".filter-option").text("");
		pre_submit("#form_produto","<?=base_url('produto/session_produto_inserir')?>","#md_produto");
	}else if(acao === "editar"){
		console.log('ação: editar');
		pre_submit("#form_produto",'produto/session_produto_editar/'+posicao,"#md_produto");
		$("#produto option[value="+id+"]").prop('selected', true);
		$("#quantidade_produto").val(quantidade);
		$("#descricao_produto").val(descricao);
		$(".filter-option").text(nome);
	}else{
		console.log('error:não foi passado uma ação no produto_modal()');
	}
	$("#md_produto").modal();
}
function produto_excluir_posicao(posicao) {
	console.log("Função: produto_excluir_posicao()");
	main_excluir('produto/session_produto_excluir/'+posicao);
}
function convite_excluir_posicao(posicao) {
	console.log("Função: convite_excluir_posicao()");
	main_excluir('convite/session_orcamento_convite_excluir/'+posicao);
}
function personalizado_excluir_posicao(posicao) {
	console.log("Função: convite_excluir_posicao()");
	main_excluir('personalizado/session_orcamento_personalizado_excluir/'+posicao);
}
function delivery_date(owner,form) {
	reset_errors();
	if(owner === "convite"){
		set_date_delivery('<?=base_url('pedido/ajax_set_date_delivery/convite')?>',form);
	}else if(owner === "personalizado"){
		set_date_delivery('<?=base_url('pedido/ajax_set_date_delivery/personalizado')?>',form);
	}else if(owner === "produto"){
		set_date_delivery('<?=base_url('pedido/ajax_set_date_delivery/produto')?>',form);
	}
}
function set_date_delivery(url,form){
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		data: $(form).serialize(),
	})
	.done(function(data) {
		console.log("success");
		$.map(data.form_validation, function (value, index) {
			$('[name="' + index + '"]').closest(".form-group").addClass('has-error');
			$('[name="' + index + '"]').next().text(value);
		});
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});	
}
function criar_orcamento() {
	criarPedido = false;
	console.log("Função: criar_orcamento()");
	console.log("Preparando para salvar");
	console.log("Verificando se há algo em edição...");
	call_loadingModal('Preparando para salvar...');
	is_editing_container_itens();
}
function criar_pedido() {
	criarPedido = true;
	ajax_get_parcelas_pedido();
	console.log('Função: criar_pedido()');
	//$('.data_entrega').show();
	$.ajax({
		url: '<?=base_url('pedido/ajax_is_set_delivery_date')?>',
		type: 'POST',
		dataType: 'json'
	})
	.done(function(data) {
		console.log("success: criar_pedido()");
		if(data.status){
			$('.data_entrega').show();
			$.alert({
				title: "Data de entrega",
				content: "Defina as datas de entrega para cada produto"
			});
		}else{
			$('#md_forma_pagamento').modal('show');

			//console.log("Preparando para criar pedido");
			//console.log("Verificando se há algo em edição...");
			//call_loadingModal('Preparando para criar o pedido...');
			//is_editing_container_itens();
		}
	})
	.fail(function() {
		console.log("error: criar_pedido()");
	})
	.always(function() {
		console.log("complete: criar_pedido()");
	});	
}
function finalizar_pedido() {
	disable_button();
	reset_errors();
	$.ajax({
		url: '<?=base_url('pedido/ajax_forma_pagamento')?>',
		type: 'POST',
		dataType: 'json',
		data: $('#form_forma_pagamento').serialize(),
	})
	.done(function(data) {
		console.log("success: finalizar_pedido()");
		if (data.status){
			$('#md_forma_pagamento').modal('hide');
			console.log("Preparando para criar pedido");
			console.log("Verificando se há algo em edição...");
			call_loadingModal('Preparando para criar o pedido...');
			is_editing_container_itens();
		}
		else{
			$.map(data.form_validation, function (value, index) {
				$('[name="' + index + '"]').closest(".form-group").addClass('has-error');
				$('[name="' + index + '"]').next().text(value);
			});
		}
	})
	.fail(function() {
		console.log("error: finalizar_pedido()");
	})
	.always(function() {
		console.log("complete: finalizar_pedido()");
		enable_button();
	});
}
function is_set_delivery_date() {
	$.ajax({
		url: '<?=base_url('pedido/ajax_is_set_delivery_date')?>',
		type: 'POST',
		dataType: 'json'
	})
	.done(function(data) {
		console.log("success: is_set_delivery_date()");
		if(data.status && !data.date_found){
			$('.data_entrega').hide();
		}else{
			$('.data_entrega').show();
		}
	})
	.fail(function() {
		console.log("error: is_set_delivery_date()");
	})
	.always(function() {
		console.log("complete: is_set_delivery_date()");
	});
}
function is_editing_container_itens() {
	console.log('Função: is_editing_container_itens()');
	$.ajax({
		url: '<?=base_url('orcamento/ajax_is_editing_container_itens')?>',
		type: 'POST',
		dataType: 'json',
	})
	.done(function(data) {
		var itens = "";
		if(data.status){
			close_loadingModal();
			$.each(data.location, function(index, location) {
				itens += '<li><strong><a href="'+data.url[index]+'">'+location+'</a></strong></li> ';
				console.log("success: Editando: "+location);
			});
			$.confirm({
				title: 'Confirmação!',
				content: 'Em edição: <ul>' + itens + '</ul> <p>Deseja salvar mesmo assim?</p>',
				confirm: function(){
					call_loadingModal('Preparando para salvar...');
					is_empty_orcamento_info();
				},
				cancel: function(){
					$.alert('Operação cancelada!');
				}
			});
		}else{
			console.log("success: Nada em edição.");
			is_empty_orcamento_info();
		}
	})
	.fail(function() {
		console.log("error:orcamento/ajax_is_editing_container_itens");
	})
	.always(function() {
		console.log("complete: is_editing_container_itens()");
	});
}
function is_empty_orcamento_info(salvar = true) {
	console.log('Função: is_empty_orcamento_info()');
	$.ajax({
		url: '<?=base_url('orcamento/ajax_is_empty_orcamento_info')?>',
		type: 'POST',
		dataType: 'JSON',
	})
	.done(function(data) {
		console.log("success: is_empty_orcamento_info()");
		if(salvar){
			if(data.status){
				is_empty_orcamento_itens();
			}else{
				close_loadingModal();
				show_orcamento_info_error(data);
			}
		}else{
			if(!data.status){
				$("#md_orcamento_info").modal();
				//show_orcamento_info_error(data);
			}
		}
	})
	.fail(function() {
		console.log("error: is_empty_orcamento_info()");
	})
	.always(function() {
		console.log("complete: is_empty_orcamento_info()");
	});	
}
function show_orcamento_info_error(data) {
	var itens = "";
	close_loadingModal();
	$.each(data.location, function(index, location) {
		if(location === 'data_evento'){
			location = 'data do evento'
		}
		itens += '<li><strong>'+location+'</strong> não foi definido!</li> ';
		console.log("success: Editando: "+location);
	});
	$.confirm({
		icon: 'glyphicon glyphicon-info-sign',
		title: 'Informações do orçamento',
		content: '<ul>' + itens + '</ul><p>Clique em Info para definir estas informações</p>',
		confirmButton: 'Info',
		cancelButton: 'Cancelar',
		confirm: function(){
			session_orcamento_info();
		},
		cancel: function(){
			$.alert({
				title:'Cancelado',
				content:'Operação cancelada!',
			});
		}
	});
}
function is_empty_orcamento_itens() {
	console.log("Função: is_empty_orcamento_itens");
	//console.log("Verificando condições para salvar...");
	//call_loadingModal('Preparando para salvar');
	$.ajax({
		url: '<?=base_url('orcamento/ajax_is_empty_orcamento_itens')?>',
		type: 'POST',
		dataType: 'json',
	})
	.done(function(data) {
		console.log("success: orcamento/ajax_is_empty_orcamento_itens");
		if(data.status){
			is_empty_orcamento_cliente();
		}else{
			console.log(data.msg);
			close_loadingModal();
			$.alert({
				title:'Orçamento',
				content: 'Não constam produtos neste orçamento. Insira pelo menos um produto antes salvar.',
			});
		}
	})
	.fail(function() {
		console.log("error: orcamento/is_empty_orcamento_itens");
	})
	.always(function() {
		console.log("complete:orcamento/is_empty_orcamento_itens");
	});
}
function is_empty_orcamento_cliente(save = true) {
	var is_criar_pedido = null;
	if(criarPedido){
		is_criar_pedido = 'true';
	}
	console.log('Função: is_empty_orcamento_cliente()');
	$.ajax({
		url: '<?=base_url('orcamento/ajax_is_empty_orcamento_cliente')?>',
		type: 'POST',
		dataType: 'JSON',
		data: {is_criar_pedido: is_criar_pedido},
	})
	.done(function(data) {
		console.log("success: orcamento/ajax_is_empty_orcamento_cliente");
		if(data.status){
			if(save){
				is_empty_orcamento_assessor();
			}
		}else{
			console.log(data.msg);
			close_loadingModal();
			$.confirm({
				title: 'Cliente!',
				content: data.msg,
				confirmButton: 'Cliente',
				cancelButton: 'Cancelar',
				confirm: function(){
					orcamento_cliente();
				},
				cancel: function(){
					$.alert('Operação cancelada! Defina o cliente manualmente antes de salvar.');
				}
			});
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}
function is_empty_orcamento_assessor() {
	console.log('Função: is_empty_orcamento_assessor');
	$.ajax({
		url: '<?=base_url('orcamento/ajax_is_empty_orcamento_assessor')?>',
		type: 'POST',
		dataType: 'JSON',
	})
	.done(function(data) {
		if(data.status){
			console.log("Orçamento pronto para salvar");
			salvar();
		}else{
			close_loadingModal();
			$.confirm({
				title:"Assessor",
				content:"Deseja adicionar um assessor?",
				confirmButton: 'Sim',
				cancelButton: 'Não',
				confirm: function () {
					$('#md_assessores').modal();
				},
				cancel: function () {
					call_loadingModal('Salvando...');
					salvar();
				}
			});
		}
	})
	.fail(function() {
		console.log("error: is_empty_orcamento_assessor");
	})
	.always(function() {
		console.log("complete: is_empty_orcamento_assessor");
	});
}
function salvar() {
	console.log("Função:salvar");
	console.log("Salvando orçamento...");
	if(criarPedido){
		url = '<?=base_url('pedido/ajax_salvar')?>';
	}else{
		url = '<?=base_url('orcamento/ajax_salvar')?>';
	}
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
	})
	.done(function(data) {
		console.log("success:salvar()");
		close_loadingModal();
		if(data.status){
			call_loadingModal("Finalizando...");
			clean_session_orcamento(data.id);
		}else{
			$.confirm({
				title:"Ops",
				content:"Não foi possível salvar o orçamento. <p>Deseja tentar salvar novamente?</p>",
				confirmButton: 'Sim',
				cancelButton: 'Não',
				confirm: function(){
					salvar();
				},
				cancel: function(){
					$.alert({
						title:'Cancelado!',
						content: 'Operação cancelada.'
					});
				}
			});
		}
	})
	.fail(function() {
		close_loadingModal();
		console.log("error:salvar()");
	})
	.always(function() {
		console.log("complete:salvar()");
	});	
}
function clean_session_orcamento(id) {
	//newWindow = window.open();
	//Limpa o formulário
	$.each($('form'), function( index, value ) {
		value.reset();
	});
	$.ajax({
		url: '<?=base_url('orcamento/ajax_clean_session_orcamento')?>',
		type: 'POST',
		dataType: 'json'
	})
	.done(function(data) {
		close_loadingModal();
		console.log("success");
		if(data.status){
			if(criarPedido){
				//newWindow.location = '<?=base_url('pedido/pdf/')?>'+data.id, '_blank';
				url = '<?=base_url('pedido/pdf/')?>'+id;
				item = "Pedido";
			}else{
				//newWindow.location = '<?=base_url('orcamento/pdf/')?>'+id, '_blank';
				url = '<?=base_url('orcamento/pdf/')?>'+id;
				item = "Orçamento";
			}
			$.confirm({
				title: item + " N° " + id,
				content: "<p>Seu " + item + " foi criado com sucesso!</p>",
				confirmButton: 'PDF',
				cancelButton: 'Fechar',
				confirm:function(){
					window.open(url,'_blank');
				},
				cancel: function(){
					$("#md_orcamento_info").modal('show');
				}

			})
			reload_table();
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		criarPedido = false;
		close_loadingModal();
		console.log("complete");
	});
}
//AJAX
/*Variaveis globais para o ajax*/
var form_ajax;
var url_ajax;
var modal_ajax;
function pre_submit(form,url,modal) {
	console.log('pre_submit');
	form_ajax = form;
	url_ajax = url;
	modal_ajax = modal;
}
//Adiciona ou Edita produto
$(".form_ajax").submit(function (e) {
	console.log('Função: $(".form_ajax")');
	disable_button();
	reset_errors();
	var form = form_ajax;
	var url = url_ajax;
	var modal = modal_ajax;
	$.ajax({
		url: url,
		type: "POST",
		data: $(form).serialize(),
		dataType: "JSON",
	}).done(function(data) {
		console.log('success: $(".form_ajax")');
		if (data.status){
			$(modal).modal('hide');
			reload_table();
		}
		else{
			$.map(data.form_validation, function (value, index) {
				$('[name="' + index + '"]').closest(".form-group").addClass('has-error');
				$('[name="' + index + '"]').next().text(value);
			});
		}
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		console.log('error: $(".form_ajax")');
		console.log(textStatus);
		$.alert({
			title: 'Atenção!',
			content: 'Não foi possível Adicionar ou Editar! Tente novamente.',
		});
	})
	.always(function() {
		enable_button();
	});
	e.preventDefault();
});
function main_excluir(url) {
	console.log("Função: main_excluir()");

	$.confirm({
		title: 'Confirmação',
		content: 'Deseja realmente excluir?',
		confirm:function(){
			call_loadingModal();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
			})
			.done(function(data) {
				console.log("success: main_excluir()");
			})
			.fail(function() {
				console.log("error:  main_excluir()");
			})
			.always(function(data) {
				console.log("complete: main_excluir()");
				reload_table();
			});
		},
		cancel: function(){
			$.alert({
				title: '',
				content: 'A operação foi cancelada!',
			});
		}
	});
}
function reload_table() {
	console.log("Função: reload_table()");
	$.ajax({
		url: '<?=base_url('orcamento')?>',
		type: 'POST',
		dataType: 'html',
	})
	.done(function(data) {
		console.log("success: reload_table()");
	})
	.fail(function() {
		console.log("error:reload_table()");
	})
	.always(function(data) {
		console.log("complete:reload_table()");
		close_loadingModal();
		$('#orcamento_info').html($('#orcamento_info' , data).html());
		$('#painel_principal').html($('#painel_principal' , data).html());
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
function clear_all_forms() {

	$('form').each(function() { this.reset() });
}
function reset_errors() {
	console.log('reset_errors()');
	$('.form-group').removeClass('has-error');
	$('.help-block').empty();
}
function disable_button(){
	$('.btnSubmit').text('Salvando...');
	$('.btnSubmit').attr('disabled', true);
}
function enable_button() {
	$('.btnSubmit').text('Salvar');
	$('.btnSubmit').attr('disabled', false);
}
function reset_form(form) {
	$(form)[0].reset(); 
	$('.form-group').removeClass('has-error'); 
	$('.help-block').empty();
}
function ajax_get_parcelas_pedido() {
	$.ajax({
		url: '<?= base_url("pedido/ajax_get_parcelas_pedido")?>',
		type: 'GET',
		dataType: 'JSON',
	})
	.done(function(data) {
		console.log(data);
		//Limpa o select antes de inserir os novos options
		$('#qtd_parcelas').find('option').remove().end().append('<option value="" selected disabled>Selecione</option>');
		$.each(data, function (i, item) {
			$("#qtd_parcelas").append($('<option>', { 
				value: item.value,
				text : item.text 
			}));
		});
	})
	.fail(function() {
		return null;
		console.log("Erro ao buscar o valor do pedido");
	})
}
</script>