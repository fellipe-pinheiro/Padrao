<?php
$icone_ativo = '<i class="glyphicon glyphicon-ok" aria-hidden="true" title="Ativo"></i> ';
$icone_inativo = '<i class="glyphicon glyphicon-remove" aria-hidden="true" title="Inativo"></i> ';
$view_data = $dados;
?>
<?php $this->load->view('_include/dataTable'); ?>
<!--Tabela Usuarios-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestão de Usuários</h3>
    </div>
    <div class="panel-body">
        <button class="btn btn-default" id="adicionar"><i class="glyphicon glyphicon-plus"></i></button>
        <button class="btn btn-default" id="editar" ><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-default" id="deletar">Desativar</button>
        <button class="btn btn-default" id="ativar">Ativar</button>

        <hr style="margin-top: 10px; margin-bottom: 10px; border-top-width: 5px;">
        <div class="table-responsive">
            <table id="table_usuario" class="table display compact table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Estado</th>
                        <th>Criado em</th>
                        <th>Último Login</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Modal add/edit-->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div><!-- /.modal-content .modal-head -->
            <div class="modal-body form">
                <?= form_open("#", array("id" => "from_usuario", "class" => "form-horizontal", "role" => "form")) ?>
                <?= form_hidden("id") ?>
                <!--Nome-->
                <div class="form-group">
                    <?= form_label("Nome  ", '', array("class" => "col-sm-2 control-label")) ?>
                    <div class="col-sm-10">
                        <?= form_input("first_name", '', "class = 'form-control' placeholder = 'Nome'") ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Sobrenome-->
                <div class="form-group">
                    <?= form_label("Sobrenome  ", '', array("class" => "col-sm-2 control-label")) ?>
                    <div class="col-sm-10">
                        <?= form_input("last_name", '', "class = 'form-control' placeholder = 'Sobrenome'") ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Emai-->
                <div class="form-group">
                    <?= form_label("Emai  ", '', array("class" => "col-sm-2 control-label")) ?>
                    <div class="col-sm-10">
                        <?= form_input("email", '', "class = 'form-control' placeholder = 'Emai'") ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Celular-->
                <div class="form-group">
                    <?= form_label("Celular  ", '', array("class" => "col-sm-2 control-label")) ?>
                    <div class="col-sm-10">
                        <?= form_input("phone", '', "class = 'form-control' placeholder = 'Celular'") ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Empresa-->
                <div class="form-group">
                    <?= form_label("Empresa  ", '', array("class" => "col-sm-2 control-label")) ?>
                    <div class="col-sm-10">
                        <?= form_input("company", '', "class = 'form-control' placeholder = 'Empresa'") ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Ativo-->
                <!--                <div class="form-group">
                <?= form_label("Ativo", '', array("class" => "col-sm-2 control-label")) ?>
                                    <div class="col-sm-10">
                <?= form_checkbox("active", "", FALSE) ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>-->
                <!--Grupos-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Grupos</label>
                    <div id="grupos" class="col-sm-10">
                        <?php foreach ($view_data["grupos"] as $grupo) { ?>
                            <div class="col-md-6">
                                <input type="checkbox" name="gp_<?= $grupo["id"] ?>">
                                <label for="gp_<?= $grupo["id"] ?>"><?= $grupo["name"] ?></label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?= form_close() ?>
            </div><!-- /.modal-content .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" id="btnSubmit" class="btn btn-default">Salvar</button>
            </div><!-- /.modal-content .modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal ativar usuario-->
<div class="modal fade" id="modal_ativacao" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Ativação de usuário</h3>
            </div><!-- /.modal-content .modal-head -->
            <div class="modal-body form row">
                <?= form_open("#", array("id" => "from_ativacao", "class" => "form-horizontal col-sm-offset-1 col-sm-10", "role" => "form")) ?>
                <?= form_hidden("id", "") ?>
                <!--Usuario-->
                <div class="form-group">
                    <?= form_label("Usuário:  ", '', array("class" => " control-label")) ?>
                    <?= form_label("", "", array("id" => "form_ativacao_usuario", "style" => "font-weight: normal")) ?>
                </div>
                <!--Codigo-->
                <div class="form-group">
                    <?= form_label("Código de ativação", '', array("class" => "control-label")) ?>
                    <?= form_input("codigo", '', "class = 'form-control' placeholder = 'Código de ativação'") ?>
                    <span class="help-block"></span>
                </div>
                <?= form_close() ?>
            </div><!-- /.modal-content .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
                <button type="button" id="btnSubmit_ativacao" class="btn btn-default">Salvar</button>
            </div><!-- /.modal-content .modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function () {
        // Inicializar DataTable
        table_usuario = $("#table_usuario").DataTable({
            "language": {
                "url": "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Visualizar colunas',
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
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('usuario/ajax_list') ?>",
                "type": "POST"
            },
            "columns": [
                {"data": "id", "visible": false},
                {"data": "name", "visible": true},
                {"data": "last_name", "visible": true},
                {"data": "email", "visible": true},
                {"data": "phone", "visible": true},
                {"data": "active", "visible": true},
                {"data": "created_on", "visible": true},
                {"data": "last_login", "visible": true}
            ],
        });
        disable_buttons();
        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input, textarea, select").keyup(function () {
            $(this).parent().parent().removeClass('has-error');
            if ($(this).prop("type") != "checkbox")
                $(this).next().empty();
        });

        // Resaltar a linha selecionada
        $("#table_usuario tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                disable_buttons();
            } else {
                table_usuario.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
                enable_buttons();
            }
        });
        $("#adicionar").click(function () {
            save_method = 'add';
            $('#from_usuario')[0].reset(); // Zerar formulario
            $('.form-group').removeClass('has-error'); // Limpar os erros
            $('.help-block').empty(); // Limpar as msg de erro
            $('#modal_form').modal('show'); // Abrir modal
            $('.modal-title').text('Adicionar usuario'); // Definir um titulo para o modal
        });
        $("#editar").click(function () {
            save_method = 'edit';
            $('#from_usuario')[0].reset(); // Zerar formulario
            $('.form-group').removeClass('has-error'); // Limpar status de erro dos inputs
            $('.help-block').empty(); // Limpar as msg de erro

            // Buscar ID da linha selecionada
            var id = table_usuario.row(".selected").id();
            if (!id) {
                return;
            }
            $("#from_usuario > input[type='hidden']").val(id);
            //Ajax Load data from ajax
            $.ajax({
                url: "<?= base_url('usuario/ajax_edit/') ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data)
                {
                    $('[name="first_name"]').val(data.usuario.first_name);
                    $('[name="last_name"]').val(data.usuario.last_name);
                    $('[name="email"]').val(data.usuario.email);
                    $('[name="phone"]').val(data.usuario.phone);
                    $('[name="company"]').val(data.usuario.company);
                    // desmarcar todos os checkbox
                    $("#from_usuario #grupos input[type='checkbox']").prop("checked", false);
                    for (var i = 0; i < data.usuario.groups.length; i++) {
                        // marcar os checkbox desse usuario
                        $("#from_usuario input[name='gp_" + data.usuario.groups[i].id + "']").prop("checked", true);
                    }

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar usuario');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                }
            });
        });
        $("#deletar").click(function () {
            console.log(table_usuario.row(".selected"));
            var id = table_usuario.row(".selected").id();
            if (confirm("O usuário sera desativado")) {
                // ajax delete data to database
                $.ajax({
                    url: "<?= base_url('usuario/ajax_delete/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {
                        if (data.status) {
                            $('#modal_form').modal('hide');
                            reload_table();
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                        console.log(errorThrown);
                    }
                });
            }
        });
        $("#ativar").click(function () {
            // difinir o id do usuario no form_ativacao
            var id = table_usuario.row(".selected").data().id;
            $('#from_ativacao input[name=id]').val(id);
            // Mostar nome do usuario que sera ativado
            var nome = table_usuario.row(".selected").data().name + " " + table_usuario.row(".selected").data().last_name;
            $("#form_ativacao_usuario").text(nome);
            console.log("Id:" + id + " Nome:" + nome);

            $("#modal_ativacao").modal();
        });

        $("#btnSubmit").click(function () {
            $('#btnSubmit').text('Salvando..');
            $('#btnSubmit').attr('disabled', true);
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('usuario/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('usuario/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#from_usuario').serialize(),
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
                    alert('Erro ao Adicionar/Editar');
                    console.log(jqXHR.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                complete: function (jqXHR, textStatus) {
                    $('#btnSubmit').text('Salvar');
                    $('#btnSubmit').attr('disabled', false);
                }
            });
        });

        $("#btnSubmit_ativacao").click(function () {
            $('#btnSubmit_ativacao').text('Salvando..');
            $('#btnSubmit_ativacao').attr('disabled', true);

            $.ajax({
                url: "<?= base_url("usuario/ativacao") ?>",
                type: "POST",
                data: $('#from_ativacao').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    console.log(data);
                    console.log(data.status);
                    console.log(data.msg);
                    if (data.status) {
                        $("#modal_ativacao").modal("hide");
                        reload_table();
                    } else {
                        $('input[name="codigo"]').next().addClass('has-error');
                        $('input[name="codigo"]').next().text(data.msg);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //alert('Erro ao ativar usuário');
                    console.log("Ajax erro");
                    console.log(textStatus);
                },
                complete: function (jqXHR, textStatus) {
                    $('#btnSubmit_ativacao').text('Salvar');
                    $('#btnSubmit_ativacao').attr('disabled', false);
                }
            });
        });
    });
    function enable_buttons() {
        $("#editar").attr("disabled", false);
        $("#deletar").attr("disabled", false);
        $("#ativar").attr("disabled", false);
    }
    function disable_buttons() {
        $("#editar").attr("disabled", true);
        $("#deletar").attr("disabled", true);
        $("#ativar").attr("disabled", true);
    }
    function reload_table() {
        table_usuario.ajax.reload(null, false); //reload datatable ajax
    }
</script>