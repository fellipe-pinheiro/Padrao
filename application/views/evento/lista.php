<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-evento-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Eventos</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-evento-menu">
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
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12 table-responsive">
                    <table id="tabela_evento" class="table display compact table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
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

<div class="modal fade" id="modal_form">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_evento">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Evento</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" required="required" title="Nome do evento" placeholder="Nome do evento">
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
<script type="text/javascript">
    $(document).ready(function () {
        tabela = $("#tabela_evento").DataTable({
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Visualizar colunas'
                }
            ],
            processing: true,
            serverSide: true,
            order: [[1, 'asc']],//nome
            ajax: {
                url: "<?= base_url('evento/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id", "visible": false},
                {data: "nome", "visible": true}
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_evento tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
            } else {
                tabela.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
            }
        });
        $("#adicionar").click(function (event) {
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar evento'); // Definir um titulo para o modal
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
                url: "<?= base_url('evento/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.evento, function (value, index) {
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            $('[name="' + index + '"]').val(value);
                        }else{
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }

                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar evento ID: '+id);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $.alert({
                        title: 'Alerta!',
                        content: 'Não foi possível buscar os dados. Tente novamente.',
                    });
                }
            });
        });
        $("#deletar").click(function () {
            var id = tabela.row(".selected").id();
            var nome = tabela.row(".selected").data().nome;
            $.confirm({
                title: 'Confirmação!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function () {
                    $.ajax({
                        url: "<?= base_url('evento/ajax_delete/') ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                reload_table();
                                $.alert({
                                    title: 'Sucesso!',
                                    content: 'Registro excluido com sucesso!.',
                                });
                            } else {
                                $.alert({
                                    title: 'Alerta!',
                                    content: 'Não foi possível excluir o registro. Tente novamente.',
                                });
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            $.alert({
                                title: 'Alerta!',
                                content: 'Não foi possível excluir o registro. Tente novamente.',
                            });
                        }
                    });
                },
                cancel: function () {
                    $.alert('Operação cancelada!')
                }
            });
        });
        $("#form_evento").submit(function (e) {
            disable_button_salvar();
            reset_errors();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('evento/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('evento/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_evento').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
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
                    $.alert({
                        title: 'Alerta!',
                        content: 'Não foi possível Adicionar ou Editar o registro. Tente novamente.',
                    });
                },
                complete: function () {
                    enable_button_salvar();
                    reload_table();
                }
            });
            $('#btnSubmit').text('Salvar');
            $('#btnSubmit').attr('disabled', false);
            e.preventDefault();
        });
        form_small();
    });

    function reload_table() {

        tabela.ajax.reload(null, false); //reload datatable ajax
    }

    function reset_form() {
        $('#form_evento')[0].reset(); // Zerar formulario
        reset_errors();
    }
</script>