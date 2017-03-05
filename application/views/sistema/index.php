<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Configuração do sistema</h3>
	</div>
	<div class="panel-body">
		<form action="" id="form_configuracao_sistema" method="POST" role="form">
			<fieldset>
				<div class="col-sm-8">
					<legend>Validade</legend>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="prazo_validade_orcamento" class="control-label">Validade do orçamento</label>
							<div class="input-group">
								<input type="number" step="1" min="1" class="form-control" name="prazo_validade_orcamento" id="prazo_validade_orcamento" placeholder="Ex: 7" value="<?=$dados['prazo_validade_orcamento']?>">
								<div class="input-group-addon">dias</div>
							</div>
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-12">
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