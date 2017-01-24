$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();
	$('.calendar').calendar();
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
	$('.date').mask('00/00/0000');
	//Filtro do Controller do calendário
	$(function() {
		$(".buttons-collection").children().append('<i class="caret">');
		$(".form-filter .form-group").css("margin-left","-5px").css("margin-right","-5px");
	});
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
/*
Adiciona tag <i> com a classe nos botões do dataTable
initComplete: function (settings, json) {
    $(".buttons-collection").children().append('<i class="caret">');
},
*/