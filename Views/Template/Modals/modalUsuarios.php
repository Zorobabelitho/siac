<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">

              <form class="row" id="formUsuario" name="formUsuario">
                <input type="hidden" id="idUsuario" name="idUsuario" value="">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Nombre completo</label>
                  <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtDescripcion">Descripción</label>
                  <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion">
                </div>
                <br>
                <div class="form-group col-md-3">
                  <label for="txtTelefono">Teléfono fijo</label>
                  <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-3">
                  <label for="txtTelefonoMovil">Teléfono móvil</label>
                  <input type="text" class="form-control valid validNumber" id="txtTelefonoMovil" name="txtTelefonoMovil" required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-3">
                  <label for="txtConmutador">Conmutador</label>
                  <input type="text" class="form-control" id="txtConmutador" name="txtConmutador">
                </div>
                <div class="form-group col-md-3">
                  <label for="txtExtension">Extensión</label>
                  <input type="text" class="form-control" id="txtExtension" name="txtExtension" >
                </div>
                <br>
                <div class="form-group col-md-12">
                  <label for="listArea">Área</label>
                  <select class="form-control" data-live-search="true" id="listArea" name="listArea"></select>
                </div>
                <br>
                <div class="form-group col-md-6">
                  <label for="listRol">Rol del usuario</label>
                  <select class="form-control" data-live-search="true" id="listRol" name="listRol"></select>
                </div>
                <div class="form-group col-md-6">
                  <label for="listStatus">Estatus</label>
                  <select class="form-control selectpicker" id="listStatus" name="listStatus">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                </div>
                <br>
                <div class="form-group col-md-6">
                  <label for="txtCorreo">Correo electrónico</label>
                  <input type="text" class="form-control valid validEmail" id="txtCorreo" name="txtCorreo" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtPassword">Contraseña</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                </div>
                <br>
                  <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                    <span id="btnText">Guardar</span>
                  </button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-fw fa-lg fa-times-circle"></i>
                    <span id="btnText">Cerrar</span>
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

<!-- Modal Ver usuario -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
          <tbody>
            <tr>
              <td>Nombre:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Teléfono fijo:</td>
              <td id="celTelefonoFijo"></td>
            </tr>
            <tr>
              <td>Teléfono móvil:</td>
              <td id="celTelefonoMovil"></td>
            </tr>
            <tr>
              <td>Conmutador:</td>
              <td id="celConmutador"></td>
            </tr>
            <tr>
              <td>Extensión:</td>
              <td id="celExtension"></td>
            </tr>
            <tr>
              <td>Área:</td>
              <td id="celArea"></td>
            </tr>
            <tr>
              <td>Permiso:</td>
              <td id="celRol"></td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEmail"></td>
            </tr>
            <tr>
              <td>Estatus:</td>
              <td id="celEstatus"></td>
            </tr>
            <tr>
              <td>Fecha de registro:</td>
              <td id="celFechaRegistro"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>