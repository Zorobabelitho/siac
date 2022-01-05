var divLoading = document.querySelector('#divLoading');
var tableBandejaReportes;
var tableBandejaReportes_Busqueda;
var tableReporteCiudadano;
var tableReportesRegistrado;
var tableNotas;
var tableHistorial;

//Datos ciudadano
let ciudadano;
let tipoContacto;
let telefono;
let colonia;
let codigoPostal;
let calle_NumEx;
let numeroInterior;
let mapa;

var strFecha = new Date();
var meses = new Array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
var strFechaHoy = strFecha.getDate() + ' de '+ meses[strFecha.getMonth()] + ' del ' + strFecha.getFullYear();

jQuery.datetimepicker.setLocale('es');
jQuery('#dtpFechaInicial').datetimepicker({
	timepicker:false,
	format:'Y-m-d'
});
jQuery('#dtpFechafinal').datetimepicker({
	timepicker:false,
	format:'Y-m-d'
});

document.addEventListener('DOMContentLoaded', function(){

	tableBandejaReportes = $('#tableBandejaReportes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url": " "+base_url+"/BandejaReportes/getBandejaReportes",

			"dataSrc":""
		},
		"columns":[
			{"data":"Id", "visible": false},
			{"data":"Numero_de_Ticket", "width": "10%"},
			{"data":"Fecha", "width": "10%"},
			{"data":"Estatus_del_Ticket", "width": "10%"},
			{"data":"Tramites_y_Servicios", "width": "40%"},
			{"data":"Area_Asignada", "width": "20%"},
			{"data":"options", "width": "10%"}
		],
		'dom': 'lBftip',
		'buttons': [
			{
				"extend": "pdfHtml5",
				"text": "<i class='fas fa-file-pdf'></i>  PDF",
				"titleAttr" : "Exportar a PDF",
				"className" : "btn btn-danger",
				"exportOptions": {
					"columns":[ 0,1,2,3,4]
				}
			}
		],
		"resonsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order":[[0,"desc"]]
	});

	var formDatosCiudadano = document.querySelector('#formDatosCiudadano');
	formDatosCiudadano.onsubmit = function(e) {
		e.preventDefault();

		//Modificar datos del ciudadano
		var strNombre = document.querySelector('#txtNombreEdit').value;
		var strApellidoPaterno = document.querySelector('#txtApePaternoEdit').value;
		var intTipoContacto = document.querySelector('#listTipoContactoEdit').value;
		var strTelefono = document.querySelector('#txtTelefonoEdit').value;
		var intColonia = document.querySelector('#listColoniaEdit').value;
		var intCalle = document.querySelector('#listCalleEdit').value;
		var strNumeroExterior = document.querySelector('#txtNumExteriorEdit').value;
		var intEntreCalle1 = document.querySelector('#listCalle1Edit').value;
		var intEntreCalle2 = document.querySelector('#listCalle2Edit').value;

		if(strNombre == '' || strApellidoPaterno == '' || intTipoContacto == '' || strTelefono == '' || intColonia == '' || intCalle == '' || strNumeroExterior == '' || intEntreCalle1 == '' || intEntreCalle1 == '')
		{
			swal("Atención", "Todos los campos en rojo son obligatorios." , "error");
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/Ciudadano/setCiudadano_BandejaReportes';
		var formData = new FormData(formDatosCiudadano);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					swal("Reporte ciudadano", objData.msg , "success");
 				}else{
 					swal("Atención", objData.msg , "warning");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;
	}

	var formBandejaReportes = document.querySelector('#formBandejaReportes');
	formBandejaReportes.onsubmit = function(e) {
		e.preventDefault();

		//Verificar que datos proporciona el usuario
		var strNumTicket = document.querySelector('#txtNumTicket_Busqueda').value;
		if(strNumTicket == '') strNumTicket = 'null';
		var strDetalleReporte = document.querySelector('#txtDetalleReporte_Busqueda').value;
		if(strDetalleReporte == '') strDetalleReporte = 'null';
		var strNotaReporte = document.querySelector('#txtNotaReporte_Busqueda').value;
		if(strNotaReporte == '') strNotaReporte = 'null';
		var intEstatusTicket = document.querySelector('#listEstatusTicket_Busqueda').value;
		if(intEstatusTicket == '') intEstatusTicket = 0;
		var strFechaInicial = document.querySelector('#dtpFechaInicial').value;
		if(strFechaInicial == '') strFechaInicial = 'null';
		var strfechaFinal = document.querySelector('#dtpFechafinal').value;
		if(strfechaFinal == '') strfechaFinal = 'null';

		if(strFechaInicial != 'null' && strfechaFinal == 'null'){
			swal("Atención!", 'Debes seleccionar una fecha final para realizar tu búsqueda.' , "warning");
			return false;
		}else if(strFechaInicial == 'null' && strfechaFinal != 'null'){
			swal("Atención!", 'Debes seleccionar una fecha inicial para realizar tu búsqueda.' , "warning");
			return false;
		}

		if(strNumTicket == 'null' && strDetalleReporte == 'null' && strNotaReporte == 'null' && intEstatusTicket == 0 && strFechaInicial == 'null' && strfechaFinal == 'null'){
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/BandejaReportes/setBusquedaReporte/' + strNumTicket + '/' + strDetalleReporte + '/' + strNotaReporte + '/' + intEstatusTicket + '/' + strFechaInicial + '/' + strfechaFinal;
		var formData = new FormData();
		request.open("GET",ajaxUrl,true);
		request.send();

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					tableBandejaReportes_Busqueda = $('#tableBandejaReportes_Busqueda').dataTable( {
						"aProcessing":true,
						"aServerSide":true,
						"language": {
							"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
						},
						"ajax":{
							"url": " "+base_url+'/BandejaReportes/setBusquedaReporte/' + strNumTicket + '/' + strDetalleReporte + '/' + strNotaReporte + '/' + intEstatusTicket + '/' + strFechaInicial + '/' + strfechaFinal
							,
						},
						"columns":[
							{"data":"Numero_de_Ticket", "width": "10%"},
							{"data":"Fecha", "width": "10%"},
							{"data":"Estatus_del_Ticket", "width": "10%"},
							{"data":"Tramites_y_Servicios", "width": "40%"},
							{"data":"Area_Asignada", "width": "20%"},
							{"data":"options", "width": "10%"}
						],
						'dom': 'lBftip',
						'buttons': [
							{
								"extend": "pdfHtml5",
								"text": "<i class='fas fa-file-pdf'></i>  PDF",
								"titleAttr" : "Exportar a PDF",
								"className" : "btn btn-danger",
								"exportOptions": {
									"columns":[ 0,1,2,3,4]
								}
							}
						],
						"resonsieve":"true",
						"bDestroy": true,
						"iDisplayLength": 10,
						"order":[[1,"desc"]]
					});

					$('#modalBandejaReportes').modal("show");

 				}else{
 					swal("Atención!", objData.msg , "info");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;
	}

	var formVerReporteCiudadano = document.querySelector('#formVerReporteCiudadano');
	formVerReporteCiudadano.onsubmit = function(e) {
		e.preventDefault();

		//Guardar modificaciones de reporte

		var intTramiteServicio = document.querySelector('#listTramitesServicios').value;
		var strDetalleReporte = document.querySelector('#txtDetalleReporte').value;
		var strNumReparaciones = document.querySelector('#txtNumSolicitudes').value;
		var intColonia = document.querySelector('#listColonia').value;
		var intIdCalle = document.querySelector('#listCalle').value;
		var strNumExterior = document.querySelector('#txtNumeroExteriorTicket').value;
		var intIdEntreCalle1 = document.querySelector('#listCalle1').value;
		var intIdEntreCalle2 = document.querySelector('#listCalle2').value;
		var id_ticket = document.querySelector('#idTicket').value;

		if(intTramiteServicio == '' || strDetalleReporte == '' || strNumReparaciones == '' || intColonia == '' || intIdCalle == '' || strNumExterior == '' || intIdEntreCalle1 == '' || intIdEntreCalle2 == '')
		{
			swal("Atención", "Todos los campos son obligatorios." , "error");
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/BandejaReportes/setModificacionesReporte';
		var formData = new FormData(formVerReporteCiudadano);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					swal("Reporte ciudadano", objData.msg , "success");
 					fntCargaHistorial(id_ticket);
 				}else{
 					swal("Atención", objData.msg , "warning");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;

	}

	var formNotas = document.querySelector('#formNotas');
	formNotas.onsubmit = function(e) {
		e.preventDefault();

		var idticket = document.querySelector('#idTicketNota').value;
		var strNota = document.querySelector('#txtNota').value;
		if(strNota == '')
		{
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/BandejaReportes/setNota';
		var formData = new FormData(formNotas);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					formNotas.reset();
 					swal("Reporte ciudadano", objData.msg , "success");
 					fntCargaNotas(idticket);
 				}else{
 					swal("Error", objData.msg , "error");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;
	}

}, false);

//Muestra los ciudadanos
function fntVerCiudadano(id_ciudadano){

	divLoading.style.display = "flex";
	var id_ciudadano = id_ciudadano;
	var strMapa = "";

	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Ciudadano/getCiudadano/'+id_ciudadano;
	request.open("GET",ajaxUrl,true);
	request.send();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			var objData = JSON.parse(request.responseText);

			if(objData.status)
			{
				fntVerReportesRegistrados(id_ciudadano);
				if(objData.data.Calle != '' && objData.data.Nuumero_Exterior != '' && objData.data.Colonia != '')
				{
					strMapa = objData.data.Calle + ' ' + objData.data.Nuumero_Exterior + ', ' + objData.data.Colonia + ', Tlalnepantla de Baz, Estado de México ';
					mapa = '<br><div class="form-group"><a class="btn btn-warning btn-sm" href="https://www.google.com/maps/preview#!q=' + strMapa + '" target="_blank"><i class="icon fas fa-map-marker-alt"></i><span> ver ubicación</span></a></div>';
				}else{
					mapa = '';
				}
				ciudadano = objData.data.Ciudadano;
				tipoContacto = objData.data.Tipo_de_Contacto;
				telefono = 'Tel. ' + objData.data.Teleefono;
				calle_NumEx = objData.data.Calle + ' ' + objData.data.Nuumero_Exterior;
				numeroInterior = '# interior: '+ objData.data.Nuumero_Interior;
				colonia = objData.data.Colonia;
				codigoPostal = 'Edo. de México C.P. ' + objData.data.Codigo_Postal;

				//Datos del Ciudadano
				document.querySelector("#idCiudadano").value = objData.data.Id;
				document.querySelector("#txtNombreEdit").value = objData.data.Nombre;
				document.querySelector("#txtApePaternoEdit").value = objData.data.Apellido_Paterno;
				document.querySelector("#txtApeMaternoEdit").value = objData.data.Apellido_Materno;
				document.querySelector("#listTipoContactoEdit").value = objData.data.Id_Tipo_de_Contacto;
				document.querySelector("#txtTelefonoEdit").value = objData.data.Teleefono;
				document.querySelector("#txtDescripcionEdit").value = objData.data.Descripcioon;
				document.querySelector("#listColoniaEdit").value = objData.data.Id_colonia;
				document.querySelector("#listCalleEdit").value = objData.data.Id_Calle;
				document.querySelector("#txtNumExteriorEdit").value = objData.data.Nuumero_Exterior;
				document.querySelector("#txtNumInteriorEdit").value = objData.data.Nuumero_Interior;
				document.querySelector("#listCalle1Edit").value = objData.data.Id_Entre_Calle_1;
				document.querySelector("#listCalle2Edit").value = objData.data.Id_Entre_Calle_2;
				document.querySelector("#txtReferenciasEdit").value = objData.data.Referencias;
				document.querySelector("#txtEmailEdit").value = objData.data.Correo_Electroonico;
				document.querySelector("#listStatusEdit").value = objData.data.Id_Estatus_del_Registro;



				$('#listTipoContactoEdit').selectpicker('render');
				$('#listColoniaEdit').selectpicker('render');
				$('#listCalleEdit').selectpicker('render');
				$('#listCalle1Edit').selectpicker('render');
				$('#listCalle2Edit').selectpicker('render');

				if(objData.data.Id_Estatus_del_Registro == 1)
				{
					document.querySelector('#listStatusEdit').value = 1;
				}else{
					document.querySelector('#listStatusEdit').value = 2;
				}
				$('#listStatusEdit').selectpicker('render');

				$('#modalVerCiudadano').modal('show');
			}else{
				swal("Error", objData.msg , "error");
			}
		}
		divLoading.style.display = "none";
	}
}

