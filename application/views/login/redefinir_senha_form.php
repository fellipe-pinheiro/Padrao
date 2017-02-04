<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <?= get_flashdata() ?> 
        <h1>Criar nova senha</h1>
        <?= form_open(base_url("login/redefinir_senha")) ?>
        <?= form_hidden('codigo', $dados["codigo"]) ?>
        <?= form_hidden('id', $dados["id"]) ?>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" class="form-control" autofocus placeholder="Senha">
        </div>
        <div class="form-group">
            <label for="confirmar_senha">Confirmar Senha</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control"  placeholder="Confirmar senha">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
        <?= form_close() ?>
    </div>
</div>