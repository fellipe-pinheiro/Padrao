<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$controller = $this->router->class;
?>
<script>
	$(document).ready(function () {
		//Empastamento:
		$($('#empastamento_cobrar').parent().children()[1]).addClass('hidden');
		$('#empastamento_quantidade').attr("disabled", true);

		$($($('#empastamento_adicionar').parent().children()[1])).click(function () {
			alteraEmpastamento();
		});
		/*====================================================================================*/
		//Laminação:
		$($('#laminacao_cobrar').parent().children()[1]).addClass('hidden');
		$('#laminacao_quantidade').attr("disabled", true);

		$($($('#laminacao_adicionar').parent().children()[1])).click(function () {
			alteraLaminacao();
		});
		/*====================================================================================*/
		//Douração:
		$($('#douracao_cobrar').parent().children()[1]).addClass('hidden');
		$('#douracao_quantidade').attr("disabled", true);

		$($($('#douracao_adicionar').parent().children()[1])).click(function () {
			alteraDouracao();
		});
		/*====================================================================================*/
		//Corte Laser:
		$($('#corte_laser_cobrar').parent().children()[1]).addClass('hidden');
		$('#corte_laser_quantidade').attr("disabled", true);
		$('#corte_laser_minutos').attr("disabled", true);

		$($($('#corte_laser_adicionar').parent().children()[1])).click(function () {
			alteraCorteLaser();
		});
		/*====================================================================================*/
		//Relevo Seco:
		$($('#relevo_seco_cobrar').parent().children()[1]).addClass('hidden');
		$($('#relevo_seco_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		$('#relevo_seco_quantidade').attr("disabled", true);

		$($($('#relevo_seco_adicionar').parent().children()[1])).click(function () {
			alteraRelevoSeco();
		});
		/*====================================================================================*/
		//Corte e Vinco:
		$($('#corte_vinco_cobrar').parent().children()[1]).addClass('hidden');
		$($('#corte_vinco_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		$('#corte_vinco_quantidade').attr("disabled", true);

		$($($('#corte_vinco_adicionar').parent().children()[1])).click(function () {
			alteraCorteVinco();
		});
		/*====================================================================================*/
		//Almofada:
		$($('#almofada_cobrar').parent().children()[1]).addClass('hidden');
		$($('#almofada_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		$('#almofada_quantidade').attr("disabled", true);

		$($($('#almofada_adicionar').parent().children()[1])).click(function () {
			alteraAlmofada();
		});
		/*====================================================================================*/
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
			ajax_carregar_papel(id_linha);
		});

		$("#form_select_papel").change(function(event){
			var option = $(this).find('option:selected');
			var id_papel = option.val();
			ajax_carregar_gramatura(id_papel);
		});

		$("#form_select_impressao_area").change(function(event) {
			var option = $(this).find('option:selected');
			var id_area = option.val();
			ajax_carregar_impressao(id_area);
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
					$("#form_select_espessura option[value='"+index+"']").prop('disabled','disabled');
				}else{
					$("#form_select_espessura option[value='"+index+"']").prop('disabled','');
				}
			});
			if(!$("#form_select_espessura option[value='"+espessura_selected+"']")[0].disabled){
				$("#form_select_espessura option[value='"+espessura_selected+"']").prop('selected','selected');
			}
		});

		$("#personalizado_categoria").change(function(event) {
			var option = $(this).find('option:selected');
			var id_categoria = option.val();
			ajax_carregar_personalizado_modelo(id_categoria);
		});
	});

	function alteraEmpastamento(){
		if($('#empastamento_adicionar').is(':checked')){
			empastamentoOn();		
		}else{
			empastamentoOff();
		}
	}

	function alteraLaminacao(){
		if($('#laminacao_adicionar').is(':checked')){
			laminacaoOn();
		}else{
			laminacaoOff();
		}
	}

	function alteraDouracao(){
		if($('#douracao_adicionar').is(':checked')){
			douracaoOn();
		}else{
			douracaoOff()
		}
	}

	function alteraCorteLaser(){
		if($('#corte_laser_adicionar').is(':checked')){
			corteLaserOn();
		}else{
			corteLaserOff();
		}
	}

	function alteraRelevoSeco(){
		if($('#relevo_seco_adicionar').is(':checked')){
			relevoSecoOn();
		}else{
			relevoSecoOff();
		}
	}

	function alteraCorteVinco(){
		if($('#corte_vinco_adicionar').is(':checked')){
			corteVincoOn();
		}else{
			corteVincoOff();
		}
	}

	function alteraAlmofada(){
		if($('#almofada_adicionar').is(':checked')){
			almofadaOn();
		}else{
			almofadaOff();
		}
	}

	function empastamentoOn(){
		$($('#empastamento_cobrar').parent().children()[1]).removeClass('hidden');
		$('#empastamento_cobrar').prop('checked', true);
		$('#empastamento_quantidade').attr("disabled", false);
		$('#empastamento_quantidade').val(1);
	}

	function empastamentoOff(){
		$($('#empastamento_cobrar').parent().children()[1]).addClass('hidden');
		$('#empastamento_cobrar').prop('checked', false);
		$('#empastamento_quantidade').attr("disabled", true);
		$('#empastamento_quantidade').val(null);
	}

	function laminacaoOn() {
		$($('#laminacao_cobrar').parent().children()[1]).removeClass('hidden');
		$('#laminacao_cobrar').prop('checked', true);
		$('#laminacao_quantidade').attr("disabled", false);
		$('#laminacao_quantidade').val(1);
	}

	function laminacaoOff() {
		$($('#laminacao_cobrar').parent().children()[1]).addClass('hidden');
		$('#laminacao_cobrar').prop('checked', false);
		$('#laminacao_quantidade').attr("disabled", true);
		$('#laminacao_quantidade').val(null);
	}

	function douracaoOn() {
		$($('#douracao_cobrar').parent().children()[1]).removeClass('hidden');
		$('#douracao_cobrar').prop('checked', true);
		$('#douracao_quantidade').attr("disabled", false);
		$('#douracao_quantidade').val(1);
	}

	function douracaoOff() {
		$($('#douracao_cobrar').parent().children()[1]).addClass('hidden');
		$('#douracao_cobrar').prop('checked', false);
		$('#douracao_quantidade').attr("disabled", true);
		$('#douracao_quantidade').val(null);
	}

	function corteLaserOn() {
		$($('#corte_laser_cobrar').parent().children()[1]).removeClass('hidden');
		$('#corte_laser_cobrar').prop('checked', true);
		$('#corte_laser_quantidade').attr("disabled", false);
		$('#corte_laser_minutos').attr("disabled", false);
		$('#corte_laser_quantidade').val(1);
	}

	function corteLaserOff() {
		$($('#corte_laser_cobrar').parent().children()[1]).addClass('hidden');
		$('#corte_laser_cobrar').prop('checked', false);
		$('#corte_laser_quantidade').attr("disabled", true);
		$('#corte_laser_minutos').attr("disabled", true);
		$('#corte_laser_quantidade').val(null);
		$('#corte_laser_minutos').val(null);
	}

	function relevoSecoOn() {
		$($('#relevo_seco_cobrar').parent().children()[1]).removeClass('hidden');
		$('#relevo_seco_cobrar').prop('checked', true);
		$($('#relevo_seco_cobrar_faca_cliche').parent().children()[1]).removeClass('hidden');
		$('#relevo_seco_cobrar_faca_cliche').prop('checked', true);
		$('#relevo_seco_quantidade').attr("disabled", false);
		$('#relevo_seco_quantidade').val(1);
	}

	function relevoSecoOff() {
		$($('#relevo_seco_cobrar').parent().children()[1]).addClass('hidden');
		$('#relevo_seco_cobrar').prop('checked', false);
		$($('#relevo_seco_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		$('#relevo_seco_cobrar_faca_cliche').prop('checked', false);
		$('#relevo_seco_quantidade').attr("disabled", true);
		$('#relevo_seco_quantidade').val(null);
	}

	function corteVincoOn() {
		$($('#corte_vinco_cobrar').parent().children()[1]).removeClass('hidden');
		$('#corte_vinco_cobrar').prop('checked', true);
		$($('#corte_vinco_cobrar_faca_cliche').parent().children()[1]).removeClass('hidden');
		$('#corte_vinco_cobrar_faca_cliche').prop('checked', true);
		$('#corte_vinco_quantidade').attr("disabled", false);
		$('#corte_vinco_quantidade').val(1);
	}

	function corteVincoOff() {
		$($('#corte_vinco_cobrar').parent().children()[1]).addClass('hidden');
		$('#corte_vinco_cobrar').prop('checked', false);
		$($('#corte_vinco_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		$('#corte_vinco_cobrar_faca_cliche').prop('checked', false);
		$('#corte_vinco_quantidade').attr("disabled", true);
		$('#corte_vinco_quantidade').val(null);
	}

	function almofadaOn() {
		$($('#almofada_cobrar').parent().children()[1]).removeClass('hidden');
		$('#almofada_cobrar').prop('checked', true);
		$($('#almofada_cobrar_faca_cliche').parent().children()[1]).removeClass('hidden');
		$('#almofada_cobrar_faca_cliche').prop('checked', true);
		$('#almofada_quantidade').attr("disabled", false);
		$('#almofada_quantidade').val(1);
	}

	function almofadaOff() {
		$($('#almofada_cobrar').parent().children()[1]).addClass('hidden');
		$('#almofada_cobrar').prop('checked', false);
		$($('#almofada_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		$('#almofada_cobrar_faca_cliche').prop('checked', false);
		$('#almofada_quantidade').attr("disabled", true);
		$('#almofada_quantidade').val(null);
	}

	function editar_papel_modal(owner,posicao,id_papel,id_linha,id_gramatura,empastamento_adicionar,empastamento_quantidade,empastamento_cobrar,laminacao_adicionar,laminacao_quantidade,laminacao_cobrar,douracao_adicionar,douracao_quantidade,douracao_cobrar,corte_laser_adicionar,corte_laser_quantidade,corte_laser_cobrar,corte_laser_minutos,relevo_seco_adicionar,relevo_seco_quantidade,relevo_seco_cobrar,relevo_seco_cobrar_faca_cliche,corte_vinco_adicionar,corte_vinco_quantidade,corte_vinco_cobrar,corte_vinco_cobrar_faca_cliche,almofada_adicionar,almofada_quantidade,almofada_cobrar,almofada_cobrar_faca_cliche){
		
		ajax_carregar_papel_linha(true,id_linha);
		ajax_carregar_papel(id_linha,true,id_papel);
		ajax_carregar_gramatura(id_papel,true,id_gramatura);
		$("#md_papel_container_owner").val(owner);

		/*====================================================================================*/
		//Empastamento:
		if(empastamento_adicionar ==1){
			$('#empastamento_adicionar').prop('checked',true);
			$('#empastamento_quantidade').attr("disabled", false);
			$($('#empastamento_cobrar').parent().children()[1]).removeClass('hidden');
		}else{
			$('#empastamento_adicionar').prop('checked',false);
			$('#empastamento_quantidade').attr("disabled", true);
			$($('#empastamento_cobrar').parent().children()[1]).addClass('hidden');
		}
		if(empastamento_cobrar ==1){
			$('#empastamento_cobrar').prop('checked',true);
		}else{
			$('#empastamento_cobrar').prop('checked',false);
		}
		$('#empastamento_quantidade').val(empastamento_quantidade);
		/*====================================================================================*/
		//Laminação:
		if(laminacao_adicionar ==1){
			$('#laminacao_adicionar').prop('checked',true);
			$('#laminacao_quantidade').attr("disabled", false);
			$($('#laminacao_cobrar').parent().children()[1]).removeClass('hidden');
		}else{
			$('#laminacao_adicionar').prop('checked',false);
			$('#laminacao_quantidade').attr("disabled", true);
			$($('#laminacao_cobrar').parent().children()[1]).addClass('hidden');
		}
		if(laminacao_cobrar ==1){
			$('#laminacao_cobrar').prop('checked',true);
		}else{
			$('#laminacao_cobrar').prop('checked',false);
		}
		$('#laminacao_quantidade').val(laminacao_quantidade);
		/*====================================================================================*/
		//Douração:
		if(douracao_adicionar ==1){
			$('#douracao_adicionar').prop('checked',true);
			$('#douracao_quantidade').attr("disabled", false);
			$($('#douracao_cobrar').parent().children()[1]).removeClass('hidden');
		}else{
			$('#douracao_adicionar').prop('checked',false);
			$('#douracao_quantidade').attr("disabled", true);
			$($('#douracao_cobrar').parent().children()[1]).addClass('hidden');
		}
		if(douracao_cobrar ==1){
			$('#douracao_cobrar').prop('checked',true);
		}else{
			$('#douracao_cobrar').prop('checked',false);
		}
		$('#douracao_quantidade').val(douracao_quantidade);
		/*====================================================================================*/
		//Corte Laser:
		if(corte_laser_adicionar ==1){
			$('#corte_laser_adicionar').prop('checked',true);
			$('#corte_laser_quantidade').attr("disabled", false);
			$('#corte_laser_minutos').attr("disabled", false);
			$($('#corte_laser_cobrar').parent().children()[1]).removeClass('hidden');
		}else{
			$('#corte_laser_adicionar').prop('checked',false);
			$('#corte_laser_quantidade').attr("disabled", true);
			$('#corte_laser_minutos').attr("disabled", true);
			$($('#corte_laser_cobrar').parent().children()[1]).addClass('hidden');
		}
		if(corte_laser_cobrar ==1){
			$('#corte_laser_cobrar').prop('checked',true);
		}else{
			$('#corte_laser_cobrar').prop('checked',false);
		}
		$('#corte_laser_minutos').val(corte_laser_minutos);
		$('#corte_laser_quantidade').val(corte_laser_quantidade);
		/*====================================================================================*/
		//Relevo Seco:
		if(relevo_seco_adicionar ==1){
			$('#relevo_seco_adicionar').prop('checked',true);
			$('#relevo_seco_quantidade').attr("disabled", false);
			$($('#relevo_seco_cobrar').parent().children()[1]).removeClass('hidden');
			$($('#relevo_seco_cobrar_faca_cliche').parent().children()[1]).removeClass('hidden');
		}else{
			$('#relevo_seco_adicionar').prop('checked',false);
			$('#relevo_seco_quantidade').attr("disabled", true);
			$($('#relevo_seco_cobrar').parent().children()[1]).addClass('hidden');
			$($('#relevo_seco_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		}
		if(relevo_seco_cobrar ==1){
			$('#relevo_seco_cobrar').prop('checked',true);
		}else{
			$('#relevo_seco_cobrar').prop('checked',false);
		}
		if(relevo_seco_cobrar_faca_cliche ==1){
			$('#relevo_seco_cobrar_faca_cliche').prop('checked',true);
		}else{
			$('#relevo_seco_cobrar_faca_cliche').prop('checked',false);
		}
		$('#relevo_seco_quantidade').val(relevo_seco_quantidade);
		/*====================================================================================*/
		//Corte Vinco:
		if(corte_vinco_adicionar ==1){
			$('#corte_vinco_adicionar').prop('checked',true);
			$('#corte_vinco_quantidade').attr("disabled", false);
			$($('#corte_vinco_cobrar').parent().children()[1]).removeClass('hidden');
			$($('#corte_vinco_cobrar_faca_cliche').parent().children()[1]).removeClass('hidden');
		}else{
			$('#corte_vinco_adicionar').prop('checked',false);
			$('#corte_vinco_quantidade').attr("disabled", true);
			$($('#corte_vinco_cobrar').parent().children()[1]).addClass('hidden');
			$($('#corte_vinco_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		}
		if(corte_vinco_cobrar ==1){
			$('#corte_vinco_cobrar').prop('checked',true);
		}else{
			$('#corte_vinco_cobrar').prop('checked',false);
		}
		if(corte_vinco_cobrar_faca_cliche ==1){
			$('#corte_vinco_cobrar_faca_cliche').prop('checked',true);
		}else{
			$('#corte_vinco_cobrar_faca_cliche').prop('checked',false);
		}
		$('#corte_vinco_quantidade').val(corte_vinco_quantidade);
		/*====================================================================================*/
		//Almofada:
		if(almofada_adicionar ==1){
			$('#almofada_adicionar').prop('checked',true);
			$('#almofada_quantidade').attr("disabled", false);
			$($('#almofada_cobrar').parent().children()[1]).removeClass('hidden');
			$($('#almofada_cobrar_faca_cliche').parent().children()[1]).removeClass('hidden');
		}else{
			$('#almofada_adicionar').prop('checked',false);
			$('#almofada_quantidade').attr("disabled", true);
			$($('#almofada_cobrar').parent().children()[1]).addClass('hidden');
			$($('#almofada_cobrar_faca_cliche').parent().children()[1]).addClass('hidden');
		}
		if(almofada_cobrar ==1){
			$('#almofada_cobrar').prop('checked',true);
		}else{
			$('#almofada_cobrar').prop('checked',false);
		}
		if(almofada_cobrar_faca_cliche ==1){
			$('#almofada_cobrar_faca_cliche').prop('checked',true);
		}else{
			$('#almofada_cobrar_faca_cliche').prop('checked',false);
		}
		$('#almofada_quantidade').val(almofada_quantidade);
		$("#md_papel").modal();
		pre_submit("#form_md_papel","<?=$controller?>/session_papel_editar/" + owner + "/" + posicao,"#md_papel",owner);
	}
	
	function editar_impressao_modal(owner,posicao,id_impressao,id_area,quantidade,descricao){
		ajax_carregar_impressao_area(true,id_area);
		ajax_carregar_impressao(id_area,true,id_impressao);
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

	function abrir_papel_modal(owner){
		$("#md_papel_container_owner").val(owner);
		$("#md_corte_laser_minutos").val(null);
		empastamentoOff();
		laminacaoOff();
		douracaoOff();
		corteLaserOff();
		relevoSecoOff();
		corteVincoOff();
		almofadaOff();
		reset_form("#form_md_papel");
		$("#form_select_gramatura").find('option').remove();
		pre_submit("#form_md_papel","<?=$controller?>/session_papel_inserir/"+owner,"#md_papel",owner);
		remove_form_select_option_papel();
		ajax_carregar_papel_linha();
	}

	function abrir_impressao_modal(owner){
		reset_form("#form_md_impressao");
		pre_submit("#form_md_impressao","<?=$controller?>/session_impressao_inserir/"+owner,"#md_impressao",owner);
		remove_form_select_option_impressao();
		ajax_carregar_impressao_area();
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
		pre_submit("#form_md_fita","<?=$controller?>/session_fita_inserir/"+owner,"#md_fita",owner);
		remove_form_select_option_fita();
		ajax_carregar_fita_material();
	}

	function ajax_carregar_papel_linha(editar = false,id_linha = null) {
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

	function ajax_carregar_papel(id_linha,editar = false, id_papel = null) {
		remove_form_select_option_papel();
		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado/")?>'+id_linha,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
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

	function ajax_carregar_gramatura(id,editar = false, id_gramatura = null) {
		var gramatura = $("#form_select_gramatura option:selected").text();
		$('#form_select_gramatura')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("papel/ajax_get_personalizado_gramatura/")?>'+id,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			//console.log(id_gramatura);
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

	function ajax_carregar_impressao_area(editar = false,id_impressao_area = null) {
		$('#form_select_impressao_area')
		    .find('option')
		    .remove()
		    .end()
		    .append('<option value="">Selecione</option>')
		    .val('');

		$.ajax({
			url: '<?= base_url("impressao_area/ajax_get_personalizado")?>',
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			$.each(data, function(index, val) {
				$('#form_select_impressao_area').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_impressao_area");
		})
		.always(function() {
			if(editar){
				$("#form_select_impressao_area option[value='"+id_impressao_area+"']").prop('selected','selected');
			}
		});
	}

	function ajax_carregar_impressao(id_area,editar = false, id_impressao = null) {
		remove_form_select_option_impressao();

		$.ajax({
			url: '<?= base_url("impressao/ajax_get_personalizado/")?>'+id_area,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			console.log(data);
			$.each(data, function(index, val) {
				$('#form_select_impressao').append($('<option>', {
				    value: val.id,
				    text: val.nome
				}));
			});
		})
		.fail(function() {
			console.log("erro ao ajax_carregar_papel");
		})
		.always(function() {
			$('#form_select_impressao').selectpicker('refresh');
			if(editar){
				$('#form_select_impressao').selectpicker('val', id_impressao);
			}
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
		remove_form_select_option_fita();
		$.ajax({
			url: '<?= base_url("fita/ajax_get_personalizado/")?>'+id_material,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(data) {
			console.log(data);
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
			console.log(data);
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
			$("#personalizado_modelo option[value='']").prop("selected",true);
			$("#quantidade_personalizado").val(null);
		}else{
			ajax_carregar_personalizado_categoria(true,id_categoria);
			$("#personalizado_modelo option[value="+id_modelo+"]").prop("selected",true);
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
	$(".form_ajax").submit(function (e) {
		console.log('Função: $(".form_ajax")');
		disable_button();
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
			enable_button();
		});
		e.preventDefault();
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

	function disable_button(){
		$('.btnSubmit').text('Salvando...');
		$('.btnSubmit').attr('disabled', true);
	}

	function enable_button() {
		$('.btnSubmit').text('Salvar');
		$('.btnSubmit').attr('disabled', false);
	}

	function reset_form(form) {
        $(form)[0].reset(); // Zerar formulario
        $('.form-group').removeClass('has-error'); // Limpar os erros
        $('.help-block').empty(); // Limpar as msg de erro
    }

    function reset_errors() {
        $('.form-group').removeClass('has-error'); // Limpar os erros
        $('.help-block').empty(); // Limpar as msg de erro
    }

    function remove_form_select_option_papel() {
    	$('#form_select_papel').selectpicker('destroy');
		$('#form_select_papel')
	    .find('option')
	    .remove()
	    .end()
	    .append('<option value="">Selecione</option>')
	    .val('');
	}

	function remove_form_select_option_impressao() {
		$('#form_select_impressao').selectpicker('destroy');
		$('#form_select_impressao')
	    .find('option')
	    .remove()
	    .end()
	    .append('<option value="">Selecione</option>')
	    .val('');
	}

	function remove_form_select_option_fita() {
    	$('#form_select_fita').selectpicker('destroy');
		$('#form_select_fita')
	    .find('option')
	    .remove()
	    .end()
	    .append('<option value="">Selecione</option>')
	    .val('');
	}

	function remove_form_select_option_personalizado_modelo() {
    	$('#personalizado_modelo').selectpicker('destroy');
		$('#personalizado_modelo')
	    .find('option')
	    .remove()
	    .end()
	    .append('<option value="">Selecione</option>')
	    .val('');
	}
</script>