function fntVerReportesRegistrados(id_ciudadano){
	var id_ciudadano = id_ciudadano;
	var ajaxUrl = '';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/ReporteCiudadano/getReportesRegistrados/'+id_ciudadano; 
    request.open("GET",ajaxUrl,true);
	request.send();
	
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			var objData = JSON.parse(request.responseText);
			if(objData.status){
				var ajaxUrl = ' '+base_url+'/ReporteCiudadano/getReportesRegistrados/'+id_ciudadano;
				fntCrearTablaReportesRegistrados(ajaxUrl);
			}else{
				var tabla = $('#tableReportesRegistrados').DataTable();
				tabla
					.clear()
					.draw();
				divLoading.style.display = "none";
				return false;
			}
		}
	}
}

//**************Carga detalles reporte****************

function fntInfoReporte(id_ticket){
	if(id_ticket > 0)
	{
		var id_ticket = id_ticket;
		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/getDetallesTicketGlobal/'+id_ticket;
		request.open("GET",ajaxUrl,true);
		request.send();
		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				var objData = JSON.parse(request.responseText);

				if(objData.status)
				{
					fntVerCiudadano(objData.data.Id_Ciudadano);

					if(objData.data.Calle != '' && objData.data.Nuumero_Exterior != '' && objData.data.Colonia != '')
					{
						strMapa = objData.data.Calle + ' ' + objData.data.Nuumero_Exterior + ', ' + objData.data.Colonia + ', Tlalnepantla de Baz, Estado de México ';
						mapa = '<br><div class="form-group"><a class="btn btn-warning btn-sm" href="https://www.google.com/maps/preview#!q=' + strMapa + '" target="_blank"><i class="icon fas fa-map-marker-alt"></i><span> ver ubicación</span></a></div>';
					}else{
						mapa = '';
					}
					var estatusTicket = '';
					if(objData.data.Id_Estatus_del_Ticket == 1) estatusTicket = '<span class="badge badge-danger">Rechazado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 2) estatusTicket = '<span class="badge badge-success">Asignado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 3) estatusTicket = '<span class="badge badge-danger">Cerrado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 4) estatusTicket = '<span class="badge badge-danger">Cancelado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 6) estatusTicket = '<span class="badge badge-success">Atendido</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 7) estatusTicket = '<span class="badge badge-warning">Reasignado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 8) estatusTicket = '<span class="badge badge-primary">Nuevo</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 9) estatusTicket = '<span class="badge badge-success">Terminado</span>';

					fntValidaEstatus(objData.data.Id_Estatus_del_Ticket, 1);
					fntCargaNotas(id_ticket);
					fntCargaHistorial(id_ticket);
					fntAreaPorDependencia(objData.data.Id_Dependencia_Asignada);
					fntEnlacePorDependencia(objData.data.Id_Dependencia_Asignada);

					document.querySelector('#NumeroTicket').innerHTML = '<h5 class="mb-3 line-head">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#NumeroTicketNotas').innerHTML = '<h5 class="mb-3 line-head">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#NumeroTicketSeguimiento').innerHTML = '<h5 class="mb-3 line-head">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#NumeroTickethistorial').innerHTML = '<h5 class="mb-3 line-head">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#divFecha').innerHTML = '<h6>' + strFechaHoy + '</h6>';
					document.querySelector('#estatusTicket').value = objData.data.Id_Estatus_del_Ticket;

					//Asignamos el Id del ticket a los diferentes formularios
					document.querySelector("#idTicket").value = objData.data.Id;
					document.querySelector('#idTicketNota').value = objData.data.Id;
					document.querySelector('#idTicketSeguimiento_terminar').value = objData.data.Id;
					document.querySelector('#idTicketSeguimiento_rechazar').value = objData.data.Id;
					document.querySelector('#idTicketSeguimiento_asignar').value = objData.data.Id;

					//Asignamos Id para seguimiento
					document.querySelector('#idFuncionarioSeguimiento_terminar').value = objData.data.Id_Funcionario_Asignado;
					document.querySelector('#idFuncionarioSeguimiento_rechazar').value = objData.data.Id_Funcionario_Asignado;
					document.querySelector('#idFuncionarioSeguimiento_asignar').value = objData.data.Id_Funcionario_Asignado;
					document.querySelector('#idDependenciaAsignadaSeguimiento_asignar').value = objData.data.Id_Dependencia_Asignada;

					ciudadano = objData.data.Ciudadano;
					telefono = 'Tel. ' + objData.data.Teleefono;
					calle_NumEx = objData.data.Calle + ' ' + objData.data.Nuumero_Exterior;
					numeroInterior = '# interior: '+ objData.data.Nuumero_Interior;
					colonia = objData.data.Colonia;
					codigoPostal = 'Edo. de México C.P. ' + objData.data.Codigo_Postal;

					document.querySelector('#idCiudadanoUR').value = objData.data.Id_Ciudadano;
					document.querySelector("#celNombreVR").innerHTML = objData.data.Ciudadano;
					document.querySelector("#celTipoContactoVR").innerHTML = tipoContacto;
					document.querySelector("#celTelefonoVR").innerHTML = telefono;
					document.querySelector("#celCalleVR").innerHTML = calle_NumEx;
					document.querySelector("#NumDomVR").innerHTML = numeroInterior;	
					document.querySelector("#ColoniaVR").innerHTML = colonia;
					document.querySelector("#celCodigoPostalVR").innerHTML = codigoPostal;
					document.querySelector("#celFuncionarioAsignadoVR").innerHTML = objData.data.Funcionario_Asignado;
					document.querySelector("#celDependenciaVR").innerHTML = objData.data.Dependencia_Asignada;
					document.querySelector("#celEstatusVR").innerHTML = estatusTicket;

					document.querySelector('#listTramitesServicios').value = objData.data.Id_Tramites_y_Servicios;
					document.querySelector('#txtDetalleReporte').value = objData.data.Detalle_del_Reporte;
					document.querySelector('#txtNumSolicitudes').value = objData.data.Nuumero_de_Reparaciones_Solicitadas;
					document.querySelector('#listColonia').value = objData.data.Id_Coodigo_Postal;
					document.querySelector('#listCalle').value = objData.data.Id_Calle;
					document.querySelector('#listCalle1').value = objData.data.Id_Entre_Calle_1;
					document.querySelector('#listCalle2').value = objData.data.Id_Entre_Calle_2;
					document.querySelector('#txtNumeroExteriorTicket').value = objData.data.Nuumero_Exterior;
					document.querySelector('#txtNumeroInteriorTicket').value = objData.data.Nuumero_Interior;
					document.querySelector('#lblFuncionarioInserto').innerHTML = '<strong>Funcionario que inserto</strong><br>' + objData.data.Funcionario_quien_Recibio + '<br>' + objData.data.Dependencia_inserto + '<br>' + objData.data.AreaInserto;
					document.querySelector("#celMapaVR").innerHTML = mapa;

					document.getElementById("DatosReportePest").click();
					$('#listTramitesServicios').selectpicker('render');
					$('#listColonia').selectpicker('render');
					$('#listCalle').selectpicker('render');
					$('#listCalle1').selectpicker('render');
					$('#listCalle2').selectpicker('render');
					$('#modalBandejaReportes').modal("hide");
					$('#modalDetallesReporte').modal("show");		
				}else{
					fntInfoTicket(id_ticket);
					$('#modalBandejaReportes').modal("hide");
					$('#modalDetallesReporte').modal("show");
				}
				divLoading.style.display = "none";
			}
		}
	}
	
}

