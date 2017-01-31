<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Lista de pedidos</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?=base_url('orcamento')?>"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li>
                            <a data-toggle="modal" href='#md_filtro'><i class="glyphicon glyphicon-filter"></i> Filtrar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="btn-reset">
                            <a href="javascript:void(0)"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)" id="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12 table-responsive">
                    <table id="tabela_pedido" class="table display compact table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>N° Pedido</th>
                                <th>Data pedido</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>N° Orçamento</th>
                                <th>Data Orçamento</th>
                                <th>Data Evento</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                                <th>CNPJ</th>
                                <th>Razao Social</th>
                                <th>Pessoa</th>
                                <th>Evento</th>
                                <th>Loja</th>
                                <th>Descricao</th>
                                <th>Condicoes</th>
                            </tr>
                        </thead>
                        <tbody id="fbody">
                        </tbody>
                    </table>
                </div>
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
                        <label for="ped_id" class="col-sm-3 control-label">Pedido Nº</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="ped_id" placeholder="Pedido Nº">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data_pedido" class="col-sm-3 control-label">Data do pedido</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control date" id="data_pedido" placeholder="00/00/0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cli_id" class="col-sm-3 control-label">ID Cliente</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="cli_id" placeholder="ID Cliente">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cli_nome" class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cli_nome" placeholder="Nome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cli_sobrenome" class="col-sm-3 control-label">Sobrenome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cli_sobrenome" placeholder="Sobrenome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data_evento" class="col-sm-3 control-label">Data do evento</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control date" id="data_evento" placeholder="00/00/0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" placeholder="e-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefone" class="col-sm-3 control-label">Telefone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control sp_celphones" id="telefone" placeholder="(00) 00000-0000">
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
                        <label for="razao_social" class="col-sm-3 control-label">Razão Social</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="razao_social" placeholder="Razão Social">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-default btn-reset"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</button>
                <button type="button" id="btn-filter" class="btn btn-default"><i class="glyphicon glyphicon-filter"></i> Filtrar</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<style>
    .dataTables_filter {
        display: none; 
    }
</style>
<script type="text/javascript">
	$(document).ready(function() {
        (function(){
            if (!$(this).hasClass("selected")) {
                $(this).removeClass("selected");
                disable_buttons();
            }
        })();
        var tabela;

        tabela = $("#tabela_pedido").DataTable({
            dom: 'lBfrtip',
            scrollX: true,
            scrollY:"500px",
            scrollCollapse: true,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
            {   
                extend:'colvis',
                text:'Visualizar colunas'
            }
            ],
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            processing: true,
            serverSide: true,
            ajax: {
            	url: "<?= base_url('pedido/ajax_list') ?>",
            	type: "POST",
                data: function ( data ) {
                    data.ped_id = $('#ped_id').val();
                    data.email = $('#email').val();
                    data.data_pedido = $('#data_pedido').val();
                    data.cli_id = $('#cli_id').val();
                    data.cli_nome = $('#cli_nome').val();
                    data.cli_sobrenome = $('#cli_sobrenome').val();
                    data.data_evento = $('#data_evento').val();
                    data.telefone = $('#telefone').val();
                    data.cpf = $('#cpf').val();
                    data.cnpj = $('#cnpj').val();
                    data.razao_social = $('#razao_social').val();
                },
            },
            columns: [
            {data: "DT_RowId","visible": true},
            {data: "ped_data","visible": false},
            {data: "cli_nome","visible": true},
            {data: "cli_sobrenome","visible": true},
            {data: "orc_id","visible": false},
            {data: "orc_data","visible": false},
            {data: "data_evento","visible": true},
            {data: "cli_email","visible": true},
            {data: "cli_telefone","visible": false},
            {data: "cli_cpf","visible": true},
            {data: "cli_cnpj","visible": true},
            {data: "cli_razao_social","visible": true},
            {data: "cli_pessoa_tipo","visible": false},
            {data: "evento","visible": false},
            {data: "loja","visible": false},
            {data: "descricao","visible": false},
            {data: "condicoes",visible: false}
            ],
        });
        //button filter event click
        $('#btn-filter').click(function(){
            //just reload table
            tabela.ajax.reload(null,false);
            $("#md_filtro").modal('hide');
        });
        //button reset event click
        $('.btn-reset').click(function(){
            $('#form-filter')[0].reset();
            //just reload table
            tabela.ajax.reload(null,false);
        });
        // Resaltar a linha selecionada
        $("#tabela_pedido tbody").on("click", "tr", function () {
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
        $("#pdf").click(function () {
            // Buscar ID da linha selecionada
            var id = tabela.row(".selected").id();
            if (!id) {
                return;
            }
            window.open("<?=base_url('pedido/pdf/')?>"+id);
        });
        $("#resumo").click(function () {
            // Buscar ID da linha selecionada
            var id = tabela.row(".selected").id();
            if (!id) {
                return;
            }
            window.location.replace("<?=base_url('pedido/resumo/')?>"+id);
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
    $('#form_pedido')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.help-block').empty();
}
function reset_errors() {
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
}
function enable_buttons() {
   $("#editar").attr("disabled", false);
   $("#deletar").attr("disabled", false);
}
function disable_buttons() {
   $("#editar").attr("disabled", true);
   $("#deletar").attr("disabled", true);
}
</script>