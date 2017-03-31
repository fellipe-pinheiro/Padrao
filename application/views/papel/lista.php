<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-papel-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Papel</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-papel-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)" id="adicionar"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0)" id="editar"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav nav-filtro-papel">
                        <li>
                            <a href="javascript:void(0)" onclick="show_filtro_papel()"><i class="glyphicon glyphicon-filter"></i> Filtro</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav nav-filtro-papel">
                        <li>
                            <a href="javascript:void(0)" onclick="filtro('reset')"><i class="glyphicon glyphicon-erase"></i> Limpar Filtro</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-trash"></i><b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="javascript:void(0)" id="deletar"><i class="glyphicon glyphicon-trash"></i> Excluir</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="col-md-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab_papel" aria-controls="tab_papel" role="tab" data-toggle="tab">Papel</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_linha" aria-controls="tab_linha" role="tab" data-toggle="tab">Linha</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_acabamento" aria-controls="tab_acabamento" role="tab" data-toggle="tab">Acabamento</a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_dimensao" aria-controls="tab_dimensao" role="tab" data-toggle="tab">Dimensão</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab_papel">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_papel" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Linha</th>
                                            <th>Papel</th>
                                            <th>Altura (mm)</th>
                                            <th>Largura (mm)</th>
                                            <th>Gramaturas (g)</th>
                                            <th>Descrição</th>
                                            <th>Ativo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_linha">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_linha" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Ativo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_acabamento">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_acabamento" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Qtd Mínima</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_dimensao">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="tb_dimensao" class="table display compact table-bordered " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Altura (mm)</th>
                                            <th>Largura (mm)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_papel">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_papel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Papel</h4>
                </div>
                <nav class="navbar navbar-default navbar-static-top" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-papel-menu">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="navbar-brand"></div>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-papel-menu">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="javascript:void(0)" id="add_gramatura"><i class="glyphicon glyphicon-plus"></i> Gramatura</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <div class="row">
                            <!--ativo-->
                            <div class="col-sm-12">
                                <div class="form-group input-padding">
                                    <label for="ativo" class="control-label">Papel ativo:</label>
                                    <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--nome-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="nome" class="control-label">Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome do papel" pattern=".{1,50}" title="Máximo de 50 caracteres" autofocus>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--papel_linha-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="papel_linha" class="control-label">Linha:</label>
                                    <select name="papel_linha" id="papel_linha" class="form-control selectpicker" data-live-search="true" required="required" autofocus>
                                        <option value="" disabled selected>Selecione</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--papel_dimensao-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="papel_dimensao" class="control-label">Dimensão:</label>
                                    <select name="papel_dimensao" id="papel_dimensao" class="form-control selectpicker" data-live-search="true" required="required">
                                        <option value="" disabled selected>Selecione</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <!--Papel Gramatura-->
                        <div class="form-group hidden" id="default_gramatura_div">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <div class="form-group input-padding" id="default_checkbox_input">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-trash"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" id="default_button_excluir">Excluir</a></li>
                                                </ul>
                                            </div>
                                            <input step="1" type="number" min="0" name="" id="default_gramatura_input" class="form-control" placeholder="Gramatura ex: 80">
                                            <div class="input-group-addon">g</div>
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group input-padding">
                                        <div class="input-group">
                                            <div class="input-group-addon">R$</div>
                                            <input step="0.01" type="number" min="0" name="" id="default_valor_input" class="form-control" placeholder="Valor ex: 3,20">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div id="lista_gramaturas" class="row">
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
<div class="modal fade" id="md_linha">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_linha">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Linha</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--ativo-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="ativo" class="control-label">Ativo:</label>
                                <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--nome-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="nome" class="control-label">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome da linha" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--Descrição-->
                        <div class="col-sm-12">
                            <div class="form-group input-padding">
                                <label for="descricao" class="control-label">Descrição:</label>
                                <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                                <span class="help-block"></span>
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
<div class="modal fade" id="md_acabamento">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_acabamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Papel Acabamento</h4>
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
                                    <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome do acessório" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--codigo-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="codigo" class="control-label">Código:</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control" value="" required="required" title="Utilize no mínimo 3 e máximo 20 caracteres sendo somente letras minúsculas [a-z], sem acentuação, números [0-9] e sem espaçamento." placeholder="Ex: mod123" pattern="[a-z0-9_]{3,30}$">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--qtd_minima-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="qtd_minima" class="control-label">Quantidade mínima:</label>
                                    <input type="number" name="qtd_minima" id="qtd_minima" step="1" min="1" class="form-control" value="" required="required" title="Quantidade mínima" placeholder="Quantidade mínima">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--valor-->
                            <div class="col-sm-6">
                                <div class="form-group input-padding">
                                    <label for="valor" class="control-label">Valor:</label>
                                    <input type="number" name="valor" step="0.01" min="0" class="form-control" value="" required="required" title="Valor" placeholder="Valor">
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
<div class="modal fade" id="md_dimensao">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_dimensao">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Dimensões de papéis</h4>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" class="form-control">
                        <!--altura-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="altura" class="control-label">Altura (mm):</label>
                                <input type="number" name="altura" id="altura" class="form-control" value="" required="required" title="Utilize somente números de até 4 dígitos" min="0" max="9999" placeholder="Altura do papel inteiro Ex: 660" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!--largura-->
                        <div class="col-sm-6">
                            <div class="form-group input-padding">
                                <label for="largura" class="control-label">Largura (mm):</label>
                                <input type="number" name="largura" id="largura" class="form-control" value="" required="required" title="Utilize somente números de até 4 dígitos" min="0" max="9999" placeholder="Largura do papel inteiro Ex: 960">
                                <span class="help-block"></span>
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
<div class="modal fade" id="md_acabamento_docs">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Documentação</h4>
            </div>
            <div class="modal-body">
                <p>Configurar a tabela conforme a tabela da documentação. Cada item deverá ter o mesmo código desta tabela</p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Empastamento</td>
                            <td>empastamento</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Laminação</td>
                            <td>laminacao</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Relevo Seco</td>
                            <td>relevo_seco</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Corte Vinco</td>
                            <td>corte_vinco</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Almofada / Bandeja</td>
                            <td>almofada</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Douração</td>
                            <td>douracao</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Corte Laser</td>
                            <td>corte_laser</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Faca</td>
                            <td>faca</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md_filtro_papel">
    <form id="form-filter-papel" class="form-horizontal form-filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Filtro</h4>
                </div>
                <nav class="navbar navbar-default navbar-static-top" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-acabamento-menu">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="navbar-brand"></div>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-acabamento-menu">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="javascript:void(0)" class="btn-reset" onclick="filtro('reset')"><i class="glyphicon glyphicon-erase"></i> Limpar Filtro</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="papel-filtro_linha" class="control-label"> Linha</label>
                                    <select id="papel-filtro_linha" class="form-control selectpicker" data-live-search="true">
                                        <option value="">Selecione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="papel-filtro_papel" class="control-label"> Papel</label>
                                    <input type="text" id="papel-filtro_papel" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="papel-filtro_altura" class="control-label"> Papel Altura</label>
                                    <input type="number" min="0" class="form-control" id="papel-filtro_altura" placeholder="Papel Altura">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="papel-filtro_largura" class="control-label"> Papel Largura</label>
                                    <input type="number" min="0" class="form-control" id="papel-filtro_largura" placeholder="Papel Largura">
                                </div>
                            </div>
                        </div>
                    </fieldset>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-default" onclick="filtro('filtrar')">
                        <span class="glyphicon glyphicon-filter"></span> Filtrar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('_include/dataTable'); ?>
