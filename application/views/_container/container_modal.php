<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class; 
?>
<!-- MODAL: PAPEL-->
<div class="modal fade" id="md_papel">
	<form class="form_ajax" id="form_md_papel" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Papel</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<input type="hidden" name="owner" id="md_papel_container_owner" class="form-control">
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_dimensao" class="control-label"><i class="glyphicon glyphicon-share-alt"></i> Destino:</label>
									<select name="dimensao" id="form_select_dimensao" class="form-control" required>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4 div_empastamento_title">
                                <div class="form-group">
                                	<label for="form_empastamento" class="control-label">Qtd empastamento:</label>
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                        	<button type="button" class="btn btn-default btn-sm" onclick="altera_quantidade_empastamento('minus')" id="btn_empastamento_minus" disabled>
                                        		<i class="glyphicon glyphicon-minus"></i>
                                        	</button>
                                        </div>
                                        <input step="1" type="number" min="0" max="2" name="qtd_empastamento" id="qtd_empastamento" class="form-control input-sm" readonly="" value="0">
                                        <div class="input-group-btn">
                                        	<button type="button" class="btn btn-default btn-sm" onclick="altera_quantidade_empastamento('plus')" id="btn_empastamento_plus">
                                        		<i class="glyphicon glyphicon-plus"></i>
                                    		</button>
                                        </div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-4 div_empastamento_title" >
								<div class="form-group">
									<label for="form_select_empastamento" class="control-label"><i class="glyphicon glyphicon-compressed"></i> Empastamento:</label>
									<select id="form_select_empastamento" name="empastamento" class="form-control selectpicker" data-live-search="true" disabled>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row" id="papel-0">
							<input type="hidden" name="papel_action" id="papel_action-0" value="1">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_linha" class="control-label"><i class="glyphicon glyphicon-book"></i> Linha:</label>
									<select id="form_select_linha" class="form-control selectpicker" data-live-search="true" autofocus required>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_papel" class="control-label"><i class="glyphicon glyphicon-file"></i> Papel:</label>
									<select id="form_select_papel" name="papel" class="form-control selectpicker select_papel show-tick" data-live-search="true" required>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_gramatura" class="control-label"><i class="glyphicon glyphicon-resize-vertical"></i> Gramatura:</label>
									<select id="form_select_gramatura" name="gramatura" class="form-control" required>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row hidden" id="papel-1">
							<input type="hidden" name="papel_action-1" id="papel_action-1">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_linha-1" class="control-label"><i class="glyphicon glyphicon-book"></i> Linha:</label>
									<select id="form_select_linha-1" class="form-control selectpicker" data-live-search="true" autofocus>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_papel-1" class="control-label"><i class="glyphicon glyphicon-file"></i> Papel:</label>
									<select id="form_select_papel-1" name="papel-1" class="form-control selectpicker select_papel show-tick" data-live-search="true">
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_gramatura-1" class="control-label"><i class="glyphicon glyphicon-resize-vertical"></i> Gramatura:</label>
									<select id="form_select_gramatura-1" name="gramatura-1" class="form-control">
									</select>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row hidden" id="papel-2">
							<input type="hidden" name="papel_action-2" id="papel_action-2">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_linha-2" class="control-label"><i class="glyphicon glyphicon-book"></i> Linha:</label>
									<select id="form_select_linha-2" class="form-control selectpicker" data-live-search="true" autofocus>
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_papel-2" class="control-label"><i class="glyphicon glyphicon-file"></i> Papel:</label>
									<select id="form_select_papel-2" name="papel-2" class="form-control selectpicker select_papel show-tick" data-live-search="true">
										<option value="" selected>Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_select_gramatura-2" class="control-label"><i class="glyphicon glyphicon-resize-vertical"></i> Gramatura:</label>
									<select id="form_select_gramatura-2" name="gramatura-2" class="form-control">
									</select>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<!--Descrição-->
									<span class="glyphicon glyphicon-pencil"></span>
									<label for="form_descricao_papel" class="control-label">Descrição:</label>
									<textarea name="descricao" id="form_descricao_papel" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
