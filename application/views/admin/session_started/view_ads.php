<?php
$place = $this->uri->segment(3);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Anuncios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Home</a></li>
            <li class="breadcrumb-item active">Anuncios</li>
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
            <h3 class="card-title">Configuración</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                <a href="<?= base_url('Admin/Ads') ?>" class="nav-link">
                  <i class="fas fa-ad"></i> Anuncios
                </a>
              </li>
              <li class="nav-item active">
                <a href="<?= base_url('Admin/Ads/Handling_Ads') ?>" class="nav-link">
                  <i class="fas fa-plus-square"></i> Crear Anuncio
                </a>
              </li>
              <li class="nav-item active">
                <a href="<?= base_url('Admin/Ads/Settings') ?>" class="nav-link">
                  <i class="fas fa-cog"></i> Ajustes
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

      <?php if ($place=="") { ?>

        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Anuncios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table3" class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=0; $i < count($ads); $i++) {
                    ?>
                    <tr>
                      <td style="width: 30%">
                        <img class="w-100" style="height: 120px !important;" src="<?= base_url('img/ads/'.$ads[$i]['banner_ads']) ?>" alt="Anuncio - <?= $ads[$i]['banner_ads'] ?> - Mylatindate.com">
                      </td>
                      <td style="width: 15%"><?= htmlspecialchars_decode(html_entity_decode($ads[$i]['name_ads'])) ?></td>
                      <td style="width: 10%">
                        <?= ($ads[$i]['priority_ads']==0) ? 'Baja' : '' ?>
                        <?= ($ads[$i]['priority_ads']==1) ? 'Normal' : '' ?>
                        <?= ($ads[$i]['priority_ads']==3) ? 'Alta' : '' ?>
                      </td>
                      <td style="width: 10%"><?= ($ads[$i]['status_ads']==1) ? '<a class="btn btn-sm btn-success text-white">Activo</a>' : '<a class="btn btn-sm btn-warning">Inactivo</a>' ?></td>
                      <td style="width: 15%"><?= date("M j, Y", strtotime($ads[$i]['date_ads'])) ?></td>
                      <td style="width: 15%">
                        <a style="width: 32px;" class="btn btn-sm btn-success" href="<?= base_url('Admin/Ads/Handling_Ads/'.$ads[$i]['token_ads']) ?>" title="Editar"> 
                         <i class="fa fa-edit"></i>
                       </a>
                       &nbsp;&nbsp;
                       <a style="width: 32px;" class="btn btn-sm btn-danger btn-delete text-white" data-delete-ads="<?= $ads[$i]['id_ads'] ?>" title="Eliminar"> 
                         <i class="fa fa-trash"></i>
                       </a>
                     </td>
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
     <?php } else if ($place=="Handling_Ads") { ?>

       <!-- /.col-header -->
       <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Crear Anuncio</h3>
          </div>
          <!-- form start -->
          <form id="form_ads" action="<?= base_url('Admin/Handling_Ads/') ?>" method="POST" enctype="multipart/form-data">
            <div class="alert-danger d-none" style="padding: 10px !important;"></div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="name_ad">Nombre del anuncio</label>
                    <input type="text" class="form-control" name="name_ads" id="name_ads" value="<?= (isset($edit_ads[0]['name_ads'])) ? htmlspecialchars_decode(html_entity_decode($edit_ads[0]['name_ads'])) : '' ?>" placeholder="Nombre del anuncio">
                  </div>
                  <div class="col-md-6">
                    <label for="priority_ad">Prioridad del anuncio</label>
                    <select name="priority_ads" id="priority_ads" class="form-control">
                      <option value="">Seleccionar prioridad</option>
                      <option value="3" <?= (isset($edit_ads[0]['priority_ads'])) ? ($edit_ads[0]['priority_ads'] == "3") ? 'selected' : '' : '' ?>>Alta</option>
                      <option value="1" <?= (isset($edit_ads[0]['priority_ads'])) ? ($edit_ads[0]['priority_ads'] == "1") ? 'selected' : '' : '' ?>>Normal</option>
                      <option value="0" <?= (isset($edit_ads[0]['priority_ads'])) ? ($edit_ads[0]['priority_ads'] == "0") ? 'selected' : '' : '' ?>>Baja</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="url_ad">¿Lleva url?</label>
                <input type="text" class="form-control" name="url_ads" id="url_ads" value="<?= (isset($edit_ads[0]['url_ads'])) ? $edit_ads[0]['url_ads'] : '' ?>" placeholder="Url del anuncio">
              </div>
              <div class="form-group">
                <label for="banner_ads">Banner del anuncio</label><br>
                <input type="file" name="banner_ads" id="banner_ads"><br>
                <input type="hidden" name="banner_ads_sec" id="banner_ads_sec" value="<?= (isset($edit_ads[0]['banner_ads'])) ? $edit_ads[0]['banner_ads'] : '' ?>">
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status_ads" id="status_ads" <?= (isset($edit_ads[0]['status_ads'])) ? ($edit_ads[0]['status_ads'] == "1") ? 'checked' : '' : 'checked' ?> >
                <label class="form-check-label" for="status_ad">Activo</label>
              </div>
              <input type="hidden" name="token_ads" id="token_ads" value="<?= (isset($edit_ads[0]['token_ads'])) ? $edit_ads[0]['token_ads'] : '' ?>">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" id="btn_ads" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.col -->
    <?php } else if ($place=="Settings") { ?>

     <!-- /.col-header -->
     <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Personalizar anuncios</h3>
        </div>
        <!-- form start -->
        <form action="<?= base_url('Admin/Ads_settings/') ?>" method="POST">
          <div class="alert-danger d-none" style="padding: 10px !important;"></div>
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="name_ad">Intensidad del anuncio</label>
                  <input type="number" min="0" class="form-control" name="intensity_settings" id="intensity_settings" value="<?= $ads_settings[0]['intensity_settings'] ?>" placeholder="Intensidad del anuncio">
                </div>
                <div class="col-md-6">
                  <label for="priority_ad">Prioridad del anuncio</label>
                  <select name="priority_settings" id="priority_settings" class="form-control">
                    <option value="3" <?= ($ads_settings[0]['priority_settings'] == 3) ? 'selected' : '' ?>>Alta</option>
                    <option value="2" <?= ($ads_settings[0]['priority_settings'] == 2) ? 'selected' : '' ?>>Aleatoria</option>
                    <option value="1" <?= ($ads_settings[0]['priority_settings'] == 1) ? 'selected' : '' ?>>Normal</option>
                    <option value="0" <?= ($ads_settings[0]['priority_settings'] == 0) ? 'selected' : '' ?>>Baja</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" id="btn_ads" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.col -->
  <?php } ?>
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>


