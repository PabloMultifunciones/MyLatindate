<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Usuarios</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>">Inicio</a></li>
						<li class="breadcrumb-item active">Usuarios</li>
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
						<a href="<?= base_url('Admin/Users/Woman') ?>" style="background-color: #E91E63 !important;" class="info-box-icon elevation-1 text-white">
							<i class="fa fa-female"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Mujeres registradas</span>
							<span class="info-box-number">
								<?php $count_woman = $this->model_admin->count_users('Woman'); ?>
								<?= count($count_woman) ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box mb-3">
						<a href="<?= base_url('Admin/Users/Man') ?>" class="info-box-icon bg-info elevation-1">
							<i class="fa fa-male"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Hombres registrados</span>
							<span class="info-box-number">
								<?php $count_man = $this->model_admin->count_users('Man'); ?>
								<?= count($count_man) ?>
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
						<a href="<?= base_url('Admin/Users/YSubs') ?>" class="info-box-icon bg-success elevation-1">
							<i class="fas fa-dollar-sign text-white"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Suscripción paga</span>
							<span class="info-box-number">
								<?php $count_ysubs = $this->model_admin->count_users('YSubs'); ?>
								<?= count($count_ysubs) ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="info-box mb-3">
						<a href="<?= base_url('Admin/Users/NSubs') ?>" class="info-box-icon bg-danger elevation-1">
							<i class="fas fa-exclamation text-white"></i>
						</a>

						<div class="info-box-content">
							<span class="info-box-text">Suscripción gratis</span>
							<span class="info-box-number">
								<?php $count_nsubs = $this->model_admin->count_users('NSubs'); ?>
								<?= count($count_nsubs) ?>
							</span>
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
							<h3 class="card-title">Datos de usuarios</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="table1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Estado</th>
										<th>Cuenta</th>
										<th>Suscripción</th>
										<th>Fecha registro</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									for ($i=0; $i < count($count_users); $i++) {
										?>
										<tr>
											<td><?= $count_users[$i]['name_user'] ?><br><?= $count_users[$i]['email_user'] ?></td>
											<td><?= ($count_users[$i]['logactive_user']=="1") ? "Conectado" : "Desconectado" ?></td>
											<td>
												<?= ($count_users[$i]['verify_account']==0) ? '<button class="btn bg-secondary">Sin verificar</button>' : '' ?>
												<?= ($count_users[$i]['verify_account']==1 || $count_users[$i]['verify_account']==3) ? '<button class="btn btn-info">En proceso</button>' : '' ?>
												<?= ($count_users[$i]['verify_account']==2) ? '<button class="btn btn-success">Verificada</button>' : '' ?>
												<?= ($count_users[$i]['verify_account']==4) ? '<button class="btn btn-warning">Inactiva</button>' : '' ?>
											</td>
											<td><?= ($count_users[$i]['subs_user']==0) ? 'Gratis' : $count_users[$i]['subs_user']." Mes(es)" ?></td>
											<td><?= date("F j, Y", strtotime($count_users[$i]['regdate_user'])) ?></td>
											<td>
												<?php
												$datos['email'] = $this->session->userdata('email_admin');
												
												$id_user = $this->model_admin->user_xemail($datos);
												?>
												<a style="width: 32px;" class="btn btn-sm btn-info" href="<?= base_url('Home/Profile/'.$id_user[0]['id_user'].'IuV'.$count_users[$i]['token_user']) ?>" target="_blank" title="Ver cuenta de usuario"> 
													<i class="fa fa-eye"></i>
												</a>
												<?php if ($count_users[$i]['verify_account']==0 || $count_users[$i]['verify_account']==1 || $count_users[$i]['verify_account']==3 || $count_users[$i]['verify_account']==4) { ?>

													<a style="width: 32px;" class="btn btn-sm btn-secondary btn-enable text-white" data-enable="<?= $count_users[$i]['id_user'] ?>" title="Activar cuenta de usuario"> 
														<i class="fa fa-exclamation-triangle"></i>
													</a>
												<?php } else if ($count_users[$i]['verify_account']==2) { ?>

													<a style="width: 32px;" class="btn btn-sm btn-success btn-disable text-white" data-disable="<?= $count_users[$i]['id_user'] ?>" title="Desactivar cuenta de usuario"> 
														<i class="fa fa-exclamation-triangle"></i>
													</a>
												<?php } ?>
												<a style="width: 32px;" class="btn btn-sm btn-danger btn-delete text-white" data-delete="<?= $count_users[$i]['id_user'] ?>" title="Eliminar cuenta de usuario"> 
													<i class="fa fa-trash"></i>
												</a>
												<?php if ($count_users[$i]['subs_user'] == "0") { ?>
													<a style="width: 32px;" class="btn btn-sm btn-primary btn-update-member text-white" data-subs="<?= $count_users[$i]['id_user'] ?>" data-status="1" title="Añadir suscripción"> 
													<i class="fa fa-arrow-up"></i>
												</a></td>
												<?php } else {?>
												<a style="width: 32px;" class="btn btn-sm btn-warning btn-update-member text-white" data-subs="<?= $count_users[$i]['id_user'] ?>" data-status="0"  title="Quitar suscripción"> 
													<i class="fa fa-arrow-down"></i>
												</a></td>
												<?php } ?> 
												
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

				if(confirm("Se borrará este usuario. ¿Está seguro?")) {

					var url        = "<?= base_url('Admin/delete_data') ?>";
					var col_valor  = $(this).data("delete");
					var table      = 'user';
					var col_where  = 'id_user';
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

			$(".btn-disable").click(function(e) {
				e.preventDefault();

				if(confirm("Se desactivará este usuario. ¿Está seguro?")) {

					var url        = "<?= base_url('Admin/update_status') ?>";
					var col_valor  = $(this).data("disable");
					var status     = 4;
					var table      = 'user';
					var col_update = 'verify_account';
					var col_where  = 'id_user';

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

				if(confirm("Se activará este usuario. ¿Está seguro?")) {

					var url        = "<?= base_url('Admin/update_status') ?>";
					var col_valor  = $(this).data("enable");
					var status     = 2;
					var table      = 'user';
					var col_update = 'verify_account';
					var col_where  = 'id_user';

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
			
			$(".btn-update-member").click(function(e) {
				e.preventDefault();

				if(confirm(`¿Está seguro de ${$(this).data("status") == '1' ? 'añadir' : 'quitar'} la suscripción a este usuario?`)) {

					var url        = "<?= base_url('Admin/update_subs') ?>";
					var col_valor  = $(this).data("subs");
					var status     = $(this).data("status");
					var table      = 'user';
					var col_update = 'subs_user';
					var col_where  = 'id_user';

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