//Valida el estatus del ticket para mostrar u ocultar el boton guardar
function fntValidaEstatus(estatusVR, origen){
	if(estatusVR > 0)
	{
		var btnGuradarVR = document.querySelector('#btnGuardarVR');
		if(origen == 1)
		{
			if(estatusVR == 1 || estatusVR == 3 || estatusVR == 4 || estatusVR == 9){
				btnGuradarVR.style.display = "none";
			}else{
				btnGuradarVR.style.display = "";
			}
		}else{
			if(estatusVR != 1){
				btnGuradarVR.style.display = "none";
			}else{
				btnGuradarVR.style.display = "";	
			}
		}
	}
}

function fntCargaNotas(id_ticket){
	if(id_ticket > 0)
	{
		let idticket = id_ticket;
		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/getNotas/'+idticket;
		request.open("GET",ajaxUrl,true);
		request.send();

		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				var objData = JSON.parse(request.responseText);

				if(objData.status)
				{
					var ajaxUrl = ' ' + base_url+'/ReporteCiudadano/getNotas/'+idticket;
					fntCrearTablaNotas(ajaxUrl);
				}else{
					var tabla = $('#tablaNotas').DataTable();
					tabla
						.clear()
						.draw();
					divLoading.style.display = "none";
					return false;
					}
			}
		}
	}
}

