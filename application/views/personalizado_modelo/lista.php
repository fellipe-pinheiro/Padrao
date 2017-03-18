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
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Ativo</th>
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
                            <div class="navbar-brand"></div>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-papel-menu">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="javascript:void(0)" id="add_dimensoes"><i class="glyphicon glyphicon-plus"></i> Dimensões</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
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
                            <!--personalizado_categoria-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="personalizado_categoria" class="control-label">Categoria:</label>
                                    <select name="personalizado_categoria" id="personalizado_categoria" class="form-control selectpicker" data-live-search="true" required="required" autofocus>
                                        <option disabled selected>Selecione</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--nome-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="nome" class="control-label">Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome do modelo" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--codigo-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="codigo" class="control-label">Código:</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control" value="" required="required" title="Utilize no mínimo 3 e máximo 20 caracteres sendo somente letras minúsculas [a-z], sem acentuação, números [0-9] e sem espaçamento." placeholder="Ex: mod123" pattern="[a-z0-9]{3,20}$">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--valor-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor" class="control-label">Valor:</label>
                                    <input type="number" name="valor" step="0.01" min="0" class="form-control" value="" required="required" title="Valor" placeholder="Valor">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <!--Personalizado Modelo Dimensão-->
                        <div class="hidden" id="default_dimensao_div">
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" id="default_button_excluir" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                        </div>
                                        <input type="text" name="" id="default_nome_input" class="form-control" placeholder="Nome">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <span class="input-group-addon">A</span>
                                        <input step="1" type="number" min="0" name="" id="default_altura_input" class="form-control" placeholder="Altura ex: 320" title="Altura">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <span class="input-group-addon">L</span>
                                        <input step="1" type="number" min="0" name="" id="default_largura_input" class="form-control" placeholder="Largura ex: 320" title="Largura">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div id="lista_dimensoes" class="row">
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
                        <!--ativo-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="ativo" class="control-label">Ativo:</label>
                                <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--Nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" class="form-control" value="" required="required" placeholder="Nome da categoria" autofocus pattern=".{1,50}" title="Máximo de 50 caracteres">
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
    var count_dimensoes = 0;
    var total_dimensao = 0;

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
                {data: "descricao","visible": false},
                {data: "valor","visible": true},
                {data: "ativo","visible": false},
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
                        {data: "descricao","visible": true},
                        {data: "ativo","visible": true}
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
            reset_form();
            $(".ativo-crud").prop('checked', true);
            if (!get_tab_active()) {
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            if(tab_active === "#tab_personalizado_modelo"){
                ajax_carregar_personalizado_categoria();
            }
            $("#add_dimensoes").click();
            save_method = 'add';
            $("input[name='id']").val("");
            $('.modal-title').text('Adicionar' + modal_title);
            total_dimensao = $(".dimensao_group").length;
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
                            if($('[name="' + index + '"]').is(':checkbox')){
                                if(value === "0"){checked = false;}else{ checked = true;}
                                $('[name="' + index + '"]').prop('checked', checked);
                            }else{
                                $('[name="' + index + '"]').val(value);
                            }
                        } else if ($('[name="' + index + '"]').is("select")) {
                            if(tab_active === "#tab_personalizado_modelo"){
                                ajax_carregar_personalizado_categoria(true,value.id);
                            }else{
                                $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                            }
                        }else if(index == 'dimensoes'){
                            $.each(value,function(i, dimensoes) {
                                clonar_dimensoes(true,dimensoes.id+"_UPD",dimensoes.nome,dimensoes.altura,dimensoes.largura); 
                            });
                        }
                    });
                    $(md_form).modal('show');
                    $('.modal-title').text('Editar' + modal_title + " ID: " + id);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                },
                complete: function ()
                {
                    total_dimensao = $(".dimensao_group").length;
                },
            });
        });
        $("#deletar").click(function () {
            if (!get_tab_active()) {
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            var id = dataTable.row(".selected").id();
            var nome = dataTable.row(".selected").data().nome;
            console.log(nome);
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
        $("#add_dimensoes").click(function(){
            count_dimensoes++;
            total_dimensao++;
            clonar_dimensoes(false,count_dimensoes+"_ADD","","","");
        });
        form_small();
    });
    
    function clonar_dimensoes(editar,id,nome,altura,largura){//ID = 1_ADD
        var clone = $("#default_dimensao_div").clone().prop("id","dimensao_"+id).removeClass('hidden').addClass('dimensao_group');
        var cl = clone[0];

        // adicionar função para deletar a linha
        $(cl).find("#default_button_excluir").prop("id","excluir_dimensao_"+id).attr("onclick","remover_dimensao('dimensao_"+id+"',"+editar+",'"+nome+"');");

        // Alterar id, name, for(label) e adicionar required
        $($(cl).find("#default_nome_input")).prop("id","nome_"+id).prop("name","dimensao_nome_"+id).val(nome).prop("required","required");

        $($(cl).find("#default_altura_input")).prop("id","altura_"+id).prop("name","dimensao_altura_"+id).val(altura).prop("required","required");

        $($(cl).find("#default_largura_input")).prop("id","largura_"+id).prop("name","dimensao_largura_"+id).val(largura).prop("required","required");

        clone.appendTo("#lista_dimensoes");
    }

    function remover_dimensao(id,editar,nome) {
        var preenchido = false;
        $.each($("#"+id+" input"), function(index, element) {
            if(element.value){
                preenchido = true;
            }
        });
        if(nome == ""){
            nome = $("#"+id+" input").val();
        }

        if(!preenchido){
            do_remove_dimensao(id,editar);
        }else{
            $.confirm({
                title: 'Atenção!',
                content: 'Deseja realmente excluir o item <strong>' + nome + '</strong>?',
                confirm: function(){
                    do_remove_dimensao(id,editar);
                },
                cancel: function(){
                }
            });
        }
    }

    function do_remove_dimensao(id,editar) {
        if(total_dimensao === 1){
            $.alert({
                title: 'Alerta!',
                content: 'O personalizado precisa ter pelo menos uma dimensão.',
            });
            return false;
        }else{
            total_dimensao--;
        }
        if (!editar) {
            $("#"+id).remove();
        } else {
            var arr_nome = new Array();
            var arr_valor = new Array();
            var arr_ativo = new Array();
            // editar o name dos campos
            var name_nome = $("#"+id+" input")[0].name;
            arr_nome = name_nome.split("_");
            $("#"+id+" input")[0].name = arr_nome[0] + "_" + arr_nome[1] + "_" + arr_nome[2]+ "_DEL";
           
            var name_altura = $("#"+id+" input")[1].name;
            arr_altura = name_altura.split("_");
            $("#"+id+" input")[1].name = arr_altura[0] + "_" + arr_altura[1] + "_" + arr_altura[2]+ "_DEL";

            var  name_largura = $("#"+id+" input")[2].name;
            arr_largura = name_largura.split("_");
            $("#"+id+" input")[2].name = arr_largura[0] + "_" + arr_largura[1] + "_" + arr_largura[2]+ "_DEL";

            $("#"+id).hide();
        }
    }

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
                data: {ativo: -1}
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
        $('#form_personalizado_modelo :input').val(''); //para limpar os inputs hidden (só com o reset não está limpando o valor)
        $(':checkbox').val('1'); // como limpei com ($(':input').val('');), recoloco o valor do input checkbox para 1
        reset_errors();
        $("#lista_dimensoes").html("");
    }

</script>