<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['janeiro']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['fevereiro']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['marco']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['abril']?>
	</div>
</div>
<div class="row">
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['maio']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['junho']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['julho']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['agosto']?>
	</div>
</div>
<div class="row">
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['setembro']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['outubro']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['novembro']?>
	</div>
	<div class="col-sm-3 col-xs-6">
		<?php echo $dados['dezembro']?>
	</div>
</div>






<div id="datepicker"></div>
<script>
$( "#datepicker" ).datepicker({
    numberOfMonths: 12,
    minDate: new Date(2017, 1 -1, 1),
    maxDate: new Date(2017, 12 -1, 31),
    showButtonPanel: true
});
</script>