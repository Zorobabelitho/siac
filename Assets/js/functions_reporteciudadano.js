var tableReporteCiudadano;
var tableReportesRegistrado;
var tableNotas;
var tableHistorial;
var divLoading = document.querySelector('#divLoading');

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

document.addEventListener('DOMContentLoaded', function(){

	var formVerReporteCiudadano = document.querySelector('#formVerReporteCiudadano');
	var formReporteCiudadano = document.querySelector('#formReporteCiudadano');
	var formBusquedaTicket = document.querySelector('#formBusquedaTicket');
	var formAgregarCiudadano = document.querySelector('#formAgregarCiudadano');
	var formDatosCiudadano = document.querySelector('#formDatosCiudadano');
	var formNotas = document.querySelector('#formNotas');

	//Seguimiento
	var formSeguimiento_Terminar = document.querySelector('#formSeguimiento_Terminar');
	var formSeguimiento_Rechazar = document.querySelector('#formSeguimiento_Rechazar');
	var formSeguimiento_Asignar = document.querySelector('#formSeguimiento_Asignar');

	formSeguimiento_Asignar.onsubmit = function(e) {
		e.preventDefault();

		var intIdArea = document.querySelector('#listAreaSeguimiento').value;
		var intEnlace = document.querySelector('#listEnlaceSeguimiento').value;
		var strNotaSeguimiento_Asignar = document.querySelector('#txtNotaSeguimiento_asignar').value;

		if(intIdArea == '' || intEnlace == '' || strNotaSeguimiento_Asignar == '')
		{
			swal("Atención", "Todos los campos son obligatorios." , "error");
			return false;	
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/setSeguimiento/' + 3;
		var formData = new FormData(formSeguimiento_Rechazar);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					formSeguimiento_Rechazar.reset();
 					swal("Reporte ciudadano", objData.msg , "success");
 				}else{
 					swal("Error", objData.msg , "error");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;
	}

	formSeguimiento_Rechazar.onsubmit = function(e) {
		e.preventDefault();

		var intIdMotivoRechazo = document.querySelector('#listMotivoRechazo').value;
		var strNotaSeguimiento_Rechazar = document.querySelector('#txtNotaSeguimiento_rechazar').value;

		if(intIdMotivoRechazo == '' || strNotaSeguimiento_Rechazar == '')
		{
			swal("Atención", "Todos los campos son obligatorios." , "error");
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/setSeguimiento/' + 2;
		var formData = new FormData(formSeguimiento_Rechazar);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					formSeguimiento_Rechazar.reset();
 					swal("Reporte ciudadano", objData.msg , "success");
 				}else{
 					swal("Error", objData.msg , "error");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;
	}

	formSeguimiento_Terminar.onsubmit = function(e) {
		e.preventDefault();

		var strNotaSeguimiento = document.querySelector('#txtNotaSeguimiento_terminar').value;

		if(strNotaSeguimiento == '')
		{
			swal("Atención", "Ingresa la nota para terminar el reporte." , "error");
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/setSeguimiento/' + 1;
		var formData = new FormData(formSeguimiento_Terminar);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					formSeguimiento_Terminar.reset();
 					swal("Reporte ciudadano", objData.msg , "success");
 				}else{
 					swal("Error", objData.msg , "error");
 				}
 			}
 			divLoading.style.display = "none";
 		}
        return false;

	}

	formBusquedaTicket.onsubmit = function(e) {
		e.preventDefault();
	}

	formVerReporteCiudadano.onsubmit = function (e) {
		e.preventDefault();
	}

	//Nueva nota
	formNotas.onsubmit = function (e) {
		e.preventDefault();

		var strNota = document.querySelector('#txtNota').value;
		var strDocumento = document.querySelector('#fileNota').value;
		var intIdTicket = document.querySelector('#idTicketNota').value;

		if(strNota == '')
		{
			return false;
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/setNota';
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
 					fntCargaNotas(intIdTicket);
 				}else{
 					swal("Error", objData.msg , "error");
 				}
 			}
 			divLoading.style.display = "none";
            return false;
 		}

	}

	//Nuevo reporte del ciudadano
	formReporteCiudadano.onsubmit = function (e) {
		e.preventDefault();
		
		var id_ciudadano = document.querySelector('#id_ciudadanoRN').value;
		var intTramiteServicio = document.querySelector('#listTramitesServicios').value;
		var strDetalleReporte = document.querySelector('#txtDetalleReporte').value;
		var intNumeroReparaciones = document.querySelector('#txtNumSolicitudesReporteNuevo').value;
		var intIdColonia = document.querySelector('#listColoniaReporteNuevo').value;
		var intIdCalle = document.querySelector('#listCalleReporteNuevo').value;
		var strNumExterior = document.querySelector('#txtNumExteriorReporteNuevo').value;
		var intIdEntreCalle1 = document.querySelector('#listCalle1ReporteNuevo').value;
		var intIdEntreCalle2 = document.querySelector('#listCalle2ReporteNuevo').value;
		let resp = 0;

		if(id_ciudadano == '' || intTramiteServicio == '' || strDetalleReporte == '' || intNumeroReparaciones == '' || intIdColonia == '' || intIdCalle == '' || strNumExterior == '' || intIdEntreCalle1 == '' || intIdEntreCalle2 == ''){
			swal("Atención", "Todos los campos son obligatorios." , "error");
			return false;
		}

		let elementValid = document.getElementsByClassName("valid");
		for (let i = 0; i < elementValid.length; i++) {
			if(elementValid[i].classList.contains('is-invalid')) {
				swal("Atención", "Verifique los campos en rojo." , "error");
				return false;
			}
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/getvalTramSer/'+id_ciudadano+'/'+intIdCalle+'/'+intTramiteServicio;
		var formData = new FormData();
		request.open("GET",ajaxUrl,true);
		request.send();

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status){
 					if(objData.msg == 'noexiste_Params')
 					{
 						swal("Error", objData.msg , "error");
 					}else{
 						//Guardar nuevo reporte
	 					divLoading.style.display = "flex";
						var request_NR = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
						var ajaxUrl_NR = base_url+'/ReporteCiudadano/setReporte';
						var formData_NR = new FormData(formReporteCiudadano);
						request_NR.open("POST",ajaxUrl_NR,true);
						request_NR.send(formData_NR);

						request_NR.onreadystatechange = function(){
				 			if(request_NR.readyState == 4 && request_NR.status == 200){
				 				var objData_RN = JSON.parse(request_NR.responseText);
				 				if(objData_RN.status){
				 					swal("Atención", objData_RN.msg , "success");
				 					let respuesta = objData_RN.ticket;
				 					fntInfoReporte(respuesta);
				 				}else{
				 					swal("Error", objData_RN.msg , "error");
				 				}
				 			}
				 		}
 					}
 				}else{
 					//Si existe el reporte creamos pregunta de confirmación
 					swal({
						title: "¡Atención!",
						text: "El reporte que intenta crear tiene una coincidencia con un reporte anterior del ciudadano. ¿Desea ver el reporte?",
						type: "info",
						showCancelButton: true,
						confirmButtonText: "Si, abrir reporte",
						cancelButtonText: "No, crear nuevo reporte",
						closeOnConfirm: true,
						closeOnCancel: false
					
					}, function(isConfirm){
						if(isConfirm){
							//Abrir datos de reporte
							resp = objData.data.Id_Ticket;
							fntInfoReporte(resp);
						}else{
							//Guardar nuevo reporte
		 					divLoading.style.display = "flex";
							var request_NR = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
							var ajaxUrl_NR = base_url+'/ReporteCiudadano/setReporte';
							var formData_NR = new FormData(formReporteCiudadano);
							request_NR.open("POST",ajaxUrl_NR,true);
							request_NR.send(formData_NR);

							request_NR.onreadystatechange = function(){
					 			if(request_NR.readyState == 4 && request_NR.status == 200){
					 				var objData_RN = JSON.parse(request_NR.responseText);
					 				if(objData_RN.status){
					 					swal("Atención", objData_RN.msg , "success");
					 					let respuesta = objData_RN.ticket;
					 					fntInfoReporte(respuesta);
					 				}else{
					 					swal("Error", objData_RN.msg , "error");
					 				}
					 			}
					 		}
						}
					});
 				}
 			}
 		}
 		divLoading.style.display = "none";
 		return false;
			
	}

	formAgregarCiudadano.onsubmit = function(e) {
		e.preventDefault();

		var strNombre = document.querySelector('#txtNombre').value;
		var strApellidoPaterno = document.querySelector('#txtApePaterno').value;
		var intIdTipoContacto = document.querySelector('#listTipoContacto').value;
		var strTelefono = document.querySelector('#txtTelefono').value;
		var intIdColonia = document.querySelector('#listColonia').value;
		var intIdCalle = document.querySelector('#listCalle').value;
		var strNumExterior = document.querySelector('#txtNumExterior').value;
		var intIdEntreCalle1 = document.querySelector('#listCalle1').value;
		var intIdEntreCalle2 = document.querySelector('#listCalle2').value; 

		if(strNombre == '' || strApellidoPaterno == '' || intIdTipoContacto == '' || strTelefono == '' || intIdColonia == '' || intIdCalle == '' || strNumExterior == '' || intIdEntreCalle1 == '' || intIdEntreCalle2 == '')
		{
			swal("Atención", "Todos los campos son obligatorios." , "error");
			return false;
		}

		let elementValid = document.getElementsByClassName("valid");
		for (let i = 0; i < elementValid.length; i++) {
			if(elementValid[i].classList.contains('is-invalid')) {
				swal("Atención", "Verifique los campos en rojo." , "error");
				return false;
			}
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/Ciudadano/setCiudadano';
		var formData = new FormData(formAgregarCiudadano);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					formAgregarCiudadano.reset();
 					swal("Ciudadano", objData.msg , "success");
 				}else{
 					swal("Advertencia", objData.msg , "warning");
 				}
 			}
 			divLoading.style.display = "none";
            return false;
 		}
	}

	formDatosCiudadano.onsubmit = function(e) {
		e.preventDefault();

		var strNombre = document.querySelector('#txtNombreEdit').value;
		var strApellidoPaterno = document.querySelector('#txtApePaternoEdit').value;
		var intIdTipoContacto = document.querySelector('#listTipoContactoEdit').value;
		var strTelefono = document.querySelector('#txtTelefonoEdit').value;
		var intIdColonia = document.querySelector('#listColoniaEdit').value;
		var intIdCalle = document.querySelector('#listCalleEdit').value;
		var strNumExterior = document.querySelector('#txtNumExteriorEdit').value;
		var intIdEntreCalle1 = document.querySelector('#listCalle1Edit').value;
		var intIdEntreCalle2 = document.querySelector('#listCalle2Edit').value; 

		if(strNombre == '' || strApellidoPaterno == '' || intIdTipoContacto == '' || strTelefono == '' || intIdColonia == '' || intIdCalle == '' || strNumExterior == '' || intIdEntreCalle1 == '' || intIdEntreCalle2 == '')
		{
			swal("Atención", "Todos los campos son obligatorios." , "error");
			return false;
		}

		let elementValid = document.getElementsByClassName("valid");
		for (let i = 0; i < elementValid.length; i++) {
			if(elementValid[i].classList.contains('is-invalid')) {
				swal("Atención", "Verifique los campos en rojo." , "error");
				return false;
			}
		}

		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/Ciudadano/setCiudadano';
		var formData = new FormData(formDatosCiudadano);
		request.open("POST",ajaxUrl,true);
		request.send(formData);

		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					fntBusqueda();
 					swal("Ciudadano", objData.msg , "success");
 				}else{
 					swal("Advertencia", objData.msg , "warning");
 				}
 			}
 			divLoading.style.display = "none";
            return false;
 		}

	}

}, false);

