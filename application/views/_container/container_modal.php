<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class; 
?>
<!-- MODAL: PAPEL-->
<div class="modal fade" id="md_papel">
	<form class="form_ajax" id="form_md_papel" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Papel</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<input type="hidden" name="owner" id="md_papel_container_owner" class="form-control">
						<div class="form-group col-sm-4">
							<label for="form_select_linha" class="control-label">Linha:</label>
							<select id="form_select_linha" class="form-control selectpicker" data-live-search="true" autofocus required>
								<option value="" selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<label for="papel" class="control-label">Papel:</label>
							<select name="papel" id="form_select_papel" class="form-control selectpicker select_papel show-tick" data-live-search="true" required>
								<option value="" selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<label for="gramatura" class="control-label">Gramatura:</label>
							<select name="gramatura" id="form_select_gramatura" class="form-control" required>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-12">
							<div class="table-responsive">
								<table class="table table-hover">
									<tr>
										<th>Acabamento</th>
										<th>Quantidade</th>
										<th>Qts min/peça?</th>
										<th>Adicionar Serviço?</th>
										<th>Cobrar Serviço ?</th>
										<th>Cobrar Faca / Clichê ?</th>
									</tr>
									<tbody>
										<tr>
											<td>Empastamento</td>
											<td>
												<div class="form-group">
													<input type="number" name="empastamento_quantidade" id="empastamento_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
											<input type="checkbox" data-group-cls="btn-group-sm" name="empastamento_adicionar" id="empastamento_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="empastamento_cobrar" id="empastamento_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Laminação</td>
											<td>
												<div class="form-group">
													<input type="number" name="laminacao_quantidade" id="laminacao_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="laminacao_adicionar" id="laminacao_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="laminacao_cobrar" id="laminacao_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Douração</td>
											<td>
												<div class="form-group">
													<input type="number" name="douracao_quantidade" id="douracao_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="douracao_adicionar" id="douracao_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="douracao_cobrar" id="douracao_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Corte Laser</td>
											<td>
												<div class="form-group">
													<input type="number" name="corte_laser_quantidade" id="corte_laser_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>
												<div class="form-group">
													<input type="number" name="corte_laser_minutos" id="corte_laser_minutos" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="corte_laser_adicionar" id="corte_laser_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="corte_laser_cobrar" id="corte_laser_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>N / A</td>
										</tr>
										<tr>
											<td>Relevo Seco</td>
											<td>
												<div class="form-group">
													<input type="number" name="relevo_seco_quantidade" id="relevo_seco_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="relevo_seco_adicionar" id="relevo_seco_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="relevo_seco_cobrar" id="relevo_seco_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="relevo_seco_cobrar_faca_cliche" id="relevo_seco_cobrar_faca_cliche" class="form-control input-sm" value="1">
											</td>

										</tr>
										<tr>
											<td>Corte Vinco</td>
											<td>
												<div class="form-group">
													<input type="number" name="corte_vinco_quantidade" id="corte_vinco_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="corte_vinco_adicionar" id="corte_vinco_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="corte_vinco_cobrar" id="corte_vinco_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="corte_vinco_cobrar_faca_cliche" id="corte_vinco_cobrar_faca_cliche" class="form-control input-sm" value="1">
											</td>

										</tr>
										<tr>
											<td>Almofada</td>
											<td>
												<div class="form-group">
													<input type="number" name="almofada_quantidade" id="almofada_quantidade" class="form-control input-sm" value="" step="1" min="1" required>
													<span class="help-block"></span>
												</div>
											</td>
											<td>N / A</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="almofada_adicionar" id="almofada_adicionar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="almofada_cobrar" id="almofada_cobrar" class="form-control input-sm" value="1">
											</td>
											<td>
												<input type="checkbox" data-group-cls="btn-group-sm" name="almofada_cobrar_faca_cliche" id="almofada_cobrar_faca_cliche" class="form-control input-sm" value="1">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit" >Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: IMPRESSÃO -->
<div class="modal fade" id="md_impressao">
	<form class="form_ajax" id="form_md_impressao" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Impressão</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<!-- Lista de impressões -->
						<div class="form-group col-sm-4">
							<span class="glyphicon glyphicon-resize-full"></span>
							<label for="form_select_impressao_area" class="control-label">Área de Impressão</label>
							<select id="form_select_impressao_area" class="form-control" autofocus required>
								<option value="" selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<span class="glyphicon glyphicon-print"></span>
							<label for="form_select_impressao" class="control-label">Impressão:</label>
							<select name="impressao" id="form_select_impressao" class="form-control selectpicker" data-live-search="true" required>
								<option value="" selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<label for="form_qtd_impressao" class="control-label">Quantidade:</label>
							<input type="number" name="quantidade" id="form_qtd_impressao" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-12">
							<!--Descrição-->
							<span class="glyphicon glyphicon-pencil"></span>
							<label for="form_descricao_impressao" class="control-label">Descrição:</label>
							<textarea name="descricao" id="form_descricao_impressao" class="form-control" rows="3" placeholder="Descrição"></textarea>
							<span class="help-block"></span>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit" >Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: ACABAMENTO -->
