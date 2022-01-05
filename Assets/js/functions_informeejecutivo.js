jQuery.datetimepicker.setLocale('es');
jQuery('#dtpFechaInicial').datetimepicker({
	timepicker:false,
	format:'d/m/Y'
});
jQuery('#dtpFechaFinal').datetimepicker({
	timepicker:false,
	format:'d/m/Y'
});

var strFecha = new Date();
var strFechaHoy = strFecha.getDate() + '/'+ (strFecha.getMonth() + 1) + '/' + strFecha.getFullYear();

document.addEventListener('DOMContentLoaded', function(){
	var formRangoFechas = document.querySelector("#formRangoFechas");
	formRangoFechas.onsubmit = function(e) {
		e.preventDefault();
	}

	var formPrefijos = document.querySelector("#formPrefijos");
	formPrefijos.onsubmit = function(e) {
		e.preventDefault();
	}

	var formCiudadano = document.querySelector("#formCiudadano");
	formCiudadano.onsubmit = function(e) {
		e.preventDefault();
	}

	var formDependencia = document.querySelector("#formDependencia");
	formDependencia.onsubmit = function(e) {
		e.preventDefault();
	}

	var formFinal = document.querySelector("#formFinal");
	formFinal.onsubmit = function(e) {
		e.preventDefault();
	}

}, false);

function fntPrefijos(){
	var ajaxUrl = base_url+'/Areas/getSelectPrefijos';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("POST",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listTipoReporte').innerHTML = request.responseText;
			$('#listTipoReporte').selectpicker('render');
		}
	}
}

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

function fntEstatusTicket(){
	var ajaxUrl = base_url+'/EstatusTicket/getSelectEstatusTicket';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listEstatus').innerHTML = request.responseText;
			$('#listEstatus').selectpicker('render');
		}
	}
}

function fntDependencias(){
	var ajaxUrl = base_url+'/Dependencias/getSelectDependencias';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listDependenciaAsignada').innerHTML = request.responseText;
			$('#listDependenciaAsignada').selectpicker('render');
			document.querySelector('#listDependenciaRegistro').innerHTML = request.responseText;
			$('#listDependenciaRegistro').selectpicker('render');
		}
	}
}

function fntFuncionarioAsignado(id_dependencia, Noselect){
	var iddep = id_dependencia;
	var ajaxUrl = base_url+'/Usuarios/getSelectFuncionarioPorDependencia/' + iddep;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			if(Noselect == 1){
				document.querySelector('#listFuncionarioAsignado').innerHTML = request.responseText;
				$('#listFuncionarioAsignado').selectpicker('refresh');
				$('#listFuncionarioAsignado').selectpicker('render');
			}else{
				document.querySelector('#listfuncionarioRegistro').innerHTML = request.responseText;
				$('#listfuncionarioRegistro').selectpicker('refresh');
				$('#listfuncionarioRegistro').selectpicker('render');
			}
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
			document.querySelector('#listCalle').innerHTML = request.responseText;
			$('#listCalle').selectpicker('refresh');
			$('#listCalle').selectpicker('render');
		}
	}
}

//Carga las calles dependiendo de la colonia
$(document).ready(function(){
	$('#listColonia').change(function(){
		var idcol = $(this).val();
		fntCallePorColoniaEdit(idcol);
	});
	$('#listDependenciaAsignada').change(function(){
		var iddep = $(this).val();
		fntFuncionarioAsignado(iddep, 1);
	});
	$('#listDependenciaRegistro').change(function(){
		var iddep = $(this).val();
		fntFuncionarioAsignado(iddep, 2);
	});
});

