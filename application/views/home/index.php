<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Panel title</h3>
			</div>
			<div class="panel-body">
				<table id="orcamentos" class="table ">
					<caption>Tabela de Orcamentos</caption>
					<thead>
						<tr>
							<th>Numero</th>
							<th>cliente</th>
							<th>Data</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
						</tr>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
						</tr>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
						</tr>
					</tbody>
				</table>
				<button>Editar</button>
				<button>PDF</button>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Panel title</h3>
			</div>
			<div class="panel-body">
				<table id="orcamentos" class="table ">
					<caption>Tabela de Pedido</caption>
					<thead>
						<tr>
							<th>Numero</th>
							<th>cliente</th>
							<th>Data</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
							<td><button><i title="Marcar como visualizado" class="glyphicon glyphicon-eye-close"></i></button></td>
						</tr>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
							<td><button><i title="Marcar como visualizado" class="glyphicon glyphicon-eye-close"></i></button></td>
						</tr>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
							<td><button><i title="Marcar como visualizado" class="glyphicon glyphicon-eye-close"></i></button></td>
						</tr>
					</tbody>
				</table>
				<button>Editar</button>
				<button>PDF</button>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Panel title</h3>
			</div>
			<div class="panel-body">
				<table id="orcamentos" class="table ">
					<caption>Tabela de Entregas - 7 dias</caption>
					<thead>
						<tr>
							<th>Numero</th>
							<th>cliente</th>
							<th>Data de entrega</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
						</tr>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
						</tr>
						<tr>
							<td>12</td>
							<td>Fellipe</td>
							<td>16/12/2017</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
  <h2>Chart.js Responsive Bar Chart Demo</h2>
  <div class="col-sm-6">
    <canvas id="canvas"></canvas>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		var dData = function() {
		  return Math.round(Math.random() * 70) + 10
		};

		var barChartData = {
		  labels: ["January", "February", "March", "April", "May", "June", "July"],
		  datasets: [{
		  	label: '# Pedidos',
		    fillColor: "rgba(0,60,100,1)",
		    strokeColor: "black",
		    data: [dData(), dData(), dData(), dData(), dData(), dData(), dData()]
		  }]
		}

		var steps = 10;
		var max = 80;
		var ctx = document.getElementById("canvas").getContext("2d");
		var barChartDemo = new Chart(ctx).Bar(barChartData, {
		  	responsive: true,
		 	barValueSpacing: 10,
		 	scaleOverride: true,
		    scaleSteps: steps,
		    scaleStepWidth: Math.ceil(max / steps),
		    scaleStartValue: 0
		});
		
	});
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
