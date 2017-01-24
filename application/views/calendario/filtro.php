<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Filtro
				<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<div class="panel-body">
				<form id="form-filter" class="form-horizontal form-filter check_filter_dirty">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_periodo" class="control-label"><i class="glyphicon"></i>Período de entrega</label>
								<select name="" id="filtro_periodo" class="form-control input-sm">
									<option value="">Todos</option>
									<option value="mes_passado">Mês passado</option>
									<option value="semana_passada">Semana passada</option>
									<option value="ontem">Ontem</option>
									<option value="hoje">Hoje</option>
									<option value="amanha">Amanhã</option>
									<option value="esta_semana">Esta semana</option>
									<option value="proxima_semana">Próxima semana</option>
									<option value="este_mes">Este mês</option>
									<option value="proximo_mes">Próximo mês</option>
									<option value="este_mes_e_proximo_mes">Este e o próximo mês</option>
									<option value="este_mes_mais_dois_meses">Este mês + 2 meses</option>
									<option value="este_mes_mais_cinco_meses">Este mês + 5 meses</option>
									<option value="este_ano">Este ano</option>
									<option value="proximo_ano">Próximo ano</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_data_entrega" class="control-label"><i class="glyphicon"></i>Data de entrega</label>
								<input type="text" class="form-control input-sm date" id="filtro_data_entrega" placeholder="dd/mm/aaaa">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_data_inicio" class="control-label"><i class="glyphicon"></i>Entre datas entrega</label>
								<div class="input-group">
									<input type="text" class="form-control input-sm date" id="filtro_data_inicio" placeholder="De: dd/mm/aaaa">
									<span class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></span>
									<input type="text" class="form-control input-sm date" id="filtro_data_final" placeholder="Até dd/mm/aaaa">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_data_evento" class="control-label"><i class="glyphicon"></i>Data do evento</label>
								<input type="text" class="form-control input-sm date" id="filtro_data_evento" placeholder="dd/mm/aaaa">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_pedido_id" class="control-label"><i class="glyphicon"></i>N° Pedido</label>
								<input type="number" class="form-control input-sm" id="filtro_pedido_id" placeholder="N° Pedido">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_documento" class="control-label"><i class="glyphicon"></i>Documento</label>
								<select name="" class="form-control input-sm" id="filtro_documento">
									<option value="">Todos</option>
									<option value="pedido">Pedido</option>
									<option value="adicional">Adicional</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_produto_nome" class="control-label"><i class="glyphicon"></i>Produto</label>
								<div class="input-group">
									<select name="" class="form-control input-sm" id="filtro_produto_tipo">
										<option value="">Todos</option>
										<option value="convite">Convite</option>
										<option value="personalizado">Personalizado</option>
										<option value="produto">Produto</option>
									</select>
									<span class="input-group-addon filtro_produto_tipo_span"><span class="glyphicon glyphicon-transfer"></span></span>
									<input type="text" class="form-control input-sm" id="filtro_produto_nome" placeholder="Produto nome">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_produto_codigo" class="control-label"><i class="glyphicon"></i>Código do produto</label>
								<input type="text" class="form-control input-sm" id="filtro_produto_codigo" placeholder="Código do produto">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_cliente_id" class="control-label"><i class="glyphicon"></i>ID Cliente</label>
								<input type="number" class="form-control input-sm" id="filtro_cliente_id" placeholder="ID Cliente">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_cliente" class="control-label"><i class="glyphicon"></i>Cliente</label>
								<input type="text" class="form-control input-sm" id="filtro_cliente" placeholder="Cliente">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_unidade" class="control-label"><i class="glyphicon"></i>Unidade</label>
								<select name="" class="form-control input-sm" id="filtro_unidade">
									<option value="">Todos</option>
									<?php foreach ($dados['lojas'] as $key => $loja): ?>
										<option value="<?= $loja->unidade ?>"><?= $loja->unidade ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="filtro_status" class="control-label"><i class="glyphicon"></i>Status</label>
								<select name="" class="form-control input-sm" id="filtro_status">
									<option value="">Todos</option>
									<option value="recebimento_dados">Recebimento dos dados</option>
									<option value="desenvolvimento_layout">Em desenvolvimento do layout</option>
									<option value="envio_layout">Envio do layout</option>
									<option value="aprovado">Aprovado</option>
									<option value="producao">Produção</option>
									<option value="disponivel">Disponível</option>
									<option value="retirado">Retirado</option>
								</select>
							</div>
						</div>
					</div>
				</form>
				<div class="col-md-12">
					<button type="button" class="btn btn-default" id="btn-filter-reset">Limpar Filtro</button>
					<button type="button" class="btn btn-default" id="btn-filter"><span class="glyphicon glyphicon-filter"></span></button>
				</div>
			</div>
		</div>
	</div>
</div>