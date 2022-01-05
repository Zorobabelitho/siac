<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['funcionario']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['permiso']; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <?php if($_SESSION['permisos'][1]['r'] == 1){ ?>
        <li>
          <a class="app-menu__item" href="<?= BASE_URL(); ?>/dashboard">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Tablero</span>
          </a>
        </li>
        <?php }?>
        <?php 
          if($_SESSION['permisos'][19]['r'] == 1 || 
            $_SESSION['permisos'][20]['r'] == 1 || 
            $_SESSION['permisos'][21]['r'] == 1 || 
            $_SESSION['permisos'][22]['r'] == 1 || 
            $_SESSION['permisos'][23]['r'] == 1 || 
            $_SESSION['permisos'][24]['r'] == 1){ 
        ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fas fa-bullhorn"></i>
            <span class="app-menu__label">Atención Ciudadana</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['permisos'][19]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/BandejaReportes">
                Bandeja de reportes
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][20]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/informe_ejecutivo_its">
                Informe ejecutivo ITS
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][21]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/InformeEjecutivo">
                Informe ejecutivo
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][22]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/informes_historicos">
                Informes historicos
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][23]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/its">
                ITS
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][24]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/ReporteCiudadano">
                Reporte Ciudadano
              </a>
            </li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
        <?php 
          if($_SESSION['permisos'][33]['r'] == 1 || 
            $_SESSION['permisos'][34]['r'] == 1){ 
        ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fas fa-users"></i>
            <span class="app-menu__label">Usuarios</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['permisos'][33]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/Usuarios">

                Usuarios
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][34]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/Roles">
                Roles
              </a>
            </li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
        <?php 
          if($_SESSION['permisos'][25]['r'] == 1 ||
            $_SESSION['permisos'][26]['r'] == 1 ||
            $_SESSION['permisos'][27]['r'] == 1 ||
            $_SESSION['permisos'][28]['r'] == 1 ||
            $_SESSION['permisos'][29]['r'] == 1 ||
            $_SESSION['permisos'][30]['r'] == 1){ 
        ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fas fa-clipboard-list"></i>
            <span class="app-menu__label">Administración</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['permisos'][25]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/areas">
                Áreas
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][26]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/adm_ciudadanos">
                Ciudadanos
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][27]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/adm_colonias">
                Colonias
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][28]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/adm_dependencias">
                Dependencias
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][29]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/adm_oficialiadepartes">
                Oficialia de partes
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][30]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/adm_reportes">
                Reportes
              </a>
            </li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
        <?php if($_SESSION['permisos'][31]['r'] == 1 || $_SESSION['permisos'][32]['r'] == 1){ ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fas fa-inbox"></i>
            <span class="app-menu__label">Oficialia de Partes</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['permisos'][31]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/bandeja_reportes">
                Bandeja de documentos
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['permisos'][32]['r'] == 1){ ?>
            <li>
              <a class="treeview-item" href="<?= BASE_URL(); ?>/informe_ejecutivo_its">
                Informes
              </a>
            </li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
          <li>
            <a class="app-menu__item" href="<?= BASE_URL(); ?>/logout">
              <i class="app-menu__icon fa fa-sign-out"></i>
              <span class="app-menu__label">Cerrar sesión</span>
            </a>
          </li>
      </ul>
    </aside>