<form action="" id="form_configuracao_sistema" method="POST" role="form">
	<fieldset>
		<legend>Painel de Configuração do Sistema</legend>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="parcelamento_maximo">Parcelamento maximo</label>
				<input type="number" class="form-control" name="parcelamento_maximo" id="parcelamento_maximo" placeholder="12" value="<?=$dados["parcelamento_maximo"]?>">
				<span class="help-block"></span>
			</div>
			<div class="form-group">
				<label for="valor_minimo_parcelamento">Valor minimo para parcelamento</label>
				<input type="number" class="form-control" name="valor_minimo_parcelamento" id="valor_minimo_parcelamento" placeholder="100,00" value="<?=$dados['valor_minimo_parcelamento']?>">
				<span class="help-block"></span>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="prazo_validade_orcamento">Prazo de validade do orçamento</label>
				<input type="number" class="form-control" name="prazo_validade_orcamento" id="prazo_validade_orcamento" placeholder="30" value="<?=$dados['prazo_validade_orcamento']?>">
				<span class="help-block"></span>
			</div>
		</div>
	</fieldset>
	<div class="col-sm-12">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$("#form_configuracao_sistema").submit(function(event) {
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
			});

			event.preventDefault();
		});
		
		
	});
</script>