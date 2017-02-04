<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '__heade.php'; ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Orca Sistemas</h1>
                <h3>Redefinicão de senha solicitada</h3>
                <a href="<?= base_url("login/redefinir_senha_form/" . $view_data["codigo"]) ?>" class="btn btn-group-lg btn-primary">
                    Redefinir senha
                </a>
            </div>
        </div>
        <?php include '__footer.php'; ?>
    </body>
</html>
