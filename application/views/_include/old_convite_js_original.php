<?php $controller = $this->router->class; ?>
<script>
	$(document).ready(function () {
		/*====================================================================================*/
	//Desabilitar funções do DataTable para tabelas com este id="dtDisabled"
	/*$("#dtDisabledCartao,#dtDisabledEnvelope,#dtTabelaConvite,#dtModalPapel").DataTable( {
		"paging":   false,
		"ordering": false,
		"info":     false,
		"searching": false,
		"warning": false,
	} );
	//Desabilita o warning do Datatable
	$.fn.dataTable.ext.errMode = 'none';
	*/
	/*====================================================================================*/
	//Verifica se há um modelo e quantidade no modal de convite
	if($("#convite_modelo option").filter(":selected").val() === "" || $("#quantidade_convite").val() === ""){
		$("#cartao, #envelope, #panel_body_convite").hide();
		$("#form_convite").prop("action", "<?=$controller?>/session_convite_novo");
		$("#md_convite").modal();
	}else{
		$("#btn_criar_convite").hide();
	}

});// FIM: $(document).ready(function ()


//MODAL: CONVITE
function abrir_convite_modal(acao)	{
	if(acao =="novo"){	
		$("#form_convite").prop("action", "<?=$controller?>/session_convite_novo");
		$("#md_convite_titulo").text('Novo Convite');
		$("#btn_mod_qtd_submit").text('Novo');
	}else if(acao =="editar"){
		$("#md_convite_titulo").text('Editar Convite');
		$("#form_convite").prop("action", "<?=$controller?>/session_convite_editar");
		$("#btn_mod_qtd_submit").text('Salvar');
	}
	$("#md_convite").modal();
}

</script>