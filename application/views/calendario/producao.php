<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('calendario/filtro'); ?>
<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#convite" aria-controls="convite" role="tab" data-toggle="tab">convite</a>
        </li>
        <li role="presentation">
            <a href="#personalizado" aria-controls="personalizado" role="tab" data-toggle="tab">personalizado</a>
        </li>
        <li role="presentation">
            <a href="#produto" aria-controls="produto" role="tab" data-toggle="tab">produto</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="convite">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table id="tb_calendario_convite" class="table display compact table-bordered " cellspacing="0" width="100%">
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
        <div role="tabpanel" class="tab-pane" id="personalizado">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table id="tb_calendario_personalizado" class="table display compact table-bordered " cellspacing="0" width="100%">
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
        <div role="tabpanel" class="tab-pane" id="produto">
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table id="tb_calendario_produto" class="table display compact table-bordered" cellspacing="0" width="100%">
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
</div>
<div class="modal fade" id="md_personalizado_detalhes" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Personalizado detalhes</h4>
            </div>
            <div class="modal-body">

                <table id="tb_personalizado_detalhes" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>pedido_id</th>
                            <th>orcamento_id</th>
                            <th>produto_id</th>
                            <th>item_id</th>
                            <th>grupo</th>
                            <th>item</th>
                            <th>material</th>
                            <th>quantidade</th>
                            <th>descricao</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_convite_detalhes" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Convite detalhes</h4>
            </div>
            <div class="modal-body">

                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist" id="tab_convite_detalhes">
                        <li role="presentation" class="active">
                            <a href="#cartao" aria-controls="cartao" role="tab" data-toggle="tab">Cartão</a>
                        </li>
                        <li role="presentation">
                            <a href="#envelope" aria-controls="envelope" role="tab" data-toggle="tab">Envelope</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="cartao">
                            <table id="tb_convite_cartao_detalhes" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>pedido_id</th>
                                        <th>orcamento_id</th>
                                        <th>produto_id</th>
                                        <th>item_id</th>
                                        <th>grupo</th>
                                        <th>item</th>
                                        <th>material</th>
                                        <th>quantidade</th>
                                        <th>descricao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="envelope">
                            <table id="tb_convite_envelope_detalhes" class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>pedido_id</th>
                                        <th>orcamento_id</th>
                                        <th>produto_id</th>
                                        <th>item_id</th>
                                        <th>grupo</th>
                                        <th>item</th>
                                        <th>material</th>
                                        <th>quantidade</th>
                                        <th>descricao</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_papel_lista_convite" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de papeis</h4>
            </div>
            <div class="modal-body">
                <table id="tb_papel_lista_convite" class="table display compact table-bordered">
                    <thead>
                        <tr>
                            <th>pedido</th>
                            <th>cliente</th>
                            <th>data_entrega</th>
                            <th>qtd_pedido</th>
                            <th>qtd_papel</th>
                            <th>add</th>
                            <th>sobras</th>
                            <th>qtd_papel_total</th>
                            <th>papel_categoria</th>
                            <th>papel_linha</th>
                            <th>papel</th>
                            <th>gramatura</th>
                            <th>folhas</th>
                            <th>pap_inteiro_alt</th>
                            <th>pap_inteiro_larg</th>
                            <th>mod_codigo</th>
                            <th>modelo_nome</th>
                            <th>altura_final</th>
                            <th>larguar_final</th>
                            <th>formato</th>
                            <th>empastamento_borda</th>
                            <th>composicao</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>pedido</th>
                            <th>cliente</th>
                            <th>data_entrega</th>
                            <th>qtd_pedido</th>
                            <th>qtd_papel</th>
                            <th>add</th>
                            <th>sobras</th>
                            <th>qtd_papel_total</th>
                            <th>papel_categoria</th>
                            <th>papel_linha</th>
                            <th>papel</th>
                            <th>gramatura</th>
                            <th>folhas</th>
                            <th>pap_inteiro_alt</th>
                            <th>pap_inteiro_larg</th>
                            <th>mod_codigo</th>
                            <th>modelo_nome</th>
                            <th>altura_final</th>
                            <th>larguar_final</th>
                            <th>formato</th>
                            <th>empastamento_borda</th>
                            <th>composicao</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_papel_lista_personalizado" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de papeis</h4>
            </div>
            <div class="modal-body">
                <table id="tb_papel_lista_personalizado" class="table display compact table-bordered">
                    <thead>
                        <tr>
                            <th>pedido</th>
                            <th>cliente</th>
                            <th>data_entrega</th>
                            <th>qtd_pedido</th>
                            <th>qtd_papel</th>
                            <th>add</th>
                            <th>sobras</th>
                            <th>qtd_papel_total</th>
                            <th>papel_categoria</th>
                            <th>papel_linha</th>
                            <th>papel</th>
                            <th>gramatura</th>
                            <th>folhas</th>
                            <th>pap_inteiro_alt</th>
                            <th>pap_inteiro_larg</th>
                            <th>mod_codigo</th>
                            <th>modelo_nome</th>
                            <th>altura_final</th>
                            <th>larguar_final</th>
                            <th>formato</th>
                            <th>empastamento_borda</th>
                            <th>composicao</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_status" tabindex="-1" role="dialog">
    <form id="form_status">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Status</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Campos de alteração</th>
                                <th>Alterar?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Recebimento dados</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_recebimento_dados"></td>
                            </tr>
                            <tr>
                                <td>Desenvolvimento layout</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_desenvolvimento_layout"></td>
                            </tr>
                            <tr>
                                <td>Envio layout</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_envio_layout"></td>
                            </tr>
                            <tr>
                                <td>Aprovado</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_aprovado"></td>
                            </tr>
                            <tr>
                                <td>Producao</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_producao"></td>
                            </tr>
                            <tr>
                                <td>Disponivel</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_disponivel"></td>
                            </tr>
                            <tr>
                                <td>Retirado</td>
                                <td><input type="checkbox" class="form-control input-sm date" value="1" name="clear_retirado"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-default" onclick="set_status(1)">Marcar status</button>
                    <button type="button" class="btn btn-default" onclick="set_status(0)">Apagar status</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<style>
    tr.group,
    tr.group:hover {
        background-color: #ddd !important;
    }
    .tab-content {
        padding-top: 30px;
    }