<!-- MODAL: IMPRESSÃO -->
<div class="modal fade" id="md_impressao">
	<form class="form_ajax" id="form_md_impressao" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Impressão</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<!-- Lista de Impressão -->
									<label for="form_select_impressao" class="control-label"><i class="glyphicon glyphicon-print"></i> Impressão</label>
									<select name="impressao" id="form_select_impressao" class="form-control selectpicker" autofocus data-live-search="true" required>
										<option value="" selected="selected">Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="dimensao" class="control-label"><i class="glyphicon glyphicon-retweet"></i> Dimensão:</label>
									<select name="dimensao" id="form_select_impressao_dimensao" class="form-control" required>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_qtd_impressao" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_impressao" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<!--Descrição-->
									<label for="form_descricao_impressao" class="control-label"><i class="glyphicon glyphicon-pencil"></i> Descrição:</label>
									<textarea name="descricao" id="form_descricao_impressao" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
						<div class="row">
							<div class="col-sm-6">
								<!-- Lista de acabamento -->
								<div class="form-group">
									<label for="form_select_acabamento" class="control-label"><i class="glyphicon glyphicon-scissors"></i> Acabamento</label>
									<select name="acabamento" id="form_select_acabamento" class="form-control selectpicker" autofocus data-live-search="true" required>
										<option value="" selected="selected">Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="form_qtd_acabamento" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_acabamento" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<!--Descrição-->
								<div class="form-group">
									<label for="form_descricao_acabamento" class="control-label"><i class="glyphicon glyphicon-pencil"></i> Descrição:</label>
									<textarea name="descricao" id="form_descricao_acabamento" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<!-- Lista de acessorio -->
									<label for="form_select_acessorio" class="control-label"><i class="fa fa-diamond" aria-hidden="true"></i> Acessório:</label>
									<select name="acessorio" id="form_select_acessorio" class="form-control selectpicker" data-live-search="true" required autofocus>
										<option value="" selected="selected">Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="form_qtd_acessorio" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_acessorio" class="form-control" value="" min="1" step="1" placeholder="Quantidade" required>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<!--Descrição-->
									<label for="form_descricao_acessorio" class="control-label"><i class="glyphicon glyphicon-pencil"></i> Descrição:</label>
									<textarea name="descricao" id="form_descricao_acessorio" class="form-control" rows="3" placeholder="Descrição"></textarea>
									<span class="help-block"></span>
								</div>
							</div>
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
									<label for="form_select_fita" class="control-label"><i class="glyphicon glyphicon-tag"></i> Fita:</label>
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
									<label for="espessura" class="control-label"><i class="glyphicon glyphicon-resize-vertical"></i> Espessura:</label>
									<select name="espessura" id="form_select_espessura" class="form-control" required>
										<!-- configurados no controller do convite -->
										<option value="" selected="selected">Selecione</option>
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
									<span class="glyphicon glyphicon-pencil"></span>
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
<!-- MODAL: CLICHÊ -->
<div class="modal fade" id="md_cliche">
	<form class="form_ajax" id="form_md_cliche" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Clichê</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<!-- Lista de Clichê -->
									<span class="glyphicon glyphicon-registration-mark"></span>
									<label for="form_select_cliche" class="control-label">Clichê</label>
									<select name="cliche" id="form_select_cliche" class="form-control selectpicker" autofocus data-live-search="true" required>
										<option value="" selected="selected">Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="dimensao" class="control-label"><i class="glyphicon glyphicon-resize-vertical"></i> Dimensão:</label>
									<select name="dimensao" id="form_select_cliche_dimensao" class="form-control" required>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_qtd_cliche" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_cliche" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="cobrar_servicoCliche" class="control-label"><i class="glyphicon glyphicon-usd"></i> Cobrar serviço:</label>
									<input type="checkbox" data-group-cls="btn-group-sm" name="cobrar_servicoCliche" id="cobrar_servicoCliche" class="form-control input-sm" value="1">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="cobrar_cliche" class="control-label"><i class="glyphicon glyphicon-usd"></i> Cobrar clichê:</label>
									<input type="checkbox" data-group-cls="btn-group-sm" name="cobrar_cliche" id="cobrar_cliche" class="form-control input-sm" value="1">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<!--Descrição-->
									<label for="form_descricao_cliche" class="control-label"><i class="glyphicon glyphicon-pencil"></i> Descrição:</label>
									<textarea name="descricao" id="form_descricao_cliche" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