function fntCargaHistorial(id_ticket){
	if(id_ticket > 0)
	{
		let idticket = id_ticket;
		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/getHistorial/'+idticket;
		request.open("GET",ajaxUrl,true);
		request.send();

		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				var objData = JSON.parse(request.responseText);

				if(objData.status)
				{
					var ajaxUrl = ' ' + base_url+'/ReporteCiudadano/getHistorial/'+idticket;
					fntCrearTablaHistorial(ajaxUrl);
				}else{
					var tabla = $('#tableHistorial').DataTable();
					tabla
						.clear()
						.draw();
					divLoading.style.display = "none";
					return false;
					}
			}
		}
	}
}

//**************funciones para crear tablas*************

function fntCrearTablaNotas(ajaxurl){
	var ajaxUrl = ajaxurl;
	tableNotas = $('#tablaNotas').DataTable( {
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax": ajaxUrl
		,
		"columns":[
			{"data":"Nota", "width": "60%"},
			{"data":"Funcionario", "width": "20%"},
			{"data":"Fecha", "width": "10%"},
			{"data":"options", "width": "10%"}
		],
		"resonsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order":[[2,"desc"]]
	} );
}

function fntCrearTablaHistorial(ajaxurl){
	var ajaxUrl = ajaxurl;
	tableHistorial = $('#tableHistorial').DataTable( {
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax": ajaxUrl
		,
		"columns":[
			{"data":"Fecha", "width": "10%"},
			{"data":"Funcionario_quien_Asigna", "width": "15%"},
			{"data":"Funcionario_Asignado", "width": "15%"},
			{"data":"Seguimiento", "width": "30%"},
			{"data":"Estatus_del_Ticket", "width": "10%"},
			{"data":"Tipo_de_rechazo", "width": "10%"},
			{"data":"Oficio Respuesta", "width": "10%"}
		],
		"resonsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order":[[0,"desc"]]
	} );
}

