<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $dados['titulo_painel'] ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">  
            <div class="col-md-12">
                <button class="btn btn-default" id="adicionar"><i class="glyphicon glyphicon-plus"></i></button>
                <button class="btn btn-default" id="editar"><i class="glyphicon glyphicon-pencil"></i></button>
                <button class="btn btn-default" data-toggle="modal" href='#md_filtro_cliente'><span class="glyphicon glyphicon-search"></span></button>
                <button type="button" id="" class="btn btn-default btn-reset">Limpar Filtro</button>
                <button type="button" id="btn-profile" class="btn btn-default">Profile</button>
                <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </div>
        <hr>  
        <div class="row">
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
                    <tbody id="fbody">
                    </tbody>
                </table>
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
            lengthMenu: [[10, 25, 50, 100, -1], ['10 linhas', '25 linhas', '50 linhas', '100 linhas', "Todas"]],
            buttons: [
                {
                    extend: 'pageLength',
                },
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