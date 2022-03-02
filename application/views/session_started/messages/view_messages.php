<?php
$plan_active = $this->model_home->validate_plan($id_user);
$uri_segment = $this->uri->segment(2);
$this->model_home->active_false_visitors($id_user, 'view_mymessages');

$get_id_user    = $get_data_user[0]['id_user'];
$logactive_user = $get_data_user[0]['logactive_user'];

$name_img_profile = $get_profile_user[0]['photo_profile_user'];

$count_image_profile = count(glob('img/profile/profile/'.$get_id_user.'/{*.jpg,*.jpeg,*.gif,*.png,*.PNG}',GLOB_BRACE));

if ($count_image_profile == 0) { $img_profile_user = base_url('img/profile/no-upload-image.png'); } else { $img_profile_user = base_url('img/profile/profile/'.$get_id_user.'/'.$name_img_profile); }
?>

<style type="text/css">
	.bg-profile { background: url(<?php echo $img_profile_user; ?>), #EC287E; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative; }
</style>
<div class="container-fluid">
	<div class="row pd-0">
		<div class="col-md-12 pd-0">
			<div class="img_profile bg-white zi-2 pos-absolute">
				<a href="<?php echo base_url("Home/Profile/".$id_user."IuV".$get_data_user[0]['token_user']); ?>">
					<table class="w-100">
						<tr>
							<td class="w-20">
								<div class="img_profile_chat bg-profile">
									<?php if ($is_Myprofile == "1"): ?>
										<i id="profile_upload" class="fa fa-pencil img_profile_user" aria-hidden="true"></i>
									<?php endif ?>	
									<?php if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success circle-point'></i>"; } ?>			
								</div>
							</td>
							<td class="w-60 lh-normal p-t-20">
								<span class="fsize-22"><?php echo $get_data_user[0]['name_user']; ?>&nbsp<i class="fa fa-user"></i></span><br>
								<small>
									<?php if ($get_profile_user[0]['city_residence'] !="") {
										$arr_profile_city = explode(",", $get_profile_user[0]['city_residence']); echo $arr_profile_city[1].', '; 
									}
									if ($get_profile_user[0]['state_residence'] !="") {
										$arr_profile_state = explode(",", $get_profile_user[0]['state_residence']); echo $arr_profile_state[1]; 
									}
									?>
								</small>
							</td>
						</tr>
					</table>
				</a>
			</div>
		</div>
		<div class="col-12 div-messages" id="container-messages">
			<table class="w-100">
				<tr>
					<td class="w-100">
						<div class="img_profile_chat bg-profile m-auto">	
						</div>
					</td>
				</tr>
				<tr>
					<td class="w-100 text-center">
						<span class="fsize-22"><?php echo $get_data_user[0]['name_user']; ?></span>
					</td>
				</tr>
			</table>


			<?php

			$data_user = $this->model_home->getDataUserxId($id_user);

			$fecha_actual = strtotime(date("d-m-Y 00:00:00"));
			$fecha        = $data_user[0]['regdate_user'];
			$fecha_reg    = strtotime('+3 day', strtotime($fecha));
			
// 			var_dump($data_user[0]['subs_user']);

			if ($data_user[0]['gender_user']==2) { ?>

				<div id="div-messages"></div>

			<?php } else if ($data_user[0]['gender_user']==1) { 

				if ($data_user[0]['subs_user'] == "1" || $plan_active == "active") { ?>

					<div id="div-messages"></div>

				<?php } else { ?>

					<br>
					<br>
					<div class="comment">    
						<p>itae, pellentesque lectus. Vestibulum sodales neque ut augue elementum </p><br>

						<div class="flex m-0">
							<div class="notice">
								<table>
									<tr>
										<td style="width: 10% !important; font-size: 30px;"><i class="fa fa-lock"></i></td>
										<td style="width: 90% !important"><?php echo $get_data_user[0]['name_user']; ?> <?= lang('text_update_membership') ?></td>
									</tr>
									<tr>
										<td colspan="2">
											<button class="btn_message_block bg-lg-blue">
												<a href="<?php echo base_url("Payment/"); ?>"><?= lang('btn_update_membership') ?></a>
											</button>
										</td>
									</tr>
								</table>
							</div>
						</div>    
					</div>

				<?php } } ?>
			</div>

			<?php 
			if ($validate_block == "0") { 
				if ($data_user[0]['gender_user']==2) { ?>

					<div class="col-md-12 message-input">
						<form class="row" id="form_message" action="<?php echo base_url("Message/send_message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>" method="POST">
							<div class="col-10 p-0"><textarea name="txt_message" id="txt_message" class="w-100" placeholder="Type a message..." required></textarea></div>
							<div class="col-2 p-l-10">
								<button type="submit">
									<i class="fa fa-paper-plane fsize-20 text-white" aria-hidden="true"></i>
								</button>
							</div>
						</form>
					</div>

				<?php } else if ($data_user[0]['gender_user']==1) { 
					
				// Esto es lo que va para el servidor desde aqui
				if ($plan_active == "active" || $data_user[0]['subs_user'] == "1") { ?>

						<div class="col-md-12 message-input">
							<form class="row" id="form_message" action="<?php echo base_url("Message/send_message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>" method="POST">
								<div class="col-10 p-0"><textarea name="txt_message" id="txt_message" class="w-100" placeholder="Type message..." required></textarea></div>
								<div class="col-2 p-l-10">
									<button type="submit">
										<i class="fa fa-paper-plane fsize-20 text-white" aria-hidden="true"></i>
									</button>
								</div>
							</form>
						</div>

					<?php } else { ?>
						<div class="col-md-12 message-input">
							<form class="row" method="POST">
								<div class="col-10 p-0"><textarea name="txt_message" id="txt_message" class="w-100" placeholder="Type message..." required></textarea></div>
								<div class="col-2 p-l-10">
									<button type="submit" class="btn-verification-chat">
										<i class="fa fa-paper-plane fsize-20 text-white" aria-hidden="true"></i>
									</button>
								</div>
							</form>
						</div>
					<?php } } } ?>

				 <!-- Esto es lo que va para el servidor hasta aqui -->

					<div class="col-md-12 display-none">
						<audio id="notification" class="display-none">
							<source src="<?php echo base_url('sound/notification_sound.mp3'); ?>" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
						</div>
					</div>

				</div>

				<script type="text/javascript">

					$(document).ready(function() {
						setInterval('num_message()', 1000);
						recive_message();
					});

					function recive_message() {
						url = "<?php echo base_url("Message/recive_message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>";
						method = "POST";

						$.ajax({
							url       : url,
							method    : method,
							success   : function(resp) {
								$("#div-messages").html(resp);
								$("#container-messages").animate({ scrollTop: $('#container-messages').prop("scrollHeight")});
							}
						});
					}

					function num_message() {
						url = "<?php echo base_url("Message/validate_message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>";

						$.ajax({
							url       : url,
							success   : function(resp) {
								if (resp == "new_message_02041996") {
									recive_message();
								}
							}
						});
					}

					// Esto va para el servidor
					const btnVerificationChat = document.querySelector('.btn-verification-chat');
					btnVerificationChat.addEventListener('click', function(e) {
						e.preventDefault();
						Swal.fire({
							background: '#fbfbf3',
							title: `<span style="color: #e91e63;"><?= lang('category_up'); ?></span>`,
							html: `<a style="color: blue; text-decoration: underline !important;" href="<?php echo base_url('Payment/'); ?>">¡<?= lang('text_category_up'); ?></a>`,
							imageUrl: `<?= base_url('img/src/getnow.gif'); ?>`,
							imageAlt: 'Please wait...',
							confirmButtonText: 'Close'
						})	
					})
					
				</script>

