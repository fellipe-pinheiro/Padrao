<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$pedido = $dados['pedido'];
$orcamento = $pedido->orcamento;
$cliente = $orcamento->cliente;
$assessor = $orcamento->assessor;
$convites = $orcamento->convite;
$personalizados = $orcamento->personalizado;
$produtos = $orcamento->produto;
$loja = $orcamento->loja;
?>
<!-- Cabeçalho-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?= $pedido->get_numero_documento() ?>
                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- Cliente -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>RG</th>
                                        <th>CPF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $cliente->id ?></td>
                                        <td><?= $cliente->nome ?> <?= $cliente->sobrenome ?></td>
                                        <td><?= $cliente->email ?></td>
                                        <td><?= $cliente->telefone ?></td>
                                        <td><?= $cliente->rg ?></td>
                                        <td><?= $cliente->cpf ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Produtos -->
<div class="row" id="produtos">
    <div class="col-md-12">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="tab-indice">
                <li role="presentation" class="active">
                    <a href="#pedido" aria-controls="pedido" role="tab" data-toggle="tab"><?= $pedido->get_numero_documento() ?></a>
                </li>
            </ul>

            <!-- Tab Pedido -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="pedido">
                    <!-- Menu -->
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Menu
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a onclick="modal_adicional()" href="javascript:void(0)">Novo Adicional</a></li>
                                    <li><a onclick="modal_cancelar_pedido(<?= $pedido->cancelado ?>)" href="javascript:void(0)">Cancelar</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Tabela -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <h4>Produtos</h4>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categoria</th>
                                            <th>Produto</th>
                                            <th class="input_data_entrega">Entrega</th>
                                            <th>Qtd</th>
                                            <th>Unitário</th>
                                            <th>Sub-total</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        //CONVITES
                                        foreach ($convites as $key => $convite) {
                                            ?>
                                            <tr class="tr-cancelado-<?= $convite->cancelado ?>">
                                                <td><?= $count ?></td>
                                                <td>Convite</td>
                                                <td><?= $convite->modelo->nome ?></td>
                                                <td class="form-group">
                                                    <form id="convite-<?= $key ?>">
                                                        <input type="text" name="data_entrega-convite-<?= $key ?>" id="data_entrega-convite-<?= $key ?>" class="form-control datetimepicker input-cancelado-<?= $convite->cancelado ?>" value="<?= $convite->data_entrega ?>" onchange="alterar_data_entrega('convite', 'convite-<?= $key ?>', event)">
                                                        <span class="help-block"></span>
                                                        <input type="hidden" name="input_post" class="form-control" value="data_entrega-convite-<?= $key ?>">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $convite->id ?>">
                                                    </form>
                                                </td>
                                                <td><?= $convite->quantidade ?></td>
                                                <td>R$ <?= number_format($convite->calcula_unitario(), 2, ',', '.') ?></td>
                                                <td class="td-sub_total-convites-<?= $convite->id ?>-<?= $convite->cancelado ?> td-sub_total-geral-<?= $convite->cancelado ?>">R$ <?= number_format($convite->calcula_total(), 2, ',', '.') ?></td>
                                                <td>
                                                    <button class="btn btn-default btn-sm btn-cancelado-<?= $convite->cancelado ?>" onclick="alterar_produto('convite',<?= $convite->id ?>, '<?= $convite->modelo->nome ?>', '.td-sub_total-convites-<?= $convite->id ?>-0')"><span class="glyphicon glyphicon-pencil"></span>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-default btn-sm btn-cancelado-<?= $convite->cancelado ?>" onclick="modal_cancelamento_item('convite', '',<?= $convite->id ?>,<?= $convite->calcula_total() ?>,<?= $assessor->comissao ?>, '<?= $convite->modelo->nome ?>', false,<?= $pedido->id ?>, '.td-sub_total-convites-<?= $convite->id ?>-0', false)"><span class="glyphicon glyphicon-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $count ++;
                                        }
                                        //PERSONALIZADOS
                                        foreach ($personalizados as $key => $personalizado) {
                                            ?>
                                            <tr class="tr-cancelado-<?= $personalizado->cancelado ?>">
                                                <td><?= $count ?></td>
                                                <td>Personalizado</td>
                                                <td><?= $personalizado->modelo->nome ?></td>
                                                <td class="form-group">
                                                    <form id="personalizado-<?= $key ?>">
                                                        <input type="text" name="data_entrega-personalizado-<?= $key ?>" id="data_entrega-personalizado-<?= $key ?>" class="form-control datetimepicker input-cancelado-<?= $personalizado->cancelado ?>" value="<?= $personalizado->data_entrega ?>" onchange="alterar_data_entrega('personalizado', 'personalizado-<?= $key ?>', event)">
                                                        <span class="help-block"></span>
                                                        <input type="hidden" name="input_post" class="form-control" value="data_entrega-personalizado-<?= $key ?>">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $personalizado->id ?>">
                                                    </form>
                                                </td>
                                                <td><?= $personalizado->quantidade ?></td>
                                                <td>R$ <?= number_format($personalizado->calcula_unitario(), 2, ',', '.') ?></td>
                                                <td class="td-sub_total-personalizados-<?= $personalizado->id ?>-<?= $personalizado->cancelado ?> td-sub_total-geral-<?= $personalizado->cancelado ?>">R$ <?= number_format($personalizado->calcula_total(), 2, ',', '.') ?></td>
                                                <td>
                                                    <button class="btn btn-default btn-sm btn-cancelado-<?= $personalizado->cancelado ?>" onclick="alterar_produto('personalizado',<?= $personalizado->id ?>, '<?= $personalizado->modelo->nome ?>', '.td-sub_total-personalizados-<?= $personalizado->id ?>-0')"><span class="glyphicon glyphicon-pencil"></span>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-default btn-sm btn-cancelado-<?= $personalizado->cancelado ?>" onclick="modal_cancelamento_item('personalizado', '',<?= $personalizado->id ?>,<?= $personalizado->calcula_total() ?>,<?= $assessor->comissao ?>, '<?= $personalizado->modelo->nome ?>', false,<?= $pedido->id ?>, '.td-sub_total-personalizados-<?= $personalizado->id ?>-0', false)"><span class="glyphicon glyphicon-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $count ++;
                                        }
                                        //PRODUTOS
                                        foreach ($produtos as $key => $container) {
                                            ?>
                                            <tr class="tr-cancelado-<?= $container->cancelado ?>">
                                                <td><?= $count ?></td>
                                                <td><?= $container->produto->produto_categoria->nome ?></td>
                                                <td><?= $container->produto->nome ?></td>
                                                <td class="form-group">
                                                    <form id="produto-<?= $key ?>">
                                                        <input type="text" name="data_entrega-produto-<?= $key ?>" id="data_entrega-produto-<?= $key ?>" class="form-control datetimepicker input-cancelado-<?= $container->cancelado ?>" value="<?= $container->data_entrega ?>" onchange="alterar_data_entrega('produto', 'produto-<?= $key ?>', event)">
                                                        <span class="help-block"></span>
                                                        <input type="hidden" name="input_post" class="form-control" value="data_entrega-produto-<?= $key ?>">
                                                        <input type="hidden" name="id" class="form-control" value="<?= $container->id ?>">
                                                    </form>
                                                </td>
                                                <td><?= $container->quantidade ?></td>
                                                <td>R$ <?= number_format($container->calcula_unitario(), 2, ',', '.') ?></td>
                                                <td class="td-sub_total-produtos-<?= $container->id ?>-<?= $container->cancelado ?> td-sub_total-geral-<?= $container->cancelado ?>">R$ <?= number_format($container->calcula_total(), 2, ',', '.') ?></td>
                                                <td>
                                                    <button class="btn btn-default btn-sm btn-cancelado-<?= $container->cancelado ?>" onclick="alterar_produto('produto',<?= $container->id ?>, '<?= $container->produto->nome ?>', '.td-sub_total-produtos-<?= $container->id ?>-0')"><span class="glyphicon glyphicon-pencil"></span>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-default btn-sm btn-cancelado-<?= $container->cancelado ?>" onclick="modal_cancelamento_item('produto', '',<?= $container->id ?>,<?= $container->calcula_total() ?>,<?= $assessor->comissao ?>, '<?= $container->produto->nome ?>', false,<?= $pedido->id ?>, '.td-sub_total-produtos-<?= $container->id ?>-0', false)"><span class="glyphicon glyphicon-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $count ++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <?php
                                        if (empty($pedido->orcamento->desconto)) {
                                            $desconto = "0,00";
                                        } else {
                                            $desconto = number_format($pedido->orcamento->desconto, 2, ',', '.');
                                        }
                                        ?>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Descontos:</th>
                                            <th>R$ <?= $desconto ?></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($pedido->adicional)) {
                    foreach ($pedido->adicional as $key => $adicional) {
                        ?>
                        <script>
                            var a1 = $('<a href="#adicional-<?= $adicional->id ?>" aria-controls="adicional-<?= $adicional->id ?>" role="tab" data-toggle="tab" >').html("<?= $adicional->get_numero_documento()?>");
                            var li1 = $('<li role="presentation" />').html(a1);
                            li1.appendTo("#tab-indice");
                        </script>
                        <!-- Tab Adicional -->
                        <div role="tabpanel" class="tab-pane" id="adicional-<?= $adicional->id ?>">
                            <!-- Menu -->
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Menu
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a onclick="modal_cancelar_adicional(<?= $adicional->id ?>, '.td-sub_total-<?= $adicional->id ?>-0',<?= $adicional->cancelado ?>)" href="javascript:void(0)">Cancelar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <h4>Produtos</h4>
                                        <table class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Categoria</th>
                                                    <th>Produto</th>
                                                    <th class="input_data_entrega">Entrega</th>
                                                    <th>Qtd</th>
                                                    <th>Unitário</th>
                                                    <th>Sub-total</th>
                                                    <th>Excluir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                //CONVITES
                                                if (!empty($adicional->convite)) {
                                                    foreach ($adicional->convite as $key => $convite) {
                                                        ?>
                                                        <tr class="tr-cancelado-<?= $convite->cancelado ?>">
                                                            <td><?= $count ?></td>
                                                            <td>Convite</td>
                                                            <td><?= $convite->objeto->modelo->nome ?></td>
                                                            <td class="form-group">
                                                                <form id="convite-adicional-<?= $adicional->id ?>-<?= $key ?>">
                                                                    <input type="text" name="data_entrega-convite-adicional-<?= $adicional->id ?>-<?= $key ?>" id="data_entrega-convite-adicional-<?= $adicional->id ?>-<?= $key ?>" class="form-control datetimepicker input-cancelado-<?= $convite->cancelado ?>" value="<?= $convite->data_entrega ?>" onchange="alterar_data_entrega_adicional('convite', 'convite-adicional-<?= $adicional->id ?>-<?= $key ?>', event)">
                                                                    <span class="help-block"></span>
                                                                    <input type="hidden" name="input_post" value="data_entrega-convite-adicional-<?= $adicional->id ?>-<?= $key ?>">
                                                                    <input type="hidden" name="id" class="form-control" value="<?= $convite->id ?>">
                                                                </form>
                                                            </td>
                                                            <td><?= $convite->quantidade ?></td>
                                                            <td>R$ <?= number_format($convite->calcula_unitario(), 2, ',', '.') ?></td>
                                                            <!-- td-sub_total -->
                                                            <td class="td-sub_total-convites-<?= $convite->objeto->id ?>-<?= $convite->cancelado ?> td-sub_total-<?= $adicional->id ?>-<?= $convite->cancelado ?> td-sub_total-geral-<?= $convite->cancelado ?>">R$ <?= number_format($convite->calcula_total(), 2, ',', '.') ?></td>
                                                            <td>
                                                                <button class="btn btn-default btn-sm btn-cancelado-<?= $convite->cancelado ?>" onclick="modal_cancelamento_item('convite',<?= $convite->objeto->id ?>,<?= $convite->id ?>,<?= $convite->calcula_total() ?>,<?= $assessor->comissao ?>, '<?= $convite->objeto->modelo->nome ?>', true,<?= $adicional->id ?>, '', false)"><span class="glyphicon glyphicon-trash"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $count ++;
                                                    }
                                                }
                                                //PERSONALIZADOS
                                                if (!empty($adicional->personalizado)) {
                                                    foreach ($adicional->personalizado as $key => $personalizado) {
                                                        ?>
                                                        <tr class="tr-cancelado-<?= $personalizado->cancelado ?>">
                                                            <td><?= $count ?></td>
                                                            <td>Personalizado</td>
                                                            <td><?= $personalizado->objeto->modelo->nome ?></td>
                                                            <td class="form-group">
                                                                <form id="personalizado-adicional-<?= $adicional->id ?>-<?= $key ?>">
                                                                    <input type="text" name="data_entrega-personalizado-adicional-<?= $adicional->id ?>-<?= $key ?>" id="data_entrega-personalizado-adicional-<?= $adicional->id ?>-<?= $key ?>" class="form-control datetimepicker input-cancelado-<?= $personalizado->cancelado ?>" value="<?= $personalizado->data_entrega ?>" onchange="alterar_data_entrega_adicional('personalizado', 'personalizado-adicional-<?= $adicional->id ?>-<?= $key ?>', event)">
                                                                    <span class="help-block"></span>
                                                                    <input type="hidden" name="input_post" value="data_entrega-personalizado-adicional-<?= $adicional->id ?>-<?= $key ?>">
                                                                    <input type="hidden" name="id" class="form-control" value="<?= $personalizado->id ?>">
                                                                </form>
                                                            </td>
                                                            <td><?= $personalizado->quantidade ?></td>
                                                            <td>R$ <?= number_format($personalizado->calcula_unitario(), 2, ',', '.') ?></td>
                                                            <!-- td-sub_total -->
                                                            <td class="td-sub_total-personalizados-<?= $personalizado->objeto->id ?>-<?= $personalizado->cancelado ?> td-sub_total-<?= $adicional->id ?>-<?= $personalizado->cancelado ?> td-sub_total-geral-<?= $personalizado->cancelado ?>">R$ <?= number_format($personalizado->calcula_total(), 2, ',', '.') ?></td>
                                                            <td>

                                                                <button class="btn btn-default btn-sm btn-cancelado-<?= $personalizado->cancelado ?>" onclick="modal_cancelamento_item('personalizado',<?= $personalizado->objeto->id ?>,<?= $personalizado->id ?>,<?= $personalizado->calcula_total() ?>,<?= $assessor->comissao ?>, '<?= $personalizado->objeto->modelo->nome ?>', true,<?= $adicional->id ?>, '', false)"><span class="glyphicon glyphicon-trash"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $count ++;
                                                    }
                                                }
                                                //PRODUTOS
                                                if (!empty($adicional->produto)) {
                                                    foreach ($adicional->produto as $key => $container) {
                                                        ?>
                                                        <tr class="tr-cancelado-<?= $container->cancelado ?>">
                                                            <td><?= $count ?></td>
                                                            <td><?= $container->objeto->produto->produto_categoria->nome ?></td>
                                                            <td><?= $container->objeto->produto->nome ?></td>
                                                            <td class="form-group">
                                                                <form id="produto-adicional-<?= $adicional->id ?>-<?= $key ?>">
                                                                    <input type="text" name="data_entrega-produto-adicional-<?= $adicional->id ?>-<?= $key ?>" id="data_entrega-produto-adicional-<?= $adicional->id ?>-<?= $key ?>" class="form-control datetimepicker input-cancelado-<?= $container->cancelado ?>" value="<?= $container->data_entrega ?>" onchange="alterar_data_entrega_adicional('produto', 'produto-adicional-<?= $adicional->id ?>-<?= $key ?>', event)">
                                                                    <span class="help-block"></span>
                                                                    <input type="hidden" name="input_post" value="data_entrega-produto-adicional-<?= $adicional->id ?>-<?= $key ?>">
                                                                    <input type="hidden" name="id" class="form-control" value="<?= $container->id ?>">
                                                                </form>
                                                            </td>
                                                            <td><?= $container->quantidade ?></td>
                                                            <td>R$ <?= number_format($container->calcula_unitario(), 2, ',', '.') ?></td>
                                                            <!-- td-sub_total -->
                                                            <td class="td-sub_total-produtos-<?= $container->objeto->id ?>-<?= $container->cancelado ?> td-sub_total-<?= $adicional->id ?>-<?= $container->cancelado ?> td-sub_total-geral-<?= $container->cancelado ?>">R$ <?= number_format($container->calcula_total(), 2, ',', '.') ?></td>
                                                            <td>
                                                                <button class="btn btn-default btn-sm btn-cancelado-<?= $container->cancelado ?>" onclick="modal_cancelamento_item('produto',<?= $container->objeto->id ?>,<?= $container->id ?>,<?= $container->calcula_total() ?>,<?= $assessor->comissao ?>, '<?= $container->objeto->produto->nome ?>', true,<?= $adicional->id ?>, '', false)"><span class="glyphicon glyphicon-trash"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $count ++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <?php
                                                if (empty($adicional->desconto)) {
                                                    $desconto = "0,00";
                                                } else {
                                                    $desconto = number_format($adicional->desconto, 2, ',', '.');
                                                }
                                                ?>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Descontos:</th>
                                                    <th>R$ <?= $desconto ?></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_cancelamento">
    <form id="form_cancelamento" class="form" method="POST" accept-charset="utf-8">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Cancelamento</h4>
                </div>
                <div class="modal-body row">
                    <input type="hidden" id="input_md_cancel_owner" name="owner" value="">
                    <input type="hidden" id="input_md_cancel_id_origem" name="id_origem" value="">
                    <input type="hidden" id="input_md_cancel_id" name="id" value="">
                    <!-- Pedido/Adicional ID-->
                    <div class="form-group">
                        <label for="input_md_cancel_numero_documento" id="input_md_cancel_label_documento" class="control-label col-md-4">Pedido</label>
                        <div class="col-md-8">
                            <input type="text" id="input_md_cancel_numero_documento" name="cancel_numero_documento" class="form-control" value="" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- Nome do produto -->
                    <div class="form-group">
                        <?= form_label('Produto: ', 'cancel_produto', array('class' => 'control-label col-md-4')) ?>
                        <div class="col-md-8">
                            <input type="text" id="input_md_cancel_nome_produto" name="nome_produto" class="form-control" value="" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- Valor do produto -->
                    <div class="form-group">
                        <label for="input_md_cancel_valor_item" id="label_md_cancel_valor_item" class="control-label col-md-4">Valor item:</label>
                        <div class="col-md-8">
                            <input type="number" id="input_md_cancel_valor_item" name="valor_item" class="form-control" value="" step="0.01" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- Comissão do assessor -->
                    <div class="form-group">
                        <?= form_label('Custos administrativos: ', 'input_md_cancel_custos_adm', array('class' => 'control-label col-md-4')) ?>
                        <div class="col-md-8">
                            <input type="number" id="input_md_cancel_custos_adm" name="custos_adm" class="form-control" value="" step="0.01" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- Valor da multa -->
                    <div class="form-group">
                        <?= form_label('Valor da multa: ', 'multa_valor', array('class' => 'control-label col-md-4')) ?>
                        <div class="col-md-8">
                            <input type="number" name="multa_valor" id="multa_valor" class="form-control" value="" step="0.01" min="0.00" autofocus="true">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!--Descrição-->
                    <div class="form-group">
                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-4')) ?>
                        <div class="col-sm-8">
                            <?= form_textarea(array('name' => 'descricao', 'rows' => '4', 'id' => 'descricao', 'class' => 'form-control', 'placeholder' => 'Motivo do cancelamento')) ?>
                            <span class="help-block"></span>
                            <p class="pull-right"><span class="caracteres_descricao"></span> Restantes</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" id="btn_md_cancel_item" class="btn btn-default btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="md_adicional">
    <form class="form" id="form_adicional_pedido" accept-charset="utf-8">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Adicional do pedido</h4>
                </div>
                <div class="modal-body row">
                    <!-- Produtos -->
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Produtos
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>
                                                    <button type="button" class="btn btn-default btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Clique nos itens que deseja incluir no adicional do pedido. Os itens que não deseja incluir no adicional do pedido, deixe-o desativado.">
                                                        <span class="glyphicon glyphicon-info-sign"></span> Adicionar?
                                                    </button>
                                                </th>
                                                <th>Categoria</th>
                                                <th>Produto</th>
                                                <th class="input_data_entrega">Entrega</th>
                                                <th>Qtd</th>
                                                <th>
                                                    <button type="button" class="btn btn-default btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="O valor inserido será somado ao valor unitário.">
                                                        <span class="glyphicon glyphicon-info-sign"></span> Valor adicional
                                                    </button>
                                                </th>
                                                <th>Unitário</th>
                                                <th>Sub-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            //CONVITES
                                            foreach ($convites as $key => $convite) {
                                                if (!$convite->cancelado) {
                                                    ?>
                                                    <tr class="tr-cancelado-<?= $convite->cancelado ?>">
                                                        <td><?= $count ?></td>
                                                        <!-- Checkbox -->
                                                        <td class="form-group">
                                                            <input type="checkbox" data-group-cls="btn-group-sm" name="checkbox-adicional-convite-<?= $key ?>" id="checkbox-adicional-convite-<?= $key ?>" class="checkbox-adicional" value="1" onchange="desativar_linha('#checkbox-adicional-convite-<?= $key ?>', '.desativar_linha-convite-<?= $key ?>', '#td-sub_total-convite-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <td>Convite</td>
                                                        <td><?= $convite->modelo->nome ?></td>
                                                        <!-- Data de entrega -->
                                                        <td class="form-group">
                                                            <input type="text" name="data_entrega-adicional-convite-<?= $key ?>" id="data_entrega-adicional-convite-<?= $key ?>" class="form-control datetimepicker input-sm input-cancelado-<?= $convite->cancelado ?> desativar_linha-convite-<?= $key ?>" value="<?= $convite->data_entrega ?>" placeholder="dd/mm/yyyy">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <!-- Quantidade -->
                                                        <td class="form-group">
                                                            <input type="number" name="qtd-adicional-convite-<?= $key ?>" id="qtd-adicional-convite-<?= $key ?>" class="form-control input-sm input_qtd desativar_linha-convite-<?= $key ?>" min="1" placeholder="qtd" onchange="calcula_sub_total(<?= $convite->calcula_unitario() ?>, '#qtd-adicional-convite-<?= $key ?>', '#td-sub_total-convite-<?= $key ?>', '#valor_extra-adicional-convite-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <!-- Valor Extra -->
                                                        <td class="form-group">
                                                            <input type="number" name="valor_extra-adicional-convite-<?= $key ?>" id="valor_extra-adicional-convite-<?= $key ?>" class="form-control input-sm input_valor_extra desativar_linha-convite-<?= $key ?>" step="0.01" min="0" placeholder="R$ 0,00" onchange="calcula_sub_total(<?= $convite->calcula_unitario() ?>, '#qtd-adicional-convite-<?= $key ?>', '#td-sub_total-convite-<?= $key ?>', '#valor_extra-adicional-convite-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <td>R$ <?= number_format($convite->calcula_unitario(), 2, ',', '.') ?></td>
                                                        <td class="td-sub_total" id="td-sub_total-convite-<?= $key ?>"></td>
                                                    </tr>
                                                    <?php
                                                    $count ++;
                                                }
                                            }
                                            //PERSONALIZADOS
                                            foreach ($personalizados as $key => $personalizado) {
                                                if (!$personalizado->cancelado) {
                                                    ?>
                                                    <tr class="tr-cancelado-<?= $personalizado->cancelado ?>">
                                                        <td><?= $count ?></td>
                                                        <!-- Checkbox -->
                                                        <td  class="form-group">
                                                            <input type="checkbox" data-group-cls="btn-group-sm" name="checkbox-adicional-personalizado-<?= $key ?>" id="checkbox-adicional-personalizado-<?= $key ?>" class="checkbox-adicional" value="1" onchange="desativar_linha('#checkbox-adicional-personalizado-<?= $key ?>', '.desativar_linha-personalizado-<?= $key ?>', '#td-sub_total-personalizado-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <td>Personalizado</td>
                                                        <td><?= $personalizado->modelo->nome ?></td>
                                                        <!-- Data de entrega -->
                                                        <td class="form-group">
                                                            <input type="text" name="data_entrega-adicional-personalizado-<?= $key ?>" id="data_entrega-adicional-personalizado-<?= $key ?>" class="form-control input-sm datetimepicker input-cancelado-<?= $personalizado->cancelado ?> desativar_linha-personalizado-<?= $key ?>" value="<?= $personalizado->data_entrega ?>" placeholder="dd/mm/yyyy">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <!-- Quantidade -->
                                                        <td class="form-group">
                                                            <input type="number" name="qtd-adicional-personalizado-<?= $key ?>" id="qtd-adicional-personalizado-<?= $key ?>" class="form-control input-sm input_qtd desativar_linha-personalizado-<?= $key ?>" min="1" placeholder="qtd" onchange="calcula_sub_total(<?= $personalizado->calcula_unitario() ?>, '#qtd-adicional-personalizado-<?= $key ?>', '#td-sub_total-personalizado-<?= $key ?>', '#valor_extra-adicional-personalizado-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <!-- Valor Extra -->
                                                        <td class="form-group">
                                                            <input type="number" name="valor_extra-adicional-personalizado-<?= $key ?>" id="valor_extra-adicional-personalizado-<?= $key ?>" class="form-control input-sm input_valor_extra desativar_linha-personalizado-<?= $key ?>" step="0.01" min="0" placeholder="R$ 0,00" onchange="calcula_sub_total(<?= $personalizado->calcula_unitario() ?>, '#qtd-adicional-personalizado-<?= $key ?>', '#td-sub_total-personalizado-<?= $key ?>', '#valor_extra-adicional-personalizado-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <td>R$ <?= number_format($personalizado->calcula_unitario(), 2, ',', '.') ?></td>
                                                        <td class="td-sub_total" id="td-sub_total-personalizado-<?= $key ?>"></td>
                                                    </tr>
                                                    <?php
                                                    $count ++;
                                                }
                                            }
                                            //PRODUTOS
                                            foreach ($produtos as $key => $container) {
                                                if (!$container->cancelado) {
                                                    ?>
                                                    <tr class="tr-cancelado-<?= $container->cancelado ?>">
                                                        <td><?= $count ?></td>
                                                        <!-- Checkbox -->
                                                        <td class="form-group">
                                                            <input type="checkbox" data-group-cls="btn-group-sm" name="checkbox-adicional-produto-<?= $key ?>" id="checkbox-adicional-produto-<?= $key ?>" class="checkbox-adicional" value="1" onchange="desativar_linha('#checkbox-adicional-produto-<?= $key ?>', '.desativar_linha-produto-<?= $key ?>', '#td-sub_total-produto-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <td><?= $container->produto->produto_categoria->nome ?></td>
                                                        <td><?= $container->produto->nome ?></td>
                                                        <!-- Data de entrega -->
                                                        <td class="form-group">
                                                            <input type="text" name="data_entrega-adicional-produto-<?= $key ?>" id="data_entrega-adicional-produto-<?= $key ?>" class="form-control input-sm datetimepicker input-cancelado-<?= $container->cancelado ?> desativar_linha-produto-<?= $key ?>" value="<?= $container->data_entrega ?>" placeholder="dd/mm/yyyy">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <!-- Quantidade -->
                                                        <td class="form-group">
                                                            <input type="number" name="qtd-adicional-produto-<?= $key ?>" id="qtd-adicional-produto-<?= $key ?>" class="form-control input-sm input_qtd desativar_linha-produto-<?= $key ?>" min="1" placeholder="qtd" onchange="calcula_sub_total(<?= $container->calcula_unitario() ?>, '#qtd-adicional-produto-<?= $key ?>', '#td-sub_total-produto-<?= $key ?>', '#valor_extra-adicional-produto-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <!-- Valor Extra -->
                                                        <td class="form-group">
                                                            <input type="number" name="valor_extra-adicional-produto-<?= $key ?>" id="valor_extra-adicional-produto-<?= $key ?>" class="form-control input-sm input_valor_extra desativar_linha-produto-<?= $key ?>" step="0.01" min="0" placeholder="R$ 0,00" onchange="calcula_sub_total(<?= $container->calcula_unitario() ?>, '#qtd-adicional-produto-<?= $key ?>', '#td-sub_total-produto-<?= $key ?>', '#valor_extra-adicional-produto-<?= $key ?>')">
                                                            <span class="help-block"></span>
                                                        </td>
                                                        <td>R$ <?= number_format($container->calcula_unitario(), 2, ',', '.') ?></td>
                                                        <td class="td-sub_total" id="td-sub_total-produto-<?= $key ?>"></td>
                                                    </tr>
                                                    <?php
                                                    $count ++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="O valor será subtraido no final."></span> Descontos</td>
                                                <td class="form-group">
                                                    <input type="number" name="input-adicional-desconto" id="input-adicional-desconto" class="form-control input-sm input_desconto" step="0.01" min="0" placeholder="R$ 0,00" onchange="calcular_total()">
                                                    <span class="help-block"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Total</th>
                                                <th id="th-adicional-total_a_pagar"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Informações complementares -->
                    <div class="col-md-6" id="div_informacoes_complementares">
                        <div class="panel panel-default">
                            <div class="panel-heading">Informações complementares
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <div class="panel-body">
                                <div id="descricao-content">
                                    <div class="form-group">
                                        <?= form_label('Loja: ', 'loja', array('class' => 'control-label')) ?>
                                        <select name="loja" id="loja" class="form-control">
                                            <option value="" selected >Selecione</option>
                                            <?php foreach ($dados['lojas'] as $loja): ?>
                                                <option value="<?= $loja->id ?>"><?= $loja->unidade ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label')) ?>
                                        <?= form_textarea(array('name' => 'descricao', 'rows' => '4', 'id' => 'descricao', 'class' => 'form-control', 'placeholder' => 'Descrição (Opcional): descreva aqui alguma informação dos produtos')) ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Forma de pagamento -->
                    <div class="col-md-6" id="div_forma_pagamento">
                        <div class="panel panel-default">
                            <div class="panel-heading">Forma de pagamento
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <div class="panel-body">
                                <div id="forma-pagamento-content">
                                    <!-- Forma de pagamento -->
                                    <div class="form-group">
                                        <?= form_label('Forma de pagamento: ', 'forma_pagamento', array('class' => 'control-label')) ?>
                                        <select name="forma_pagamento" id="forma_pagamento" class="form-control"  autofocus onchange="get_quantidade_parcelas()">
                                            <option value="" selected >Selecione</option>
                                            <?php
                                            foreach ($dados['forma_pagamento'] as $key => $forma_pagamento) {
                                                ?>
                                                <option value="<?= $forma_pagamento->id ?>" data-parcelamento_maximo="<?=$forma_pagamento->parcelamento_maximo?>" data-valor_minimo="<?=$forma_pagamento->valor_minimo?>"><?= $forma_pagamento->nome ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <!-- Quantidade de parcelas -->
                                    <div class="form-group">
                                        <?= form_label('Quantidade de Parcelas: ', 'qtd_parcelas', array('class' => 'control-label')) ?>
                                        <select name="qtd_parcelas" id="qtd_parcelas" class="form-control">
                                            <option value="" selected>Selecione</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <!-- Primeiro vencimento -->
                                    <div class="form-group">
                                        <?= form_label('1º Vencimento: ', 'primeiro_vencimento', array('class' => 'control-label')) ?>
                                        <input type="text" name="primeiro_vencimento" id="primeiro_vencimento" class="form-control datetimepicker" value="<?=date('d/m/Y')?>">
                                        <span class="help-block"></span>
                                    </div>
                                    <!-- Próximos vencimentos -->
                                    <div class="form-group">
                                        <?= form_label('Próximos vencimentos: ', 'vencimento_dia', array('class' => 'control-label')) ?>
                                        <select name="vencimento_dia" id="vencimento_dia" class="form-control">
                                            <option value="" selected >Selecione</option>
                                            <option value="01">Todo dia 1</option>
                                            <option value="05">Todo dia 5</option>
                                            <option value="10">Todo dia 10</option>
                                            <option value="15">Todo dia 15</option>
                                            <option value="20">Todo dia 20</option>
                                            <option value="25">Todo dia 25</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <!--Condições-->
                                    <div class="form-group">
                                        <?= form_label('Condições: ', 'condicoes', array('class' => 'control-label')) ?>
                                        <?= form_textarea(array('name' => 'condicoes', 'rows' => '4', 'id' => 'condicoes', 'class' => 'form-control', 'placeholder' => 'Condições (opcional) : descreva aqui alguma condição de pagamento')) ?>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="limpar_modal_adicional()" type="button" class="btn btn-default"><span class="glyphicon glyphicon-erase"></span> Limpar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button onclick="criar_adicional_pedido()" type="button" class="btn btn-default btnSubmitAdicional btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<br>
<br>
<br>
<style>
    .input_data_entrega{
        width: 120px;
    }
    .input_qtd{
        width: 80px;
    }
    .input_desconto{
        width: 100px;
    }
    .input_valor_extra{
        width: 100px;
    }
</style>
<script type="text/javascript">

    var pedido_id = <?= $pedido->id ?>;
    var assessor_comissao = <?= $assessor->comissao ?>;
    var caracteres_descricao = 100;

    $(document).on("keydown", "#descricao", function () {
        var caracteresRestantes = caracteres_descricao;
        var caracteresDigitados = parseInt($(this).val().length);
        var caracteresRestantes = caracteresRestantes - caracteresDigitados;
        $(".caracteres_descricao").text(caracteresRestantes);
    });

    $(document).ready(function () {
        apply_this_document_ready();
    });

    function apply_this_document_ready() {
        desabilita_produto_cancelado();
        disable_button_adicional();
        $(".caracteres_descricao").text(caracteres_descricao);
        $('#input-adicional-desconto').attr("disabled", true);
        $.each($("#form_adicional_pedido input"), function (index, value) {
            if (value.type != 'checkbox') {
                $($("#form_adicional_pedido input")[index]).attr("disabled", true);
            }
        });
        $("#div_informacoes_complementares").hide();
        $("#div_forma_pagamento").hide();
        $('.datetimepicker').datetimepicker({
            format:'L'
        });
        $(".datetimepicker").on("dp.change", function (e) {
            $(e.target).trigger("change");
        });
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
        $(':checkbox').checkboxpicker();
        $("#qtd_parcelas").click(function (event) {
            if ($("#qtd_parcelas").val() == 1) {
                $("#vencimento_dia").attr("disabled", true);
                $("#vencimento_dia option[value='']").prop("selected", true);
            } else {
                $("#vencimento_dia").attr("disabled", false);
            }
        });
    }

    function criar_adicional_pedido() {
        disable_button_salvar();
        reset_errors();
        call_loadingModal("Criando o adicional...");
        $.ajax({
            url: '<?= base_url('pedido/ajax_criar_adicional_pedido/') ?>' + pedido_id,
            type: 'POST',
            dataType: 'JSON',
            data: $("#form_adicional_pedido").serialize(),
        })
        .done(function (data) {
            console.log("success");
            close_loadingModal();
            if (data.status) {
                $("#md_adicional").modal('hide');
                $("#form_adicional_pedido")[0].reset();
                atualizar();
                $.alert({
                    title: "Adicional N° " + data.adicional_id,
                    content: "<p>Seu pedido adicional foi criado com sucesso!</p>",
                    confirmButton: 'PDF',
                    confirm: function () {
                        window.open('<?= base_url('adicional/pdf/') ?>' + data.adicional_id, '_blank');
                    },
                })
            } else {
                $.alert({
                    title: "Atenção!",
                    content: "Alguns erros foram encontrados no formulário. Por favor corrija-os e envie novamente."
                });
                $.map(data.form_validation, function (value, index) {
                    $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                    $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                });
            }
        })
        .fail(function () {
            console.log("error");
            close_loadingModal();
        })
        .always(function () {
            enable_button_salvar();
            console.log("complete");
        });
    }

    function calcula_sub_total(valor_unitario, id_input_qtd, id_td_sub_total, id_input_valor_extra) {
        var total = 0;
        var qtd = 0;
        var valor_extra = 0;

        qtd = $(id_input_qtd).val();
        qtd = Number(qtd);

        valor_extra = $(id_input_valor_extra).val();
        valor_extra = Number(valor_extra);

        total = (valor_unitario + valor_extra) * qtd;
        total = parseFloat(total).toFixed(2);
        total = total.replace(".", ",");
        $(id_td_sub_total).html("R$ " + total);
        calcular_total();
    }

    function calcular_total() {
        var total = 0;
        var desconto = 0;

        $.each($(".td-sub_total"), function (index, value) {
            total += numberFormat($(".td-sub_total")[index].innerText);
        });

        desconto = $("#input-adicional-desconto").val();

        total += -desconto;
        total = parseFloat(total).toFixed(2);
        total = total.replace(".", ",");
        $("#th-adicional-total_a_pagar").html("R$ " + total);
        atualiza_quantidade_parcelas();
    }

    function calcular_total_itens_to_cancel(classe_itens) {
        var total = 0;

        $.each($(classe_itens), function (index, value) {
            total += numberFormat($(classe_itens)[index].innerText);
        });
        return total;
    }

    function calcular_custos_adm(valor) {
        var custos_adm = 0;
        custos_adm = parseFloat(valor / ((100 - assessor_comissao) / 100)).toFixed(5);
        custos_adm = custos_adm - valor;
        return custos_adm;
    }

    function modal_adicional() {

        $("#md_adicional").modal();
    }

    function alterar_produto(owner, produto_id, nome_produto, classe_itens) {
        $.confirm({
            title: 'Atenção!',
            content: 'Alterar algum item deste produto ou diminuir a quantidade irá encadear pedido e adicionais, se existir, o cancelamento do produto deste e direcionar à tela do orçamento com o respectivo produto. Deseja realmente realizar esta ação?',
            confirm: function () {
                call_loadingModal();
                $.ajax({
                    url: "<?= base_url('orcamento/ajax_create_order_with_client_and_product/') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        owner: owner,
                        produto_id: produto_id,
                        pedido_id: pedido_id
                    },
                })
                .done(function (data) {
                    console.log("success");
                    if (data.status) {
                        close_loadingModal();
                        modal_cancelamento_item(owner, '', produto_id, 0, assessor_comissao, nome_produto, false, pedido_id, classe_itens, true);
                    } else {
                        $.alert('Não foi possível criar um orçamento com o cliente e o produto que deseja alterar. Faça o processo manualmente.')
                    }
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });

            },
            cancel: function () {
                $.alert('Ação cancelada');
            }
        });
    }

    function alterar_data_entrega(owner, form, e) {
        e.preventDefault();
        reset_errors();
        $.ajax({
            url: '<?= base_url('pedido/ajax_alterar_data_entrega/') ?>' + owner,
            type: 'POST',
            dataType: 'JSON',
            data: $("#" + form).serialize(),
        })
        .done(function (data) {
            console.log("success");
            if (data.status) {
                $.alert("Data de entrega alterada com sucesso!");
                atualizar();
            } else {
                $.map(data.form_validation, function (value, index) {
                    $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                    $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                });
            }
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
    }

    function alterar_data_entrega_adicional(owner, form, e) {
        e.preventDefault();
        reset_errors();
        $.ajax({
            url: '<?= base_url('pedido/ajax_alterar_data_entrega_adicional/') ?>' + owner,
            type: 'POST',
            dataType: 'JSON',
            data: $("#" + form).serialize(),
        })
        .done(function (data) {
            console.log("success");
            if (data.status) {
                $.alert("Data de entrega alterada com sucesso!");
                atualizar();
            } else {
                $.map(data.form_validation, function (value, index) {
                    $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                    $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                });
            }
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });
    }

    function modal_cancelar_pedido(cancelado) {
        if (cancelado) {
            $.alert('Este Pedido N° ' + pedido_id + ' já foi cancelado!');
            return false;
        }
        var valor_total = 0;
        var custos_adm = 0;
        $.each($('.td-sub_total-geral-0'), function (index, value) {
            valor_total += numberFormat($('.td-sub_total-geral-0')[index].innerText);
        });
        valor_total = parseFloat(valor_total).toFixed(2);

        custos_adm = calcular_custos_adm(valor_total);
        custos_adm = parseFloat(custos_adm).toFixed(2);

        preenche_modal_cancelamento(null, null, pedido_id, 'Todos os produtos', pedido_id, valor_total, custos_adm, 'Valor total dos produtos', 'Pedido');
        $('#btn_md_cancel_item').attr("onclick", "cancelar_pedido(" + pedido_id + ")");
        $("#md_cancelamento").modal();
    }

    function modal_cancelar_adicional(id, td_sub_total, cancelado) {
        if (cancelado) {
            $.alert('Este Adicional N° ' + id + ' já foi cancelado!');
            return false;
        }
        var valor_total = 0;
        var custos_adm = 0;

        $.each($(td_sub_total), function (index, value) {
            valor_total += numberFormat($(td_sub_total)[index].innerText);
        });
        valor_total = parseFloat(valor_total).toFixed(2);

        custos_adm = calcular_custos_adm(valor_total);
        custos_adm = parseFloat(custos_adm).toFixed(2);

        preenche_modal_cancelamento(null, null, id, 'Todos os produtos', id, valor_total, custos_adm, 'Valor total dos produtos', 'Adicional');
        $('#btn_md_cancel_item').attr("onclick", "cancelar_adicional(" + id + ")");
        $("#md_cancelamento").modal();
    }

    function modal_cancelamento_item(owner, id_origem, id, input_valor_item, porcentagem_assessor, nome_produto, adicional, input_numero_documento, classe_itens, alterar) {
        reset_errors();

        var custos_adm = 0;
        var label_valor_item = "";
        var input_label_documento = "";

        if (adicional) {//boolean
            //Adicional
            custos_adm = calcular_custos_adm(input_valor_item);
            custos_adm = parseFloat(custos_adm).toFixed(2);
            input_valor_item = parseFloat(input_valor_item).toFixed(2);
            label_valor_item = 'Valor item:';
            input_label_documento = 'Adicional';
        } else {
            //Pedido
            var input_valor_item = 0;
            input_valor_item = calcular_total_itens_to_cancel(classe_itens);
            input_valor_item = parseFloat(input_valor_item).toFixed(2);

            custos_adm = calcular_custos_adm(input_valor_item);
            custos_adm = parseFloat(custos_adm).toFixed(2);
            label_valor_item = 'Valor total dos itens:';
            input_label_documento = 'Pedido';
        }
        preenche_modal_cancelamento(owner, id_origem, id, nome_produto, input_numero_documento, input_valor_item, custos_adm, label_valor_item, input_label_documento);
        if (alterar) {
            $('#btn_md_cancel_item').attr("onclick", "alterar_item()");
        } else {
            $('#btn_md_cancel_item').attr("onclick", "cancelar_item(" + adicional + ")");
        }
        $("#md_cancelamento").modal();
    }
    function preenche_modal_cancelamento(owner, id_origem, id, nome_produto, input_numero_documento, input_valor_item, custos_adm, label_valor_item, input_label_documento) {
        $("#form_cancelamento")[0].reset();
        $(".caracteres_descricao").text(caracteres_descricao);
        $("#input_md_cancel_owner").val(owner);
        $("#input_md_cancel_id_origem").val(id_origem);
        $("#input_md_cancel_id").val(id);
        $("#input_md_cancel_nome_produto").val(nome_produto);
        $("#input_md_cancel_numero_documento").val(input_numero_documento);
        $("#input_md_cancel_valor_item").val(input_valor_item);
        $("#input_md_cancel_custos_adm").val(custos_adm);
        $('#label_md_cancel_valor_item').text(label_valor_item);
        $("#input_md_cancel_label_documento").text(input_label_documento);
    }

    function cancelar_pedido(id) {
        $.confirm({
            title: 'Atenção!',
            content: 'Esta ação irá cancelar todos os produtos deste Pedido e todos os Adicionais ligados a este pedido.<p>Deseja realmente cancelar o Pedido N° ' + id + " ?</p>",
            confirmButton: 'Sim',
            cancelButton: 'Não',
            confirm: function () {
                call_loadingModal();
                $.ajax({
                    url: '<?= base_url('pedido/ajax_cancelar_pedido') ?>',
                    type: 'POST',
                    dataType: 'JSON',
                    data: $("#form_cancelamento").serialize(),
                })
                .done(function (data) {
                    close_loadingModal();
                    console.log("success: pedido/ajax_cancelar_pedido()");
                    if (data.status) {
                        $("#md_cancelamento").modal('hide');
                        $.alert('Pedido N° ' + id + ' cancelado com sucesso!');
                        atualizar();
                    } else {
                        $.map(data.form_validation, function (value, index) {
                            $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                            $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                        });
                    }
                })
                .fail(function () {
                    close_loadingModal();
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
            },
            cancel: function () {
            }
        });
    }

    function cancelar_adicional(id) {
        $.confirm({
            title: 'Atenção!',
            content: 'Esta ação irá cancelar todos os produtos deste Adicional.<p>Deseja realmente cancelar o Adicional N° ' + id + " ?</p>",
            confirmButton: 'Sim',
            cancelButton: 'Não',
            confirm: function () {
                call_loadingModal();
                $.ajax({
                    url: '<?= base_url('pedido/ajax_cancelar_adicional') ?>',
                    type: 'POST',
                    dataType: 'JSON',
                    data: $("#form_cancelamento").serialize(),
                })
                .done(function (data) {
                    close_loadingModal();
                    console.log("success: pedido/ajax_cancelar_adicional()");
                    if (data.status) {
                        $("#md_cancelamento").modal('hide');
                        $.alert('Adicional N° ' + id + ' cancelado com sucesso!');
                        atualizar();
                    } else {
                        $.map(data.form_validation, function (value, index) {
                            $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                            $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                        });
                    }
                })
                .fail(function () {
                    close_loadingModal();
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });
            },
            cancel: function () {
                $.alert('Ação cancelada.');
            }
        });
    }

    function cancelar_item(adicional) {
        if (adicional) {
            url = "<?= base_url('pedido/ajax_cancelar_adicional_item/') ?>" + pedido_id;
        } else {
            url = "<?= base_url('pedido/ajax_cancelar_pedido_item/') ?>" + pedido_id;
        }
        $.confirm({
            title: 'Confirme',
            content: 'Deseja realmente cancelar este produto?',
            confirmButton: 'Sim',
            cancelButton: 'Não',
            confirm: function () {
                disable_button_salvar();
                call_loadingModal("Cancelando o produto...");
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $("#form_cancelamento").serialize(),
                })
                .done(function (data) {
                    console.log("success");
                    close_loadingModal();
                    if (data.status) {
                        $("#form_cancelamento")[0].reset();
                        atualizar();
                        $("#md_cancelamento").modal('hide');
                        $.alert('Produto cancelado com sucesso');
                    } else {
                        $.map(data.form_validation, function (value, index) {
                            $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                            $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                        });
                    }
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                    enable_button_salvar();
                });
            },
            cancel: function () {
                $("#md_cancelamento").modal('hide');
            }
        });
    }

    function alterar_item() {
        disable_button_salvar();
        call_loadingModal("Cancelando o produto...");
        $.ajax({
            url: '<?= base_url('pedido/ajax_cancelar_pedido_item/') ?>' + pedido_id,
            type: 'POST',
            dataType: 'JSON',
            data: $("#form_cancelamento").serialize(),
        })
        .done(function (data) {
            console.log("success");
            close_loadingModal();
            if (data.status) {
                $("#form_cancelamento")[0].reset();
                $("#md_cancelamento").modal('hide');
                $.confirm({
                    title: 'Sucesso!',
                    content: 'Deseja ir para a página do orçamento realizar as alterações?',
                    confirm: function () {
                        window.location.replace("<?= base_url('orcamento/index') ?>");
                    },
                    cancel: function () {
                        atualizar();
                    }
                });
            } else {
                $.map(data.form_validation, function (value, index) {
                    $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                    $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                });
            }
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
            enable_button_salvar();
        });
    }

    function atualizar() {
        //location.reload();
        console.log("Função: atualizar()");
        call_loadingModal('Atualizando as informações...');
        $.ajax({
            url: '<?= base_url('pedido/editar/') ?>' + pedido_id,
            type: 'POST',
            dataType: 'html',
        })
        .done(function (data) {
            console.log("success: atualizar()");
            hash = $('#tab-indice li.active').children()[0].hash;
            $('#produtos').html($('#produtos', data).html());
            $('#form_adicional_pedido').html($('#form_adicional_pedido', data).html());
            $("#tab-indice a[href='" + hash + "']").tab('show');
        })
        .fail(function () {
            console.log("error: atualizar()");
        })
        .always(function (data) {
            console.log("complete: atualizar()");
            desabilita_produto_cancelado();
            close_loadingModal();
            apply_this_document_ready();
        });
    }

    function desabilita_produto_cancelado() {
        $(".tr-cancelado-1").addClass('danger');
        $(".input-cancelado-1").attr("disabled", true);
        $(".btn-cancelado-1").attr("disabled", true);
    }

    function reset_forms() {
        $.each($('.form'), function (index, value) {
            value.reset();
        });
    }

    function disable_button_adicional() {

        $('.btnSubmitAdicional').attr('disabled', true);
    }

    function enable_button_adicional() {

        $('.btnSubmitAdicional').attr('disabled', false);
    }

    function desativar_linha(id_checkbox, class_desativar_linha, td_sub_total) {
        var checkbox_true = 0;

        if (!$(id_checkbox).is(':checked')) {
            $.each($(class_desativar_linha), function (index, value) {
                if (index === 0) {
                    $($(class_desativar_linha)[index]).attr("disabled", true);
                } else {
                    $($(class_desativar_linha)[index]).val("").attr("disabled", true);
                }
            });
            $(td_sub_total).html("");
        } else {
            $.each($(class_desativar_linha), function (index, value) {
                $($(class_desativar_linha)[index]).attr("disabled", false);
            });
        }

        $.each($('.checkbox-adicional'), function (index, value) {
            if ($($('.checkbox-adicional')[index]).is(':checked')) {
                checkbox_true += 1;
            }
        });
        if (checkbox_true === 0) {
            $('#input-adicional-desconto').attr("disabled", true);
            $('#primeiro_vencimento').attr("disabled", false);
            $("#div_informacoes_complementares").slideUp();
            $("#div_forma_pagamento").slideUp();
            disable_button_adicional();
        } else {
            $('#input-adicional-desconto').attr("disabled", false);
            $('#primeiro_vencimento').attr("disabled", false);
            $("#div_informacoes_complementares").slideDown();
            $("#div_forma_pagamento").slideDown();
            enable_button_adicional();
        }
        calcular_total();
    }

    function get_quantidade_parcelas() {
        atualiza_quantidade_parcelas();
    }

    function atualiza_quantidade_parcelas() {
        var parcelamento_maximo = $("#forma_pagamento").find(':selected').data('parcelamento_maximo');
        var valor_minimo = $("#forma_pagamento").find(':selected').data('valor_minimo');
        var qtd_parcelas = $("#qtd_parcelas option:selected").val();

        var total = 0;
        var valor_parcela = 0;
        var data = [];
        total = numberFormat($('#th-adicional-total_a_pagar')[0].innerText);

        $('#qtd_parcelas').find('option').remove().end().append('<option value="" selected disabled>Selecione</option>');
        for (var i = 1; i <= parcelamento_maximo; i++) {
            valor_parcela = total / i;
            if(valor_parcela < valor_minimo){
                break;
            }
            valor_parcela = parseFloat(valor_parcela).toFixed(2);
            valor_parcela = valor_parcela.replace(".", ",");
            data.push({"value": i, "text": i + " x R$ " + valor_parcela});
        }
        $.each(data, function (i, item) {
            $("#qtd_parcelas").append($('<option>', {
                value: item.value,
                text: item.text
            }));
            if(item.value == qtd_parcelas){
                $("#qtd_parcelas option[value="+qtd_parcelas+"]").prop("selected","selected");
            }
        });
    }

    function limpar_modal_adicional() {
        reset_errors();
        $("#form_adicional_pedido")[0].reset();
        $.each($('.td-sub_total'), function (index, value) {
            $($(".td-sub_total")[index]).html("");
        });
        $("#th-adicional-total_a_pagar").html("");
    }
    
</script>