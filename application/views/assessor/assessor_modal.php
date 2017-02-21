<div class="modal fade" id="md_filtro_assessor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Filtro</h4>
            </div>
            <div class="modal-body">
                <form id="form-filter-assessor" class="form-horizontal">
                    <div class="form-group">
                        <label for="filtro_assessor_id" class="col-sm-3 control-label">ID</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="filtro_assessor_id" placeholder="ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filtro_assessor_nome" class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="filtro_assessor_nome" placeholder="Nome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filtro_assessor_sobrenome" class="col-sm-3 control-label">Sobrenome</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="filtro_assessor_sobrenome" placeholder="Sobrenome">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filtro_assessor_email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="filtro_assessor_email" placeholder="e-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filtro_assessor_telefone" class="col-sm-3 control-label">Telefone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control sp_celphones" id="filtro_assessor_telefone" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" id="" class="btn btn-default btn-reset"><i class="glyphicon glyphicon-erase"></i> Limpar filtro</button>
                <button type="button" id="btn-filter-assessor" class="btn btn-default"><i class="glyphicon glyphicon-filter"></i> Filtrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_assessor">
    <form action="#" method="POST" role="form" class="form-horizontal form_crud" id="form_assessor">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Assessor</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <div class="row">
                            <!--nome-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="nome" class="control-label">Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="" required="required" title="Nome" placeholder="Nome">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--sobrenome-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="sobrenome" class="control-label">Sobrenome:</label>
                                    <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="" required="required" title="Sobrenome" placeholder="Sobrenome">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--email-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="email" class="control-label">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" value="" required="required" title="Email" placeholder="Email">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--telefone-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="telefone" class="control-label">Telefone:</label>
                                    <input type="text" name="telefone" id="telefone" class="form-control sp_celphones" value="" required="required" title="Telefone" placeholder="Telefone">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--empresa-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="empresa" class="control-label">Empresa:</label>
                                    <input type="text" name="empresa" id="empresa" class="form-control" value=""  title="Nome da Empresa" placeholder="Nome da Empresa">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--comissao-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="comissao" class="control-label">Comissão / BV (%):</label>
                                    <input type="number" name="comissao" id="comissao" step="0.01" min="0" class="form-control" value="" required="required" title="Comissão" placeholder="Comissão em porcentagem. EX: 10">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--Descrição-->
                            <div class="col-sm-12">
                                <div class="form-group input-padding">
                                    <label for="descricao" class="control-label">Descrição:</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-default btnSubmit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>