<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-heading">
    <h3 class="panel-title">Modelos de convites</h3>
    </div>
    <div class="panel-body">
        <button class="btn btn-default" id="adicionar"><i class="glyphicon glyphicon-plus"></i></button>
        <button class="btn btn-default" id="editar"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
        <hr>  
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table id="tabela_convite_modelo" class="table display compact table-bordered " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Altura Final</th>
                            <th>Largura Final</th>
                            <th>Cartao Altura</th>
                            <th>Cartao Largura</th>
                            <th>Envelope Altura</th>
                            <th>Envelope Largura</th>
                            <th>Empastamento Borda</th>
                            <th>Descricao</th>
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
                <h4 class="modal-title"></h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_convite_modelo" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('*Nome: ', 'nome', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--codigo-->
                <div class="form-group">
                    <?= form_label('*Código: ', 'codigo', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'codigo','type'=>'text', 'id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Código'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--altura_final-->
                <div class="form-group">
                    <?= form_label('*Altura Final (mm): ', 'altura_final', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'altura_final','type'=>'number', 'id'=>'altura_final', 'class'=>'form-control', 'placeholder'=>'Altura Final  do convite pronto'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--largura_final-->
                <div class="form-group">
                    <?= form_label('*Largura Final (mm): ', 'largura_final', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'largura_final','type'=>'number', 'id'=>'largura_final', 'class'=>'form-control', 'placeholder'=>'Largura Final do convite pronto'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--cartao_altura-->
                <div class="form-group">
                    <?= form_label('*Cartão Altura (mm): ', 'cartao_altura', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'cartao_altura','type'=>'number', 'id'=>'cartao_altura', 'class'=>'form-control', 'placeholder'=>'Cartão Altura'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--cartao_largura-->
                <div class="form-group">
                    <?= form_label('*Cartão Largura (mm): ', 'cartao_largura', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'cartao_largura','type'=>'number', 'id'=>'cartao_largura', 'class'=>'form-control', 'placeholder'=>'Cartão Largura'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--envelope_altura-->
                <div class="form-group">
                    <?= form_label('*Envelope Altura (mm): ', 'envelope_altura', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'envelope_altura','type'=>'number', 'id'=>'envelope_altura', 'class'=>'form-control', 'placeholder'=>'Envelope Altura'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--envelope_largura-->
                <div class="form-group">
                    <?= form_label('*Envelope Largura (mm): ', 'envelope_largura', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'envelope_largura','type'=>'number', 'id'=>'envelope_largura', 'class'=>'form-control', 'placeholder'=>'Envelope Largura'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--empastamento_borda-->
                <div class="form-group">
                    <?= form_label('*Empastamento borda (mm): ', 'empastamento_borda', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_input(array('name'=>'empastamento_borda','type'=>'number', 'id'=>'empastamento_borda', 'class'=>'form-control', 'placeholder'=>'Empastamento borda (mm)'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Descrição-->
                <div class="form-group">
                    <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-4')) ?>
                    <div class="col-sm-8">
                        <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descricao"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <input type="submit" id="btnSubmit" class="btn btn-default" value="Salvar">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        tabela = $("#tabela_convite_modelo").DataTable({
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
                    orientation: 'landscape',
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
                    orientation: 'landscape',
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
                url: "<?= base_url('convite_modelo/ajax_list') ?>",
                type: "POST"
            },
            columns: [
            {data: "id","visible": true},
            {data: "codigo","visible": true},
            {data: "nome","visible": true},
            {data: "altura_final","visible": true},
            {data: "largura_final","visible": true},
            {data: "cartao_altura","visible": true},
            {data: "cartao_largura","visible": true},
            {data: "envelope_altura","visible": true},
            {data: "envelope_largura","visible": true},
            {data: "empastamento_borda","visible": true},
            {data: "descricao","visible": true}
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_convite_modelo tbody").on("click", "tr", function () {
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

            $('.modal-title').text('Adicionar Convite Modelo'); // Definir um titulo para o modal
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
                url: "<?= base_url('convite_modelo/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.convite_modelo, function (value, index) {
                        $('[name="' + index + '"]').val(value);

                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar Convite Modelo');
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
                    url: "<?= base_url('convite_modelo/ajax_delete/') ?>" + id,
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
        $("#form_convite_modelo").submit(function (e) {
            reset_errors();
            $('#btnSubmit').text('Salvando...');
            $('#btnSubmit').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('convite_modelo/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('convite_modelo/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_convite_modelo').serialize(),
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
    tabela.ajax.reload(null, false);
}
function reset_form() {
    $('#form_convite_modelo')[0].reset();
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