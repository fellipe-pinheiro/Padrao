<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$orcamento = $dados['pedido']->orcamento;

$cliente =  $orcamento->cliente;
$convites =  $orcamento->convite;
$personalizados =  $orcamento->personalizado;
$produtos =  $orcamento->produto;
$loja =  $orcamento->loja;

?>
<!-- Cabeçalho -->
<div class="row">
	<div class="col-md-12">
		<h3 class="pull-right">
			Data: <?=$dados['data']?><br>
			<?=$dados['documento_numero'] ?>
		</h3>
	</div>
</div>
<!-- Cliente -->
<div class="row">
	<div class="col-md-12">
		<h4>Dados do cliente</h4>
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<th>Nome / Razão Social</th>
					<th>CPF / CNPJ</th>
					<th>Email</th>
					<th>Telefone</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($cliente->pessoa_tipo === 'fisica'): ?>
					<tr>
						<td><?=$cliente->nome?> <?=$cliente->sobrenome?></td>
						<td><?=$cliente->cpf?></td>
						<td><?=$cliente->email?></td>
						<td><?=$cliente->telefone?></td>
					</tr>
				<?php else: ?>
					<tr>
						<td><?=$cliente->razao_social?> </td>
						<td><?=$cliente->cnpj?></td>
						<td><?=$cliente->email?></td>
						<td><?=$cliente->telefone?></td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
