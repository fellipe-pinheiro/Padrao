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
    <?= form_open("#", 'class="form-horizontal" id="form_fita" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--Fita Laço-->
                    <div class="form-group">
                        <?= form_label('Fita Laço: ', 'fita_laco', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <select autofocus name="fita_laco" id="fita_laco" class="form-control" >
                                <option value="" disabled selected>Selecione</option>
                                <?php foreach ($dados['fita_laco'] as $key => $value) { 
                                    ?>
                                    <option value="<?=$value->id?>"><?=$value->nome?></option>
                                    <?php 
                                } 
                                ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Fita Material-->
                    <div class="form-group">
                        <?= form_label('Fita Material: ', 'fita_material', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <select name="fita_material" id="fita_material" class="form-control" >
                                <option value="" disabled selected>Selecione</option>
                                <?php foreach ($dados['fita_material'] as $key => $value) { 
                                    ?>
                                    <option value="<?=$value->id?>"><?=$value->nome?></option>
                                    <?php 
                                } 
                                ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 03mm-->
                    <div class="form-group">
                        <?= form_label('Valor_03mm: ', 'valor_03mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_03mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 07mm-->
                    <div class="form-group">
                        <?= form_label('Valor_07mm: ', 'valor_07mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_07mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 10mm-->
                    <div class="form-group">
                        <?= form_label('Valor_10mm: ', 'valor_10mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_10mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 15mm-->
                    <div class="form-group">
                        <?= form_label('Valor_15mm: ', 'valor_15mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_15mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 22mm-->
                    <div class="form-group">
                        <?= form_label('Valor_22mm: ', 'valor_22mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_22mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 38mm-->
                    <div class="form-group">
                        <?= form_label('Valor_38mm: ', 'valor_38mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_38mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 50mm-->
                    <div class="form-group">
                        <?= form_label('Valor_50mm: ', 'valor_50mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_50mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor 70mm-->
                    <div class="form-group">
                        <?= form_label('Valor_70mm: ', 'valor_70mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01"  value="0.00" name="valor_70mm" type="number" class="form-control" placeholder="Valor">
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>
<div class="modal fade" id="md_form_laco">
    <?= form_open("#", 'class="form-horizontal" id="form_laco" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita material</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--Nome-->
                    <div class="form-group">
                        <?= form_label('*Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>
<div class="modal fade" id="md_form_espessura">
    <?= form_open("#", 'class="form-horizontal" id="form_espessura" role="form"') ?>
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
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--esp_03mm-->
                    <div class="form-group">
                        <?= form_label('*esp_03mm: ', 'esp_03mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_03mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_07mm-->
                    <div class="form-group">
                        <?= form_label('*esp_07mm: ', 'esp_07mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_07mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_10mm-->
                    <div class="form-group">
                        <?= form_label('*esp_10mm: ', 'esp_10mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_10mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_15mm-->
                    <div class="form-group">
                        <?= form_label('*esp_15mm: ', 'esp_15mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_15mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_22mm-->
                    <div class="form-group">
                        <?= form_label('*esp_22mm: ', 'esp_22mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_22mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_38mm-->
                    <div class="form-group">
                        <?= form_label('*esp_38mm: ', 'esp_38mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_38mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_50mm-->
                    <div class="form-group">
                        <?= form_label('*esp_50mm: ', 'esp_50mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_50mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--esp_70mm-->
                    <div class="form-group">
                        <?= form_label('*esp_70mm: ', 'esp_70mm', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('esp_70mm', '', 'id="nome" class="form-control" placeholder="Nome para esta espessura"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>
<div class="modal fade" id="md_form_material">
    <?= form_open("#", 'class="form-horizontal" id="form_material" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Fita material</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--Nome-->
                    <div class="form-group">
                        <?= form_label('*Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    <?= form_close() ?>
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
            {data: "valor_70mm","visible": true,"orderable": false}
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
                    ajax: {
                        url: "<?= base_url('fita_laco/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                    {data: "id","visible": false},
                    {data: "nome","visible": true},
                    {data: "descricao","visible": true,"orderable": false}
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
                    ajax: {
                        url: "<?= base_url('fita_material/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                    {data: "id", "visible": false},
                    {data: "nome", "visible": true},
                    {data: "descricao", "visible": true,"orderable": false},
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
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            reset_form();
            console.log($(form +' .modal-title'));
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
                        if($('[name="' + index + '"]').is("input, textarea")){
                            $('[name="' + index + '"]').val(value);
                        }else if($('[name="' + index + '"]').is("select")){
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                        }
                    });
                    $(md_form).modal('show');
                    $(form +' .modal-title').text('Editar' + modal_title);
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
            if (confirm("O registro: " + nome + " será excluido. Clique em OK para continuar ou Cancele a operação.")) {
                $.ajax({
                    url: url_delete + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {
                        if (data.status) {
                            reload_table(dataTable);
                        }else{
                            alert("Erro ao excluir o registro");
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Erro ao excluir o registro');
                    }
                });
            }
        });
        $("#form_fita").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_laco").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_espessura").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_material").submit(function (e) {

            formulario_submit(e);
        });
    });

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
                            $(form + " #fita_laco").val('');
                        },
                        cancel: function(){
                            $(md_form).modal('hide');
                        }
                    });
                }else{
                    $(md_form).modal('hide');
                }
            }
            else
            {
                $.map(data.form_validation, function (value, index) {
                    $('[name="' + index + '"]').parent().parent().addClass('has-error');
                    $('[name="' + index + '"]').next().text(value);
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
        disable_buttons();
    }
    else {
        table.$("tr.selected").removeClass("selected");
        $(tr).addClass("selected");
        enable_buttons();
    }
}
function reload_table(tabela) {

    tabela.ajax.reload(null, false);
}
function reset_form() {
    $(form)[0].reset();
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