<div class="modal fade" id="md_acabamento">
	<form class="form_ajax" id="form_md_acabamento" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Acabamento</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="form-group col-sm-6">
							<!-- Lista de acabamento -->
							<span class="glyphicon glyphicon-scissors"></span>
							<label for="form_select_acabamento" class="control-label">Acabamento</label>
							<select name="acabamento" id="form_select_acabamento" class="form-control selectpicker" autofocus data-live-search="true" required>
								<option value="" selected="selected">Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-6">
							<label for="form_qtd_acabamento" class="control-label">Quantidade:</label>
							<input type="number" name="quantidade" id="form_qtd_acabamento" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-12">
							<!--Descrição-->
							<span class="glyphicon glyphicon-pencil"></span>
							<label for="form_descricao_acabamento" class="control-label">Descrição:</label>
							<textarea name="descricao" id="form_descricao_acabamento" class="form-control" rows="3" placeholder="Descrição"></textarea>
							<span class="help-block"></span>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit" >Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: ACESSÓRIO -->
<div class="modal fade" id="md_acessorio">
	<form class="form_ajax" id="form_md_acessorio" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Acessório</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="form-group col-sm-6">
							<!-- Lista de acessorio -->
							<i class="fa fa-diamond" aria-hidden="true"></i>
							<label for="form_select_acessorio" class="control-label">Acessório:</label>
							<select name="acessorio" id="form_select_acessorio" class="form-control selectpicker" data-live-search="true" required autofocus>
								<option value="" selected="selected">Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-6">
							<label for="form_qtd_acessorio" class="control-label">Quantidade:</label>
							<input type="number" name="quantidade" id="form_qtd_acessorio" class="form-control" value="" min="1" step="1" placeholder="Quantidade" required>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-12">
							<!--Descrição-->
							<span class="glyphicon glyphicon-pencil"></span>
							<label for="form_descricao_acessorio" class="control-label">Descrição:</label>
							<textarea name="descricao" id="form_descricao_acessorio" class="form-control" rows="3" placeholder="Descrição"></textarea>
							<span class="help-block"></span>
						</div>
					<fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit" >Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: FITA -->
<div class="modal fade" id="md_fita">
	<form class="form_ajax" id="form_md_fita" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Fita</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="form_select_fita_material" class="control-label">Material</label>
									<select id="form_select_fita_material" class="form-control selectpicker" data-live-search="true" autofocus required>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="form_select_fita" class="control-label">Fita:</label>
									<select name="fita" id="form_select_fita" class="form-control selectpicker show-tick" data-live-search="true" required>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="espessura" class="control-label">Espessura:</label>
									<select name="espessura" id="form_select_espessura" class="form-control" required>
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
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="form_qtd_fita" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_fita" class="form-control" value="" min="1" step="1" placeholder="Quantidade" required>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="form_descricao_fita" class="control-label">Descrição:</label>
		                            <textarea name="descricao" id="form_descricao_fita" class="form-control" rows="3" placeholder="Descrição"></textarea>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit" >Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: CONVITE -->
<div class="modal fade" id="md_convite">
	<form class="form_ajax" id="form_convite" action="" method="post" accept-charset="utf-8" role="form">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 id="md_convite_titulo" class="modal-title"></h4>
				</div>			
				<div class="modal-body">
					<fieldset>
						<div class="form-group col-sm-8">
							<label for="convite_modelo" class="control-label">Modelo:</label>
							<select id="convite_modelo" autofocus name="convite_modelo" class="form-control selectpicker" data-live-search="true" required>
								<option value="" disabled selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<label for="quantidade" class="control-label">Quantidade:</label>
							<input type="number" name="quantidade" id="quantidade_convite" step="1" min="1" class="form-control" value="" placeholder="Quantidade de convites" required>
							<span class="help-block"></span>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: PERSONALIZADO -->
<div class="modal fade" id="md_personalizado">
	<form class="form_ajax" id="form_personalizado" action="" method="post" accept-charset="utf-8" role="form">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 id="md_personalizado_titulo" class="modal-title"></h4>
				</div>			
				<div class="modal-body">
					<fieldset>
						<div class="form-group col-sm-4">
							<label for="personalizado_categoria" class="control-label">Categoria</label>
							<select id="personalizado_categoria" class="form-control selectpicker" data-live-search="true" autofocus required>
								<option value="" disabled selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<label for="personalizado_modelo" class="control-label">Modelo</label>
							<select id="personalizado_modelo" name="personalizado_modelo" class="form-control selectpicker" data-live-search="true" required>
								<option value="" disabled selected>Selecione</option>
							</select>
							<span class="help-block"></span>
						</div>
						<div class="form-group col-sm-4">
							<label for="quantidade" class="control-label">Quantidade:</label>
							<input type="number" name="quantidade" id="quantidade_personalizado" min="1" step="1" class="form-control" value="" placeholder="Quantidade" required>
							<span class="help-block"></span>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button id="btn_mod_qtd_submit" type="submit" class="btn btn-default btnSubmit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: MÃO DE OBRA -->
<div class="modal fade" id="md_mao_obra">
	<form  class="form_ajax" id="form_mao_obra" action="" method="post" accept-charset="utf-8" role="form">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Mão de obra</h4>
				</div>			
				<div class="modal-body">
					<div class="form-group">
						<label for="md_mao_obra_select" class="control-label">Mão de obra:</label>
						<select id="md_mao_obra_select" name="mao_obra" class="form-control" autofocus required>
							<option value="" selected disabled>Selecione</option>
						</select>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAL: DESCRIÇÃO -->
<div class="modal fade" id="md_descricao">
	<form  class="form_ajax" id="form_descricao" action="" method="post" accept-charset="utf-8" role="form">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Descrição</h4>
				</div>			
				<div class="modal-body">
					<div class="form-group">
						<label for="descricao" class="control-label">Descrição:</label>
						<textarea name="descricao" id="form_descricao_txt" class="form-control" rows="3"><?= ($controller === 'convite')? $this->session->convite->descricao : $this->session->personalizado->descricao?></textarea>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-default btnSubmit">Salvar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- MODAIS FIM -->