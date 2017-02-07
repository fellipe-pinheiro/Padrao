<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-papel-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Papel</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-papel-menu">
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
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab_papel" aria-controls="tab_papel" role="tab" data-toggle="tab">Papel</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_linha" aria-controls="tab_linha" role="tab" data-toggle="tab">Linha</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_acabamento" aria-controls="tab_acabamento" role="tab" data-toggle="tab">Acabamento</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_dimensao" aria-controls="tab_dimensao" role="tab" data-toggle="tab">Dimensão</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab_papel">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_papel" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Linha</th>
                                            <th>Papel</th>
                                            <th>Altura (mm)</th>
                                            <th>Largura (mm)</th>
                                            <th>Gramatura (g)</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_linha">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_linha" class="table display compact table-bordered " cellspacing="0" width="100%">
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
                    <div role="tabpanel" class="tab-pane" id="tab_acabamento">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_acabamento" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_dimensao">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_dimensao" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Altura (mm)</th>
                                            <th>Largura (mm)</th>
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
<div class="modal fade" id="md_papel">
    <?= form_open("#", 'class="form-horizontal" id="form_papel" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Papel</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>
                    <!--Papel Linha-->
                    <div class="form-group">
                        <?= form_label('Linha: ', 'papel_linha', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <select name="papel_linha" id="papel_linha" class="form-control selectpicker show-tick" data-live-search="true" autofocus="">
                                <option value="" disabled selected>Selecione</option>
                                <?php foreach ($dados['papel_linha'] as $key => $value) { 
                                    ?>
                                    <option value="<?= $value->id ?>"><?= $value->nome ?></option>
                                    <?php 
                                } 
                                ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Nome-->
                    <div class="form-group">
                        <?= form_label('Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Papel Dimensao-->
                    <div class="form-group">
                        <?= form_label('Dimensão: ', 'papel_dimensao', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <select name="papel_dimensao" id="papel_dimensao" class="form-control" >
                                <option value="" selected disabled>Selecione</option>
                                <?php
                                foreach ($dados['papel_dimensao'] as $key => $value) {
                                    ?>
                                    <option value="<?=$value->id?>"><?=$value->altura?> x <?=$value->largura?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Papel Gramatura-->
                    <div class="form-group" id="default_gramatura">
                        <?= form_label('Gramatura: ', 'gramatura', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-4">
                            <input step="1" type="number" min="0" name="gramatura_0_ADD" required class="form-control" placeholder="Gramatura ex: 80">
                        </div>
                        <div class="col-sm-4">
                            <input step="0.01" type="number" min="0" name="valor_0_ADD" required class="form-control" placeholder="Valor ex: 3,20">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" id="add_gramatura"><i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>
                    <div id="lista_gramaturas">
                    </div>
                      
                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descricao"') ?>
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
<div class="modal fade" id="md_linha">
    <?= form_open("#", 'class="form-horizontal" id="form_linha" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Linha</h4>
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
                            <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descrição"') ?>
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
<div class="modal fade" id="md_acabamento">
    <?= form_open("#", 'class="form-horizontal" id="form_acabamento" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Papel Acabamento</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--Nome-->
                    <div class="form-group">
                        <?= form_label('Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('nome', '', 'id="nome" class="form-control" disabled="true" placeholder="Nome"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--codigo-->
                    <div class="form-group">
                        <?= form_label('*Código: ', 'codigo', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input(array('name'=>'codigo','type'=>'text', 'id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Código', 'disabled'=>'true'), '') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descrição"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--Valor-->
                    <div class="form-group">
                        <?= form_label('*Valor: ', 'valor', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <input step="0.01" value="" name="valor" type="number" class="form-control" placeholder="Valor" />
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
<div class="modal fade" id="md_dimensao">
    <?= form_open("#", 'class="form-horizontal" id="form_dimensao" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Dimensões de papéis</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--Altura-->
                    <div class="form-group">
                        <?= form_label('Altura: ', 'altura', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input(array('name'=>'altura','type'=>'number', 'id'=>'altura', 'class'=>'form-control', 'placeholder'=>'Altura')) ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--largura-->
                    <div class="form-group">
                        <?= form_label('Largura: ', 'largura', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input(array('name'=>'largura','type'=>'number', 'id'=>'largura', 'class'=>'form-control', 'placeholder'=>'Largura')) ?>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input type="submit" id="btnSubmit" class="btn btn-success" value="Salvar">
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>
<div class="modal fade" id="md_acabamento_docs">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Documentação</h4>
            </div>
            <div class="modal-body">
                <p>Configurar a tabela conforme a tabela da documentação. Cada item deverá ter o mesmo código desta tabela</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Empastamento</td>
                            <td>empastamento</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Laminação</td>
                            <td>laminacao</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Relevo Seco</td>
                            <td>relevo_seco</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Corte Vinco</td>
                            <td>corte_vinco</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Almofada / Bandeja</td>
                            <td>almofada</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Douração</td>
                            <td>douracao</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Corte Laser</td>
                            <td>corte_laser</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Faca</td>
                            <td>faca</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_filtro_papel">
    <form id="form-filter-papel" class="form-horizontal form-filter">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Filtro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="papel-filtro_papel" class="control-label"> Papel</label>
                        <input type="text" id="papel-filtro_papel" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_linha" class="control-label"> Linha</label>
                        <select id="papel-filtro_linha" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($dados['papel_linha'] as $key => $value) {
                                ?>
                                <option value="<?=$value->nome?>"><?=$value->nome?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_altura" class="control-label"> Papel Altura</label>
                        <input type="number" min="0" class="form-control" id="papel-filtro_altura" placeholder="Papel Altura">
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_largura" class="control-label"> Papel Largura</label>
                        <input type="number" min="0" class="form-control" id="papel-filtro_largura" placeholder="Papel Largura">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="filtro('reset')">
                        <span class="glyphicon glyphicon-erase"></span> Limpar Filtro
                    </button>
                    <button type="button" class="btn btn-default" onclick="filtro('filtrar')">
                        <span class="glyphicon glyphicon-filter"></span>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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

    var tb_papel;
    var tb_linha;
    var tb_acabamento;
    var tb_dimensao;
    var tab_active;
    var dataTable;
    var md_form;
    var modal_title;
    var url_edit;
    var save_method;
    var url_add;
    var url_update;
    var form;
    var count_gramatura = 0;

    $(document).ready(function() {
        tb_papel = $("#tb_papel").DataTable({
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
                },
                {   
                    text: '<i class="glyphicon glyphicon-filter"></i> Filtro',
                    action: function () {
                        $('.modal-title').text('Filtro');
                        $("#md_filtro_papel").modal('show');
                    }
                }
            ],
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('papel/ajax_list') ?>",
                type: "POST",
                data: function ( data ) {
                    data.filtro_papel = $('#papel-filtro_papel').val();
                    data.filtro_linha = $('#papel-filtro_linha').val();
                    data.filtro_altura = $('#papel-filtro_altura').val();
                    data.filtro_largura = $('#papel-filtro_largura').val();
                    data.filtro_linha = $('#papel-filtro_linha').val();
                },
            },
            columns: [
                {data: "id","visible": false},
                {data: "linha","visible": true},
                {data: "papel","visible": true},
                {data: "altura","visible": true,"orderable": false},
                {data: "largura","visible": true,"orderable": false},
                {data: "gramaturas","visible": true,"orderable": false},
                {data: "descricao","visible": false,"orderable": false},

            ],
            order: [[1, 'asc']],
        });
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_papel']").click(function () {

            tb_papel.ajax.reload(null, false);
        });
        $("a[href='#tab_linha']").click(function () {
            if (!is_datatable_exists("#tb_linha")) {
                tb_linha = $("#tb_linha").DataTable({
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
                        url: "<?= base_url('papel_linha/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "nome","visible": true},
                        {data: "descricao","visible": true,"orderable": false},
                    ]
                });
            }else {
                tb_linha.ajax.reload(null, false);
            }
        });
        $("a[href='#tab_acabamento']").click(function () {
            if (!is_datatable_exists("#tb_acabamento")) {
                tb_acabamento = $("#tb_acabamento").DataTable({
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
                        },
                        {   
                            text: 'Documentação',
                            action: function () {
                                open_papel_acabamento_docs();
                            }
                        }
                    ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('papel_acabamento/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": true},
                        {data: "nome","visible": true},
                        {data: "codigo","visible": true},
                        {data: "descricao","visible": true},
                        {data: "valor","visible": true}
                    ]
                });
            }else {
                tb_acabamento.ajax.reload(null, false);
            }
        });
        $("a[href='#tab_dimensao']").click(function () {
            if (!is_datatable_exists("#tb_dimensao")) {
                tb_dimensao = $("#tb_dimensao").DataTable({
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
                        url: "<?= base_url('papel_dimensao/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "altura","visible": true},
                        {data: "largura","visible": true}
                    ]
                });
            }else {
                tb_dimensao.ajax.reload(null, false);
            }
        });
        //seleciona a linha da tabela
        $("#tb_papel tbody").on("click", "tr", function () {
            row_select(tb_papel,this);            
        });
        $("#tb_linha tbody").on("click", "tr", function () {
            row_select(tb_linha,this);            
        });
        $("#tb_acabamento tbody").on("click", "tr", function () {
            row_select(tb_acabamento,this);            
        });
        $("#tb_dimensao tbody").on("click", "tr", function () {
            row_select(tb_dimensao,this);            
        });
        $("#adicionar").click(function(event) {
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");
            $('.modal-title').text('Adicionar' + modal_title);
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
                    if(tab_active == '#tab_papel'){
                        $.map(data, function (value, index) {
                            if($('[name="' + index + '"]').is("input, textarea")){
                                $('[name="' + index + '"]').val(value);
                            }else if($('[name="' + index + '"]').is("select")){
                                if( $('[name="' + index + '"]').hasClass("selectpicker") ){
                                    $('[name="' + index + '"]').selectpicker('val', value.id);
                                }else{
                                    $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                                }
                            }else if(index === 'papel_gramaturas'){
                                $.each(value,function(i, gramatura) {
                                    if(i === 0){
                                        $("#default_gramatura input")[0].value = gramatura.gramatura;
                                        $("#default_gramatura input")[1].value = gramatura.valor;
                                        $($("#default_gramatura input")[0]).prop("name","gramatura_"+gramatura.id+"_UPD");
                                        $($("#default_gramatura input")[1]).prop("name","valor_"+gramatura.id+"_UPD");
                                    }else{
                                        clonar_gramatura(gramatura.id+"_UPD",gramatura.gramatura,gramatura.valor);
                                    }
                                });
                            }

                        });
                    }else{
                        $.map(data, function (value, index) {
                            if($('[name="' + index + '"]').is("input, textarea")){
                                $('[name="' + index + '"]').val(value);
                            }else if($('[name="' + index + '"]').is("select")){
                                if( $('[name="' + index + '"]').hasClass("selectpicker") ){
                                    $('[name="' + index + '"]').selectpicker('val', value.id);
                                }else{
                                    $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                                }
                            }
                        });
                    }
                    $(md_form).modal('show');
                    $('.modal-title').text('Editar' + modal_title);
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
        $("form").submit(function (e) {

            formulario_submit(e);
        });
        $(".check_filter_dirty").change(function(event) {

            check_filter_dirty();
        });
        $("#add_gramatura").click(function(){
            count_gramatura++;
            clonar_gramatura(count_gramatura+"_ADD","","");
        });
    });

function clonar_gramatura(id,gramatura,valor){
    var c = $("#default_gramatura").clone().prop("id","gramatura_papel_"+id);
    // ALterar sinal do botao
    $(c[0]).find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    // adicionar funcao para deletar a linha
    if (gramatura == "") {
    $(c[0]).find("button").attr("onclick","remover_gramatura_papel('gramatura_papel_"+id+"',true);");
    } else {
    $(c[0]).find("button").attr("onclick","remover_gramatura_papel('gramatura_papel_"+id+"',false);");
    }
    // Alterar name do inputs
    $($(c[0]).find("input")[0]).prop("name","gramatura_"+id).val(gramatura);
    $($(c[0]).find("input")[1]).prop("name","valor_"+id).val(valor);

    c.appendTo("#lista_gramaturas");
}
function remover_gramatura_papel(id,add) {
    if (add) {
        $("#"+id).remove();
    } else {
        var arr_g = new Array();
        var arr_v = new Array();
        // adicionar o D no name dos inputs
        var name_gramatura = $($("#"+id+" input")[0]).prop("name");
        arr_g = name_gramatura.split("_");
        arr_g[2] = "DEL";
        name_gramatura = arr_g[0] + "_" + arr_g[1] + "_" + arr_g[2];
        $($("#"+id+" input")[0]).prop("name",name_gramatura);

        var name_valor = $($("#"+id+" input")[1]).prop("name");
        arr_v = name_valor.split("_");
        arr_v[2] = "DEL";
        name_valor = arr_v[0] + "_" + arr_v[1] + "_" + arr_v[2];
        $($("#"+id+" input")[1]).prop("name",name_valor);
        $("#"+id).hide();
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
                if(tab_active == '#tab_papel' && save_method == 'add'){
                    $.confirm({
                        title: 'Papel inserido com sucesso!',
                        content: 'Deseja inserir mais um papel da mesma linha?',
                        confirmButton: 'Sim',
                        cancelButton: 'Não',
                        confirm: function(){
                            $(form + " #nome").val('');
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
                    $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                    $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Erro ao Adicionar ou Editar');
        },
        complete: function () 
        {
            enable_button_salvar();
            reload_table(dataTable);
        }
    });
    e.preventDefault();
}
function get_tab_active() {
    tab_active = $(".nav-tabs li.active a")[0].hash;
    switch(tab_active) {
        case '#tab_papel':
            dataTable = tb_papel;
            md_form = '#md_papel';
            modal_title = ' Papel';
            url_edit = "<?= base_url('papel/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel/ajax_add') ?>";
            url_update = "<?php echo site_url('papel/ajax_update') ?>";
            url_delete = "<?= base_url('papel/ajax_delete/') ?>";
            form = '#form_papel';
            return true;
            break;
        case '#tab_linha':
            dataTable = tb_linha;
            md_form = '#md_linha';
            modal_title = ' Linha';
            url_edit = "<?= base_url('papel_linha/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel_linha/ajax_add') ?>";
            url_update = "<?php echo site_url('papel_linha/ajax_update') ?>";
            url_delete = "<?= base_url('papel_linha/ajax_delete/') ?>";
            form = '#form_linha';
            return true;
            break;
        case '#tab_acabamento':
            dataTable = tb_acabamento;
            md_form = '#md_acabamento';
            modal_title = ' Papel Acabamento';
            url_edit = "<?= base_url('papel_acabamento/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel_acabamento/ajax_add') ?>";
            url_update = "<?php echo site_url('papel_acabamento/ajax_update') ?>";
            url_delete = "<?= base_url('papel_acabamento/ajax_delete/') ?>";
            form = '#form_acabamento';
            return true;
            break;
        case '#tab_dimensao':
            dataTable = tb_dimensao;
            md_form = '#md_dimensao';
            modal_title = ' Papel Dimensão';
            url_edit = "<?= base_url('papel_dimensao/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel_dimensao/ajax_add') ?>";
            url_update = "<?php echo site_url('papel_dimensao/ajax_update') ?>";
            url_delete = "<?= base_url('papel_dimensao/ajax_delete/') ?>";
            form = '#form_dimensao';
            return true;
            break;
        default:
        return false;    
    }
}
function switch_data(tab_active,data) {
    switch(tab_active){
        case '#tab_papel':
            return data.papel;
            break;
        case '#tab_linha':
            return data.linha;
            break;
        case '#tab_acabamento':
            return data.papel_acabamento;
            break;
        case '#tab_dimensao':
            return data.papel_dimensao;
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
    $('.selectpicker').selectpicker('val', '');
    $("#lista_gramaturas").html("");
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
function open_papel_acabamento_docs() {

    $("#md_acabamento_docs").modal('show');
}
function filtro(acao) {
    if(!get_tab_active()){
        console.log('Não foi possível carregar get_tab_active()');
        return false;
    }
    if(acao === 'filtrar'){
        dataTable.ajax.reload(null,false);
        $("#md_filtro_papel").modal('hide');
    }else if(acao === 'reset'){
        $('#form-filter-papel')[0].reset();
        $('#form-filter-papel ul>li.selected.active').removeClass('selected active');
        $('#papel-filtro_linha').selectpicker('val', '');
        dataTable.ajax.reload(null,false);
    }
}
</script>