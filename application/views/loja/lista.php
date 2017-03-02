<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-loja-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand" href="javascript:void(0)">Lojas</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-loja-menu">
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
                    <table id="tabela_loja" class="table display compact table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Unidade</th>
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>I.E</th>
                                <th>I.M</th>
                                <th>Telefone</th>
                                <th>Telefone2</th>
                                <th>Telefone3</th>
                                <th>Email</th>
                                <th>Endereço</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>Estado</th>
                                <th>UF</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>CEP</th>
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

<div class="modal fade" id="modal_form">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_loja">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Loja</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <div class="row">
                            <!--ativo-->
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="form-group input-padding">
                                        <label for="ativo" class="control-label">Ativo:</label>
                                        <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!--unidade-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="unidade" class="control-label">Unidade:</label>
                                        <input type="text" name="unidade" id="unidade" class="form-control" value="" required="required" placeholder="Ex: Jardins" autofocus pattern=".{1,50}" title="Máximo de 50 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--razao_social-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="razao_social" class="control-label">Razão Social:</label>
                                        <input type="text" name="razao_social" id="razao_social" class="form-control" value="" required="required" placeholder="Razão Social" pattern=".{1,150}" title="Máximo de 150 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--cnpj-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="cnpj" class="control-label">CNPJ:</label>
                                        <input type="text" name="cnpj" id="cnpj" class="form-control" value="" placeholder="CNPJ" pattern=".{1,18}" title="Máximo de 18 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!--ie-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="ie" class="control-label">Inscrição Estadual:</label>
                                        <input type="text" name="ie" id="ie" class="form-control" value="" placeholder="Inscrição Estadual" pattern=".{1,30}" title="Máximo de 30 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--im-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="im" class="control-label">Inscrição Municipal:</label>
                                        <input type="text" name="im" id="im" class="form-control" value="" placeholder="Inscrição Municipal" pattern=".{1,30}" title="Máximo de 30 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--email-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="email" class="control-label">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control" value="" placeholder="Email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Insira um email válido">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!--telefone-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="telefone" class="control-label">Telefone:</label>
                                        <input type="text" name="telefone" id="telefone" class="form-control sp_celphones" value="" title="Telefone" placeholder="Telefone" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--telefone2-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="telefone2" class="control-label">Telefone 2:</label>
                                        <input type="text" name="telefone2" id="telefone2" class="form-control sp_celphones" value="" title="Telefone 2" placeholder="Telefone 2">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--telefone3-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="telefone3" class="control-label">Telefone 3:</label>
                                        <input type="text" name="telefone3" id="telefone3" class="form-control sp_celphones" value="" title="Telefone 3" placeholder="Telefone 3">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <legend>Endereço</legend>
                                <!--cep-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="cep" class="control-label">CEP:</label>
                                        <input type="text" name="cep" id="input_cep" class="form-control cep" value="" placeholder="CEP" pattern="\d{5}-?\d{3}" title="Máximo de 9 caracteres Ex: 00000-000">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--endereco-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="endereco" class="control-label">Logradouro:</label>
                                        <input type="text" name="endereco" id="input_endereco" class="form-control" value="" placeholder="Logradouro" pattern=".{1,100}" title="Máximo de 100 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--numero-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="numero" class="control-label">Número:</label>
                                        <input type="text" name="numero" id="numero" class="form-control" value="" placeholder="Número" pattern=".{1,10}" title="Máximo de 10 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!--complemento-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="complemento" class="control-label">Complemento:</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control" value="" placeholder="Complemento" pattern=".{1,100}" title="Máximo de 100 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--bairro-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="bairro" class="control-label">Bairro:</label>
                                        <input type="text" name="bairro" id="input_bairro" class="form-control" value="" placeholder="Bairro" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--cidade-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="cidade" class="control-label">Cidade:</label>
                                        <input type="text" name="cidade" id="input_cidade" class="form-control" value="" placeholder="Cidade" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <!--estado-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="estado" class="control-label">Estado:</label>
                                        <input data-estado='<?=$dados['estados_json']?>' list="dl_estado" id="input_estado" name="estado" class="form-control" pattern=".{1,50}" title="Máximo de 50 caracteres" placeholder="Estado">
                                        <datalist id="dl_estado">
                                            <?php foreach ($dados['estados'] as $estado): ?>
                                                <option value="<?=$estado?>"></option>
                                            <?php endforeach ?>
                                        </datalist>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--uf-->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <label for="uf" class="control-label">UF:</label>
                                        <input list="dl_uf" name="uf" id="input_uf" class="form-control" pattern=".{2,2}" title="Máximo de 2 caracteres" placeholder="UF">
                                        <datalist id="dl_uf">
                                            <?php foreach ($dados['estados'] as $uf =>$estado ): ?>
                                                <option value="<?=$uf?>"></option>
                                            <?php endforeach ?>
                                        </datalist>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!---->
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                    </div>
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
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        tabela = $("#tabela_loja").DataTable({
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
            order: [[1, 'asc']],
            ajax: {
                url: "<?= base_url('loja/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id", "visible": true,"orderable": true},
                {data: "unidade", "visible": true,"orderable": true},
                {data: "razao_social", "visible": true,"orderable": true},
                {data: "cnpj", "visible": true,"orderable": true},
                {data: "ie", "visible": false,"orderable": true},
                {data: "im", "visible": false,"orderable": true},
                {data: "telefone", "visible": true,"orderable": false},
                {data: "telefone2", "visible": true,"orderable": false},
                {data: "telefone3", "visible": true,"orderable": false},
                {data: "email", "visible": true,"orderable": true},
                {data: "endereco", "visible": false,"orderable": true},
                {data: "numero", "visible": false,"orderable": false},
                {data: "complemento", "visible": false,"orderable": false},
                {data: "estado", "visible": false,"orderable": true},
                {data: "uf", "visible": false,"orderable": true},
                {data: "bairro", "visible": false,"orderable": true},
                {data: "cidade", "visible": false,"orderable": true},
                {data: "cep", "visible": false,"orderable": true},
                {data: "ativo", "visible": true,"orderable": false},
            ]
        });
        // Resaltar a linha selecionada
        $("#tabela_loja tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
            } else {
                tabela.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
            }
        });

        $("#adicionar").click(function (event) {
            reset_form();
            $(".ativo-crud").prop('checked', true);
            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar loja'); // Definir um titulo para o modal
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
                url: "<?= base_url('loja/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.loja, function (value, index) {
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            if($('[name="' + index + '"]').is(':checkbox')){
                                if(value === "0"){checked = false;}else{ checked = true;}
                                $('[name="' + index + '"]').prop('checked', checked);
                            }else{
                                $('[name="' + index + '"]').val(value);
                            }
                        }else if ($('[name="' + index + '"]').is("select")){
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }
                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar loja ID: '+id);
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
            var nome = tabela.row(".selected").data().unidade;
            $.confirm({
                title: 'Confirmação!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function () {
                    $.ajax({
                        url: "<?= base_url('loja/ajax_delete/') ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                reload_table();
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

        $("#form_loja").submit(function (e) {
            disable_button_salvar();
            reset_errors();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('loja/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('loja/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_loja').serialize(),
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
                }
            });
            reload_table();
            e.preventDefault();
        });

        $("#input_cep").keyup(carregaCep);

        form_small();
    });

    function reload_table() {

        tabela.ajax.reload(null, false);
    }

    function reset_form() {
        $('#form_loja')[0].reset();
        reset_errors()
    }
</script>