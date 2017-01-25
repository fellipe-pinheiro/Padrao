<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Papéis</h3>
    </div>
    <div class="panel-body">
        <button class="btn btn-default" id="adicionar"><i class="glyphicon glyphicon-plus"></i></button>
        <button class="btn btn-default" id="editar"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-danger pull-right" id="deletar"><i class="glyphicon glyphicon-trash"></i></button>
        <hr>
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_papel" aria-controls="tab_papel" role="tab" data-toggle="tab">Papel</a>
                </li>
                <li role="presentation">
                    <a href="#tab_papel_linha" aria-controls="tab_papel_linha" role="tab" data-toggle="tab">Papel linha</a>
                </li>
                <li role="presentation">
                    <a href="#tab_papel_catalogo" aria-controls="tab_papel_catalogo" role="tab" data-toggle="tab">Papel Catalogo</a>
                </li>
                <li role="presentation">
                    <a href="#tab_papel_acabamento" aria-controls="tab_papel_acabamento" role="tab" data-toggle="tab">Papel Acabamento</a>
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
                                        <th>Catálogo</th>
                                        <th>Linha</th>
                                        <th>Papel</th>
                                        <th>Altura</th>
                                        <th>Largura</th>
                                        <th>Val_80g</th>
                                        <th>Val_120g</th>
                                        <th>Val_180g</th>
                                        <th>Val_250g</th>
                                        <th>Val_300g</th>
                                        <th>Val_350g</th>
                                        <th>Val_400g</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody id="fbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_papel_linha">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tb_linha" class="table display compact table-bordered " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Catálogo</th>
                                        <th>Linha</th>
                                        <th>Val_80g</th>
                                        <th>Val_120g</th>
                                        <th>Val_180g</th>
                                        <th>Val_250g</th>
                                        <th>Val_300g</th>
                                        <th>Val_350g</th>
                                        <th>Val_400g</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody id="fbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_papel_catalogo">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tb_catalogo" class="table display compact table-bordered " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_papel_acabamento">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="tb_acabamento" class="table display compact table-bordered " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Código</th>
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
            </div>
        </div>  
    </div>