function fntCrearTablaReportesRegistrados(ajaxurl){
	var ajaxUrl = ajaxurl;
	tableReportesRegistrado = $('#tableReportesRegistrados').DataTable( {
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax": ajaxUrl,

		"dataSrc":""
		,
		"columns":[
			{"data":"Id", "width": "10%"},
			{"data":"Fecha", "width": "10%"},
			{"data":"Estatus_del_Ticket", "width": "10%"},
			{"data":"Tramites_y_Servicios", "width": "25%"},
			{"data":"Area_Asignada", "width": "20%"},
			{"data":"Fecha_de_Modificacioon", "width": "10%"},
			{"data":"options", "width": "10%"}
		],
		"resonsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order":[[1,"desc"]]
	} );
}

//************Funciones para cargar selects*******

function fntTramitesServicios(){
	var ajaxUrl = base_url+'/TramitesServicios/getSelectTramitesServicios';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listTramitesServicios').innerHTML = request.responseText;
			$('#listTramitesServicios').selectpicker('render');
		}
	}
}

function fntMotivoRechazo(){
	var ajaxUrl = base_url+'/ReporteCiudadano/getSelectMotivoRechazo';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listMotivoRechazo').innerHTML = request.responseText;
			$('#listMotivoRechazo').selectpicker('render');
		}
	}
}

