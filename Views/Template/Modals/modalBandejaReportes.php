<!-- Modal Busqueda de reporte -->
<div class="modal fade" id="modalBandejaReportes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Resultados de la búsqueda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="myTabContent">
          <div class="tile-body">
            <div class="tile mb-4">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableBandejaReportes_Busqueda" style="width: 100%">
                  <thead>
                    <tr>
                      <th>No. Ticket</th>
                      <th>Fecha</th>
                      <th>Estatus</th>
                      <th>Trámite y/o servicio</th>
                      <th>Área</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal detalles de reporte -->
<div class="modal fade" id="modalDetallesReporte" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary" >
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#DatosReporte" id="DatosReportePest">Datos del reporte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Notas">Notas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Seguimiento">Seguimiento</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Historial">Historial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#InfoCiudadanos">Datos del ciudadano</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Reportes">Reportes registrados</a>
          </li>
        </ul>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade active show" id="DatosReporte"> 
           <div class="modal-body">
              <div class="tile mb-4">
                <div class="tile-body">
                  <form class="row" id="formVerReporteCiudadano" name="formVerReporteCiudadano">
                    <input type="hidden" id="idTicket" name="idTicket" value="">
                    <input type="hidden" id="estatusTicket" name="estatusTicket" value="">
                    <input type="hidden" id="idCiudadanoUR" name="idCiudadanoUR" value="">
                    <div class="form-group col-md-3">
                      <div class="card mb-3 text-white bg-info">
                        <div class="card-body">
                          <blockquote class="card-blockquote">
                            <table>
                              <thead></thead>
                              <tbody class="text-white">
                                <tr>
                                  <td id="celNombreVR"></td>
                                </tr>
                                <tr>
                                  <td id="celTipoContactoVR"></td>
                                </tr>
                                <tr>
                                  <td id="celTelefonoVR"></td>
                                </tr>
                                <tr>
                                  <td id="celCalleVR"></td>
                                </tr>
                                <tr>
                                  <td id="NumDomVR"></td>
                                </tr>
                                <tr>
                                  <td id="ColoniaVR"></td>
                                </tr>
                                <tr>
                                  <td>Tlalnepantla de Baz</td>
                                </tr>
                                <tr>
                                  <td id="celCodigoPostalVR"></td>
                                </tr>
                                <tr>
                                  <td id="celMapaVR"></td>
                                </tr>
                              </tbody>
                            </table>
                            <br>
                            <table>
                              <thead></thead>
                              <tbody class="text-white">
                                <tr>
                                  <td><strong>Funcionario asignado</strong></td>
                                </tr>
                                <tr>
                                  <td id="celFuncionarioAsignadoVR"></td>
                                </tr>
                                <tr>
                                  <td id="celDependenciaVR"></td>
                                </tr>
                                <tr>
                                  <td><strong>Estatus</strong></td>
                                </tr>
                                <tr>
                                  <td id="celEstatusVR"></td>
                                </tr>
                              </tbody>
                            </table>
                          </blockquote>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-9">
                      <br>
                      <div class="bs-component">
                        <div id="NumeroTicket" name="NumeroTicket"></div>
                      </div>
                      <br>
                      <fieldset>
                        <label class="control-label" for="listTramitesServicios">Trámite o servicio</label>
                        <select class="form-control" data-live-search="true" id="listTramitesServicios" name="listTramitesServicios"></select>
                      </fieldset>
                      <br>
                      <fieldset>
                        <label class="control-label" for="txtDetalleReporte">Detalle del reporte</label>
                        <textarea class="form-control" id="txtDetalleReporte" name="txtDetalleReporte" rows="4" type="text" ></textarea>
                      </fieldset>
                      <br>
                      <fieldset>
                        <label class="control-label" for="txtNumSolicitudes">Número de reparaciones solicitadas</label>
                        <input type="text" class="form-control" id="txtNumSolicitudes" name="txtNumSolicitudes" onkeypress="return controlTag(event);" >
                      </fieldset>
                      <br>
                      <div class="bs-component">
                        <div class="alert alert-dismissible alert-info text-center">
                          <strong>Ubicación del reporte</strong>
                        </div>
                      </div>
                      <fieldset>
                        <label class="control-label" for="listColonia">Colonia</label>
                        <select class="form-control" data-live-search="true" id="listColonia" name="listColonia"></select>
                      </fieldset>
                      <br>
                      <fieldset>
                        <label class="control-label" for="listCalle">Calle</label>
                        <select class="form-control" data-live-search="true" id="listCalle" name="listCalle"></select>
                      </fieldset>
                      <br>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <fieldset>
                            <label class="control-label" for="txtNumeroExteriorTicket">
                            Número exterior</label>
                            <input type="text" class="form-control" id="txtNumeroExteriorTicket" name="txtNumeroExteriorTicket" >
                          </fieldset>
                        </div>
                        <div class="form-group col-md-6">
                          <fieldset>
                            <label class="control-label" for="txtNumeroInteriorTicket">
                            Número interior</label>
                            <input type="text" class="form-control" id="txtNumeroInteriorTicket" name="txtNumeroInteriorTicket" >
                          </fieldset>
                        </div>
                      </div>
                      <br>
                      <fieldset>
                        <label class="control-label" for="listCalle1">Entre calle 1</label>
                        <select class="form-control" data-live-search="true" id="listCalle1" name="listCalle1"></select>
                      </fieldset>
                      <br>
                      <fieldset>
                        <label class="control-label" for="listCalle2">Entre calle 2</label>
                        <select class="form-control" data-live-search="true" id="listCalle2" name="listCalle2"></select>
                      </fieldset>
                      <br>
                      <fieldset>
                        <label class="control-label" for="txtReferencias">Referencias</label>
                        <textarea class="form-control" id="txtReferencias" name="txtReferencias" rows="4" type="text" ></textarea>
                      </fieldset>
                      <br>
                      <div class="row text-right">
                        <div class="form-group col-md-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardarVR">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar
                          </button>
                          &nbsp;&nbsp;&nbsp;
                          <button class="btn btn-primary" type="button">
                            <i class="icon fas fa-print"></i>
                            Imprimir
                          </button>
                        </div>
                      </div>
                      <br>
                      <div class="text-right">
                        <label id="lblFuncionarioInserto" name="lblFuncionarioInserto"></label>  
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>   
          </div>
          <div class="tab-pane fade" id="Notas">
            <div class="tile mb-4">
              <div class="page-header">
                <div class="row">
                  <div class="col-lg-12" id="NumeroTicketNotas" name="NumeroTicketNotas">
                  </div>
                </div>
              </div>
              <div class="tile-body">
                <form id="formNotas" name="formNotas">
                  <input type="hidden" id="idTicketNota" name="idTicketNota" value="">
                  <div class="form-group">
                    <label class="control-label">Nota</label>
                    <textarea class="form-control" rows="3" id="txtNota" name="txtNota"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Documento</label>
                    <input class="form-control" type="file" id="fileNota" name="fileNota">
                  </div>
                   <div class="text-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar nota</button>
                  </div>
                </form>
                <br>
              </div>
            </div>
            <div class="tile mb-4">
              <div class="page-header">
                <div class="row">
                  <div class="col-lg-12">
                    <h5 class="mb-3 line-head">Notas anteriores</h5>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaNotas" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Nota</th>
                      <th>Funcionario</th>
                      <th>Fecha</th>
                      <th>Documento</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="Seguimiento">
            <div class="tile mb-4">
              <div class="page-header">
                <div class="row">
                  <div class="col-lg-12" id="NumeroTicketSeguimiento" name="NumeroTicketSeguimiento">
                  </div>
                </div>
              </div>
              <div class="tile-body row">
                <div class="col-md-3">
                  <div class="tile p-0">
                    <ul class="nav flex-column nav-tabs user-tabs">
                      <li class="nav-item"><a class="nav-link active" href="#Seguimiento_terminar" data-toggle="tab">Terminar</a></li>
                      <li class="nav-item"><a class="nav-link" href="#Seguimiento_rechazar" data-toggle="tab">Rechazar</a></li>
                      <li class="nav-item"><a class="nav-link" href="#Seguimiento_asignar" data-toggle="tab">Asignar</a></li>
                      <li class="nav-item"><a class="nav-link" href="#Seguimiento_cerrar" data-toggle="tab">Cerrar</a></li>
                      <li class="nav-item"><a class="nav-link" href="#Seguimiento_reasignar" data-toggle="tab">Reasignar</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="tab-content">
                    <div class="tab-pane active" id="Seguimiento_terminar">
                      <div class="tile mb-4">
                        <div class="page-header">
                          <div class="row">
                            <div class="col-lg-12">
                              <h5 class="mb-3 line-head">Terminar reporte</h5>
                            </div>
                          </div>
                        </div>
                        <div class="tile-body">
                          <form id="formSeguimiento_Terminar" name="formSeguimiento_Terminar" class="row">
                            <input type="hidden" id="idTicketSeguimiento_terminar" name="idTicketSeguimiento_terminar" value="">
                            <input type="hidden" id="idFuncionarioSeguimiento_terminar" name="idFuncionarioSeguimiento_terminar" value="">
                            <div class="bs-component col-md-6">
                              <div class="card mb-4 text-white bg-info">
                                <div class="card-body">
                                  <blockquote class="card-blockquote">
                                    <label class="control-label">Con fecha de: </label>
                                    <footer id="divFecha" name="divFecha"></footer>
                                  </blockquote>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-12">
                              <label class="control-label">Nota de seguimiento</label>
                              <textarea class="form-control" rows="3" id="txtNotaSeguimiento_terminar" name="txtNotaSeguimiento_terminar"></textarea>
                            </div>
                            <div class="col-md-12 text-right">
                              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Terminar reporte</button>
                            </div>
                          </form>
                          <br>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="Seguimiento_rechazar">
                      <div class="tile mb-4">
                        <div class="page-header">
                          <div class="row">
                            <div class="col-lg-12">
                              <h5 class="mb-3 line-head">Rechazar reporte</h5>
                            </div>
                          </div>
                        </div>
                        <div class="tile-body">
                          <form id="formSeguimiento_Rechazar" name="formSeguimiento_Rechazar">
                            <input type="hidden" id="idTicketSeguimiento_rechazar" name="idTicketSeguimiento_rechazar" value="">
                            <input type="hidden" id="idFuncionarioSeguimiento_rechazar" name="idFuncionarioSeguimiento_rechazar" value="">
                            <div class="form-group">
                              <label class="control-label" for="listMotivoRechazo">Motivo del rechazo</label>
                               <select class="form-control" data-live-search="true" id="listMotivoRechazo" name="listMotivoRechazo"></select>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Nota de seguimiento</label>
                              <textarea class="form-control" rows="3" id="txtNotaSeguimiento_rechazar" name="txtNotaSeguimiento_rechazar"></textarea>
                            </div>
                            <div class="text-right">
                              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Rechazar reporte</button>
                            </div>
                          </form>
                          <br>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="Seguimiento_asignar">
                      <div class="tile mb-4">
                        <div class="page-header">
                          <div class="row">
                            <div class="col-lg-12">
                              <h5 class="mb-3 line-head">Asignar reporte</h5>
                            </div>
                          </div>
                        </div>
                        <div class="tile-body">
                          <form id="formSeguimiento_Asignar" name="formSeguimiento_Asignar">
                            <input type="hidden" id="idTicketSeguimiento_asignar" name="idTicketSeguimiento_asignar" value="">
                            <input type="hidden" id="idFuncionarioSeguimiento_asignar" name="idFuncionarioSeguimiento_asignar" value="">
                            <input type="hidden" id="idDependenciaAsignadaSeguimiento_asignar" name="idDependenciaAsignadaSeguimiento_asignar" value="">
                            <div class="form-group">
                              <label class="control-label" for="listAreaSeguimiento">Área</label>
                               <select class="form-control" data-live-search="true" id="listAreaSeguimiento" name="listAreaSeguimiento"></select>
                            </div>
                            <div class="form-group">
                              <label class="control-label" for="listEnlaceSeguimiento">Enlace</label>
                               <select class="form-control" data-live-search="true" id="listEnlaceSeguimiento" name="listEnlaceSeguimiento"></select>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Nota de seguimiento</label>
                              <textarea class="form-control" rows="3" id="txtNotaSeguimiento_asignar" name="txtNotaSeguimiento_asignar"></textarea>
                            </div>
                            <div class="text-right">
                              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Asignar reporte</button>
                            </div>
                          </form>
                          <br>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="Seguimiento_cerrar">
                      <div class="tile mb-4">
                        <div class="page-header">
                          <div class="row">
                            <div class="col-lg-12">
                              <h5 class="mb-3 line-head">Cerrar reporte</h5>
                            </div>
                          </div>
                        </div>
                        <div class="tile-body">
                          <form id="formSeguimiento_Cerrar" name="formSeguimiento_Cerrar">
                            <input type="hidden" id="idTicketSeguimiento_cerrar" name="idTicketSeguimiento_cerrar" value="">
                            <div class="form-group">
                              <label class="control-label">Con oficio de respuesta</label>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" checked="true" name="chkSeguimiento">Si
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="chkSeguimiento">No
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Nota de seguimiento</label>
                              <textarea class="form-control" rows="3" id="txtNotaSeguimiento_rechazar" name="txtNotaSeguimiento_rechazar"></textarea>
                            </div>
                            <div class="text-right">
                              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cerrar reporte</button>
                            </div>
                          </form>
                          <br>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="Seguimiento_reasignar">
                      
                    </div>
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="Historial">
            <div class="tile mb-4">
              <div class="page-header">
                <div class="row">
                  <div class="col-lg-12" id="NumeroTickethistorial" name="NumeroTicketHistorial">
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableHistorial" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Funcionario que asigna</th>
                      <th>Funcionario asignado</th>
                      <th>Nota de seguimiento</th>
                      <th>Estatus</th>
                      <th>Tipo de rechazo</th>
                      <th>Oficio respuesta</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="InfoCiudadanos">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <form class="row" id="formDatosCiudadano" name="formDatosCiudadano">
                    <input type="hidden" id="idCiudadano" name="idCiudadano" value="">
                    <div class="form-group col-md-6">
                      <label for="txtNombreEdit">Nombre(s)</label>
                      <input type="text" class="form-control valid validText" id="txtNombreEdit" name="txtNombreEdit" required="">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="txtApePaternoEdit">Apellido paterno</label>
                      <input type="text" class="form-control" id="txtApePaternoEdit" name="txtApePaternoEdit">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="txtApeMaternoEdit">Apellido materno</label>
                      <input type="text" class="form-control" id="txtApeMaternoEdit" name="txtApeMaternoEdit">
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <label for="listTipoContactoEdit">Tipo de contacto</label>
                      <select class="form-control" data-live-search="true" id="listTipoContactoEdit" name="listTipoContactoEdit"></select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="txtTelefonoEdit">Teléfono</label>
                      <input type="text" class="form-control" id="txtTelefonoEdit" name="txtTelefonoEdit" onkeypress="return controlTag(event);">
                    </div>
                    <div class="form-group col-md-3"></div>
                    <div class="form-group col-md-12">
                      <label for="txtDescripcionEdit">Descripción</label>
                      <textarea class="form-control" id="txtDescripcionEdit" name="txtDescripcionEdit" rows="2" type="text"></textarea>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <label for="listColoniaEdit">Colonia</label>
                      <select class="form-control" data-live-search="true" id="listColoniaEdit" name="listColoniaEdit"></select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="listCalleEdit">Calle</label>
                      <select class="form-control" data-live-search="true" id="listCalleEdit" name="listCalleEdit"></select>
                    </div>
                    <br>
                    <div class="form-group col-md-3">
                      <label for="txtNumExteriorEdit">No. Exterior</label>
                      <input type="text" class="form-control" id="txtNumExteriorEdit" name="txtNumExteriorEdit">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="txtNumInteriorEdit">No. Interior</label>
                      <input type="text" class="form-control" id="txtNumInteriorEdit" name="txtNumInteriorEdit">
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <label for="listCalle1Edit">Entre calle 1</label>
                      <select class="form-control" data-live-search="true" id="listCalle1Edit" name="listCalle1Edit"></select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="listCalle2Edit">Entre calle 2</label>
                      <select class="form-control" data-live-search="true" id="listCalle2Edit" name="listCalle2Edit"></select>
                    </div>
                    <br>
                    <div class="form-group col-md-12">
                      <label for="txtReferenciasEdit">Referencias</label>
                      <textarea class="form-control" id="txtReferenciasEdit" name="txtReferenciasEdit" rows="2" type="text"></textarea>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <label for="txtEmailEdit">Correo electrónico</label>
                      <input type="text" class="form-control" id="txtEmailEdit" name="txtEmailEdit">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="listStatusEdit">Estatus</label>
                      <select class="form-control" id="listStatusEdit" name="listStatusEdit" required="">
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                      </select>
                    </div>
                    <br>
                    <div class="form-group col-md-12 text-right">
                      <button id="btnActionForm" class="btn btn-primary" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        <span id="btnText">Guardar</span>
                      </button>
                    </div> 
                          
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="Reportes">
            <div class="tile mb-4">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableReportesRegistrados" style="width: 100%">
                  <thead>
                    <tr>
                      <th>No. Ticket</th>
                      <th>Fecha</th>
                      <th>Estatus</th>
                      <th>Trámite / Servicio</th>
                      <th>Área</th>
                      <th>Ultima modificación</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>     
      </div>
    </div>
  </div>
</div>