//Busca por telefono o nombre al ciudadano
function fntBusqueda(){
	var strBusqueda = document.querySelector('#txtBusqueda').value;
	var ajaxUrl = '';
	
	if(strBusqueda == '')
	{
		return false;
	}

	if(!testEntero(strBusqueda)){
		if(!testTex(strBusqueda)){
			swal("Búsqueda no valida", "No utilices números y letras juntas, ni caracteres especiales.", "error");
			return false;
		}else{
			if(strBusqueda.length <= 3)
			{
				swal("Atención", "Ingresa un nombre valido para realizar la búsqueda" , "error");
				return false;
			}
			//Búsqueda por nombre
			divLoading.style.display = "flex";
			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url+'/Ciudadano/getSelectCiudadanoPorNombre/'+strBusqueda; 
		    request.open("GET",ajaxUrl,true);
			request.send();
			
			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					var objData = JSON.parse(request.responseText);
					if(objData.status){
						var ajaxUrl = ' '+base_url+'/Ciudadano/getSelectCiudadanoPorNombre/'+strBusqueda;
						fntCrearTablaBusqueda(ajaxUrl);
					}else{
						swal("Atención", objData.msg , "error");
						return false;
					}
				}
				divLoading.style.display = "none";
			}
		}
	}else{
		if(strBusqueda.length < 8)
		{
			swal("Atención", "El teléfono debe contener como mínimo 8 caracteres" , "error");
			return false;
		}
		//Búsqueda por teléfono
		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/Ciudadano/getselectCiudadanoPorTelefono/'+strBusqueda; 
	    request.open("GET",ajaxUrl,true);
		request.send();
		
		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				var objData = JSON.parse(request.responseText);
				if(objData.status){
					var ajaxUrl = ' '+base_url+'/Ciudadano/getselectCiudadanoPorTelefono/'+strBusqueda;
					fntCrearTablaBusqueda(ajaxUrl);
				}else{
					swal("Atención", objData.msg , "error");
					return false;
				}
			}
			divLoading.style.display = "none";
		}
	}
}

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

				//Datos ciudadano reporte nuevo
				document.querySelector("#id_ciudadanoRN").value = objData.data.Id;
				document.querySelector('#TelefonoRN').value = objData.data.Teleefono;
				document.querySelector("#celNombreRN").innerHTML = ciudadano;
				document.querySelector("#celTipoContactoRN").innerHTML = tipoContacto;
				document.querySelector("#celTelefonoRN").innerHTML = telefono;
				document.querySelector("#celCalleRN").innerHTML = calle_NumEx;
				document.querySelector("#NumDomRN").innerHTML = numeroInterior;
				document.querySelector("#ColoniaRN").innerHTML = colonia;
				document.querySelector("#celCodigoPostalRN").innerHTML = codigoPostal;
				document.querySelector("#celMapaRN").innerHTML = mapa;
				document.querySelector("#listColoniaReporteNuevo").value = objData.data.Id_colonia;
				document.querySelector("#listCalleReporteNuevo").value = objData.data.Id_Calle;
				document.querySelector("#txtNumExteriorReporteNuevo").value = objData.data.Nuumero_Exterior;
				document.querySelector("#txtNumInteriorReporteNuevo").value = objData.data.Nuumero_Interior;
				document.querySelector("#listCalle1ReporteNuevo").value = objData.data.Id_Entre_Calle_1;
				document.querySelector("#listCalle2ReporteNuevo").value = objData.data.Id_Entre_Calle_2;
				document.querySelector("#txtReferenciasReporteNuevo").value = objData.data.Referencias;



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

				$('#listColoniaReporteNuevo').selectpicker('render');
				$('#listCalleReporteNuevo').selectpicker('render');
				$('#listCalle1ReporteNuevo').selectpicker('render');
				$('#listCalle2ReporteNuevo').selectpicker('render');

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
					var estatusTicket = '';
					if(objData.data.Id_Estatus_del_Ticket == 1) estatusTicket = '<span class="badge badge-danger">Rechazado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 2) estatusTicket = '<span class="badge badge-success">Asignado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 3) estatusTicket = '<span class="badge badge-danger">Cerrado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 4) estatusTicket = '<span class="badge badge-danger">Cancelado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 6) estatusTicket = '<span class="badge badge-success">Atendido</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 7) estatusTicket = '<span class="badge badge-warning">Reasignado</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 8) estatusTicket = '<span class="badge badge-primary">Nuevo</span>';
					else if (objData.data.Id_Estatus_del_Ticket == 9) estatusTicket = '<span class="badge badge-success">Terminado</span>';
					
					fntValidaEstatus(objData.data.Numero_de_Ticket, 1);
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

					document.querySelector('#idCiudadanoVR').value = objData.data.Id_Ciudadano;
					document.querySelector("#celNombreVR").innerHTML = ciudadano;
					document.querySelector("#celTipoContactoVR").innerHTML = tipoContacto;
					document.querySelector("#celTelefonoVR").innerHTML = telefono;
					document.querySelector("#celCalleVR").innerHTML = calle_NumEx;
					document.querySelector("#NumDomVR").innerHTML = numeroInterior;	
					document.querySelector("#ColoniaVR").innerHTML = colonia;
					document.querySelector("#celCodigoPostalVR").innerHTML = codigoPostal;
					document.querySelector("#celFuncionarioAsignadoVR").innerHTML = objData.data.Funcionario_Asignado;
					document.querySelector("#celDependenciaVR").innerHTML = objData.data.Dependencia_Asignada;
					document.querySelector("#celEstatusVR").innerHTML = estatusTicket;

					document.querySelector('#listTramitesServiciosVR').value = objData.data.Id_Tramites_y_Servicios;
					document.querySelector('#txtDetalleReporteVR').value = objData.data.Detalle_del_Reporte;
					document.querySelector('#txtNumSolicitudesVR').value = objData.data.Nuumero_de_Reparaciones_Solicitadas;
					document.querySelector('#txtColoniaTicket').value = objData.data.Colonia;
					document.querySelector('#txtCalleTicket').value = objData.data.Calle;
					document.querySelector('#txtNumeroExteriorTicket').value = objData.data.Nuumero_Exterior;
					document.querySelector('#txtNumeroInteriorTicket').value = objData.data.Nuumero_Interior;
					document.querySelector('#txtCalle1Ticket').value = objData.data.Entre_calle_1;
					document.querySelector('#txtCalle2Ticket').value = objData.data.Entre_Calle_2;
					document.querySelector('#lblFuncionarioInserto').innerHTML = '<strong>Funcionario que inserto</strong><br>' + objData.data.Funcionario_quien_Recibio + '<br>' + objData.data.Dependencia_inserto + '<br>' + objData.data.AreaInserto;
					document.querySelector("#celMapaVR").innerHTML = mapa;



					$('#listTramitesServiciosVR').selectpicker('render');
					$('#modalVerCiudadano').modal("hide");
					$('#modalDetallesReporte').modal("show");			
				}else{
					fntInfoTicket(id_ticket);
					$('#modalVerCiudadano').modal("hide");
					$('#modalDetallesReporte').modal("show");
				}
				divLoading.style.display = "none";
			}
		}
	}
	
}

