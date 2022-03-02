<?php $general_settings = $this->model_admin->settings(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description"
    content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['description_app'])) ?>">
  <meta property="og:site_name"
    content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta property="og:title"
    content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta property="og:description"
    content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['description_app'])) ?>">
  <meta name="language" content="es">
  <meta name="keywords" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= base_url() ?>">
  <meta property="og:image" content="<?= base_url('img/settings/'.$general_settings[0]['favicon_app']) ?>">
  <meta property="og:image:width" content="96">
  <meta property="og:image:height" content="96">
  <meta property="author" content="Juan Camilo Bolivar Ramirez">
  <meta name="copyright" content="<?= htmlspecialchars_decode(html_entity_decode($general_settings[0]['name_app'])) ?>">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" type="image/png" href="<?= base_url('img/settings/'.$general_settings[0]['favicon_app']) ?>">

  <title>Login - <?= $general_settings[0]['name_app'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?= base_url('Admin') ?>"><img style="width: 85% !important;"
          src="<?= base_url('img/settings/'.$general_settings[0]['logo_app']) ?>"
          alt="Logo <?= $general_settings[0]['name_app'] ?>"></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="alert-danger d-none" style="padding: 10px 20px;"></div>
        <p class="login-box-msg">Inicia sesión para comenzar</p>

        <form action="<?= base_url('index.php/Admin/Signin') ?>" method="POST" id="form-login-admin">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" id="btn-login-admin">Iniciar sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



        <!-- Button trigger modal -->
        <button type="button" class="btn w-100 mt-3 text-primary" data-toggle="modal" data-target="#exampleModal">
          Recuperar contrase&ntilde;a
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recuperación de contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="alert d-none" role="alert" id="alert"></div>
                <form action="<?= base_url('index.php/Admin/Recovery') ?>" method="POST" id="formRemember">
                  <div class="form-group">
                    <label for="rememberpass">Dirección de correo electrónico</label>
                    <input type="email" class="form-control" id="rememberpass" placeholder="my@email.com" required>
                  </div>
                  <button type="submit" class="w-100 btn btn-primary rebemberPass">
                    Enviar
                  </button>
                </form>
                <!-- Forgot Password -->
                <form action="<?= base_url('index.php/Admin/NewPass') ?>" method="POST" id="forgotPass" class="d-none">
                <input type="hidden" id="idUser">
                  <div class="form-group">
                    <label for="rememberpass">Nueva contraseña</label>
                    <input type="password" class="form-control" id="passnew" placeholder="Nueva contraseña" required minlength="10" maxlength="15">
                  </div>
                  <div class="form-group mt-2">
                    <label for="rememberpass">Verificar contraseña</label>
                    <input type="password" class="form-control" id="passnewver" placeholder="Verificar contraseña" required minlength="10" maxlength="15">
                  </div>
                  <button type="submit" class="w-100 btn btn-primary forgotPass">
                    Recuperar
                  </button>
                </form>
                <!-- Verify code -->
                <form class="d-none" id="codeVerForm">
                  <input type="hidden" id="code_ver">
                  <div class="form-group">
                    <label for="rememberpass">Código</label>
                    <input type="text" class="form-control" id="codeVerify" placeholder="Verificación de email" required minlength="8" maxlength="15">
                  </div>
                  <button type="submit" class="w-100 btn btn-primary verifyCode">
                    Continuar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>




      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>

  <script type="text/javascript">
    $(document).ready(function () {


      $("#form-login-admin").on("submit", function (event) {
        event.preventDefault();

        var $btn = $('#btn-login-admin');
        var $txt = $btn.text();
        $btn.prop('disabled', true);
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
          success: function (obj) {

            if (obj.result == 'KO') {

              $(".alert-danger").removeClass("d-none");
              $(".alert-danger").html(obj.errorTexto);
              $btn.prop('disabled', false);
              $btn.text($txt);
              $('html, body').animate({
                scrollTop: 0
              }, 1500, 'swing');

            } else if (obj.result == 'OK') {
              window.location.href = "<?= base_url("index.php/Admin ") ?>";
              $btn.text('Iniciando sesión...');
            }
          }
        });
      });
      function Alertme(text, type) {
        $('#alert').html(text)
        $('#alert').removeClass('d-none');
        $('#alert').addClass('alert-' + type);
        setTimeout(() => {
          $('#alert').addClass('d-none').removeClass('alert-' + type);
        }, 2000);
      }

      $('#formRemember').on('submit', function (e) {
        e.preventDefault();
        const URL = $(this).attr('action')
        const method = $(this).attr('method')
        const data = $('#rememberpass').val()
        $.ajax({
          url: URL,
          method: method,
          data: data,
          success: function (res) {
              console.log(res)
            const json = $.parseJSON(res);
            console.log(json)
            if (json != 'noval') {
              $('#idUser').val(json[0].id_admin)
              $('#code_ver').val(json['cod_ver'])
              $('.modal-title').html('Verificación de email')
              $('#codeVerForm').removeClass('d-none')
              $('#formRemember').addClass('d-none');
            } else {
              Alertme('Verifique e intente de nuevo', 'danger')
            }
          }
        })
      });



      $('.verifyCode').on('click', function(e) {
        e.preventDefault();
        if ($('#codeVerify').val() == $('#code_ver').val()) {
          $('.modal-title').html('Ingrese su nueva contraseña')
          $('#forgotPass').removeClass('d-none');
          $('#formRemember').addClass('d-none');
          $('#codeVerForm').addClass('d-none')
        }else{
          Alertme('Verifique e intente de nuevo', 'danger')
        }
      });



      $('#forgotPass').on('submit', function (e) {
        e.preventDefault();
        const URL = $(this).attr('action')
        const method = $(this).attr('method')
        const pass = $('#passnew').val()
        const newPass = $('#passnewver').val()
        const idUser = $('#idUser').val()
        const data = {'id_user': idUser, 'new_pass': newPass};
        if (pass === newPass) {
          $.ajax({
            url: URL,
            method: method,
            data: data,
            success: function (res) {
              if (res == "val") {
                Alertme('¡Recuperación exitosa!', 'success')
                setTimeout(() => {
                  location.reload();
                }, 200);
              }else {
               Alertme('Lo sentimos, ha ocurrido un error...', 'danger')
              }
            }
          })
        } else {
         Alertme('Las contraseñas no conciden', 'danger')
        }
      });


      




    });
  </script>

</body>

</html>