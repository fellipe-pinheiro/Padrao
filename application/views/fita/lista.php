<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-fita-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Fita</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-fita-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)" id="adicionar"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)" id="editar"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-trash"></i><b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="javascript:void(0)" id="deletar"><i class="glyphicon glyphicon-trash"></i> Excluir</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="col-md-12">
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab_fita" aria-controls="tab_fita" role="tab" data-toggle="tab">Fita</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_laco" aria-controls="tab_laco" role="tab" data-toggle="tab">Laço</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_espessura" aria-controls="tab_espessura" role="tab" data-toggle="tab">Espessura</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_material" aria-controls="tab_material" role="tab" data-toggle="tab">Material</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab_fita">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_fita" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Laço</th>
                                            <th>Material</th>
                                            <th>Val_03mm</th>
                                            <th>Val_07mm</th>
                                            <th>Val_10mm</th>
                                            <th>Val_15mm</th>
                                            <th>Val_22mm</th>
                                            <th>Val_38mm</th>
                                            <th>Val_50mm</th>
                                            <th>Val_70mm</th>
                                            <th>Ativo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_laco">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_laco" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Ativo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_espessura">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_espessura" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>esp_03mm</th>
                                            <th>esp_07mm</th>
                                            <th>esp_10mm</th>
                                            <th>esp_15mm</th>
                                            <th>esp_22mm</th>
                                            <th>esp_38mm</th>
                                            <th>esp_50mm</th>
                                            <th>esp_70mm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_material">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_material" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Ativo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_fita">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_fita">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <div class="row">
                            <!--ativo-->
                            <div class="col-sm-12">
                                <div class="form-group input-padding">
                                    <label for="ativo" class="control-label">Ativo:</label>
                                    <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--fita_material-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="fita_material" class="control-label">Material:</label>
                                    <select name="fita_material" id="fita_material" class="form-control selectpicker" data-live-search="true" required="required" autofocus>
                                        <option value="" disabled selected>Selecione</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--fita_laco-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="fita_laco" class="control-label">Laço:</label>
                                    <select name="fita_laco" id="fita_laco" class="form-control selectpicker" data-live-search="true" required="required" autofocus>
                                        <option value="" disabled selected>Selecione</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--valor_03mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_03mm" class="control-label"><i></i> valor_03mm:</label>
                                    <input type="number" name="valor_03mm" id="valor_03mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--valor_07mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_07mm" class="control-label"><i></i> valor_07mm:</label>
                                    <input type="number" name="valor_07mm" id="valor_07mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--valor_10mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_10mm" class="control-label"><i></i> valor_10mm:</label>
                                    <input type="number" name="valor_10mm" id="valor_10mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--valor_15mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_15mm" class="control-label"><i></i> valor_15mm:</label>
                                    <input type="number" name="valor_15mm" id="valor_15mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--valor_22mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_22mm" class="control-label"><i></i> valor_22mm:</label>
                                    <input type="number" name="valor_22mm" id="valor_22mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--valor_38mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_38mm" class="control-label"><i></i> valor_38mm:</label>
                                    <input type="number" name="valor_38mm" id="valor_38mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--valor_50mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_50mm" class="control-label"><i></i> valor_50mm:</label>
                                    <input type="number" name="valor_50mm" id="valor_50mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--valor_70mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor_70mm" class="control-label"><i></i> valor_70mm:</label>
                                    <input type="number" name="valor_70mm" id="valor_70mm" step="0.01" min="0" class="form-control valor_mm" value="0.00" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    <fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-default btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="md_form_laco">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_laco">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita material</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--ativo-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="ativo" class="control-label">Ativo:</label>
                                <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" required="required" placeholder="Nome do laço" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--Descrição-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="descricao" class="control-label">Descrição:</label>
                                <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
<div class="modal fade" id="md_form_espessura">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_espessura">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita Espessura</h4>
                </div>
                <div class="modal-body form">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <div class="row">
                            <!--esp_03mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_03mm" class="control-label">esp_03mm:</label>
                                    <input type="text" name="esp_03mm" id="esp_03mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--esp_07mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_07mm" class="control-label">esp_07mm:</label>
                                    <input type="text" name="esp_07mm" id="esp_07mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--esp_10mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_10mm" class="control-label">esp_10mm:</label>
                                    <input type="text" name="esp_10mm" id="esp_10mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--esp_15mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_15mm" class="control-label">esp_15mm:</label>
                                    <input type="text" name="esp_15mm" id="esp_15mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--esp_22mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_22mm" class="control-label">esp_22mm:</label>
                                    <input type="text" name="esp_22mm" id="esp_22mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--esp_38mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_38mm" class="control-label">esp_38mm:</label>
                                    <input type="text" name="esp_38mm" id="esp_38mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--esp_50mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_50mm" class="control-label">esp_50mm:</label>
                                    <input type="text" name="esp_50mm" id="esp_50mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--esp_70mm-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="esp_70mm" class="control-label">esp_70mm:</label>
                                    <input type="text" name="esp_70mm" id="esp_70mm" class="form-control" required="required" placeholder="Nome para esta espessura" pattern=".{1,20}" title="Máximo de 20 caracteres">
                                    <span class="help-block"></span>
                                </div>
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
<div class="modal fade" id="md_form_material">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_material">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita material</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--ativo-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="ativo" class="control-label">Ativo:</label>
                                <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" required="required" placeholder="Nome do material Ex: Cetim" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--Descrição-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="descricao" class="control-label">Descrição:</label>
                                <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
