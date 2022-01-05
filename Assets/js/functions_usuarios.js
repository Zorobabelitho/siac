var tableUsuarios;
var divLoading = document.querySelector('#divLoading');

function fntCodificar(clave)
{
      let sClaveCod = '';
      let sSeparador = '@';
      let sCodigo = '';
      let iCodigo = 0;

      for (let i = 0; i <= clave.length - 1; i++) {
            sCodigo = clave.substring(i, i + 1);
            iCodigo = (sCodigo.charCodeAt(0) * 7);
            sClaveCod += (iCodigo.toString() + sSeparador);
      }

      return sClaveCod;
}

document.addEventListener('DOMContentLoaded', function(){

	tableUsuarios = $('#tableUsuario').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
		},
		"ajax":{
			"url": " "+base_url+"/Usuarios/getUsuarios",

			"dataSrc":""
		},
		"columns":[
			{"data":"id_funcionario", "width": "5%"},
			{"data":"funcionario", "width": "40%"},
			{"data":"permiso", "width": "20%"},
			{"data":"id_estatus_del_registro", "width": "10%"},
			{"data":"options", "width": "15%"}
		],
		'dom': 'lBftip',
		'buttons': [
			{
				"extend": "pdfHtml5",
				"text": "<i class='fas fa-file-pdf'></i>  PDF",
				"titleAttr" : "Exportar a PDF",
				"className" : "btn btn-danger",
				"exportOptions": {
					"columns":[ 0,1,2,3]
				}
			}
		],
		"resonsieve":"true",
		"bDestroy": true,
		"iDisplayLength": 10,
		"order":[[1,"asc"]]
	});

	var formUsuario = document.querySelector("#formUsuario");
	formUsuario.onsubmit = function(e) {
		e.preventDefault();

		var strNombre = document.querySelector('#txtNombre').value;
		var strDescripcion = document.querySelector('#txtDescripcion').value;
		var strTelefonoFijo = document.querySelector('#txtTelefono').value;
		var strTelefonoMovil = document.querySelector('#txtTelefonoMovil').value;
		var strConmutador = document.querySelector('#txtConmutador').value;
		var strExtension = document.querySelector('#txtExtension').value;
		var intArea = document.querySelector('#listArea').value;
		var intRolUsuario = document.querySelector('#listRol').value;
		var strCorreoElectronico = document.querySelector('#txtCorreo').value;
		var strPassword = document.querySelector('#txtPassword').value;

		if(strNombre == '' || strTelefonoMovil == '' || intArea == '' || intRolUsuario == '' || strCorreoElectronico == '')
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
		let strClaveCodificada = fntCodificar(strPassword);
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		var ajaxUrl = base_url+'/Usuarios/setUsuario/'+strClaveCodificada;
		var formData = new FormData(formUsuario);
		request.open("POST",ajaxUrl,true);
		request.send(formData);
 		request.onreadystatechange = function(){
 			if(request.readyState == 4 && request.status == 200){
 				var objData = JSON.parse(request.responseText);
 				if(objData.status)
 				{
 					$('#modalFormUsuario').modal("hide");
 					formUsuario.reset();
 					swal("Usuarios", objData.msg , "success");
 					tableUsuarios.api().ajax.reload();
 				}else{
 					swal("Error", objData.msg , "error");
 				}
 			}
 			divLoading.style.display = "none";
            return false;
 		}

	}
}, false);


window.addEventListener('load',function(){
	fntRolesUsuario();
	fntAreas();
	/*fntViewUsuario();
	fntEditUsuario();
	fntDelUsuario();*/
}, false);

function fntRolesUsuario(){
	var ajaxUrl = base_url+'/Roles/getSelectRolesActivos';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listRol').innerHTML = request.responseText;
			$('#listRol').selectpicker('render');
		}
	}
}

function fntAreas(){
	var ajaxUrl = base_url+'/Areas/getSelectAreas';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function() {
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#listArea').innerHTML = request.responseText;
			$('#listArea').selectpicker('render');
		}
	}
}


