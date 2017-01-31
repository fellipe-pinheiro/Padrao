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
                    <div class="navbar-brand">Cliente</div>
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
                    <ul class="nav navbar-nav">
                        <li>
                            <a data-toggle="modal" href='#md_filtro_cliente'><i class="glyphicon glyphicon-filter"></i> Filtrar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="btn-reset">
                            <a href="javascript:void(0)"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)" id="btn-profile"><i class="glyphicon glyphicon-user"></i> Perfil</a>
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
            <div class="col-sm-12">
                <div class="col-sm-12 table-responsive">
                    <table id="tabela_cliente" class="table display compact table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Nome2</th>
                                <th>Sobrenome2</th>
                                <th>Email2</th>
                                <th>Telefone2</th>
                                <th>Rg</th>
                                <th>Cpf</th>
                                <th>Endereço</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>Estado</th>
                                <th>UF</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                                <th>Cep</th>
                                <th>Observacao</th>
                                <th>Pessoa</th>
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>I.E</th>
                                <th>I.M</th>
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
<?php $this->load->view('cliente/cliente_modal'); ?>
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        tabela_cliente = $("#tabela_cliente").DataTable({
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
                url: "<?= base_url('cliente/ajax_list') ?>",
                type: "POST",
                data: function (data) {
                    data.filtro_id = $('#filtro_id').val();
                    data.filtro_email = $('#filtro_email').val();
                    data.filtro_nome = $('#filtro_nome').val();
                    data.filtro_sobrenome = $('#filtro_sobrenome').val();
                    data.filtro_telefone = $('#filtro_telefone').val();
                    data.filtro_cpf = $('#filtro_cpf').val();
                    data.filtro_cnpj = $('#filtro_cnpj').val();
                    data.filtro_razao_social = $('#filtro_razao_social').val();
                },
            },
            columns: [
                {data: "id", "visible": true},
                {data: "nome", "visible": true},
                {data: "sobrenome", "visible": true},
                {data: "email", "visible": true},
                {data: "telefone", "visible": true},
                {data: "nome2", "visible": false},
                {data: "sobrenome2", "visible": false},
                {data: "email2", "visible": false},
                {data: "telefone2", "visible": false},
                {data: "rg", "visible": true},
                {data: "cpf", "visible": true},
                {data: "endereco", "visible": false},
                {data: "numero", "visible": false},
                {data: "complemento", "visible": false},
                {data: "estado", "visible": false},
                {data: "uf", "visible": false},
                {data: "bairro", "visible": false},
                {data: "cidade", "visible": false},
                {data: "cep", "visible": false},
                {data: "observacao", "visible": false},
                {data: "pessoa_tipo", "visible": false},
                {data: "razao_social", "visible": true},
                {data: "cnpj", "visible": true},
                {data: "ie", "visible": false},
                {data: "im", "visible": false},
            ]
        });
        //button filter event click
        $('#btn-filter-cliente').click(function () {
            //just reload table
            tabela_cliente.ajax.reload(null, false);
            $("#md_filtro_cliente").modal('hide');
        });
        //button reset event click
        $('.btn-reset').click(function () {
            $('#form-filter-cliente')[0].reset();
            //just reload table
            tabela_cliente.ajax.reload(null, false);
        });
        $('#btn-profile').click(function () {
            var id = tabela_cliente.row(".selected").id();
            if (!id) {
                return;
            }
            //$().redirect("<?= base_url('cliente/profile/') ?>", {'id': id});
            window.location.replace("<?= base_url('cliente/profile/') ?>" + id);
        });
        // Resaltar a linha selecionada
        $("#tabela_cliente tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                disable_buttons();
            } else {
                tabela_cliente.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
                enable_buttons();
            }
        });
        $("#adicionar").click(function (event) {
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar cliente'); // Definir um titulo para o modal
            $('#md_form_cliente').modal('show'); // Abrir modal
        });
        $("#editar").click(function () {
            // Buscar ID da linha selecionada
            var id = tabela_cliente.row(".selected").id();
            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            //Ajax Load data from ajax
            $.ajax({
                url: "<?= base_url('cliente/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    $.map(data.cliente, function (value, index) {
                        $('[name="' + index + '"]').val(value);

                    });

                    $('#md_form_cliente').modal('show');
                    $('.modal-title').text('Editar cliente');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                }
            });
        });
        $("#deletar").click(function () {

            var id = tabela_cliente.row(".selected").id();
            var nome = tabela_cliente.row(".selected").data().nome;
            if (confirm("O registro: " + nome + " será excluido. Clique em OK para continuar ou Cancele a operação.")) {
                $.ajax({
                    url: "<?= base_url('cliente/ajax_delete/') ?>" + id,
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
            }
        });
        $("#form_cliente").submit(function (e) {
            disable_button_salvar();
            reset_errors();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('cliente/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('cliente/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_cliente').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#md_form_cliente').modal('hide');
                        reload_table();
                    } else
                    {
                        $.map(data.form_validation, function (value, index) {
                            $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                            $('[name="' + index + '"]').next().text(value);
                            var juridica = ["razao_social", "cnpj", "ie", "im"];
                            var fisica = ["nome", "sobrenome", "email", "telefone", "nome2", "sobrenome2", "email2", "telefone2", "rg", "cpf"];
                            var endereco = ['endereco', 'numero', 'complemento', 'estado', 'uf', 'bairro', 'cidade', 'cep', 'observacao'];
                            if ($.inArray(index, fisica) !== -1) {
                                $('a[href="#fisica"]').children().addClass('glyphicon glyphicon-remove');
                            }
                            if ($.inArray(index, juridica) !== -1) {
                                $('a[href="#juridica"]').children().addClass('glyphicon glyphicon-remove');
                            }
                            if ($.inArray(index, endereco) !== -1) {
                                $('a[href="#endereco"]').children().addClass('glyphicon glyphicon-remove');
                            }
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
        $("#input_cep").blur(carregaCep);
    });
    function reload_table() {
        tabela_cliente.ajax.reload(null, false); //reload datatable ajax
    }
    function reset_form() {
        $('#form_cliente')[0].reset(); // Zerar formulario
        $('.form-group').removeClass('has-error'); // Limpar os erros
        $('.error_validation').removeClass('glyphicon-remove');
        $('.help-block').empty(); // Limpar as msg de erro
    }
    function reset_errors() {
        $('.form-group').removeClass('has-error'); // Limpar os erros
        $('.error_validation').removeClass('glyphicon-remove');
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