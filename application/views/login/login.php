<div class="row">
    <div class="col-md-offset-4 col-md-4">
        <?= get_flashdata() ?> 
        <div class="panel panel-default"  style="min-width: 330px;">
            <div class="panel-body text-center">
                <?= form_open(base_url('login/logar'), 'class="form-signin"') ?>
                <?= form_hidden('redirecionar', $this->session->userdata('redirecionar')) ?>
                <p><?= img(array('src' => '/assets/imagens/logo_cgolin.png', 'alt' => 'Logo da empresa', 'class' => '', 'width' => '300', 'height' => 'auto', 'title' => 'Logo da empresa')); ?></p>
                <?= form_error('senha') ?>
                <p>
                    <?= form_label('Usuário/Email: ', 'identity', array('class' => 'sr-only')) ?>
                    <?= form_input('login', set_value('login'), ' id="login" class="form-control" placeholder="Usuário/Email" autofocus required') ?>
                </p>
                <p>
                    <?= form_label('Senha: ', 'senha', array('class' => 'sr-only')) ?>
                    <?= form_password('senha', '', ' id="senha" class="form-control" placeholder="Senha"') ?>
                </p>
                <p>
                    <?= form_label('Lembrar senha? ', 'remember') ?>
                    <?= form_checkbox('remember', '1', TRUE, 'id="remember"'); ?>
                </p>
                <hr>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                <?= form_close() ?>

            </div>
        </div>
        <div>
            <?= anchor(base_url("login/esqueci_senha"), "Esqueci minha senha") ?>
        </div>
    </div>
</div>