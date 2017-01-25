<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Impressão</h3>
    </div>
    <div class="panel-body">
        <button class="btn btn-default" id="adicionar"><i class="glyphicon glyphicon-plus"></i></button>
        <button class="btn btn-default" id="editar"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
        <hr>
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_impressao" aria-controls="tab_impressao" role="tab" data-toggle="tab">Impressão</a>
                </li>
                <li role="presentation">
                    <a href="#tab_area" aria-controls="tab_area" role="tab" data-toggle="tab">Área de Impressão</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab_impressao">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tb_impressao" class="table display compact table-bordered " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Impressão Área</th>
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
                <div role="tabpanel" class="tab-pane" id="tab_area">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tb_area" class="table display compact table-bordered " cellspacing="0" width="100%">
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

<div class="modal fade" id="md_form_impressao">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Impressão</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_impressao" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('nome', '', 'autofocus id="nome" class="form-control" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Impressao Area-->
                <div class="form-group">
                    <?= form_label('Impressao Area: ', 'impressao_area', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <select name="impressao_area" id="impressao_area" class="form-control" >
                            <option disabled selected>Selecione</option>
                            <?php foreach ($dados['impressao_area'] as $key => $value) {
                                ?>
                                <option value="<?= $value->id ?>"><?= $value->nome ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Descrição-->
                <div class="form-group">
                    <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descricao"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Valor-->
                <div class="form-group">
                    <?= form_label('Valor: ', 'valor', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" min="0" value="" name="valor" type="number" class="form-control" placeholder="Valor" />
                        <span class="help-block"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-default btnSubmit">Salvar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_area">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Fita material</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_area" role="form"') ?>
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
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<style>
    .tab-pane{
        margin-top: 30px;
    }
</style>
<script type="text/javascript">

    var tb_impressao;
    var tb_area;
    var tab_active;
    var dataTable;
    var md_form;
    var modal_title;
    var url_edit;
    var save_method;
    var url_add;
    var url_update;
    var form;

    $(document).ready(function () {
        tb_impressao = $("#tb_impressao").DataTable({
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Visualizar colunas'
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
                url: "<?= base_url('impressao/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id", "visible": false},
                {data: "nome", "visible": true},
                {data: "impressao_area", "visible": true},
                {data: "descricao", "visible": false},
                {data: "valor", "visible": true},
            ],
        });
        if (!get_tab_active()) {
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_impressao']").click(function () {

            tb_impressao.ajax.reload(null, false);
        });
        $("a[href='#tab_area']").click(function () {
            if (!is_datatable_exists("#tb_area")) {
                tb_area = $("#tb_area").DataTable({
                    scrollX: true,
                    scrollY: "500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
                    buttons: [
                        {
                            extend: 'colvis',
                            text: 'Visualizar colunas'
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
                        url: "<?= base_url('impressao_area/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id", "visible": false},
                        {data: "nome", "visible": true},
                        {data: "descricao", "visible": true, "orderable": false}
                    ]
                });
            } else {
                tb_area.ajax.reload(null, false);
            }
        });
        //seleciona a linha da tabela
        $("#tb_impressao tbody").on("click", "tr", function () {
            row_select(tb_impressao, this);
        });
        $("#tb_area tbody").on("click", "tr", function () {
            row_select(tb_area, this);
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
        $("#form_impressao").submit(function (e) {
            formulario_submit(e);
        });
        $("#form_area").submit(function (e) {
            formulario_submit(e);
        });
        $(".check_filter_dirty").change(function (event) {
            check_filter_dirty();
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
        enable_button_salvar();
        reload_table(dataTable);
        e.preventDefault();
    }
    function get_tab_active() {
        tab_active = $(".nav-tabs li.active a")[0].hash;
        switch (tab_active) {
            case '#tab_impressao':
                dataTable = tb_impressao;
                md_form = '#md_form_impressao';
                modal_title = ' Impressão';
                url_edit = "<?= base_url('impressao/ajax_edit/') ?>";
                url_add = "<?php echo site_url('impressao/ajax_add') ?>";
                url_update = "<?php echo site_url('impressao/ajax_update') ?>";
                url_delete = "<?= base_url('impressao/ajax_delete/') ?>";
                form = '#form_impressao';
                return true;
                break;
            case '#tab_area':
                dataTable = tb_area;
                md_form = '#md_form_area';
                modal_title = ' Área de Impressão';
                url_edit = "<?= base_url('impressao_area/ajax_edit/') ?>";
                url_add = "<?php echo site_url('impressao_area/ajax_add') ?>";
                url_update = "<?php echo site_url('impressao_area/ajax_update') ?>";
                url_delete = "<?= base_url('impressao_area/ajax_delete/') ?>";
                form = '#form_area';
                return true;
                break;
            default:
                return false;
        }
    }
    function switch_data(tab_active, data) {
        switch (tab_active) {
            case '#tab_impressao':
                return data.impressao;
                break;
            case '#tab_area':
                return data.impressao_area;
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