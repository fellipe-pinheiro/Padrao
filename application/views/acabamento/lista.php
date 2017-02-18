<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-acabamento-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Acabamento</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-acabamento-menu">
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
                    <table id="tabela_acabamento" class="table display compact table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
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
    </div>
</div>
<div class="modal fade" id="modal_form">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_acabamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Acabamento</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">

                        <!--nome-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" required="required" title="Nome do acabamento" placeholder="Nome do acabamento">
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
<script type="text/javascript">
    $(document).ready(function() {
        tabela = $("#tabela_acabamento").DataTable({
            scrollX: true,
            scrollY:"500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
            {   
                extend:'colvis',
                text:'Visualizar colunas',
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
                url: "<?= base_url('acabamento/ajax_list') ?>",
                type: "POST"
            },
            columns: [
            {data: "id","visible": false},
            {data: "nome","visible": true},
            {data: "descricao","visible": false},
            {data: "valor","visible": true}
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_acabamento tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
            }
            else {
                tabela.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
            }
        });
        $("#adicionar").click(function(event) {
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar acabamento'); // Definir um titulo para o modal
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
                url: "<?= base_url('acabamento/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.acabamento, function (value, index) {
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            $('[name="' + index + '"]').val(value);
                        }else{
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }
                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar acabamento ID: '+id);
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
                title: 'Atenção!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function(){
                    $.ajax({
                        url: "<?= base_url('acabamento/ajax_delete/') ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                reload_table();
                                $.alert('<strong>ID: ' + id + ' ' + nome + '</strong> excluido com sucesso!');
                            }else{
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
                cancel: function(){
                    $.alert('Cancelado!')
                }
            });
        });
        $("#form_acabamento").submit(function (e) {
            disable_button_salvar();
            reset_errors();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('acabamento/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('acabamento/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_acabamento').serialize(),
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
                }
            });
            reload_table();
            e.preventDefault();
        });
        form_small();
    });

    function reload_table() {
        tabela.ajax.reload(null, false); //reload datatable ajax
    }

    function reset_form() {
        $('#form_acabamento')[0].reset(); // Zerar formulario
        reset_errors();
    }
</script>