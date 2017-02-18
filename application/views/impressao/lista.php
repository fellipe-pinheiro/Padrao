<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-impressao-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Impressão</div>
                </div>
                
                <div class="collapse navbar-collapse navbar-impressao-menu">
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
</div>

<div class="modal fade" id="md_form_impressao">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_impressao">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Impressão</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">

                        <!--nome-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" required="required" title="Nome da impressão" placeholder="Nome da impressão">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--impressao_area-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="impressao_area" class="control-label">Área:</label>
                                <select name="impressao_area" id="impressao_area" class="form-control" required="required">
                                    <option disabled selected>Selecione</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--valor-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="valor" class="control-label">Valor:</label>
                                <input type="number" name="valor" step="0.01" min="0" class="form-control" value="" required="required" title="Valor" placeholder="Valor">
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
                    </div>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-default btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="md_form_area">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_area">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">

                        <!--nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" title="Nome do modelo" placeholder="Nome do modelo" required="required" autofocus>
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
    var impressao_atualizar = true;

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
            order: [[1, 'asc']],//nome
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
            if (!get_tab_active()) {
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
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
                    order: [[1, 'asc']],//nome
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
            if (!get_tab_active()) {
                console.log('Não foi possível carregar get_tab_active()');
                return false;
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
            if(tab_active === "#tab_impressao"){
                ajax_carregar_impressao_area();
            }
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");
            $(form + ' .modal-title').text('Adicionar' + modal_title);
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
                            if(tab_active === "#tab_impressao"){
                                ajax_carregar_impressao_area(true,value.id);
                            }else{
                                $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                            }
                        }
                    });
                    $(md_form).modal('show');
                    $(form + ' .modal-title').text('Editar' + modal_title + ' ID: '+id);
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
            $.confirm({
                title: 'Confirmação!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function () {
                    $.ajax({
                        url: url_delete + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                if(tab_active === '#tab_area'){
                                    impressao_atualizar = true;
                                }
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
                },
                cancel: function () {
                    $.alert('Cancelado!')
                }
            });
        });
        $("form").submit(function (e) {
            formulario_submit(e);
        });
        $(".check_filter_dirty").change(function (event) {
            check_filter_dirty();
        });
        form_small();
    });

    function ajax_carregar_impressao_area(editar = false,id_impressao_area = null) {
        if(impressao_atualizar){
            $('#impressao_area')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecione</option>')
            .val('');

            $.ajax({
                url: '<?= base_url("impressao_area/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
            })
            .done(function(data) {
                impressao_atualizar = false;
                $.each(data, function(index, val) {
                    $('#impressao_area').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_impressao_area");
            })
            .always(function() {
                if(editar){
                    $("#impressao_area option[value='"+id_impressao_area+"']").prop('selected','selected');
                }else{
                    $("#impressao_area option[value='']").prop('selected','selected');
                }
            });
        }else{
            if(editar){
                $("#impressao_area option[value='"+id_impressao_area+"']").prop('selected','selected');
            }else{
                $("#impressao_area option[value='']").prop('selected','selected');
            }
        }
    }

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
                    if(tab_active != '#tab_impressao'){
                        impressao_atualizar = true;
                    }
                } else
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
            complete: function () {
                enable_button_salvar();
                reload_table(dataTable);
            }
        });
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
        } else {
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