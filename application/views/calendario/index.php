<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('calendario/filtro'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de entregas</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12 table-responsive">
                <table id="tb_calendario_entrega" class="table display compact table-bordered " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Data Entrega</th>
                            <th>N° Pedido</th>
                            <th>Documento</th>
                            <th>Cliente_id</th>
                            <th>Cliente</th>
                            <th>Data Evento</th>
                            <th>orcamento_id</th>
                            <th>produto_id</th>
                            <th>adicional</th>
                            <th>N° Adicional</th>
                            <th>ad_produto_id</th>
                            <th>Produto Tipo</th>
                            <th>Produto Nome</th>
                            <th>Produto Código</th>
                            <th>Quantidade</th>
                            <th>Unidade</th>
                            <th>Recebimento dados</th>
                            <th>Desenvolvimento layout</th>
                            <th>Envio layout</th>
                            <th>Aprovado</th>
                            <th>Producao</th>
                            <th>Disponivel</th>
                            <th>Retirado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<style>
    tr.group,
    tr.group:hover {
        background-color: #ddd !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {

        var tabela = $("#tb_calendario_entrega").DataTable({
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            select: {
                style: 'multi'
            },
            scrollX: true,
            scrollY:"500px",
            scrollCollapse: true,
            dom: 'lBrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todas"]],
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
                },
            ],
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;

                api.column(0, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="23">' + getDateGroup(group) + '</td></tr>'
                                );

                        last = group;
                    }
                });
            },
            order: [[0, 'asc']],
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('calendario/ajax_list') ?>",
                type: "POST",
                data: function (data) {
                    data.filtro_documento = $('#filtro_documento').val();
                    data.filtro_pedido_id = $('#filtro_pedido_id').val();
                    data.filtro_cliente_id = $('#filtro_cliente_id').val();
                    data.filtro_cliente = $('#filtro_cliente').val();
                    data.filtro_data_evento = $('#filtro_data_evento').val();
                    data.filtro_produto_tipo = $('#filtro_produto_tipo').val();
                    data.filtro_produto_nome = $('#filtro_produto_nome').val();
                    data.filtro_produto_codigo = $('#filtro_produto_codigo').val();
                    data.filtro_data_entrega = $('#filtro_data_entrega').val();
                    data.filtro_data_inicio = $('#filtro_data_inicio').val();
                    data.filtro_data_final = $('#filtro_data_final').val();
                    data.filtro_unidade = $('#filtro_unidade').val();
                    data.filtro_periodo = $('#filtro_periodo').val();
                    data.filtro_status = $('#filtro_status').val();
                    data.agrupar = 1;
                },
            },
            columns: [
                {data: "data_entrega", "visible": true},
                {data: "pedido_id", "visible": true},
                {data: "documento", "visible": true},
                {data: "cliente_id", "visible": false},
                {data: "cliente", "visible": true},
                {data: "data_evento", "visible": true},
                {data: "orcamento_id", "visible": false},
                {data: "produto_id", "visible": false},
                {data: "adicional", "visible": false},
                {data: "adicional_id", "visible": false},
                {data: "ad_produto_id", "visible": false},
                {data: "produto_tipo", "visible": true},
                {data: "produto_nome", "visible": true},
                {data: "produto_codigo", "visible": true},
                {data: "quantidade", "visible": true},
                {data: "unidade", "visible": true},
                {data: "recebimento_dados", "visible": false},
                {data: "desenvolvimento_layout", "visible": false},
                {data: "envio_layout", "visible": false},
                {data: "aprovado", "visible": false},
                {data: "producao", "visible": false},
                {data: "disponivel", "visible": false},
                {data: "retirado", "visible": false}
            ]
        });

        $('#btn-filter').click(function () {
            tabela.ajax.reload(null, false);
            $("#md_filtro").modal('hide');
        });
        $('#btn-filter-reset').click(function () {
            filter_reset();
            check_filter_dirty();
        });
        $(".check_filter_dirty").change(function(event) {
            check_filter_dirty();
        });
        function filter_reset() {
            $('#form-filter')[0].reset();
            tabela.ajax.reload(null, false);
        }
    });
</script>