<!-- MODAL: FACA -->
<div class="modal fade" id="md_faca">
	<form class="form_ajax" id="form_md_faca" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Faca</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<!-- Lista de Faca -->
									<label for="form_select_faca" class="control-label"><i class="fa fa-map-o" aria-hidden="true"></i> Faca</label>
									<select name="faca" id="form_select_faca" class="form-control selectpicker" autofocus data-live-search="true" required>
										<option value="" selected="selected">Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="dimensao" class="control-label"><i class="glyphicon glyphicon-resize-vertical"></i> Dimensão:</label>
									<select name="dimensao" id="form_select_faca_dimensao" class="form-control" required>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_qtd_faca" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_faca" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label for="cobrar_servicoFaca" class="control-label"><i class="glyphicon glyphicon-usd"></i> Cobrar serviço:</label>
									<input type="checkbox" data-group-cls="btn-group-sm" name="cobrar_servicoFaca" id="cobrar_servicoFaca" class="form-control input-sm" value="1">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="cobrar_faca" class="control-label"><i class="glyphicon glyphicon-usd"></i> Cobrar faca:</label>
									<input type="checkbox" data-group-cls="btn-group-sm" name="cobrar_faca" id="cobrar_faca" class="form-control input-sm" value="1">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<!--Descrição-->
									<label for="form_descricao_faca" class="control-label"><i class="glyphicon glyphicon-pencil"></i> Descrição:</label>
									<textarea name="descricao" id="form_descricao_faca" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
<!-- MODAL: LASER -->
<div class="modal fade" id="md_laser">
	<form class="form_ajax" id="form_md_laser" action="" method="post" accept-charset="utf-8">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Laser</h4>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<!-- Lista de laser -->
									<label for="form_select_laser" class="control-label"><span class="glyphicon glyphicon-flash"></span> Laser</label>
									<select name="laser" id="form_select_laser" class="form-control selectpicker" autofocus data-live-search="true" required>
										<option value="" selected="selected">Selecione</option>
									</select>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_qtd_laser" class="control-label">Quantidade:</label>
									<input type="number" name="quantidade" id="form_qtd_laser" class="form-control" value="" min="1" step="1" required placeholder="Quantidade">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="form_qtdMinutos_laser" class="control-label">Qtd em Minutos:</label>
									<input type="number" name="qtd_minutos" id="form_qtdMinutos_laser" class="form-control" value="" min="1" step="1" required placeholder="Qtd em Minutos" title="Qtd em Minutos">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<!--Descrição-->
								<div class="form-group">
									<label for="form_descricao_laser" class="control-label"><i class="glyphicon glyphicon-pencil"></i> Descrição:</label>
									<textarea name="descricao" id="form_descricao_laser" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
						<div class="col-sm-6">
							<div class="form-group">
								<label for="convite_modelo" class="control-label">Modelo:</label>
								<select id="convite_modelo" autofocus name="convite_modelo" class="form-control selectpicker" data-live-search="true" required>
									<option value="" disabled selected>Selecione</option>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="quantidade" class="control-label">Quantidade:</label>
								<input type="number" name="quantidade" id="quantidade_convite" step="1" min="1" class="form-control" value="" placeholder="Quantidade de convites" required>
								<span class="help-block"></span>
							</div>
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
						<div class="col-sm-4">
							<div class="form-group">
								<label for="personalizado_categoria" class="control-label">Categoria</label>
								<select id="personalizado_categoria" class="form-control selectpicker" data-live-search="true" autofocus required>
									<option value="" disabled selected>Selecione</option>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="personalizado_modelo" class="control-label">Modelo</label>
								<select id="personalizado_modelo" name="personalizado_modelo" class="form-control selectpicker" data-live-search="true" required>
									<option value="" disabled selected>Selecione</option>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label for="quantidade" class="control-label">Quantidade:</label>
								<input type="number" name="quantidade" id="quantidade_personalizado" min="1" step="1" class="form-control" value="" placeholder="Quantidade" required>
								<span class="help-block"></span>
							</div>
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
						<span class="glyphicon glyphicon-pencil"></span>
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