function fntViewUsuario(id_funcionario)
{
	var id_funcioanrio = id_funcionario;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Usuarios/getUsuario/'+id_funcionario;
	request.open("GET",ajaxUrl,true);
	request.send();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			var objData = JSON.parse(request.responseText);

			if(objData.status)
			{
				var estadoUsuario = objData.data.id_estatus_del_registro == 1 ?
				'<span class="badge badge-success">Activo</span>':
				'<span class="badge badge-danger">Inactivo</span>';

				document.querySelector("#celNombre").innerHTML = objData.data.funcionario;
				document.querySelector("#celDescripcion").innerHTML = objData.data.descripcioon;
				document.querySelector("#celTelefonoFijo").innerHTML = objData.data.teleefono_directo;
				document.querySelector("#celTelefonoMovil").innerHTML = objData.data.teleefono_moovil;
				document.querySelector("#celConmutador").innerHTML = objData.data.conmutador;
				document.querySelector("#celExtension").innerHTML = objData.data.extensiones;
				document.querySelector("#celArea").innerHTML = objData.data.area;
				document.querySelector("#celRol").innerHTML = objData.data.permiso;
				document.querySelector("#celEmail").innerHTML = objData.data.correo_electroonico;
				document.querySelector("#celEstatus").innerHTML = estadoUsuario;
				document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;

				$('#modalViewUser').modal('show');
			}else{
				swal("Error", objData.msg , "error");
			}
		}
	}
}

function fntEditUsuario(id_funcionario)
{

	document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
	document.querySelector('#titleModal').innerHTML ="Actualizar usuario";
	document.querySelector('#btnText').innerHTML = "Actualizar";

	var id_funcionario = id_funcionario;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Usuarios/getUsuario/'+id_funcionario;
	request.open("GET",ajaxUrl,true);
	request.send();
	request.onreadystatechange = function(){
		
		if(request.readyState == 4 && request.status == 200)
		{
			var objData = JSON.parse(request.responseText);

			if(objData.status)
			{
					document.querySelector('#idUsuario').value = objData.data.id_funcionario;
					document.querySelector('#txtNombre').value = objData.data.funcionario; 
					document.querySelector('#txtDescripcion').value = objData.data.descripcioon; 
					document.querySelector('#txtTelefono').value = objData.data.teleefono_directo;
					document.querySelector('#txtTelefonoMovil').value = objData.data.teleefono_moovil;
					document.querySelector('#txtConmutador').value = objData.data.conmutador;
					document.querySelector('#txtExtension').value = objData.data.extensiones;
					document.querySelector('#listArea').value = objData.data.id_area;
					document.querySelector('#listRol').value = objData.data.id_permiso;
					document.querySelector('#txtCorreo').value = objData.data.correo_electroonico;
					
					$('#listRol').selectpicker('render');
					$('#listArea').selectpicker('render');

					if(objData.data.id_estatus_del_registro == 1)
					{
						document.querySelector('#listStatus').value = 1;
					}else{
						document.querySelector('#listStatus').value = 2;
					}
					$('#listStatus').selectpicker('render');
			}
		}

		$('#modalFormUsuario').modal('show');	
	
	}
}

function fntDelUsuario(id_funcionario)
{

	var idUsuario = id_funcionario;

	swal({
		title: "Eliminar usuario",
		text: "¿Realmente desea eliminar el Usuario?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Si, eliminar",
		cancelButtonText: "No, cancelar",
		closeOnConfirm: false,
		closeOnCancel: true
	}, function(isConfirm){

		if (isConfirm)
		{
	    	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    	var ajaxUrl = base_url+'/Usuarios/delUsuario/';
	    	var strData = "idUsuario="+idUsuario;
	    	request.open("POST",ajaxUrl,true);
	    	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    	request.send(strData);
	    	request.onreadystatechange = function(){
		       	if(request.readyState == 4 && request.status == 200){
		          	var objData = JSON.parse(request.responseText);
	            	if(objData.status)
	            	{
		                swal("Eliminar!", objData.msg , "success");
		                tableUsuarios.api().ajax.reload();
		            }else{
		                swal("Atención!", objData.msg , "error");
		            }
		        }
	    	}
		}

	});
}

function openModal()
{
	document.querySelector('#idUsuario').value ="";
	document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
	document.querySelector('#titleModal').innerHTML ="Nuevo usuario";
	document.querySelector('#btnText').innerHTML = "Guardar";
	document.querySelector('#formUsuario').reset();

	$('#modalFormUsuario').modal('show');
}