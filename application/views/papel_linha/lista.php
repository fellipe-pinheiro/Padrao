<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $dados['titulo_painel'] ?></h3>
    </div>
    <div class="panel-body">
        <button class="btn btn-default" id="adicionar"><i class="glyphicon glyphicon-plus"></i></button>
        <button class="btn btn-default" id="editar"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-default" data-toggle="modal" href='#md_filtro'><span class="glyphicon glyphicon-search"></span></button>
        <button type="button" class="btn btn-default btn-reset">Limpar Filtro</button>
        <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
        <hr>  
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table id="tabela_papel_linha" class="table display compact table-bordered " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Catálogo</th>
                            <th>Linha</th>
                            <th>Val_80g</th>
                            <th>Val_120g</th>
                            <th>Val_180g</th>
                            <th>Val_250g</th>
                            <th>Val_300g</th>
                            <th>Val_350g</th>
                            <th>Val_400g</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody id="fbody">
                    </tbody>
                </table>
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
                        <label for="nome" class="col-sm-3 control-label">Catálogo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="filtro_catalogo" placeholder="Catálogo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-3 control-label">Linha</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="filtro_linha" placeholder="Linha">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-default btn-reset">Limpar Filtro</button>
                <button type="button" id="btn-filter" class="btn btn-default"><span class="glyphicon glyphicon-filter"></span></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Papel linha</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_papel_linha" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('Linha: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('nome', '', 'id="nome" autofocus class="form-control" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Papel Catálogo-->
                <div class="form-group">
                    <?= form_label('Papel Catálogo: ', 'papel_catalogo', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <select name="papel_catalogo" id="papel_catalogo" class="form-control" >
                            <option disabled selected>Selecione</option>
                            <?php foreach ($dados['papel_catalogo'] as $key => $value) { 
                                ?>
                                <option value="<?= $value->id ?>"><?= $value->nome ?></option>
                                <?php 
                            } 
                            ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 80g-->
                <div class="form-group">
                    <?= form_label('Valor 80g: ', 'valor_80g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_80g" type="number" class="form-control" placeholder="Valor de 80g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 120g-->
                <div class="form-group">
                    <?= form_label('Valor 120g: ', 'valor_120g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_120g" type="number" class="form-control" placeholder="Valor de 120g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 180g-->
                <div class="form-group">
                    <?= form_label('Valor 180g: ', 'valor_180g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_180g" type="number" class="form-control" placeholder="Valor de 180g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 250g-->
                <div class="form-group">
                    <?= form_label('Valor 250g: ', 'valor_250g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_250g" type="number" class="form-control" placeholder="Valor de 250g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 300g-->
                <div class="form-group">
                    <?= form_label('Valor 300g: ', 'valor_300g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_300g" type="number" class="form-control" placeholder="Valor de 300g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 350g-->
                <div class="form-group">
                    <?= form_label('Valor 350g: ', 'valor_350g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_350g" type="number" class="form-control" placeholder="Valor de 350g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 400g-->
                <div class="form-group">
                    <?= form_label('Valor 400g: ', 'valor_400g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_400g" type="number" class="form-control" placeholder="Valor de 400g" />
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <input type="submit" id="btnSubmit" class="btn btn-success" value="Salvar">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        tabela = $("#tabela_papel_linha").DataTable({
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
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?= base_url('papel_linha/ajax_list') ?>",
                type: "POST",
                data: function ( data ) {
                    data.filtro_catalogo = $('#filtro_catalogo').val();
                    data.filtro_linha = $('#filtro_linha').val();
                },
            },
            columns: [
            {data: "id","visible": true},
            {data: "papel_catalogo","visible": true},
            {data: "nome","visible": true},
            {data: "valor_80g","visible": true},
            {data: "valor_120g","visible": true},
            {data: "valor_180g","visible": true},
            {data: "valor_250g","visible": true},
            {data: "valor_300g","visible": true},
            {data: "valor_350g","visible": true},
            {data: "valor_400g","visible": true},
            {data: "descricao","visible": true},
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_papel_linha tbody").on("click", "tr", function () {
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
        $('#btn-filter').click(function(){
            tabela.ajax.reload(null,false);
            $("#md_filtro").modal('hide');
        });

        $('.btn-reset').click(function(){
            $('#form-filter')[0].reset();
            tabela.ajax.reload(null,false);
        });
        $("#adicionar").click(function(event) {
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");
            $('.modal-title').text('Adicionar papel_linha');
            $('#modal_form').modal('show');
        });
        $("#editar").click(function () {
            var id = tabela.row(".selected").id();
            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            $.ajax({
                url: "<?= base_url('papel_linha/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                { 
                    $.map(data.papel_linha, function (value, index) {
                        if($('[name="' + index + '"]').is("input, textarea")){
                            $('[name="' + index + '"]').val(value);
                        }else if($('[name="' + index + '"]').is("select")){
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                        }
                    });
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar papel_linha');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                }
            });
        });
        $("#deletar").click(function () {

            var id = tabela.row(".selected").id();
            var nome = tabela.row(".selected").data().nome;
            if (confirm("O registro: " + nome + " será excluido. Clique em OK para continuar ou Cancele a operação.")) {
                $.ajax({
                    url: "<?= base_url('papel_linha/ajax_delete/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {
                        if (data.status) {
                            reload_table();
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
        $("#form_papel_linha").submit(function (e) {
            reset_errors();
            $('#btnSubmit').text('Salvando...');
            $('#btnSubmit').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('papel_linha/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('papel_linha/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_papel_linha').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
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
                }
            });
            $('#btnSubmit').text('Salvar');
            $('#btnSubmit').attr('disabled', false);
            reload_table();
            e.preventDefault();
        });
    });

function reload_table() {
        tabela.ajax.reload(null, false); //reload datatable ajax
    }
    function reset_form() {
        $('#form_papel_linha')[0].reset(); // Zerar formulario
        $('.form-group').removeClass('has-error'); // Limpar os erros
        $('.help-block').empty(); // Limpar as msg de erro
    }
    function reset_errors() {
        $('.form-group').removeClass('has-error'); // Limpar os erros
        $('.help-block').empty(); // Limpar as msg de erro
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