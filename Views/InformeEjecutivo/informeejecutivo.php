<?php 
  headerAdmin($data); 
  //getModal('modalUsuarios', $data);
?>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fas fa-file-contract"></i> <?= $data['page_title']?>
        </h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/InformeEjecutivo"><?= $data['page_title']?></a></li>
      </ul>
    </div>
    <div class="progress">
      <div class="progress-bar" role="progressbar" id="progress-bar"></div>
    </div>

    <div class="row panel-activo-IE" id="panel-rangofechas">
      <div class="col-md-12">
        <div class="tile">
          <h5 >Filtros para búsqueda por: </h5>
          <h6 class="mb-3 line-head"> - Rango de fechas</h6>
          <div class="tile-body">
            <form class="row" id="formRangoFechas" name="formRangoFechas">
              <div class="form-group col-md-6">
                <label for="dtpFechaInicial">Fecha inicial</label>
                <input type="text" id="dtpFechaInicial" name="dtpFechaInicial" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="dtpFechaFinal">Fecha final</label>
                <input type="text" id="dtpFechaFinal" name="dtpFechaFinal" class="form-control">
              </div>
              <div class="form-group col-md-12 text-right">
                <button id="btnActionForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(1, 1);">
                  <i class="icon fas fa-angle-right"></i>
                  <span id="btnText"> Siguiente</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnLimpiarForm" class="btn btn-secondary btn-sm" onclick="cambiarpanel(5, 1);">
                  <i class=" icon fas fa-angle-double-right"></i>
                  <span id="btnText"> Terminar</span>
                </button>
              </div> 
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row panel-inactivo-IE" id="panel-prefijos_tramites">
      <div class="col-md-12">
        <div class="tile">
          <h5 >Filtros para búsqueda por: </h5>
          <h6 class="mb-3 line-head"> 
            - Estatus del ticket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            - Tipos de reporte (Préfijos)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            - Trámites y/o servicios
          </h6>
          <div class="tile-body">
            <form class="row" id="formPrefijos" name="formPrefijos">
              <div class="form-group col-md-3">
                <label for="listEstatus">Estatus</label>
                <select class="form-control" data-live-search="true" id="listEstatus" name="listEstatus"></select>
              </div>
              <div class="form-group col-md-3">
                <label for="listTipoReporte">Tipos de reportes</label>
                <select class="form-control" data-live-search="true" id="listTipoReporte" name="listTipoReporte">
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="listTramitesServicios">Trámites o servicios</label>
                <select class="form-control" data-live-search="true" id="listTramitesServicios" name="listTramitesServicios">
                </select>
              </div>
              <div class="form-group col-md-12 text-right">
                <button id="btnActionForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(1, 2);">
                  <i class="fas fa-angle-left"></i>
                  <span id="btnText"> Anterior</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnActionForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(2, 1);">
                  <i class="icon fas fa-angle-right"></i>
                  <span id="btnText"> Siguiente</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnLimpiarForm" class="btn btn-secondary btn-sm" onclick="cambiarpanel(5, 2);">
                  <i class="icon fas fa-angle-double-right"></i>
                  <span id="btnText"> Terminar</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row panel-inactivo-IE" id="panel-Ciudadano">
      <div class="col-md-12">
        <div class="tile">
          <h5 >Filtros para búsqueda por: </h5>
          <h6 class="mb-3 line-head"> 
            - Datos del ciudadano&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            - Dirección (Colonia o calle)
          </h6>
          <div class="tile-body">
            <form class="row" id="formCiudadano" name="formCiudadano">
              <div class="form-group col-md-6">
                <label for="txtCiudadano">Ciudadano</label>
                <input type="text" class="form-control valid validText" id="txtCiudadano" name="txtCiudadano">
              </div>
              <div class="form-group col-md-6">
                <label for="txtTelefono">Teléfono</label>
                <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" onkeypress="return controlTag(event);">
              </div>
              <div class="form-group col-md-6">
                <label for="listColonia">Colonia</label>
                <select class="form-control" data-live-search="true" id="listColonia" name="listColonia">
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="listCalle">Calle</label>
                <select class="form-control" data-live-search="true" id="listCalle" name="listCalle">
                </select>
              </div>
              <div class="form-group col-md-12 text-right">
                <button id="btnActionForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(2, 2);">
                  <i class="icon fas fa-angle-left"></i>
                  <span id="btnText"> Anterior</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnActionForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(3, 1);">
                  <i class="icon fas fa-angle-right"></i>
                  <span id="btnText"> Siguiente</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnLimpiarForm" class="btn btn-secondary btn-sm" onclick="cambiarpanel(5, 3);">
                  <i class="icon fas fa-angle-double-right"></i>
                  <span id="btnText"> Terminar</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row panel-inactivo-IE" id="panel_Dependencia">
      <div class="col-md-12">
        <div class="tile">
          <h5 >Filtros para búsqueda por: </h5>
          <h6 class="mb-3 line-head"> 
            - Dependencia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            - Funcionario por dependencia
          </h6>
          <div class="tile-body">
            <form class="row" id="formDependencia" name="formDependencia">
              <div class="form-group col-md-6">
                <label for="listDependenciaAsignada">Dependencia asignada</label>
                <select class="form-control" data-live-search="true" id="listDependenciaAsignada" name="listDependenciaAsignada">
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="listDependenciaRegistro">Dependencia que registró</label>
                <select class="form-control" data-live-search="true" id="listDependenciaRegistro" name="listDependenciaRegistro">
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="listFuncionarioAsignado">Funcionario asignado</label>
                <select class="form-control" data-live-search="true" id="listFuncionarioAsignado" name="listFuncionarioAsignado">
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="listfuncionarioRegistro">Funcionario que registró</label>
                <select class="form-control" data-live-search="true" id="listfuncionarioRegistro" name="listfuncionarioRegistro">
                </select>
              </div>
              <div class="form-group col-md-12 text-right">
                <button id="btnActionForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(3, 2);">
                  <i class="icon fas fa-angle-left"></i>
                  <span id="btnText"> Anterior</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnLimpiarForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(4, 1);">
                  <i class="icon fas fa-angle-double-right"></i>
                  <span id="btnText"> Siguiente</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row panel-inactivo-IE" id="panel_Final">
      <div class="col-md-12">
        <div class="tile">
          <h5 class="mb-3 line-head">Filtros de búsqueda seleccionados </h5>
          <div class="tile-body">
            <form class="row" id="formFinal" name="formFinal">
              <div class="form-group col-md-6">
                <label for="listDependenciaAsignada">Los filtros para realizar tu búsqueda son:</label>
              </div>
              
              <div class="col-lg-8">
                <div class="bs-component">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="tag tag-default tag-pill float-xs-right" id="liRangoFecha" name="liRangoFecha"></span>
                    </li>
                    <li class="list-group-item" id="liEstatusTicket_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liEstatusTicket" name="liEstatusTicket"></span>
                    </li>
                    <li class="list-group-item" id="liPrefijos_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liPrefijos" name="liPrefijos"></span>
                    </li>
                    <li class="list-group-item" id="liTramiteServicio_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liTramiteServicio" name="liTramiteServicio"></span>
                    </li>
                    <li class="list-group-item" id="liCiudadano_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liCiudadano" name="liCiudadano"></span>
                    </li>
                    <li class="list-group-item" id="liTelefono_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liTelefono" name="liTelefono"></span>
                    </li>
                    <li class="list-group-item" id="liColonia_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liColonia" name="liColonia"></span>
                    </li>
                    <li class="list-group-item" id="liCalle_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liCalle" name="liCalle"></span>
                    </li>
                    <li class="list-group-item" id="liDependenciaAsignada_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liDependenciaAsignada" name="liDependenciaAsignada"></span>
                    </li>
                    <li class="list-group-item" id="liFuncionarioAsignado_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liFuncionarioAsignado" name="liFuncionarioAsignado"></span>
                    </li>
                    <li class="list-group-item" id="liDependenciaRegistro_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liDependenciaRegistro" name="liDependenciaRegistro"></span>
                    </li>
                    <li class="list-group-item" id="liFuncionarioRegistro_">
                      <span class="tag tag-default tag-pill float-xs-right" id="liFuncionarioRegistro" name="liFuncionarioRegistro"></span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="form-group col-md-12 text-right">
                <button id="btnLimpiarForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(6, 1);">
                  <i class="icon fa fa-fw fa-lg fa-check-circle"></i>
                  <span id="btnText"> Son correctos. Siguiente</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnActionForm" class="btn btn-secondary btn-sm" onclick="cambiarpanel(4, 2);">
                  <i class="icon fas fa-angle-double-left"></i>
                  <span id="btnText"> Regresar a los filtros</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row panel-inactivo-IE" id="panel_Columnas">
      <div class="col-md-12">
        <div class="tile">
          <h5 class="mb-3 line-head">Columnas para tu informe</h5>
          <div class="tile-body row">
            <div class="form-group col-md-4">
              <h6 class="mb-3">Estas son las columnas que se mostraran en tu informe:</h6>    
            </div>
            <div class="form-group col-md-8 text-center">
              <p class="text-info">Puedes seleccionar las columnas que deseas agregar o quitar para tu informe.</p>
            </div>

            <div class="form-group col-md-4">
              <div class="form-group bs-component">
                <ul class="list-group">
                  <li class="list-group-item li_mostrar" id="liId_tabla">
                    <span class="tag tag-default tag-pill float-xs-right">Id</span>
                  </li>
                  <li class="list-group-item li_ocultar" id="liCiudadano_tabla">
                    <span class="tag tag-default tag-pill float-xs-right">Ciudadano</span>
                  </li>
                  <li class="list-group-item">
                    <span class="tag tag-default tag-pill float-xs-right">Estatus</span>
                  </li>
                </ul>
              </div>

              <div class="row form-group col-md-12">
                <button id="btnLimpiarForm" class="btn btn-primary btn-sm" onclick="cambiarpanel(6, 1);">
                  <i class="icon fa fa-fw fa-lg fa-check-circle"></i>
                  <span id="btnText"> Generar informe</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button id="btnActionForm" class="btn btn-secondary btn-sm" onclick="cambiarpanel(6, 2);">
                    <i class="icon fas fa-angle-left"></i>
                    <span id="btnText"> Regresar</span>
                  </button>
              </div>
            </div>
            
            <div class="form-group col-md-8">
              <div class="row form-group col-md-12" id="divChecked">

                <div class="form-group col-md-6">
                  <div class="bs-component">
                    <div class="card">
                      <h4 class="card-header">Ticket</h4>
                      <div class="card-body">
                        <p class="card-text">
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbId" name="ckbId" checked>
                              <span class="label-text">Id</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbNumeroTicket" name="ckbNumeroTicket" checked>
                              <span class="label-text">Número de ticket</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbNumeroTicketAbsoluto" name="ckbNumeroTicketAbsoluto">
                              <span class="label-text">Número de ticket absoluto</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbEstatusTicket" name="ckbEstatusTicket" checked>
                              <span class="label-text">Estatus del ticket</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbTramitesServicios" name="ckbTramitesServicios" checked>
                              <span class="label-text">Trámite y/o servicio</span>
                            </label>
                          </div>
                          <div class="animated-checkbox">
                            <label>
                              <input type="checkbox" id="ckbDetalleReporte" name="ckbDetalleReporte">
                              <span class="label-text">Detalle del reporte</span>
                            </label>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <div class="bs-component">
                    <div class="card">
                      <h4 class="card-header">Dirección</h4>
                      <div class="card-body">
                        <p class="card-text">
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbColonia" name="ckbColonia">
                              <span class="label-text">Colonia</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbCalle" name="ckbCalle">
                              <span class="label-text">Calle</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbNumeroExterior" name="ckbNumeroExterior">
                              <span class="label-text">Número exterior</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbNumeroInterior" name="ckbNumeroInterior">
                              <span class="label-text">Número interior</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbEntreCalle1" name="ckbEntreCalle1">
                              <span class="label-text">Entre calle 1</span>
                            </label>
                          </div>
                          <div class="animated-checkbox">
                            <label>
                              <input type="checkbox" id="ckbEntreCalle2" name="ckbEntreCalle2">
                              <span class="label-text">Entre calle 2</span>
                            </label>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <div class="bs-component">
                    <div class="card">
                      <h4 class="card-header">Ciudadano</h4>
                      <div class="card-body">
                        <p class="card-text">
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbCiudadano" name="ckbCiudadano">
                              <span class="label-text">Ciudadano</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbTelefono" name="ckbTelefono">
                              <span class="label-text">Teléfono</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbTelefonoMovil" name="ckbTelefonoMovil">
                              <span class="label-text">Teléfono móvil</span>
                            </label>
                          </div>
                          <div class="animated-checkbox">
                            <label>
                              <input type="checkbox" id="ckbCorreoCiudadano" name="ckbCorreoCiudadano">
                              <span class="label-text">Correo electrónico</span>
                            </label>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <div class="bs-component">
                    <div class="card">
                      <h4 class="card-header">Tiempo</h4>
                      <div class="card-body">
                        <p class="card-text">
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbFecha" name="ckbFecha">
                              <span class="label-text">Fecha</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbTiempoHoras" name="ckbTiempoHoras">
                              <span class="label-text">Tiempo en horas</span>
                            </label>
                          </div>
                          <div class="animated-checkbox">
                            <label>
                              <input type="checkbox" id="ckbUltimaActualizacion" name="ckbUltimaActualizacion">
                              <span class="label-text">Ultima actualización</span>
                            </label>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <div class="bs-component">
                    <div class="card">
                      <h4 class="card-header">Otros</h4>
                      <div class="card-body">
                        <p class="card-text">
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbArea" name="ckbArea" checked>
                              <span class="label-text">Área</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbDependencia" name="ckbDependencia" checked>
                              <span class="label-text">Dependencia</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbFuncionario" name="ckbFuncionario">
                              <span class="label-text">Funcionario</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbFuncionarioRecibio" name="ckbFuncionarioRecibio" checked>
                              <span class="label-text">Funcionario quien recibio</span>
                            </label>
                          </div>
                          <div class="animated-checkbox mb-3 line-head">
                            <label>
                              <input type="checkbox" id="ckbOrigen" name="ckbOrigen" checked>
                              <span class="label-text">Origen</span>
                            </label>
                          </div>
                          <div class="animated-checkbox">
                            <label>
                              <input type="checkbox" id="ckbEstatus" name="ckbEstatus">
                              <span class="label-text">Estatus</span>
                            </label>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 text-center" id="div_mensaje">
      <div class="col-lg-12">
        <div class="bs-component">
          <div class="alert alert-dismissible alert-info">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Recuerda!</strong> Puedes realizar tu búsqueda utilizando mas de un filtro.
          </div>
        </div>
      </div>
    </div>

    <div class="row panel-inactivo-IE">
      <div class="col-md-9">
        <div class="tile">
          <div class="tile-body">
            
            <form class="row">
            </form>
            
          </div>
        </div>
      </div>

    </div>
  </main>

<?php footerAdmin($data); ?>