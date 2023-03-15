
<?php
include "Header_extra.php";
//require 'dbconect.php';
require('../Conexion.php');

if($_SESSION['username'] != 'eddie' AND $_SESSION['username'] != 'jaime.rodriguez' AND $_SESSION['username'] != 'laura' AND $_SESSION['username'] != 'jesus.maturan' AND $_SESSION['username'] != 'gloria.cano' AND $_SESSION['username'] !='enrique.morales'  AND $_SESSION['username'] !='ezequiel.bernal'  AND $_SESSION['username'] !='usuario.prueba'){

  echo '<div class="im-flex im-widget"><p class="im-w-100 alert alert-danger agileits" role="alert">Lo sentimos, usted no tiene permisos para ver o modificar ésta opción. </p></div>';

  exit();
}
set_time_limit(400000); ?>
<link rel="stylesheet" href="../css_app/imssa.css">
<style>
	thead th {
		background-color: #FDE273;
		text-align: center;
		font-weight: bold;
	}
	.im-mg-r-2{
		margin-right: 2rem;
	}
	.im-padding-v{
	  margin: 2rem 0;
	}
	td {
    color: black;
    background-color: #E8E8EC;
    font-size: 11px !important;
    text-align: center;
	}
	.tr-cost:last-child{
    	background-color: black;
    	color: white;
  	}
  	.totales>td{
    	background: #0e2652 !important;
    	color: #f5f5f5 !important;
  	}
  	.totales-r>td:last-child{
   	background: #0e2652 !important;
   	color: #f5f5f5 !important;
  	}
  	.noManufactura>td{
  		background-color: #a04a4a;
  		color: #f5f5f5;
  	}
  	.totalesSeparados>td{
    	background: #ED7D31 !important;
    	color: #f5f5f5;
  	}
  	.totalesDiario>td{
    	background: #369634 !important;
    	color: #f5f5f5;
  	}
  	.totales-r>td:last-child {
   	background: #0e2652 !important;
   	color: #f5f5f5 !important;
	}
	@media screen and (max-width: 992px){
    	.im-mg-r-2{
      	margin-right: 0;
    	}
  	}
