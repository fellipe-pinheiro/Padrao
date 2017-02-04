<!DOCTYPE html>
<html>
    <?php include '__heade.php'; ?>
    <body>
        <div class="container">
            <div class="container">
                <div class="row header">
                    <h1>OrcaSistemas</h1>
                </div>
            </div>
            <div class="container">
                <div class="row body">
                    <h2>Novo usuário cadastrado</h2>
                    <p>
                        Usuário acb@acb.com cadastrado no sistema da empresa ABCD.
                    </p>
                    <p>
                        Apos ativação poderar acessar o sistema pelo link <a href="http://orcasistemas.com.br">orcasistemas.com.br</a>.
                    </p>
                    <pre>
                        <?= var_dump($view_data) ?>
                    </pre>
                </div>
            </div>

            <?php include '__footer.php'; ?>
        </div>
    </body>
</html>
