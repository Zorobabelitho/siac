$('.login-content [data-toggle="flip"]').click(function() {
      $('.login-box').toggleClass('flipped');
      return false;
});

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

var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){
      if(document.querySelector('#formLogin')){
            let formLogin = document.querySelector('#formLogin');
            formLogin.onsubmit = function(e) {
                  e.preventDefault();

                  let strEmail = document.querySelector('#txtEmail').value;
                  let strPassword = document.querySelector('#txtPassword').value;

                  if(strEmail == "" || strPassword == "")
                  {
                        swal("Atención", "Escribe usuario y contraseña.", "error");
                        return false;
                  }else{
                        divLoading.style.display = "flex";
                        let strClaveCodificada = fntCodificar(strPassword);
                        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        var ajaxUrl = base_url+'/Login/loginUser/'+strClaveCodificada; 
                        var formData = new FormData(formLogin);
                        request.open("POST",ajaxUrl,true);
                        request.send(formData);

                        request.onreadystatechange = function(){
                              if(request.readyState != 4) return;
                              if(request.status == 200){
                                    var objData = JSON.parse(request.responseText);
                                    if(objData.status)
                                    {
                                          window.location = base_url+'/dashboard';
                                    }else{
                                          swal("Atención", objData.msg, "error");
                                          document.querySelector('#txtPassword').value = "";
                                    }
                              }else{
                                    swal("Atención", "Error en el proceso", "error");
                              }
                              divLoading.style.display = "none";
                              return false;
                        }

                  }
            }
      }

      if(document.querySelector('#formRecetPass')){
            let formRecetPass = document.querySelector('#formRecetPass');
            formRecetPass.onsubmit = function(e) {
                  e.preventDefault();

                  let strEmail = document.querySelector('#txtEmailReset').value;
                  if(strEmail == "")
                  {
                        swal("Atención", "Escribe tu correo electrónico.", "error");
                        return false;
                  }else{
                        divLoading.style.display = "flex";
                        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        var ajaxUrl = base_url+'/Login/resetPass'; 
                        var formData = new FormData(formRecetPass);
                        request.open("POST",ajaxUrl,true);
                        request.send(formData);

                        request.onreadystatechange = function(){
                              if(request.readyState != 4) return;
                              if(request.status == 200){
                                    var objData = JSON.parse(request.responseText);
                                    if(objData.status)
                                    {
                                          swal({
                                                title: "",
                                                text: objData.msg,
                                                type: "success",
                                                confirmButtonText: "Aceptar",
                                                closeOnConfirm: false,
                                          }, function(isConfirm) {
                                                if(isConfirm){
                                                      window.location = base_url;
                                                }
                                          });
                                    }else{
                                          swal("Atención", objData.msg, "error");
                                    }
                              }else{
                                    swal("Atención", "Escribe en el proceso.", "error");
                              }
                              divLoading.style.display = "none";
                              return false;
                        }
                  }
            }
      }

      if(document.querySelector('#formCambiarPass'))
      {
            let formCambiarPass = document.querySelector('#formCambiarPass');
            formCambiarPass.onsubmit = function(e){
                  e.preventDefault();

                  let strPassword = document.querySelector('#txtPassword').value;
                  let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
                  let idUsuario = document.querySelector('#idUsuario').value;

                  if(strPassword == "" || strPasswordConfirm == "")
                  {
                        swal("Atención", "Escribe la nueva contraseña", "error");
                        return false;
                  }else{
                        if(strPassword.length < 5){
                              swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres", "error");
                              return false;
                        }
                        if(strPassword != strPasswordConfirm)
                        {
                              swal("Atención", "Las contraseñas no son iguales", "error");
                              return false;     
                        }
                        divLoading.style.display = "flex";
                        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                        var ajaxUrl = base_url+'/Login/setPassword'; 
                        var formData = new FormData(formCambiarPass);
                        request.open("POST",ajaxUrl,true);
                        request.send(formData);

                        request.onreadystatechange = function(){
                              if(request.readyState != 4) return;
                              if(request.status == 200)
                              {
                                    var objData = JSON.parse(request.responseText);

                                    if(objData.status)
                                    {
                                          swal({
                                                title: "",
                                                text: objData.msg,
                                                type: "success",
                                                confirmButtonText: "Iniciar sesión",
                                                closeOnConfirm: false,
                                          }, function(isConfirm) {
                                                if(isConfirm){
                                                      window.location = base_url+'/login';
                                                }
                                          });
                                    }else{
                                         swal("Atención", objData.msg, "error"); 
                                    }
                              }else{
                                    swal("Atención", "Error en el proceso", "error");
                              }
                              divLoading.style.display = "none";
                        }
                  }

            }
      }

}, false);