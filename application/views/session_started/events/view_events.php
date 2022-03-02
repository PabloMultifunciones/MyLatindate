<div class="container">
	<div class="row">
		<?php
		$index=0; 
		for ($i=0; $i < count($events); $i++) {
			$assitance = $this->model_home->assitance($id_user, $events[$i]['token_event']);
			$status_assistance = 0;
			if (isset($assitance) && count($assitance) > 0) {
				$status_assistance = $assitance[0]['status_assistance'];
			} else {
				$status_assistance = 0;
			}
			?>
			<div class="col-md-4 p-t-40" <?php if ($index==$i) { echo 'style="background-color: #f0f8ff;"'; $index=$index+2; } ?>>
				<h5 class="text-uppercase"><strong><?= htmlspecialchars_decode(html_entity_decode($events[$i]['name_event'])) ?></strong></h5>
				<p class="m-0"><strong>Fecha inicio: </strong><?= $events[$i]['date_from_event'] ?></p>
				<p><strong>Fecha finalización: </strong><?= $events[$i]['date_to_event'] ?></p>
				<p><strong>Lugar: </strong>
					<?= (isset($events[$i]['city_event']) && $events[$i]['city_event']!="") ? explode(",", $events[$i]['city_event'])[1].', ' : '' ?>
					<?= (isset($events[$i]['state_event']) && $events[$i]['state_event']!="") ? explode(",", $events[$i]['state_event'])[1].', ' : '' ?>
					<?= (isset($events[$i]['country_event']) && $events[$i]['country_event']!="") ? explode(",", $events[$i]['country_event'])[1] : '' ?>
				</p>

				<p><strong>Descripción: </strong><br><?= nl2br(htmlspecialchars_decode(html_entity_decode($events[$i]['description_event']))) ?></p>
				
				<?= ($status_assistance==1) ? '<div class="alert alert-info m-0" role="alert"><i class="fa fa-bell text-info"></i> Asistirás a este evento</div><br>' : '' ?>
				<?= ($status_assistance==2) ? '<div class="alert alert-danger m-0" role="alert"><i class="fa fa-bell text-danger"></i> No asistirás a este evento</div><br>' : '' ?>

				<?php if ($status_assistance==0) { ?>

					<button class="btn btn-success btn-enable" data-enable="<?= $events[$i]['token_event'] ?>" title="Asistiré al evento">Asistiré</button>
					<button class="btn btn-danger btn-disable" data-disable="<?= $events[$i]['token_event'] ?>" title="No asistiré al evento">No asistiré</button>

				<?php } else if ($status_assistance==1) { ?>

					<button class="btn btn-danger btn-disable" data-disable="<?= $events[$i]['token_event'] ?>" title="No asistiré al evento">No asistiré</button>
				<?php } else if ($status_assistance==2) { ?>

					<button class="btn btn-success btn-enable" data-enable="<?= $events[$i]['token_event'] ?>" title="Asistiré al evento">Asistiré</button>
				<?php } ?>
				<br><br>
			</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$(".btn-disable").click(function(e) {
			e.preventDefault();

			if(confirm("No asistirás al evento. ¿Está seguro?")) {

				var url               = "<?= base_url('Home/update_status_event') ?>";
				var token_assistance  = $(this).data("disable");
				var status_assistance = 2;
				var id_user           = "<?= $id_user ?>";

				$.ajax({
					url     : url,
					data    : {token_assistance:token_assistance,status_assistance:status_assistance,id_user:id_user},
					type    : "POST",
					success : function() {
						location.reload();
					}
				})
			}
		});

		$(".btn-enable").click(function(e) {
			e.preventDefault();

			if(confirm("Asistirás al evento. ¿Está seguro?")) {

				var $btn = $('.btn-enable');
				var $txt = $btn.text();
				$btn.prop('disabled',true);
				$btn.text('Confirmando, por favor espere...');

				var url               = "<?= base_url('Home/update_status_event') ?>";
				var token_assistance  = $(this).data("enable");
				var status_assistance = 1;
				var id_user           = "<?= $id_user ?>";

				$.ajax({
					url     : url,
					data    : {token_assistance:token_assistance,status_assistance:status_assistance,id_user:id_user},
					type    : "POST",
					success : function() {
						location.reload();
					}
				})
			}
		});
	});
</script>