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
			                </div>
			            </div>
			        </nav>
			        <div class="row">
			            <div class="col-md-12">
			                <div class="table-responsive">
								<table id="<?=$tabela_id?>" class="table table-hover table-condensed">
									<tr>
										<th>#</th>
										<th>Material</th>
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
												if($container_papel->empastamento->adicionar == 1){
													$glyphicon = 'glyphicon glyphicon-duplicate';
												}else{
													$glyphicon = 'glyphicon glyphicon-file';
												}
												?>
												<tr>
													<td><?= $count = $count + 1 ?></td>
													<td><span class="<?=$glyphicon?>"></span> <b>Papel</b></td>
													<td><?=$container_papel->dimensao->nome?> : <?=$container_papel->papel->papel_linha->nome?> <?=$container_papel->papel->nome?>, <?=$container_papel->papel->get_selected_papel_gramatura()->gramatura?>g</td>
													<td></td>
													<td><?=$container_papel->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario($session_container->modelo, $container_papel->dimensao,$session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total($container_papel->quantidade,$container_papel->calcula_valor_unitario($session_container->modelo,$container_papel->dimensao,$session_container->quantidade)), 2, ",", ".") ?>
													</td>
													<td>
														<button onclick="editar_papel_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_papel->papel->id?>,<?=$container_papel->dimensao->id?>,<?=$container_papel->papel->papel_linha->id?>,<?=$container_papel->papel->get_selected_papel_gramatura()->id?>,<?=$container_papel->empastamento->adicionar?>,<?=$container_papel->empastamento->quantidade?>,<?=$container_papel->empastamento->cobrar_servico?>,<?=$container_papel->laminacao->adicionar?>,<?=$container_papel->laminacao->quantidade?>,<?=$container_papel->laminacao->cobrar_servico?>,<?=$container_papel->douracao->adicionar?>,<?=$container_papel->douracao->quantidade?>,<?=$container_papel->douracao->cobrar_servico?>,<?=$container_papel->corte_laser->adicionar?>,<?=$container_papel->corte_laser->quantidade?>,<?=$container_papel->corte_laser->cobrar_servico?>,<?=$container_papel->corte_laser->corte_laser_minutos?>,<?=$container_papel->relevo_seco->adicionar?>,<?=$container_papel->relevo_seco->quantidade?>,<?=$container_papel->relevo_seco->cobrar_servico?>,<?=$container_papel->relevo_seco->cobrar_faca_cliche?>,<?=$container_papel->hot_stamping->adicionar?>,<?=$container_papel->hot_stamping->quantidade?>,<?=$container_papel->hot_stamping->cobrar_servico?>,<?=$container_papel->hot_stamping->cobrar_faca_cliche?>,<?=$container_papel->corte_vinco->adicionar?>,<?=$container_papel->corte_vinco->quantidade?>,<?=$container_papel->corte_vinco->cobrar_servico?>,<?=$container_papel->corte_vinco->cobrar_faca_cliche?>,<?=$container_papel->almofada->adicionar?>,<?=$container_papel->almofada->quantidade?>,<?=$container_papel->almofada->cobrar_servico?>,<?=$container_papel->almofada->cobrar_faca_cliche?>)" id="" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-pencil"></span>
														</button>
													</td>
													<td>
														<button onclick="excluir_papel('<?=$session_owner->owner?>',<?=$key?>)" class="btn btn-default btn-sm">
															<span class="glyphicon glyphicon-trash"></span>
														</button>
													</td>
												</tr>
												<?php ($container_papel->empastamento->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-align-justify"></span> <b><?=$container_papel->empastamento->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->empastamento->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_empastamento($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_empastamento($container_papel->calcula_valor_unitario_empastamento($session_container->quantidade),$container_papel->empastamento->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->laminacao->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-open-file"></span> <b><?=$container_papel->laminacao->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->laminacao->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_laminacao($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_laminacao($container_papel->calcula_valor_unitario_laminacao($session_container->quantidade),$container_papel->laminacao->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->douracao->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-certificate"></span> <b><?=$container_papel->douracao->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->douracao->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_douracao($session_container->quantidade), 2, ",", ".") ?></span></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_douracao($container_papel->calcula_valor_unitario_douracao($session_container->quantidade),$container_papel->douracao->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->corte_laser->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-flash"></span> <b><?=$container_papel->corte_laser->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->corte_laser->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_corte_laser($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_corte_laser($container_papel->calcula_valor_unitario_corte_laser($session_container->quantidade),$container_papel->corte_laser->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->relevo_seco->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-object-align-bottom"></span> <b><?=$container_papel->relevo_seco->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->relevo_seco->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_relevo_seco($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_relevo_seco($container_papel->calcula_valor_unitario_relevo_seco($session_container->quantidade),$container_papel->relevo_seco->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->hot_stamping->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-registration-mark"></span> <b><?=$container_papel->hot_stamping->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->hot_stamping->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_hot_stamping($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_hot_stamping($container_papel->calcula_valor_unitario_hot_stamping($session_container->quantidade),$container_papel->hot_stamping->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->corte_vinco->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-th"></span> <b><?=$container_papel->corte_vinco->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->corte_vinco->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_corte_vinco($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_corte_vinco($container_papel->calcula_valor_unitario_corte_vinco($session_container->quantidade),$container_papel->corte_vinco->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php ($container_papel->almofada->quantidade == 0) ? $class = "hidden" : $class = ""?>
												<tr class="<?=$class?>">
													<td></td>
													<td><span class="glyphicon glyphicon-unchecked"></span> <b><?=$container_papel->almofada->papel_acabamento->nome?></b></td>
													<td></td>
													<td></td>
													<td><?=$container_papel->almofada->quantidade?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_unitario_almofada($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_papel->calcula_valor_total_almofada($container_papel->calcula_valor_unitario_almofada($session_container->quantidade),$container_papel->almofada->quantidade), 2, ",", ".") ?></td>
													<td></td>
													<td></td>
												</tr>
												<?php
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
													<td><?=$container_impressao->impressao->nome?> / <?=$container_impressao->impressao->impressao_area->nome?>
													</td>
													<td><?=$container_impressao->descricao?></td>
													<td><?=$container_impressao->quantidade?></td>
													<td>R$ <?= number_format($container_impressao->calcula_valor_unitario($session_container->quantidade), 2, ",", ".") ?></td>
													<td>R$ <?= number_format($container_impressao->calcula_valor_total($container_impressao->quantidade,$container_impressao->calcula_valor_unitario($session_container->quantidade)), 2, ",", ".") ?>
													</td>
													<td>
														<button onclick="editar_impressao_modal('<?=$session_owner->owner?>',<?=$key?>,<?=$container_impressao->impressao->id?>,<?=$container_impressao->impressao->impressao_area->id?>,<?=$container_impressao->quantidade?>,'<?=$container_impressao->descricao?>')" id="" class="btn btn-default btn-sm">
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
									</tbody>
									<tfoot>
										<tr>
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