function fntTipoContacto(){
	var ajaxUrl = base_url+'/TipoContacto/getSelectTipoContacto';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listTipoContactoEdit').innerHTML = request.responseText;
			$('#listTipoContactoEdit').selectpicker('render');
		}
	}
}

function fntColonias(){
	var ajaxUrl = base_url+'/Colonias/getSelectColonias';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listColoniaEdit').innerHTML = request.responseText;
			$('#listColoniaEdit').selectpicker('render');
			document.querySelector('#listColonia').innerHTML = request.responseText;
			$('#listColonia').selectpicker('render');
		}
	}

}

function fntCalles(){
	var ajaxUrl = base_url+'/Calles/getSelectCalles';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listCalleEdit').innerHTML = request.responseText;
			document.querySelector('#listCalle1Edit').innerHTML = request.responseText;
			document.querySelector('#listCalle2Edit').innerHTML = request.responseText;
			document.querySelector('#listCalle').innerHTML = request.responseText;
			document.querySelector('#listCalle1').innerHTML = request.responseText;
			document.querySelector('#listCalle2').innerHTML = request.responseText;
			$('#listCalleEdit').selectpicker('render');
			$('#listCalle1Edit').selectpicker('render');
			$('#listCalle2Edit').selectpicker('render');
			$('#listCalle').selectpicker('render');
			$('#listCalle1').selectpicker('render');
			$('#listCalle2').selectpicker('render');
		}
	}
}

