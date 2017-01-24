<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$adicional = $dados['adicional'];
$cliente =  $adicional->cliente; // Fazer o adicional trazer o cliente
$convites =  $adicional->convite;
$personalizados =  $adicional->personalizado;
$produtos =  $adicional->produto;
$loja =  $adicional->loja;
?>
<div class="container">
	<!-- Cabeçalho -->
	<div class="row">
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
		<!-- Número-->
		<div class="col-lg-3 col-md-3 col-xs-3">
			<p class="pull-right">
				Data: <?=$dados['data']?><br>
			</p>
			<h3 class="pull-right"><strong>Adicional N° <?=$adicional->pedido?>/<?=$adicional->id?></strong></h3><br>
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
					if(!empty($convites)){
						foreach ($convites as $key => $convite) {
							?>
							<tr>
								<td><?=$count?></td>
								<td>Convite</td>
								<td><?=$convite->objeto->modelo->nome?></td>
								<td><?=$convite->data_entrega?></td>
								<td><?=$convite->quantidade?></td>
								<td>R$ <?=number_format($convite->calcula_unitario(),2,',','.')?></td>
								<td>R$ <?=number_format($convite->calcula_total(),2,',','.')?></td>
							</tr>
							<?php
							$count ++;
						}
					}
					//PERSONALIZADOS
					if(!empty($personalizados)){
						foreach ($personalizados as $key => $personalizado) {
							?>
							<tr>
								<td><?=$count?></td>
								<td>Personalizado</td>
								<td><?=$personalizado->objeto->modelo->nome?></td>
								<td><?=$personalizado->data_entrega?></td>
								<td><?=$personalizado->quantidade?></td>
								<td>R$ <?=number_format($personalizado->calcula_unitario(),2,',','.')?></td>
								<td>R$ <?=number_format($personalizado->calcula_total(),2,',','.')?></td>
							</tr>
							<?php
							$count ++;
						}
					}
					//PRODUTOS
					if(!empty($produtos)){
						foreach ($produtos as $key => $produto) {
							?>
							<tr>
								<td><?=$count?></td>
								<td><?=$produto->objeto->produto->produto_categoria->nome?></td>
								<td><?=$produto->objeto->produto->nome?></td>
								<td><?=$produto->data_entrega?></td>
								<td><?=$produto->quantidade?></td>
								<td>R$ <?=number_format($produto->calcula_unitario(),2,',','.')?></td>
								<td>R$ <?=number_format($produto->calcula_total(),2,',','.')?></td>
							</tr>
							<?php
							$count ++;
						}
					}
					?>
				</tbody>
				<tfoot>
					<?php
					if(!empty($adicional->desconto) && $adicional->desconto != "0.00"){
						?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Desconto</td>
							<td>R$ <?=number_format($adicional->desconto,2,',','.')?></td>
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
						<th>R$ <?=number_format($adicional->calcula_total(),2,',','.')?></th>
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
			<p><?=$adicional->descricao?></p>
		</div>
	</div>
	<hr>
	<!-- Forma de pagamento -->
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<h4>Parcelas</h4>
			<table class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>Lançamento</th>
						<th>vencimento</th>
						<th>forma_pagamento</th>
						<th>descricao</th>
						<th>valor</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($adicional->cliente_debitos as $key => $debito) {
						if(!empty($debito->vencimento)){
							list($ano, $mes, $dia) = explode("-", $debito->vencimento);
							$vencimento = $dia."/".$mes."/".$ano;
						}else{
							$vencimento = "";
						}
						if(!$debito->cancelado && $debito->adicional && !$debito->multa){

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
					?>
				</tbody>
			</table>
			<hr>
			<h4>Condições de pagamento</h4>
			<?=$adicional->condicoes?>
			<hr>
		</div>
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