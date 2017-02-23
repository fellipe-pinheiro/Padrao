<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class;
if($controller === 'orcamento'){
	$orcamento = $dados['orcamento'];
}else if($controller === 'pedido'){
	$orcamento = $dados['pedido']->orcamento;
}
?>
<div class="container">
	<!-- Cabeçalho -->
	<div class="row">
		<?php
		$cliente =  $orcamento->cliente;
		$convites =  $orcamento->convite;
		$personalizados =  $orcamento->personalizado;
		$produtos =  $orcamento->produto;
		$loja =  $orcamento->loja;
		?>
		<!-- Logo -->
		<div class="col-lg-3 col-md-3 col-xs-3">
			<?= img(array('src'   => '/assets/imagens/logo_cgolin.png','alt'   => 'Logo da empresa','class' => '','width' => '150','height'=> 'auto','title' => 'Logo da empresa')); ?>
		</div>
		<!-- Loja -->
		<div class="col-lg-6 col-md-6 col-xs-6" style="font-size: 12px">
			<h4><?=$loja->razao_social?></h4>
			<p>CNPJ: <?=$loja->cnpj?></p>
			<p><?=$loja->endereco?>, <?=$loja->numero?> - <?=$loja->complemento?> <?=$loja->bairro?> - <?=$loja->cidade?> / <?=$loja->uf?></p>
			<p>Telefone: <?=$loja->telefone?></p>
		</div>
		<!-- Data / Número-->
		<div class="col-lg-3 col-md-3 col-xs-3">
			<p class="pull-right">
				Data: <?=$orcamento->get_data_hora()?><br>
			</p>
			<?=$dados['documento_numero'] ?>
		</div>
	</div>
	<!-- Cliente -->
	<div class="row">
		<div class="col-lg-12 col-md-12">
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
		<div class="col-lg-12 col-md-12">
			<h4>Produtos</h4>
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
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
							<td><?=$count?></td>
							<td>Convite</td>
							<td><?=$convite->modelo->nome?></td>
							<td><?=$convite->data_entrega?></td>
							<td><?=$convite->quantidade?></td>
							<td>R$ <span class="pull-right"><?=number_format($convite->calcula_unitario(),2,',','.')?></span></td>
							<td>R$ <span class="pull-right"><?=number_format($convite->calcula_total(),2,',','.')?></span></td>
						</tr>
						<?php
						$count ++;
					}
					//PERSONALIZADOS
					foreach ($personalizados as $key => $personalizado) {
						?>
						<tr>
							<td><?=$count?></td>
							<td>Personalizado</td>
							<td><?=$personalizado->modelo->nome?></td>
							<td><?=$personalizado->data_entrega?></td>
							<td><?=$personalizado->quantidade?></td>
							<td>R$ <span class="pull-right"><?=number_format($personalizado->calcula_unitario(),2,',','.')?></span></td>
							<td>R$ <span class="pull-right"><?=number_format($personalizado->calcula_total(),2,',','.')?></span></td>
						</tr>
						<?php
						$count ++;
					}
					//PRODUTOS
					foreach ($produtos as $key => $container) {
						?>
						<tr>
							<td><?=$count?></td>
							<td><?=$container->produto->produto_categoria->nome?></td>
							<td><?=$container->produto->nome?></td>
							<td><?=$container->data_entrega?></td>
							<td><?=$container->quantidade?></td>
							<td>R$ <span class="pull-right"><?=number_format($container->calcula_unitario(),2,',','.')?></span></td>
							<td>R$ <span class="pull-right"><?=number_format($container->calcula_total(),2,',','.')?></span></td>
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
							<td>Desconto</td>
							<td>R$ <span class="pull-right"><?=number_format($orcamento->desconto,2,',','.')?></span></td>
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
	<!-- Detalhes -->
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h4>Detalhes</h4>
			<?php
			$arr_produtos = array();
			foreach ($convites as $key => $convite) {
				$arr_produtos[] = array('convite' => $convite);
			}
			foreach ($personalizados as $key => $personalizado) {
				$arr_produtos[] = array('personalizado' => $personalizado);
			}
			$count = 1;
			foreach ($arr_produtos as $key => $produto) {
				if(key($produto) === 'convite'){

					$produto = $produto['convite'];

					$arr = array("cartao", "envelope");

				}else if(key($produto) === 'personalizado'){

					$produto = $produto['personalizado'];

					$arr = array("personalizado");
				}
				?>
				<h4><span class="label label-default">#<?=$count?> <?=$produto->modelo->nome?></span></h4>
				<br>
				<?php
				foreach ($arr as $key => $value) {
					if($value === 'cartao'){
						$container = $produto->cartao;
					}else if($value === 'envelope'){
						$container = $produto->envelope;
					}else if($value === 'personalizado'){
						$container = $produto->personalizado;
					}
					if($value === 'personalizado'){
						?>
						<span class="badge"><?=$produto->modelo->nome?></span>
						<?php
					}else{
						?>
						<span class="badge"><?=$value?></span>
						<?php
					}
					?>
					<p class="text-justify p-margin">
						<?php
						//PAPEL:
						if(!empty($container->container_papel)){
							foreach ($container->container_papel as $key => $container_papel) {
								?>
								<strong class="text-uppercase">Papel: </strong>
								(<?=$container_papel->quantidade?>) <?=$container_papel->papel->nome?>  <?=$container_papel->papel->get_selected_papel_gramatura()->gramatura?>g 
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
					</p>
					<?php
				}
				?>
				<?php
				if(!empty($produto->descricao)){
					?>
					<p><strong>Descrição:</strong> <?=$produto->descricao?></p>
					<?php
				}
				?>
				<hr>
				<?php
				$count++;
			}
			foreach ($produtos as $key => $produto) {
				?>
				<h4><span class="label label-default">#<?=$count?> <?=$produto->produto->produto_categoria->nome?></span></h4>
				<span class="badge"><?=$produto->produto->nome?></span>
				<strong class="text-uppercase">Detalhe: </strong>
				<?=$produto->descricao?> - <strong class="text-uppercase">Descrição: </strong><?=$produto->produto->descricao?>
				<hr>
				<?php
				$count++;
			}
			?>
		</div>
	</div>
	<!-- Forma de pagamento -->
	<div class="row">
		<?php
		if($controller === 'pedido'){
			?>
			<div class="col-lg-12 col-md-12">
				<h4>Parcelas</h4>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Lançamento</th>
							<th>Vencimento</th>
							<th>Pagamento</th>
							<th>Descrição</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($dados['pedido']->cliente_debitos)){
							foreach ($dados['pedido']->cliente_debitos as $key => $debito) {
								if(!empty($debito->vencimento)){
									$vencimento = date_to_form($debito->vencimento);
								}else{
									$vencimento = "";
								}
								if(!$debito->cancelado && !$debito->adicional && !$debito->multa){

									?>
									<tr>
										<td><?=$debito->id?></td>
										<td><?=$vencimento?></td>
										<td><?=$debito->forma_pagamento->nome?></td>
										<td><?=$debito->descricao?></td>
										<td>R$ <?=number_format($debito->valor,2,',','.')?></td>
									</tr>
									<?php
								}
							}
						}
						?>
					</tbody>
				</table>
				<hr>
				<h4>Condições de pagamento</h4>
				<?=$dados['pedido']->condicoes?>
				<hr>
			</div>
			<?php
		}
		?>
	</div>
	<!-- Rodapé -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12">
			<p>Li e confirmo as informações acima descritas neste documento.</p>
		</div>
		<div class="col-lg-6 col-md-6 col-xs-6">
			<h4>Responsável</h4>
			<p>______________________________________</p>
			<p>Assinatura</p>
		</div>
		<div class="col-lg-6 col-md-6 col-xs-6">
			<h4>Vendedor</h4>
			<p>______________________________________</p>
			<p>Assinatura</p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		window.print();
	});
</script>
<style>
	* {
		text-shadow:none !important;
		filter:none !important;
		-ms-filter:none !important;
	}
	body {
		margin:0;
		padding:0;
		line-height: 1.4em;
		letter-spacing: 0.2px;
		font: 12pt, "Times New Roman", Times, serif;
		color: #000;
	}
	nav, footer, video, audio, object, embed { 
		display:none; 
	}
	body > div > div:nth-child(1){
		display:none;
	}
	h1 {
		font-size: 24pt;
	}

	h2 {
		font-size: 18pt;
	}

	h3 {
		font-size: 14pt;
	}
	p {
		font-size: 10pt;
	}
</style>