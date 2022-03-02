<?php $general_settings = $this->model_admin->settings(); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('Admin') ?>" class="brand-link">
    <a href="<?= base_url('Admin') ?>"><img style="width: 70% !important; margin: auto; display: block; padding: 15px 0px 5px 0px" src="<?= base_url('img/settings/'.$general_settings[0]['logo_app']) ?>" alt="Logo <?= $general_settings[0]['name_app'] ?>"></a>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="<?= base_url('Admin') ?>" class="d-block"><strong>Administración</strong></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin') ?>" class="nav-link <?= ($this->uri->segment(2)=="") ? "active" : "" ?>">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Users') ?>" class="nav-link <?= ($this->uri->segment(2)=="Users") ? "active" : "" ?>">
          <i class="nav-icon fa fa-user"></i>
          <p>
            Usuarios
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Claims') ?>" class="nav-link <?= ($this->uri->segment(2)=="Claims") ? "active" : "" ?>">
          <i class="nav-icon far fa-envelope"></i>
          <p>
            Quejas y reclamos
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Verify') ?>" class="nav-link <?= ($this->uri->segment(2)=="Verify") ? "active" : "" ?>">
          <i class="nav-icon fa fa-check-circle" aria-hidden="true"></i>
          <p>
            Verificaciones
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Ads') ?>" class="nav-link <?= ($this->uri->segment(2)=="Ads") ? "active" : "" ?>">
          <i class='nav-icon fas fa-bullhorn'></i>
          <p>
            Anuncios
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Events') ?>" class="nav-link <?= ($this->uri->segment(2)=="Events") ? "active" : "" ?>">
          <i class='nav-icon fas fa-calendar-alt'></i>
          <p>
            Eventos
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Config') ?>" class="nav-link <?= ($this->uri->segment(2)=="Config") ? "active" : "" ?>">
          <i class="nav-icon fa fa-cog"></i>
          <p>
            Configuración
          </p>
        </a>
      </li>
       <li class="nav-item has-treeview menu-open">
        <a href="<?= base_url('Admin/Logout') ?>" class="nav-link <?= ($this->uri->segment(2)=="Logout") ? "active" : "" ?>">
          <i class="nav-icon fa fa-power-off"></i>
          <p>
            Cerrar sesión
          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>