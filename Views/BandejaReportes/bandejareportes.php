<?php 
  headerAdmin($data);
  getModal('modalBandejaReportes', $data);
?>
  <div id="contentAjax"></div>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fas fa-archive"></i> <?= $data['page_title']?>
        </h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/BandejaReportes"><?= $data['page_title']?></a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <form class="row" id="formBandejaReportes" name="formBandejaReportes">
              <div class="form-group col-md-3">
                <label class="control-label" for="txtNumTicket_Busqueda">No. de ticket</label>
                <input class="form-control" type="text" id="txtNumTicket_Busqueda" name="txtNumTicket_Busqueda">
              </div>
              <div class="form-group col-md-3">
                <label class="control-label" for="listEstatusTicket_Busqueda">Estatus del ticket</label>
                <select class="form-control" data-live-search="true" id="listEstatusTicket_Busqueda" name="listEstatusTicket_Busqueda"></select>
              </div>
              <div class="form-group col-md-3">
                <label class="control-label" for="dtpFechaInicial">Fecha inicial</label>
                <input class="form-control" type="text" id="dtpFechaInicial" name="dtpFechaInicial">
              </div>
              <div class="form-group col-md-3">
                <label class="control-label" for="dtpFechafinal">Fecha final</label>
                <input class="form-control" type="text" id="dtpFechafinal" name="dtpFechafinal">
              </div>
              <div class="form-group col-md-6">
                <label class="control-label" for="txtDetalleReporte_Busqueda">Búsqueda por detalle</label>
                <input class="form-control" type="text" id="txtDetalleReporte_Busqueda" name="txtDetalleReporte_Busqueda">
              </div>
              <div class="form-group col-md-6">
                <label class="control-label" for="txtNotaReporte_Busqueda">Búsqueda por nota</label>
                <input class="form-control" type="text" id="txtNotaReporte_Busqueda" name="txtNotaReporte_Busqueda">
              </div>
              
              <div class="form-group col-md-12 align-self-end text-right">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
          <div class="tile mb-4">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-12">
                  <h5 class="mb-3 line-head">Reportes recientes</h5>
                </div>
              </div>
            </div>
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableBandejaReportes" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Id</th>
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
  </main>
<?php footerAdmin($data); ?>