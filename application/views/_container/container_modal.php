<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class; 
?>
<!-- MODAL: PAPEL-->
<div class="modal fade" id="md_papel">
	<div class="modal-dialog modal-lg">
		<form class="form_ajax" id="form_md_papel" action="" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Papel</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?=form_input(array('type'=>'hidden','name'=>'owner','id'=>'md_papel_container_owner'));  ?>
						<div class="form-group col-sm-4">
							<?= form_label('Catalogo: ', 'form_select_catalogo', array('class' => 'control-label')) ?>
							<select id="form_select_catalogo" class="form-control selectpicker" data-live-search="true" autofocus="true">
								<option value="" selected>Selecione</option>
								<?php foreach ( $dados['papel_catalogo'] as $catalogo) {
									?>
									<option value="<?=$catalogo->id?>"><?=$catalogo->nome ?></option>
									<?php
								}
								?>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<?= form_label('Papel: ', 'papel', array('class' => 'control-label')) ?>
							<select name="papel" id="form_select_papel" class="form-control selectpicker select_papel" data-live-search="true">
								<option value="" selected>Selecione</option>
								<?php foreach ($dados['papel_linha'] as $papel_linha) {
									?>
									<option data-gramatura='<?=$papel_linha->get_object_json()?>' data-catalogo="<?=$papel_linha->papel_catalogo->id?>" value="<?=$papel_linha->id?>"><?=$papel_linha->papel_catalogo->nome." - ".$papel_linha->nome." - ".$papel_linha->cor?></option>
									<?php
								}
								?>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<?= form_label('Gramatura: ', 'gramatura', array('class' => 'control-label')) ?>
							<select name="gramatura" id="form_select_gramatura" class="form-control" required>
								<option value="" selected="" disabled="disabled">Selecione</option>
								<option value="80">80g</option>
								<option value="120">120g</option>
								<option value="180">170 / 180g</option>
								<option value="250">240 / 250g</option>
								<option value="300">300g</option>
								<option value="350">350g</option>
								<option value="400">400g</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
										<th>Acabamento</th>
										<th>Qtd</th>
										<th>Minutos</th>
										<th>S / N</th>
										<th>Cobrar Serviço ?</th>
										<th>Cobrar Faca / Clichê ?</th>
									</tr>
									<tbody>
										<tr>
											<td>Empastamento</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="empastamento_quantidade" id="empastamento_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<?=form_input(array('name'=>'empastamento_adicionar','type'=>'checkbox','id'=>'empastamento_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'empastamento_cobrar','type'=>'checkbox','id'=>'empastamento_cobrar'), '1', '');?>
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Laminação</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="laminacao_quantidade" id="laminacao_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<?=form_input(array('name'=>'laminacao_adicionar','type'=>'checkbox','id'=>'laminacao_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'laminacao_cobrar','type'=>'checkbox','id'=>'laminacao_cobrar'), '1', '');?>
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Douração</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="douracao_quantidade" id="douracao_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<?=form_input(array('name'=>'douracao_adicionar','type'=>'checkbox','id'=>'douracao_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'douracao_cobrar','type'=>'checkbox','id'=>'douracao_cobrar'), '1', '');?>
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Corte Laser</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="corte_laser_quantidade" id="corte_laser_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="corte_laser_minutos" id="corte_laser_minutos" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>
												<?=form_input(array('name'=>'corte_laser_adicionar','type'=>'checkbox','id'=>'corte_laser_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'corte_laser_cobrar','type'=>'checkbox','id'=>'corte_laser_cobrar'), '1', '');?>
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Relevo Seco</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="relevo_seco_quantidade" id="relevo_seco_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<?=form_input(array('name'=>'relevo_seco_adicionar','type'=>'checkbox','id'=>'relevo_seco_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'relevo_seco_cobrar','type'=>'checkbox','id'=>'relevo_seco_cobrar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'relevo_seco_cobrar_faca_cliche','type'=>'checkbox','id'=>'relevo_seco_cobrar_faca_cliche'), '1', '');?>	
											</td>

										</tr>
										<tr>
											<td>Corte Vinco</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="corte_vinco_quantidade" id="corte_vinco_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<?=form_input(array('name'=>'corte_vinco_adicionar','type'=>'checkbox','id'=>'corte_vinco_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'corte_vinco_cobrar','type'=>'checkbox','id'=>'corte_vinco_cobrar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'corte_vinco_cobrar_faca_cliche','type'=>'checkbox','id'=>'corte_vinco_cobrar_faca_cliche'), '1', '');?>
											</td>

										</tr>
										<tr>
											<td>Almofada</td>
											<td class="col-sm-2">
												<div class="form-group">
													<input type="number" name="almofada_quantidade" id="almofada_quantidade" class="form-control" value="" step="1">
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<?=form_input(array('name'=>'almofada_adicionar','type'=>'checkbox','id'=>'almofada_adicionar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'almofada_cobrar','type'=>'checkbox','id'=>'almofada_cobrar'), '1', '');?>
											</td>
											<td>
												<?=form_input(array('name'=>'almofada_cobrar_faca_cliche','type'=>'checkbox','id'=>'almofada_cobrar_faca_cliche'), '1', '');?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit" >Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL: IMPRESSÃO -->
<div class="modal fade" id="md_impressao">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_md_impressao" action="" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Impressão</h4>
				</div>
				<div class="modal-body row">
					<!-- Lista de impressões -->
					<div class="form-group col-sm-8">
						<span class="glyphicon glyphicon-print"></span>
						<?= form_label('Impressão: ', 'form_select_impressao', array('class' => 'control-label')) ?>
						<select name="impressao" id="form_select_impressao" class="form-control" autofocus="true">
							<option value="" selected="selected">Selecione</option>
							<?php 
							foreach ($dados['impressao_area'] as $impressao_area) {
								?>
								<optgroup label="<?=$impressao_area->nome?>">
									<?php
									foreach ($dados['impressao'] as $impressao) {
										if($impressao_area->id == $impressao->impressao_area->id){
											?>
											<option value="<?=$impressao->id?>"><?=$impressao->impressao_area->nome?> : <?=$impressao->nome?></option>
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
					<div class="form-group col-sm-4">
						<?= form_label('Quantidade: ', 'form_qtd_impressao', array('class' => 'control-label')) ?>
						<?= form_input(array('name'=>'quantidade','step'=>'1','type'=>'number','class'=>'form-control','id'=>'form_qtd_impressao','placeholder'=>'Quantidade', '', ''));  ?>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-12">
						<!--Descrição-->
						<span class="glyphicon glyphicon-pencil"></span>
						<?= form_label('Descrição: ', 'form_descricao_impressao', array('class' => 'control-label')) ?>
						<?= form_textarea(array('name'=>'descricao','id'=>'form_descricao_impressao','class'=>'form-control','rows'=>'3','placeholder'=>'Descricao', '', '')) ?>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit" >Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL: ACABAMENTO -->
<div class="modal fade" id="md_acabamento">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_md_acabamento" action="" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Acabamento</h4>
				</div>
				<div class="modal-body row">
					<div class="form-group col-sm-8">
						<!-- Lista de acabamento -->
						<span class="glyphicon glyphicon-scissors"></span>
						<?= form_label('Acabamento: ', 'form_select_acabamento', array('class' => 'control-label')) ?>
						<select name="acabamento" id="form_select_acabamento" class="form-control" autofocus="true">
							<option value="" selected="selected">Selecione</option>
							<?php foreach ($dados['acabamento'] as $acabamento) {
								?>
								<option value="<?=$acabamento->id?>"><?=$acabamento->nome?></option>
								<?php
							}
							?>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-4">
						<?= form_label('Quantidade: ', 'form_qtd_acabamento', array('class' => 'control-label')) ?>
						<?= form_input(array('name'=>'quantidade','step'=>'1','type'=>'number','class'=>'form-control','id'=>'form_qtd_acabamento','placeholder'=>'Quantidade', '', ''));  ?>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-12">
						<!--Descrição-->
						<span class="glyphicon glyphicon-pencil"></span>
						<?= form_label('Descrição: ', 'form_descricao_acabamento', array('class' => 'control-label')) ?>
						<?= form_textarea(array('name'=>'descricao','id'=>'form_descricao_acabamento','class'=>'form-control','rows'=>'3','placeholder'=>'Descricao', '', '')) ?>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit" >Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL: ACESSÓRIO -->
<div class="modal fade" id="md_acessorio">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_md_acessorio" action="" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Acessório</h4>
				</div>
				<div class="modal-body row">
					<div class="form-group col-sm-8">
						<!-- Lista de acessorio -->
						<span class="glyphicon glyphicon-leaf"></span>
						<?= form_label('Acessório: ', 'form_select_acessorio', array('class' => 'control-label')) ?>
						<select name="acessorio" id="form_select_acessorio" class="form-control" autofocus="true">
							<option value="" selected="selected">Selecione</option>
							<?php foreach ($dados['acessorio'] as $acessorio) {
								?>
								<option value="<?=$acessorio->id?>"><?=$acessorio->nome?></option>
								<?php
							}
							?>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-4">
						<?= form_label('Quantidade: ', 'form_qtd_acessorio', array('class' => 'control-label')) ?>
						<?= form_input(array('name'=>'quantidade','step'=>'1','type'=>'number','class'=>'form-control','id'=>'form_qtd_acessorio','placeholder'=>'Quantidade', '', ''));  ?>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-12">
						<!--Descrição-->
						<span class="glyphicon glyphicon-pencil"></span>
						<?= form_label('Descrição: ', 'form_descricao_acessorio', array('class' => 'control-label')) ?>
						<?= form_textarea(array('name'=>'descricao','id'=>'form_descricao_acessorio','class'=>'form-control','rows'=>'3','placeholder'=>'Descricao', '', '')) ?>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit" >Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL: FITA -->
<div class="modal fade" id="md_fita">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_md_fita" action="" method="post" accept-charset="utf-8">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Fita</h4>
				</div>
				<div class="modal-body row">
					<div class="form-group col-sm-12">
						<!-- Lista de fita -->
						<span class="glyphicon glyphicon-tags"></span>
						<?= form_label('Fita: ', 'form_select_fita', array('class' => 'control-label')) ?>
						<select name="fita" id="form_select_fita" class="form-control" autofocus="true">
							<option value="" selected="selected">Selecione</option>
							<?php foreach ($dados['fita_material'] as $fita_material) {
								?>
								<optgroup label="<?=$fita_material->nome?>">
									?>
									<?php foreach ($dados['fita'] as $fita) {
										?>
										<?php if($fita_material->id == $fita->fita_material->id){
											?>
											<option data-espessura='<?=$fita->get_espessura_json();?>' value="<?=$fita->id?>"><?=$fita->fita_material->nome?> : <?=$fita->fita_laco->nome?></option>
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
					<div class="form-group col-sm-8">
						<?= form_label('Espessura: ', 'espessura', array('class' => 'control-label')) ?>
						<select name="espessura" id="form_select_espessura" class="form-control">
							<!-- configurados no controller do convite -->
							<option value="" selected="selected" disabled="disabled">Selecione</option>
							<option value="3"><?=$dados['fita_espessura']->esp_03mm?></option>
							<option value="7"><?=$dados['fita_espessura']->esp_07mm?></option>
							<option value="10"><?=$dados['fita_espessura']->esp_10mm?></option>
							<option value="15"><?=$dados['fita_espessura']->esp_15mm?></option>
							<option value="22"><?=$dados['fita_espessura']->esp_22mm?></option>
							<option value="38"><?=$dados['fita_espessura']->esp_38mm?></option>
							<option value="50"><?=$dados['fita_espessura']->esp_50mm?></option>
							<option value="70"><?=$dados['fita_espessura']->esp_70mm?></option>
							option
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-4">
						<?= form_label('Quantidade: ', 'form_qtd_fita', array('class' => 'control-label')) ?>
						<?= form_input(array('name'=>'quantidade','step'=>'1','type'=>'number','class'=>'form-control','id'=>'form_qtd_fita','placeholder'=>'Quantidade', '', ''));  ?>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-12">
						<!--Descrição-->
						<span class="glyphicon glyphicon-pencil"></span>
						<?= form_label('Descrição: ', 'form_descricao_fita', array('class' => 'control-label')) ?>
						<?= form_textarea(array('name'=>'descricao','id'=>'form_descricao_fita','class'=>'form-control','rows'=>'3','placeholder'=>'Descricao', '', '')) ?>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success btnSubmit" >Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL: CONVITE -->
<div class="modal fade" id="md_convite">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_convite" action="" method="post" accept-charset="utf-8" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 id="md_convite_titulo" class="modal-title"></h4>
				</div>			
				<div class="modal-body row">
					<div class="form-group col-sm-8">
						<?= form_label('Convite Modelo: ', 'convite_modelo', array('class' => 'control-label')) ?>
						<select id="convite_modelo" autofocus="true" name="convite_modelo" class="form-control">
							<option value="" disabled selected>Selecione</option>
							<?php 
							foreach ($dados['convite_modelo'] as $convite_modelo) {
								?>
								<option value="<?=$convite_modelo->id?>"><?=$convite_modelo->codigo?></option>
								<?php 
							} 
							?>
						</select>
						<span class="help-block"></span>
					</div>
					<div class="form-group col-sm-4">
						<?= form_label('Quantidade: ', 'quantidade', array('class' => 'control-label')) ?>
						<input type="number" name="quantidade" id="quantidade_convite" step="1" class="form-control" value="" placeholder="Quantidade de convites" />
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
<!-- MODAL: PERSONALIZADO -->
<div class="modal fade" id="md_personalizado">
	<div class="modal-dialog">
		<form class="form_ajax" id="form_personalizado" action="" method="post" accept-charset="utf-8" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 id="md_personalizado_titulo" class="modal-title"></h4>
				</div>			
				<div class="modal-body row">
					<div class="form-group col-sm-8">
						<?= form_label('Personalizado Modelo: ', 'personalizado_modelo', array('class' => 'control-label')) ?>
						<select id="personalizado_modelo" autofocus="true" name="personalizado_modelo" class="form-control">
							<option value="" disabled selected>Selecione</option>
							<?php 
							foreach ($dados['personalizado_categoria'] as $personalizado_categoria) {
								?>
								<optgroup label="Categoria: <?=$personalizado_categoria->nome?>">
									<?php
									foreach ($dados['personalizado_modelo'] as $personalizado_modelo) {
										if($personalizado_categoria->id == $personalizado_modelo->personalizado_categoria->id){
											?>
											<option value="<?=$personalizado_modelo->id?>"><?=$personalizado_modelo->personalizado_categoria->nome?> : <?=$personalizado_modelo->nome?></option>
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
					<div class="form-group col-sm-4">
						<?= form_label('Quantidade: ', 'quantidade', array('class' => 'control-label')) ?>
						<input type="number" name="quantidade" id="quantidade_personalizado" min="1" step="1" class="form-control" value="" placeholder="Quantidade" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button id="btn_mod_qtd_submit" type="submit" class="btn btn-success btnSubmit">Salvar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL: MÃO DE OBRA -->
<div class="modal fade" id="md_mao_obra">
	<div class="modal-dialog modal-sm">
		<form  class="form_ajax" id="form_mao_obra" action="" method="post" accept-charset="utf-8" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Mão de obra</h4>
				</div>			
				<div class="modal-body">
					<div class="form-group">
						<?= form_label('Mão de obra: ', 'mao_obra', array('class' => 'control-label')) ?>
						<select id="md_mao_obra_select" name="mao_obra" class="form-control" autofocus="true">
							<option value="" selected disabled>Selecione</option>
							<?php 
							foreach ($dados['mao_obra'] as $mao_obra) {
								?>
								<option value="<?=$mao_obra->id?>"><?=$mao_obra->nome?></option>
								<?php 
							} 
							?>
						</select>
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
<!-- MODAL: DESCRIÇÃO -->
<div class="modal fade" id="md_descricao">
	<div class="modal-dialog modal-md">
		<form  class="form_ajax" id="form_descricao" action="" method="post" accept-charset="utf-8" role="form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Descrição</h4>
				</div>			
				<div class="modal-body">
					<div class="form-group">
						<?= form_label('Descrição: ', 'descricao', array('class' => 'control-label')) ?>
						<textarea name="descricao" id="form_descricao_txt" class="form-control" rows="3"><?= ($controller === 'convite')? $this->session->convite->descricao : $this->session->personalizado->descricao?></textarea>
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
<!-- MODAIS FIM -->