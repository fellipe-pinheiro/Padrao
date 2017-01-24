<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($dados['acao'] == 'inserir') {
    $action = 'usuario/ajax_add';
    $dados['usuario'] = new Usuario_m();
} elseif ($dados['acao'] == 'editar') {
    $action = 'usuario/ajax_update';
}
?>
<!--Formulario-->
<div class="panel panel-default hidden">
    <div class="panel-heading">
        <h3 class="panel-title">Informações do usuario</h3>
    </div>
    <div class="panel-body">
        <?= form_open(base_url($action), array("class" => "form-horizontal", "role" => "form")) ?>
        <?= form_hidden("id", $dados['usuario']->id . set_value('id')) ?>

        <!--Nome-->
        <div class="form-group">
            <?= form_label("Nome  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("first_name", $dados['usuario']->first_name . set_value('first_name'), "class = 'form-control' placeholder = 'Nome'") ?>
                <span class="help-block"><?= form_error('first_name') ?></span>
            </div>
        </div>
        <!--Sobrenome-->
        <div class="form-group">
            <?= form_label("Sobrenome  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("last_name", $dados['usuario']->last_name . set_value('last_name'), "class = 'form-control' placeholder = 'Sobrenome'") ?>
                <span class="help-block"><?= form_error('last_name') ?></span>
            </div>
        </div>
        <!--Emai-->
        <div class="form-group">
            <?= form_label("Emai  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("email", $dados['usuario']->email . set_value('email'), "class = 'form-control' placeholder = 'Emai'") ?>
                <span class="help-block"><?= form_error('email') ?></span>
            </div>
        </div>
        <!--Celular-->
        <div class="form-group">
            <?= form_label("Celular  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("phone", $dados['usuario']->phone . set_value('phone'), "class = 'form-control' placeholder = 'Celular'") ?>
                <span class="help-block"><?= form_error('phone') ?></span>
            </div>
        </div>
        <!--Empresa-->
        <div class="form-group">
            <?= form_label("Empresa  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("company", $dados['usuario']->company . set_value('company'), "class = 'form-control' placeholder = 'Empresa'") ?>
                <span class="help-block"><?= form_error('company') ?></span>
            </div>
        </div>
        <!--Botoes-->
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-5">
                <?= anchor(base_url('cliente'), 'Cancelar', 'class="  btn btn-default"') ?>
                <?= form_submit('salvar', 'Salvar', 'class="  btn btn-success"') ?>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>

<!--Formulario Ajax-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Informações do usuario</h3>
    </div>
    <div class="panel-body">
        <?= form_open(base_url($action), array("id" => "form_ajax", "class" => "form-horizontal", "role" => "form")) ?>
        <?= form_hidden("id", $dados['usuario']->id . set_value('id')) ?>

        <!--Nome-->
        <div class="form-group">
            <?= form_label("Nome  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("first_name", $dados['usuario']->first_name . set_value('first_name'), "class = 'form-control' placeholder = 'Nome'") ?>
                <span class="help-block"><?= form_error('first_name') ?></span>
            </div>
        </div>
        <!--Sobrenome-->
        <div class="form-group">
            <?= form_label("Sobrenome  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("last_name", $dados['usuario']->last_name . set_value('last_name'), "class = 'form-control' placeholder = 'Sobrenome'") ?>
                <span class="help-block"><?= form_error('last_name') ?></span>
            </div>
        </div>
        <!--Emai-->
        <div class="form-group">
            <?= form_label("Emai  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("email", $dados['usuario']->email . set_value('email'), "class = 'form-control' placeholder = 'Emai'") ?>
                <span class="help-block"><?= form_error('email') ?></span>
            </div>
        </div>
        <!--Celular-->
        <div class="form-group">
            <?= form_label("Celular  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("phone", $dados['usuario']->phone . set_value('phone'), "class = 'form-control' placeholder = 'Celular'") ?>
                <span class="help-block"><?= form_error('phone') ?></span>
            </div>
        </div>
        <!--Empresa-->
        <div class="form-group">
            <?= form_label("Empresa  ", '', array("class" => "col-sm-2 control-label")) ?>
            <div class="col-sm-10">
                <?= form_input("company", $dados['usuario']->company . set_value('company'), "class = 'form-control' placeholder = 'Empresa'") ?>
                <span class="help-block"><?= form_error('company') ?></span>
            </div>
        </div>
        <!--Botoes-->
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-5">
                <?= anchor(base_url('cliente'), 'Cancelar', 'class="  btn btn-default"') ?>
                <?= form_submit('salvar', 'Salvar', 'class="  btn btn-success"') ?>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        function save()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('person/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('person/ajax_update') ?>";
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 

                }
            });
        }


        $(".help-block").each(function () {
            if (this.innerHTML) {
                $(this).parent().parent().addClass('has-error');
            }
        });
    });
</script>