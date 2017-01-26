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
                        <li><a href="<?= base_url('pedido/lista') ?>">Lista</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orçamento<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a href="<?= base_url('orcamento') ?>">Orçamento</a></li>
                        <li class=""><a href="<?= base_url('orcamento/lista') ?>">Lista</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produtos<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Modelos</li>
                        <li><a href="<?= base_url('convite_modelo') ?>">Convite Modelo</a></li>
                        <li><a href="<?= base_url('personalizado_modelo') ?>">Personalizado Modelo</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Matéria prima</li>
                        <li><a href="<?= base_url('acabamento') ?>">Acabamento</a></li>
                        <li><a href="<?= base_url('acessorio') ?>">Acessório</a></li>
                        <li><a href="<?= base_url('fita') ?>">Fita</a></li>
                        <li><a href="<?= base_url('impressao') ?>">Impressão</a></li>
                        <li><a href="<?= base_url('papel') ?>">Papel</a></li>
                        <li><a href="<?= base_url('fonte') ?>">Fonte</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Produtos</li>
                        <li><a href="<?= base_url('produto') ?>">Produto</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administração<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('assessor') ?>">Assessor</a></li>
                        <li><a href="<?= base_url('cliente') ?>">Cliente</a></li>
                        <li><a href="<?= base_url('evento') ?>">Evento</a></li>
                        <li><a href="<?= base_url('forma_pagamento') ?>">Formas de pagamento</a></li>
                        <li><a href="<?= base_url('loja') ?>">Loja</a></li>
                        <li><a href="<?= base_url('mao_obra') ?>">Mão de obra</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Calendário<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('calendario/index') ?>">Entregas</a></li>
                        <li><a href="<?= base_url('calendario/producao') ?>">Produção</a></li>
                        <li><a data-toggle="modal" href='#md_calendario'>Calendário</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p class="navbar-btn">
                        <div class="btn-group">
                            <?php 
                            if (esta_logado()) { 
                                ?>
                                <button type="button" class="btn btn-success"><i class=" glyphicon glyphicon-user"></i> <?= get_dados_usuario('first_name') ?></button>
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                    <i class="glyphicon glyphicon-cog"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li ><?= anchor("Usuario/detalhes", "Meus dados") ?></li>
                                    <li class="divider"></li>
                                    <li><?= anchor("Usuario/gestao_usuarios", "Gestão de úsuarios") ?></li>
                                    <li><?= anchor("Sistema/index", "<i class='glyphicon glyphicon-cog'></i> Sistema</a>") ?></li>                        
                                    <li class="divider"></li>
                                    <li><?= anchor("Login/logout", "<i class='glyphicon glyphicon-log-out'></i> Logout</a>") ?></li>
                                </ul>
                                <?php
                            } else {
                                $login = '<i class=" glyphicon glyphicon-user"></i> Login';
                                $attr = array('href' => base_url('Login/index'), 'type' => 'button', 'class' => 'btn btn-default');
                                print anchor('Login/index', $login, $attr);
                            }
                            ?>
                        </div>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</nav>