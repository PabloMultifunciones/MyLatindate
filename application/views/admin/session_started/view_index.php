<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php $count_users = $this->model_admin->count_users(); ?>
              <h3><?= count($count_users) ?></h3>

              <p>Usuarios registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('Admin/Users') ?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <?php $count_users_verify = $this->model_admin->count_users('Verify'); ?>
              <h3><?= count($count_users_verify) ?></h3>
              <p>Usuarios verificados</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark-round"></i>
            </div>
            <a href="<?= base_url('Admin/Users') ?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <?php $count_users_online = $this->model_admin->count_users('Online'); ?>
              <h3><?= count($count_users_online) ?></h3>

              <p>Usuarios conectados</p>
            </div>
            <div class="icon">
              <i class="ion ion-chatbubbles"></i>
            </div>
            <a href="<?= base_url('Admin/Users') ?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= count($count_reports_users) ?></h3>

              <p>Nuevos reportes</p>
            </div>
            <div class="icon">
              <i class="ion ion-information-circled"></i>
            </div>
            <a href="<?= base_url('Admin/Claims') ?>" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Últimos usuarios registrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="table1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width: 10px">Usuario</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $last_users = $this->model_admin->count_users('Last');
                          for ($i=0; $i < count($last_users); $i++) {
                            ?>
                            <tr>
                              <td><?= $last_users[$i]['name_user'] ?></td>
                              <td><?= $last_users[$i]['email_user'] ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Últimos usuarios verificados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="table2" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width: 10px">Usuario</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $verify_users = $this->model_admin->count_users('Verify', 'Last');
                          for ($i=0; $i < count($verify_users); $i++) {
                            ?>
                            <tr>
                              <td><?= $verify_users[$i]['name_user'] ?></td>
                              <td><?= $verify_users[$i]['email_user'] ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <!-- right col -->
        </div>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->