<hr>
<!-- Produtos -->
<div class="row">
	<div class="col-md-12">
		<h4>Produtos</h4>
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<th></th>
					<th>#</th>
					<th>Categoria</th>
					<th>Produto</th>
					<th>Entrega</th>
					<th>Qtd</th>
					<th>Unitário</th>
					<th>Sub-total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count = 1;
					//CONVITES
				foreach ($convites as $key => $convite) {
					?>

					<tr>
						<td onclick="show_datails('dt-<?=$count?>')">
							<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
						</td>
						<td><?=$count?></td>
						<td>Convite</td>
						<td><?=$convite->modelo->nome?></td>
						<td><?=$convite->data_entrega?></td>
						<td><?=$convite->quantidade?></td>
						<td>R$ <span class="pull-right"><?=number_format($convite->calcula_unitario(),5,',','.')?></span></td>
						<td>R$ <span class="pull-right"><?=number_format($convite->calcula_total(),2,',','.')?></span></td>


					</tr>
					<tr class="hidden" id="dt-<?=$count?>">
						<td colspan="8">
							<?php 
							for ($i=0; $i < 2; $i++) { 
								if($i===0){
									$container = $convite->cartao;
								}else{
									$container = $convite->envelope;
								}
								print "<br><span class='badge'>$container->owner</span>";
										//PAPEL:
								if(!empty($container->container_papel)){
									foreach ($container->container_papel as $key => $container_papel) {
										?>
										<strong class="text-uppercase">Papel: </strong>
										(<?=$container_papel->quantidade?>) <?=$container_papel->papel->nome?>  <?=$container_papel->gramatura?>g 
										<?php 
										$empastamento = $container_papel->empastamento;
										if(!empty($empastamento->adicionar)){
											?>
											(<?=$empastamento->quantidade?>) <?=$empastamento->papel_acabamento->nome?>
											<?php
										}
										$laminacao = $container_papel->laminacao;
										if(!empty($laminacao->adicionar)){
											?>
											(<?=$laminacao->quantidade?>) <?=$laminacao->papel_acabamento->nome?>
											<?php
										}
										$douracao = $container_papel->douracao;
										if(!empty($douracao->adicionar)){
											?>
											(<?=$douracao->quantidade?>) <?=$douracao->papel_acabamento->nome?>
											<?php
										}
										$corte_laser = $container_papel->corte_laser;
										if(!empty($corte_laser->adicionar)){
											?>
											(<?=$corte_laser->quantidade?>) <?=$corte_laser->papel_acabamento->nome?>
											<?php
										}
										$relevo_seco = $container_papel->relevo_seco;
										if(!empty($relevo_seco->adicionar)){
											?>
											(<?=$relevo_seco->quantidade?>) <?=$relevo_seco->papel_acabamento->nome?>
											<?php
										}
										$almofada = $container_papel->almofada;
										if(!empty($almofada->adicionar)){
											?>
											(<?=$almofada->quantidade?>) <?=$almofada->papel_acabamento->nome?>
											<?php
										}
										?> 
										<?php
									}
								}
										//IMPRESSÃO
								if(!empty($container->container_impressao)){
									foreach ($container->container_impressao as $key => $container_impressao) {
										?>
										<strong class="text-uppercase">Impressão: </strong>
										(<?=$container_impressao->quantidade?>) <?=$container_impressao->impressao->nome?> (<?=$container_impressao->descricao?>)
										<?php
									}
								}
										//ACABAMENTO
								if(!empty($container->container_acabamento)){
									foreach ($container->container_acabamento as $key => $container_acabamento) {
										?>
										<strong class="text-uppercase">Acabamento: </strong>
										(<?=$container_acabamento->quantidade?>) <?=$container_acabamento->acabamento->nome?> (<?=$container_acabamento->descricao?>)
										<?php
									}
								}
										//ASSESSÓRIO
								if(!empty($container->container_acessorio)){
									foreach ($container->container_acessorio as $key => $container_acessorio) {
										?>
										<strong class="text-uppercase">Acessório: </strong>
										(<?=$container_acessorio->quantidade?>) <?=$container_acessorio->acessorio->nome?> (<?=$container_acessorio->descricao?>)
										<?php
									}
								}
										//FITA
								if(!empty($container->container_fita)){
									foreach ($container->container_fita as $key => $container_fita) {
										?>
										<strong class="text-uppercase">Fita: </strong>
										(<?=$container_fita->quantidade?>) <?=$container_fita->fita->fita_laco->nome?> <?=$container_fita->fita->fita_material->nome?> <?=$container_fita->espessura?>mm (<?=$container_fita->descricao?>)
										<?php
									}
								}
							}
							?>
						</td>
					</tr>
					<?php
					$count ++;
				}
					//PERSONALIZADOS
				foreach ($personalizados as $key => $personalizado) {
					?>
					<tr>
						<td onclick="show_datails('dt-<?=$count?>')">
							<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
						</td>
						<td><?=$count?></td>
						<td>Personalizado</td>
						<td><?=$personalizado->modelo->nome?></td>
						<td><?=$personalizado->data_entrega?></td>
						<td><?=$personalizado->quantidade?></td>
						<td>R$ <span class="pull-right"><?=number_format($personalizado->calcula_unitario(),5,',','.')?></span></td>
						<td>R$ <span class="pull-right"><?=number_format($personalizado->calcula_total(),2,',','.')?></span></td>
					</tr>
					<tr class="hidden" id="dt-<?=$count?>">
						<td colspan="8">
							<span class="badge"><?=$personalizado->modelo->nome?></span>
							<?php 
							$container = $personalizado->personalizado;
									//PAPEL:
							if(!empty($container->container_papel)){
								foreach ($container->container_papel as $key => $container_papel) {
									?>
									<strong class="text-uppercase">Papel: </strong>
									(<?=$container_papel->quantidade?>) <?=$container_papel->papel->nome?>  <?=$container_papel->gramatura?>g 
									<?php 
									$empastamento = $container_papel->empastamento;
									if(!empty($empastamento->adicionar)){
										?>
										(<?=$empastamento->quantidade?>) <?=$empastamento->papel_acabamento->nome?>
										<?php
									}
									$laminacao = $container_papel->laminacao;
									if(!empty($laminacao->adicionar)){
										?>
										(<?=$laminacao->quantidade?>) <?=$laminacao->papel_acabamento->nome?>
										<?php
									}
									$douracao = $container_papel->douracao;
									if(!empty($douracao->adicionar)){
										?>
										(<?=$douracao->quantidade?>) <?=$douracao->papel_acabamento->nome?>
										<?php
									}
									$corte_laser = $container_papel->corte_laser;
									if(!empty($corte_laser->adicionar)){
										?>
										(<?=$corte_laser->quantidade?>) <?=$corte_laser->papel_acabamento->nome?>
										<?php
									}
									$relevo_seco = $container_papel->relevo_seco;
									if(!empty($relevo_seco->adicionar)){
										?>
										(<?=$relevo_seco->quantidade?>) <?=$relevo_seco->papel_acabamento->nome?>
										<?php
									}
									$almofada = $container_papel->almofada;
									if(!empty($almofada->adicionar)){
										?>
										(<?=$almofada->quantidade?>) <?=$almofada->papel_acabamento->nome?>
										<?php
									}
									?> 
									<?php
								}
							}
										//IMPRESSÃO
							if(!empty($container->container_impressao)){
								foreach ($container->container_impressao as $key => $container_impressao) {
									?>
									<strong class="text-uppercase">Impressão: </strong>
									(<?=$container_impressao->quantidade?>) <?=$container_impressao->impressao->nome?> (<?=$container_impressao->descricao?>)
									<?php
								}
							}
										//ACABAMENTO
							if(!empty($container->container_acabamento)){
								foreach ($container->container_acabamento as $key => $container_acabamento) {
									?>
									<strong class="text-uppercase">Acabamento: </strong>
									(<?=$container_acabamento->quantidade?>) <?=$container_acabamento->acabamento->nome?> (<?=$container_acabamento->descricao?>)
									<?php
								}
							}
										//ASSESSÓRIO
							if(!empty($container->container_acessorio)){
								foreach ($container->container_acessorio as $key => $container_acessorio) {
									?>
									<strong class="text-uppercase">Acessório: </strong>
									(<?=$container_acessorio->quantidade?>) <?=$container_acessorio->acessorio->nome?> (<?=$container_acessorio->descricao?>)
									<?php
								}
							}
										//FITA
							if(!empty($container->container_fita)){
								foreach ($container->container_fita as $key => $container_fita) {
									?>
									<strong class="text-uppercase">Fita: </strong>
									(<?=$container_fita->quantidade?>) <?=$container_fita->fita->fita_laco->nome?> <?=$container_fita->fita->fita_material->nome?> <?=$container_fita->espessura?>mm (<?=$container_fita->descricao?>)
									<?php
								}
							}
							?>
						</td>
					</tr>
					<?php
					$count ++;
				}
					//PRODUTOS
				foreach ($produtos as $key => $container) {
					?>
					<tr>
						<td onclick="show_datails('dt-<?=$count?>')">
							<span class="glyphicon glyphicon-plus-sign clickable" aria-hidden="true"></span>
						</td>
						<td><?=$count?></td>
						<td><?=$container->produto->produto_categoria->nome?></td>
						<td><?=$container->produto->nome?></td>
						<td><?=$container->data_entrega?></td>
						<td><?=$container->quantidade?></td>
						<td>R$ <span class="pull-right"><?=number_format($container->calcula_unitario(),5,',','.')?></span></td>
						<td>R$ <span class="pull-right"><?=number_format($container->calcula_total(),2,',','.')?></span></td>
					</tr>
					<tr class="hidden" id="dt-<?=$count?>">
						<td colspan="8">
							<?php 
							print $container->descricao."<br>";
							print $container->produto->descricao."<br>";
							?>
						</td>
					</tr>
					<?php
					$count ++;
				}
				?>
			</tbody>
			<tfoot>
				<?php
				if(!empty($orcamento->desconto)){
					?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Desconto</td>
						<td>R$ <span class="pull-right"><?=number_format($orcamento->desconto,2,',','.')?></span></td>
					</tr>
					<?php 
				}
				if(!empty($orcamento->calcula_custos_administrativos())){
					?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Custos admin.</td>
						<td>R$ <span class="pull-right"><?=number_format($orcamento->calcula_custos_administrativos(),2,',','.')?></span></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>Total a pagar</th>
					<th>R$ <span class="pull-right"><?=number_format($orcamento->calcula_total(),2,',','.')?></span></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<hr>
<!-- Descrição -->
<div class="row">
	<div class="col-md-12">
		<h4>Descrição</h4>
		<p><?=$orcamento->descricao?></p>
	</div>
</div>
<hr>
<!-- Condições -->
<div class="row">
	<div class="col-md-12">
		<h4>Condições de pagamento</h4>
		<?=$dados['pedido']->condicoes?>
	</div>
</div>
<hr>	
<!-- Debito e crédito -->
<div class="row">
	<div class="col-md-6">
		<h4>Debitos</h4>
		<div class="table-responsive">
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>data</th>
						<th>vencimento</th>
						<th>forma_pagamento</th>
						<th>descricao</th>
						<th>valor</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($dados['pedido']->cliente_debitos)) {
						foreach ($dados['pedido']->cliente_debitos as $key => $debito) {
							if(!empty($debito->vencimento)){
								list($ano, $mes, $dia) = explode("-", $debito->vencimento);
								$vencimento = $dia."/".$mes."/".$ano;
							}else{
								$vencimento = "";
							}
							list($ano, $mes, $dia) = explode("-", $debito->data);
							$data = $dia."/".$mes."/".$ano;
							?>
							<tr>
								<td><?=$debito->id?></td>
								<td><?=$data?></td>
								<td><?=$vencimento?></td>
								<td><?=$debito->forma_pagamento->nome?></td>
								<td><?=$debito->descricao?></td>
								<td>R$ <?=number_format($debito->valor,2,',','.')?></td>
							</tr>
							<!-- Fazer um foreach dentro dos $cliente_creditos-->
							<!-- Se $debito->id === ao fk e o montante for igual ao $debito->valor, este boleto está quitado-->
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
						<th>R$ <?=number_format($dados['total_debitos'],2,',','.')?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<h4>Creditos</h4>
		<div class="table-responsive">
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>vencimento</th>
						<th>forma_pagamento</th>
						<th>descricao</th>
						<th>valor</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($dados['pedido']->cliente_creditos)) {
						foreach ($dados['pedido']->cliente_creditos as $key => $cliente_conta) {
							if(!empty($cliente_conta->vencimento)){
								list($ano, $mes, $dia) = explode("-", $cliente_conta->vencimento);
								$vencimento = $dia."/".$mes."/".$ano;
							}else{
								$vencimento = "";
							}
							?>
							<tr>
								<td><?=$cliente_conta->id?></td>
								<td><?=$vencimento?></td>
								<td><?=$cliente_conta->forma_pagamento->nome?></td>
								<td><?=$cliente_conta->descricao?></td>
								<td>R$ <?=number_format($cliente_conta->valor,2,',','.')?></td>
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
						<th>R$ <?=number_format($dados['total_creditos'],2,',','.')?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<hr>
<!-- Saldo -->
<div class="row">
	<div class="col-md-12">
		<h4>Resumo</h4>
		<ul class="list-group">
			<li class="list-group-item"><h4>Saldo devedor <span class="pull-right">R$ <?=number_format($dados['total_debitos'],2,',','.')?></span></h4></li>
			<li class="list-group-item"><h4>Saldo credor<span class="pull-right">R$ <?=number_format($dados['total_creditos'],2,',','.')?></span></h4></li>
			<li class="list-group-item"><h4>Saldo total<span class="pull-right">R$ <?=number_format($dados['saldo'],2,',','.')?></span></h4></li>
		</ul>
	</div>
</div>