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

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box">
						<a href="<?= base_url('Admin/Users/Woman') ?>" class="info-box-icon elevation-1 text-white bg-info">
							<i class="fa fa-calendar-alt"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Eventos registrados</span>
							<span class="info-box-number">
								<?= count($events) ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box mb-3">
						<a href="<?= base_url('Admin/Users/Man') ?>" class="info-box-icon elevation-1 text-white bg-success">
							<i class="fas fa-calendar-check"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Eventos activos</span>
							<span class="info-box-number">
								<?= count($events_active) ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<!-- fix for small devices only -->
				<div class="clearfix hidden-md-up"></div>

				<!-- /.col -->
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box mb-3">
						<a href="<?= base_url('Admin/Users/YSubs') ?>" class="info-box-icon bg-danger elevation-1">
							<i class="fas fa-calendar-times"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Eventos inactivos</span>
							<span class="info-box-number">
								<?= count($events_inactive) ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box mb-3">
						<a href="<?= base_url('Admin/Handling_Event/') ?>" class="info-box-icon bg-primary elevation-1">
							<i class="fas fa-calendar-plus"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Crear nuevo evento</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Eventos</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="table1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 15%">Nombre</th>
										<th style="width: 10%">Para</th>
										<th style="width: 30%">Descipción</th>
										<th style="width: 20%">Fecha</th>
										<th style="width: 5%">Estado</th>
										<th style="width: 20%">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									for ($i=0; $i < count($events); $i++) {
										?>
										<tr>
											<td><?= htmlspecialchars_decode(html_entity_decode($events[$i]['name_event'])) ?></td>
											<td>
												<?= ($events[$i]['addressedto_event']=="1") ? 'Hombres' : '' ?>
												<?= ($events[$i]['addressedto_event']=="2") ? 'Mujeres' : '' ?>
												<?= ($events[$i]['addressedto_event']=="3") ? 'Todos' : '' ?>
											</td>
											<td><?= htmlspecialchars_decode(html_entity_decode(substr($events[$i]['description_event'], 0, 100))).'...' ?></td>
											<td>
												<strong>Desde:</strong> <?= $events[$i]['date_from_event'] ?>
												<br>
												<strong>Hasta:</strong> <?= $events[$i]['date_to_event'] ?>
											</td>
											<td>
												<?= ($events[$i]['status_event']==0) ? '<button class="btn bg-secondary">Inactivo</button>' : '' ?>
												<?= ($events[$i]['status_event']==1) ? '<button class="btn bg-success">Activo</button>' : '' ?>
											</td>
											<td>
												<a style="width: 32px;" class="btn btn-sm btn-info" href="<?= base_url('Admin/Event_Assistance/'.$events[$i]['token_event']) ?>" title="Ver asistencias confirmadas"> 
													<i class="fa fa-eye"></i>
												</a>

												<a style="width: 32px;" class="btn btn-sm btn-dark" href="<?= base_url('Admin/Handling_Event/'.$events[$i]['token_event']) ?>" title="Editar evento"> 
													<i class="fa fa-edit"></i>
												</a>
												
												<?php if ($events[$i]['status_event']==0) { ?>

													<a style="width: 32px;" class="btn btn-sm btn-warning btn-enable text-dark" data-enable="<?= $events[$i]['id_event'] ?>" title="Activar evento"> 
														<i class="fa fa-exclamation-triangle"></i>
													</a>
												<?php } else if ($events[$i]['status_event']==1) { ?>

													<a style="width: 32px;" class="btn btn-sm btn-success btn-disable text-white" data-disable="<?= $events[$i]['id_event'] ?>" title="Inactivar evento"> 
														<i class="fa fa-exclamation-triangle"></i>
													</a>
												<?php } ?>
												<a style="width: 32px;" class="btn btn-sm btn-danger btn-delete text-white" data-delete="<?= $events[$i]['id_event'] ?>" title="Eliminar evento"> 
													<i class="fa fa-trash"></i>
												</a></td>
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
				</div>
			</div>
		</section>
		<!-- /.content -->
	</div>

	<script type="text/javascript">
		$(document).ready(function() {

			$(".btn-delete").click(function(e) {
				e.preventDefault();

				if(confirm("Se borrará este evento. ¿Está seguro?")) {

					var url        = "<?= base_url('Admin/delete_data') ?>";
					var col_valor  = $(this).data("delete");
					var table      = 'events';
					var col_where  = 'id_event';
					var path_image = 'events';
					var col_img    = 'attachment_event';

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

			$(".btn-disable").click(function(e) {
				e.preventDefault();

				if(confirm("Se desactivará este evento. ¿Está seguro?")) {

					var url        = "<?= base_url('Admin/update_status') ?>";
					var col_valor  = $(this).data("disable");
					var status     = 0;
					var table      = 'events';
					var col_update = 'status_event';
					var col_where  = 'id_event';

					$.ajax({
						url     : url,
						data    : {col_valor:col_valor,status:status,table:table,col_update:col_update,col_where:col_where},
						type    : "POST",
						success : function() {
							location.reload();
						}
					})
				}
			});

			$(".btn-enable").click(function(e) {
				e.preventDefault();

				if(confirm("Se activará este evento. ¿Está seguro?")) {

					var url        = "<?= base_url('Admin/update_status') ?>";
					var col_valor  = $(this).data("enable");
					var status     = 1;
					var table      = 'events';
					var col_update = 'status_event';
					var col_where  = 'id_event';

					$.ajax({
						url     : url,
						data    : {col_valor:col_valor,status:status,table:table,col_update:col_update,col_where:col_where},
						type    : "POST",
						success : function() {
							location.reload();
						}
					})
				}
			});
		});
	</script>