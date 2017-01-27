<div class="modal fade" id="md_form_cliente">
    <?= form_open("#", 'class="form-horizontal form_crud" id="form_cliente" role="form"') ?>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#fisica" aria-controls="fisica" role="tab" data-toggle="tab">Dados pessoais <i class="error_validation"></i></a>
                            </li>
                            <li role="presentation">
                                <a href="#juridica" aria-controls="juridica" role="tab" data-toggle="tab">Dados da empresa <i class="error_validation"></i></a>
                            </li>
                            <li role="presentation">
                                <a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço <i class="error_validation"></i></a>
                            </li>
                        </ul>
                        <div class="tab-content container-fluid">
                            <div role="tabpanel" class="tab-pane active" id="fisica">
                                <br>
                                <br>
                                <!--ID-->
                                <?= form_hidden('id') ?>
                                <div class="row">
                                    <!--Pessoa tipo-->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('*Pessoa: ', 'pessoa_tipo', array('class' => 'control-label')) ?>
                                            <select id="pessoa_tipo" name="pessoa_tipo"  class="form-control input-sm" autofocus="true">
                                                <option value="" selected>Selecione</option>
                                                <option value="fisica">Física</option>
                                                <option value="juridica">Jurídica</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Nome-->
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <?= form_label('*Nome: ', 'nome', array('class' => 'control-label')) ?>
                                            <?= form_input('nome', '', 'id="nome" class="form-control input-sm" placeholder="Nome do responsável"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Sobrenome-->
                                    <div class="col_margin_left col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('Sobrenome: ', 'sobrenome', array('class' => 'control-label ')) ?>
                                            <?= form_input('sobrenome', '', 'id="sobrenome" class="form-control input-sm" placeholder="Sobrenome"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>    
                                    <!--Email-->
                                    <div class="col_margin_left col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('*Email: ', 'email', array('class' => 'control-label ')) ?>
                                            <?= form_input('email', '', 'id="email" class="form-control input-sm" placeholder="Email"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Telefone-->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('*Telefone: ', 'telefone', array('class' => 'control-label ')) ?>
                                            <?= form_input('telefone', '', 'id="telefone1" class="form-control sp_celphones input-sm" placeholder="Telefone"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--RG-->
                                    <div class="col_margin_left col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('RG: ', 'rg', array('class' => 'control-label ')) ?>
                                            <?= form_input('rg', '', 'id="rg" class="form-control input-sm" placeholder="RG"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--CPF-->
                                    <div class="col_margin_left col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('CPF: ', 'cpf', array('class' => 'control-label ')) ?>
                                            <?= form_input('cpf', '', 'id="cpf" class="form-control cpf input-sm" placeholder="CPF"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>Opcional</h4>
                                <div class="row">
                                    <!--Nome2-->
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <?= form_label('Nome2: ', 'nome2', array('class' => 'control-label')) ?>
                                            <?= form_input('nome2', '', 'id="nome2" class="form-control input-sm" placeholder="Nome2"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Sobrenome2-->
                                    <div class="col_margin_left col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('Sobrenome2: ', 'sobrenome2', array('class' => 'control-label')) ?>
                                            <?= form_input('sobrenome2', '', 'id="sobrenome2" class="form-control input-sm" placeholder="Sobrenome2"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Email2-->
                                    <div class="col_margin_left col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('E-mail 2: ', 'email2', array('class' => 'control-label')) ?>
                                            <?= form_input('email2', '', 'id="email2" class="form-control input-sm" placeholder="Email2"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Telefone 2-->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('Telefone 2: ', 'telefone2', array('class' => 'control-label')) ?>
                                            <?= form_input('telefone2', '', 'id="telefone2" class="form-control sp_celphones input-sm" placeholder="Telefone2"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="juridica">
                                <br>
                                <br>
                                <div class="row">
                                    <!-- Razão Social -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?= form_label('Razão Social*: ', 'razao_social', array('class' => 'control-label ')) ?>
                                            <?= form_input('razao_social', '', 'id="razao_social" class="form-control input-sm" placeholder="Razão Social"') ?>
                                            <span class="help-block"></span>
                                        </div>  
                                    </div>
                                    <!-- CNPJ -->
                                    <div class="col_margin_left col-sm-5">
                                        <div class="form-group">
                                            <?= form_label('CNPJ: ', 'cnpj', array('class' => 'control-label ')) ?>
                                            <?= form_input('cnpj', '', 'id="cnpj" class="form-control input-sm cnpj" placeholder="CNPJ"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Inscrição Estadual -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('Inscrição Estadual: ', 'ie', array('class' => 'control-label ')) ?>
                                            <?= form_input('ie', '', 'id="ie" class="form-control input-sm" placeholder="Inscrição Estadual"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- Inscrição Municipal -->
                                    <div class="col_margin_left col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('Inscrição Municipal: ', 'im', array('class' => 'control-label ')) ?>
                                            <?= form_input('im', '', 'id="im" class="form-control input-sm" placeholder="Inscrição Municipal"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="endereco">
                                <br>
                                <br>
                                <div class="row">
                                    <!--Endereco-->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="endereco" class="control-label">Endereço</label>
                                            <input type="text" name="endereco" id="input_endereco" class="form-control input-sm" title="endereco" placeholder="Endereço">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Número-->
                                    <div class="col_margin_left col-sm-1">
                                        <div class="form-group">
                                            <?= form_label('Número: ', 'numero', array('class' => 'control-label ')) ?>
                                            <?= form_input('numero', '', 'id="numero" class="form-control input-sm" placeholder="Número"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Complemento-->
                                    <div class="col_margin_left col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('Complemento: ', 'complemento', array('class' => 'control-label ')) ?>
                                            <?= form_input('complemento', '', 'id="complemento" class="form-control input-sm" placeholder="Complemento"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Bairro-->
                                    <div class="col_margin_left col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('Bairro: ', 'bairro', array('class' => 'control-label ')) ?>
                                            <?= form_input('bairro', '', 'id="input_bairro" class="form-control input-sm" placeholder="Bairro"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Cidade-->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?= form_label('Cidade: ', 'cidade', array('class' => 'control-label ')) ?>
                                            <?= form_input('cidade', '', 'id="input_cidade" class="form-control input-sm" placeholder="Cidade"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Estado-->
                                    <div class="col_margin_left col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('Estado: ', 'estado', array('class' => 'control-label ')) ?>
                                            <input data-estado='<?=$dados['estados_json']?>' list="dl_estado" id="input_estado" name="estado" class="form-control input-sm"/>
                                            <datalist id="dl_estado">
                                                <?php foreach ($dados['estados'] as $estado): ?>
                                                    <option value="<?=$estado?>"></option>
                                                <?php endforeach ?>
                                            </datalist>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>

                                    <!--uf-->
                                    <div class="col_margin_left col-sm-1">
                                        <div class="form-group">
                                            <?= form_label('UF: ', 'uf', array('class' => 'control-label ')) ?>
                                            <input list="dl_uf" name="uf" id="input_uf" class="form-control input-sm"/>
                                            <datalist id="dl_uf">
                                                <?php foreach ($dados['estados'] as $uf =>$estado ): ?>
                                                    <option value="<?=$uf?>"></option>
                                                <?php endforeach ?>
                                            </datalist>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--Cep-->
                                    <div class="col_margin_left col-sm-3">
                                        <div class="form-group">
                                            <?= form_label('Cep: ', 'cep', array('class' => 'control-label ')) ?>
                                            <?= form_input('cep', '', 'id="input_cep" class="form-control input-sm cep" placeholder="Cep"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Observacao-->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?= form_label('Observação: ', 'observacao', array('class' => 'control-label ')) ?>
                                            <?= form_textarea(array('name'=>'observacao','rows'=>'3'), '', ' id="observacao"  class="form-control input-sm" placeholder="Observacão"') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>
<div class="modal fade" id="md_filtro_cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Filtro</h4>
            </div>
            <div class="modal-body">
                <form id="form-filter-cliente" class="form-horizontal">
                    <div class="form-group">
                    <label for="id" class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="filtro_id" placeholder="ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome" class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="filtro_nome" placeholder="Nome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sobrenome" class="col-sm-3 control-label">Sobrenome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="filtro_sobrenome" placeholder="Sobrenome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="filtro_email" placeholder="e-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefone" class="col-sm-3 control-label">Telefone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control sp_celphones" id="filtro_telefone" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cpf" class="col-sm-3 control-label">CPF</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control cpf" id="filtro_cpf" placeholder="000.000.000-00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cnpj" class="col-sm-3 control-label">CNPJ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control cnpj" id="filtro_cnpj" placeholder="00.000.000/0000-00">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" id="" class="btn btn-default btn-reset">Limpar Filtro</button>
                <button type="button" id="btn-filter-cliente" class="btn btn-default">Filtrar</button>
            </div>
        </div>
    </div>
</div>