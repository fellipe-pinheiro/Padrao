<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class;
?>
<script>
	$(document).ready(function () {
		//Checkbox estilizado
		$(':checkbox').checkboxpicker();
		//Esconde ou mostra os itens
		if('<?=$controller?>' == "convite"){
			$("#md_convite_titulo").text('Novo Convite');
			is_empty_modelo_quantidade("#form_convite",'<?=base_url('convite/session_convite_novo')?>',"#cartao, #envelope","#md_convite","convite");
		}else if('<?=$controller?>' == "personalizado"){
			$("#md_personalizado_titulo").text('Novo personalizado');
			is_empty_modelo_quantidade("#form_personalizado",'<?=base_url('personalizado/session_personalizado_novo')?>',"#personalizado","#md_personalizado","personalizado");
		}else{
			console.log("controller não identificado");
		}

		// Filtrar os papeis por linha
		$("#form_select_linha").change(function(event) {
			var option = $(this).find('option:selected');
			var id_linha = option.val();
			ajax_carregar_papel(id_linha,false,null);
		});

		$("#form_select_linha-1").change(function(event) {
			var option = $(this).find('option:selected');
			var id_linha = option.val();
			ajax_carregar_papel1(id_linha,false,null);
		});

		$("#form_select_linha-2").change(function(event) {
			var option = $(this).find('option:selected');
			var id_linha = option.val();
			ajax_carregar_papel2(id_linha,false,null);
		});

		$("#form_select_papel").change(function(event){
			var option = $(this).find('option:selected');
			var id_papel = option.val();
			ajax_carregar_gramatura(id_papel,false,null);
		});

		$("#form_select_papel-1").change(function(event){
			var option = $(this).find('option:selected');
			var id_papel = option.val();
			ajax_carregar_gramatura1(id_papel,false,null);
		});

		$("#form_select_papel-2").change(function(event){
			var option = $(this).find('option:selected');
			var id_papel = option.val();
			ajax_carregar_gramatura2(id_papel,false,null);
		});

		$("#form_select_impressao").change(function(event){
			var option = $(this).find('option:selected');
			var id_impressao = option.val();
			ajax_carregar_impressao_dimensao(id_impressao);
		});

		$("#form_select_fita_material").change(function(event) {
			var option = $(this).find('option:selected');
			var id_material = option.val();
			ajax_carregar_fita(id_material);
		});

		$("#form_select_fita").change(function(){
			var option = $(this).find('option:selected');
			var espessura = option.data("espessura");
			var espessura_selected = $("#form_select_espessura option:selected").val();
			$("#form_select_espessura").val('');
			$.each(espessura, function(index, val) {
				if(val==0){
					$("#form_select_espessura option[value='"+index+"']").hide();
				}else{
					$("#form_select_espessura option[value='"+index+"']").show();
				}
			});
			if(!$("#form_select_espessura option[value='"+espessura_selected+"']")[0].disabled){
				$("#form_select_espessura option[value='"+espessura_selected+"']").prop('selected','selected');
			}
		});

		$("#form_select_cliche").change(function(event){
			var option = $(this).find('option:selected');
			var id_cliche = option.val();
			ajax_carregar_cliche_dimensao(id_cliche);
		});

		$("#form_select_faca").change(function(event){
			var option = $(this).find('option:selected');
			var id_faca = option.val();
			ajax_carregar_faca_dimensao(id_faca);
		});

		$("#personalizado_categoria").change(function(event) {
			var option = $(this).find('option:selected');
			var id_categoria = option.val();
			ajax_carregar_personalizado_modelo(id_categoria);
		});
	});

	function altera_quantidade_empastamento(action, editar = false){
		var qtd_empastamento = $("#qtd_empastamento").val();

		if(action == 'minus'){
			qtd_empastamento--;
		}else if(action == 'plus'){
			qtd_empastamento++;
		}else{
			console.log('Ação indefinida => Função:altera_quantidade_empastamento()');
		}

		switch(qtd_empastamento){
			case 1:
				set_papel1();
				break;
			case 2:
				set_papel2();
				break;
			default :
				set_papel_default();
				break;
		}
		$("#qtd_empastamento").val(qtd_empastamento);
	}

	function set_papel_default() {
		btn_empastamento_ativo(true,false);
		show_papel(false,false);
		papel_action(0,0);
		papel_obrigatorio(false,false);
	}

	function set_papel1() {
		show_papel(true,false);
		papel_action(1,0);
		btn_empastamento_ativo(false,false);
		papel_obrigatorio(true,false);
	}

	function set_papel2() {
		show_papel(true,true);
		papel_action(1,1);
		btn_empastamento_ativo(false,true);
		papel_obrigatorio(true,true);
	}

	function papel_obrigatorio(papel1,papel2) { //(boolean,boolean)
		//habilita e desabilita o select
		$("#form_select_empastamento").prop('disabled', !papel1);
		$("#form_select_empastamento").selectpicker('refresh');

		//required
		$("#form_select_empastamento").attr('required', papel1);

		//papel1
		$("#form_select_linha-1").attr('required', papel1);
		$("#form_select_papel-1").attr('required', papel1);
		$("#form_select_gramatura-1").attr('required', papel1);
		//papel2
		$("#form_select_linha-2").attr('required', papel2);
		$("#form_select_papel-2").attr('required', papel2);
		$("#form_select_gramatura-2").attr('required', papel2);
	}

	function btn_empastamento_ativo(minus,plus) { //(boolean,boolean)
		if('<?=$controller?>' == "personalizado"){
			//desativar botão de adicionar e adiciona o title
			$("#btn_empastamento_minus").attr('disabled', true);
			$("#btn_empastamento_plus").attr('disabled', true);
			$(".div_empastamento_title").attr('title', 'Somente para convite');
		}else{
			$("#btn_empastamento_minus").attr('disabled', minus);
			$("#btn_empastamento_plus").attr('disabled', plus);
		}
	}

	function papel_action(papel1,papel2) { //int (0,1)
		$("#papel_action-1").val(papel1);
		$("#papel_action-2").val(papel2);
	}

	function show_papel(papel1,papel2) { //(boolean,boolean)
		if(papel1){
			$("#papel-1").removeClass("hidden");
		}else{
			$("#papel-1").addClass("hidden");
		}
		if(papel2){
			$("#papel-2").removeClass("hidden");
		}else{
			$("#papel-2").addClass("hidden");
		}
	}

	function editar_papel_modal(owner,posicao,id_dimensao,id_papel,id_linha,id_gramatura,id_empastamento,id_papel1,id_linha1,id_gramatura1,id_papel2,id_linha2,id_gramatura2){

		//TODO receber uma variavel depois da id_gramatura2 para setar o empastamento
		ajax_carregar_empastamento(true,id_empastamento);


		
		ajax_carregar_papel_linha(true,id_linha);
		ajax_carregar_papel_linha1(true,id_linha1);
		ajax_carregar_papel_linha2(true,id_linha2);

		if(id_papel1 != "" && id_linha1 != "" && id_gramatura1 != ""){
			set_papel1();
			$("#qtd_empastamento").val(1);
		}

		if(id_papel2 != "" && id_linha2 != "" && id_gramatura2 != ""){
			set_papel2();
			$("#qtd_empastamento").val(2);
		}

		ajax_carregar_papel(id_linha,true,id_papel);
		ajax_carregar_papel1(id_linha1,true,id_papel1);
		ajax_carregar_papel2(id_linha2,true,id_papel2);

		ajax_carregar_gramatura(id_papel,true,id_gramatura);
		ajax_carregar_gramatura1(id_papel1,true,id_gramatura1);
		ajax_carregar_gramatura2(id_papel2,true,id_gramatura2);


		ajax_session_carregar_dimensoes(owner,id_dimensao,true);
		$("#md_papel_container_owner").val(owner);
		$("#md_papel").modal();
		pre_submit("#form_md_papel","<?=$controller?>/session_papel_editar/" + owner + "/" + posicao,"#md_papel",owner);
	}

	function editar_impressao_modal(owner,posicao,id_impressao,quantidade,descricao,id_dimensao){
		ajax_carregar_impressao(true,id_impressao,id_dimensao);
		ajax_carregar_impressao_dimensao(id_impressao,true,id_dimensao);
		$("#form_qtd_impressao").val(quantidade);
		$("#form_descricao_impressao").val(descricao);
		$("#md_impressao").modal();
		pre_submit("#form_md_impressao","<?=$controller?>/session_impressao_editar/" + owner + "/" + posicao,"#md_impressao",owner);
	}
	
	function editar_acabamento_modal(owner,posicao,id_acabamento,quantidade,descricao){
		ajax_carregar_acabamento(true,id_acabamento);
		$("#form_qtd_acabamento").val(quantidade);
		$("#form_descricao_acabamento").val(descricao);
		$("#md_acabamento").modal();
		pre_submit("#form_md_acabamento","<?=$controller?>/session_acabamento_editar/" + owner + "/" + posicao,"#md_acabamento",owner);
	}
	
	function editar_acessorio_modal(owner,posicao,id_acessorio,quantidade,descricao){
		ajax_carregar_acessorio(true,id_acessorio);
		$("#form_qtd_acessorio").val(quantidade);
		$("#form_descricao_acessorio").val(descricao);
		$("#md_acessorio").modal();
		pre_submit("#form_md_acessorio","<?=$controller?>/session_acessorio_editar/" + owner + "/" + posicao,"#md_acessorio",owner);
	}

	function editar_fita_modal(owner,posicao,id_fita,quantidade,descricao,espessura,id_fita_material){
		ajax_carregar_fita_material(true,id_fita_material);
		ajax_carregar_fita(id_fita_material,true,id_fita);
		$("#form_select_espessura option[value=" + espessura + "]").prop("selected", true);
		$("#form_qtd_fita").val(quantidade);
		$("#form_descricao_fita").val(descricao);
		$("#md_fita").modal();
		pre_submit("#form_md_fita","<?=$controller?>/session_fita_editar/" + owner + "/" + posicao,"#md_fita",owner);
	}
	
	function editar_cliche_modal(owner,posicao,id_cliche,quantidade,descricao,id_dimensao,cobrarServico,cobrarCliche){
		ajax_carregar_cliche(true,id_cliche,id_dimensao);
		ajax_carregar_cliche_dimensao(id_cliche,true,id_dimensao);
		$("#form_qtd_cliche").val(quantidade);
		$("#form_descricao_cliche").val(descricao);
		if(cobrarServico ==1){
			$('#cobrar_servicoCliche').prop('checked',true);
		}else{
			$('#cobrar_servicoCliche').prop('checked',false);
		}
		if(cobrarCliche ==1){
			$('#cobrar_cliche').prop('checked',true);
		}else{
			$('#cobrar_cliche').prop('checked',false);
		}

		$("#md_cliche").modal();
		pre_submit("#form_md_cliche","<?=$controller?>/session_cliche_editar/" + owner + "/" + posicao,"#md_cliche",owner);
	}

	function editar_faca_modal(owner,posicao,id_faca,quantidade,descricao,id_dimensao,cobrarServico,cobrarCliche){
		ajax_carregar_faca(true,id_faca,id_dimensao);
		ajax_carregar_faca_dimensao(id_faca,true,id_dimensao);
		$("#form_qtd_faca").val(quantidade);
		console.log(descricao);
		$("#form_descricao_faca").val(descricao);
		if(cobrarServico ==1){
			$('#cobrar_servicoFaca').prop('checked',true);
		}else{
			$('#cobrar_servicoFaca').prop('checked',false);
		}
		if(cobrarCliche ==1){
			$('#cobrar_faca').prop('checked',true);
		}else{
			$('#cobrar_faca').prop('checked',false);
		}

		$("#md_faca").modal();
		pre_submit("#form_md_faca","<?=$controller?>/session_faca_editar/" + owner + "/" + posicao,"#md_faca",owner);
	}

	function editar_laser_modal(owner,posicao,id_laser,quantidade,qtd_minutos,descricao){
		ajax_carregar_laser(true,id_laser);
		$("#form_qtd_laser").val(quantidade);
		$("#form_qtdMinutos_laser").val(qtd_minutos);
		$("#form_descricao_laser").val(descricao);
		$("#md_laser").modal();
		pre_submit("#form_md_laser","<?=$controller?>/session_laser_editar/" + owner + "/" + posicao,"#md_laser",owner);
	}

	function abrir_papel_modal(owner){
		$("#md_papel_container_owner").val(owner);
		reset_form("#form_md_papel");
		$("#form_select_gramatura").find('option').remove();
		$('#form_select_papel').selectpicker('val', '');
		pre_submit("#form_md_papel","<?=$controller?>/session_papel_inserir/"+owner,"#md_papel",owner);
		//remove_form_select_option_papel();
		limpar_select($('#form_select_dimensao'),true);
		limpar_select($('#form_select_papel'),false);

		//TODO não esta funcionando...=> limpar_select()
		limpar_select($('#form_select_papel-1'),false);
		limpar_select($('#form_select_papel-2'),false);

		set_papel_default();

		//remover o atributo required dos papeins 1 e 2
		ajax_carregar_papel_linha(false,null);
		ajax_carregar_papel_linha1(false,null);
		ajax_carregar_papel_linha2(false,null);

        ajax_carregar_empastamento(false,null);
        ajax_session_carregar_dimensoes(owner);
	}

	function abrir_impressao_modal(owner){
		reset_form("#form_md_impressao");
		pre_submit("#form_md_impressao","<?=$controller?>/session_impressao_inserir/"+owner,"#md_impressao",owner);
		$('#form_select_impressao').selectpicker('val', '');
		limpar_select($('#form_select_impressao_dimensao'));
		ajax_carregar_impressao();
	}

	function abrir_acabamento_modal(owner){
		reset_form("#form_md_acabamento");
		pre_submit("#form_md_acabamento","<?=$controller?>/session_acabamento_inserir/"+owner,"#md_acabamento",owner);
		$('#form_select_acabamento').selectpicker('val', '');
		ajax_carregar_acabamento();
	}

	function abrir_acessorio_modal(owner){
		reset_form("#form_md_acessorio");
		pre_submit("#form_md_acessorio","<?=$controller?>/session_acessorio_inserir/"+owner,"#md_acessorio",owner);
		$('#form_select_acessorio').selectpicker('val', '');
		ajax_carregar_acessorio();
	}

	function abrir_fita_modal(owner){
		reset_form("#form_md_fita");
		//$('#form_select_fita').selectpicker('val', '');
		$('#form_select_fita').selectpicker('destroy');
		pre_submit("#form_md_fita","<?=$controller?>/session_fita_inserir/"+owner,"#md_fita",owner);
		//remove_form_select_option_fita();
		limpar_select($('#form_select_fita'));
		ajax_carregar_fita_material();
	}

	function abrir_cliche_modal(owner){
		reset_form("#form_md_cliche");
		pre_submit("#form_md_cliche","<?=$controller?>/session_cliche_inserir/"+owner,"#md_cliche",owner);
		$('#form_select_cliche').selectpicker('val', '');
		limpar_select($('#form_select_cliche_dimensao'));
		ajax_carregar_cliche();
	}
	
	function abrir_faca_modal(owner){
		reset_form("#form_md_faca");
		pre_submit("#form_md_faca","<?=$controller?>/session_faca_inserir/"+owner,"#md_faca",owner);
		$('#form_select_faca').selectpicker('val', '');
		limpar_select($('#form_select_faca_dimensao'));
		ajax_carregar_faca();
	}

	function abrir_laser_modal(owner){
		reset_form("#form_md_laser");
		pre_submit("#form_md_laser","<?=$controller?>/session_laser_inserir/"+owner,"#md_laser",owner);
		$('#form_select_laser').selectpicker('val', '');
		ajax_carregar_laser();
	}

	function ajax_session_carregar_dimensoes(owner, id_dimensao = null,editar = false) {
		var dimensao = $("#form_select_dimensao option:selected").val();
		switch(owner) {
		    case 'cartao':
		    	url = '<?= base_url("convite/ajax_session_carregar_dimensoes/cartao")?>'
		        break;
		    case 'envelope':
		        url = '<?= base_url("convite/ajax_session_carregar_dimensoes/envelope")?>'
		        break;
		    case 'personalizado':
		        url = '<?= base_url("personalizado/ajax_session_carregar_dimensoes/personalizado")?>'
		        break;
		}
		limpar_select($('#form_select_dimensao'),true);

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_dimensao'));
			$.each(data.dimensoes, function(index, val) {
				selected = false;
				if(val.id == dimensao && !editar){
					selected = true;
				}else if(val.id == id_dimensao && editar){
					selected = true;
				}
				$('#form_select_dimensao').append($('<option>', {
				    value: val.id,
				    text: val.nome,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
		});
	}

	function ajax_carregar_papel_linha( editar = false, id_linha = null ) {
		$('#form_select_linha')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("papel_linha/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_linha').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel_linha");
		})
		.always(function() {
			$('#form_select_linha').selectpicker('refresh');
			if(editar){
				$('#form_select_linha').selectpicker('val', id_linha);
			}
		});
	}

	function ajax_carregar_papel_linha1( editar = false, id_linha = null ) {
		$('#form_select_linha-1')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("papel_linha/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_linha-1').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel_linha");
		})
		.always(function() {
			$('#form_select_linha-1').selectpicker('refresh');
			if(editar){
				$('#form_select_linha-1').selectpicker('val', id_linha);
			}
		});
	}

	function ajax_carregar_papel_linha2( editar = false, id_linha = null ) {
		$('#form_select_linha-2')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("papel_linha/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_linha-2').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel_linha");
		})
		.always(function() {
			$('#form_select_linha-2').selectpicker('refresh');
			if(editar){
				$('#form_select_linha-2').selectpicker('val', id_linha);
			}
		});
	}

	function ajax_carregar_empastamento( editar = false, id_empastamento = null ) {
		$('#form_select_empastamento')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("papel_empastamento/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_empastamento').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel_linha");
		})
		.always(function() {
			$('#form_select_empastamento').selectpicker('refresh');
			if(editar){
				$('#form_select_empastamento').selectpicker('val', id_empastamento);
			}
		});
	}

	function ajax_carregar_papel(id_linha,editar = false, id_papel = null) {
		$('#form_select_papel').selectpicker('destroy');
		limpar_select($('#form_select_papel'),true);
		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
			data: {id_linha: id_linha}
		})
		.done(function(data) {
			limpar_select($('#form_select_papel'));
			$.each(data, function(index, val) {
				$('#form_select_papel').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
			$('#form_select_papel').selectpicker('refresh');
			if(editar){
				$('#form_select_papel').selectpicker('val', id_papel);
			}
		});
	}

	function ajax_carregar_papel1(id_linha,editar = false, id_papel = null) {
		$('#form_select_papel-1').selectpicker('destroy');
		limpar_select($('#form_select_papel-1'),true);
		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
			data: {id_linha: id_linha}
		})
		.done(function(data) {
			limpar_select($('#form_select_papel-1'));
			$.each(data, function(index, val) {
				$('#form_select_papel-1').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
			$('#form_select_papel-1').selectpicker('refresh');
			if(editar){
				$('#form_select_papel-1').selectpicker('val', id_papel);
			}
		});
	}

	function ajax_carregar_papel2(id_linha,editar = false, id_papel = null) {
		$('#form_select_papel-2').selectpicker('destroy');
		limpar_select($('#form_select_papel-2'),true);
		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
			data: {id_linha: id_linha}
		})
		.done(function(data) {
			limpar_select($('#form_select_papel-2'));
			$.each(data, function(index, val) {
				$('#form_select_papel-2').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
			$('#form_select_papel-2').selectpicker('refresh');
			if(editar){
				$('#form_select_papel-2').selectpicker('val', id_papel);
			}
		});
	}

	function ajax_carregar_gramatura( id, editar = false, id_gramatura = null) {
		var gramatura = $("#form_select_gramatura option:selected").text();
		limpar_select($('#form_select_gramatura'), true);

		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado_gramatura/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_gramatura'));
			$.each(data, function(index, val) {
				selected = false;
				if(val.gramatura == gramatura && !editar){
					selected = true;
				}else if(val.id == id_gramatura && editar){
					selected = true;
				}
				$('#form_select_gramatura').append($('<option>', {
				    value: val.id,
				    text: val.gramatura,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
		});
	}

	function ajax_carregar_gramatura1( id, editar = false, id_gramatura = null) {
		var gramatura = $("#form_select_gramatura-1 option:selected").text();
		limpar_select($('#form_select_gramatura-1'), true);

		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado_gramatura/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_gramatura-1'));
			$.each(data, function(index, val) {
				selected = false;
				if(val.gramatura == gramatura && !editar){
					selected = true;
				}else if(val.id == id_gramatura && editar){
					selected = true;
				}
				$('#form_select_gramatura-1').append($('<option>', {
				    value: val.id,
				    text: val.gramatura,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
		});
	}

	function ajax_carregar_gramatura2( id, editar = false, id_gramatura = null) {
		var gramatura = $("#form_select_gramatura-2 option:selected").text();
		limpar_select($('#form_select_gramatura-2'), true);

		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado_gramatura/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_gramatura-2'));
			$.each(data, function(index, val) {
				selected = false;
				if(val.gramatura == gramatura && !editar){
					selected = true;
				}else if(val.id == id_gramatura && editar){
					selected = true;
				}
				$('#form_select_gramatura-2').append($('<option>', {
				    value: val.id,
				    text: val.gramatura,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
		});
	}

	function ajax_carregar_impressao( editar = false, id_impressao = null, id_dimensao = null) {
		$('#form_select_impressao')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("impressao/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_impressao').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_impressao");
		})
		.always(function() {
			$('#form_select_impressao').selectpicker('refresh');
			if(editar){
				$('#form_select_impressao').selectpicker('val', id_impressao);
			}
		});
	}

	function ajax_carregar_impressao_dimensao( id, editar = false, idImpressaoDimensao = null) {
		limpar_select($('#form_select_impressao_dimensao'), true);

		$.ajax({
			url: '<?= base_url("impressao/ajax_get_personalizado_impressao_dimensao/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_impressao_dimensao'));
			$.each(data, function(index, val) {
				selected = false;
				if(val.id == idImpressaoDimensao && editar){
					selected = true;
				}
				$('#form_select_impressao_dimensao').append($('<option>', {
				    value: val.id,
				    text: val.nome,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_impressao_dimensao");
		})
		.always(function() {
		});
	}

	function ajax_carregar_acabamento(editar = false,id_acabamento = null) {
		$('#form_select_acabamento')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("acabamento/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_acabamento').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_acabamento");
		})
		.always(function() {
			$('#form_select_acabamento').selectpicker('refresh');
			if(editar){
				$('#form_select_acabamento').selectpicker('val', id_acabamento);
			}
		});
	}

	function ajax_carregar_cliche(editar = false, id_cliche = null, id_dimensao = null) {
		$('#form_select_cliche')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("cliche/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_cliche').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_cliche");
		})
		.always(function() {
			$('#form_select_cliche').selectpicker('refresh');
			if(editar){
				$('#form_select_cliche').selectpicker('val', id_cliche);
			}
		});
	}

	function ajax_carregar_cliche_dimensao(id,editar = false, idClicheDimensao = null) {
		limpar_select($('#form_select_cliche_dimensao'), true);

		$.ajax({
			url: '<?= base_url("cliche/ajax_get_personalizado_cliche_dimensao/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_cliche_dimensao'));
			$.each(data, function(index, val) {
				selected = false;
				if(val.id == idClicheDimensao && editar){
					selected = true;
				}
				$('#form_select_cliche_dimensao').append($('<option>', {
				    value: val.id,
				    text: val.nome,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_cliche_dimensao");
		})
		.always(function() {
		});
	}

	function ajax_carregar_faca(editar = false, id_faca = null, id_dimensao = null) {
		$('#form_select_faca')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("faca/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_faca').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_faca");
		})
		.always(function() {
			$('#form_select_faca').selectpicker('refresh');
			if(editar){
				$('#form_select_faca').selectpicker('val', id_faca);
			}
		});
	}

	function ajax_carregar_faca_dimensao(id,editar = false, idClicheDimensao = null) {
		limpar_select($('#form_select_faca_dimensao'), true);

		$.ajax({
			url: '<?= base_url("faca/ajax_get_personalizado_faca_dimensao/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			limpar_select($('#form_select_faca_dimensao'));
			$.each(data, function(index, val) {
				selected = false;
				if(val.id == idClicheDimensao && editar){
					selected = true;
				}
				$('#form_select_faca_dimensao').append($('<option>', {
				    value: val.id,
				    text: val.nome,
				    selected: selected
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_faca_dimensao");
		})
		.always(function() {
		});
	}

	function ajax_carregar_laser(editar = false,id_laser = null) {
		$('#form_select_laser')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("laser/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_laser').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_laser");
		})
		.always(function() {
			$('#form_select_laser').selectpicker('refresh');
			if(editar){
				$('#form_select_laser').selectpicker('val', id_laser);
			}
		});
	}

	function ajax_carregar_acessorio(editar = false,id_acessorio = null) {
		$('#form_select_acessorio')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("acessorio/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_acessorio').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_acessorio");
		})
		.always(function() {
			$('#form_select_acessorio').selectpicker('refresh');
			if(editar){
				$('#form_select_acessorio').selectpicker('val', id_acessorio);
			}
		});
	}

	function ajax_carregar_fita_material(editar = false,id_fita_material = null) {
		$('#form_select_fita_material')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("fita_material/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			console.log(data);
			$.each(data, function(index, val) {
				$('#form_select_fita_material').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_fita_material");
		})
		.always(function() {
			$('#form_select_fita_material').selectpicker('refresh');
			if(editar){
				$('#form_select_fita_material').selectpicker('val', id_fita_material);
			}
		});
	}

	function ajax_carregar_fita(id_material,editar = false, id_fita = null) {
		//remove_form_select_option_fita();
		limpar_select($('#form_select_fita'),true);
		$.ajax({
			url: '<?= base_url("fita/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
			data: {id_material: id_material}
		})
		.done(function(data) {
			limpar_select($('#form_select_fita'));
			$.each(data, function(index, val) {
				espessura = {3:val.valor_03mm,7:val.valor_07mm,10:val.valor_10mm,15:val.valor_15mm,22:val.valor_22mm,38:val.valor_38mm,50:val.valor_50mm,70:val.valor_70mm};
				espessura = JSON.stringify(espessura);
				$('#form_select_fita').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}).attr('data-espessura', espessura));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_fita");
		})
		.always(function() {
			$('#form_select_fita').selectpicker('refresh');
			if(editar){
				$('#form_select_fita').selectpicker('val', id_fita);
				$("#form_select_fita").change();
			}
		});
	}

	function ajax_carregar_convite_modelo(editar = false,id_modelo = null) {
		$('#convite_modelo')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("convite_modelo/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#convite_modelo').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_convite_modelo");
		})
		.always(function() {
			$('#convite_modelo').selectpicker('refresh');
			if(editar){
				$('#convite_modelo').selectpicker('val', id_modelo);
			}
		});
	}

	function ajax_carregar_mao_obra(editar = false,id_mao_obra = null) {
		$('#md_mao_obra_select')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		$.ajax({
			url: '<?= base_url("mao_obra/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#md_mao_obra_select').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_mao_obra");
		})
		.always(function() {
			if(editar){
				$("#md_mao_obra_select option[value='"+id_mao_obra+"']").attr("selected", "selected");
			}else{
				$("#md_mao_obra_select option[value='']").attr("selected", "selected");
			}
		});
	}

	function ajax_carregar_personalizado_categoria(editar = false,id_categoria = null) {
		$('#personalizado_categoria')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');
		    $('#personalizado_modelo').selectpicker('val', '');
		$.ajax({
			url: '<?= base_url("personalizado_categoria/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#personalizado_categoria').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_personalizado_categoria");
		})
		.always(function() {
			$('#personalizado_categoria').selectpicker('refresh');
			if(editar){
				$('#personalizado_categoria').selectpicker('val', id_categoria);
			}
		});
	}

	function ajax_carregar_personalizado_modelo(id_categoria,editar = false, id_modelo = null) {
		remove_form_select_option_personalizado_modelo();
		$.ajax({
			url: '<?= base_url("personalizado_modelo/ajax_get_personalizado/")?>'+id_categoria,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#personalizado_modelo').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
			$('#personalizado_modelo').selectpicker('refresh');
			if(editar){
				$('#personalizado_modelo').selectpicker('val', id_modelo);
			}
		});
	}
	
	function excluir_papel(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_papel_excluir",owner,posicao);
	}

	function excluir_impressao(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_impressao_excluir",owner,posicao);
	}

	function excluir_acabamento(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_acabamento_excluir",owner,posicao);
	}

	function excluir_acessorio(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_acessorio_excluir",owner,posicao);
	}

	function excluir_fita(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_fita_excluir",owner,posicao);
	}

	function excluir_cliche(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_cliche_excluir",owner,posicao);
	}

	function excluir_faca(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_faca_excluir",owner,posicao);
	}

	function excluir_laser(owner,posicao) {
		excluir_item_posicao("<?=$controller?>/session_laser_excluir",owner,posicao);
	}

	function excluir_convite() {
		main_excluir('<?=base_url('convite/session_convite_excluir')?>','convite');
	}

	function excluir_personalizado(){
		main_excluir('<?=base_url('personalizado/session_personalizado_excluir')?>','personalizado');	
	}

	function excluir_mao_obra() {
		main_excluir('<?=base_url($controller.'/session_mao_obra_excluir')?>','mao_obra');
	}

	function excluir_itens_personalizado() {
		main_excluir('<?=base_url('personalizado/session_personalizado_itens_excluir')?>','itens_personalizado');
	}

	function mao_obra_modal(acao,id_mao_obra = null){
		console.log('Função: mao_obra_modal()');
		reset_errors();
		if(acao === "inserir"){
			pre_submit("#form_mao_obra","<?=$controller?>/session_mao_obra_inserir","#md_mao_obra",'');
		}else if(acao === "editar"){
			pre_submit("#form_mao_obra","<?=$controller?>/session_mao_obra_editar","#md_mao_obra",'');
		}
		if(id_mao_obra ===''){
			ajax_carregar_mao_obra();
		}else{
			ajax_carregar_mao_obra(true,id_mao_obra);
			console.log("caiu")
		}
		$("#md_mao_obra").modal();
	}

	function descricao_modal(){
		console.log('Função: descricao_modal(');
		pre_submit("#form_descricao","<?=$controller?>/session_descricao","#md_descricao",'');
		$("#md_descricao").modal();
	}
	
	function personalizado_modal(editar = false,id_modelo = "",id_categoria = "",quantidade = "")	{
		console.log("Função: personalizado_modal()");
		reset_errors();
		if(id_modelo == ""){
			remove_form_select_option_personalizado_modelo();
			ajax_carregar_personalizado_categoria();
			$('#personalizado_modelo').selectpicker('val', '');
			$("#quantidade_personalizado").val(null);
		}else{
			ajax_carregar_personalizado_categoria(true,id_categoria);
			ajax_carregar_personalizado_modelo(id_categoria,true, id_modelo);
			$('#personalizado_modelo').selectpicker('val', id_modelo);
			$("#quantidade_personalizado").val(quantidade);
		}
		if(!editar){
			$("#md_personalizado_titulo").text('Novo personalizado');
			pre_submit("#form_personalizado","<?=$controller?>/session_personalizado_novo","#md_personalizado",'personalizado');
		}else{
			$("#md_personalizado_titulo").text('Editar personalizado');
			pre_submit("#form_personalizado","<?=$controller?>/session_personalizado_editar","#md_personalizado",'personalizado');
		}
		$("#md_personalizado").modal();
	}
	
	function convite_modal(acao,id_modelo,quantidade)	{
		console.log("Função: convite_modal()");
		reset_errors();
		if(id_modelo == ''){
			ajax_carregar_convite_modelo();
			$('#convite_modelo').selectpicker('val', '');
			$("#quantidade_convite").val(null);
		}else{
			ajax_carregar_convite_modelo(true,id_modelo);
			$("#quantidade_convite").val(quantidade);
		}
		if(acao =="inserir"){
			$("#md_convite_titulo").text('Novo Convite');
			pre_submit("#form_convite","<?=$controller?>/session_convite_novo","#md_convite","convite");
		}else if(acao =="editar"){
			$("#md_convite_titulo").text('Editar Convite');
			pre_submit("#form_convite","<?=$controller?>/session_convite_editar","#md_convite","convite");
		}else{
			console.log("Nenhuma ação foi definida");
		}
		$("#md_convite").modal();
	}
	
	//AJAX
	/*Variaveis globais para o ajax*/
	var form_ajax;
	var url_ajax;
	var modal_ajax;
	var owner_ajax;
	function pre_submit(form,url,modal,owner) {
		console.log('Função: pre_submit()');
		form_ajax = form;
		url_ajax = url;
		modal_ajax = modal;
		owner_ajax = owner;
	}

	//Adiciona ou Edita (papel,impressao, acabamento, acessório, fita)
	$(".form_ajax").submit(function (event) {
		console.log('Função: $(".form_ajax")');
		event.preventDefault();
		disable_button_salvar();
		reset_errors();
		var form = form_ajax;
		var url = url_ajax;
		var modal = modal_ajax;
		var owner = owner_ajax;
		$.ajax({
			url: url,
			type: "POST",
			data: $(form).serialize(),
			dataType: "JSON",
		}).done(function(data) {
			console.log('success: $(".form_ajax")');
			if (data.status){
				$(modal).modal('hide');
				reload_table(owner,data.msg);
				//selectpicker_papel_clear();
				//selectpicker_fita_clear();
			}
			else{
				$.map(data.form_validation, function (value, index) {
					$('[name="' + index + '"]').closest(".form-group").addClass('has-error');
					$('[name="' + index + '"]').closest(".form-group").find('.help-block').text(value);
				});
			}
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			console.log('error: $(".form_ajax")');
			$.alert({
				title: 'Aviso!',
				content: 'Não foi possível Adicionar ou Editar! Tente novamente.',
			});
		})
		.always(function() {
			console.log('complete: $(".form_ajax")');
			enable_button_salvar();
		});
	});

	//Função acionada na view para excluir da sessao: papel, impressao, acabamento, acessorio, fita
	function excluir_item_posicao(url,owner,posicao) {
		console.log('Função: excluir_item_posicao()');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {
				owner: owner,
				posicao: posicao
			},
		})
		.done(function(data) {
			console.log("success: excluir_item_posicao()");
			reload_table(owner,data.msg);
		})
		.fail(function() {
			console.log("error: excluir_item_posicao()");
		})
	}

	//Ação para excluir (convite/personalizado)
	function main_excluir(url,item) {
		console.log("Função: main_excluir()");
		$.confirm({
			title: 'Confirmação!',
			content: 'Deseja realmente excluir: '+item+'?',
			confirm: function(){
				$.alert('Excluido com sucesso!');
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
				})
				.done(function(data) {
					console.log("success: main_excluir()");
					if(item == 'convite'){
						$("#cartao, #envelope").hide();
					}else if(item == 'personalizado'){
						$("#personalizado").hide();
					}else if(item == 'mao_obra'){
						//reload_table('personalizado',data.msg);
					}else if(item == 'itens_personalizado'){
						reload_table('personalizado',data.msg);
					}
				})
				.fail(function() {
					console.log("error:  main_excluir()");
				})
				.always(function(data) {
					console.log("complete: main_excluir()");
					$.ajax({
						url: '<?=base_url($controller)?>',
						type: 'POST',
						dataType: 'html',
					})
					.done(function(data) {
						console.log("success')");
						$('.main_panel').html($('.main_panel' , data).html());
					})
					.fail(function(){
						console.log("error");
					})
				});
			},
			cancel: function(){
				$.alert('Operação canceleda!');
			}
		});
	}

	function add_to_orcamento() {
		disable_button_salvar();
		$('.btnAddOrcamento').addClass('disabled');
		console.log("Função: add_to_orcamento()");
		if('<?=$controller?>' == "convite"){
			is_empty_container_itens('<?=base_url('convite/is_empty_container_itens')?>','<?=base_url('convite/finalizar')?>');
		}else if('<?=$controller?>' == "personalizado"){
			is_empty_container_itens('<?=base_url('personalizado/is_empty_container_itens')?>','<?=base_url('personalizado/finalizar')?>');
		}
	}

	//Verifica se o container está vazio e adiciona ao orçamento
	function is_empty_container_itens(url,redirect) {
		console.log("Função: is_empty_container_itens()");
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
		})
		.done(function(data) {
			console.log("success");
			if(data.status){
				$.confirm({
					title:'Preparando para salvar...',
					content:'Deseja realmente salvar?',
					confirmButton: 'Salvar',
					cancelButton: 'Fechar',
					confirm: function(){
						window.location.replace(redirect);
					},
					cancel: function(){
						$.alert({
							title: '',
							content: 'Operação cancelada com sucesso!',
						});
					}
				});
			}else{
				if(data.location === 'mao_obra'){
					$.confirm({
						title:'Atenção!',
						content:'A mão de obra não definida.',
						confirmButton: 'Mão de obra',
						cancelButton: 'Fechar',
						confirm: function(){
							mao_obra_modal('inserir','');
						},
						cancel: function(){
							$.alert({
								title: '',
								content: 'Operação cancelada com sucesso!',
							});
						}
					});
				}else{
					$.alert({
						title: 'Atenção!',
						content: data.msg,
					});
				}
			}
		})
		.fail(function() {
			console.log("error: erro ao verificar se is_empty_container_itens() do servidor ");
		})
		.always(function() {
			console.log("complete");
			$('.btnAddOrcamento').removeClass('disabled');
			enable_button_salvar();
		});
	}

	//Verifica se há um modelo e quantidade
	function is_empty_modelo_quantidade(form,url,itens,modal,owner) {
		$.ajax({
			url: '<?=base_url($controller.'/is_empty_modelo_quantidade')?>',
			type: 'POST',
			dataType: 'JSON',
		})
		.done(function(data) {
			console.log("success");
			if(data.status){
				$(itens).show()
			}
			else{
				console.log(itens);
				$(itens).hide();
				pre_submit(form,url,modal,owner)
				$(modal).modal();
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			if(owner === 'convite'){
				ajax_carregar_convite_modelo();
			}else if(owner === 'personalizado'){
				ajax_carregar_personalizado_categoria();
			}
		});	
	}

	//Avisos para o uruário...(não utilizado no momento.Obs: melhorar alerts)
	function user_info(msg){
		$(".alert").show();
		$(".alert").addClass('alert-success').html(msg);
		$(".alert").fadeOut(5000);
	}

	function reload_table(owner,msg){
		console.log('Função: reload_table()');
		$.ajax({
			url: '<?=base_url($controller)?>',
			type: 'POST',
			dataType: 'html',
		})
		.done(function(data) {
			console.log('success: reload_table()');
			if(owner === 'cartao'){
				$('#tabela_cartao').html($('#tabela_cartao' , data).html());
			}
			else if(owner === 'envelope'){
				$('#tabela_envelope').html($('#tabela_envelope' , data).html());
			}
			else if(owner === 'personalizado'){
				$("#personalizado").show();
				$('#tabela_personalizado').html($('#tabela_personalizado' , data).html());
			}
			else if(owner === 'convite'){
				$("#cartao, #envelope").show();
				$('#tabela_cartao').html($('#tabela_cartao' , data).html());
				$('#tabela_envelope').html($('#tabela_envelope' , data).html());
			}
		})
		.fail(function() {
			console.log('error: reload_table()');
		}).always(function(data) {
			console.log('complete: reload_table()');
			$('.main_panel').html($('.main_panel' , data).html());
			//user_info(msg);
		});	
	}

	function reset_form(form) {
        $(form)[0].reset(); // Zerar formulario
        reset_errors();
    }

	function remove_form_select_option_personalizado_modelo() {
		$('#personalizado_modelo')
	    .find('option')
	    .remove()
	    .end()
	    .append('<option value="">Selecione</option>')
	    .val('');
	}
</script>