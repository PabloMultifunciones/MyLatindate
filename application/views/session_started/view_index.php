<div class="container-fluid">
	<div class="row bg-f4f4f4 dnone-menu-pc">
		<div class="col-2 text-center"></div>
		<div class="col-2 text-center menu-top"><a href="<?php echo base_url('Home/Messages'); ?>"><img src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_messages > 0): ?> <span class="circle-point-count"><?php echo count($get_count_messages); ?></span> <?php endif ?></div>
		<div class="col-2 text-center menu-top"><a href="<?php echo base_url('Home/InterestedInMe'); ?>"><img src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_interested > 0): ?> <span class="circle-point-count"><?php echo count($get_count_interested); ?></span> <?php endif ?></div>
		<div class="col-2 text-center menu-top"><a href="<?php echo base_url('Home/FavoriteOf'); ?>"><img src="<?php echo base_url('img/src/star-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_favorites > 0): ?> <span class="circle-point-count"><?php echo count($get_count_favorites); ?></span> <?php endif ?></div>
		<div class="col-2 text-center menu-top"><a href="<?php echo base_url('Home/Viewedmyprofile'); ?>"><img src="<?php echo base_url('img/src/eye-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_visitor > 0): ?> <span class="circle-point-count"><?php echo count($get_count_visitor); ?></span> <?php endif ?></div>
		<div class="col-2 text-center"></div>
	</div>
	<div class="row bg-f4f4f4 dnone-menu-movil">
		<div class="col-4 text-center"></div>
		<div class="col-1 text-center menu-top"><a href="<?php echo base_url('Home/Messages'); ?>"><img src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_messages > 0): ?> <span class="circle-point-count"><?php echo count($get_count_messages); ?></span> <?php endif ?></div>
		<div class="col-1 text-center menu-top"><a href="<?php echo base_url('Home/InterestedInMe'); ?>"><img src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_interested > 0): ?> <span class="circle-point-count"><?php echo count($get_count_interested); ?></span> <?php endif ?></div>
		<div class="col-1 text-center menu-top"><a href="<?php echo base_url('Home/FavoriteOf'); ?>"><img src="<?php echo base_url('img/src/star-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_favorites > 0): ?> <span class="circle-point-count"><?php echo count($get_count_favorites); ?></span> <?php endif ?></div>
		<div class="col-1 text-center menu-top"><a href="<?php echo base_url('Home/Viewedmyprofile'); ?>"><img src="<?php echo base_url('img/src/eye-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><?php if ( $get_count_visitor > 0): ?> <span class="circle-point-count"><?php echo count($get_count_visitor); ?></span> <?php endif ?></div>
		<div class="col-4 text-center"></div>
	</div>
	<div class="row">
		<?php 

		$session_email_user  = $this->session->userdata('email_user');
		for ($i=0; $i < count($get_data_user); $i++) { 

			$get_token_user = $get_data_user[$i]['email_user'];

			if ($session_email_user != $get_token_user) {
				if ($get_data_user[$i]['profactive_user'] != 0) {

					$get_id_user = $get_data_user[$i]['id_user'];
					$logactive_user = $get_data_user[$i]['logactive_user'];
					$date_start     = strtotime($get_data_user[$i]['loguotdate_user']);
					$date_start_reg = strtotime($get_data_user[$i]['regdate_user']);
					$date_end       = strtotime(date("Y-m-d H:i:s"));
					$segundos       = $date_end-$date_start;
					$segundos_reg   = $date_end-$date_start_reg;
					$minutos        = $segundos/60;
					$horas          = $segundos/60/60;
					$horas_reg      = $segundos_reg/60/60;
					$days           = $segundos/60/60/60;
					$horas_reg = round($horas_reg); 
					$last_active    = 0;
					if ($segundos <= 60) {
						$last_active = round($segundos).' secs';
					} else if ($segundos > 60 && $segundos <= 3600) {
						$last_active = round($minutos).' mins';
					} else if ($segundos > 3600 && $segundos <= 86400) {
						$last_active = round($horas).' hours';
					} else if ($segundos > 86400) {
						$last_active = round($days).' days';
					}

					$queryMyInterested = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_myinterested');
					$name_img_cover = $get_profile_user[$i]['photo_cover_user'];
					$name_img_profile = $get_profile_user[$i]['photo_profile_user'];

					$count_image = count(glob('img/profile/cover/'.$get_id_user.'/{*.jpg,*.jpeg,*.gif,*.png}',GLOB_BRACE));
					$count_image_profile = count(glob('img/profile/profile/'.$get_id_user.'/{*.jpg,*.jpeg,*.gif,*.png}',GLOB_BRACE));

					if ($count_image == 0) { $img_cover_user = base_url('img/profile/no-upload-image.png'); } else { $img_cover_user = base_url('img/profile/cover/'.$get_id_user.'/'); }
					if ($count_image_profile == 0) { $img_profile_user = base_url('img/profile/no-upload-image.png'); } else { $img_profile_user = base_url('img/profile/profile/'.$get_id_user.'/'.$name_img_profile); }

					?>

					<style type="text/css">
						.bg-profile-<?php echo $i; ?> { background: url(<?php echo $img_profile_user; ?>), #EC287E; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative; }
					</style>
					<div class="col-xs-12 col-sm-6 col-md-3 pd-0 bg-portada-index">
						<div class="w-100 zi-2 pos-absolute">
							<a class="tdeco-none" href="<?php echo base_url("Home/Profile/".$id_user."IuV".$get_data_user[$i]['token_user']); ?>">
								<table class="w-100 m-t-15">
									<tr>
										<td class="w-20">
											<!-- <a class="lightbox" id="view-profile-<?php echo $i; ?>" href="#photo_profile"> -->
												<div class="img_profile_logo bg-profile-<?php echo $i; ?>">	
													<?php if ($horas_reg < 72): ?>
														<span class="text-new text-white">New</span>
													<?php endif ?>
													<?php if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success circle-point'></i>"; } ?>
												</div>					
												<!-- </a> -->
											</td>
											<td class="w-60 lh-normal p-t-20 va-baseline">
												<span class="fsize-22"><?php echo $get_data_user[$i]['name_user']; ?>&nbsp<i class="fa fa-user"></i></span><br>
												<span class="fsize-12"><?php echo $get_profile_user[$i]['age']; ?> <i class='fa fa-circle point-icon'></i> <?php $arr_profile_city = explode(",", $get_profile_user[$i]['city_residence']); echo $arr_profile_city[1]; ?>, <?php $arr_profile_state = explode(",", $get_profile_user[$i]['state_residence']); echo $arr_profile_state[1]; ?></span>
											</td>
											<td class="w-20 lh-normal p-t-30 va-baseline">
												<span class="fsize-12">
													<?php 
													if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success'></i> Active"; } else { echo $last_active."<br>ago"; } ?>
												</span>
											</td>
										</tr>
									</table>
								</a>
							</div>
							<table class="w-100 icons-user">
								<tr class="w-100">
									<td class="w-25"></td>
									<td class="w-25 text-right">
										<?php 	if ($queryMyInterested == "1") {
											?>
											<a href="<?php echo base_url('Home/DelMyInterested/'.$id_user."IuF".$get_data_user[$i]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
										<?php } else if ($queryMyInterested == "0") {
											?>
											<a href="<?php echo base_url('Home/AddMyInterested/'.$id_user."IuF".$get_data_user[$i]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-active-false.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
											<?php
										} ?>
										
									&nbsp&nbsp</td>
									<td class="w-25 text-left">&nbsp&nbsp<a href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$get_data_user[$i]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a></td>
									<td class="w-25"></td>
								</tr>
							</table>
							<a class="lightbox" href="#photo_cover">
								<div id="carouselExampleIndicators-<?php echo $i; ?>" class="carousel slide carousel-cover w-100 zi-1 pos-absolute" data-interval="false" data-ride="carousel">
									<ol class="carousel-indicators">
										<?php
										if ($count_image > 0) {
											for ($j=0; $j < $count_image; $j++) { 
												if ($j == 0) {
													?>
													<li data-target="#carouselExampleIndicators-<?php echo $i; ?>" data-slide-to="<?php echo $j; ?>" class="active"></li>
													<?php
												} else {
													?>
													<li data-target="#carouselExampleIndicators-<?php echo $i; ?>" data-slide-to="<?php echo $j; ?>"></li>
													<?php
												}
											}
										}
										?>
									</ol>
									<div class="carousel-inner carousel-inner-<?php echo $i; ?>">
										<?php 
										if ($count_image > 0) {
											$index = 0;
											$directory="img/profile/cover/".$get_id_user."/";
											$scandir_cover  = scandir($directory);

											for ($j=0; $j < count($scandir_cover); $j++) { 
												if ($scandir_cover[$j] != "." && $scandir_cover[$j] != "..") {

													if ($index == 0) {
														?>
														<div class="carousel-item bg-portada active">
															<img class="d-block w-100 img_cover_height" src="<?php echo $img_cover_user.$scandir_cover[$j]; ?>" alt="First slide">
														</div>
														<?php
													} else { 
														?>
														<div class="carousel-item bg-portada">
															<img class="d-block w-100 img_cover_height" src="<?php echo $img_cover_user.$scandir_cover[$j]; ?>" alt="First slide">
														</div>
														<?php 
													}
													$index++;
												}
											}

										} else {
											?>
											<div class="carousel-item bg-portada active">
												<img class="d-block w-100 img_cover_height" src="<?php echo $img_cover_user; ?>" alt="First slide">
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</a>

					<!-- <div class="lightbox-target zi-20" id="photo_profile">
						<img id="img_profile_active" alt="Image Profile | Mylatindate.com">
						<a class="lightbox-close" href="#"></a>
					</div> -->
					<div class="lightbox-target zi-20" id="photo_cover">
						<img id="img_cover_active" alt="Image Cover | Mylatindate.com">
						<a class="lightbox-close" href="#"></a>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$(".carousel-inner-<?php echo $i; ?>").click(function() {
								var img_active_cover = $(".carousel-inner-<?php echo $i; ?> .active img").attr('src');
								$("#img_cover_active").prop("src", img_active_cover);
							})
							/*$("#view-profile-<?php echo $i; ?>").click(function() {
								var img_active_profile = "<?php echo $img_profile_user; ?>";
								$("#img_profile_active").prop("src", img_active_profile);
							})*/
						})
					</script>					
				</div>
			<?php } } } ?>
		</div>
	</div>