<script type="text/javascript">
  $(document).ready(function() {

    $("#form_ads").on("submit", function(event) {
      event.preventDefault();

      var $btn = $('#btn_ads');
      var $txt = $btn.text();
      $btn.prop('disabled',true);
      $btn.text('Validando datos...');
      $action = $(this).attr('action');
      $method = $(this).attr('method');
      $.ajax({
        type: $method,
        url: $action,
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(obj) {

          if(obj.result == 'KO') {

            $(".alert-danger").removeClass("d-none");
            $(".alert-danger").html(obj.errorTexto);
            $btn.prop('disabled',false);
            $btn.text($txt);
            $('html, body').animate({scrollTop:0}, 1500, 'swing');

          } else if(obj.result == 'OK') {
            window.location.href = "<?= base_url("Admin/Ads") ?>";
            $btn.text('Creando anuncio...');
          }
        }
      });
    });

    $(".btn-delete").click(function(e) {
      e.preventDefault();

      if(confirm("¿Está seguro que desea eliminar este anuncio?")) {

        var url    = "<?= base_url('Admin/Delete_ads') ?>";
        var id_ads = $(this).data("delete-ads");

        $.ajax({
          url     : url,
          data    : {id_ads:id_ads},
          type    : "POST",
          success : function() {
            location.reload();
          }
        })
      }
    });
  });
</script>
