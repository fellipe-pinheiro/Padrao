<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="panel panel-default">
    <div class="panel-body panel-nav">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-modelo_convite-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">Modelos de convites</div>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-modelo_convite-menu">
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
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-12 table-responsive">
                    <table id="tabela_convite_modelo" class="table display compact table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Empastamento Borda</th>
                                <th>Descricao</th>
                                <th>Ativo</th>
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

<div class="modal fade" id="modal_form">
    <form action="#" method="POST" role="form" class="form-horizontal" id="form_convite_modelo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title row"></h4>
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
                                    <a href="javascript:void(0)" id="add_dimensoes"><i class="glyphicon glyphicon-plus"></i> Dimensões</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="modal-body">
                    <fieldset>
                        <!--ID-->
                        <input type="hidden" name="id" id="id" class="form-control">
                        <div class="row">
                            <!--ativo-->
                            <div class="col-sm-12">
                                <div class="form-group input-padding">
                                    <label for="ativo" class="control-label">Ativo:</label>
                                    <input type="checkbox" value="1" class="ativo-crud" name="ativo" data-group-cls="btn-group-sm">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--Nome-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="nome" class="control-label">Nome:</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="" required="required" placeholder="Nome do modelo" pattern=".{1,50}" title="Máximo de 50 caracteres">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--Código-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="codigo" class="control-label">Código:</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control" value="" required="required" title="Utilize no mínimo 3 e máximo 20 caracteres sendo somente letras minúsculas [a-z], sem acentuação, números [0-9] e sem espaçamento." placeholder="Código do modelo Ex: abc123" pattern="[a-z0-9]{3,20}$">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--empastamento_borda-->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <label for="empastamento_borda" class="control-label">Empastamento borda:</label>
                                    <div class="input-group">
                                        <input type="number" name="empastamento_borda" id="empastamento_borda" class="form-control" value="" required="required" title="Utilize somente números de até 5 dígitos" min="0" max="99999" placeholder="Borda adicionada caso haja empastamento. Ex:10">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Dimensão Final -->
                        <div class="row">
                            <!-- dimensao_nome_final_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <label for="dimensao_altura_final_default">Dimensão Final</label>
                                        <input type="hidden" name="dimensao_id_final_default" id="dimensao_id_final_default" class="form-control">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- dimensao_altura_final_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="dimensao_altura_final_default" id="dimensao_altura_final_default" class="form-control" placeholder="Altura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- dimensao_largura_final_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="dimensao_largura_final_default" id="dimensao_largura_final_default" class="form-control" placeholder="Largura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- Cartão -->
                        <div class="row">
                            <!-- dimensao_nome_cartao_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <label for="dimensao_altura_cartao_default">Cartão</label>
                                        <input type="hidden" name="dimensao_id_cartao_default" id="dimensao_id_cartao_default" class="form-control">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- dimensao_altura_cartao_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="dimensao_altura_cartao_default" id="dimensao_altura_cartao_default" class="form-control" placeholder="Altura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- dimensao_largura_cartao_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="dimensao_largura_cartao_default" id="dimensao_largura_cartao_default" class="form-control" placeholder="Largura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- Envelope -->
                        <div class="row">
                            <!-- dimensao_nome_envelope_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <label for="dimensao_altura_envelope_default">Envelope</label>
                                        <input type="hidden" name="dimensao_id_envelope_default" id="dimensao_id_envelope_default" class="form-control">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- dimensao_altura_envelope_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="dimensao_altura_envelope_default" id="dimensao_altura_envelope_default" class="form-control" placeholder="Altura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!-- dimensao_largura_envelope_default -->
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="dimensao_largura_envelope_default" id="dimensao_largura_envelope_default" class="form-control" placeholder="Largura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!--Convite Modelo Dimensão-->
                        <div class="hidden" id="default_dimensao_div">
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" id="default_button_excluir" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                        </div>
                                        <input type="text" name="" id="default_nome_input" class="form-control" placeholder="Nome">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="" id="default_altura_input" class="form-control" placeholder="Altura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group input-padding">
                                    <div class="input-group">
                                        <input step="1" type="number" min="0" name="" id="default_largura_input" class="form-control" placeholder="Largura ex: 320">
                                        <div class="input-group-addon">mm</div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div id="lista_dimensoes" class="row">
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
<?php $this->load->view('_include/dataTable'); ?>
<script type="text/javascript">
    var count_dimensoes = 0;

    $(document).ready(function () {
        tabela = $("#tabela_convite_modelo").DataTable({
            scrollX: true,
            scrollY: "500px",
            scrollCollapse: true,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "todas"]],
            buttons: [
            {
                extend: 'colvis',
                text: 'Visualizar colunas'
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
            }
            ],
            language: {
                url: "<?= base_url("assets/idioma/dataTable-pt.json") ?>"
            },
            processing: true,
            serverSide: true,
            order: [[2, 'asc']],//nome
            ajax: {
                url: "<?= base_url('convite_modelo/ajax_list') ?>",
                type: "POST"
            },
            columns: [
                {data: "id", "visible": false},
                {data: "codigo", "visible": true},
                {data: "nome", "visible": true},
                {data: "empastamento_borda", "visible": true},
                {data: "descricao", "visible": false},
                {data: "ativo", "visible": false}
                ]
            });
        // Resaltar a linha selecionada
        $("#tabela_convite_modelo tbody").on("click", "tr", function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
            } else {
                tabela.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
            }
        });
        $("#adicionar").click(function (event) {
            reset_form();
            $(".ativo-crud").prop('checked', true);
            save_method = 'add';
            $("input[name='id']").val("");

            $('.modal-title').text('Adicionar Modelo');
            visible_gramatura = $(".dimensao_group").length;
            $('#modal_form').modal('show');
        });
        $("#editar").click(function () {
            // Buscar ID da linha selecionada
            var id = tabela.row(".selected").id();
            if (!id) {
                return;
            }

            reset_form();

            save_method = 'edit';
            $("input[name='id']").val(id);
            //Ajax Load data from ajax
            $.ajax({
                url: "<?= base_url('convite_modelo/ajax_edit/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {   
                    $.map(data.convite_modelo, function (value, index) {
                        if ($('[name="' + index + '"]').is("input, textarea")) {
                            if($('[name="' + index + '"]').is(':checkbox')){
                                if(value === "0"){checked = false;}else{ checked = true;}
                                $('[name="' + index + '"]').prop('checked', checked);
                            }else{
                                $('[name="' + index + '"]').val(value);
                            }
                        }else if ($('[name="' + index + '"]').is("select")){
                            $('[name="' + index + '"] option[value=' + value.id + ']').prop("selected", "selected");
                        }else if(index == 'dimensoes'){
                            $.each(value,function(i, dimensoes) {
                                 switch (dimensoes.destino) {
                                    case '0':
                                        $('[name="dimensao_id_final_default"]').val(dimensoes.id);
                                        $('[name="dimensao_altura_final_default"]').val(dimensoes.altura);
                                        $('[name="dimensao_largura_final_default"]').val(dimensoes.largura);
                                        break;
                                    case '1':
                                        $('[name="dimensao_id_cartao_default"]').val(dimensoes.id);
                                        $('[name="dimensao_altura_cartao_default"]').val(dimensoes.altura);
                                        $('[name="dimensao_largura_cartao_default"]').val(dimensoes.largura);
                                        break;
                                    case '2':
                                        $('[name="dimensao_id_envelope_default"]').val(dimensoes.id);
                                        $('[name="dimensao_altura_envelope_default"]').val(dimensoes.altura);
                                        $('[name="dimensao_largura_envelope_default"]').val(dimensoes.largura);
                                        break;
                                    default:
                                    clonar_dimensoes(true,dimensoes.id+"_UPD",dimensoes.nome,dimensoes.altura,dimensoes.largura);
                                        break;
                                }  
                            });
                        }      
                    });

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Editar Modelo ID: '+id);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao buscar os dados');
                },
                complete: function () {
                    visible_dimensao = $(".dimensao_group").length;
                }
            });
        });
        $("#deletar").click(function () {

            var id = tabela.row(".selected").id();
            var nome = tabela.row(".selected").data().nome;
            $.confirm({
                title: 'Atenção!',
                content: 'Deseja realmente excluir o <strong>ID: ' + id + ' ' + nome + '</strong>',
                confirmButtonClass: 'btn-danger',
                cancelButtonClass: 'btn-default',
                confirm: function(){
                    $.ajax({
                        url: "<?= base_url('convite_modelo/ajax_delete/') ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            if (data.status) {
                                reload_table();
                                $.alert('<strong>ID: ' + id + ' ' + nome + '</strong> excluido com sucesso!');
                            } else {
                                alert("Erro ao excluir o registro");
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Erro ao excluir o registro');
                        }
                    });
                },
                cancel: function(){
                    $.alert('Cancelado!')
                }
            });
        });
        $("#form_convite_modelo").submit(function (event) {
            event.preventDefault();
            disable_button_salvar();
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('convite_modelo/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('convite_modelo/ajax_update') ?>";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_convite_modelo').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    } else
                    {
                        $.map(data.form_validation, function (value, index) {
                            $('[name="' + index + '"]').closest(".form-group").addClass('has-error');
                            $('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Erro ao Adicionar ou Editar');
                },
                complete: function () {
                    enable_button_salvar();
                    reload_table();
                }
            });
        });
        $("#add_dimensoes").click(function(){
            count_dimensoes++;
            clonar_dimensoes(false,count_dimensoes+"_ADD","","","");
        });
        form_small();
    });

    function clonar_dimensoes(editar,id,nome,altura,largura){//ID = 1_ADD
        var clone = $("#default_dimensao_div").clone().prop("id","dimensao_"+id).removeClass('hidden').addClass('dimensao_group');
        var cl = clone[0];

        // adicionar função para deletar a linha
        $(cl).find("#default_button_excluir").prop("id","excluir_dimensao_"+id).attr("onclick","remover_dimensao('dimensao_"+id+"',"+editar+",'"+nome+"');");

        // Alterar id, name, for(label) e adicionar required
        $($(cl).find("#default_nome_input")).prop("id","nome_"+id).prop("name","dimensao_nome_"+id).val(nome).prop("required","required");

        $($(cl).find("#default_altura_input")).prop("id","altura_"+id).prop("name","dimensao_altura_"+id).val(altura).prop("required","required");

        $($(cl).find("#default_largura_input")).prop("id","largura_"+id).prop("name","dimensao_largura_"+id).val(largura).prop("required","required");

        clone.appendTo("#lista_dimensoes");
    }

    function remover_dimensao(id,editar,nome) {
        var preenchido = false;
        $.each($("#"+id+" input"), function(index, element) {
            if(element.value){
                preenchido = true;
            }
        });

        if(!preenchido){
            do_remove_dimensao(id,editar);
        }else{
            $.confirm({
                title: 'Atenção!',
                content: 'Deseja realmente excluir o item <strong>' + nome + '</strong>?',
                confirm: function(){
                    do_remove_dimensao(id,editar);
                },
                cancel: function(){
                }
            });
        }
    }

    function do_remove_dimensao(id,editar) {
        if (!editar) {
            $("#"+id).remove();
        } else {
            var arr_nome = new Array();
            var arr_valor = new Array();
            var arr_ativo = new Array();
            // editar o name dos campos
            var name_nome = $("#"+id+" input")[0].name;
            arr_nome = name_nome.split("_");
            $("#"+id+" input")[0].name = arr_nome[0] + "_" + arr_nome[1] + "_" + arr_nome[2]+ "_DEL";
           
            var name_altura = $("#"+id+" input")[1].name;
            arr_altura = name_altura.split("_");
            $("#"+id+" input")[1].name = arr_altura[0] + "_" + arr_altura[1] + "_" + arr_altura[2]+ "_DEL";

            var  name_largura = $("#"+id+" input")[2].name;
            arr_largura = name_largura.split("_");
            $("#"+id+" input")[2].name = arr_largura[0] + "_" + arr_largura[1] + "_" + arr_largura[2]+ "_DEL";

            $("#"+id).hide();
        }
    }

    function reload_table() {

        tabela.ajax.reload(null, false);
    }

    function reset_form() {
        $('#form_convite_modelo')[0].reset();
        $('#form_convite_modelo :input').val(''); //para limpar os inputs hidden (só com o reset não está limpando o valor)
        $(':checkbox').val('1'); // como limpei com ($(':input').val('');), recoloco o valor do input checkbox para 1
        reset_errors();
        $("#lista_dimensoes").html("");
    }
</script>