function cambiarpanel(numero_panel, movimiento){
	var div_mensaje = document.querySelector("#div_mensaje");
	if(numero_panel == 1){
		if(movimiento == 1){
			document.querySelector('#panel-prefijos_tramites').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#panel-rangofechas').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#progress-bar').style.width = '40%';
		}else{
			document.querySelector('#panel-prefijos_tramites').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#panel-rangofechas').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#progress-bar').style.width = '20%';
		}
	}
	if(numero_panel == 2){
		if(movimiento == 1){
			document.querySelector('#panel-Ciudadano').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#panel-prefijos_tramites').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#progress-bar').style.width = '60%';
		}else{
			document.querySelector('#panel-Ciudadano').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#panel-prefijos_tramites').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#progress-bar').style.width = '40%';
		}
	}
	if(numero_panel == 3){
		if(movimiento == 1){
			document.querySelector('#panel_Dependencia').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#panel-Ciudadano').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#progress-bar').style.width = '80%';
		}else{
			document.querySelector('#panel_Dependencia').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#panel-Ciudadano').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#progress-bar').style.width = '60%';
		}
	}
	if(numero_panel == 4){
		if(movimiento == 1){
			//Validamos los input
			let elementValid = document.getElementsByClassName("valid");
			for (let i = 0; i < elementValid.length; i++) {
				if(elementValid[i].classList.contains('is-invalid')) {
					swal("Atención", "Verifique los campos en rojo." , "error");
					return false;
				}
			}
			div_mensaje.style.display = "none";
			document.querySelector('#panel_Final').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#panel_Dependencia').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#progress-bar').style.width = '90%';
			$("#progress-bar").addClass("bg-warning");
			fntVerificaFiltros();
		}else{
			div_mensaje.style.display = "flex";
			document.querySelector('#panel_Final').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#panel_Dependencia').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#progress-bar').style.width = '80%';
			$("#progress-bar").removeClass("bg-warning");
		}
	}
	if(numero_panel == 5){
		//Validamos los input
		let elementValid = document.getElementsByClassName("valid");
		for (let i = 0; i < elementValid.length; i++) {
			if(elementValid[i].classList.contains('is-invalid')) {
				swal("Atención", "Verifique los campos en rojo." , "error");
				return false;
			}
		}
		div_mensaje.style.display = "none";
		document.querySelector('#panel_Final').classList.replace("panel-inactivo-IE", "panel-activo-IE");
		document.querySelector('#progress-bar').style.width = '90%';
		$("#progress-bar").addClass("bg-warning");

		switch (movimiento) {
			case 1:
				document.querySelector('#panel-rangofechas').classList.replace("panel-activo-IE", "panel-inactivo-IE");
				break;
			case 2:
				document.querySelector('#panel-prefijos_tramites').classList.replace("panel-activo-IE", "panel-inactivo-IE");
				break;
			case 3:
				document.querySelector('#panel-Ciudadano').classList.replace("panel-activo-IE", "panel-inactivo-IE");
				break;
			default:
				document.querySelector('#panel_Final').classList.replace("panel-activo-IE", "panel-inactivo-IE");
		}

		fntVerificaFiltros();
	}
	if(numero_panel == 6){
		if(movimiento == 1){
			document.querySelector('#panel_Columnas').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#panel_Final').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#progress-bar').style.width = '95%';
		}else{
			document.querySelector('#panel_Columnas').classList.replace("panel-activo-IE", "panel-inactivo-IE");
			document.querySelector('#panel_Final').classList.replace("panel-inactivo-IE", "panel-activo-IE");
			document.querySelector('#progress-bar').style.width = '90%';
		}
	}
}

