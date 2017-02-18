<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-assessor-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Assessor</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-assessor-menu">
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
                    <ul class="nav navbar-nav">
                        <li>
                            <a data-toggle="modal" href='#md_filtro_assessor'><i class="glyphicon glyphicon-filter"></i> Filtrar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="btn-reset">
                            <a href="javascript:void(0)"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</a>
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
        <div class="row">
            <div class="col-md-12">
            <div class="col-sm-12 table-responsive">
                <table id="tabela_assessor" class="table display compact table-bordered " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Empresa</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Comissão(%)</th>
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
<?php $this->load->view('assessor/assessor_modal'); ?>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        tabela_assessor = $("#tabela_assessor").DataTable({
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
                url: "<?= base_url('assessor/ajax_list') ?>",
                type: "POST",
                data: function (data) {
                    data.filtro_id = $('#filtro_assessor_id').val();
                    data.filtro_nome = $('#filtro_assessor_nome').val();
                    data.filtro_sobrenome = $('#filtro_assessor_sobrenome').val();
                    data.filtro_telefone = $('#filtro_assessor_telefone').val();
                    data.filtro_email = $('#filtro_assessor_email').val();
                },
            },
            columns: [
                {data: "id", "visible": false},
                {data: "nome", "visible": true},
                {data: "sobrenome", "visible": true},
                {data: "empresa", "visible": true},
                {data: "telefone", "visible": true},
                {data: "email", "visible": true},
                {data: "comissao", "visible": true},
                {data: "descricao", "visible": false},
            ]
        });
        //button filter event click
        $('#btn-filter-assessor').click(function () {
            //just reload table
            tabela_assessor.ajax.reload(null, false);
            $("#md_filtro_assessor").modal('hide');
        });
        //button reset event click
        $('.btn-reset').click(function () {
            $('#form-filter-assessor')[0].reset();
            //just reload table
            tabela_assessor.ajax.reload(null, false);
        });
        // Resaltar a linha selecionada
        $("#tabela_assessor tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
            } else {
                tabela_assessor.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
            }
        });
        $("#adicionar").click(function (event) {
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar assessor'); // Definir um titulo para o modal
            $('#md_form_assessor').modal('show'); // Abrir modal
        });
        $("#editar").click(function () {
            // Buscar ID da linha selecionada
            var id = tabela_assessor.row(".selected").id();
            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            //Ajax Load data from ajax
            $.ajax({
                url: "<?= base_url('assessor/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.assessor, function (value, index) {
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            $('[name="' + index + '"]').val(value);
                        }else{
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }
                    });

                    $('#md_form_assessor').modal('show');
                    $('.modal-title').text('Editar assessor ID: '+id);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                }
            });
        });
        $("#deletar").click(function () {

            var id = tabela_assessor.row(".selected").id();
            var nome = tabela_assessor.row(".selected").data().nome;
            $.confirm({
                title: 'Confirmação!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function () {
                    $.ajax({
                        url: "<?= base_url('assessor/ajax_delete/') ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                reload_table();
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
                    $.alert('Operação cancelada!')
                }
            });
        });
        $("#form_assessor").submit(function (e) {
            disable_button_salvar();
            reset_errors();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('assessor/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('assessor/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_assessor').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status){
                        $('#md_form_assessor').modal('hide');
                        reload_table();
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
                    reload_table();
                }
            });
            e.preventDefault();
        });
        form_small();
    });

    function reload_table() {

        tabela_assessor.ajax.reload(null, false); //reload datatable ajax
    }

    function reset_form() {
        $('#form_assessor')[0].reset(); // Zerar formulario
        reset_errors();
    }
</script>