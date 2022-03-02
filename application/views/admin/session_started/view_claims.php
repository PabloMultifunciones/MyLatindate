<?php
$is_open = $this->uri->segment(3);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quejas y reclamos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Quejas y reclamos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Carpetas</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                <a href="<?= base_url('Admin/Claims') ?>" class="nav-link">
                  <i class="fas fa-inbox"></i> Bandeja de entrada
                  <span class="badge bg-primary float-right"><?= (isset($count_reports_users)) ? count($count_reports_users) : '0' ?></span>
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

      <?php if ($is_open=="") { ?>

        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Quejas y reclamos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table3" class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=0; $i < count($reports_users); $i++) {

                    $data_reporter = $this->model_home->getDataUserxId($reports_users[$i]['reporter_claims']);
                    ?>
                    <tr>
                      <td style="width: 20%"><a href="<?= base_url('Admin/Claims/'.$reports_users[$i]['token_claims']) ?>" style="<?= ($reports_users[$i]['status_claims']==0) ? 'color:#808B96;' : 'font-weight: bolder;' ?>"><?= $data_reporter[0]['name_user'] ?></a></td>
                      <td style="width: 60%"><b><?= $reports_users[$i]['subject_claims'] ?></b> - <?= substr($reports_users[$i]['body_claims'], 0, 45).'...' ?></td>
                      <td style="width: 20%"><?= date("M j, Y", strtotime($reports_users[$i]['date_claims'])) ?></td><td><a style="width: 32px;" class="btn btn-sm btn-danger btn-delete text-white" data-delete="<?= $reports_users[$i]['id_claims'] ?>" title="Eliminar cuenta de usuario"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php } ?> 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Quejas y reclamos | Pagina De Inicio</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table3" class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>URL</th>
                    <th>Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $complaintspolicy = $this->model_home->getDataComplaintsPolicy();
                  foreach ($complaintspolicy as $item) {
                
                    ?>
                    <tr>
                      <td style="width: 20%"><?php echo $item->name; ?></td>
                      <td style="width: 20%"><?php echo $item->email; ?></td>
                      <td style="width: 20%"><?php echo $item->url; ?></td>
                      <td style="width: 40%"><?php echo $item->complaint; ?></td>
                    </tr>
                  <?php } ?> 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        
        
        
        <!-- /.col -->
      <?php } else { ?>
        <?php if (isset($reports_xtoken[0]['reporter_claims']) && $reports_xtoken[0]['reporter_claims']!="") { $data_reporter = $this->model_home->getDataUserxId($reports_xtoken[0]['reporter_claims']); } ?>
        <?php if (isset($reports_xtoken[0]['reporter_claims']) && $reports_xtoken[0]['reported_claims']!="") { $data_reported = $this->model_home->getDataUserxId($reports_xtoken[0]['reported_claims']); } ?>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Quejas y Reclamos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>Asunto: <strong><?= (isset($reports_xtoken[0]['subject_claims'])) ? $reports_xtoken[0]['subject_claims'] : '' ?></strong></h5>
                <h6>De: <?= (isset($data_reporter[0]['email_user'])) ? $data_reporter[0]['email_user'] : '' ?>
                <span class="mailbox-read-time float-right"><?= (isset($reports_xtoken[0]['date_claims'])) ? date('d M. Y H:i A', strtotime($reports_xtoken[0]['date_claims'])) : '' ?></span></h6>
              </div>
              <div class="mailbox-read-message">
                <br>
                <br>
                <p><strong>USUARIO QUE REPORTA:</strong></p>
                <h6><strong>Nombre: </strong><?= (isset($data_reporter[0]['name_user'])) ? $data_reporter[0]['name_user'] : '' ?><br>
                <h6><strong>Email: </strong><?= (isset($data_reporter[0]['email_user'])) ? $data_reporter[0]['email_user'] : '' ?><br><hr>
                  <?php if ($reports_xtoken[0]['reported_claims']!=0): ?>
                <p><strong>USUARIO REPORTADO:</strong></p>
                <h6><strong>Nombre: </strong><?= (isset($data_reported[0]['name_user'])) ? $data_reported[0]['name_user'] : '' ?><br>
                <h6><strong>Email: </strong><?= (isset($data_reported[0]['email_user'])) ? $data_reported[0]['email_user'] : '' ?><br><hr>
                  <?php endif ?>
                <p><strong>DESCRIPCIÓN DEL REPORTE:</strong></p>
                <?= (isset($reports_xtoken[0]['body_claims'])) ? nl2br($reports_xtoken[0]['body_claims']) : '' ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <?php if (isset($reports_xtoken[0]['attachment_claims']) && $reports_xtoken[0]['attachment_claims']!=""): ?>
             <div class="card-footer bg-white">
              <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                <li>
                  <span class="mailbox-attachment-icon has-img"><img style="width: 120px !important; padding: 10px !important;" src="<?= base_url('img/report/'.$reports_xtoken[0]['attachment_claims']) ?>" alt="Attachment"></span>
                  <div class="mailbox-attachment-info">
                    <a href="<?= base_url('img/report/'.$reports_xtoken[0]['attachment_claims']) ?>" download="<?= $reports_xtoken[0]['attachment_claims'] ?>" class="mailbox-attachment-name"><i class="fas fa-camera"></i> <?= $reports_xtoken[0]['attachment_claims'] ?></a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                      <a href="<?= base_url('img/report/'.$reports_xtoken[0]['attachment_claims']) ?>" download="<?= $reports_xtoken[0]['attachment_claims'] ?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                    </span>
                  </div>
                </li>
              </ul>
            </div>
          <?php endif ?>

                <img style="width: 35% !important; padding: 0px 20px 30px 20px !important;" src="<?= base_url('img/src/logo_black.png') ?>" alt="Logo Mylatindate">
        </div>
        <!-- /.card -->
      </div>
    <?php } ?>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>


    <script type="text/javascript">
      $(document).ready(function() {

        $(".btn-delete").click(function(e) {
          e.preventDefault();

          if(confirm("Se borrará este dato. ¿Está seguro?")) {

            var url        = "<?= base_url('Admin/delete_data') ?>";
            var col_valor  = $(this).data("delete");
            var table      = 'claims';
            var col_where  = 'id_claims';
            var path_image = '';
            var col_img    = '';

            $.ajax({
              url     : url,
              data    : {col_valor:col_valor,table:table,col_where:col_where,path_image:path_image,col_img:col_img},
              type    : "POST",
              success : function() {
                location.reload();
              }
            })
          }
        });
      });
    </script>