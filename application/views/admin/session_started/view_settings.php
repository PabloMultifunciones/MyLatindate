<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Configuración</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Configuración</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title">
              Configuración General
            </h3>
          </div>
          <!-- /.card-header -->
          <form id="add-settings" action="<?= base_url('Admin/edit_settings/') ?>" method="POST">
            <div class="card-body pad">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="alert-danger d-none" style="padding: 10px 20px;"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <h5>Información de la aplicación</h5>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name_app">Nombre de la aplicación</label>
                    <input type="text" class="form-control" id="name_app" name="name_app" placeholder="Nombre de la aplicación" value="<?= (isset($settings[0]['name_app'])) ? htmlspecialchars_decode(html_entity_decode($settings[0]['name_app'])) : '' ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description_app">Descripción de la aplicación</label>
                    <textarea style="height: 100px; resize: none;" class="form-control" id="description_app" name="description_app" placeholder="Descripción del aplicación"><?= (isset($settings[0]['description_app'])) ? htmlspecialchars_decode(html_entity_decode($settings[0]['description_app'])) : '' ?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="icon_product">Favicon de la aplicación</label>
                    <br>
                    <img id="favicon" style="width: 5%; padding-bottom: 10px;" src="<?= base_url('img/settings/'.$settings[0]['favicon_app']) ?>" alt="Imagen de la aplicación - <?= $settings[0]['name_app'] ?>">
                    <br>
                    <input type='file' id="favicon_app" name="favicon_app" onchange="readURL(this, 'favicon');">
                    <input type='hidden' id="img_product_sec" name="favicon_app_sec" value="<?= (isset($settings[0]['favicon_app'])) ? $settings[0]['favicon_app'] : '' ?>">

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="icon_product">Logo de la aplicación</label>
                    <br>
                    <img id="logo" style="width: 50%; padding-bottom: 10px;" src="<?= base_url('img/settings/'.$settings[0]['logo_app']) ?>" alt="Imagen de la aplicación - <?= $settings[0]['name_app'] ?>">
                    <br>
                    <input type='file' id="logo_app" name="logo_app" onchange="readURL(this, 'logo');">
                    <input type='hidden' id="img_product_sec" name="logo_app_sec" value="<?= (isset($settings[0]['logo_app'])) ? $settings[0]['logo_app'] : '' ?>">

                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" id="btn-add-settings" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->


  <script type="text/javascript">
    $(document).ready(function() {

      $("#add-settings").on("submit", function(event) {
        event.preventDefault();

        var $btn = $('#btn-add-settings');
        var $txt = $btn.text();
        $btn.prop('disabled',true);
        $btn.text('Validando datos, por favor espere...');
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
              window.location.href = "<?= base_url("Admin/Config") ?>";
              $btn.text('Subiendo datos, por favor espere...');
            }
          }
        });
      });
    });

    function readURL(input, place) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#'+place)
          .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>