<style>
    .tab-pane{
        margin-top: 30px;
    }
    .gramatura_add{
        padding-bottom: 10px;
    }
    .gramatura_group{
        margin-bottom: 0px !important;
    }
</style>
<script type="text/javascript">

    var tb_papel;
    var tb_linha;
    var tb_acabamento;
    var tb_dimensao;
    var tab_active;
    var dataTable;
    var md_form;
    var modal_title;
    var url_edit;
    var save_method;
    var url_add;
    var url_update;
    var form;
    var count_gramatura = 0;
    var visible_gramatura = 0;
    var papel_atualizar = true;

    $(document).ready(function() {
        tb_papel = $("#tb_papel").DataTable({
            scrollX: true,
            scrollY:"500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
                {   
                    extend:'colvis',
                    text:'Visualizar colunas'
                },
                {
                    extend: 'collection',
                    text: 'Exportar',
                    autoClose: true,
                    buttons: [
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                    ],
                    fade: true
                }
            ],
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('papel/ajax_list') ?>",
                type: "POST",
                data: function ( data ) {
                    data.filtro_papel = $('#papel-filtro_papel').val();
                    data.filtro_linha = $('#papel-filtro_linha').val();
                    data.filtro_altura = $('#papel-filtro_altura').val();
                    data.filtro_largura = $('#papel-filtro_largura').val();
                    data.filtro_linha = $('#papel-filtro_linha').val();
                },
            },
            columns: [
                {data: "id","visible": false},
                {data: "linha","visible": true},
                {data: "papel","visible": true},
                {data: "altura","visible": true,"orderable": false},
                {data: "largura","visible": true,"orderable": false},
                {data: "gramaturas","visible": true,"orderable": false},
                {data: "descricao","visible": false,"orderable": false},
                {data: "ativo","visible": false,"orderable": false}

            ],
            order: [[2, 'asc']],//linha
        });
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_papel']").click(function () {
            $(".nav-filtro-papel").show();
            tb_papel.ajax.reload(null, false);
        });
        $("a[href='#tab_linha']").click(function () {
            $(".nav-filtro-papel").hide();
            if (!is_datatable_exists("#tb_linha")) {
                tb_linha = $("#tb_linha").DataTable({
                    scrollX: true,
                    scrollY:"500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
                    buttons: [
                        {   
                            extend:'colvis',
                            text:'Visualizar colunas'
                        },
                        {
                            extend: 'collection',
                            text: 'Exportar',
                            autoClose: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                            ],
                            fade: true
                        }
                    ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    order: [[1, 'asc']],
                    ajax: {
                        url: "<?= base_url('papel_linha/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "nome","visible": true},
                        {data: "descricao","visible": true,"orderable": false},
                        {data: "ativo","visible": true,"orderable": false},
                    ]
                });
            }else {
                tb_linha.ajax.reload(null, false);
            }
        });
        $("a[href='#tab_acabamento']").click(function () {
            $(".nav-filtro-papel").hide();
            if (!is_datatable_exists("#tb_acabamento")) {
                tb_acabamento = $("#tb_acabamento").DataTable({
                    scrollX: true,
                    scrollY:"500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
                    buttons: [
                        {   
                            extend:'colvis',
                            text:'Visualizar colunas'
                        },
                        {
                            extend: 'collection',
                            text: 'Exportar',
                            autoClose: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                            ],
                            fade: true
                        },
                        {   
                            text: 'Documentação',
                            action: function () {
                                open_papel_acabamento_docs();
                            }
                        }
                    ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('papel_acabamento/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "nome","visible": true},
                        {data: "codigo","visible": true},
                        {data: "qtd_minima","visible": true},
                        {data: "descricao","visible": true},
                        {data: "valor","visible": true},
                    ]
                });
            }else {
                tb_acabamento.ajax.reload(null, false);
            }
        });
        $("a[href='#tab_dimensao']").click(function () {
            $(".nav-filtro-papel").hide();
            if (!is_datatable_exists("#tb_dimensao")) {
                tb_dimensao = $("#tb_dimensao").DataTable({
                    scrollX: true,
                    scrollY:"500px",
                    scrollCollapse: true,
                    dom: 'lBfrtip',
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
                    buttons: [
                        {   
                            extend:'colvis',
                            text:'Visualizar colunas'
                        },
                        {
                            extend: 'collection',
                            text: 'Exportar',
                            autoClose: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                            ],
                            fade: true
                        }
                    ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    order: [[1, 'asc']],//altura
                    ajax: {
                        url: "<?= base_url('papel_dimensao/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                        {data: "id","visible": false},
                        {data: "altura","visible": true},
                        {data: "largura","visible": true}
                    ]
                });
            }else {
                tb_dimensao.ajax.reload(null, false);
            }
        });
        //seleciona a linha da tabela
        $("#tb_papel tbody").on("click", "tr", function () {
            row_select(tb_papel,this);            
        });
        $("#tb_linha tbody").on("click", "tr", function () {
            row_select(tb_linha,this);            
        });
        $("#tb_acabamento tbody").on("click", "tr", function () {
            row_select(tb_acabamento,this);            
        });
        $("#tb_dimensao tbody").on("click", "tr", function () {
            row_select(tb_dimensao,this);            
        });
        $("#adicionar").click(function(event) {
            reset_form();
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            $(".ativo-crud").prop('checked', true);
            if(tab_active === "#tab_papel"){
                $("#add_gramatura").click();
                ajax_carregar_papel_linha();
                ajax_carregar_papel_dimensao();
            }
            if(tab_active === "#tab_acabamento"){
                $("#codigo").attr("readonly",false);
            }
            save_method = 'add';
            $("input[name='id']").val("");
            $('.modal-title').text('Adicionar' + modal_title);
            visible_gramatura = $(".gramatura_group").length;
            $(md_form).modal('show');
        });
        $("#editar").click(function () {

            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }

            var id = dataTable.row(".selected").id();

            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            $.ajax({
                url: url_edit + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {   
                    data = switch_data(tab_active,data);

                    if(tab_active == '#tab_papel'){
                        $.map(data, function (value, index) {
                            if($('[name="' + index + '"]').is("input, textarea")){
                                if($('[name="' + index + '"]').is(':checkbox')){
                                    if(value === "0"){checked = false;}else{ checked = true;}
                                    $('[name="' + index + '"]').prop('checked', checked);
                                }else{
                                    $('[name="' + index + '"]').val(value);
                                }
                            }else if($('[name="' + index + '"]').is("select")){
                                if(index === "papel_linha"){
                                    ajax_carregar_papel_linha(true,value.id);
                                }else if(index === "papel_dimensao"){
                                    ajax_carregar_papel_dimensao(true,value.id);
                                }else if( $('[name="' + index + '"]').hasClass("selectpicker") ){
                                    $('[name="' + index + '"]').selectpicker('val', value.id);
                                }else{
                                    $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                                }
                            }else if(index === 'papel_gramaturas'){
                                $.each(value,function(i, gramatura) {
                                    clonar_gramatura(true,gramatura.id+"_UPD",gramatura.gramatura,gramatura.valor,gramatura.ativo);
                                });
                            }
                        });
                    }else{
                        $.map(data, function (value, index) {
                            if(tab_active === "#tab_acabamento"){
                                $("#codigo").attr("readonly",true);
                            }
                            if($('[name="' + index + '"]').is("input, textarea")){
                                if($('[name="' + index + '"]').is(':checkbox')){
                                    if(value === "0"){checked = false;}else{ checked = true;}
                                    $('[name="' + index + '"]').prop('checked', checked);
                                }else{
                                    $('[name="' + index + '"]').val(value);
                                }
                            }else if($('[name="' + index + '"]').is("select")){
                                if( $('[name="' + index + '"]').hasClass("selectpicker") ){
                                    $('[name="' + index + '"]').selectpicker('val', value.id);
                                }else{
                                    $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                                }
                            }
                        });
                    }
                    $(md_form).modal('show');
                    $('.modal-title').text('Editar' + modal_title + ' ID: '+id);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                },
                complete: function ()
                {
                    visible_gramatura = $(".gramatura_group").length;
                },
            });
        });
        $("#deletar").click(function () {
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            var id = dataTable.row(".selected").id();
            var nome = dataTable.row(".selected").data().nome;
            if(tab_active === "#tab_papel"){
                var nome = dataTable.row(".selected").data().papel;
            }
            if(tab_active === "#tab_dimensao"){
                var altura = dataTable.row(".selected").data().altura;
                var largura = dataTable.row(".selected").data().largura;
                nome = altura + 'x' + largura;
            }
            if(tab_active === "#tab_acabamento"){
                value = dataTable.row(".selected").data().codigo;
                if($.inArray(value, ["empastamento","laminacao","relevo_seco","corte_vinco","almofada","douracao","corte_laser","faca"]) > -1){
                    $.alert({
                        title: "Atenção",
                        content: "O <strong>"+ nome + " </strong>não pode ser excluido. Este item faz parte de uma variavel do sistema."
                    });
                    return false;
                }
            }
            $.confirm({
                title: 'Confirmação!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function () {
                    $.ajax({
                        url: url_delete + id,
                        type: "POST",
                        dataType: "JSON"
                    })
                    .done(function(data) {
                        console.log("success");
                        if (data.status) {
                            if(tab_active == '#tab_linha' || tab_active == '#tab_dimensao'){
                                papel_atualizar = true;
                            }
                            reload_table(dataTable);
                        }else{
                            if(data.db_error_1451){
                                $.alert({
                                    title: 'Atenção!',
                                    content: 'O papel <strong>ID: ' + id + ' '+ nome +'</strong> não pode ser excluido pois está sendo utilizado no orçamento...'
                                });
                            }
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log("error");
                    })
                },
                cancel: function () {
                    $.alert({
                        title: 'Sucesso',
                        content: 'O <strong>ID ' + id + ' ' + nome + '</strong> foi excluido com sucesso!'
                    })
                }
            });
        });
        $("form").submit(function (e) {

            formulario_submit(e);
        });
        $(".check_filter_dirty").change(function(event) {

            check_filter_dirty();
        });
        $("#add_gramatura").click(function(){
            count_gramatura++;
            visible_gramatura++;
            clonar_gramatura(false,count_gramatura+"_ADD","","",1);
        });
    });

    function ajax_carregar_papel_linha(editar = false,id_linha = null) {
        if(papel_atualizar){
            $('#papel_linha')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecione</option>')
                .val('');
            $('#papel-filtro_linha')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecione</option>')
                .val('');

            $.ajax({
                url: '<?= base_url("papel_linha/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
                data: {ativo: -1}
            })
            .done(function(data) {
                papel_atualizar = false;
                $.each(data, function(index, val) {
                    $('#papel_linha').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                    $('#papel-filtro_linha').append($('<option>', {
                        value: val.nome,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_papel_linha");
            })
            .always(function() {
                $('#papel_linha').selectpicker('refresh');
                $('#papel-filtro_linha').selectpicker('refresh');
                if(editar){
                    $('#papel_linha').selectpicker('val', id_linha);
                }
            });
        }else{
            if(editar){
                $('#papel_linha').selectpicker('val', id_linha);
            }else{
                $('#papel_linha').selectpicker('val', '');
            }
        }
    }

    function ajax_carregar_papel_dimensao(editar = false,id_dimensao = null) {
        if(papel_atualizar){
            $('#papel_dimensao')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecione</option>')
                .val('');

            $.ajax({
                url: '<?= base_url("papel_dimensao/ajax_get_personalizado")?>',
                type: 'GET',
                dataType: 'json',
            })
            .done(function(data) {
                papel_atualizar = false;
                $.each(data, function(index, val) {
                    $('#papel_dimensao').append($('<option>', {
                        value: val.id,
                        text: val.nome
                    }));
                });
            })
            .fail(function() {
                console.log("erro ao ajax_carregar_papel_dimensao");
            })
            .always(function() {
                $('#papel_dimensao').selectpicker('refresh');
                if(editar){
                    $('#papel_dimensao').selectpicker('val', id_dimensao);
                }
            });
        }else{
            if(editar){
                $('#papel_dimensao').selectpicker('val', id_dimensao);
            }else{
                $('#papel_dimensao').selectpicker('val', '');
            }
        }
    }

    function clonar_gramatura(editar,id,gramatura,valor,ativo){ // editar[boolean], ativo[string_db "0" / "1"]
        var clone = $("#default_gramatura_div").clone().prop("id","gramatura_papel_"+id).removeClass('hidden').addClass('gramatura_group');
        var cl = clone[0];
        var checked = '';

        (ativo == "0") ? checked = '' : checked = 'checked';

        // adicionar função para deletar a linha
        $(cl).find("#default_button_excluir").prop("id","excluir_gramatura_"+id).attr("onclick","remover_gramatura_papel('gramatura_papel_"+id+"',"+editar+",'"+gramatura+"');");

        // Alterar id, name, for(label) e adicionar required
        $($(cl).find("#default_gramatura_input")).prop("id","gramatura_"+id).prop("name","gramatura_"+id).val(gramatura).prop("required","required");

        //$($(cl).find("label")[0]).prop("for","gramatura_"+id);
        $($(cl).find("#default_valor_input")).prop("id","valor_"+id).prop("name","valor_"+id).val(valor).prop("required","required");

        //Cria um checkbox no local especificado. PS: O clone não está ativando a função do checkboxpicker.
        $(cl).find("#default_checkbox_input").prop("id","gramatura_checkbox_"+id).html('<label for="" class="label-control">Gramatura ativa </label> <input type="checkbox" id="ativo_'+id+'" name="ativo_'+id+'" value="1" data-group-cls="btn-group-sm" '+checked+'>');
        clone.appendTo("#lista_gramaturas");

        $("#ativo_"+id).checkboxpicker({ // altera os icones do checkbox
            html: true,
            offActiveCls: 'btn-warning',
            offLabel: '<span class="glyphicon glyphicon-remove">',
            onLabel: '<span class="glyphicon glyphicon-ok">'
        });
    }

    function remover_gramatura_papel(id,editar,gramatura) {
        if(!editar){
            do_remove_gramatura_papel(id,editar);
        }else{
            $.confirm({
                title: 'Atenção!',
                content: 'Deseja realmente excluir a gramatura <strong>' + gramatura + '</strong>?',
                confirm: function(){
                    do_remove_gramatura_papel(id,editar);
                },
                cancel: function(){
                }
            });
        }
    }

    function do_remove_gramatura_papel(id,editar) {
        if(visible_gramatura === 1){
            $.alert({
                title: 'Alerta!',
                content: 'O papel precisa ter pelo menos uma gramatura.',
            });
            return false;
        }else{
            visible_gramatura--;
        }
        if (!editar) {
            $("#"+id).remove();
        } else {
            var arr_gramatura = new Array();
            var arr_valor = new Array();
            var arr_ativo = new Array();
            // adicionar o D no name dos inputs
            var name_gramatura = $($("#"+id+" input")[0]).prop("name");
            arr_gramatura = name_gramatura.split("_");
            arr_gramatura[2] = "DEL";
            name_gramatura = arr_gramatura[0] + "_" + arr_gramatura[1] + "_" + arr_gramatura[2];
            $($("#"+id+" input")[0]).prop("name",name_gramatura);

            var name_valor = $($("#"+id+" input")[1]).prop("name");
            arr_valor = name_valor.split("_");
            arr_valor[2] = "DEL";
            name_valor = arr_valor[0] + "_" + arr_valor[1] + "_" + arr_valor[2];
            $($("#"+id+" input")[1]).prop("name",name_valor);

            var name_ativo = $($("#"+id+" input")[2]).prop("name");
            arr_ativo = name_ativo.split("_");
            arr_ativo[2] = "DEL";
            name_ativo = arr_ativo[0] + "_" + arr_ativo[1] + "_" + arr_ativo[2];
            $($("#"+id+" input")[2]).prop("name",name_ativo);
            $("#"+id).hide();
        }
    }

    function formulario_submit(event) {
        event.preventDefault();
        console.log('formulario submit');
        disable_button_salvar();
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        reset_errors();
        var url_submit;
        if (save_method == 'add') {
            url_submit = url_add;
        } else {
            url_submit = url_update;
        }
        $.ajax({
            url: url_submit,
            type: 'POST',
            dataType: 'json',
            data: $(form).serialize(),
        })
        .done(function(data) {
            console.log("success");
            if (data.status){   
                if(tab_active == '#tab_papel' && save_method == 'add'){
                    $.confirm({
                        title: 'Papel inserido com sucesso!',
                        content: 'Deseja inserir mais um papel da mesma linha?',
                        confirmButton: 'Sim',
                        cancelButton: 'Não',
                        confirm: function(){
                            $(form + " #nome").val('');
                        },
                        cancel: function(){
                            $(md_form).modal('hide');
                        }
                    });
                }else{
                    if(tab_active == '#tab_linha' || tab_active == '#tab_dimensao'){
                            papel_atualizar = true;
                        }
                    $(md_form).modal('hide');
                }
            }else{
                if(data.db_error_1451){
                    console.log('db_error_1451');
                    $.each(data.db_error_1451, function(index, val) {
                         arr_g = val.name.split("_");
                         id = '#' + arr_g[0] + '_papel_' + arr_g[1] + '_UPD';
                         name_gramatura = arr_g[0] + '_' + arr_g[1] + '_UPD';
                         $('[name=' + val.name + ']').prop('name',name_gramatura);

                         name_valor = 'valor_' + arr_g[1] + '_UPD';
                         $('[name=valor_' + arr_g[1] + '_DEL]').prop('name',name_valor);

                         visible_gramatura++;
                         $(id).show();
                        $('[name="' + name_gramatura + '"]').closest(".form-group").addClass('has-error').find('.help-block').text(val.msg);
                        
                    });
                }else{
                    $.map(data.form_validation, function (value, index) {
                        $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                        $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                    });
                }
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        })
        .always(function() {
            console.log("complete");
            enable_button_salvar();
            reload_table(dataTable);
        });
    }

    function get_tab_active() {
        form_small();
        tab_active = $(".nav-tabs li.active a")[0].hash;
        switch(tab_active) {
            case '#tab_papel':
                dataTable = tb_papel;
                md_form = '#md_papel';
                modal_title = ' Papel';
                url_edit = "<?= base_url('papel/ajax_edit/') ?>";
                url_add = "<?php echo site_url('papel/ajax_add') ?>";
                url_update = "<?php echo site_url('papel/ajax_update') ?>";
                url_delete = "<?= base_url('papel/ajax_delete/') ?>";
                form = '#form_papel';
                return true;
                break;
            case '#tab_linha':
                dataTable = tb_linha;
                md_form = '#md_linha';
                modal_title = ' Linha';
                url_edit = "<?= base_url('papel_linha/ajax_edit/') ?>";
                url_add = "<?php echo site_url('papel_linha/ajax_add') ?>";
                url_update = "<?php echo site_url('papel_linha/ajax_update') ?>";
                url_delete = "<?= base_url('papel_linha/ajax_delete/') ?>";
                form = '#form_linha';
                return true;
                break;
            case '#tab_acabamento':
                dataTable = tb_acabamento;
                md_form = '#md_acabamento';
                modal_title = ' Papel Acabamento';
                url_edit = "<?= base_url('papel_acabamento/ajax_edit/') ?>";
                url_add = "<?php echo site_url('papel_acabamento/ajax_add') ?>";
                url_update = "<?php echo site_url('papel_acabamento/ajax_update') ?>";
                url_delete = "<?= base_url('papel_acabamento/ajax_delete/') ?>";
                form = '#form_acabamento';
                return true;
                break;
            case '#tab_dimensao':
                dataTable = tb_dimensao;
                md_form = '#md_dimensao';
                modal_title = ' Papel Dimensão';
                url_edit = "<?= base_url('papel_dimensao/ajax_edit/') ?>";
                url_add = "<?php echo site_url('papel_dimensao/ajax_add') ?>";
                url_update = "<?php echo site_url('papel_dimensao/ajax_update') ?>";
                url_delete = "<?= base_url('papel_dimensao/ajax_delete/') ?>";
                form = '#form_dimensao';
                return true;
                break;
            default:
            return false;    
        }
    }

    function switch_data(tab_active,data) {
        switch(tab_active){
            case '#tab_papel':
                return data.papel;
                break;
            case '#tab_linha':
                return data.linha;
                break;
            case '#tab_acabamento':
                return data.papel_acabamento;
                break;
            case '#tab_dimensao':
                return data.papel_dimensao;
                break;
        }
    }

    function row_select(table,tr) {
        if ($(tr).hasClass("selected")) {
            $(tr).removeClass("selected");
        }
        else {
            table.$("tr.selected").removeClass("selected");
            $(tr).addClass("selected");
        }
    }

    function reload_table(tabela) {

        tabela.ajax.reload(null, false);
    }

    function reset_form() {
        $(form)[0].reset();
        reset_errors();
        $('.selectpicker').selectpicker('val', '');
        $("#lista_gramaturas").html("");
    }

    function open_papel_acabamento_docs() {

        $("#md_acabamento_docs").modal('show');
    }

    function filtro(acao) {
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        if(acao === 'filtrar'){
            dataTable.ajax.reload(null,false);
            $("#md_filtro_papel").modal('hide');
        }else if(acao === 'reset'){
            $('#form-filter-papel')[0].reset();
            $('#form-filter-papel ul>li.selected.active').removeClass('selected active');
            $('#papel-filtro_linha').selectpicker('val', '');
            dataTable.ajax.reload(null,false);
        }
    }

    function show_filtro_papel() {
        ajax_carregar_papel_linha();
        $('.modal-title').text('Filtro');
        $("#md_filtro_papel").modal('show');
    }

</script>