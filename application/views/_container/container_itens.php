<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class;
if($controller == 'convite'){
	$arr = array("cartao", "envelope");
	$session_container = $this->session->convite;
}else if($controller == 'personalizado'){
	$arr = array("personalizado");
	$session_container = $this->session->personalizado;
}
foreach ($arr as $key => $value) {
	if($controller == 'convite'){
		if($value == 'cartao'){
			$session_owner = $this->session->convite->cartao;
			$session_owner->owner = $value;
			$panel_title = "Módulo Cartão";
			$tabela_id = "tabela_cartao";
			$drop = "dropdown";
		}else if($value == 'envelope'){
			$session_owner = $this->session->convite->envelope;
			$session_owner->owner = $value;
			$panel_title = "Módulo Envelope";
			$tabela_id= "tabela_envelope";
			$drop = "dropup";
		}
	}
	if($controller == 'personalizado' && $value == 'personalizado'){
		$session_owner = $this->session->personalizado->personalizado;
		$session_owner->owner = $value;
		$panel_title = "Módulo personalizado";
		$tabela_id= "tabela_personalizado";
		$drop = "dropdown";
	}
	?>
	<!-- Tabela: [Cartão, Envelope] / [Personalizado] -->
	<div id="<?=$session_owner->owner?>" class="row" style="display: none">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body panel-nav">
					<nav class="navbar navbar-default navbar-static-top" role="navigation">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-item-<?=$tabela_id?>" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<div class="navbar-brand"><?=$panel_title?></div>
							</div>

							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-item-<?=$tabela_id?>">
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_papel_modal('<?=$session_owner->owner?>')" data-toggle="modal" data-modelo="" href='#md_papel'><i class="glyphicon glyphicon-file"></i> Papel</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_impressao_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_impressao'><i class="glyphicon glyphicon-print"></i> Impressão</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_acabamento_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_acabamento'><i class="glyphicon glyphicon-scissors"></i> Acabamento</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_acessorio_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_acessorio'><i class="fa fa-diamond" aria-hidden="true"></i> Acessório</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_fita_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_fita'><i class="glyphicon glyphicon-tag"></i> Fita</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_cliche_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_cliche'><i class="glyphicon glyphicon-registration-mark"></i> Clichê</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_faca_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_faca'><i class="fa fa-map-o" aria-hidden="true"></i> Faca</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li>
										<a onclick="abrir_laser_modal('<?=$session_owner->owner?>')" data-toggle="modal" href='#md_laser'><i class="glyphicon glyphicon-flash"></i> Laser</a>
									</li>
								</ul>
							</div>
						</div>
					</nav>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="<?=$tabela_id?>" class="table table-hover table-condensed">
									<tr>
										<th>#</th>
										<th>Componente</th>
										<th>Item</th>
										<th>Descrição</th>
										<th>Qtd</th>
										<th>Unitário</th>
										<th>Sub-Total</th>
										<th>Editar</th>
										<th>Excluir</th>
									</tr>
									<tbody>
										<!-- INICIO: PAPEL -->
										<?php 
										$count = 0;
										if(!empty($session_owner->container_papel)){
											foreach ($session_owner->container_papel as $key => $container_papel) {
												foreach ($container_papel as $key1 => $value) {
													if($key1 != 'papel-0'){
														?>
														<tr>
															<td></td>
															<td><span class="glyphicon glyphicon-compressed"></span> <b>Empastamento</b></td>
															<td><?=$value->empastamento->nome?></td>
															<td></td>
															<td>1</td>
															<td>R$ <?= number_format( $value->calcula_valor_unitario_empastamento($session_container->quantidade), 2, ",", ".") ?></td>
															<td>R$ <?= number_format( $value->calcula_valor_total_empastamento(1,$value->calcula_valor_unitario_empastamento($session_container->quantidade)), 2, ",", ".") ?></td>
															<td></td>
															<td></td>
														</tr>
														<?php
													}
													?>
													<tr>
														<?php
														if($key1 == 'papel-0'){
															//se for o papel principal contar
															?>
															<td><?= $count = $count + 1 ?></td>
															<?php
														}else{
															?>
															<td></td>
															<?php
														}
														?>
														<td><span class="glyphicon glyphicon-file"></span> <b>Papel</b></td>
														<td><?=$value->dimensao->nome?> : <?=$value->papel->papel_linha->nome?> <?=$value->papel->nome?>, <?=$value->papel->get_selected_papel_gramatura()->gramatura?>g</td>
														<td></td>
														<td><?=$value->quantidade?></td>
														<td>R$ <?= number_format($value->calcula_valor_unitario($session_container->modelo, $value->dimensao,$session_container->quantidade), 2, ",", ".") ?></td>
														<td>R$ <?= number_format($value->calcula_valor_total($value->quantidade,$value->calcula_valor_unitario($session_container->modelo,$value->dimensao,$session_container->quantidade)), 2, ",", ".") ?>
														</td>
														<?php
														$qtd_papel = count($container_papel);
														if($key1 == 'papel-0'){
															//se for o papel principal mostar com os botões
															if($qtd_papel == 1){ //1 papel (envia somente os parametros necessários)
																?>
																<td>
																	<button onclick="editar_papel_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_papel['papel-0']->dimensao->id?>,<?=$container_papel['papel-0']->papel->id?>,<?=$container_papel['papel-0']->papel->papel_linha->id?>,<?=$container_papel['papel-0']->papel->get_selected_papel_gramatura()->id?>,'','','','','','','')" id="" class="btn btn-default btn-sm">
																		<span class="glyphicon glyphicon-pencil"></span>
																	</button>
																</td>
																<?php
															}else if($qtd_papel == 2){ //2 papel (envia somente os parametros necessários)
																?>
																<td>
																	<button onclick="editar_papel_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_papel['papel-0']->dimensao->id?>,<?=$container_papel['papel-0']->papel->id?>,<?=$container_papel['papel-0']->papel->papel_linha->id?>,<?=$container_papel['papel-0']->papel->get_selected_papel_gramatura()->id?>,<?=$container_papel['papel-1']->empastamento->id?>,<?=$container_papel['papel-1']->papel->id?>,<?=$container_papel['papel-1']->papel->papel_linha->id?>,<?=$container_papel['papel-1']->papel->get_selected_papel_gramatura()->id?>,'','','')" id="" class="btn btn-default btn-sm">
																		<span class="glyphicon glyphicon-pencil"></span>
																	</button>
																</td>
																<?php
															}else{ //3 papel (envia somente os parametros necessários)
																?>
																<td>
																	<button onclick="editar_papel_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_papel['papel-0']->dimensao->id?>,<?=$container_papel['papel-0']->papel->id?>,<?=$container_papel['papel-0']->papel->papel_linha->id?>,<?=$container_papel['papel-0']->papel->get_selected_papel_gramatura()->id?>,<?=$container_papel['papel-1']->empastamento->id?>,<?=$container_papel['papel-1']->papel->id?>,<?=$container_papel['papel-1']->papel->papel_linha->id?>,<?=$container_papel['papel-1']->papel->get_selected_papel_gramatura()->id?>,<?=$container_papel['papel-2']->papel->id?>,<?=$container_papel['papel-2']->papel->papel_linha->id?>,<?=$container_papel['papel-2']->papel->get_selected_papel_gramatura()->id?>)" id="" class="btn btn-default btn-sm">
																		<span class="glyphicon glyphicon-pencil"></span>
																	</button>
																</td>
																<?php
															}
															?>
															<td>
																<button onclick="excluir_papel('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
																	<span class="glyphicon glyphicon-trash"></span>
																</button>
															</td>
															<?php
														}else{
															?>
															<td></td>
															<td></td>
															<?php
														}
														?>
													</tr>
													<?php
												}
											}
										}
										?>
										<!-- FIM: PAPEL -->
										<!-- INICIO: IMPRESSÃO -->
										<?php 
										if(!empty($session_owner->container_impressao)){
											foreach ($session_owner->container_impressao as $key => $container_impressao) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><span class="glyphicon glyphicon-print"></span> <b>Impressão</b></td>
													<td><?=$container_impressao->impressao->nome?> / <?=$container_impressao->impressao->get_selected_impressao_dimensao()->nome?>
													</td>
													<td><?=$container_impressao->descricao?></td>
													<td><?=$container_impressao->quantidade?></td>
													<td>R$ <?= number_format($container_impressao->calcula_valor_unitario($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_impressao->calcula_valor_total($container_impressao->quantidade,$container_impressao->calcula_valor_unitario($session_container->quantidade)), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_impressao_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_impressao->impressao->id?>,<?=$container_impressao->quantidade?>,'<?=$container_impressao->descricao?>',<?=$container_impressao->impressao->get_selected_impressao_dimensao()->id?>)" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_impressao('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: IMPRESSÃO -->
										<!-- INICIO: ACABAMENTO -->
										<?php 
										if(!empty($session_owner->container_acabamento)){
											foreach ($session_owner->container_acabamento as $key => $container_acabamento) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><span class="glyphicon glyphicon-scissors"></span> <b>Acabamento</b></td>
													<td><?=$container_acabamento->acabamento->nome?></td>
													<td><?=$container_acabamento->descricao?></td>
													<td><?=$container_acabamento->quantidade?></td>
													<td>R$ <?= number_format($container_acabamento->calcula_valor_unitario($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_acabamento->calcula_valor_total($container_acabamento->quantidade,$container_acabamento->calcula_valor_unitario($session_container->quantidade)), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_acabamento_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_acabamento->acabamento->id?>,<?=$container_acabamento->quantidade?>,'<?=$container_acabamento->descricao?>')" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_acabamento('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: ACABAMENTO -->
										<!-- INICIO: ACESSÓRIO -->
										<?php 
										if(!empty($session_owner->container_acessorio)){
											foreach ($session_owner->container_acessorio as $key => $container_acessorio) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><i class="fa fa-diamond" aria-hidden="true"></i> <b>Acessório</b></td>
													<td><?=$container_acessorio->acessorio->nome?></td>
													<td><?=$container_acessorio->descricao?></td>
													<td><?=$container_acessorio->quantidade?></td>
													<td>R$ <?= number_format($container_acessorio->calcula_valor_unitario(), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_acessorio->calcula_valor_total($container_acessorio->quantidade,$container_acessorio->calcula_valor_unitario()), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_acessorio_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_acessorio->acessorio->id?>,<?=$container_acessorio->quantidade?>,'<?=$container_acessorio->descricao?>')" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_acessorio('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: ACESSORIO -->
										<!-- INICIO: FITA -->
										<?php 
										if(!empty($session_owner->container_fita)){
											foreach ($session_owner->container_fita as $key => $container_fita) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><span class="glyphicon glyphicon-tags"></span> <b>Fita</b></td>
													<td><?=$container_fita->fita->fita_material->nome?>(<?=$container_fita->espessura?>mm) / <?=$container_fita->fita->fita_laco->nome?></td>
													<td><?=$container_fita->descricao?></td>
													<td><?=$container_fita->quantidade?></td>
													<td>R$ <?= number_format($container_fita->calcula_valor_unitario(), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_fita->calcula_valor_total($container_fita->quantidade,$container_fita->calcula_valor_unitario()), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_fita_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_fita->fita->id?>,<?=$container_fita->quantidade?>,'<?=$container_fita->descricao?>',<?=$container_fita->espessura?>,<?=$container_fita->fita->fita_material->id?>)" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<a onclick="excluir_fita('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</a>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: FITA -->
										<!-- INICIO: CLICHÊ -->
										<?php 
										if(!empty($session_owner->container_cliche)){
											foreach ($session_owner->container_cliche as $key => $container_cliche) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><span class="glyphicon glyphicon-registration-mark"></span> <b>Clichê</b></td>
													<td><?=$container_cliche->cliche->nome?> / <?=$container_cliche->cliche->get_selected_cliche_dimensao()->nome?>
													</td>
													<td><?=$container_cliche->descricao?></td>
													<td><?=$container_cliche->quantidade?></td>
													<td>R$ <?= number_format($container_cliche->calcula_valor_unitario($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_cliche->calcula_valor_total($container_cliche->quantidade,$container_cliche->calcula_valor_unitario($session_container->quantidade)), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_cliche_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_cliche->cliche->id?>,<?=$container_cliche->quantidade?>,'<?=$container_cliche->descricao?>',<?=$container_cliche->cliche->get_selected_cliche_dimensao()->id?>,<?=$container_cliche->cobrar_servico?>,<?=$container_cliche->cobrar_cliche?>)" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_cliche('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: CLICHÊ -->
										<!-- INICIO: FACA -->
										<?php 
										if(!empty($session_owner->container_faca)){
											foreach ($session_owner->container_faca as $key => $container_faca) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><i class="fa fa-map-o" aria-hidden="true"></i> <b>Faca</b></td>
													<td><?=$container_faca->faca->nome?> / <?=$container_faca->faca->get_selected_faca_dimensao()->nome?>
													</td>
													<td><?=$container_faca->descricao?></td>
													<td><?=$container_faca->quantidade?></td>
													<td>R$ <?= number_format($container_faca->calcula_valor_unitario($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_faca->calcula_valor_total($container_faca->quantidade,$container_faca->calcula_valor_unitario($session_container->quantidade)), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_faca_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_faca->faca->id?>,<?=$container_faca->quantidade?>,'<?=$container_faca->descricao?>',<?=$container_faca->faca->get_selected_faca_dimensao()->id?>,<?=$container_faca->cobrar_servico?>,<?=$container_faca->cobrar_faca?>)" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_faca('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: FACA -->
										<!-- INICIO: LASER -->
										<?php
										if(!empty($session_owner->container_laser)){
											foreach ($session_owner->container_laser as $key => $container_laser) {
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><span class="glyphicon glyphicon-flash"></span> <b>Laser</b></td>
													<td><?=$container_laser->laser->nome?></td>
													<td><?=$container_laser->descricao?></td>
													<td><?=$container_laser->quantidade?></td>
													<td>R$ <?= number_format($container_laser->calcula_valor_unitario($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_laser->calcula_valor_total($container_laser->quantidade,$container_laser->calcula_valor_unitario($session_container->quantidade)), 2, ",", ".") ?></td>
													<td>
														<button onclick="editar_laser_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_laser->laser->id?>,<?=$container_laser->quantidade?>,<?=$container_laser->qtd_minutos?>,'<?=$container_laser->descricao?>')" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_laser('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										}
										?>
										<!-- FIM: ACABAMENTO -->
									</tbody>
									<tfoot>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th>Sub-total</th>
											<th>R$ <?=number_format($session_owner->calcula_total($session_container->modelo,$session_container->quantidade),2,',','.')?></th>
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
		</div>
	</div>
	<?php
}
?>