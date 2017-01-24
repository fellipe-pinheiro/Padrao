<?php
$usuario = $dados["usuario"];
?>
<style>
    dd { 
        margin-left: 40px;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Detalhes do usuario</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <dl>
                <dt>Nome Completo</dt>
                <dd><?= $usuario->get_full_name() ?></dd>
                <dt>Email</dt>
                <dd><?= $usuario->email ?></dd>
                <dt>Telefone</dt>
                <dd><?= $usuario->phone ?></dd>
                <dt>Usuario de sistema</dt>
                <dd><?= $usuario->username ?></dd>
            </dl>
        </div>
        <div class="col-md-6">
            <dl>
                <dt>Empresa</dt>
                <dd><?= $usuario->company ?></dd>
                <dt>Grupos</dt>
                <?php
                foreach ($usuario->get_groups() as $group) {
                    print "<dd>$group->name - $group->description</dd>";
                }
                ?>
                <dt>Último login</dt>
                <dd><?= date("d/m/Y H:i:s", $usuario->last_login) ?></dd>
                <dt>Usuario criado em</dt>
                <dd><?= date("d/m/Y H:i:s", $usuario->created_on) ?></dd>
            </dl>
        </div>
    </div>
</div>