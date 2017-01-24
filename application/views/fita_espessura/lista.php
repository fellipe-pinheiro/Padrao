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
        <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
        <hr>  
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table id="tabela_fita_espessura" class="table display compact table-bordered " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="hidden">ID</th>
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
                <h4 class="modal-title">Fita Espessura</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_fita_espessura" role="form"') ?>
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
                <input type="submit" id="btnSubmit" class="btn btn-success" value="Salvar">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        tabela = $("#tabela_fita_espessura").DataTable({
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
            {data: "esp_03mm","visible": true},
            {data: "esp_07mm","visible": true},
            {data: "esp_10mm","visible": true},
            {data: "esp_15mm","visible": true},
            {data: "esp_22mm","visible": true},
            {data: "esp_38mm","visible": true},
            {data: "esp_50mm","visible": true},
            {data: "esp_70mm","visible": true},
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_fita_espessura tbody").on("click", "tr", function () {
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
            if ( tabela.data().count() == 0 ) {
                reset_form();

                save_method = 'add';
                $("input[name='id']").val("");

                $('.modal-title').text('Adicionar fita_espessura');
                $('#modal_form').modal('show');
            }else{
                alert("Nesta tabela é aceita somente 1 linha.");
            }
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
                url: "<?= base_url('fita_espessura/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.fita_espessura, function (value, index) {
                        $('[name="' + index + '"]').val(value);

                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar fita_espessura');
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
                    url: "<?= base_url('fita_espessura/ajax_delete/') ?>" + id,
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
        $("#form_fita_espessura").submit(function (e) {
            reset_errors();
            $('#btnSubmit').text('Salvando...');
            $('#btnSubmit').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('fita_espessura/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('fita_espessura/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_fita_espessura').serialize(),
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
        $('#form_fita_espessura')[0].reset(); // Zerar formulario
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