<?php $this->load->view('_include/dataTable'); ?>
<style>
    .tab-pane{
        margin-top: 30px;
    }
</style>
<script type="text/javascript">

    var tb_fita;
    var tb_laco;
    var tb_espessura;
    var tb_material;
    var tab_active;
    var dataTable;
    var md_form;
    var modal_title;
    var url_edit;
    var save_method;
    var url_add;
    var url_update;
    var form;
    var fita_atualizar = true;

    $(document).ready(function() {
        tb_fita = $("#tb_fita").DataTable({
            scrollX: true,
            scrollY:"500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
                {   
                    extend:'colvis',
                    text:'Visualizar colunas'
                },
                {
                    extend: 'collection',
                    text: 'Exportar',
                    autoClose: true,
                    buttons: [
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                        ],
                    fade: true
                }
                ],
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],//laço
            ajax: {
                url: "<?= base_url('fita/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id","visible": false},
                {data: "fita_laco","visible": true},
                {data: "fita_material","visible": true},
                {data: "valor_03mm","visible": true,"orderable": false},
                {data: "valor_07mm","visible": true,"orderable": false},
                {data: "valor_10mm","visible": true,"orderable": false},
                {data: "valor_15mm","visible": true,"orderable": false},
                {data: "valor_22mm","visible": true,"orderable": false},
                {data: "valor_38mm","visible": true,"orderable": false},
                {data: "valor_50mm","visible": true,"orderable": false},
                {data: "valor_70mm","visible": true,"orderable": false},
                {data: "ativo","visible": true,"orderable": false},
            ]
        });
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_fita']").click(function () {

            tb_fita.ajax.reload(null, false);
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
        });
        $("a[href='#tab_laco']").click(function () {
            if (!is_datatable_exists("#tb_laco")) {
                tb_laco = $("#tb_laco").DataTable({
                    scrollX: true,
                    scrollY:"500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
                    buttons: [
                        {   
                            extend:'colvis',
                            text:'Visualizar colunas'
                        },
                        {
                            extend: 'collection',
                            text: 'Exportar',
                            autoClose: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                ],
                            fade: true
                        }
                        ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    order: [[1, 'asc']],//nome
                    ajax: {
                        url: "<?= base_url('fita_laco/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "nome","visible": true},
                        {data: "descricao","visible": true,"orderable": false},
                        {data: "ativo","visible": true,"orderable": false},
                    ]
                });
            }else {
                tb_laco.ajax.reload(null, false);
            }
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
        });
        $("a[href='#tab_espessura']").click(function () {
            if (!is_datatable_exists("#tb_espessura")) {
                tb_espessura = $("#tb_espessura").DataTable({
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    scrollY:"500px",
                    scrollCollapse: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('fita_espessura/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "esp_03mm","visible": true},
                        {data: "esp_07mm","visible": true},
                        {data: "esp_10mm","visible": true},
                        {data: "esp_15mm","visible": true},
                        {data: "esp_22mm","visible": true},
                        {data: "esp_38mm","visible": true},
                        {data: "esp_50mm","visible": true},
                        {data: "esp_70mm","visible": true}
                    ]
                });
            }else {
                tb_espessura.ajax.reload(null, false);
            }
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
        });
        $("a[href='#tab_material']").click(function () {
            if (!is_datatable_exists("#tb_material")) {
                tb_material = $("#tb_material").DataTable({
                    scrollX: true,
                    scrollY:"500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
                    buttons: [
                        {   
                            extend:'colvis',
                            text:'Visualizar colunas'
                        },
                        {
                            extend: 'collection',
                            text: 'Exportar',
                            autoClose: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                ],
                            fade: true
                        }
                        ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    order: [[1, 'asc']],//nome
                    ajax: {
                        url: "<?= base_url('fita_material/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id", "visible": false},
                        {data: "nome", "visible": true},
                        {data: "descricao", "visible": true,"orderable": false},
                        {data: "ativo", "visible": true,"orderable": false},
                    ]
                });
            }else {
                tb_material.ajax.reload(null, false);
            }
             if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
        });
        //seleciona a linha da tabela
        $("#tb_fita tbody").on("click", "tr", function () {
            row_select(tb_fita,this);
        });
        $("#tb_laco tbody").on("click", "tr", function () {
            row_select(tb_laco,this);
        });
        $("#tb_espessura tbody").on("click", "tr", function () {
            row_select(tb_espessura,this);
        });
        $("#tb_material tbody").on("click", "tr", function () {
            row_select(tb_material,this);
        });
        $("#adicionar").click(function(event) {
            reset_form();
            $(".ativo-crud").prop('checked', true);
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            if(tab_active === "#tab_fita"){
                ajax_carregar_fita_material();
                ajax_carregar_fita_laco();
                clear_valor_mm();
            }
            save_method = 'add';
            $("input[name='id']").val("");
            $(form +' .modal-title').text('Adicionar' + modal_title);
            $(md_form).modal('show');
        });
        $("#editar").click(function () {
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }

            var id = dataTable.row(".selected").id();

            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            $.ajax({
                url: url_edit + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {   
                    data = switch_data(tab_active,data);
                    $.map(data, function (value, index) {
                        if(tab_active === "#tab_fita"){
                            check_valor_mm();
                        }
                        if($('[name="' + index + '"]').is("input, textarea")){
                            if($('[name="' + index + '"]').is(':checkbox')){
                                if(value === "0"){checked = false;}else{ checked = true;}
                                $('[name="' + index + '"]').prop('checked', checked);
                            }else{
                                $('[name="' + index + '"]').val(value);
                            }
                        }else if($('[name="' + index + '"]').is("select")){
                            if(tab_active === "#tab_fita"){
                                if(index == "fita_laco"){
                                    ajax_carregar_fita_laco(true,value.id);
                                }else if(index == "fita_material"){
                                    ajax_carregar_fita_material(true,value.id);
                                }
                            }else{
                                $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                            }
                        }
                    });
                    $(md_form).modal('show');
                    $(form +' .modal-title').text('Editar' + modal_title + ' ID: ' + id);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                }
            });
        });
        $("#deletar").click(function () {
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            var id = dataTable.row(".selected").id();
            var nome = dataTable.row(".selected").data().nome;
            if(tab_active === "#tab_fita"){
                nome = dataTable.row(".selected").data().fita_laco;
            }
            $.confirm({
                title: 'Atenção!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function(){
                    $.ajax({
                        url: url_delete + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                if(tab_active != '#tab_fita'){                            
                                    fita_atualizar = true;
                                }
                                reload_table(dataTable);
                                $.alert('<strong>ID: ' + id + ' ' + nome + '</strong> excluido com sucesso!');
                            }else{
                                alert("Erro ao excluir o registro");
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Erro ao excluir o registro');
                        }
                    });
                },
                cancel: function(){
                    $.alert('Cancelado!')
                }
            });
        });
        $("form").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_fita").on('keyup', '.valor_mm', function(event) { // Retira a classe de erro do formulário
            valor = $(this).val().replace(",", ".");
            if(valor > 0){
                $(this).prev().children().removeClass('glyphicon glyphicon-warning-sign');   
            }else{
                $(this).prev().children().addClass('glyphicon glyphicon-warning-sign');
            }
        });
    });
    
    function clear_valor_mm() {
        $.each($("#form_fita .valor_mm"), function(index, el) {
            $(el).prev().children().removeClass('glyphicon glyphicon-warning-sign');   
        });
    }

    function check_valor_mm() {
        $.each($("#form_fita .valor_mm"), function(index, el) {
            valor = $(el).val().replace(",", ".");
            if(valor == 0){
                $(el).prev().children().addClass('glyphicon glyphicon-warning-sign');
            }else{
                $(el).prev().children().removeClass('glyphicon glyphicon-warning-sign');   
            }
        });
    }
    
    function ajax_carregar_fita_material(editar = false,id_fita_material = null) {
        if(fita_atualizar){
            $('#fita_material')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecione</option>')
                .val('');

            $.ajax({
                url: '<?= base_url("fita_material/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
                data: {ativo: -1}
            })
            .done(function(data) {
                fita_atualizar = false;
                $.each(data, function(index, val) {
                    $('#fita_material').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_fita_material");
            })
            .always(function() {
                $('#fita_material').selectpicker('refresh');
                if(editar){
                    $('#fita_material').selectpicker('val', id_fita_material);
                }
            });
        }else {
            if(editar){
                $('#fita_material').selectpicker('val', id_fita_material);
            }else{
                $('#fita_material').selectpicker('val', '');
            }
        }
    }

    function ajax_carregar_fita_laco(editar = false,id_fita_laco = null) {
        if(fita_atualizar){
            $('#fita_laco')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecione</option>')
                .val('');

            $.ajax({
                url: '<?= base_url("fita_laco/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
                data: {ativo: -1}
            })
            .done(function(data) {
                fita_atualizar = false;
                $.each(data, function(index, val) {
                    $('#fita_laco').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_fita_laco");
            })
            .always(function() {
                $('#fita_laco').selectpicker('refresh');
                if(editar){
                    $('#fita_laco').selectpicker('val', id_fita_laco);
                }
            });
        }else{  
            if(editar){
                $('#fita_laco').selectpicker('val', id_fita_laco);
            }else{
                $('#fita_laco').selectpicker('val', '');
            }
        } 
    }

    function formulario_submit(e) {

        disable_button_salvar();
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        reset_errors();
        
        var url_submit;
        if (save_method == 'add') {
            url_submit = url_add;
        } else {
            url_submit = url_update;
        }
        $.ajax({
            url: url_submit,
            type: "POST",
            data: $(form).serialize(),
            dataType: "JSON",
            success: function (data)
            {
                if (data.status)
                {   
                    if(tab_active == '#tab_fita' && save_method == 'add'){
                        $.confirm({
                            title: 'Fita inserida com sucesso!',
                            content: 'Deseja inserir mais uma fita de mesmo material?',
                            confirmButton: 'Sim',
                            cancelButton: 'Não',
                            confirm: function(){
                                $(form + ' #fita_laco').selectpicker('val', '');
                            },
                            cancel: function(){
                                $(md_form).modal('hide');
                            }
                        });
                    }else{
                        if(tab_active != '#tab_fita'){                            
                            fita_atualizar = true;
                        }
                        $(md_form).modal('hide');
                    }
                }
                else
                {
                    $.map(data.form_validation, function (value, index) {
                        $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                        $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Erro ao Adicionar ou Editar');
            },
            complete:function(){
                enable_button_salvar();
                reload_table(dataTable);
            }
        });
        e.preventDefault();
    }

    function get_tab_active() {
        form_small();
        tab_active = $(".nav-tabs li.active a")[0].hash;
        switch(tab_active) {
            case '#tab_fita':
            dataTable = tb_fita;
            md_form = '#md_form_fita';
            modal_title = ' Fita';
            url_edit = "<?= base_url('fita/ajax_edit/') ?>";
            url_add = "<?php echo site_url('fita/ajax_add') ?>";
            url_update = "<?php echo site_url('fita/ajax_update') ?>";
            url_delete = "<?= base_url('fita/ajax_delete/') ?>";
            form = '#form_fita';
            return true;
            break;
            case '#tab_laco':
            dataTable = tb_laco;
            md_form = '#md_form_laco';
            modal_title = ' Laço';
            url_edit = "<?= base_url('fita_laco/ajax_edit/') ?>";
            url_add = "<?php echo site_url('fita_laco/ajax_add') ?>";
            url_update = "<?php echo site_url('fita_laco/ajax_update') ?>";
            url_delete = "<?= base_url('fita_laco/ajax_delete/') ?>";
            form = '#form_laco';
            return true;
            break;
            case '#tab_espessura':
            dataTable = tb_espessura;
            md_form = '#md_form_espessura';
            modal_title = ' Espessura';
            url_edit = "<?= base_url('fita_espessura/ajax_edit/') ?>";
            url_add = "<?php echo site_url('fita_espessura/ajax_add') ?>";
            url_update = "<?php echo site_url('fita_espessura/ajax_update') ?>";
            url_delete = "<?= base_url('fita_espessura/ajax_delete/') ?>";
            form = '#form_espessura';
            return true;
            break;
            case '#tab_material':
            dataTable = tb_material;
            md_form = '#md_form_material';
            modal_title = ' Material';
            url_edit = "<?= base_url('fita_material/ajax_edit/') ?>";
            url_add = "<?php echo site_url('fita_material/ajax_add') ?>";
            url_update = "<?php echo site_url('fita_material/ajax_update') ?>";
            url_delete = "<?= base_url('fita_material/ajax_delete/') ?>";
            form = '#form_material';
            return true;
            break;
            default:
            return false;    
        }
    }

    function switch_data(tab_active,data) {
        switch(tab_active){
            case '#tab_fita':
            return data.fita;
            break;
            case '#tab_laco':
            return data.fita_laco;
            break;
            case '#tab_espessura':
            return data.fita_espessura;
            break;
            case '#tab_material':
            return data.fita_material;
            break;
        }
    }

    function row_select(table,tr) {
        if ($(tr).hasClass("selected")) {
            $(tr).removeClass("selected");
        }
        else {
            table.$("tr.selected").removeClass("selected");
            $(tr).addClass("selected");
        }
    }

    function reload_table(tabela) {

        tabela.ajax.reload(null, false);
    }

    function reset_form() {
        $(form)[0].reset();
        reset_errors();
    }

</script>