</style>
<script>
    var tb_calendario_convite;
    var tb_calendario_personalizado;
    var tb_calendario_produto;
    var tb_papel_lista_convite;
    var tb_papel_lista_personalizado;
    var tb_convite_cartao_detalhes;
    var tb_convite_envelope_detalhes;
    var tb_convite_personalizado_detalhes;
    var dados_dblclick;

    $(document).ready(function () {
        tb_calendario_convite = $("#tb_calendario_convite").DataTable({
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            select: {
                style: 'multi'
            },
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            dom: 'lBrtip',
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
                {
                    extend: 'collection',
                    text: 'Selecionar',
                    autoClose: true,
                    buttons: [
                        {
                            text: 'Todos',
                            action: function () {
                                selecionar_linhas(tb_calendario_convite);
                            }
                        },
                        {
                            text: 'Limpar',
                            action: function () {
                                limpar_selecao(tb_calendario_convite);
                            }
                        },
                    ],
                    fade: true
                },
                {
                    text: 'Status',
                    action: function () {
                        if (!tb_calendario_convite.rows({selected: true}).data().count()) {
                            empty_rows_message();
                        } else {
                            $("#md_status").modal();
                        }
                    }
                },
                {
                    text: 'Papel Lista',
                    action: function () {
                        get_papel_lista_convite();
                    }
                }
            ],
            order: [[0, 'asc']],
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
                    data.filtro_produto_tipo = 'convite';
                    data.filtro_produto_nome = $('#filtro_produto_nome').val();
                    data.filtro_produto_codigo = $('#filtro_produto_codigo').val();
                    data.filtro_data_entrega = $('#filtro_data_entrega').val();
                    data.filtro_data_inicio = $('#filtro_data_inicio').val();
                    data.filtro_data_final = $('#filtro_data_final').val();
                    data.filtro_unidade = $('#filtro_unidade').val();
                    data.filtro_periodo = $('#filtro_periodo').val();
                    data.filtro_status = $('#filtro_status').val();
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
                {data: "produto_tipo", "visible": false},
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
            if (typeof tb_calendario_convite !== "undefined") {
                tb_calendario_convite.ajax.reload(null, false);
            }
            if (typeof tb_calendario_personalizado !== "undefined") {
                tb_calendario_personalizado.ajax.reload(null, false);
            }
            if (typeof tb_calendario_produto !== "undefined") {
                tb_calendario_produto.ajax.reload(null, false);
            }
        });
        $('#btn-filter-reset').click(function () {
            filter_reset(tb_calendario_convite);
            filter_reset(tb_calendario_personalizado);
            filter_reset(tb_calendario_produto);
        });
        $('#tb_calendario_convite tbody').on('dblclick', 'tr', function () {
            //console.log(tb_calendario_convite.row(this).data());
            dados_dblclick = tb_calendario_convite.row(this).data();
            tb_convite_cartao_detalhes = $("#tb_convite_cartao_detalhes").DataTable({
                scrollX: true,
                scrollY: "500px",
                scrollCollapse: true,
                dom: 'lBfrtip',
                paging: false,
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
                language: {
                    url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?= base_url('calendario/ajax_get_convite_detalhes') ?>',
                    type: "POST",
                    data: {
                        produto_id: dados_dblclick.produto_id,
                        componente: 'cartao'
                    },
                },
                columns: [
                    {data: "pedido_id", "visible": false, "orderable": false},
                    {data: "orcamento_id", "visible": false, "orderable": false},
                    {data: "produto_id", "visible": false, "orderable": false},
                    {data: "item_id", "visible": false, "orderable": false},
                    {data: "grupo", "visible": false, "orderable": false},
                    {data: "item", "visible": false, "orderable": false},
                    {data: "material", "visible": true, "orderable": false},
                    {data: "quantidade", "visible": true, "orderable": false},
                    {data: "descricao", "visible": true, "orderable": false},
                ],
                order: [[4, 'asc']],
                drawCallback: function (settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;

                    api.column(4, {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="23">' + group + '</td></tr>'
                                    );

                            last = group;
                        }
                    });
                },
            });
            $("#md_convite_detalhes").modal();
        });
        $('#tb_calendario_personalizado tbody').on('dblclick', 'tr', function () {
            dados_dblclick = tb_calendario_personalizado.row(this).data();
            if (!$.fn.DataTable.isDataTable('#tb_personalizado_detalhes')) {
                tb_personalizado_detalhes = $("#tb_personalizado_detalhes").DataTable({
                    scrollX: true,
                    scrollY: "500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    paging: false,
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
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url('calendario/ajax_get_convite_detalhes') ?>',
                        type: "POST",
                        data: {
                            produto_id: dados_dblclick.produto_id,
                            componente: 'personalizado'
                        },
                    },
                    columns: [
                        {data: "pedido_id", "visible": false, "orderable": false},
                        {data: "orcamento_id", "visible": false, "orderable": false},
                        {data: "produto_id", "visible": false, "orderable": false},
                        {data: "item_id", "visible": false, "orderable": false},
                        {data: "grupo", "visible": false, "orderable": false},
                        {data: "item", "visible": false, "orderable": false},
                        {data: "material", "visible": true, "orderable": false},
                        {data: "quantidade", "visible": true, "orderable": false},
                        {data: "descricao", "visible": true, "orderable": false},
                    ],
                    order: [[4, 'asc']],
                    drawCallback: function (settings) {
                        var api = this.api();
                        var rows = api.rows({page: 'current'}).nodes();
                        var last = null;

                        api.column(4, {page: 'current'}).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                        '<tr class="group"><td colspan="23">' + group + '</td></tr>'
                                        );

                                last = group;
                            }
                        });
                    },
                });
            }
            $("#md_personalizado_detalhes").modal();
        });
        $("a[href='#convite']").click(function () {

            tb_calendario_convite.ajax.reload(null, false);
        });
        $("a[href='#personalizado']").click(function () {
            if (!is_datatable_exists("#tb_calendario_personalizado")) {
                tb_calendario_personalizado = $("#tb_calendario_personalizado").DataTable({
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    select: {
                        style: 'multi'
                    },
                    scrollX: true,
                    scrollY: "500px",
                    scrollCollapse: true,
                    dom: 'lBrtip',
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
                        {
                            extend: 'collection',
                            text: 'Selecionar',
                            autoClose: true,
                            buttons: [
                                {
                                    text: 'Todos',
                                    action: function () {
                                        selecionar_linhas(tb_calendario_personalizado);
                                    }
                                },
                                {
                                    text: 'Limpar',
                                    action: function () {
                                        limpar_selecao(tb_calendario_personalizado);
                                    }
                                },
                            ],
                            fade: true
                        },
                        {
                            text: 'Status',
                            action: function () {
                                if (!tb_calendario_personalizado.rows({selected: true}).data().count()) {
                                    empty_rows_message();
                                } else {
                                    $("#md_status").modal();
                                }
                            }
                        },
                        {
                            text: 'Papel Lista',
                            action: function () {
                                get_papel_lista_personalizado();
                            }
                        }
                    ],
                    order: [[0, 'asc']],
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
                            data.filtro_produto_tipo = 'personalizado';
                            data.filtro_produto_nome = $('#filtro_produto_nome').val();
                            data.filtro_produto_codigo = $('#filtro_produto_codigo').val();
                            data.filtro_data_entrega = $('#filtro_data_entrega').val();
                            data.filtro_data_inicio = $('#filtro_data_inicio').val();
                            data.filtro_data_final = $('#filtro_data_final').val();
                            data.filtro_unidade = $('#filtro_unidade').val();
                            data.filtro_periodo = $('#filtro_periodo').val();
                            data.filtro_status = $('#filtro_status').val();
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
                        {data: "produto_tipo", "visible": false},
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
                    ],
                });
            } else {
                tb_calendario_personalizado.ajax.reload(null, false);
            }
        });
        $("a[href='#produto']").click(function () {
            if (!is_datatable_exists("#tb_calendario_produto")) {
                tb_calendario_produto = $("#tb_calendario_produto").DataTable({
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    select: {
                        style: 'multi'
                    },
                    scrollX: true,
                    scrollY: "500px",
                    scrollCollapse: true,
                    dom: 'lBrtip',
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
                        {
                            extend: 'collection',
                            text: 'Selecionar',
                            autoClose: true,
                            buttons: [
                                {
                                    text: 'Todos',
                                    action: function () {
                                        selecionar_linhas(tb_calendario_produto);
                                    }
                                },
                                {
                                    text: 'Limpar',
                                    action: function () {
                                        limpar_selecao(tb_calendario_produto);
                                    }
                                },
                            ],
                            fade: true
                        },
                        {
                            text: 'Status',
                            action: function () {
                                if (!tb_calendario_produto.rows({selected: true}).data().count()) {
                                    empty_rows_message();
                                } else {
                                    $("#md_status").modal();
                                }
                            }
                        }
                    ],
                    order: [[0, 'asc']],
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
                            data.filtro_produto_tipo = 'produto';
                            data.filtro_produto_nome = $('#filtro_produto_nome').val();
                            data.filtro_produto_codigo = $('#filtro_produto_codigo').val();
                            data.filtro_data_entrega = $('#filtro_data_entrega').val();
                            data.filtro_data_inicio = $('#filtro_data_inicio').val();
                            data.filtro_data_final = $('#filtro_data_final').val();
                            data.filtro_unidade = $('#filtro_unidade').val();
                            data.filtro_periodo = $('#filtro_periodo').val();
                            data.filtro_status = $('#filtro_status').val();
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
                        {data: "produto_tipo", "visible": false},
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
                    ],
                });
            } else {
                tb_calendario_produto.ajax.reload(null, false);
            }
        });
        $("a[href='#envelope']").click(function () {
            if (!is_datatable_exists("#tb_convite_envelope_detalhes")) {
                tb_convite_envelope_detalhes = $("#tb_convite_envelope_detalhes").DataTable({
                    scrollX: true,
                    scrollY: "500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    paging: false,
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
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '<?= base_url('calendario/ajax_get_convite_detalhes') ?>',
                        type: "POST",
                        data: {
                            produto_id: dados_dblclick.produto_id,
                            componente: 'envelope',
                        },
                    },
                    columns: [
                        {data: "pedido_id", "visible": false, "orderable": false},
                        {data: "orcamento_id", "visible": false, "orderable": false},
                        {data: "produto_id", "visible": false, "orderable": false},
                        {data: "item_id", "visible": false, "orderable": false},
                        {data: "grupo", "visible": false, "orderable": false},
                        {data: "item", "visible": false, "orderable": false},
                        {data: "material", "visible": true, "orderable": false},
                        {data: "quantidade", "visible": true, "orderable": false},
                        {data: "descricao", "visible": true, "orderable": false},
                    ],
                    order: [[4, 'asc']],
                    drawCallback: function (settings) {
                        var api = this.api();
                        var rows = api.rows({page: 'current'}).nodes();
                        var last = null;

                        api.column(4, {page: 'current'}).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                        '<tr class="group"><td colspan="23">' + group + '</td></tr>'
                                        );

                                last = group;
                            }
                        });
                    },
                });
            }
        });
        $("#filtro_produto_tipo").prop('disabled', true);
        $("#filtro_produto_tipo option")[0].text = 'N/A';
        $(".check_filter_dirty").change(function (event) {
            check_filter_dirty();
        });
        $('#md_papel_lista_convite').on('hide.bs.modal', function (e) {
            tb_papel_lista_convite.destroy();
        });
        $('#md_papel_lista_personalizado').on('hide.bs.modal', function (e) {
            tb_papel_lista_personalizado.destroy();
        });
        $('#md_papel_lista_convite').on('shown.bs.modal', function (e) {
            $('#tb_papel_lista_convite tbody').hide();
        });
        $('#md_papel_lista_personalizado').on('shown.bs.modal', function (e) {
            $('#tb_papel_lista_personalizado tbody').hide();
        });
        $('#md_convite_detalhes').on('hidden.bs.modal', function (e) {
            if (is_datatable_exists("#tb_convite_cartao_detalhes")) {
                $("#tb_convite_cartao_detalhes tbody").remove();
                tb_convite_cartao_detalhes.destroy();
            }
            if (is_datatable_exists("#tb_convite_envelope_detalhes")) {
                $("#tb_convite_envelope_detalhes tbody").remove();
                tb_convite_envelope_detalhes.destroy();
            }
            $("#tab_convite_detalhes a[href='#cartao']").tab('show');
        });
        $('#tb_papel_lista_convite tbody').on('change', 'tr', function () {
            data = tb_papel_lista_convite.row(this).data();
            data.add = $(this).children().closest('.add').children()[0].value;
            tb_papel_lista_convite.row(this).data(calcular_folhas(data));
        });

        $('#tb_papel_lista_personalizado tbody').on('change', 'tr', function () {
            data = tb_papel_lista_personalizado.row(this).data();
            data.add = $(this).children().closest('.add').children()[0].value;
            tb_papel_lista_personalizado.row(this).data(calcular_folhas(data));
        });
    });
    function calcular_folhas(data) {
        data.add = Number(data.add);
        data.qtd_pedido = Number(data.qtd_pedido);
        data.formato = Number(data.formato);
        data.qtd_papel = Number(data.qtd_papel);
        total_aux = data.qtd_pedido + data.add;
        data.folhas = Math.ceil((total_aux * data.qtd_papel) / data.formato);
        data.qtd_papel_total = (data.folhas * data.formato) / data.qtd_papel;
        data.sobras = data.qtd_papel_total - data.qtd_pedido;
        return data;
    }
    function get_papel_lista_convite() {
        var selecao = get_selecao(tb_calendario_convite);
        tb_papel_lista_convite = $("#tb_papel_lista_convite").DataTable({
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
                }
            ],
            order: [[11, 'asc']],
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(11, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="26">' + group + ' g</td></tr>'
                                );

                        last = group;
                    }
                });
                $('#tb_papel_lista_convite tbody').show();
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('calendario/ajax_get_papel_lista') ?>",
                type: "POST",
                data: function (data) {
                    data.selecao = JSON.stringify(selecao);
                    data.produto_tipo = 'convite';
                    data.agrupar = 1;
                },
            },
            columns: [
                {data: "pedido", "visible": true},
                {data: "cliente", "visible": false},
                {data: "data_entrega", "visible": false},
                {data: "qtd_pedido", "visible": true},
                {data: "qtd_papel", "visible": false},
                {data: "add", "visible": true, "orderable": false},
                {data: "sobras", "visible": true, "orderable": false},
                {data: "qtd_papel_total", "visible": true, "orderable": false},
                {data: "papel_categoria", "visible": false},
                {data: "papel_linha", "visible": false},
                {data: "papel", "visible": true},
                {data: "gramatura", "visible": true},
                {data: "folhas", "visible": true, "orderable": false},
                {data: "pap_inteiro_alt", "visible": false},
                {data: "pap_inteiro_larg", "visible": false},
                {data: "modelo_codigo", "visible": true},
                {data: "modelo_nome", "visible": false},
                {data: "altura_final", "visible": true},
                {data: "larguar_final", "visible": true},
                {data: "formato", "visible": true, "orderable": false},
                {data: "empastamento_borda", "visible": false},
                {data: "composicao", "visible": true}
            ],
            columnDefs: [{
                    targets: 5,
                    searchable: false,
                    orderable: true,
                    className: 'dt-body-center add',
                    render: function (data, type, full, meta) {
                        return '<input type="number" id="" name="" class="form-control" style="width:90px" min="0" step="1" value="' + $('<div/>').text(data).html() + '">';
                    }
                }],
        });
        $("#md_papel_lista_convite").modal();
    }
    function get_papel_lista_personalizado() {
        var selecao = get_selecao(tb_calendario_personalizado);
        tb_papel_lista_personalizado = $("#tb_papel_lista_personalizado").DataTable({
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            scrollX: true,
            dom: 'lBrtip',
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
            order: [[11, 'asc']],
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(11, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="26">' + group + ' g</td></tr>'
                                );

                        last = group;
                    }
                });
                $('#tb_papel_lista_personalizado tbody').show();
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('calendario/ajax_get_papel_lista') ?>",
                type: "POST",
                data: function (data) {
                    data.selecao = JSON.stringify(selecao);
                    data.produto_tipo = 'personalizado';
                    data.agrupar = 1;
                },
            },
            columns: [
                {data: "pedido", "visible": true},
                {data: "cliente", "visible": false},
                {data: "data_entrega", "visible": false},
                {data: "qtd_pedido", "visible": true},
                {data: "qtd_papel", "visible": false},
                {data: "add", "visible": true, "orderable": false},
                {data: "sobras", "visible": true, "orderable": false},
                {data: "qtd_papel_total", "visible": true, "orderable": false},
                {data: "papel_categoria", "visible": false},
                {data: "papel_linha", "visible": false},
                {data: "papel", "visible": true},
                {data: "gramatura", "visible": true},
                {data: "folhas", "visible": true, "orderable": false},
                {data: "pap_inteiro_alt", "visible": false},
                {data: "pap_inteiro_larg", "visible": false},
                {data: "modelo_codigo", "visible": true},
                {data: "modelo_nome", "visible": false},
                {data: "altura_final", "visible": false},
                {data: "larguar_final", "visible": false},
                {data: "formato", "visible": true, "orderable": false},
                {data: "empastamento_borda", "visible": false},
                {data: "composicao", "visible": false}
            ],
            columnDefs: [{
                    targets: 5,
                    searchable: false,
                    orderable: true,
                    className: 'dt-body-center add',
                    render: function (data, type, full, meta) {
                        return '<input type="number" id="" name="" class="form-control" style="width:90px" min="0" step="1" value="' + $('<div/>').text(data).html() + '">';
                    }
                }],
        });
        $("#md_papel_lista_personalizado").modal();
    }
    function selecionar_linhas(tabela) {

        tabela.rows().select();
    }
    function limpar_selecao(tabela) {

        tabela.rows().deselect();
    }
    function get_selecao(tabela) {
        var rows_data = tabela.rows({selected: true}).data();
        var orcamento = [];
        var adicional = [];

        $.each(rows_data, function (index, val) {
            if (val.adicional == "1") {
                adicional.push(val.ad_produto_id);
            } else {
                orcamento.push(val.produto_id);
            }
        });
        var selecao = {
            adicionais: adicional,
            orcamentos: orcamento
        };
        return selecao;
    }
    function filter_reset(tabela) {
        if (typeof tabela !== "undefined") {
            $('#form-filter')[0].reset();
            check_filter_dirty();
            tabela.ajax.reload(null, false);
        }
    }
    function get_convite_papeis(orcamento_convite, adicional_convite) {
        $.ajax({
            url: '<?= base_url('calendario/ajax_get_convite_detalhes') ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                orcamento_convite: JSON.stringify(orcamento_convite),
                adicional_convite: JSON.stringify(adicional_convite)
            },
        })
                .done(function (data) {
                    console.log("success");
                    console.log(data.convite);
                    console.log(data.adicional);
                    console.log(data.query);
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
    }
    function empty_rows_message() {

        alert('Nenhuma linha foi selecionada! Selecione uma ou mais linhas para continuar.');
    }
    function set_status(action) {
        if (!is_checkbox_checked()) {
            alert('Ative os status que deseja alterar!');
            return false;
        }
        var tab_active = $(".nav-tabs li.active a")[0].hash;
        var tabela;
        var produto;
        if (tab_active === "#convite") {
            tabela = tb_calendario_convite;
            produto = 'convite';
        } else if (tab_active === "#personalizado") {
            tabela = tb_calendario_personalizado;
            produto = 'personalizado';
        } else if (tab_active === "#produto") {
            tabela = tb_calendario_produto;
            produto = 'produto';
        }
        var selecao = get_selecao(tabela);
        selecao = JSON.stringify(selecao);
        $.ajax({
            url: '<?= base_url('calendario/ajax_set_status/') ?>' + action,
            type: 'POST',
            dataType: 'json',
            data: $("#form_status").serialize() + "&selecao=" + selecao + "&produto=" + produto,
        })
                .done(function (data) {
                    console.log("success");
                    if (data.status) {
                        limpar_selecao(tabela);
                        tabela.ajax.reload(null, false);
                        $("#md_status").modal('hide');
                        $("#form_status")[0].reset();
                    }
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
    }
    function is_checkbox_checked() {
        var count = 0;
        $("#form_status input").each(function (index, el) {
            if ($("#form_status input")[index].checked) {
                count++;
            }
        });
        if (count > 0) {
            return true;
        }
        return false;
    }
</script>