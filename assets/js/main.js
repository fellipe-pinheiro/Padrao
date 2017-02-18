$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	$('.calendar').calendar().setLanguage("pt");
	$('.datetimepicker').datetimepicker({
		format:'L'
	});
	// Fix Multiples Modals Scroll Issues
	$('.modal').on("hidden.bs.modal", function (e) {
		if($('.modal:visible').length)
		{
			$('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
			$('body').addClass('modal-open');
		}
	}).on("show.bs.modal", function (e) {
		if($('.modal:visible').length)
		{
			$('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
			$(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
		}
	});
	//Checkbox estilizado
	$(':checkbox').checkboxpicker();

	//Telefone com 8 ou 9 dígitos use a class="sp_celphones"
	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};

	//Mask Plugin : formulário com dados padrões
	$('.sp_celphones').mask(SPMaskBehavior, spOptions);
	//CPF
	$('.cpf').mask('000.000.000-00', {reverse: true});
	//CNPJ
	$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	//CEP
	$('.cep').mask('00000-000');
	//DATA
	//$('.date').mask('00/00/0000');
	//Filtro do Controller do calendário
	$(function() {
		$(".buttons-collection").children().append('<i class="caret">');
		$(".form-filter .form-group").css("margin-left","-5px").css("margin-right","-5px");
	});
	/*Footer: Back to top link span*/
	if ( ($(window).height() + 100) < $(document).height() ) {
		$('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:10}
    	});
	}
	remove_error_on_change_and_keyup();
});
$(document).on('click', '.panel-heading span.clickable', function(e){
	var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
});
function remove_error_on_change_and_keyup() {
	$("form").on('keyup', 'input, textarea', function(event) { // Retira a classe de erro do formulário
		$(this).closest(".form-group").removeClass('has-error').find('.help-block').empty();
	});
	$("form").on('change', 'select', function(event) { // Retira a classe de erro do formulário
		$(this).closest(".form-group").removeClass('has-error').find('.help-block').empty();
	});
}
function show_datails(id) {
	$("#"+id).toggleClass("hidden");
	$($("#"+id).prev().children()[0]).find('span').toggleClass("glyphicon glyphicon-plus-sign");
	$($("#"+id).prev().children()[0]).find('span').toggleClass("glyphicon glyphicon-minus-sign")
}
function numberFormat(str) {
	if(str == null)
		return 0;
	str = str.replace(/[^0-9\,-]+/g,"");
	str = str.replace(",",".");
	str = parseFloat(str).toFixed(2);
	if(str.length <= 0 || isNaN(str)) 
		return 0;
	return Number(parseFloat(str).toFixed(2));
}
function getDateGroup(dateStr) {

	var arr = dateStr.split("/");
	var d = new Date(arr[1] + "/" + arr[0] + "/" + arr[2]);
	var diaDaSemana = d.getDay();
	switch (diaDaSemana) {
		case 0:
		return dateStr + " " + "Domingo";
		break;
		case 1:
		return dateStr + " " + "Segunda feira";
		break;
		case 2:
		return dateStr + " " + "Terça feira";
		break;
		case 3:
		return dateStr + " " + "Quarta feira";
		break;
		case 4:
		return dateStr + " " + "Quinta feira";
		break;
		case 5:
		return dateStr + " " + "Sexta feira";
		break;
		case 6:
		return dateStr + " " + "Sábado";
		break;
		default:
		return dateStr;
	}
}
//Identifica se o input/select do filtro está sendo aplicado
function check_filter_dirty() {
	$(".check_filter_dirty input").each(function(index, el) {
		if($(el).val() != ""){
			$(el).closest(".form-group").addClass('has-success');
			$(el).prev().children().addClass('glyphicon-filter');
		}else{
			$(el).closest(".form-group").removeClass('has-success');
			$(el).prev().children().removeClass('glyphicon-filter');
		}
	});
	$(".check_filter_dirty select").each(function(index, el) {
		if($(el).val() != ""){
			$(el).closest(".form-group").addClass('has-success');
			$(el).prev().children().addClass('glyphicon-filter');
		}else{
			$(el).closest(".form-group").removeClass('has-success');
			$(el).prev().children().removeClass('glyphicon-filter');
		}
	});
}
function is_datatable_exists(dt_table) {
	if($.fn.DataTable.isDataTable( dt_table )){
		return true;
	}
	return false;
}
function disable_button_salvar(){
	$('.btnSubmit').text('Salvando...').addClass('spinner');
	$('.btnSubmit').attr('disabled', true);
}
function enable_button_salvar() {
	$('.btnSubmit').text('Salvar').removeClass('spinner');
	$('.btnSubmit').attr('disabled', false);
}
function reset_errors() { // Retira os erros do formulário
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
}
function carregaCep(){
	var cep = $("#input_cep").val();
	if(cep.length != 9){
		console.log('cep inválido');
		return false;
	}
	cep = cep.replace("-", "");
	var url_valor = "http://correiosapi.apphb.com/cep/" + cep;
	var estados = $("#input_estado").data("estado");
	$.ajax({
		url: url_valor,
		type: 'POST',
		dataType: 'jsonp',
		crossDomain: true,
		contentType: "application/json",
		statusCode: {
			200: function(data) {
				$("#input_endereco").val(data.tipoDeLogradouro + " " + data.logradouro);
				$("#input_bairro").val(data.bairro);
				$("#input_cidade").val(data.cidade);
            $("#input_estado").val(estados[data.estado]);// Estado
            $("#input_uf").val(data.estado); } // UF
            ,400: function(msg) { console.log(msg);  } // Bad Request
            ,404: function(msg) { console.log("CEP não encontrado!!"); } // Not Found
            ,0: function(msg) { console.log(msg)}
        }
    })
	.done(function() {
		console.log("success");
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

function form_small() {
	$('form input, form select, form textarea').each(
	    function(index){  
	        $(this).addClass('input-sm');
	    }
	);
	$('form button').each(
	    function(index){  
	        $(this).addClass('btn-sm');
	    }
	);
}
function validar_cpf(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    strCPF = strCPF.replace(/[^0-9]+/g, '');
    if (strCPF == '00000000000' || strCPF == '11111111111' || strCPF == '22222222222' || strCPF == '33333333333' || strCPF == '44444444444' || strCPF == '55555555555' || strCPF == '66666666666' || strCPF == '77777777777' || strCPF == '88888888888' || strCPF == '99999999999') {
        return false;
    }
    
    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
    
    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}
function validar_cnpj(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
}

/*
Adiciona tag <i> com a classe nos botões do dataTable
initComplete: function (settings, json) {
    $(".buttons-collection").children().append('<i class="caret">');
},
*/