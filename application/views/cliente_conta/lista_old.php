<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?= $dados['titulo_painel'] ?></h3>
	</div>
	<div class="panel-body">
        <div class="col-md-10">
            <button class="btn btn-default" data-toggle="modal" href='#md_filtro'><span class="glyphicon glyphicon-search"></span></button>
            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
            <button class="btn btn-default" id="efetuar_pagamento">Efetuar pagamento</button>
        </div>
        <div class="dropdown col-md-2">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Mostrar colunas
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                  <li><a class="toggle-vis" data-column="0"><span class="glyphicon glyphicon-eye-open"></span> id</a></li>
                  <li><a class="toggle-vis" data-column="1"><span class="glyphicon glyphicon-eye-open"></span> data</a></li>
                  <li><a class="toggle-vis" data-column="2"><span class="glyphicon glyphicon-eye-close"></span> usr_nome</a></li>
                  <li><a class="toggle-vis" data-column="3"><span class="glyphicon glyphicon-eye-open"></span> num_pedido</a></li>
                  <li><a class="toggle-vis" data-column="4"><span class="glyphicon glyphicon-eye-open"></span> status</a></li>
                  <li><a class="toggle-vis" data-column="5"><span class="glyphicon glyphicon-eye-close"></span> valor_pedido</a></li>
                  <li><a class="toggle-vis" data-column="6"><span class="glyphicon glyphicon-eye-open"></span> vencimento</a></li>
                  <li><a class="toggle-vis" data-column="7"><span class="glyphicon glyphicon-eye-close"></span> forma_pagto</a></li>
                  <li><a class="toggle-vis" data-column="8"><span class="glyphicon glyphicon-eye-open"></span> descricao</a></li>
                  <li><a class="toggle-vis" data-column="9"><span class="glyphicon glyphicon-eye-close"></span> pagamento</a></li>
                  <li><a class="toggle-vis" data-column="10"><span class="glyphicon glyphicon-eye-close"></span> qtd_parcelas</a></li>
                  <li><a class="toggle-vis" data-column="11"><span class="glyphicon glyphicon-eye-open"></span> cli_nome</a></li>
                  <li><a class="toggle-vis" data-column="12"><span class="glyphicon glyphicon-eye-open"></span> cli_sobrenome</a></li>
                  <li><a class="toggle-vis" data-column="13"><span class="glyphicon glyphicon-eye-open"></span> cli_cpf</a></li>
                  <li><a class="toggle-vis" data-column="14"><span class="glyphicon glyphicon-eye-open"></span> cli_cnpj</a></li>
                  <li><a class="toggle-vis" data-column="15"><span class="glyphicon glyphicon-eye-close"></span> cli_email</a></li>
                  <li><a class="toggle-vis" data-column="16"><span class="glyphicon glyphicon-eye-open"></span> debito</a></li>
                  <li><a class="toggle-vis" data-column="17"><span class="glyphicon glyphicon-eye-open"></span> credito</a></li>
              </ul>
          </div>
          <hr>  
          <div class="row">
            <div class="col-sm-12 table-responsive">
                <table id="tabela" class="table display compact table-bordered " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>data</th>
                            <th>usr_nome</th>
                            <th>num_pedido</th>
                            <th>status</th>
                            <th>valor_pedido</th>
                            <th>vencimento</th>
                            <th>forma_pagto</th>
                            <th>descricao</th>
                            <th>pagamento</th>
                            <th>qtd_parcelas</th>
                            <th>cli_nome</th>
                            <th>cli_sobrenome</th>
                            <th>cli_cpf</th>
                            <th>cli_cnpj</th>
                            <th>cli_email</th>
                            <th>Saldo devedor</th>
                            <th>Saldo credidor</th>
                        </tr>
                    </thead>
                    <tbody id="fbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_filtro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Filtro</h4>
            </div>
            <div class="modal-body">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label for="ped_id" class="col-sm-3 control-label">Nº Pedido</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="ped_id" placeholder="Nº Pedido">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data_vencimento" class="col-sm-3 control-label">Data vencimento</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control date" id="data_vencimento" placeholder="00/00/0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" placeholder="e-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cpf" class="col-sm-3 control-label">CPF</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control cpf" id="cpf" placeholder="000.000.000-00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cnpj" class="col-sm-3 control-label">CNPJ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control cnpj" id="cnpj" placeholder="00.000.000/0000-00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LastName" class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <button type="button" id="btn-filter" class="btn btn-default">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_pagamento">
    <form id="form_pagamento" method="POST" accept-charset="utf-8">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Efetuar Pagamento</h4>
                </div>
                <div class="modal-body row">
                    <?= form_hidden('data') ?>
                    <!--Id do documento-->
                    <div class="form-group">
                        <?= form_label('*Código do documento: ', 'id', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input name="id" id="id" class="form-control" placeholder="Código do documento" readonly/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Pedido-->
                    <div class="form-group">
                        <?= form_label('*Pedido: ', 'pedido', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input name="pedido" id="pedido" class="form-control" placeholder="Pedido" readonly />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input name="descricao" id="descricao" class="form-control" placeholder="Descrição" readonly />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Valor do documento-->
                    <div class="form-group">
                        <?= form_label('*Valor do documento: ', 'debito', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input name="debito" id="debito" class="form-control" placeholder="debito" readonly />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Data vencimento-->
                    <div class="form-group">
                        <?= form_label('*Data vencimento: ', 'vencimento', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input type="date" name="vencimento" id="vencimento" class="form-control" placeholder="vencimento" readonly />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Data pagamento-->
                    <div class="form-group">
                        <?= form_label('*Data pagamento: ', 'data_pagamento', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" placeholder="Data pagamento" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Forma pagamento-->
                    <div class="form-group">
                        <?= form_label('*Forma de pagamento: ', 'forma_pagamento', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                                <option value="" selected >Selecione</option>
                                <?php 
                                foreach ($dados['forma_pagamento'] as $key => $forma_pagamento) {
                                    ?>
                                    <option value="<?=$forma_pagamento->id?>"><?=$forma_pagamento->nome?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Valor-->
                    <div class="form-group">
                        <?= form_label('*Valor: ', 'valor', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" value="" name="valor" class="form-control" placeholder="Valor" autofocus="true" />
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-default btnSubmit" id="btnSubmit_form_pagamento">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
	$(document).ready(function() {
        (function(){
            if (!$(this).hasClass("selected")) {
                $(this).removeClass("selected");
                disable_buttons();
            }
        })();
        tabela = $("#tabela").DataTable({
           language: {
            url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
        },
        scrollY:"500px",
        scrollCollapse: true,
        processing: true,
        serverSide: true,
        ajax: {
         url: "<?= base_url('cliente_conta/ajax_list') ?>",
         type: "POST",
         data: function ( data ) {
            data.ped_id = $('#ped_id').val();
            data.cpf = $('#cpf').val();
            data.cnpj = $('#cnpj').val();
            data.email = $('#email').val();
            data.vencimento = $('#vencimento').val();
        },
    },
    columnDefs: [
    { "visible": false, "targets": 2 },
    { "visible": false, "targets": 5 },
    { "visible": false, "targets": 7 },
    { "visible": false, "targets": 9 },
    { "visible": false, "targets": 10 },
    { "visible": false, "targets": 15 }
    ],
    columns: [
    {data: "DT_RowId"},
    {data: "cc_data"},
    {data: "usr_nome"},
    {data: "cc_pedido"},
    {data: "cc_status"},
    {data: "cc_valor_pedido"},
    {data: "cc_vencimento"},
    {data: "fpg_nome"},
    {data: "cc_descricao"},
    {data: "cc_pagamento"},
    {data: "cc_qtd_parcelas"},
    {data: "cli_nome"},
    {data: "cli_sobrenome"},
    {data: "cli_cpf"},
    {data: "cli_cnpj"},
    {data: "cli_email"},
    {data: "cc_debito"},
    {data: "cc_credito"}
    ]
});
        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
            var column = tabela.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            className = $(this).children().attr("class");
            if(className === 'glyphicon glyphicon-eye-open'){
                $(this).children().removeClass('glyphicon glyphicon-eye-open' );
                $(this).children().addClass('glyphicon glyphicon-eye-close' );
                $(this).addClass('text-muted');
            }else{
                $(this).children().removeClass('glyphicon glyphicon-eye-close' );
                $(this).children().addClass('glyphicon glyphicon-eye-open' );
                $(this).removeClass('text-muted');
            }
        });
        //button filter event click
        $('#btn-filter').click(function(){
            //just reload table
            tabela.ajax.reload(null,false);
            $("#md_filtro").modal('hide');
        });
        //button reset event click
        $('#btn-reset').click(function(){
            $('#form-filter')[0].reset();
            //just reload table
            tabela.ajax.reload(null,false);
        });
        // Resaltar a linha selecionada
        $("#tabela tbody").on("click", "tr", function () {
        	if ($(this).hasClass("selected")) {
        		$(this).removeClass("selected");
        		disable_buttons();
        	}
        	else {
        		tabela.$("tr.selected").removeClass("selected");
        		$(this).addClass("selected");
        		enable_buttons();
        	}
        });
        $("#efetuar_pagamento").click(function () {
            var id = tabela.row(".selected").id();
            if (!id) {
                return;
            }
            $.ajax({
                url: '<?=base_url('cliente_conta/ajax_edit/')?>'+id,
                type: 'POST',
                dataType: 'JSON'
            })
            .done(function(data) {
                console.log("success");
                $.map(data.cliente_conta, function (value, index) {
                    if($('[name="' + index + '"]').is("input, textarea")){
                        $('[name="' + index + '"]').val(value);
                    }else if($('[name="' + index + '"]').is("select")){
                        $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                    };
                    $('#md_form_pagamento').modal('show');
                });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $("#btnSubmit_form_pagamento").click(function (e) {
            reset_errors();
            $('.btnSubmit').text('Salvando...');
            $('.btnSubmit').attr('disabled', true);
            $.ajax({
                url: '<?=base_url('cliente_conta/efetuar_pagamento')?>',
                type: 'POST',
                dataType: 'JSON',
                data: $('#form_pagamento').serialize(),
            })
            .done(function(data) {
                console.log("success");
                if (data.status)
                {
                    $('#md_form_pagamento').modal('hide');
                }
                else
                {
                    $.map(data.form_validation, function (value, index) {
                        $('[name="' + index + '"]').parent().parent().addClass('has-error');
                        $('[name="' + index + '"]').next().text(value);
                    });
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("error");
                $.alert({
                    title: 'Alerta!',
                    content: 'Não foi possível Adicionar ou Editar o registro. Tente novamente.',
                });
            })
            .always(function() {
                console.log("complete");
                $('.btnSubmit').text('Salvar');
                $('.btnSubmit').attr('disabled', false);
            });
            e.preventDefault();
        });
    });
function call_loadingModal(msg=""){
    if(msg ===""){
        msg = "Processando os dados..."
    }
    $('body').loadingModal({
        position: 'auto',
        text: msg,
        color: '#fff',
        opacity: '0.7',
        backgroundColor: 'rgb(0,0,0)',
        animation: 'threeBounce'
    });
}
function close_loadingModal() {
    // hide the loading modal
    $('body').loadingModal('hide');
    // destroy the plugin
    $('body').loadingModal('destroy');
}
function reload_table() {

    tabela.ajax.reload(null, false);
}
function reset_form() {
    $('#form_pagamento')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty();
}
function reset_errors() {
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
}
function enable_buttons() {
   $("#efetuar_pagamento").attr("disabled", false);
}
function disable_buttons() {
   $("#efetuar_pagamento").attr("disabled", true);
}
</script>