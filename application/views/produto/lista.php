<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-produto-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Produto</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-produto-menu">
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
                        <a href="#tab_produto" aria-controls="tab_produto" role="tab" data-toggle="tab">Produto</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_categoria" aria-controls="tab_categoria" role="tab" data-toggle="tab">Categoria</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab_produto">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_produto" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Categoria</th>
                                            <th>Nome</th>
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

<div class="modal fade" id="md_form_produto">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_produto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Produto</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <div class="row">
                            <!--nome-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="nome" class="control-label">Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome do produto" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--produto_categoria-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="produto_categoria" class="control-label">Categoria:</label>
                                    <select name="produto_categoria" id="produto_categoria" class="form-control selectpicker" data-live-search="true" required="required" autofocus>
                                        <option value="" disabled selected>Selecione</option>
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
                        </div>
                        <div class="row">
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
                    <h4 class="modal-title">Categoria de produtos</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome da categoria" pattern=".{1,50}" title="Máximo de 50 caracteres">
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
<div class="modal fade" id="md_filtro_produto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Filtro</h4>
            </div>
            <div class="modal-body">
                <form id="form-filter-produto" class="form-horizontal">
                    <div class="form-group">
                        <label for="filtro_categoria" class="col-sm-3 control-label">Categoria</label>
                        <div class="col-sm-9">
                            <select id="filtro_categoria" class="form-control selectpicker" data-live-search="true" autofocus="true">
                                <option value="">Selecione</option>
                                <?php foreach ($dados['categorias'] as $key => $value) {
                                    ?>
                                    <option value="<?= $value['nome'] ?>"><?= $value['nome'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-3 control-label">Produto</label>
                        <div class="col-sm-9">
                            <input type="search" id="filtro_produto" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-default" onclick="filtro('produto', 'reset')"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</button>
                <button type="button" id="btn-filter" class="btn btn-default" onclick="filtro('produto', 'filtrar')">
                    <span class="glyphicon glyphicon-filter"></span> Filtrar
                </button>
            </div>
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

    var tb_produto;
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
    var produto_atualizar = true;

    $(document).ready(function () {
        tb_produto = $("#tb_produto").DataTable({
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
                        }
                    ],
                    fade: true
                },
                {
                    text: '<i class="glyphicon glyphicon-filter"></i> Filtro',
                    action: function () {
                        $("#md_filtro_produto").modal('show');
                    }
                }
            ],
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            processing: true,
            serverSide: true,
            order: [[2, 'asc']],//produto
            ajax: {
                url: "<?= base_url('produto/ajax_list') ?>",
                type: "POST",
                data: function (data) {
                    data.filtro_categoria = $('#filtro_categoria').val();
                    data.filtro_produto = $('#filtro_produto').val();
                },
            },
            columns: [
                {data: "id", "visible": false},
                {data: "produto_categoria", "visible": true},
                {data: "nome", "visible": true},
                {data: "descricao", "visible": true, "orderable": false},
                {data: "valor", "visible": true, "orderable": false}
            ],
        });
        if (!get_tab_active()) {
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_produto']").click(function () {

            tb_produto.ajax.reload(null, false);
        });
        $("a[href='#tab_categoria']").click(function () {
            if (!is_datatable_exists("#tb_categoria")) {
                tb_categoria = $("#tb_categoria").DataTable({
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
                        url: "<?= base_url('produto_categoria/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id", "visible": false},
                        {data: "nome", "visible": true},
                        {data: "descricao", "visible": true}
                    ]
                });
            } else {
                tb_categoria.ajax.reload(null, false);
            }
        });
        //seleciona a linha da tabela
        $("#tb_produto tbody").on("click", "tr", function () {
            row_select(tb_produto, this);
        });
        $("#tb_categoria tbody").on("click", "tr", function () {
            row_select(tb_categoria, this);
        });
        $("#adicionar").click(function (event) {
            if (!get_tab_active()) {
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            if(tab_active === "#tab_produto"){
                ajax_carregar_categoria();
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
                            if(tab_active === "#tab_produto"){
                                ajax_carregar_categoria(true,value.id);
                            }else{
                                $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                            }
                        }
                    });
                    $(md_form).modal('show');
                    $('.modal-title').text('Editar' + modal_title + ' ID: ' + id);
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
                                if(tab_active === '#tab_categoria'){
                                    produto_atualizar = true;
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
                cancel: function(){
                    $.alert('Cancelado!')
                }
            });
        });
        $("form").submit(function (e) {

            formulario_submit(e);
        });
    });

    function ajax_carregar_categoria(editar = false,id_categoria = null) {
        if(produto_atualizar){
            $('#produto_categoria')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecione</option>')
            .val('');

            $.ajax({
                url: '<?= base_url("produto_categoria/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
            })
            .done(function(data) {
                produto_atualizar = false;
                $.each(data, function(index, val) {
                    $('#produto_categoria').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_categoria");
            })
            .always(function() {
                $('#produto_categoria').selectpicker('refresh');
                if(editar){
                    $('#produto_categoria').selectpicker('val', id_categoria);
                }
            });
        }else{
            if(editar){
                $('#produto_categoria').selectpicker('val', id_categoria);
            }else{
                $('#produto_categoria').selectpicker('val', '');
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
                if (data.status){
                    if(tab_active == '#tab_produto' && save_method == 'add'){
                        $.confirm({
                            title: 'Produto inserido com sucesso!',
                            content: 'Deseja inserir mais um produto da mesma categoria?',
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
                        if(tab_active == '#tab_categoria'){
                            produto_atualizar = true;
                        }
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
                reload_table(dataTable);
            }
        });
        e.preventDefault();
    }

    function get_tab_active() {
        form_small();
        tab_active = $(".nav-tabs li.active a")[0].hash;
        switch (tab_active) {
            case '#tab_produto':
                dataTable = tb_produto;
                md_form = '#md_form_produto';
                modal_title = ' produto';
                url_edit = "<?= base_url('produto/ajax_edit/') ?>";
                url_add = "<?php echo site_url('produto/ajax_add') ?>";
                url_update = "<?php echo site_url('produto/ajax_update') ?>";
                url_delete = "<?= base_url('produto/ajax_delete/') ?>";
                form = '#form_produto';
                return true;
                break;
            case '#tab_categoria':
                dataTable = tb_categoria;
                md_form = '#md_form_categoria';
                modal_title = ' Categoria';
                url_edit = "<?= base_url('produto_categoria/ajax_edit/') ?>";
                url_add = "<?php echo site_url('produto_categoria/ajax_add') ?>";
                url_update = "<?php echo site_url('produto_categoria/ajax_update') ?>";
                url_delete = "<?= base_url('produto_categoria/ajax_delete/') ?>";
                form = '#form_categoria';
                return true;
                break;
            default:
                return false;
        }
    }

    function switch_data(tab_active, data) {
        switch (tab_active) {
            case '#tab_produto':
                return data.produto;
                break;
            case '#tab_categoria':
                return data.produto_categoria;
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
        reset_errors()
    }

    function filtro(tabela, acao) {
        if (!get_tab_active()) {
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        if (acao === 'filtrar') {
            dataTable.ajax.reload(null, false);
            $("#md_filtro_produto").modal('hide');
        } else if (acao === 'reset') {
            $('#form-filter-produto')[0].reset();
            $('#form-filter-produto ul>li.selected.active').removeClass('selected active');
            //$($('#form-filter-produto ul li')[0]).addClass('selected active');
            $(".filter-option").each(function (index, el) {
                $(".filter-option").text("Selecione");
            });
            dataTable.ajax.reload(null, false);
        }
    }

</script>