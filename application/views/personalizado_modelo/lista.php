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
        <a class="btn btn-default" href="<?= base_url('personalizado_categoria') ?>">Categoria</a>
        <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
        <hr>  
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table id="tabela_personalizado_modelo" class="table display compact table-bordered " cellspacing="0" width="100%">
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
                    <tbody id="fbody">
                    </tbody>
                </table>
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
                <h4 class="modal-title">Personalizado modelo</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_personalizado_modelo" role="form"') ?>
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
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        tabela = $("#tabela_personalizado_modelo").DataTable({
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
        // Resaltar a linha selecionada
        $("#tabela_personalizado_modelo tbody").on("click", "tr", function () {
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
        $("#adicionar").click(function(event) {
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar modelo personalizado'); // Definir um titulo para o modal
            $('#modal_form').modal('show'); // Abrir modal
        });
        $("#editar").click(function () {
            // Buscar ID da linha selecionada
            var id = tabela.row(".selected").id();
            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            //Ajax Load data from ajax
            $.ajax({
                url: "<?= base_url('personalizado_modelo/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.personalizado_modelo, function (value, index) {
                        if($('[name="' + index + '"]').is("input, textarea")){
                            $('[name="' + index + '"]').val(value);
                        }else if($('[name="' + index + '"]').is("select")){
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                        }
                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar modelo personalizado');
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
                    url: "<?= base_url('personalizado_modelo/ajax_delete/') ?>" + id,
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
        $("#form_personalizado_modelo").submit(function (e) {
            disable_button_salvar();
            reset_errors();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('personalizado_modelo/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('personalizado_modelo/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_personalizado_modelo').serialize(),
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
                },
                complete: function () {
                    enable_button_salvar();
                }
            });
            reload_table();
            e.preventDefault();
        });
    });

function reload_table() {
        tabela.ajax.reload(null, false); //reload datatable ajax
    }
    function reset_form() {
        $('#form_personalizado_modelo')[0].reset(); // Zerar formulario
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