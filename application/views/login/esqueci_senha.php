<div class="row">
    <div class="col-sm-offset-4 col-sm-4">
        <?= get_flashdata() ?> 


        <h1>Redefinir minha senha</h1>
        <p>Será enviado um email para redefinição de senha</p>

        <?= form_open(base_url("login/enviar_senha")) ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"id="email" name="email" class="form-control"  placeholder="Email">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
        <?= form_close() ?>
    </div>
</div>