function fntInfoTicket(id_ticket){
	if(id_ticket > 0)
	{
		var id_ticket = id_ticket;
		divLoading.style.display = "flex";
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/ReporteCiudadano/getDetallesTicket/'+id_ticket;
		request.open("GET",ajaxUrl,true);
		request.send();
		request.onreadystatechange = function(){
			if(request.readyState == 4 && request.status == 200){
				var objData = JSON.parse(request.responseText);

				if(objData.status)
				{
					var estatusTicket = objData.data.Estatus_del_Registro == 1 ?
						'<span class="badge badge-success">Asignado</span>':
						'<span class="badge badge-danger">Cerrado</span>';
					
					let NumTicket = objData.data.Id_Ticket;
					fntValidaEstatus(objData.data.Numero_de_Ticket, 2);
					fntCargaNotas(NumTicket);

					document.querySelector('#NumeroTicket').innerHTML = '<h5 class="modal-title">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#NumeroTicketNotas').innerHTML = '<h5 class="modal-title">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#NumeroTicketSeguimiento').innerHTML = '<h5 class="modal-title">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#NumeroTickethistorial').innerHTML = '<h5 class="mb-3 line-head">Reporte: ' + objData.data.Numero_de_Ticket + '</h5>';
					document.querySelector('#estatusTicket').value = objData.data.Estatus_del_Registro;
					document.querySelector("#idTicket").value = objData.data.Id_Ticket;
					document.querySelector('#idTicketNota').value = objData.data.Id;
					document.querySelector('#idCiudadanoVR').value = objData.data.Id_Ciudadano;
					document.querySelector("#celNombreVR").innerHTML = ciudadano;
					document.querySelector("#celTipoContactoVR").innerHTML = tipoContacto;
					document.querySelector("#celTelefonoVR").innerHTML = 'Tel. ' + telefono;
					document.querySelector("#celCalleVR").innerHTML = calle +' '+ numeroExterior;
					if(objData.data.Nuumero_Interior != ''){
						document.querySelector("#NumDomVR").innerHTML = '# interior '+ numeroInterior;	
					}
					document.querySelector("#ColoniaVR").innerHTML = colonia;
					document.querySelector("#celCodigoPostalVR").innerHTML = 'Edo. de México C.P. ' + codigoPostal;
					document.querySelector("#celFuncionarioAsignadoVR").innerHTML = objData.data.Funcionario;
					document.querySelector("#celDependenciaVR").innerHTML = objData.data.Dependencia;
					document.querySelector("#celEstatusVR").innerHTML = estatusTicket;

					document.querySelector('#listTramitesServiciosVR').value = objData.data.Id_Tramites_y_Servicios;
					document.querySelector('#txtDetalleReporteVR').value = objData.data.Detalle_del_Reporte;
					document.querySelector('#txtNumSolicitudesVR').value = objData.data.Nuumero_de_Reparaciones_Solicitadas;
					document.querySelector('#txtColoniaTicket').value = objData.data.Colonia;
					document.querySelector('#txtCalleTicket').value = objData.data.Calle;
					document.querySelector('#txtNumeroExteriorTicket').value = objData.data.Nuumero_Exterior;
					document.querySelector('#txtNumeroInteriorTicket').value = objData.data.Nuumero_Interior;
					document.querySelector('#txtCalle1Ticket').value = objData.data.Entre_Calle_1;
					document.querySelector('#txtCalle2Ticket').value = objData.data.Entre_Calle_2;
					document.querySelector('#lblFuncionarioInserto').innerHTML = '<strong>Funcionario que inserto</strong><br>' + objData.data.Funcionario_que_Insertoo + '<br>' + objData.data.Dependencia + '<br>' + objData.data.Area;

					if(calle != '' && numeroExterior != '' && colonia != '' && codigoPostal != '')
					{
						strMapa = calle + ' ' + numeroExterior + ' ' + colonia + ' Tlalnepantla de Baz Estado de México ' + codigoPostal;
						document.querySelector("#celMapaVR").innerHTML = '<br><div class="text-center"><a class="btn btn-warning btn-sm" href="https://www.google.com/maps/preview#!q='+strMapa+'" target="_blank"><i class="fas fa-map-marker-alt"></i><span> ver ubicación</span></a></div>';
					}

					$('#listTramitesServiciosVR').selectpicker('render');
					$('#modalVerCiudadano').modal("hide");
					$('#modalDetallesReporte').modal("show");			
				}else{
					swal("Error", objData.msg , "error");
				}
				divLoading.style.display = "none";
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

function fntAbrirDocumento(nameDoc){
	var Url = 'http://localhost/SIAC/Assets/files/ArchivosNotas/';
	window.open(Url+nameDoc, "Documento - SIAC", "width=100%, height=100%" );
}

//Creacion de datatables
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

function fntCrearTablaBusqueda(ajaxurl){
	var ajaxUrl = ajaxurl;
	tableReporteCiudadano = $('#tableReporteCiudadano').DataTable( {
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax": ajaxUrl
		,
		"columns":[
			{"data":"Id", "width": "10%"},
			{"data":"Ciudadano", "width": "30%"},
			{"data":"Colonia", "width": "25%"},
			{"data":"Teleefono", "width": "10%"},
			{"data":"options", "width": "15%"}
		],
		"resonsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order":[[1,"asc"]]
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

//***************Acciones**********

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

//Regresa al modal del ciudadano
function fntAtras(){
	$('#modalDetallesReporte').modal("hide");
	$('#modalVerCiudadano').modal("show");
	
}

//Muestra el modal
function openModal(){
	$('#modalFormReporteCiudadano').modal('show');
}

//Limpia form Nuevo Ciudadano
function limpiarFormNuevoCiudadano(){
	formAgregarCiudadano.reset();
}

//Load de la pagina
window.addEventListener('load',function(){
	fntMotivoRechazo();
	fntTramitesServicios();
	fntTipoContacto();
	fntColonias();
	fntCalles();
}, false);

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
			document.querySelector('#listTramitesServiciosVR').innerHTML = request.responseText;
			$('#listTramitesServiciosVR').selectpicker('render');
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
			document.querySelector('#listTipoContacto').innerHTML = request.responseText;
			$('#listTipoContacto').selectpicker('render');

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
			document.querySelector('#listColonia').innerHTML = request.responseText;
			$('#listColonia').selectpicker('render');

			document.querySelector('#listColoniaEdit').innerHTML = request.responseText;
			$('#listColoniaEdit').selectpicker('render');

			document.querySelector('#listColoniaReporteNuevo').innerHTML = request.responseText;
			$('#listColoniaReporteNuevo').selectpicker('render');
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
			document.querySelector('#listCalleReporteNuevo').innerHTML = request.responseText;
			document.querySelector('#listCalle1ReporteNuevo').innerHTML = request.responseText;
			document.querySelector('#listCalle2ReporteNuevo').innerHTML = request.responseText;
			$('#listCalleEdit').selectpicker('render');
			$('#listCalle1Edit').selectpicker('render');
			$('#listCalle2Edit').selectpicker('render');
			$('#listCalleReporteNuevo').selectpicker('render');
			$('#listCalle1ReporteNuevo').selectpicker('render');
			$('#listCalle2ReporteNuevo').selectpicker('render');
		}
	}
}

function fntCallePorColonia(id_colonia){
	var idcol = id_colonia;
	var ajaxUrl = base_url+'/Calles/getSelectCallePorColonia/'+idcol;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listCalle').innerHTML = request.responseText;
			document.querySelector('#listCalle1').innerHTML = request.responseText;
			document.querySelector('#listCalle2').innerHTML = request.responseText;
			$('#listCalle').selectpicker('refresh');
			$('#listCalle').selectpicker('render');
			$('#listCalle1').selectpicker('refresh');
			$('#listCalle1').selectpicker('render');
			$('#listCalle2').selectpicker('refresh');
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
			$('#listCalleEdit').selectpicker('refresh');
			$('#listCalleEdit').selectpicker('render');
			$('#listCalle1Edit').selectpicker('refresh');
			$('#listCalle1Edit').selectpicker('render');
			$('#listCalle2Edit').selectpicker('refresh');
			$('#listCalle2Edit').selectpicker('render');
		}
	}
}

