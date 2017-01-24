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
                <button type="button" id="" class="btn btn-default btn-reset">Limpar Filtro</button>
                <button type="button" id="btn-filter-assessor" class="btn btn-default">Filtrar</button>
            </div>
        </div>
    </div>
</div>