<?php 
  headerAdmin($data); 
  getModal('modalReporteCiudadano', $data);
?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fas fa-address-card"></i> <?= $data['page_title']?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/ReporteCiudadano"><?= $data['page_title']?></a></li>
    </ul>
  </div>
  <div class="">
    <div class="row user">
      <div class="col-md-3">
        <div class="tile p-0">
          <ul class="nav flex-column nav-tabs user-tabs">
            <li class="nav-item"><a class="nav-link active" href="#busqueda" data-toggle="tab">Búsqueda</a></li>
            <li class="nav-item"><a class="nav-link" href="#ciudadanoNuevo" data-toggle="tab">Agregar ciudadano</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane active" id="busqueda">
            <div class="row">
              <div class="col-md-12">
                <div class="tile">
                  
                  <div class="tile-body">
                    <form class="row" id="formBusquedaTicket" name="formBusquedaTicket">
                      <div class="form-group col-md-12">
                        <h5 class="modal-title" id="titleModal"></h5>
                        <input id="txtBusqueda" name="txtBusqueda" class="form-control app-search__input" type="text" placeholder="Búsqueda por nombre o teléfono">
                        <button class="app-search__button" id="btnBusquedaTicket" onclick="fntBusqueda();">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="tableReporteCiudadano" style="width: 100%">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Ciudadano</th>
                            <th>Colonia</th>
                            <th>Teléfono</th>
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
          <div class="tab-pane fade" id="ciudadanoNuevo">
            <div class="row">
              <div class="col-md-12">
                <div class="tile">
                  <h3 class="tile-title">Ciudadano nuevo</h3>
                  <div class="tile-body">
                    <form class="row" id="formAgregarCiudadano" name="formAgregarCiudadano">
                      <input type="hidden" id="id_ciudadano" name="id_ciudadano" value="">
                      <div class="form-group col-md-6">
                        <label for="txtNombre">Nombre(s)</label>
                        <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="txtApePaterno">Apellido paterno</label>
                        <input type="text" class="form-control valid validText" id="txtApePaterno" name="txtApePaterno" required="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="txtApeMaterno">Apellido materno</label>
                        <input type="text" class="form-control valid validText" id="txtApeMaterno" name="txtApeMaterno">
                      </div>
                      <br>
                      <div class="form-group col-md-6">
                        <label for="listTipoContacto">Tipo de contacto</label>
                        <select class="form-control" data-live-search="true" id="listTipoContacto" name="listTipoContacto" required=""></select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="txtTelefono">Teléfono</label>
                        <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" onkeypress="return controlTag(event);" required="">
                      </div>
                      <div class="form-group col-md-3"></div>
                      <div class="form-group col-md-12">
                        <label for="txtDescripcion">Descripción</label>
                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" type="text"></textarea>
                      </div>
                      <br>
                      <div class="form-group col-md-6">
                        <label for="listColonia">Colonia</label>
                        <select class="form-control" data-live-search="true" id="listColonia" name="listColonia" required=""></select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="listCalle">Calle</label>
                        <select class="form-control" data-live-search="true" id="listCalle" name="listCalle" required=""></select>
                      </div>
                      <br>
                      <div class="form-group col-md-3">
                        <label for="txtNumExterior">No. Exterior</label>
                        <input type="text" class="form-control" id="txtNumExterior" name="txtNumExterior" required="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="txtNumInterior">No. Interior</label>
                        <input type="text" class="form-control" id="txtNumInterior" name="txtNumInterior">
                      </div>
                      <div class="form-group col-md-6">
                      </div>
                      <br>
                      <div class="form-group col-md-6">
                        <label for="listCalle1">Entre calle 1</label>
                        <select class="form-control" data-live-search="true" id="listCalle1" name="listCalle1" required=""></select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="listCalle2">Entre calle 2</label>
                        <select class="form-control" data-live-search="true" id="listCalle2" name="listCalle2" required=""></select>
                      </div>
                      <br>
                      <div class="form-group col-md-12">
                        <label for="txtReferencias">Referencias</label>
                        <textarea class="form-control" id="txtReferencias" name="txtReferencias" rows="2" type="text"></textarea>
                      </div>
                      <br>
                      <div class="form-group col-md-6">
                        <label for="txtEmail">Correo electrónico</label>
                        <input type="text" class="form-control valid validEmail" id="txtEmail" name="txtEmail">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="listStatus">Estatus</label>
                        <select class="form-control" id="listStatus" name="listStatus" required="">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                        </select>
                      </div>
                      <br>
                      <div class="form-group col-md-12 text-right">
                        <button id="btnActionForm" class="btn btn-primary" type="submit">
                          <i class="icon fas fa-check-circle"></i>
                          <span id="btnText">Guardar</span>
                        </button>&nbsp;&nbsp;
                        <button id="btnLimpiarForm" class="btn btn-secondary" onclick="limpiarFormNuevoCiudadano();">
                          <i class="icon fas fa-brush"></i>
                          <span id="btnText">Limpiar</span>
                        </button>
                      </div> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php footerAdmin($data); ?> 