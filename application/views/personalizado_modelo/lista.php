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
                    <div class="navbar-brand">Modelo Personalizado</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
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
                        <a href="#tab_personalizado_modelo" aria-controls="tab_personalizado_modelo" role="tab" data-toggle="tab">Modelo Personalizado</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_categoria" aria-controls="tab_categoria" role="tab" data-toggle="tab">Categoria</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab_personalizado_modelo">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_personalizado_modelo" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Categoria</th>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Formato</th>
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
                    <div role="tabpanel" class="tab-pane" id="tab_categoria">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_categoria" class="table display compact table-bordered " cellspacing="0" width="100%">
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
<div class="modal fade" id="md_form_personalizado_modelo">
    <?= form_open("#", 'class="form-horizontal" id="form_personalizado_modelo" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Personalizado modelo</h4>
                </div>
                <div class="modal-body form">
                    <!--ID-->
                    <?= form_hidden('id') ?>

                    <!--Personalizado Categoria-->
                    <div class="form-group">
                        <?= form_label('Categoria: ', 'personalizado_categoria', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <select name="personalizado_categoria" id="personalizado_categoria" class="form-control" >
                                <option disabled selected>Selecione</option>
                                <?php foreach ($dados['personalizado_categoria'] as $key => $value) { 
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
                        <?= form_label('*Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--codigo-->
                    <div class="form-group">
                        <?= form_label('*Código: ', 'codigo', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input(array('name'=>'codigo','type'=>'text', 'id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Código'), '') ?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <!--formato-->
                    <div class="form-group">
                        <?= form_label('*Formato: ', 'formato', array('class' => 'control-label col-sm-2')) ?>
                        <div class="col-sm-10">
                            <?= form_input(array('name'=>'formato','type'=>'number', 'id'=>'formato', 'class'=>'form-control', 'placeholder'=>'Somente números'), '') ?>
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
                            <input step="0.01" value="" name="valor" type="number" class="form-control" placeholder="0,00" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-default btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>
<div class="modal fade" id="md_form_categoria">
    <?= form_open("#", 'class="form-horizontal" id="form_categoria" role="form"') ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Categoria de personalizados</h4>
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
                    <button type="submit" class="btn btn-default btnSubmit">Salvar</button>
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

    var tb_personalizado_modelo;
    var tb_categoria;
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
        tb_personalizado_modelo = $("#tb_personalizado_modelo").DataTable({
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
                url: "<?= base_url('personalizado_modelo/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id","visible": false},
                {data: "personalizado_categoria","visible": true},
                {data: "nome","visible": true},
                {data: "codigo","visible": true},
                {data: "formato","visible": true},
                {data: "descricao","visible": false},
                {data: "valor","visible": true}
            ]
        });
        if (!get_tab_active()) {
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_personalizado_modelo']").click(function () {

            tb_personalizado_modelo.ajax.reload(null, false);
        });
        $("a[href='#tab_categoria']").click(function () {
            if (!is_datatable_exists("#tb_categoria")) {
                tb_categoria = $("#tb_categoria").DataTable({
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
                        url: "<?= base_url('personalizado_categoria/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "nome","visible": true},
                        {data: "descricao","visible": true}
                    ]
                });
            } else {
                tb_categoria.ajax.reload(null, false);
            }
        });
        //seleciona a linha da tabela
        $("#tb_personalizado_modelo tbody").on("click", "tr", function () {
            row_select(tb_personalizado_modelo, this);
        });
        $("#tb_categoria tbody").on("click", "tr", function () {
            row_select(tb_categoria, this);
        });
        $("#adicionar").click(function (event) {
            if (!get_tab_active()) {
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
            if (!get_tab_active()) {
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
            //Ajax Load data from ajax
            $.ajax({
                url: url_edit + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    data = switch_data(tab_active, data);
                    $.map(data, function (value, index) {
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            $('[name="' + index + '"]').val(value);
                        } else if ($('[name="' + index + '"]').is("select")) {
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }
                    });
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
            if (!get_tab_active()) {
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
                        } else {
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
        $("#form_personalizado_modelo").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_categoria").submit(function (e) {

            formulario_submit(e);
        });
    });
    
    function formulario_submit(e) {
        disable_button_salvar();
        if (!get_tab_active()) {
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
                    $(md_form).modal('hide');
                    reload_table(dataTable);
                } else
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
            complete: function () {
                enable_button_salvar();
            }
        });
        reload_table(dataTable);
        e.preventDefault();
    }
    function get_tab_active() {
        tab_active = $(".nav-tabs li.active a")[0].hash;
        switch (tab_active) {
            case '#tab_personalizado_modelo':
                dataTable = tb_personalizado_modelo;
                md_form = '#md_form_personalizado_modelo';
                modal_title = ' Modelo Personalizado';
                url_edit = "<?= base_url('personalizado_modelo/ajax_edit/') ?>";
                url_add = "<?php echo site_url('personalizado_modelo/ajax_add') ?>";
                url_update = "<?php echo site_url('personalizado_modelo/ajax_update') ?>";
                url_delete = "<?= base_url('personalizado_modelo/ajax_delete/') ?>";
                form = '#form_personalizado_modelo';
                return true;
                break;
            case '#tab_categoria':
                dataTable = tb_categoria;
                md_form = '#md_form_categoria';
                modal_title = ' Categoria';
                url_edit = "<?= base_url('personalizado_categoria/ajax_edit/') ?>";
                url_add = "<?php echo site_url('personalizado_categoria/ajax_add') ?>";
                url_update = "<?php echo site_url('personalizado_categoria/ajax_update') ?>";
                url_delete = "<?= base_url('personalizado_categoria/ajax_delete/') ?>";
                form = '#form_categoria';
                return true;
                break;
            default:
                return false;
        }
    }
    function switch_data(tab_active, data) {
        switch (tab_active) {
            case '#tab_personalizado_modelo':
                return data.personalizado_modelo;
                break;
            case '#tab_categoria':
                return data.personalizado_categoria;
                break;
        }
    }
    function row_select(table, tr) {
        if ($(tr).hasClass("selected")) {
            $(tr).removeClass("selected");
            disable_buttons();
        } else {
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