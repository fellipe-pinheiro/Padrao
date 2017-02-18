<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-modelo_personalizado-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Modelo Personalizado</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-modelo_personalizado-menu">
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
                        <a href="#tab_personalizado_modelo" aria-controls="tab_personalizado_modelo" role="tab" data-toggle="tab">Modelo</a>
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
    <form action="" method="POST" role="form" class="form-horizontal" id="form_personalizado_modelo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Personalizado modelo</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--personalizado_categoria-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="personalizado_categoria" class="control-label">Categoria:</label>
                                <select name="personalizado_categoria" id="personalizado_categoria" class="form-control selectpicker" data-live-search="true" required="required" autofocus>
                                    <option disabled selected>Selecione</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--nome-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" required="required" title="Nome do modelo" placeholder="Nome do modelo">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--codigo-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="codigo" class="control-label">Código:</label>
                                <input type="text" name="codigo" id="codigo" class="form-control" value="" required="required" title="Utilize no mínimo 3 e máximo 20 caracteres sendo somente letras minúsculas [a-z], sem acentuação, números [0-9] e sem espaçamento." placeholder="Ex: mod123" pattern="[a-z0-9]{3,20}$">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--formato-->
                        <div class="col-sm-4">
                            <div class="form-group input-padding">
                                <label for="formato" class="control-label">Formato:</label>
                                <input type="number" name="formato" id="formato" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="999" placeholder="Aproveitamento do papel">
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
<div class="modal fade" id="md_form_categoria">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_categoria">
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
                        <!--Nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" class="form-control" value="" required="required" title="Nome do modelo" placeholder="Nome da categoria" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--Descrição-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="descricao" class="control-label">Descrição:</label>
                                <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
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
    var categoria_atualizar = true;

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
            order: [[2, 'asc']],//nome
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
            if(tab_active === "#tab_personalizado_modelo"){
                ajax_carregar_personalizado_categoria();
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
                            if(tab_active === "#tab_personalizado_modelo"){
                                ajax_carregar_personalizado_categoria(true,value.id);
                            }else{
                                $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                            }
                        }
                    });
                    $(md_form).modal('show');
                    $('.modal-title').text('Editar' + modal_title + " ID: " + id);
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
                                if(tab_active === "#tab_categoria"){
                                    categoria_atualizar = true;
                                }
                                reload_table(dataTable);
                                $.alert('<strong>ID: ' + id + ' ' + nome + '</strong> excluido com sucesso!');
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
                cancel: function(){
                    $.alert('Cancelado!')
                }
            });
        });
        $("form").submit(function (e) {

            formulario_submit(e);
        });
        form_small();
    });

    function ajax_carregar_personalizado_categoria(editar = false,id_categoria = null) {
        if(categoria_atualizar){
            $('#personalizado_categoria')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecione</option>')
            .val('');

            $.ajax({
                url: '<?= base_url("personalizado_categoria/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
            })
            .done(function(data) {
                categoria_atualizar = false;
                $.each(data, function(index, val) {
                    $('#personalizado_categoria').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_personalizado_categoria");
            })
            .always(function() {
                $('#personalizado_categoria').selectpicker('refresh');
                if(editar){
                    $('#personalizado_categoria').selectpicker('val', id_categoria);
                }
            });
        }else{
            if(editar){
                $('#personalizado_categoria').selectpicker('val', id_categoria);
            }else{
                $('#personalizado_categoria').selectpicker('val', '');
            }
        }
    }
    
    function formulario_submit(e) {
        disable_button_salvar();
        if (!get_tab_active()) {
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
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
                if (data.status){
                    $(md_form).modal('hide');
                    reload_table(dataTable);
                    if(tab_active === "#tab_categoria"){
                        categoria_atualizar = true;
                    }
                } else{
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
                modal_title = ' Modelo';
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