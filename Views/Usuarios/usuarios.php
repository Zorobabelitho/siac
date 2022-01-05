<?php 
  headerAdmin($data); 
  getModal('modalUsuarios', $data);
?>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fas fa-users"></i> <?= $data['page_title']?>
          <?php if($_SESSION['permisosMod']['w'] == 1){ ?>
          <button class="btn btn-primary" type="button" onclick="openModal();"><i class="icon fas fa-plus-circle"></i>  Nuevo</button>
          <?php } ?>
        </h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/Usuarios"><?= $data['page_title']?></a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableUsuario" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Permiso</th>
                      <th>Estatus</th>
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