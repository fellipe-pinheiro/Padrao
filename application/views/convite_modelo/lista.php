<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-modelo_convite-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Modelos de convites</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-modelo_convite-menu">
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
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_convite_modelo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title row"></h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" id="id" class="form-control">
                        <!--Nome-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" required="required" title="Nome do modelo" placeholder="Nome do modelo">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--Código-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="codigo" class="control-label">Código:</label>
                                <input type="text" name="codigo" id="codigo" class="form-control" value="" required="required" title="Utilize no mínimo 3 e máximo 20 caracteres sendo somente letras minúsculas [a-z], sem acentuação, números [0-9] e sem espaçamento." placeholder="Código do modelo Ex: abc123" pattern="[a-z0-9]{3,20}$">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <!--altura_final-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="altura_final" class="control-label">Altura Final (mm):</label>
                                <input type="number" name="altura_final" id="altura_final" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Altura final do convite pronto em milímetros. Ex:200">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--largura_final-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="largura_final" class="control-label">Largura Final (mm):</label>
                                <input type="number" name="largura_final" id="largura_final" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Largura final do convite pronto em milímetros. Ex:200">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--cartao_altura-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="cartao_altura" class="control-label">Cartão Altura (mm):</label>
                                <input type="number" name="cartao_altura" id="cartao_altura" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Altura do cartão para corte Ex:200">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--cartao_largura-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                            <label for="cartao_largura" class="control-label">Cartão Largura (mm):</label>
                                <input type="number" name="cartao_largura" id="cartao_largura" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Largura do cartão para corte Ex:200">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--envelope_altura-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="envelope_altura" class="control-label">Envelope Altura (mm):</label>
                                <input type="number" name="envelope_altura" id="envelope_altura" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Altura do envelope para corte Ex:200">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--envelope_largura-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="envelope_largura" class="control-label">Envelope Largura (mm):</label>
                                <input type="number" name="envelope_largura" id="envelope_largura" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Largura do envelope para corte Ex:200">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <!--empastamento_borda-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="empastamento_borda" class="control-label">Empastamento borda (mm):</label>
                                <input type="number" name="empastamento_borda" id="empastamento_borda" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Borda adicionada caso haja empastamento. Ex:10">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            
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
    $(document).ready(function () {
        tabela = $("#tabela_convite_modelo").DataTable({
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
            processing: true,
            serverSide: true,
            order: [[2, 'asc']],//nome
            ajax: {
                url: "<?= base_url('convite_modelo/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id", "visible": false},
                {data: "codigo", "visible": true},
                {data: "nome", "visible": true},
                {data: "altura_final", "visible": true},
                {data: "largura_final", "visible": true},
                {data: "cartao_altura", "visible": true},
                {data: "cartao_largura", "visible": true},
                {data: "envelope_altura", "visible": true},
                {data: "envelope_largura", "visible": true},
                {data: "empastamento_borda", "visible": true},
                {data: "descricao", "visible": false}
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_convite_modelo tbody").on("click", "tr", function () {
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

            $('.modal-title').text('Adicionar Modelo'); // Definir um titulo para o modal
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
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            $('[name="' + index + '"]').val(value);
                        }else{
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }
                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar Modelo ID: '+id);
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
            $.confirm({
                title: 'Atenção!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function(){
                    $.ajax({
                        url: "<?= base_url('convite_modelo/ajax_delete/') ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                reload_table();
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
        $("#form_convite_modelo").submit(function (e) {
            disable_button_salvar();
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
                    alert('Erro ao Adicionar ou Editar');
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
        tabela.ajax.reload(null, false);
    }

    function reset_form() {
        $('#form_convite_modelo')[0].reset();
        reset_errors();
    }
</script>