function fntCallePorColoniaReportenuevo(id_colonia){
	var idcol = id_colonia;
	var ajaxUrl = base_url+'/Calles/getSelectCallePorColonia/'+idcol;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listCalleReporteNuevo').innerHTML = request.responseText;
			document.querySelector('#listCalle1ReporteNuevo').innerHTML = request.responseText;
			document.querySelector('#listCalle2ReporteNuevo').innerHTML = request.responseText;
			$('#listCalleReporteNuevo').selectpicker('refresh');
			$('#listCalleReporteNuevo').selectpicker('render');
			$('#listCalle1ReporteNuevo').selectpicker('refresh');
			$('#listCalle1ReporteNuevo').selectpicker('render');
			$('#listCalle2ReporteNuevo').selectpicker('refresh');
			$('#listCalle2ReporteNuevo').selectpicker('render');
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

//Carga las calles dependiendo de la colonia
$(document).ready(function(){

	$('#listColonia').change(function(){
		var idcol = $(this).val();
		fntCallePorColonia(idcol);
	});

	$('#listColoniaEdit').change(function(){
		var idcol = $(this).val();
		fntCallePorColoniaEdit(idcol);
	});

	$('#listColoniaReporteNuevo').change(function(){
		var idcol = $(this).val();
		fntCallePorColoniaReportenuevo(idcol);
	});
});