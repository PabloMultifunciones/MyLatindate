<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Confirmación de evento</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Inicio</a></li>
						<li class="breadcrumb-item active">Confirmación de evento</li>
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
				<div class="col-12 col-sm-6 col-md-4">
					<div class="info-box mb-3">
						<a class="info-box-icon elevation-1 text-white bg-success">
							<i class="fas fa-calendar-check"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Asistirán</span>
							<span class="info-box-number">
								<?= count($assistance_active) ?>
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
				<div class="col-12 col-sm-6 col-md-4">
					<div class="info-box mb-3">
						<a class="info-box-icon bg-danger elevation-1">
							<i class="fas fa-calendar-times"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">No asistirán</span>
							<span class="info-box-number">
								<?= count($assistance_inactive) ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title text-uppercase"><strong><?= htmlspecialchars_decode(html_entity_decode($events[0]['name_event'])) ?></strong></h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="table1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 25%">Nombre</th>
										<th style="width: 25%">Email</th>
										<th style="width: 20%">Genero</th>
										<th style="width: 15%">Estado</th>
										<th style="width: 15%">Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if (isset($assistance) && count($assistance) > 0) {

										for ($i=0; $i < count($assistance); $i++) {
											$user = $this->model_admin->user_xid($assistance[$i]['id_user']);
											?>
											<tr>
												<td><?= htmlspecialchars_decode(html_entity_decode($user[0]['name_user'])) ?></td>
												<td><?= $user[0]['email_user'] ?></td>
												<td>
													<?= ($user[0]['gender_user']=="1") ? 'Hombre' : '' ?>
													<?= ($user[0]['gender_user']=="2") ? 'Mujer' : '' ?>
												</td>
												<td>
													<?= ($assistance[$i]['status_assistance']==1) ? '<button class="btn bg-success">Asistirá</button>' : '' ?>
													<?= ($assistance[$i]['status_assistance']==2) ? '<button class="btn bg-secondary">No asistirá</button>' : '' ?>
												</td>
												<td>
													<?php
													$email_admin = $this->session->userdata('email_admin');
													$id_user = $this->model_admin->get_user_xemail($email_admin);
													?>
													<a style="width: 32px;" class="btn btn-sm btn-info" href="<?= base_url('Home/Profile/'.$id_user[0]['id_user'].'IuV'.$user[0]['token_user']) ?>" target="_blank" title="Ver cuenta de usuario"> 
														<i class="fa fa-eye"></i>
													</a>
												</a>
											</td>
										</tr>
									<?php } } ?>
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