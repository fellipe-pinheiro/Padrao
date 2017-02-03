<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand" href="javascript:void(0)">Lojas</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
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
                            </tr>
                        </thead>
                        <tbody id="fbody">
                        </tbody>
                    </table>
                </div>
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
                <h4 class="modal-title">Loja</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_loja" role="form"') ?>
            <div class="modal-body form">

                <?= form_hidden('id') ?>

                <!--Unidade-->
                <div class="form-group">
                    <?= form_label('Unidade*: ', 'unidade', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('unidade', '', 'id="unidade" class="form-control" placeholder="Unidade"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!-- Razão Social -->
                <div class="form-group">
                    <?= form_label('Razão Social*: ', 'razao_social', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('razao_social', '', 'id="razao_social" class="form-control" placeholder="Razão Social"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!-- CNPJ -->
                <div class="form-group">
                    <?= form_label('CNPJ: ', 'cnpj', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('cnpj', '', 'id="cnpj" class="form-control cnpj" placeholder="CNPJ"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!-- Inscrição Estadual -->
                <div class="form-group">
                    <?= form_label('Inscrição Estadual: ', 'ie', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('ie', '', 'id="ie" class="form-control" placeholder="Inscrição Estadual"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!-- Inscrição Municipal -->
                <div class="form-group">
                    <?= form_label('Inscrição Municipal: ', 'im', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('im', '', 'id="im" class="form-control" placeholder="Inscrição Municipal"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Telefone-->
                <div class="form-group">
                    <?= form_label('*Telefone: ', 'telefone', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('telefone', '', 'id="telefone" class="form-control sp_celphones" placeholder="Telefone"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Telefone 2-->
                <div class="form-group">
                    <?= form_label('Telefone 2: ', 'telefone2', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('telefone2', '', 'id="telefone2" class="form-control sp_celphones" placeholder="Telefone2"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Telefone3-->
                <div class="form-group">
                    <?= form_label('*Telefone3: ', 'telefone3', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('telefone3', '', 'id="telefone3" class="form-control sp_celphones" placeholder="Telefone3"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Email-->
                <div class="form-group">
                    <?= form_label('*Email: ', 'email', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('email', '', 'id="email" class="form-control" placeholder="Email"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Endereço-->
                <div class="form-group">
                    <?= form_label('Endereço: ', 'endereco', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('endereco', '', 'id="input_endereco" class="form-control" placeholder="Logradouro"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Número-->
                <div class="form-group">
                    <?= form_label('Número: ', 'numero', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('numero', '', 'id="numero" class="form-control" placeholder="Número"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Complemento-->
                <div class="form-group">
                    <?= form_label('Complemento: ', 'complemento', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('complemento', '', 'id="complemento" class="form-control" placeholder="Complemento"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Estado-->
                <div class="form-group">
                    <?= form_label('Estado: ', 'estado', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input list="dl_estado" id="input_estado" name="estado" class="form-control" data-estado='<?=$dados['estados_json']?>'/>
                        <datalist id="dl_estado">
                            <?php foreach ($dados['estados'] as $estado): ?>
                                <option value="<?= $estado ?>"></option>
                            <?php endforeach ?>
                        </datalist>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--uf-->
                <div class="form-group">
                    <?= form_label('UF: ', 'uf', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input list="dl_uf" name="uf" id="input_uf" class="form-control"/>
                        <datalist id="dl_uf">
                            <?php foreach ($dados['estados'] as $uf => $estado): ?>
                                <option value="<?= $uf ?>"></option>
                            <?php endforeach ?>
                        </datalist>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Bairro-->
                <div class="form-group">
                    <?= form_label('Bairro: ', 'bairro', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('bairro', '', 'id="input_bairro" class="form-control" placeholder="Bairro"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Cidade-->
                <div class="form-group">
                    <?= form_label('Cidade: ', 'cidade', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('cidade', '', 'id="input_cidade" class="form-control" placeholder="Cidade"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Cep-->
                <div class="form-group">
                    <?= form_label('Cep: ', 'cep', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('cep', '', 'id="input_cep" class="form-control cep" placeholder="Cep"') ?>
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
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?= base_url('loja/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id", "visible": true},
                {data: "unidade", "visible": true},
                {data: "razao_social", "visible": true},
                {data: "cnpj", "visible": true},
                {data: "ie", "visible": false},
                {data: "im", "visible": false},
                {data: "telefone", "visible": true},
                {data: "telefone2", "visible": true},
                {data: "telefone3", "visible": true},
                {data: "email", "visible": true},
                {data: "endereco", "visible": false},
                {data: "numero", "visible": false},
                {data: "complemento", "visible": false},
                {data: "estado", "visible": false},
                {data: "uf", "visible": false},
                {data: "bairro", "visible": false},
                {data: "cidade", "visible": false},
                {data: "cep", "visible": false},
            ]
        });

        // Resaltar a linha selecionada
        $("#tabela_loja tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                disable_buttons();
            } else {
                tabela.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
                enable_buttons();
            }
        });
        $("#adicionar").click(function (event) {
            reset_form();

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
                        $('[name="' + index + '"]').val(value);

                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar loja');
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
            var unidade = tabela.row(".selected").data().unidade;
            $.confirm({
                title: 'Confirmação!',
                content: 'O registro: ' + unidade + ' será excluido.',
                confirm: function () {
                    $.alert('Confirmado!');
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
                    $.alert('Cancelado!')
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
                            $('[name="' + index + '"]').parent().parent().addClass('has-error');
                            $('[name="' + index + '"]').next().text(value);
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
        $("#input_cep").blur(carregaCep);
    });

    function reload_table() {

        tabela.ajax.reload(null, false);
    }
    function reset_form() {
        $('#form_loja')[0].reset();
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