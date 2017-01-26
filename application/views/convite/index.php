<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Convite</h3>
			</div>
			<div class="panel-body">
				<!-- CONVITE MENU -->
				<div class="main_panel">
					<div class="dropdown">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"  id="convite_menu" aria-haspopup="true" aria-expanded="true">
							Menu
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu"  aria-labelledby="convite_menu">
							<?php
							$mao_obra = $this->session->convite->mao_obra;
							if(empty($mao_obra->id)){
								$mao_txt = "Adicionar";
								$mao_id = "''";
							}else{
								$mao_txt = "Alterar";
								$mao_id = $mao_obra->id;
							}
							?>
							<li><a onclick="convite_modal('inserir','','')" href="javascript:void(0)">Novo convite</a></li>
							<li><a onclick="mao_obra_modal('inserir',<?=$mao_id?>)" href="javascript:void(0)"><?=$mao_txt ?> mão de obra</a></li>
							<li><a onclick="descricao_modal()" href="javascript:void(0)">Adicionar descrição</a></li>
						</ul>
					</div>
					<div class="table-responsive">
						<table id="tabela_principal" class="table table-hover table-condensed">
							<tr>
								<th>#</th>
								<th>Produto</th>
								<th>Descrição</th>
								<th>Qtd</th>
								<th>Unitário</th>
								<th>Sub-total</th>
								<th>Editar</th>
								<th>Excluir</th>
							</tr>
							<tbody>
								<?php $count = 1 ;
								if(!empty($this->session->convite->modelo->id)){
									?>
									<tr>
										<td><?=$count?></td>
										<td>Convite</td>
										<td><?=$this->session->convite->modelo->codigo?></td>
										<td><?=$this->session->convite->quantidade?></td>
										<td>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_convite(),2,',','.')?></span></td>
										<td>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_convite_sub_total(),2,',','.')?></span></td>
										<td><a onclick="convite_modal('editar',<?=$this->session->convite->modelo->id?>,<?=$this->session->convite->quantidade?>)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></a></td>
										<td><a onclick="excluir_convite()" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>
									</tr>
									<?php
								}
								if(!empty($this->session->convite->mao_obra->id)){
									?>
									<tr>
										<td><?=++$count?></td>
										<td>Mão de obra</td>
										<td></td>
										<td><?=$this->session->convite->quantidade?></td>
										<td>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_mao_obra(),2,',','.')?></span></td>
										<td>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_mao_obra_sub_total(),2,',','.')?></span></td>
										<td><a onclick="mao_obra_modal('editar',<?=$this->session->convite->mao_obra->id?>)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></a></td>
										<td><a onclick="excluir_mao_obra()" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-trash"></span></a></td>
									</tr>
									<?php
								}
								if(!empty($this->session->convite->calcula_custos_administrativos_unitario())){
									?>
									<tr>
										<td><?=++$count?></td>
										<td>Custos Administrativos</td>
										<td></td>
										<td><?=$this->session->convite->quantidade?></td>
										<td>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_custos_administrativos_unitario(),2,',','.')?></span></td>
										<td>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_custos_administrativos_total(),2,',','.')?></span></td>
										<td></td>
										<td></td>
									</tr>
									<?php
								}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th></th>
									<th>Total</th>
									<th></th>
									<th><?=$this->session->convite->quantidade?></th>
									<th>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_unitario(),2,',','.')?></span></th>
									<th>R$ <span class="pull-right"><?=number_format($this->session->convite->calcula_total(),2,',','.')?></span></th>
									<th></th>
									<th><button onclick="add_to_orcamento()" type="button" class="btn btn-success btn-sm btnSubmit">Salvar</button></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('_container/container_itens'); ?>
<?php $this->load->view('_container/container_modal'); ?>
<?php $this->load->view('_container/container_js'); ?>