<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url('home') ?>">Sistema</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedido<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url('pedido/lista') ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> Lista</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orçamento<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url('orcamento') ?>"><i class="fa fa-calculator" aria-hidden="true"></i> Orçamento</a>
                        </li>
                        <li>
                            <a href="<?= base_url('orcamento/lista') ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> Lista</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produtos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Modelos</li>
                        <li>
                            <a href="<?= base_url('convite_modelo') ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> Convite Modelo</a>
                        </li>
                        <li>
                            <a href="<?= base_url('personalizado_modelo') ?>"><i class="fa fa-paint-brush" aria-hidden="true"></i> Personalizado Modelo</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Matéria prima</li>
                        <li>
                            <a href="<?= base_url('acabamento') ?>"><i class="glyphicon glyphicon-scissors"></i> Acabamento</a>
                        </li>
                        <li>
                            <a href="<?= base_url('acessorio') ?>"><i class="fa fa-diamond" aria-hidden="true"></i> Acessório</a>
                        </li>
                        <li>
                            <a href="<?= base_url('cliche') ?>"><i class="glyphicon glyphicon-registration-mark"></i> Clichê</a>
                        </li>
                        <li>
                            <a href="<?= base_url('fita') ?>"><i class="glyphicon glyphicon-tag"></i> Fita</a>
                        </li>
                        <li>
                            <a href="<?= base_url('fonte') ?>"><i class="fa fa-font" aria-hidden="true"></i> Fonte</a>
                        </li>
                        <li>
                            <a href="<?= base_url('impressao') ?>"><i class="glyphicon glyphicon-print"></i> Impressão</a>
                        </li>
                        <li>
                            <a href="<?= base_url('laser') ?>"><i class="glyphicon glyphicon-flash"></i> Laser</a>
                        </li>
                        <li>
                        <li>
                            <a href="<?= base_url('papel') ?>"><i class="glyphicon glyphicon-file"></i> Papel</a>
                        </li>
                        <li>
                            <a href="<?= base_url('faca') ?>"><i class="fa fa-map-o" aria-hidden="true"></i> Faca</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Produtos</li>
                        <li>
                            <a href="<?= base_url('produto') ?>"><i class="glyphicon glyphicon-gift"></i> Produto</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administração<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url('assessor') ?>"><i class="fa fa-user-secret" aria-hidden="true"></i> Assessor</a>
                        </li>
                        <li>
                            <a href="<?= base_url('cliente') ?>"><i class="fa fa-users" aria-hidden="true"></i> Cliente</a>
                        </li>
                        <li>
                            <a href="<?= base_url('evento') ?>"><i class="glyphicon glyphicon-edit"></i> Evento</a>
                        </li>
                        <li>
                            <a href="<?= base_url('forma_pagamento') ?>"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Formas de pagamento</a>
                        </li>
                        <li>
                            <a href="<?= base_url('loja') ?>"><i class="glyphicon glyphicon-home"></i> Loja</a>
                        </li>
                        <li>
                            <a href="<?= base_url('mao_obra') ?>"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> Mão de obra</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Calendário<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url('calendario/entrega') ?>"><i class="fa fa-truck" aria-hidden="true"></i> Entregas</a>
                        </li>
                        <li>
                            <a href="<?= base_url('calendario/producao') ?>"><i class="fa fa-gavel" aria-hidden="true"></i> Produção</a>
                        </li>
                        <li>
                            <a data-toggle="modal" href='#md_calendario'><i class="fa fa-calendar" aria-hidden="true"></i> Calendário</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php 
                if (esta_logado()) { 
                    ?>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?= get_dados_usuario('first_name') ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li >
                                <a href="<?=base_url('usuario/detalhes')?>"><i class="fa fa-database" aria-hidden="true"></i> Meus dados</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?=base_url('usuario/gestao_usuarios')?>"><i class="fa fa-cogs" aria-hidden="true"></i> Gestão de usuários</a>
                            </li>
                            <li><?= anchor("sistema/index", "<i class='glyphicon glyphicon-cog'></i> Sistema</a>") ?></li>                        
                            <li class="divider"></li>
                            <li><?= anchor("login/logout", "<i class='glyphicon glyphicon-log-out'></i> Logout</a>") ?></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li><a href="<?=base_url('login/index')?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>