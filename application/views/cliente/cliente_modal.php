<div class="modal fade" id="md_form_cliente">
    <form action="#" method="POST" role="form" class="form-horizontal form_crud" id="form_cliente">
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
                                <div class="row">
                                    <!--ID-->
                                    <input type="hidden" name="id" class="form-control">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!--pessoa_tipo-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="pessoa_tipo" class="control-label">Pessoa:</label>
                                                    <select id="pessoa_tipo" name="pessoa_tipo"  class="form-control" autofocus="true" required="required">
                                                        <option value="" selected>Selecione</option>
                                                        <option value="fisica">Física</option>
                                                        <option value="juridica">Jurídica</option>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!--nome-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="nome" class="control-label">Nome:</label>
                                                    <input type="text" name="nome" id="nome" class="form-control" value="" title="Nome do responsável" placeholder="Nome do responsável" required="required">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!--sobrenome-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="sobrenome" class="control-label">Sobrenome:</label>
                                                    <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="" title="Sobrenome do responsável" placeholder="Sobrenome do responsável" required="required">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!--email-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="email" class="control-label">Email:</label>
                                                    <input type="email" name="email" id="email" class="form-control" value="" title="Email" placeholder="Email" required="required">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!--telefone-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="telefone" class="control-label">Telefone:</label>
                                                    <input type="text" name="telefone" id="telefone" class="form-control sp_celphones" value="" title="Telefone" placeholder="Telefone" required="required">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!--rg-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="rg" class="control-label">RG:</label>
                                                    <input type="text" name="rg" id="rg" class="form-control" value="" title="RG" placeholder="RG">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!--cpf-->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                    <label for="cpf" class="control-label">CPF:</label>
                                                    <input type="text" name="cpf" id="cpf" class="form-control cpf" value="" title="CPF" placeholder="CPF">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!---->
                                            <div class="col-sm-3">
                                                <div class="form-group input-padding">
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <legend>Opcional</legend>
                                <div class="row">
                                    <!--nome2-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="nome2" class="control-label">Nome2:</label>
                                            <input type="text" name="nome2" id="nome2" class="form-control" value="" title="Segundo contato" placeholder="Segundo contato">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--sobrenome2-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="sobrenome2" class="control-label">sobrenome2:</label>
                                            <input type="text" name="sobrenome2" id="sobrenome2" class="form-control" value="" title="Sobrenome" placeholder="Sobrenome">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--email2-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="email2" class="control-label">Email2:</label>
                                            <input type="email" name="email2" id="email2" class="form-control" value="" title="Email do contato" placeholder="Email do contato">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--telefone2-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="telefone2" class="control-label">Telefone 2:</label>
                                            <input type="text" name="telefone2" id="telefone2" class="form-control sp_celphones" value="" title="Telefone 2" placeholder="Telefone 2">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="juridica">
                                <br>
                                <div class="row">
                                    <!--razao_social-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="razao_social" class="control-label">Razão Social:</label>
                                            <input type="text" name="razao_social" id="razao_social" class="form-control" value="" title="Razão Social" placeholder="Razão Social">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--cnpj-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="cnpj" class="control-label">CNPJ:</label>
                                            <input type="text" name="cnpj" id="cnpj" class="form-control cnpj" value="" title="CNPJ" placeholder="CNPJ">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--ie-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="ie" class="control-label">Inscrição Estadual:</label>
                                            <input type="text" name="ie" id="ie" class="form-control ie" value="" title="Inscrição Estadual" placeholder="Inscrição Estadual">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--im-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="im" class="control-label">Inscrição Municipal:</label>
                                            <input type="text" name="im" id="im" class="form-control im" value="" title="Inscrição Municipal" placeholder="Inscrição Municipal">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="endereco">
                                <br>
                                <div class="row">
                                    <div class="col-ssm-12">
                                        <!--endereco-->
                                        <div class="col-sm-3">
                                            <div class="form-group input-padding">
                                                <label for="endereco" class="control-label">Logradouro:</label>
                                                <input type="text" name="endereco" id="input_endereco" class="form-control" value="" title="Logradouro" placeholder="Logradouro">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <!--numero-->
                                        <div class="col-sm-3">
                                            <div class="form-group input-padding">
                                                <label for="numero" class="control-label">Número:</label>
                                                <input type="text" name="numero" id="numero" class="form-control" value="" title="Número" placeholder="Número">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <!--complemento-->
                                        <div class="col-sm-3">
                                            <div class="form-group input-padding">
                                                <label for="complemento" class="control-label">Complemento:</label>
                                                <input type="text" name="complemento" id="complemento" class="form-control" value="" title="Complemento" placeholder="Complemento">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <!--bairro-->
                                        <div class="col-sm-3">
                                            <div class="form-group input-padding">
                                                <label for="bairro" class="control-label">Bairro:</label>
                                                <input type="text" name="bairro" id="input_bairro" class="form-control" value="" title="Bairro" placeholder="Bairro">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--cidade-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="cidade" class="control-label">Cidade:</label>
                                            <input type="text" name="cidade" id="input_cidade" class="form-control" value="" title="Cidade" placeholder="Cidade">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--estado-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="estado" class="control-label">Estado:</label>
                                            <input data-estado='<?=$dados['estados_json']?>' list="dl_estado" id="input_estado" name="estado" class="form-control">
                                            <datalist id="dl_estado">
                                                <?php foreach ($dados['estados'] as $estado): ?>
                                                    <option value="<?=$estado?>"></option>
                                                <?php endforeach ?>
                                            </datalist>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--uf-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="uf" class="control-label">UF:</label>
                                            <input list="dl_uf" name="uf" id="input_uf" class="form-control">
                                            <datalist id="dl_uf">
                                                <?php foreach ($dados['estados'] as $uf =>$estado ): ?>
                                                    <option value="<?=$uf?>"></option>
                                                <?php endforeach ?>
                                            </datalist>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!--cep-->
                                    <div class="col-sm-3">
                                        <div class="form-group input-padding">
                                            <label for="cep" class="control-label">CEP:</label>
                                            <input type="text" name="cep" id="input_cep" class="form-control cep" value="" title="CEP" placeholder="CEP">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--observacao-->
                                    <div class="col-sm-12">
                                        <div class="form-group input-padding">
                                            <label for="observacao" class="control-label">Observação:</label>
                                            <textarea name="observacao" id="observacao" class="form-control" rows="3" placeholder="Observação"></textarea>
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
                <button type="button" class="btn btn-default btn-reset"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</button>
                <button type="button" id="btn-filter-cliente" class="btn btn-default"><i class="glyphicon glyphicon-filter"></i> Filtrar</button>
            </div>
        </div>
    </div>
</div>