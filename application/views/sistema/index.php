<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Configuração do sistema</h3>
	</div>
	<div class="panel-body">
		<form action="" id="form_configuracao_sistema" method="POST" role="form">
			<fieldset>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="parcelamento_maximo" class="control-label col-sm-6">Parcelamento máximo</label>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="number" step="1" min="1" class="form-control" name="parcelamento_maximo" id="parcelamento_maximo" placeholder="Ex: 12" value="<?=$dados["parcelamento_maximo"]?>">
								<div class="input-group-addon">vezes</div>
							</div>
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="valor_minimo_parcelamento" class="control-label col-sm-6">Valor mínimo parcelamento</label>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="number" step="0.01" min="0" class="form-control" name="valor_minimo_parcelamento" id="valor_minimo_parcelamento" placeholder="Ex: 100,00" value="<?=$dados['valor_minimo_parcelamento']?>">
								<div class="input-group-addon">reais</div>
							</div>
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="prazo_validade_orcamento" class="control-label col-sm-6">Validade do orçamento</label>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="number" step="1" min="1" class="form-control" name="prazo_validade_orcamento" id="prazo_validade_orcamento" placeholder="Ex: 7" value="<?=$dados['prazo_validade_orcamento']?>">
								<div class="input-group-addon">dias</div>
							</div>
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="col-sm-6"></div>
				<div class="col-sm-12">
					<div class="col-sm-6">
						<button type="submit" class="btn btn-success btnSubmit">Salvar</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#form_configuracao_sistema").submit(function(event) {
			event.preventDefault();
			disable_button_salvar();
			reset_errors();
			$.ajax({
				url: '<?=base_url("sistema/ajax_update")?>',
				type: 'post',
				dataType: 'json',
				data: $("#form_configuracao_sistema").serialize(),
			})
			.done(function(data) {
				if (data.status){
					console.log("formulario atualizado");
					$.alert({
						title: 'Sucesso',
						content: 'Configuração atualizada com sucesso!'
					});
				}
				else
				{
					$.map(data.form_validation, function (value, index) {
						$('[name="' + index + '"]').closest(".form-group").addClass('has-error');
						$('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
					});
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
				enable_button_salvar();
			});
		});
		
		
	});
</script>