function fntCallePorColoniaEdit(id_colonia){
	var idcol = id_colonia;
	var ajaxUrl = base_url+'/Calles/getSelectCallePorColonia/'+idcol;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listCalleEdit').innerHTML = request.responseText;
			document.querySelector('#listCalle1Edit').innerHTML = request.responseText;
			document.querySelector('#listCalle2Edit').innerHTML = request.responseText;
			document.querySelector('#listCalle').innerHTML = request.responseText;
			document.querySelector('#listCalle1').innerHTML = request.responseText;
			document.querySelector('#listCalle2').innerHTML = request.responseText;
			$('#listCalleEdit').selectpicker('refresh');
			$('#listCalleEdit').selectpicker('render');
			$('#listCalle1Edit').selectpicker('refresh');
			$('#listCalle1Edit').selectpicker('render');
			$('#listCalle2Edit').selectpicker('refresh');
			$('#listCalle2Edit').selectpicker('render');
			$('#listCalle').selectpicker('refresh');
			$('#listCalle').selectpicker('render');
			$('#listCalle1').selectpicker('refresh');
			$('#listCalle1').selectpicker('render');
			$('#listCalle2').selectpicker('refresh');
			$('#listCalle2').selectpicker('render');
		}
	}
}

function fntAreaPorDependencia(id_dependencia){
	var iddependencia = id_dependencia;
	var ajaxUrl = base_url+'/Areas/getSelectAreaPorDependencia/'+iddependencia;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listAreaSeguimiento').innerHTML = request.responseText;
			$('#listAreaSeguimiento').selectpicker('refresh');
			$('#listAreaSeguimiento').selectpicker('render');
		}
	}
}

function fntEnlacePorDependencia(id_dependencia){
	var iddependencia = id_dependencia;
	var ajaxUrl = base_url+'/Areas/getSelectEnlacePorDependencia/'+iddependencia;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listEnlaceSeguimiento').innerHTML = request.responseText;
			$('#listEnlaceSeguimiento').selectpicker('refresh');
			$('#listEnlaceSeguimiento').selectpicker('render');
		}
	}
}

function fntEstatusTicket(){
	var ajaxUrl = base_url+'/EstatusTicket/getSelectEstatusTicket';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listEstatusTicket_Busqueda').innerHTML = request.responseText;
			$('#listEstatusTicket_Busqueda').selectpicker('render');
		}
	}
}

//Carga las calles dependiendo de la colonia
$(document).ready(function(){

	$('#listColoniaEdit').change(function(){
		var idcol = $(this).val();
		fntCallePorColoniaEdit(idcol);
	});

	$('#listColonia').change(function(){
		var idcol = $(this).val();
		fntCallePorColoniaEdit(idcol);
	});
});

//Load de la pagina
window.addEventListener('load',function(){
	fntEstatusTicket();
	fntMotivoRechazo();
	fntTramitesServicios();
	fntTipoContacto();
	fntColonias();
	fntCalles();
},false);