function fntVerificaFiltros()
{
	//Obtenemos el rango de fechas
	var strfechaInicial = document.querySelector('#dtpFechaInicial').value;
	var strfechaFinal = document.querySelector('#dtpFechaFinal').value;

	//Obtenemos el estatus, prefijo y tramite o servicio
	var intestatusTicket = document.querySelector('#listEstatus').value;
	var intprefijo =  document.querySelector('#listTipoReporte').value;
	var intTramiteServicio = document.querySelector('#listTramitesServicios').value; 

	//Obtenemos ciudadano, telefono, colonia y calle
	var strCiudadano = document.querySelector('#txtCiudadano').value;
	var strTelefono = document.querySelector('#txtTelefono').value;
	var intColonia = document.querySelector('#listColonia').value;
	var intCalle = document.querySelector('#listCalle').value;

	//Obtenemos dependencia asignada, dependencia que registro, funcionario asignado y funcionario que registro
	var intDependenciaAsignada = document.querySelector('#listDependenciaAsignada').value;
	var intDependenciaRegistro = document.querySelector('#listDependenciaRegistro').value;
	var intFuncionarioAsignado = document.querySelector('#listFuncionarioAsignado').value;
	var intFuncionarioRegistro = document.querySelector('#listfuncionarioRegistro').value;

	//Validar y mostrar el rango de fechas
	if(strfechaInicial == '' && strfechaFinal == ''){
		document.querySelector('#liRangoFecha').innerHTML = '<strong>Rango de fecha: </strong> del 01/01/2019 al ' + strFechaHoy;
		strfechaInicial = '01/01/2019';
		strfechaFinal = strFechaHoy;
	}else if(strfechaInicial != '' && strfechaFinal == ''){
		document.querySelector('#liRangoFecha').innerHTML = '<strong>Rango de fecha: </strong> del ' + strfechaInicial + ' al ' + strFechaHoy;
		strfechaFinal = strFechaHoy;
	}else if(strfechaInicial == '' && strfechaFinal != ''){
		document.querySelector('#liRangoFecha').innerHTML = '<strong>Rango de fecha: </strong> del 01/01/2019 al ' + strfechaFinal;
		strfechaInicial = '01/01/2019';
	}else{
		document.querySelector('#liRangoFecha').innerHTML = '<strong>Rango de fecha: </strong> del ' + strfechaInicial + ' al ' + strfechaFinal;
	}

	//Validar y mostrar si existe un estatus de ticket
	var liEstatus = document.querySelector('#liEstatusTicket_');
	if(intestatusTicket == 0){
		liEstatus.style.display = "none";
	}else{
		liEstatus.style.display = "flex";
		document.querySelector('#liEstatusTicket').innerHTML = '<strong>Estatus de ticket: </strong>' + $('select[name="listEstatus"] option:selected').text();	
	}

	//Validar y mostrar si existe tipos de reportes
	var liTiposReportes = document.querySelector('#liPrefijos_');
	if(intprefijo == 0){
		liTiposReportes.style.display = "none";
	}else{
		liTiposReportes.style.display = "flex";
		document.querySelector('#liPrefijos').innerHTML = '<strong>Tipo de reporte: </strong>' + $('select[name="listTipoReporte"] option:selected').text();		
	}

	//Validar y mostrar si existe tramite o servicio
	var liTramiteServicio = document.querySelector('#liTramiteServicio_');
	if(intTramiteServicio == 0){
		liTramiteServicio.style.display = "none";
	}else{
		liTramiteServicio.style.display = "flex";
		document.querySelector('#liTramiteServicio').innerHTML = '<strong>Trámite y/o servicio: </strong>' + $('select[name="listTramitesServicios"] option:selected').text();		
	}

	//Validar y mostrar si existe ciudadano
	var liCiudadano = document.querySelector('#liCiudadano_');
	if(strCiudadano == ''){
		liCiudadano.style.display = "none";
	}else{
		liCiudadano.style.display = "flex";
		let letrasMayusculas = titleCase(strCiudadano);
		document.querySelector('#liCiudadano').innerHTML = '<strong>Ciudadano: </strong>' + letrasMayusculas;
	}

	//Validar y mostrar si existe telefono
	var liTelefono = document.querySelector('#liTelefono_');
	if(strTelefono == ''){
		liTelefono.style.display = "none";
	} else{
		liTelefono.style.display = "flex";
		document.querySelector('#liTelefono').innerHTML = '<strong>Teléfono: </strong>' + strTelefono;
	}

	//Validar y mostrar si existe colonia
	var liColonia = document.querySelector('#liColonia_');
	if(intColonia == 0){
		liColonia.style.display = "none";
	}else{
		liColonia.style.display = "flex";
		document.querySelector('#liColonia').innerHTML = '<strong>Colonia: </strong>' + $('select[name="listColonia"] option:selected').text();		
	}

	//Validar y mostrar si existe colonia
	var liCalle = document.querySelector('#liCalle_');
	if(intCalle == 0){
		liCalle.style.display = "none";
	}else{
		liCalle.style.display = "flex";
		document.querySelector('#liCalle').innerHTML = '<strong>Calle: </strong>' + $('select[name="listCalle"] option:selected').text();		
	}

	//Validar y mostrar si existe dependencia asignada
	var liDependenciaAsignada = document.querySelector('#liDependenciaAsignada_');
	if(intDependenciaAsignada == 0){
		liDependenciaAsignada.style.display = "none";
	}else{
		liDependenciaAsignada.style.display = "flex";
		document.querySelector('#liDependenciaAsignada').innerHTML = '<strong>Dependencia asignada: </strong>' + $('select[name="listDependenciaAsignada"] option:selected').text();		
	}

	//Validar y mostrar si existe funcionario asignado
	var liFuncionarioAsignado = document.querySelector('#liFuncionarioAsignado_');
	if(intFuncionarioAsignado == 0){
		liFuncionarioAsignado.style.display = "none";
	}else{
		liFuncionarioAsignado.style.display = "flex";
		document.querySelector('#liFuncionarioAsignado').innerHTML = '<strong>Funcionario asignado: </strong>' + $('select[name="listFuncionarioAsignado"] option:selected').text();		
	}

	//Validar y mostrar si existe dependencia que registro
	var liDependenciaRegistro = document.querySelector('#liDependenciaRegistro_');
	if(intDependenciaRegistro == 0){
		liDependenciaRegistro.style.display = "none";
	}else{
		liDependenciaRegistro.style.display = "flex";
		document.querySelector('#liDependenciaRegistro').innerHTML = '<strong>Dependencia que registro: </strong>' + $('select[name="listDependenciaRegistro"] option:selected').text();		
	}

	//Validar y mostrar si existe funcionario que registro
	var liFuncionarioRegistro = document.querySelector('#liFuncionarioRegistro_');
	if(intFuncionarioRegistro == 0){
		liFuncionarioRegistro.style.display = "none";
	}else{
		liFuncionarioRegistro.style.display = "flex";
		document.querySelector('#liFuncionarioRegistro').innerHTML = '<strong>Funcionario que registro: </strong>' + $('select[name="listfuncionarioRegistro"] option:selected').text();		
	}

}