</div>
<div class="modal fade" id="md_form_papel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">papel</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_papel" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Papel Linha-->
                <div class="form-group">
                    <?= form_label('Linha: ', 'papel_linha', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <select name="papel_linha" id="papel_linha" class="form-control" >
                            <option value="" selected disabled>Selecione</option>
                            <?php
                            foreach ($dados['papel_linha'] as $key => $value) {
                                ?>
                                <option value="<?=$value->id?>"><?=$value->nome?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Papel Dimensao-->
                <div class="form-group">
                    <?= form_label('Dimensão: ', 'papel_dimensao', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <select name="papel_dimensao" id="papel_dimensao" class="form-control" >
                            <option value="" selected disabled>Selecione</option>
                            <?php
                            foreach ($dados['papel_dimensao'] as $key => $value) {
                                ?>
                                <option value="<?=$value->id?>"><?=$value->altura?> x <?=$value->largura?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Descrição-->
                <div class="form-group">
                    <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descricao"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_linha">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Papel linha</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_linha" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('Linha: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('nome', '', 'id="nome" autofocus class="form-control" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Papel Catálogo-->
                <div class="form-group">
                    <?= form_label('Papel Catálogo: ', 'papel_catalogo', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <select name="papel_catalogo" id="papel_catalogo" class="form-control" >
                            <option disabled selected>Selecione</option>
                            <?php foreach ($dados['papel_catalogo'] as $key => $value) { 
                                ?>
                                <option value="<?= $value->id ?>"><?= $value->nome ?></option>
                                <?php 
                            } 
                            ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 80g-->
                <div class="form-group">
                    <?= form_label('Valor 80g: ', 'valor_80g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_80g" type="number" class="form-control" placeholder="Valor de 80g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 120g-->
                <div class="form-group">
                    <?= form_label('Valor 120g: ', 'valor_120g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_120g" type="number" class="form-control" placeholder="Valor de 120g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 180g-->
                <div class="form-group">
                    <?= form_label('Valor 180g: ', 'valor_180g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_180g" type="number" class="form-control" placeholder="Valor de 180g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 250g-->
                <div class="form-group">
                    <?= form_label('Valor 250g: ', 'valor_250g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_250g" type="number" class="form-control" placeholder="Valor de 250g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 300g-->
                <div class="form-group">
                    <?= form_label('Valor 300g: ', 'valor_300g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_300g" type="number" class="form-control" placeholder="Valor de 300g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 350g-->
                <div class="form-group">
                    <?= form_label('Valor 350g: ', 'valor_350g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_350g" type="number" class="form-control" placeholder="Valor de 350g" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Valor 400g-->
                <div class="form-group">
                    <?= form_label('Valor 400g: ', 'valor_400g', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor_400g" type="number" class="form-control" placeholder="Valor de 400g" />
                        <span class="help-block"></span>
                    </div>
                </div>   
                <!--Descrição-->
                <div class="form-group">
                    <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descricao"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_catalogo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Catalogo de papéis</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_catalogo" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('*Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('nome', '', 'id="nome" class="form-control" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--Descrição-->
                <div class="form-group">
                    <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descrição"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade" id="md_form_acabamento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Papel Acabamento</h4>
            </div>
            <?= form_open("#", 'class="form-horizontal" id="form_acabamento" role="form"') ?>
            <div class="modal-body form">
                <!--ID-->
                <?= form_hidden('id') ?>

                <!--Nome-->
                <div class="form-group">
                    <?= form_label('Nome: ', 'nome', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input('nome', '', 'id="nome" class="form-control" disabled="true" placeholder="Nome"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--codigo-->
                <div class="form-group">
                    <?= form_label('*Código: ', 'codigo', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_input(array('name'=>'codigo','type'=>'text', 'id'=>'codigo', 'class'=>'form-control', 'placeholder'=>'Código', 'disabled'=>'true'), '') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Descrição-->
                <div class="form-group">
                    <?= form_label('Descrição: ', 'descricao', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <?= form_textarea('descricao', '', ' id="descricao" class="form-control" placeholder="Descrição" disabled="true"') ?>
                        <span class="help-block"></span>
                    </div>
                </div>

                <!--Valor-->
                <div class="form-group">
                    <?= form_label('*Valor: ', 'valor', array('class' => 'control-label col-sm-2')) ?>
                    <div class="col-sm-10">
                        <input step="0.01" value="" name="valor" type="number" class="form-control" placeholder="Valor" />
                        <span class="help-block"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success btnSubmit">Salvar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade" id="md_papel_acabamento_docs">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Documentação</h4>
            </div>
            <div class="modal-body">
                <p>Configurar a tabela conforme a tabela da documentação. Deverá ter o mesmo ID e mesmo Código</p>
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
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Filtro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="papel-filtro_catalogo" class="control-label"> Catálogo</label>
                        <select id="papel-filtro_catalogo" class="form-control selectpicker" data-live-search="true" autofocus="true">
                            <option value="">Selecione</option>
                            <?php foreach ($dados['papel_catalogo'] as $key => $value) { 
                                ?>
                                <option value="<?= $value->nome ?>"><?= $value->nome ?></option>
                                <?php 
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_linha" class="control-label"> Linha</label>
                        <select id="papel-filtro_linha" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($dados['papel_linha'] as $key => $value) {
                                ?>
                                <option value="<?=$value->nome?>"><?=$value->nome?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_papel" class="control-label"> Papel</label>
                        <select id="papel-filtro_papel" class="form-control selectpicker" data-live-search="true" autofocus="true">
                            <option value="" selected>Selecione</option>
                            <?php foreach ($dados['papel'] as $papel) {
                                ?>
                                <option value="<?=$papel->nome?>"><?=$papel->nome?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_papel_altura" class="control-label"> Papel Altura</label>
                        <input type="number" min="0" class="form-control" id="papel-filtro_papel_altura" placeholder="Papel Altura">
                    </div>
                    <div class="form-group">
                        <label for="papel-filtro_papel_largura" class="control-label"> Papel Largura</label>
                        <input type="number" min="0" class="form-control" id="papel-filtro_papel_largura" placeholder="Papel Largura">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="filtro('papel','reset')">Limpar Filtro</button>
                    <button type="button" class="btn btn-default" onclick="filtro('papel','filtrar')">
                        <span class="glyphicon glyphicon-filter"></span>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="md_filtro_papel_linha">
    <form id="form-filter-papel_linha" class="form-horizontal form-filter">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Filtro</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="papel_linha-filtro_catalogo" class="control-label"> Catálogo</label>
                        <select id="papel_linha-filtro_catalogo" class="form-control selectpicker" data-live-search="true" autofocus="true">
                            <option value="">Selecione</option>
                            <?php foreach ($dados['papel_catalogo'] as $key => $value) { 
                                ?>
                                <option value="<?= $value->nome ?>"><?= $value->nome ?></option>
                                <?php 
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="papel_linha-filtro_linha" class="control-label"> Linha</label>
                        <select id="papel_linha-filtro_linha" class="form-control selectpicker" data-live-search="true">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($dados['papel_linha'] as $key => $value) {
                                ?>
                                <option value="<?=$value->nome?>"><?=$value->nome?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="papel_linha-filtro_papel_altura" class="control-label"> Papel Altura</label>
                        <input type="number" min="0" class="form-control" id="papel_linha-filtro_papel_altura" placeholder="Papel Altura">
                    </div>
                    <div class="form-group">
                        <label for="papel_linha-filtro_papel_largura" class="control-label"> Papel Largura</label>
                        <input type="number" min="0" class="form-control" id="papel_linha-filtro_papel_largura" placeholder="Papel Largura">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="filtro('papel_linha','reset')">Limpar Filtro</button>
                    <button type="button" class="btn btn-default" onclick="filtro('papel_linha','filtrar')">
                        <span class="glyphicon glyphicon-filter"></span>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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
</style>
<script type="text/javascript">

    var tb_papel;
    var tb_linha;
    var tb_catalogo;
    var tb_acabamento;
    var tab_active;
    var dataTable;
    var md_form;
    var modal_title;
    var url_edit;
    var save_method;
    var url_add;
    var url_update;
    var form;

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
                            orientation: 'landscape',
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
                            orientation: 'landscape',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                    ],
                    fade: true
                },
                {   
                    text: 'Filtro',
                    action: function () {
                        $("#md_filtro_papel").modal('show');
                    }
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
                    data.filtro_catalogo = $('#papel-filtro_catalogo').val();
                    data.filtro_linha = $('#papel-filtro_linha').val();
                    data.filtro_papel = $('#papel-filtro_papel').val();
                    data.filtro_papel_altura = $('#papel-filtro_papel_altura').val();
                    data.filtro_papel_largura = $('#papel-filtro_papel_largura').val();
                },
            },
            columns: [
                {data: "id","visible": false},
                {data: "papel_catalogo","visible": true},
                {data: "papel_linha","visible": true},
                {data: "nome","visible": true},
                {data: "pd_altura","visible": true,"orderable": false},
                {data: "pd_largura","visible": true,"orderable": false},
                {data: "valor_80g","visible": true,"orderable": false},
                {data: "valor_120g","visible": true,"orderable": false},
                {data: "valor_180g","visible": true,"orderable": false},
                {data: "valor_250g","visible": true,"orderable": false},
                {data: "valor_300g","visible": true,"orderable": false},
                {data: "valor_350g","visible": true,"orderable": false},
                {data: "valor_400g","visible": true,"orderable": false},
                {data: "descricao","visible": false,"orderable": false},
            ],
        });
        if(!get_tab_active()){
            console.log('Não foi possível carregar get_tab_active()');
            return false;
        }
        $("a[href='#tab_papel']").click(function () {

            tb_papel.ajax.reload(null, false);
        });
        $("a[href='#tab_papel_linha']").click(function () {
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
                        },
                        {   
                            text: 'Filtro',
                            action: function () {
                                $("#md_filtro_papel_linha").modal('show');
                            }
                        }
                    ],
                    language: {
                        url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?= base_url('papel_linha/ajax_list') ?>",
                        type: "POST",
                        data: function ( data ) {
                            data.filtro_catalogo = $('#papel_linha-filtro_catalogo').val();
                            data.filtro_linha = $('#papel_linha-filtro_linha').val();
                        },
                    },
                    columns: [
                    {data: "id","visible": true,"visible": false},
                    {data: "papel_catalogo","visible": true},
                    {data: "nome","visible": true},
                    {data: "valor_80g","visible": true,"orderable": false},
                    {data: "valor_120g","visible": true,"orderable": false},
                    {data: "valor_180g","visible": true,"orderable": false},
                    {data: "valor_250g","visible": true,"orderable": false},
                    {data: "valor_300g","visible": true,"orderable": false},
                    {data: "valor_350g","visible": true,"orderable": false},
                    {data: "valor_400g","visible": true,"orderable": false},
                    {data: "descricao","visible": false,"orderable": false},
                    ]
                });
            }else {
                tb_linha.ajax.reload(null, false);
            }
        });
        $("a[href='#tab_papel_catalogo']").click(function () {
            if (!is_datatable_exists("#tb_catalogo")) {
                tb_catalogo = $("#tb_catalogo").DataTable({
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
                        url: "<?= base_url('papel_catalogo/ajax_list') ?>",
                        type: "POST"
                    },
                    columns: [
                    {data: "id","visible": false},
                    {data: "nome","visible": true},
                    {data: "descricao","visible": false,"orderable": false},
                    ]
                });
            }else {
                tb_catalogo.ajax.reload(null, false);
            }
        });
        $("a[href='#tab_papel_acabamento']").click(function () {
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
                        {data: "id","visible": true},
                        {data: "nome","visible": true},
                        {data: "codigo","visible": true},
                        {data: "descricao","visible": true},
                        {data: "valor","visible": true}
                    ]
                });
            }else {
                tb_acabamento.ajax.reload(null, false);
            }
        });
        //seleciona a linha da tabela
        $("#tb_papel tbody").on("click", "tr", function () {
            row_select(tb_papel,this);
        });
        $("#tb_linha tbody").on("click", "tr", function () {
            row_select(tb_linha,this);            
        });
        $("#tb_catalogo tbody").on("click", "tr", function () {
            row_select(tb_catalogo,this);            
        });
        $("#tb_acabamento tbody").on("click", "tr", function () {
            row_select(tb_acabamento,this);            
        });
        $("#adicionar").click(function(event) {
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            reset_form();

            save_method = 'add';
            $("input[name='id']").val("");
            $('.modal-title').text('Adicionar' + modal_title);
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
                    $.map(data, function (value, index) {
                        if($('[name="' + index + '"]').is("input, textarea")){
                            $('[name="' + index + '"]').val(value);
                        }else if($('[name="' + index + '"]').is("select")){
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected","selected");
                        }
                    });
                    $(md_form).modal('show');
                    $('.modal-title').text('Editar' + modal_title);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                }
            });
        });
        $("#deletar").click(function () {
            if(!get_tab_active()){
                console.log('Não foi possível carregar get_tab_active()');
                return false;
            }
            var id = dataTable.row(".selected").id();
            var nome = dataTable.row(".selected").data().nome;
            if (confirm("O registro: " + nome + " será excluido. Clique em OK para continuar ou Cancele a operação.")) {
                $.ajax({
                    url: url_delete + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {
                        if (data.status) {
                            reload_table(dataTable);
                        }else{
                            alert("Erro ao excluir o registro");
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Erro ao excluir o registro');
                    }
                });
            }
        });
        $("#form_papel").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_linha").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_catalogo").submit(function (e) {

            formulario_submit(e);
        });
        $("#form_acabamento").submit(function (e) {

            formulario_submit(e);
        });
        $(".check_filter_dirty").change(function(event) {

            check_filter_dirty();
        });
    });

function formulario_submit(e) {
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
        type: "POST",
        data: $(form).serialize(),
        dataType: "JSON",
        success: function (data)
        {
            if (data.status)
            {
                $(md_form).modal('hide');
                reload_table(dataTable);
            }
            else
            {
                $.map(data.form_validation, function (value, index) {
                    $('[name="' + index + '"]').parent().parent().addClass('has-error');
                    $('[name="' + index + '"]').next().text(value);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Erro ao Adicionar ou Editar');
        },
            complete: function () {
                enable_button_salvar();
            }
    });
    reload_table(dataTable);
    e.preventDefault();
}
function get_tab_active() {
    tab_active = $(".nav-tabs li.active a")[0].hash;
    switch(tab_active) {
        case '#tab_papel':
            dataTable = tb_papel;
            md_form = '#md_form_papel';
            modal_title = ' Papel';
            url_edit = "<?= base_url('papel/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel/ajax_add') ?>";
            url_update = "<?php echo site_url('papel/ajax_update') ?>";
            url_delete = "<?= base_url('papel/ajax_delete/') ?>";
            form = '#form_papel';
            return true;
            break;
        case '#tab_papel_linha':
            dataTable = tb_linha;
            md_form = '#md_form_linha';
            modal_title = ' Papel Linha';
            url_edit = "<?= base_url('papel_linha/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel_linha/ajax_add') ?>";
            url_update = "<?php echo site_url('papel_linha/ajax_update') ?>";
            url_delete = "<?= base_url('papel_linha/ajax_delete/') ?>";
            form = '#form_linha';
            return true;
            break;
        case '#tab_papel_catalogo':
            dataTable = tb_catalogo;
            md_form = '#md_form_catalogo';
            modal_title = ' Papel Catalogo';
            url_edit = "<?= base_url('papel_catalogo/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel_catalogo/ajax_add') ?>";
            url_update = "<?php echo site_url('papel_catalogo/ajax_update') ?>";
            url_delete = "<?= base_url('papel_catalogo/ajax_delete/') ?>";
            form = '#form_catalogo';
            return true;
            break;
        case '#tab_papel_acabamento':
            dataTable = tb_acabamento;
            md_form = '#md_form_acabamento';
            modal_title = ' Papel Acabamento';
            url_edit = "<?= base_url('papel_acabamento/ajax_edit/') ?>";
            url_add = "<?php echo site_url('papel_acabamento/ajax_add') ?>";
            url_update = "<?php echo site_url('papel_acabamento/ajax_update') ?>";
            url_delete = "<?= base_url('papel_acabamento/ajax_delete/') ?>";
            form = '#form_acabamento';
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
        case '#tab_papel_linha':
        return data.papel_linha;
        break;
        case '#tab_papel_catalogo':
        return data.papel_catalogo;
        break;
        case '#tab_papel_acabamento':
        return data.papel_acabamento;
        break;
    }
}
function row_select(table,tr) {
    if ($(tr).hasClass("selected")) {
        $(tr).removeClass("selected");
        disable_buttons();
    }
    else {
        table.$("tr.selected").removeClass("selected");
        $(tr).addClass("selected");
        enable_buttons();
    }
}
function reload_table(tabela) {

    tabela.ajax.reload(null, false);
}
function reset_form() {
    $(form)[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
}
function reset_errors() {
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
}
function enable_buttons() {
    $("#editar").attr("disabled", false);
    $("#deletar").attr("disabled", false);
}
function disable_buttons() {
    $("#editar").attr("disabled", true);
    $("#deletar").attr("disabled", true);
}
function open_papel_acabamento_docs() {

    $("#md_papel_acabamento_docs").modal('show');
}
function filtro(tabela,acao) {
    if(!get_tab_active()){
        console.log('Não foi possível carregar get_tab_active()');
        return false;
    }
    if(acao === 'filtrar'){
        dataTable.ajax.reload(null,false);
        if(tabela === 'papel'){
            $("#md_filtro_papel").modal('hide');
        }else{
            $("#md_filtro_papel_linha").modal('hide');
        }
    }else if(acao === 'reset'){
        if(tabela === 'papel'){
            $('#form-filter-papel')[0].reset();
            $('#form-filter-papel ul>li.selected.active').removeClass('selected active');
            //$($('#form-filter-papel ul li')[0]).addClass('selected active');
        }else{
            $('#form-filter-papel_linha')[0].reset();
            $('#form-filter-papel_linha ul>li.selected.active').removeClass('selected active');
            //$($('#form-filter-papel_linha ul li')[0]).addClass('selected active');
        }
        $(".filter-option").each(function(index, el) {
            $(".filter-option").text("Selecione");
        });
        dataTable.ajax.reload(null,false);
    }
}
</script>