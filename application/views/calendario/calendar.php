<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Panel title</h3>
	</div>
	<div class="panel-body">
		<?php
		echo $dados['calendario'];
		?>
		<div id="calendario" data-provide="calendar">

		</div>

	</div>
</div>
<style type="text/css">
	.calendar {
		font-family: Arial, Verdana, Sans-serif;
		width: 100%;
		min-width: 960px;
		border-collapse: collapse;
	}

	.calendar tbody tr:first-child th {
		color: #505050;
		margin: 0 0 10px 0;
	}

	.day_header {
		font-weight: normal;
		text-align: center;
		color: #757575;
		font-size: 10px;
	}

	.calendar td {
		width: 14%; /* Force all cells to be about the same width regardless of content */
		border:1px solid #CCC;
		height: 100px;
		vertical-align: top;
		font-size: 10px;
		padding: 0;
	}

	.calendar td:hover {
		background: #F3F3F3;
	}

	.day_listing {
		display: block;
		text-align: right;
		font-size: 12px;
		color: #2C2C2C;
		padding: 5px 5px 0 0;
	}

	div.today {
		background: #E9EFF7;
		height: 100%;
	}
</style>