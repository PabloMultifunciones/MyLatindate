<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Eventos</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Eventos</li>
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
              Administración de Eventos
            </h3>
          </div>
          <!-- /.card-header -->
          <form id="add-event" action="<?= base_url('Admin/create_edit_event/') ?>" method="POST" enctype="multipart/form-data">
            <div class="card-body pad">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="alert-danger d-none" style="padding: 10px 20px;"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name_event">Nombre del evento</label>
                    <input type="text" class="form-control" name="name_event" id="name_event" placeholder="Nombre del evento" value="<?= (isset($events_xtoken) && $events_xtoken[0]['name_event']!="") ? htmlspecialchars_decode(html_entity_decode($events_xtoken[0]['name_event'])) : '' ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="addressedto_event">Evento dirijido a</label>
                    <select class="form-control" name="addressedto_event" id="addressedto_event">
                      <option value="3" <?= (isset($events_xtoken) && $events_xtoken[0]['addressedto_event']=="3") ? 'selected' : '' ?>>Todos</option>
                      <option value="1" <?= (isset($events_xtoken) && $events_xtoken[0]['addressedto_event']=="1") ? 'selected' : '' ?>>Hombres</option>
                      <option value="2" <?= (isset($events_xtoken) && $events_xtoken[0]['addressedto_event']=="2") ? 'selected' : '' ?>>Mujeres</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description_event">Descripción del evento</label>
                    <textarea class="form-control" name="description_event" id="description_event" style="height: 150px; resize: none;"><?= (isset($events_xtoken) && $events_xtoken[0]['description_event']!="") ? htmlspecialchars_decode(html_entity_decode($events_xtoken[0]['description_event'])) : '' ?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_from_event">Fecha de inicio</label>
                    <input type="date" class="form-control" id="date_from_event" name="date_from_event" value="<?= (isset($events_xtoken) && $events_xtoken[0]['date_from_event']!="") ? $events_xtoken[0]['date_from_event'] : '' ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_to_event">Fecha de finalización</label>
                    <input type="date" class="form-control" id="date_to_event" name="date_to_event" value="<?= (isset($events_xtoken) && $events_xtoken[0]['date_to_event']!="") ? $events_xtoken[0]['date_to_event'] : '' ?>">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="date_to_event">País</label>
                    
                    <select class="form-control" id="country_event" name="country_event">
                      <option value=""><?= lang('please_select') ?>...</option>
                      <?php foreach ($country->result() as $key) {
                        echo "<option value='".$key->id.",".$key->name."'";
                        if (isset($events_xtoken[0]['country_event']) && $events_xtoken[0]['country_event'] == $key->id.",".$key->name) {
                         echo "selected";
                       } else {
                        echo "";
                      }
                      echo ">".$key->name."</option>";
                    }
                    ?>
                  </select>

                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="date_to_event">Estado/provincia</label>

                  <select class="form-control" id="state_event" name="state_event">
                    <option value=""><?= lang('please_select') ?>...</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="date_to_event">Ciudad</label>

                  <select class="form-control" id="city_event" name="city_event">
                    <option value=""><?= lang('please_select') ?>...</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="attachment_event">Ajunto del evento</label><br>
                  <input type="file" id="attachment_event" name="attachment_event">
                  <input type="hidden" id="attachment_event_sec" name="attachment_event_sec" value="<?= (isset($events_xtoken) && $events_xtoken[0]['attachment_event']!="") ? $events_xtoken[0]['attachment_event'] : '' ?>">
                  <br>
                  <small style="color: #9f9f9f">* Cargue el adjunto en los siguientes formatos recomendados: PDF.</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch"><br>
                    <input type="checkbox" class="custom-control-input" id="status_event" name="status_event" <?= (isset($events_xtoken[0]['status_event']) && $events_xtoken[0]['status_event']==1) ? 'checked' : '' ?>>
                    <label class="custom-control-label" for="status_event">Activo</label>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <input type="hidden" class="form-control" id="id_event" name="id_event" value="<?= (isset($events_xtoken[0]['id_event']) && $events_xtoken[0]['id_event']!="") ? $events_xtoken[0]['id_event'] : '' ?>">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" id="btn-add-event" class="btn btn-primary">Guardar cambios</button>
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

    $("#add-event").on("submit", function(event) {
      event.preventDefault();

      var $btn = $('#btn-add-event');
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
            window.location.href = "<?= base_url("Admin/Events") ?>";
            $btn.text('Subiendo datos, por favor espere...');
          }
        }
      });
    });

    var id_country = "<?= (isset($events_xtoken[0]['country_event']) && $events_xtoken[0]['country_event']!="") ? $events_xtoken[0]['country_event'] : '' ?>";
    var id_state   = "<?= (isset($events_xtoken[0]['state_event']) && $events_xtoken[0]['state_event']!="") ? $events_xtoken[0]['state_event'] : '' ?>";
    var id_city    = "<?= (isset($events_xtoken[0]['city_event']) && $events_xtoken[0]['city_event']!="") ? $events_xtoken[0]['city_event'] : '' ?>";

    if (id_country!="") {

      var id_country_split = id_country.split(",");

      var url = '<?= (base_url('home/getState/')) ?>' + id_country_split[0];

      $.ajax({
        url     :     url,
        data    :     {id_state,id_state},
        type    :     "POST",
        success :     function(response) {
          $("#state_event").html(response);
        }
      });
    }

    if (id_state!="") {

      var id_state_split = id_state.split(",");

      var url = '<?= (base_url('home/getCity/')) ?>' + id_state_split[0];

      $.ajax({
        url     :     url,
        data    :     {id_city,id_city},
        type    :     "POST",
        success :     function(response) {
          $("#city_event").html(response);
        }
      })
    }


    $("#country_event").on("change", function() {

      var id_country = $("#country_event").val();
      var id_country_split = id_country.split(",");

      var url = '<?= (base_url('home/getState/')) ?>' + id_country_split[0];

      $.ajax({
        url     :     url,
        type    :     "POST",
        success :     function(response) {
          $("#state_event").html(response);
        }
      })
    });

    $("#state_event").on("change", function() {

      var id_state = $("#state_event").val();
      var id_state_split = id_state.split(",");

      var url = '<?= (base_url('home/getCity/')) ?>' + id_state_split[0];

      $.ajax({
        url     :     url,
        type    :     "POST",
        success :     function(response) {
          $("#city_event").html(response);
        }
      })
    });
  });
</script>
