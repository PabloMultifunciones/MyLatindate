<?php
$is_open = $this->uri->segment(3);
$verify  = $this->uri->segment(4);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Verificaciones</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Verificaciones</li>
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
                <a href="<?= base_url('Admin/Verify') ?>" class="nav-link">
                  <i class="fas fa-inbox"></i> Bandeja de entrada
                  <span class="badge bg-primary float-right"><?= (isset($count_verify_users)) ? count($count_verify_users) : '0' ?></span>
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
              <h3 class="card-title">Verificaciones</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="table3" class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Asunto</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=0; $i < count($verify_users); $i++) {

                    $data_verify = $this->model_home->getDataUserxId($verify_users[$i]['id_user']);
                    ?>
                    <tr>
                      <td style="width: 20%"><a href="<?= base_url('Admin/Verify/'.$verify_users[$i]['id_verify']) ?>" style="<?= ($verify_users[$i]['status_verify']==0) ? 'color:#808B96;' : 'font-weight: bolder;' ?>"><?= $data_verify[0]['name_user'] ?></a></td>
                      <td style="width: 60%"><b>Verificación pendiente</b> - <?= $data_verify[0]['name_user'] . " ha enviado una solicitud para verificar su cuenta." ?></td>
                      <td style="width: 20%"><?= date("M j, Y", strtotime($verify_users[$i]['date_verify'])) ?></td>
                      <td><a style="width: 32px;" class="btn btn-sm btn-danger btn-delete text-white" data-delete="<?= $verify_users[$i]['id_verify'] ?>" title="Eliminar cuenta de usuario"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php } ?> 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      <?php } else { ?>
        <?php if (isset($verify_xid[0]['id_verify']) && $verify_xid[0]['id_verify']!="") { $data_verify_account = $this->model_home->getDataUserxId($verify_xid[0]['id_user']); } ?>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Verificación de cuenta</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <?php if ($verify=='Sfd34waf34AAs'): ?>
                  <div style="background-color: #d4edda; color: #155724; padding: 10px; margin: 5px 0px;">Cuenta verificada exitosamente.</div>
                <?php endif ?>
                <?php if ($verify=='Nfd34waf34AAs'): ?>
                  <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 5px 0px;">La verificación ha sido rechazada.</div>
                <?php endif ?>
                <h5>Asunto: <strong>Nueva verificación de cuenta</strong></h5>
                <h6>De: <?= (isset($data_verify_account[0]['email_user'])) ? $data_verify_account[0]['email_user'] : '' ?>
                <span class="mailbox-read-time float-right"><?= (isset($reports_xtoken[0]['date_claims'])) ? date('d M. Y H:i A', strtotime($reports_xtoken[0]['date_claims'])) : '' ?></span></h6>
              </div>
              <div class="mailbox-read-message">
                <br>
                <br>
                <p><strong>DATOS DE USUARIO:</strong></p>
                <h6><strong>Nombre: </strong><?= (isset($data_verify_account[0]['name_user'])) ? $data_verify_account[0]['name_user'] : '' ?><br>
                  <h6><strong>Email: </strong><?= (isset($data_verify_account[0]['email_user'])) ? $data_verify_account[0]['email_user'] : '' ?><br><hr>
                    <p><strong>DESCRIPCIÓN:</strong></p>
                    <p>El usuario <strong><?= $data_verify_account[0]['name_user'] ?></strong> ha enviado una solicitud para verificar su cuenta.</p>
                    <p>Revisa su tarjeta de identificación y acepta o rechaza su verificación.</p><br>
                    <p>Presiona <a href="<?= base_url('home/verify_account/accept/'.$data_verify_account[0]['id_user'].'/'.$verify_xid[0]['id_verify']) ?>">clic aquí</a> para verificar la cuenta.</p>
                    <p>Presiona <a href="<?= base_url('home/verify_account/decline/'.$data_verify_account[0]['id_user'].'/'.$verify_xid[0]['id_verify']) ?>">clic aquí</a> para rechazar la verificación y pedir que envie un nuevo documento.</p>
                  </div>
                  <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                <?php if (isset($verify_xid[0]['img_verify']) && $verify_xid[0]['img_verify']!=""): ?>
                 <div class="card-footer bg-white">
                  <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                      <span class="mailbox-attachment-icon has-img"><img style="width: 120px !important; padding: 10px !important;" 
                        src="<?= base_url('img/profile/verify/'.$verify_xid[0]['img_verify']) ?>" alt="Attachment"></span>
                        <div class="mailbox-attachment-info">
                          <a href="<?= base_url('img/profile/verify/'.$verify_xid[0]['img_verify']) ?>" download="<?= $verify_xid[0]['img_verify'] ?>" class="mailbox-attachment-name"><i class="fas fa-camera"></i> <?= $verify_xid[0]['img_verify'] ?></a>
                          <span class="mailbox-attachment-size clearfix mt-1">
                            <a href="<?= base_url('img/profile/verify/'.$verify_xid[0]['img_verify']) ?>" download="<?= $verify_xid[0]['img_verify'] ?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
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
            var table      = 'verify';
            var col_where  = 'id_verify';
            var path_image = 'verify';
            var col_img    = 'img_verify';

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