</style>
<div id="carga" style="display: none;"><div style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999; opacity: 0.8; background: url('../img/imssawait.gif') 50% 50% no-repeat rgb(255,255,255);"></div></div>
<div class="container">
	<div class="panel-group">
		<div class="panel">
			<div class="panel-heading" style="background-color: #0e2652 !important;"><p class="text-center text-white text-uppercase" style="color: #f5f5f5">Reporte Costos de Manufactura</p></div>
			<div class="panel-body im-flex im-flex-column">
				<div class="im-flex im-flex-inline im-flex-wrap im-padding-v im-widget">
					<div class="im-w-25 im-md-50 im-padding-1-v">
						<div class="ctrl">
							<input type="date" id="fecha_inicial" value="<?php echo date('Y-m-d')?>">
							<label for="" class="ctrl-label">Fecha Inicial:</label>
						</div>
					</div>
					<div class="im-w-25 im-md-50 im-padding-1-v">
						<div class="ctrl">
							<input type="date" id="fecha_final" value="<?php echo date('Y-m-d')?>">
							<label for="" class="ctrl-label">Fecha Final:</label>
						</div></div>
					<div class="im-w-20 im-md-100 im-padding-1-v">
						<button class="im-btn im-w-100 im-btn-info" onclick="searchInfo();"><i class="fas fa-search"></i> Busqueda</button>
					</div>
				</div>
				<div class="im-flex im-flex-inline im-padding-v">
					<button type="button" class="im-btn im-btn-aux2 im-w-10 im-md-20 im-padding-1-v" data-toggle="collapse" data-target="#tc-panel">Agregar TC <i class="fas fa-angle-double-down"></i></button>
				</div>
				<div class="crear collapse" id="tc-panel">
					<div class="panel" style="border-color: #082954;">
						<div class="panel-heading" style="background-color: #082954 !important;"><p class="text-center text-white" style="color: #f5f5f5;">AGREGAR TIPO DE CAMBIO</p></div>
						<div class="panel-body im-flex im-flex-column">
							<div class="im-flex im-flex-inline im-padding-v im-flex-wrap">
								<div class="im-w-25 im-md-50 im-padding-1-v">
									<div class="ctrl">
										<input type="number" min="0" id="tipo_cambio_save" placeholder="Pesos MXN">
										<label for="" class="ctrl-label">Tipo de Cambio</label>
									</div>
								</div>
								<div class="im-w-25 im-md-50 im-padding-1-v">
									<div class="ctrl">
										<select name="mes_TC" id="mes_TC">
							            <option value="">SELECCIONAR...</option>
							            <option value="ENERO">ENERO</option>
							            <option value="FEBRERO">FEBRERO</option>
							            <option value="MARZO">MARZO</option>
							            <option value="ABRIL">ABRIL</option>
							            <option value="MAYO">MAYO</option>
							            <option value="JUNIO">JUNIO</option>
							            <option value="JULIO">JULIO</option>
							            <option value="AGOSTO">AGOSTO</option>
							            <option value="SEPTIEMBRE">SEPTIEMBRE</option>
							            <option value="OCTUBRE">OCTUBRE</option>
							            <option value="NOVIEMBRE">NOVIEMBRE</option>
							          	<option value="DICIEMBRE">DICIEMBRE</option>
					          		</select>
										<label for="" class="ctrl-label">Mes</label>
									</div>
								</div>
								<div class="im-w-25 im-md-50 im-padding-1-v">
									<div class="ctrl">
										<select name="periodo" id="periodo">
								        	<option value="">SELECCIONAR...</option>
								        	<option value="2020">2020</option>
								        	<option value="2021">2021</option>
								        	<option value="2022">2022</option>
								        	<option value="2023">2023</option> 
						        		</select>
										<label for="" class="ctrl-label">Periodo</label>
									</div>
								</div>
								<div class="im-w-25 im-md-50 im-padding-1-v">
									<button type="button" class="im-btn im-btn-ok im-w-100" onclick="save_TC();">Guardar</button>
								</div>
							</div>
							<div class="im-flex im-flex-inline im-flex-wrap .im-padding-v">
								<div class="im-w-30 im-md-50 im-padding-1-v">
									<div class="ctrl">
										<select name="" id="">
											<?php 
												$sql = sqlsrv_query($conn, "SELECT * FROM tipo_cambio_mes ORDER BY id_tc DESC");
												while($rs = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
													echo "<option>".$rs['mes']." ".$rs['periodo']." [TC: ".$rs['tipo_cambio']."]</option>";
												}
											?>
										</select>
										<label for="" class="ctrl-label">Tipo de Cambios Registrados:</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="im-flex im-flex-column tablas">
					<div class="tabla0 im-padding-1-v">
						<span class="tcTxt" style="font-size: 16px;"></span>
						<table id="tabla0" class="table table-striped table-bordered table-hover text-center" width="100%">
							<thead>
								<tr>
									<th>Costo Total con M.O.R</th>
									<th>Costo Total con M.O.T</th>
									<th>Total Insumos</th>
									<th>Materia Prima</th>
									<th>Maquina y Equipo</th>
									<th>M.O.R.D</th>
									<th>M.O.R.I</th>
									<th>M.O.T.D</th>
									<th>M.O.T.I</th>
									<th>Costo Total M.O.R</th>
									<th>Costo Total M.O.T</th>
									<th>Total Ingresos</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="tabla1 im-padding-1-v">
						<table id="tabla1" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Cliente</th>
									<th>Sistema</th>
									<th>Fecha</th>
									<th># Parte</th>
									<th>Pz Programadas</th>
									<th>Cantidad Pz(HxH)</th>
									<th>Cant. Pz Terminadas</th>
									<th>Cant. Pz Aceptadas</th>
									<th>Costo Insumos Con Folio</th>
									<th>Total Materia Prima</th>
									<!--<th>Unitario M.P</th> -->
									<th>Area total ft²/Peso Lbs</th>
									<th>Precio Venta</th>
									<th>Participacion en Sistema</th>
									<th>Costo Insumos Sin Folio</th>
									<th>Costo M.O.R.D</th>
									<th>Costo M.O.T.D</th>
									<th>Costo M.O.R.I</th>
									<th>Costo M.O.T.I</th>
									<th>Planta y Equipo</th>
									<th>Ingresos</th>
									<th>Costo Total</th>
									<!--<th>Utilidad</th>
									<th>Margen</th>
									<th>Costo Unitario</th>
									<th>Costo Ft/Lb</th>-->
									<th>Ingreso Pz Aceptadas</th>
									<th>Ingreso Pz Terminadas</th>
									<th>Ingreso Pz Programadas</th>
									<th>% Pz Terminadas</th>
									<th>% Pz Procesadas</th>
									<th>% Pz Aceptadas</th>
									<th>% Pz Programadas($)</th>
									<th>% Pz Programadas</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="tabla_unitario im-padding-1-v">
						<div class="im-flex im-flex-inline im-center-v">
							<h3>Costo Unitario</h3>
						</div>
						<table id="table_unit" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>Folio</th>
									<th>Cliente</th>
									<th># Parte</th>
									<th>Cantidad pz (HxH)</th>
									<th>Costo Total</th>
									<th>Costo Unitario Real</th>
									<th>Insumos Con Folio</th>
									<th>Total Materia Prima</th>
									<th>Insumos Sin Folio</th>
									<th>Costo M.O.R.D</th>
									<th>Costo M.O.T.D</th>
									<th>Costo M.O.R.I</th>
									<th>Costo M.O.T.I</th>
									<th>Maquina y Equipo</th>
									<th>Precio Venta</th>
									<th>Margen Precio/Costo Unitario</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="tabla2 im-padding-1-v">
						<div class="im-flex im-flex-inline im-center-v">
							<h3>Costos Insumo Sin Folio Cargado a Segmentos</h3>
						</div>
						<table id="tabla2" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Departamento</th>
									<th>Insumo</th>
									<th>Nombre Insumo</th>
									<th>Segmento</th>
									<th>Costo</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="tabla3 im-padding-1-v">
						<div class="im-flex im-flex-inline im-center-v">
							<h3>Mano de Obra Teórica</h3>	
						</div>
						<table id="tabla3" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Sistema</th>
									<th>Personal</th>
									<th>Convenio</th>
									<th>Permiso</th>
									<th>Costo</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="tabla4 im-padding-1-v">
						<div class="im-flex im-flex-inline im-center-v">
							<h3>Mano de Obra Real</h3>
						</div>
						<div class="msjMO">
							
						</div>
						<table id="tabla4" class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Sistema</th>
									<th>Costo</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	let totales_MORD = 0;
	let totales_MORI = 0;
	let arraySistemas = [];
	let arrayMO = [];
	let arrayMOR = [];
	let arrayInsumos = [];
	let totalSistemaNo = 0;
	let totalMONo = 0;
	let totalMORNo = 0;
	let siS1 = 0, siS2 = 0, siS3 = 0, siS5 = 0, siS6 = 0, siS7 = 0, siS8 = 0;
	const mxn = { style: 'currency', currency: 'MXN' };
	const numFormat = new Intl.NumberFormat('es-MX', mxn);
	var nf = new Intl.NumberFormat();

	$(document).ready(function(){
		$('.select2_TC').select2({
			width: '100%',
			height: '100%'
		});
		var table0 = $('#tabla0').DataTable({
			'info': false,
			fixedColumns: true,
			fixedHeader: false,
			responsive: true,
			'paging': false,
			'ordering': false,
			dom: 'Blfrtip',
	      buttons: [
	      {extend:'copy',footer: true,text: 'Copiar <i class="fas fa-copy"></i>' },

	      {extend: 'excel',footer: true, text:'Excel <i class="fas fa-file-excel" style="color:green;"></i>',title: 'Resumen costos manufactura'}

	      ]
		});
		var tabla2 = $('#tabla2').DataTable({
			'info': false,
			fixedColumns: true,
			fixedHeader: false,
			responsive: true,
			'paging': false,
			'ordering': true,
	      dom: 'Blfrtip',
	      buttons: [
	      {extend:'copy',footer: true,text: 'Copiar <i class="fas fa-copy"></i>' },

	      {extend: 'excel',footer: true, text:'Excel <i class="fas fa-file-excel" style="color:green;"></i>',title: 'Costos Insumos Sin Folio'}

	      ]
		});
		var table_unit = $('#table_unit').DataTable({
			'info': false,
			fixedColumns: true,
			fixedHeader: true,
			responsive: true,
			'paging': false,
			'ordering': false,
	      dom: 'Blfrtip',
	      buttons: [
	      {extend:'copy',footer: true,text: 'Copiar <i class="fas fa-copy"></i>' },

	      {extend: 'excel',footer: true, text:'Excel <i class="fas fa-file-excel" style="color:green;"></i>',title: 'Resumen Costo Unitario'}

	      ]
		});
		var tabla3 = $('#tabla3').DataTable({
			'info': false,
			fixedColumns: false,
			fixedHeader: false,
			responsive: true,
			'paging': false,
			'ordering': false,
	      dom: 'Blfrtip',
	      buttons: [
	      {extend:'copy',footer: true,text: 'Copiar <i class="fas fa-copy"></i>' },

	      {extend: 'excel',footer: true, text:'Excel <i class="fas fa-file-excel" style="color:green;"></i>',title: 'Mano de Obra Teorica'}

	      ]
		});
		var tabla4 = $('#tabla4').DataTable({
			'info': false,
			fixedColumns: false,
			fixedHeader: false,
			responsive: true,
			'paging': false,
			responsive: true,
			'paging': false,
			'ordering': false,
	      dom: 'Blfrtip',
	      buttons: [
	      {extend:'copy',footer: true,text: 'Copiar <i class="fas fa-copy"></i>' },

	      {extend: 'excel',footer: true, text:'Excel <i class="fas fa-file-excel" style="color:green;"></i>',title: 'Mano de Obra Real'}

	      ]
		});
		tableManufactura();
	});
	function tableManufactura(){

		var tabla1 = $('#tabla1').DataTable({
			'info': false,
			fixedColumns: true,
			fixedHeader: true,
			responsive: true,
			'paging': false,
			'ordering': false,
	      dom: 'Blfrtip',
	      buttons: [
	      {extend:'copy',footer: true,text: 'Copiar <i class="fas fa-copy"></i>' },

	      {extend: 'excel',footer: true, text:'Excel <i class="fas fa-file-excel" style="color:green;"></i>',title: 'Costos insumos'}

	      ]
		});
	}
	function save_TC(){
		let tipo_cambio = $('#tipo_cambio_save').val();
		let mes = $('#mes_TC').val();
		let periodo = $('#periodo').val();
		alertify.set('notifier','position', 'top-center');
		if(tipo_cambio!='' && mes !='' && periodo !=''){
			$.ajax({
				url: 'EM/costos.php',
				type: 'POST',
				data: {guardar_TC:'guardar_TC', tipo_cambio:tipo_cambio, mes:mes, periodo:periodo},
				success: function(data){
					alertify.alert(data, function(){
						alertify.message(location.reload());
					});
				}
			});
		}else{
      		alertify.error("Campos Vacios!");
		}
	}
	function searchInfo(){
		totalSistemaNo = 0;
		totalMONo = 0;
		arraySistemas = [];
		arrayMO = [];
		arrayMOR = [];
		let fecha_inicial = $('#fecha_inicial').val();
		let fecha_final = $('#fecha_final').val();
		//let tipo_cambio = $('#tipo_cambio').val();
		if(fecha_inicial !='' && fecha_final !=''){
   		$('#imssa_loading').show();

		  var dataSend = new FormData();
		  dataSend.append('searchInfo','searchInfo');
			dataSend.append('fecha_inicial', fecha_inicial);
			dataSend.append('fecha_final', fecha_final);
			$.ajax({
					url : 'EM/costos.php',
					type : 'POST',
					data :{
						searchInfo : 'searchInfo',
						fecha_inicial : fecha_inicial,
						fecha_final : fecha_final
					},
					dataType: 'json',
					success : function(r){
						console.log(r);
						let MORD = r.MORD;
						let MORI = r.MORI;
						let MOTD = r.MOTD;
						let MOTI = r.MOTI;
						let totalesmotd = r.totalesMOTD;
						let totalesmoti = r.totalesMOTI;
						let totalMOSistemas = r.totalesSistemas;
						let insumosSegmentos = r.insumosSegmento;
						arraySistemas = insumosSegmentos;
						let totalCosto = r.totalInsumoSegmentos;
						let costo_manufactura = r.costo_manufactura;
						let granTotalInsumos = r.totalInsumoSegmentos;
						arrayMO = MOTD;
						arrayMOR = MORD;
						totales_MORD = r.totalMORD;
						totales_MORI = r.totalMORI;
						tablamanufactura(costo_manufactura, totalCosto, totalesmotd.totalMOTD, totalesmoti.totalMOTI, granTotalInsumos);
						tablaCostoUnitario(costo_manufactura);
						tablaManoObraReal(arrayMOR, MORI);
						tablaManoObraTeorica(MOTD, MOTI, totalesmotd, totalesmoti, costo_manufactura.manufactura);
						tablaInsumosSegmento(arraySistemas, totalCosto);
						$('#imssa_loading').hide();
					},
	  			error: function(xhr, textStatus, error){
	          console.log(xhr.statusText);
	          console.log(textStatus);
	          console.log(error);
	          console.log(xhr);
	          var tb0 = $('#tabla0').DataTable();
	          tb0.clear().draw(false);
	          var tb1 = $('#tabla1').DataTable();
	          tb1.clear().draw(false);
	          var unit = $('#table_unit').DataTable();
	          unit.clear().draw(false);
	          var tb2 = $('#tabla2').DataTable();
	          tb2.clear().draw(false);
	          var tb3 = $('#tabla3').DataTable();
	          tb3.clear().draw(false);
	          var tb4 = $('#tabla4').DataTable();
	          tb4.clear().draw(false);
	   				$('#imssa_loading').hide();
						alertify.alert('<h4 class="text-danger">Error. Comunicate al Dpo. de Sistemas</h4>');
	  			}
			});
		}else{
			alertify.set('notifier', 'position', 'top-center');
			alertify.error('Selecciona Rango de Fechas Validas.');

		}
	}
	function tablaInsumosSegmento(insumosSegmentos, totalCosto){
		var table = $('#tabla2').DataTable();
		table.clear().draw();
		table.row.add([
			'',
			'',
			'',
			'',
			'',
			totalCosto
			]).nodes()
			.to$()
			.addClass('totales-r');
		console.log(insumosSegmentos);
		for (var i = 0; i < insumosSegmentos.length; i++) {
			let clase = 'NA';
			if(insumosSegmentos[i].insDepartamento == 'OK'){
				if(insumosSegmentos[i].noContado == 'N'){
					totalSistemaNo = totalSistemaNo + (insumosSegmentos[i].costo*1);
					clase = "noManufactura";
				}else{
					clase = "NA";
				}
			}
			table.row.add([
				insumosSegmentos[i].fecha,
				insumosSegmentos[i].departamento,
				insumosSegmentos[i].insumo,
				insumosSegmentos[i].nombre_insumo,
				insumosSegmentos[i].segmento,
				insumosSegmentos[i].costo]).nodes().to$().addClass(clase);
		}
		/*for (var i = 0; i < insumosSegmentos.length; i++) {

			if(arraySistemas.includes(insumosSegmentos[i].sistema) || insumosSegmentos[i].sistema==""){

				if(insumosSegmentos[i].segmento=='119' && siS6==0){
					totalSistemaNo = totalSistemaNo + (insumosSegmentos[i].costo*1);
					table.row.add([
						insumosSegmentos[i].fecha,
						insumosSegmentos[i].departamento,
						insumosSegmentos[i].insumo,
						insumosSegmentos[i].nombre_insumo,
						insumosSegmentos[i].segmento,
						insumosSegmentos[i].costo
						]).nodes().to$().addClass('noManufactura');
				}else{
					table.row.add([
						insumosSegmentos[i].fecha,
						insumosSegmentos[i].departamento,
						insumosSegmentos[i].insumo,
						insumosSegmentos[i].nombre_insumo,
						insumosSegmentos[i].segmento,
						insumosSegmentos[i].costo
						]);

				}

			}else{
				totalSistemaNo = totalSistemaNo + (insumosSegmentos[i].costo*1);
				table.row.add([
					insumosSegmentos[i].fecha,
					insumosSegmentos[i].departamento,
					insumosSegmentos[i].insumo,
					insumosSegmentos[i].nombre_insumo,
					insumosSegmentos[i].segmento,
					insumosSegmentos[i].costo
					]).nodes().to$().addClass('noManufactura');

			}
		}*/
		table.draw(false);

		var t = $('#tabla1').DataTable();
		t.destroy();

		t.row.add([
			'',
			'',
			'',
			'',
			'Insumos No Contado <i class="fas fa-long-arrow-alt-right"></i>',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			totalSistemaNo.toFixed(2),
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'']).nodes().to$().addClass('noManufactura');
		t.draw(false);
		tableManufactura();
	}
	function tablaManoObraReal(mord, mori){
		let totalMORD = 0;
		let totalMORI = 0;

		var table = $('#tabla4').DataTable();
		table.clear().draw();
		let html = '';

		if(mord !='SND'){
			console.log(mord)
			for (var i = 0; i < mord.length; i++) {
				let clase = "";
				if(mord[i].noContado == 'S'){
					clase = "";
				}else{
					totalMORNo +=mord[i].costo;
					clase = "noManufactura";
				}
				totalMORD += mord[i].costo;
				table.row.add([
					mord[i].fecha,
					mord[i].sistema,
					mord[i].costo]).nodes()
					.to$()
					.addClass(clase);
			}
		}else{
			html += '<br><p><b>No hay registros de mano de obra real directa</b></p>';
		}
		totales_MORD +=totalMORD;
		table.row.add([
			'TOTAL MANO DE OBRA DIRECTA',
			'',
			totalMORD.toFixed(3)]).nodes()
			.to$()
			.addClass('totales');
		if(mori !='SND'){
			for (var i = 0; i < mori.length; i++) {
				totalMORI += mori[i].costo;
				table.row.add([
					mori[i].fecha,
					mori[i].sistema,
					mori[i].costo]);
			}
		}else{
			html +='<p><b>No hay registros de mano de obra real indirecta </b></p>';
		}
		totales_MORI += totalMORI;
		table.row.add([
			'TOTAL MANO DE OBRA INDIRECTA',
			'',
			totalMORI.toFixed(3)]).nodes()
			.to$()
			.addClass('totales');
		table.draw(false);
		$('.msjMO').html(html);
		var t = $('#tabla1').DataTable();
		t.destroy();

		t.row.add([
			'',
			'',
			'',
			'',
			'MO Real No Contado <i class="fas fa-long-arrow-alt-right"></i>',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			totalMORNo.toFixed(2),
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'']).nodes().to$().addClass('noManufactura');
		t.draw(false);
		tableManufactura();
	}
	function tablaManoObraTeorica(arrayMO, moti, totalesmotd, totalesmoti, manufactura){
		var table = $('#tabla3').DataTable();
		table.clear().draw();
		//console.log(arrayMO);
		for(var i = 0; i < arrayMO.length; i ++){
			let clas = "";
			if(arrayMO[i].noContado == 'N'){
				totalMONo = totalMONo + (arrayMO[i].costo*1);
				clas = "noManufactura";
			}else{
				clas = "NA";
			}
			table.row.add([
				arrayMO[i].fecha,
				arrayMO[i].sistema,
				arrayMO[i].personal,
				arrayMO[i].convenio,
				arrayMO[i].permiso,
				arrayMO[i].costo]).nodes().to$().addClass(clas);
		}
		table.row.add([
			'TOTAL MANO DE OBRA DIRECTA',
			'',
			totalesmotd.totalPersonal,
			totalesmotd.totalConvenios,
			totalesmotd.totalPermisos,
			totalesmotd.totalMOTD]).nodes()
			.to$()
			.addClass('totales');
		for(var i =0; i <moti.length; i++){
			if(moti[i].fecha !='' && moti[i].fecha !=null && moti[i].fecha !=undefined ){
				table.row.add([
					moti[i].fecha,
					moti[i].sistema,
					moti[i].personal,
					moti[i].convenio,
					moti[i].permiso,
					moti[i].costo]);
			}
		}
		table.row.add([
			'TOTAL MANO DE OBRA INDIRECTA',
			'',
			totalesmoti.TotalPersonal,
			totalesmoti.totalConvenios,
			totalesmoti.totalPermisos,
			totalesmoti.totalMOTI]).nodes()
			.to$()
			.addClass('totales');
		table.draw(false);

		var t = $('#tabla1').DataTable();
		t.destroy();

		t.row.add([
			'',
			'',
			'',
			'',
			'MO No Contado <i class="fas fa-long-arrow-alt-right"></i>',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			totalMONo.toFixed(2),
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'']).nodes().to$().addClass('noManufactura');
		t.draw(false);
		tableManufactura();
	}
	function tablamanufactura(costo_manufactura, totalCosto, motd, moti, granTotalInsumos){
		let manufactura = costo_manufactura.manufactura;
		console.log(manufactura);
		let ins = totalCosto;

		let s1 = costo_manufactura.sistema_1;
		let s2 = costo_manufactura.sistema_2;
		let s3 = costo_manufactura.sistema_3;
		let s5 = costo_manufactura.sistema_5;
		let s6 = costo_manufactura.sistema_6;
		let s7 = costo_manufactura.sistema_7;
		let s8 = costo_manufactura.sistema_8;
		let cont1 = 0, cont2 = 0, cont3 = 0, cont5 = 0, cont6 = 0, cont7 = 0, cont8 = 0;
		
		let hxh3 = 0; hxh2 = 0; hxh1 = 0;
		let pz_terminada1 = 0, pz_terminada2 = 0, pz_terminada3 = 0;
		let pz_aceptada1 = 0, pz_aceptada2 = 0, pz_aceptada3 = 0;
		let prorateo1 = 0, prorateo2 = 0, prorateo3 = 0;
		let total_ganancia1 = 0, total_programada1=0, costo_total1=0, total_terminada1=0, total_aceptada1=0;
		let total_MP1= 0, total_insumos1=0, total_area1 = 0, total_MOTD1 = 0, total_MOTI1 = 0, total_MORD1 = 0, total_MORI1 = 0;
		let maquinaPint = 0;

		let hxhS1 = 0, gananciaS1 = 0, ingProgS1 = 0, costoS1 = 0, ingAcepS1 = 0, ingTerS1 = 0, prograS1 = 0;
		let hxhS2 = 0, gananciaS2 = 0, ingProgS2 = 0, costoS2 = 0, ingAcepS2 = 0, ingTerS2 = 0, prograS2 = 0;
		let hxhS3 = 0, gananciaS3 = 0, ingProgS3 = 0, costoS3 = 0, ingAcepS3 = 0, ingTerS3 = 0, prograS3 = 0;
		let hxhS5 = 0, gananciaS5 = 0, ingProgS5 = 0, costoS5 = 0, ingAcepS5 = 0, ingTerS5 = 0, prograS5 = 0;
		let hxhS6 = 0, gananciaS6 = 0, ingProgS6 = 0, costoS6 = 0, ingAcepS6 = 0, ingTerS6 = 0, prograS6 = 0;
		let hxhS7 = 0, gananciaS7 = 0, ingProgS7 = 0, costoS7 = 0, ingAcepS7 = 0, ingTerS7 = 0, prograS7 = 0;
		let hxhS8 = 0, gananciaS8 = 0, ingProgS8 = 0, costoS8 = 0, ingAcepS8 = 0, ingTerS8 = 0, prograS8 = 0;

		let gran_total_ingresos = 0, gran_total_costo = 0, gran_total_aceptadas = 0, gran_total_terminadas = 0, gran_total_proyectado = 0;

		let totales_costo_total_MOR = 0, totales_costo_total_MOT = 0,  totales_mp= 0, totales_MOTD = 0, totales_MOTI =0, totales_costo_MOR =0, totales_costo_MOT = 0, totales_ingresos = 0, totales_maq = 0;

		var table = $('#tabla1').DataTable();
		table.clear().draw();
		table.destroy();

		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='9' || manufactura[i].sistema=='1'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='SISTEMA 1 PREPARACION'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='SISTEMA 1 PREPARACION'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == '126'){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}

				hxh1 +=manufactura[i].hxh*1;
				pz_terminada1 += manufactura[i].piezas_terminadas*1;
				pz_aceptada1 += manufactura[i].piezas_aceptadas*1;
				
				if(manufactura[i].area != 0){
					siS1++;
				}
				cont1++;
				hxhS1 += manufactura[i].hxh*1; 
				gananciaS1 +=manufactura[i].ingreso*1;
				ingProgS1 += manufactura[i].ingreso_programado*1;
				costoS1 +=manufactura[i].costo_total*1;
				ingAcepS1 += manufactura[i].ingreso_aceptado*1;
				ingTerS1 += manufactura[i].ingreso_terminado*1;
				prograS1 +=manufactura[i].piezas_programadas*1;
				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen+' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont1 > 0){
			
			

			total_insumos1 +=s1.total_insumos*1;
			total_MP1 +=s1.total_materia_prima*1;
			total_area1 += s1.area_total*1;
			total_MOTD1 += s1.total_MOTD*1;
			total_MOTI1 += s1.total_MOTI*1;
			total_ganancia1 += s1.total_ganancia*1;
			costo_total1 +=s1.costo_total*1;
			total_programada1 += s1.ganancia_programada;
			total_terminada1 += s1.ganancia_terminadas;
			total_aceptada1 += s1.ganancia_aceptada;
			prorateo1 += s1.total_prorateo*1;
			total_MORD1 += s1.total_MORD*1;
			total_MORI1 += s1.total_MORI*1;
			maquinaPint +=s1.maquina*1;
			let per_procesado = (hxhS1/prograS1)*100;
			let per_proyectado = (gananciaS1/ingProgS1)*100;
			let per_terminado = (costoS1/ingTerS1)*100;
			let per_procesadas = (costoS1/gananciaS1)*100;
			let per_aceptada = (costoS1/ingAcepS1)*100;

			table.row.add([
				'Sistema 1 <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s1.total_insumos,
				s1.total_materia_prima,
				//'',
				s1.area_total,
				'',
				'',
				s1.total_prorateo,
				s1.total_MORD,
				s1.total_MOTD,
				s1.total_MORI,
				s1.total_MOTI,
				s1.maquina,
				s1.total_ganancia,
				s1.costo_total,
				/*s1.total_utilidad,
				s1.margen +' %',
				s1.costo_unitario,
				s1.costo_fb_lb,*/
				s1.ganancia_aceptada,
				s1.ganancia_terminadas,
				s1.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');
		}
		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='2'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='SISTEMA 2'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='SISTEMA 2'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == '120'){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}

				hxh1 +=manufactura[i].hxh*1;
				pz_terminada1 += manufactura[i].piezas_terminadas*1;
				pz_aceptada1 += manufactura[i].piezas_aceptadas*1;
				
				if(manufactura[i].area != 0){
					siS2++;
				}
				cont2++;

				hxhS2 += manufactura[i].hxh*1; 
				gananciaS2 +=manufactura[i].ingreso*1;
				ingProgS2 += manufactura[i].ingreso_programado*1;
				costoS2 +=manufactura[i].costo_total*1;
				ingAcepS2 += manufactura[i].ingreso_aceptado*1;
				ingTerS2 += manufactura[i].ingreso_terminado*1;
				prograS2 +=manufactura[i].piezas_programadas*1;
				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen+' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont2 > 0){
			
			
			total_insumos1 +=s2.total_insumos*1;
			total_MP1 +=s2.total_materia_prima*1;
			total_area1 += s2.area_total*1;
			total_MOTD1 += s2.total_MOTD*1;
			total_MOTI1 += s2.total_MOTI*1;
			total_ganancia1 += s2.total_ganancia*1;
			costo_total1 +=s2.costo_total*1;
			total_programada1 += s2.ganancia_programada;
			total_terminada1 += s2.ganancia_terminadas;
			total_aceptada1 += s2.ganancia_aceptada;
			prorateo1 += s2.total_prorateo*1;
			total_MORD1 += s2.total_MORD*1;
			total_MORI1 += s2.total_MORI*1;
			maquinaPint +=s2.maquina*1;

			let per_procesado = (hxhS2/prograS2)*100;
			let per_proyectado = (gananciaS2/ingProgS2)*100;
			let per_terminado = (costoS2/ingTerS2)*100;
			let per_procesadas = (costoS2/gananciaS2)*100;
			let per_aceptada = (costoS2/ingAcepS2)*100;

			table.row.add([
				'Sistema 2 <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s2.total_insumos,
				s2.total_materia_prima,
				//'',
				s2.area_total,
				'',
				'',
				s2.total_prorateo,
				s2.total_MORD,
				s2.total_MOTD,
				s2.total_MORI,
				s2.total_MOTI,
				s2.maquina,
				s2.total_ganancia,
				s2.costo_total,
				/*s2.total_utilidad,
				s2.margen+' %',
				s2.costo_unitario,
				s2.costo_fb_lb,*/
				s2.ganancia_aceptada,
				s2.ganancia_terminadas,
				s2.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');

		}
		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='3'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='SISTEMA 3'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='SISTEMA 3'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == '121'){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}
				hxh1 +=manufactura[i].hxh*1;
				pz_terminada1 += manufactura[i].piezas_terminadas*1;
				pz_aceptada1 += manufactura[i].piezas_aceptadas*1;

				if(manufactura[i].area != 0){
					siS3++;
				}				

				cont3++;

				hxhS3 += manufactura[i].hxh*1; 
				gananciaS3 +=manufactura[i].ingreso*1;
				ingProgS3 += manufactura[i].ingreso_programado*1;
				costoS3 +=manufactura[i].costo_total*1;
				ingAcepS3 += manufactura[i].ingreso_aceptado*1;
				ingTerS3 += manufactura[i].ingreso_terminado*1;
				prograS3 +=manufactura[i].piezas_programadas*1;

				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen+' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont3 > 0){
			
			
			total_insumos1 +=s3.total_insumos*1;
			total_MP1 +=s3.total_materia_prima*1;
			total_area1 += s3.area_total*1;
			total_MOTD1 += s3.total_MOTD*1;
			total_MOTI1 += s3.total_MOTI*1;
			total_ganancia1 += s3.total_ganancia*1;
			costo_total1 +=s3.costo_total*1;
			total_programada1 += s3.ganancia_programada;
			total_terminada1 += s3.ganancia_terminadas;
			total_aceptada1 += s3.ganancia_aceptada;
			prorateo1 += s3.total_prorateo*1;
			total_MORD1 += s3.total_MORD*1;
			total_MORI1 += s3.total_MORI*1;
			maquinaPint +=s3.maquina*1;

			let per_procesado = (hxhS3/prograS3)*100;
			let per_proyectado = (gananciaS3/ingProgS3)*100;
			let per_terminado = (costoS3/ingTerS3)*100;
			let per_procesadas = (costoS3/gananciaS3)*100;
			let per_aceptada = (costoS3/ingAcepS3)*100;

			table.row.add([
				'Sistema 3 <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s3.total_insumos,
				s3.total_materia_prima,
				//'',
				s3.area_total,
				'',
				'',
				s3.total_prorateo,
				s3.total_MORD,
				s3.total_MOTD,
				s3.total_MORI,
				s3.total_MOTI,
				s3.maquina,
				s3.total_ganancia,
				s3.costo_total,
				/*s3.total_utilidad,
				s3.margen+' %',
				s3.costo_unitario,
				s3.costo_fb_lb,*/
				s3.ganancia_aceptada,
				s3.ganancia_terminadas,
				s3.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');
		}
		
		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='5'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='SISTEMA 5'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='SISTEMA 5'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == '122'){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}
				hxh1 +=manufactura[i].hxh*1;
				pz_terminada1 += manufactura[i].piezas_terminadas*1;
				pz_aceptada1 += manufactura[i].piezas_aceptadas*1;

				if(manufactura[i].area != 0){
					siS5++;
				}				

				cont5++;

				hxhS5 += manufactura[i].hxh*1; 
				gananciaS5 +=manufactura[i].ingreso*1;
				ingProgS5 += manufactura[i].ingreso_programado*1;
				costoS5 +=manufactura[i].costo_total*1;
				ingAcepS5 += manufactura[i].ingreso_aceptado*1;
				ingTerS5 += manufactura[i].ingreso_terminado*1;
				prograS5 +=manufactura[i].piezas_programadas*1;

				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen +' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont5 > 0){
			
			
			total_insumos1 +=s5.total_insumos*1;
			total_MP1 +=s5.total_materia_prima*1;
			total_area1 += s5.area_total*1;
			total_MOTD1 += s5.total_MOTD*1;
			total_MOTI1 += s5.total_MOTI*1;
			total_ganancia1 += s5.total_ganancia*1;
			costo_total1 +=s5.costo_total*1;
			total_programada1 += s5.ganancia_programada;
			total_terminada1 += s5.ganancia_terminadas;
			total_aceptada1 += s5.ganancia_aceptada;
			prorateo1 += s5.total_prorateo*1;
			total_MORD1 += s5.total_MORD*1;
			total_MORI1 += s5.total_MORI*1;
			maquinaPint +=s5.maquina*1;

			let per_procesado = (hxhS5/prograS5)*100;
			let per_proyectado = (gananciaS5/ingProgS5)*100;
			let per_terminado = (costoS5/ingTerS5)*100;
			let per_procesadas = (costoS5/gananciaS5)*100;
			let per_aceptada = (costoS5/ingAcepS5)*100;

			table.row.add([
				'Sistema 5 <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s5.total_insumos,
				s5.total_materia_prima,
				//'',
				s5.area_total,
				'',
				'',
				s5.total_prorateo,
				s5.total_MORD,
				s5.total_MOTD,
				s5.total_MORI,
				s5.total_MOTI,
				s5.maquina,
				s5.total_ganancia,
				s5.costo_total,
				/*s5.total_utilidad,
				s5.margen+' %',
				s5.costo_unitario,
				s5.costo_fb_lb,*/
				s5.ganancia_aceptada,
				s5.ganancia_terminadas,
				s5.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');
		}
		
		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='6'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='CUARTO DE PREPARACION'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='CUARTO DE PREPARACION'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == '119'){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}
				hxh1 +=manufactura[i].hxh*1;
				pz_terminada1 += manufactura[i].piezas_terminadas*1;
				pz_aceptada1 += manufactura[i].piezas_aceptadas*1;
				
				if(manufactura[i].area != 0){
					siS6++;
				}

				cont6++;

				hxhS6 += manufactura[i].hxh*1; 
				gananciaS6 +=manufactura[i].ingreso*1;
				ingProgS6 += manufactura[i].ingreso_programado*1;
				costoS6 +=manufactura[i].costo_total*1;
				ingAcepS6 += manufactura[i].ingreso_aceptado*1;
				ingTerS6 += manufactura[i].ingreso_terminado*1;
				prograS6 +=manufactura[i].piezas_programadas*1;

				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen+' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont6 > 0){
			
			;
			total_insumos1 +=s6.total_insumos*1;
			total_MP1 +=s6.total_materia_prima*1;
			total_area1 += s6.area_total*1;
			total_MOTD1 += s6.total_MOTD*1;
			total_MOTI1 += s6.total_MOTI*1;
			costo_total1 +=s6.costo_total*1;
			total_ganancia1 += s6.total_ganancia*1;
			total_programada1 += s6.ganancia_programada;
			total_terminada1 += s6.ganancia_terminadas;
			total_aceptada1 += s6.ganancia_aceptada;
			prorateo1 += s6.total_prorateo*1;
			total_MORD1 += s6.total_MORD*1;
			total_MORI1 += s6.total_MORI*1;
			maquinaPint +=s6.maquina*1;

			let per_procesado = (hxhS6/prograS6)*100;
			let per_proyectado = (gananciaS6/ingProgS6)*100;
			let per_terminado = (costoS6/ingTerS6)*100;
			let per_procesadas = (costoS6/gananciaS6)*100;
			let per_aceptada = (costoS6/ingAcepS6)*100;

			table.row.add([
				'Cuarto de Preparación <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s6.total_insumos,
				s6.total_materia_prima,
				//'',
				s6.area_total,
				'',
				'',
				s6.total_prorateo,
				s6.total_MORD,
				s6.total_MOTD,
				s6.total_MORI,
				s6.total_MOTI,
				s6.maquina,
				s6.total_ganancia,
				s6.costo_total,
				/*s6.total_utilidad,
				s6.margen+' %',
				s6.costo_unitario,
				s6.costo_fb_lb,*/
				s6.ganancia_aceptada,
				s6.ganancia_terminadas,
				s6.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');
		}
		if(cont1 !=0 || cont2 !=0 || cont3 !=0 || cont5 !=0 || cont6 !=0){
			
			let per_proyectado1 = (total_ganancia1*1/total_programada1*1)*100;	
			let per_procesado1 = (costo_total1*1/total_ganancia1*1)*100;
			let per_aceptada1 = (costo_total1*1/total_aceptada1*1)*100;
			let per_terminadas1 = (costo_total1*1/total_terminada1*1)*100;

			gran_total_ingresos += total_ganancia1;
			gran_total_costo += costo_total1;
			gran_total_aceptadas += total_aceptada1;
			gran_total_terminadas += total_terminada1;
			gran_total_proyectado += total_programada1;
			
			totales_mp +=total_MP1;
			totales_ingresos +=total_ganancia1;
			totales_maq +=maquinaPint*1;

			table.row.add([
            'Total Pintado: <i class="fas fa-long-arrow-alt-right"></i>',
            '',
            '',
            '',
            '',
            '',
            hxh1.toFixed(2),
            pz_terminada1.toFixed(2),
            pz_aceptada1.toFixed(2),
            total_insumos1.toFixed(3),
            total_MP1.toFixed(3),
           // '',
            '',
            '',
            '',
            prorateo1.toFixed(3),
           	total_MORD1.toFixed(3),
            total_MOTD1.toFixed(3),
   	      total_MORI1.toFixed(3),
				total_MOTI1.toFixed(3),
				maquinaPint.toFixed(3),
				total_ganancia1.toFixed(3),
				costo_total1.toFixed(3),
				/*'',
				'',
				'',
				'',*/
				total_aceptada1.toFixed(3),
				total_terminada1.toFixed(3),
				total_programada1.toFixed(3),
				per_terminadas1.toFixed(3) +' %',
				per_procesado1.toFixed(3) +' %',
				per_aceptada1.toFixed(3) +' %',
				per_proyectado1.toFixed(3) + ' %',
				'']).nodes()
            .to$()
         	.addClass('totalesSeparados');
		}
		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='7'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='MOLDEO'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='MOLDEO'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == '65'){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}
				hxh2 +=manufactura[i].hxh*1;
				pz_terminada2 += manufactura[i].piezas_terminadas*1;
				pz_aceptada2 += manufactura[i].piezas_aceptadas*1;
				prorateo2 += manufactura[i].prrorateo_insumos*1;

				if(manufactura[i].area != 0){
					siS7++;
				}

				cont7++;

				hxhS7 += manufactura[i].hxh*1; 
				gananciaS7 +=manufactura[i].ingreso*1;
				ingProgS7 += manufactura[i].ingreso_programado*1;
				costoS7 +=manufactura[i].costo_total*1;
				ingAcepS7 += manufactura[i].ingreso_aceptado*1;
				ingTerS7 += manufactura[i].ingreso_terminado*1;
				prograS7 +=manufactura[i].piezas_programadas*1;

				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen+' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont7 > 0){
			
						let per_procesado = (hxhS7/prograS7)*100;
			let per_proyectado = (gananciaS7/ingProgS7)*100;
			let per_terminado = (costoS7/ingTerS7)*100;
			let per_procesadas = (costoS7/gananciaS7)*100;
			let per_aceptada = (costoS7/ingAcepS7)*100;
			totales_maq +=s7.maquina*1;
			table.row.add([
				'Sistema 7 <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s7.total_insumos,
				s7.total_materia_prima,
				//'',
				s7.area_total,
				'',
				'',
				s7.total_prorateo,
				s7.total_MORD,
				s7.total_MOTD,
				s7.total_MORI,
				s7.total_MOTI,
				s7.maquina,
				s7.total_ganancia,
				s7.costo_total,
				/*s7.total_utilidad,
				s7.margen+' %',
				s7.costo_unitario,
				s7.costo_fb_lb,*/
				s7.ganancia_aceptada,
				s7.ganancia_terminadas,
				s7.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');

			let per_proyectado2 = (s7.total_ganancia*1/s7.ganancia_programada*1)*100;	
         per_proyectado2 = isNaN(per_proyectado2) ? 0 : per_proyectado2;

			let per_procesado2 = (s7.costo_total*1/s7.total_ganancia*1)*100;
         per_procesado2 = isNaN(per_procesado2) ? 0 : per_procesado2;

			let per_aceptada2 = (s7.costo_total*1/s7.ganancia_aceptada*1)*100;
         per_aceptada2 = isNaN(per_aceptada2) ? 0 : per_aceptada2;

			let per_terminadas2 = (s7.costo_total*1/s7.ganancia_terminadas*1)*100;
         per_terminadas2 = isNaN(per_terminadas2) ? 0 : per_terminadas2;
         per_terminadas2 = isFinite(per_terminadas2) ? per_terminadas2 : 0;

			gran_total_ingresos += s7.total_ganancia*1;
			gran_total_costo += s7.costo_total*1;
			gran_total_aceptadas += s7.ganancia_aceptada*1;
			gran_total_terminadas += s7.ganancia_terminadas*1;
			gran_total_proyectado += s7.ganancia_programada*1;
			//console.log(gran_total_proyectado);

			totales_mp +=s7.total_materia_prima*1;
			totales_ingresos +=s7.total_ganancia*1;

			table.row.add([
            'Total Moldeo: <i class="fas fa-long-arrow-alt-right"></i>',
            '',
            '',
            '',
            '',
            '',
            hxh2.toFixed(2),
            pz_terminada2.toFixed(2),
            pz_aceptada2.toFixed(2),
            s7.total_insumos,
            s7.total_materia_prima,
            //'',
            '',
            '',
            '',
            s7.total_prorateo,
           	s7.total_MORD,
            s7.total_MOTD,
   	      s7.total_MORI,
				s7.total_MOTI,
				s7.maquina,
				s7.total_ganancia,
				s7.costo_total,
				/*'',
				'',
				'',
				'',*/
				s7.ganancia_aceptada,
				s7.ganancia_terminadas,
				s7.ganancia_programada,
				per_terminadas2.toFixed(3) +' %',
				per_procesado2.toFixed(3) +' %',
				per_aceptada2.toFixed(3) +' %',
				per_proyectado2.toFixed(3) + ' %',
				'']).nodes()
            .to$()
         	.addClass('totalesSeparados');
		}
		for (var i = 0; i < manufactura.length; i++) {
			if(manufactura[i].sistema=='8'){

				for(var x = 0; x <arrayMO.length; x++){

					if(manufactura[i].fecha == arrayMO[x].fecha_oficial && arrayMO[x].sistema=='EXTRUSION ALUMINIO'){
						arrayMO[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x <arrayMOR.length; x++){

					if(manufactura[i].fecha == arrayMOR[x].fecha_oficial && arrayMOR[x].sistema=='EXTRUSION ALUMINIO'){
						arrayMOR[x]['noContado'] = 'S';
					}
				}
				for(var x = 0; x<arraySistemas.length; x++){
					let seg = '';
					if(arraySistemas[x].insDepartamento == 'OK'){
						if(manufactura[i].maquina == 'Prensa 2 [1450T]'){
							seg = '128';
						}else{
							seg = '51'
						}
						if(arraySistemas[x].fecha == manufactura[i].fecha && arraySistemas[x].segmento == seg){
							arraySistemas[x]['noContado'] = 'S';
						}
					}
				}
				hxh3 +=manufactura[i].hxh*1;
				pz_terminada3 += manufactura[i].piezas_terminadas*1;
				pz_aceptada3 += manufactura[i].piezas_aceptadas*1;
				prorateo3 += manufactura[i].prrorateo_insumos*1;

				if(manufactura[i].area != 0){
					siS8++;
				}

				cont8++;

				hxhS8 += manufactura[i].hxh*1; 
				gananciaS8 +=manufactura[i].ingreso*1;
				ingProgS8 += manufactura[i].ingreso_programado*1;
				costoS8 +=manufactura[i].costo_total*1;
				ingAcepS8 += manufactura[i].ingreso_aceptado*1;
				ingTerS8 += manufactura[i].ingreso_terminado*1;
				prograS8 +=manufactura[i].piezas_programadas*1;

				table.row.add([
					'<b title="Tipo de Folio: '+manufactura[i].tipo_folio+'">'+manufactura[i].folio+'</b>',
					manufactura[i].cliente,
					manufactura[i].sistema,
					manufactura[i].fecha,
					manufactura[i].NP,
					manufactura[i].piezas_programadas,
					manufactura[i].hxh,
					manufactura[i].piezas_terminadas,
					manufactura[i].piezas_aceptadas,
					manufactura[i].insumos,
					manufactura[i].materia_prima,
					//manufactura[i].unitario_mp,
					manufactura[i].area,
					manufactura[i].precio_venta,
					manufactura[i].participacion + ' %',
					manufactura[i].prrorateo_insumos,
					manufactura[i].asignacionMORD,
					manufactura[i].asignacionMOTD,
					manufactura[i].asignacionMORI,
					manufactura[i].asignacionMOTI,
					manufactura[i].costo_maquina,
					manufactura[i].ingreso,
					manufactura[i].costo_total,
					/*manufactura[i].utilidad,
					manufactura[i].margen+' %',
					manufactura[i].costo_unitario,
					manufactura[i].costo_ft_lbs,*/
					manufactura[i].ingreso_aceptado,
					manufactura[i].ingreso_terminado,
					manufactura[i].ingreso_programado,
					manufactura[i].per_terminado + ' %',
					manufactura[i].per_procesadas + ' %',
					manufactura[i].per_aceptada + ' %',
					manufactura[i].per_proyectado + ' %',
					manufactura[i].per_procesado + ' %']);
			}
		}
		if(cont8 > 0){
			
			
			let per_procesado = (hxhS8/prograS8)*100;
			let per_proyectado = (gananciaS8/ingProgS8)*100;
			let per_terminado = (costoS8/ingTerS8)*100;
			let per_procesadas = (costoS8/gananciaS8)*100;
			let per_aceptada = (costoS8/ingAcepS8)*100;
			totales_maq +=s8.maquina*1;
			table.row.add([
				'Sistema 8 <i class="fas fa-level-up-alt"></i>',
				'',
				'',
				'',
				'Totales: <i class="fas fa-long-arrow-alt-right"></i>',
				'',
				'',
				'',
				'',
				s8.total_insumos,
				s8.total_materia_prima,
				//'',
				s8.area_total,
				'',
				'',
				s8.total_prorateo,
				s8.total_MORD,
				s8.total_MOTD,
				s8.total_MORI,
				s8.total_MOTI,
				s8.maquina,
				s8.total_ganancia,
				s8.costo_total,
				/*s8.total_utilidad,
				s8.margen+' %',
				s8.costo_unitario,
				s8.costo_fb_lb,*/
				s8.ganancia_aceptada,
				s8.ganancia_terminadas,
				s8.ganancia_programada,
				per_terminado.toFixed(3)+' %',
				per_procesadas.toFixed(3)+' %',
				per_aceptada.toFixed(3)+' %',
				per_proyectado.toFixed(3)+' %',
				per_procesado.toFixed(3)+' %']).nodes()
				.to$()
				.addClass('totales');

			let per_proyectado3 = (s8.total_ganancia*1/s8.ganancia_programada*1)*100;
			per_proyectado3 = isFinite(per_proyectado3) ? per_proyectado3 : 0; 	

			let per_procesado3 = (s8.costo_total*1/s8.total_ganancia*1)*100;
			per_procesado3 = isFinite(per_procesado3) ? per_procesado3 : 0; 	

			let per_aceptada3 = (s8.costo_total*1/s8.ganancia_aceptada*1)*100;
			per_aceptada3 = isFinite(per_aceptada3) ? per_aceptada3 : 0; 	

			let per_terminadas3 = (s8.costo_total*1/s8.ganancia_terminadas*1)*100;
			per_terminadas3 = isFinite(per_terminadas3) ? per_terminadas3 : 0; 	

			gran_total_ingresos += s8.total_ganancia*1;
			gran_total_costo += s8.costo_total*1;
			gran_total_aceptadas += s8.ganancia_aceptada*1;
			gran_total_terminadas += s8.ganancia_terminadas*1;
			gran_total_proyectado += s8.ganancia_programada*1;
			
			//console.log(gran_total_proyectado);
			
			totales_mp +=s8.total_materia_prima*1;
			totales_ingresos +=s8.total_ganancia*1;

			table.row.add([
            'Total Extrusión: <i class="fas fa-long-arrow-alt-right"></i>',
            '',
            '',
            '',
            '',
            '',
            hxh3.toFixed(2),
            pz_terminada3.toFixed(2),
            pz_aceptada3.toFixed(2),
            s8.total_insumos,
            s8.total_materia_prima,
            //'',
            '',
            '',
            '',
            prorateo3.toFixed(3),
           	s8.total_MORD,
            s8.total_MOTD,
   	      s8.total_MORI,
				s8.total_MOTI,
				s8.maquina,
				s8.total_ganancia,
				s8.costo_total,
				/*'',
				'',
				'',
				'',*/
				s8.ganancia_aceptada,
				s8.ganancia_terminadas,
				s8.ganancia_programada,
				per_terminadas3.toFixed(3) +' %',
				per_procesado3.toFixed(3) +' %',
				per_aceptada3.toFixed(3) +' %',
				per_proyectado3.toFixed(3) + ' %',
				'']).nodes()
            .to$()
         		.addClass('totalesSeparados');
		}
		let gran_per_terminadas = (gran_total_costo/gran_total_terminadas)*100;
		let gran_per_procesadas = (gran_total_costo/gran_total_ingresos)*100;
		let gran_per_aceptadas = (gran_total_costo/gran_total_aceptadas)*100;
		let gran_per_proyectado = (gran_total_ingresos/gran_total_proyectado)*100;
		table.row.add([
			'Total Diario: <i class="fas fa-long-arrow-alt-right"></i>',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			//'',
			'',
			gran_total_ingresos.toFixed(3),
			gran_total_costo.toFixed(3),
			/*'',
			'',
			'',
			'',*/
			gran_total_aceptadas.toFixed(3),
			gran_total_terminadas.toFixed(3),
			gran_total_proyectado.toFixed(3),
			gran_per_terminadas.toFixed(3) + ' %',
			gran_per_procesadas.toFixed(3) + ' %',
			gran_per_aceptadas.toFixed(3) + ' %',
			gran_per_proyectado.toFixed(3) + ' %',
			'']).nodes()
			.to$()
			.addClass('totalesDiario');
		
		table.draw(false);
		tableManufactura();

		var tabla =  $('#tabla0').DataTable();
		tabla.clear().draw();

		totales_MOTD +=motd*1;
		totales_MOTI +=moti*1;
		totales_costo_MOT = totales_MOTD + totales_MOTI;
		totales_costo_MOR = totales_MORD + totales_MORI;
      totales_costo_total_MOT = granTotalInsumos + totales_mp + totales_costo_MOT + totales_maq;
      totales_costo_total_MOR = granTotalInsumos + totales_mp + totales_costo_MOR + totales_maq;

		tabla.row.add([
			totales_costo_total_MOR.toFixed(3),
			totales_costo_total_MOT.toFixed(3),
			granTotalInsumos,
			totales_mp.toFixed(3),
			totales_maq.toFixed(3),
			totales_MORD.toFixed(3),
			totales_MORI.toFixed(3),
			totales_MOTD.toFixed(3),
			totales_MOTI.toFixed(3),
			totales_costo_MOR.toFixed(3),
			totales_costo_MOT.toFixed(3),
			totales_ingresos.toFixed(3)]);
		tabla.draw(false);
		$('#carga').hide();
	}
	function tablaCostoUnitario(costo_manufactura){
		let costos = costo_manufactura.manufactura;
		//console.log(costos);
		var tabla = $('#table_unit').DataTable();
		tabla.clear().draw(false);
		if(costos.length > 0){
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;
        		
        		if(costos[i].sistema =='1' || costos[i].sistema=='9'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						maq.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);

        		}
			}
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;
        		
        		if(costos[i].sistema=='2'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						maq.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);
        		}
			}
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;

        		if(costos[i].sistema=='3'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						maq.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);


        		}
			}
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;
        		
        		
        		if(costos[i].sistema=='5'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						maq.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);


        		}
			}
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;
        		
        		if(costos[i].sistema=='6'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						maq.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);


        		}
			}
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;
        		
        		if(costos[i].sistema=='7'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						maq.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);

        		}
			}
			for(var i = 0; i <costos.length; i++){
				let costo_unit = (costos[i].costo_total*1/costos[i].hxh*1);
				costo_unit = isNaN(costo_unit) ? 0 : costo_unit;
        		costo_unit = isFinite(costo_unit) ? costo_unit : 0;
				let ins_folio = costos[i].insumos*1/costos[i].hxh*1;
				ins_folio = isNaN(ins_folio) ? 0 : ins_folio;
        		ins_folio = isFinite(ins_folio) ? ins_folio : 0;
				let ins_sinfolio = costos[i].prrorateo_insumos*1/costos[i].hxh*1;
				ins_sinfolio = isNaN(ins_sinfolio) ? 0 : ins_sinfolio;
        		ins_sinfolio = isFinite(ins_sinfolio) ? ins_sinfolio : 0;
				let mp = costos[i].materia_prima*1/costos[i].hxh*1;
				mp = isNaN(mp) ? 0 : mp;
        		mp = isFinite(mp) ? mp : 0;
				let costo_mord = costos[i].asignacionMORD*1/costos[i].hxh*1;
				costo_mord = isNaN(costo_mord) ? 0 : costo_mord;
        		costo_mord = isFinite(costo_mord) ? costo_mord : 0;

        		let maq = costos[i].costo_maquina*1/costos[i].hxh*1;
				maq = isNaN(maq) ? 0 : maq;
        		maq = isFinite(maq) ? maq : 0;

				let costo_motd = costos[i].asignacionMOTD*1/costos[i].hxh*1;
				costo_motd = isNaN(costo_motd) ? 0 : costo_motd;
        		costo_motd = isFinite(costo_motd) ? costo_motd : 0;
				let costo_mori = costos[i].asignacionMORI*1/costos[i].hxh*1;
				costo_mori = isNaN(costo_mori) ? 0 : costo_mori;
        		costo_mori = isFinite(costo_mori) ? costo_mori : 0;
				let costo_moti = costos[i].asignacionMOTI*1/costos[i].hxh*1;
				costo_moti = isNaN(costo_moti) ? 0 : costo_moti;
        		costo_moti = isFinite(costo_moti) ? costo_moti : 0;
				let margen = (costo_unit.toFixed(4)/costos[i].precio_venta*1)*100;
				margen = isNaN(margen) ? 0 : margen;
        		margen = isFinite(margen) ? margen : 0;
        		
        		if(costos[i].sistema=='8'){
					tabla.row.add([
						costos[i].folio,
						costos[i].cliente,
						costos[i].NP,
						costos[i].hxh,
						costos[i].costo_total,
						costo_unit.toFixed(3),
						ins_folio.toFixed(3),
						ins_sinfolio.toFixed(3),
						mp.toFixed(3),
						maq.toFixed(3),
						costo_mord.toFixed(3),
						costo_motd.toFixed(3),
						costo_mori.toFixed(3),
						costo_moti.toFixed(3),
						costos[i].precio_venta,
						margen.toFixed(3) + ' %']);

        		}
			}
			tabla.draw(false);	
		}
	}
</script>