function fntMostrarOpcionesColumna(mostrar_ocultar){
	var divChecked = document.querySelector('#divChecked');
	if(mostrar_ocultar == 1){
		document.querySelector('#btnAgregar_quitarColumnas').innerHTML = '¡Quiero agregar o quitar columnas!';
		document.querySelector('#btnAgregar_quitarColumnas').setAttribute('onclick','fntMostrarOpcionesColumna(2)');
		divChecked.style.display = "none";
	}else{
		document.querySelector('#btnAgregar_quitarColumnas').innerHTML = 'Ocultar selección de columnas';
		document.querySelector('#btnAgregar_quitarColumnas').setAttribute('onclick','fntMostrarOpcionesColumna(1)');
		divChecked.style.display = "flex";
	}
}

var ckbId = document.querySelector('#ckbId');
ckbId.addEventListener('change', function(){
	if(this.checked){
		document.querySelector('#thId').classList.replace("th_ocultar", "th_mostrar");
		document.querySelector('#tdId').classList.replace("th_ocultar", "th_mostrar");
	}else{
		document.querySelector('#thId').classList.replace("th_mostrar", "th_ocultar");
		document.querySelector('#tdId').classList.replace("th_mostrar", "th_ocultar");
	}
});

var ckbCiudadano = document.querySelector('#ckbCiudadano');
ckbCiudadano.addEventListener('change', function(){
	if(this.checked) {
		document.querySelector('#liCiudadano_tabla').classList.replace("li_ocultar", "li_mostrar");
	}else{
		document.querySelector('#liCiudadano_tabla').classList.replace("li_mostrar", "li_ocultar");
	}
});

//Load de la pagina
window.addEventListener('load', function(){
	fntPrefijos();
	fntTramitesServicios();
	fntEstatusTicket();
	fntColonias();
	fntDependencias();
},false);
