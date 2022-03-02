<div class="container-fluid">
	<div class="row">
		<?php 

		$uri_segment = $this->uri->segment(2);
		$tipo        = $this->uri->segment(3);

		if ($uri_segment=="InterestedInMe") {
			$this->model_home->active_false_visitors($id_user, 'view_myinterested');
		} else if ($uri_segment=="FavoriteOf") {
			$this->model_home->active_false_visitors($id_user, 'view_myfavorites');
		} else if ($uri_segment=="Viewedmyprofile") {
			$this->model_home->active_false_visitors($id_user, 'view_myprofile');
		}

		if (isset($getDataUsers) && $getDataUsers != "") {
			
			rsort($getDataUsers);

			$sessEmailUser  = $this->session->userdata('email_user'); 

			//Obtiene todos los anuncios que hay registrados en la bd
			$ads_settings  = $this->model_home->ads_settings();
			//Dice cada cuantos usuarios se debe mostrar un anuncio
			$count_show_ad  = $ads_settings[0]['intensity_settings'];
			//Cuenta los usuarios que hay registrados en la bd
			$count_users_ad = 0;
			//Proporciona el numero que se mostrara en el array ej, $ads[$num_show_ad]['banner_ads'] donde $ads[$num_show_ad es el consecutivo
			$num_show_ad    = 0;

			for ($a=0; $a < count($getDataUsers); $a++) { 

				if ($uri_segment=="InterestedInMe") {
					$id_visitor = $getDataUsers[$a]['id_visitor'];
				} else if ($uri_segment=="MyInterest") {
					$id_visitor = $getDataUsers[$a]['id_user'];
				} else if ($uri_segment=="FavoriteOf") {
					$id_visitor = $getDataUsers[$a]['id_visitor'];
				} else if ($uri_segment=="MyFavorites") {
					$id_visitor = $getDataUsers[$a]['id_user'];
				} else if ($uri_segment=="Viewedmyprofile") {
					$id_visitor = $getDataUsers[$a]['id_visitor'];
				} else if ($uri_segment=="ViewedProfile") {
					$id_visitor = $getDataUsers[$a]['id_user'];
				} else if ($uri_segment=="Messages") {
					$active_view     = $getDataUsers[$a]['active_view'];
					$id_message_view = $getDataUsers[$a]['id_count'];
					if ($tipo=="Received") {
						$id_visitor = $getDataUsers[$a]['id_visitor'];
					} else if ($tipo=="Send") {
						$id_visitor = $getDataUsers[$a]['id_user'];
					} else {
						$id_visitor = $getDataUsers[$a]['id_visitor'];
					}
				} else {
					$id_visitor = $getDataUsers[$a]['id_user'];
				}

				$dataUsersGetId = $this->model_home->user_xid($id_visitor); 
				$dataProfilesGetId = $this->model_home->profile_xid($id_visitor); 

				for ($i=0; $i < count($dataUsersGetId); $i++) { 

					if ($dataUsersGetId[$i]['email_user'] == "" or $dataUsersGetId[$i]['email_user'] == null) {
						$getEmailUser = "";
					} else {
						$getEmailUser = $dataUsersGetId[$i]['email_user'];
					}
					

					if ($sessEmailUser != $getEmailUser) {

						if ($dataUsersGetId[$i]['profactive_user'] != 0) {

							$count_users_ad = $count_users_ad + 1;

							$get_id_user = $dataUsersGetId[$i]['id_user'];
							$logactive_user = $dataUsersGetId[$i]['logactive_user'];
							$date_start     = strtotime($dataUsersGetId[$i]['loguotdate_user']);
							$date_start_reg = strtotime($dataUsersGetId[$i]['regdate_user']);
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
								$last_active = round($segundos).' '.lang('secs');
							} else if ($segundos > 60 && $segundos <= 3600) {
								$last_active = round($minutos).' '.lang('mins');
							} else if ($segundos > 3600 && $segundos <= 86400) {
								$last_active = round($horas).' '.lang('hours');
							} else if ($segundos > 86400) {
								$last_active = round($days).' '.lang('days');
							}

							$queryMyInterested = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_myinterested');
							
							$count_image = count(glob('img/profile/cover/'.$get_id_user.'/{*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG}',GLOB_BRACE));
							$img_cover_user = base_url('img/profile/cover/'.$get_id_user.'/');
							$img_profile_user = base_url('img/profile/profile/'.$get_id_user.'/'.$dataProfilesGetId[$i]['photo_profile_user']); 
							?>

							<style type="text/css">
								.bg-profile-<?php echo $a; ?> { background: url(<?php echo $img_profile_user; ?>), #EC287E; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative; }
							</style>
							
							<?php
							if ($uri_segment=="Messages") {

								$count_chat_emisor = count(glob("system/messages/".$id_user."_".$get_id_user."/{handling_message.txt}",GLOB_BRACE));
								$count_chat_receptor = count(glob("system/messages/".$get_id_user."_".$id_user."/{handling_message.txt}",GLOB_BRACE));

								if ($count_chat_emisor != 0) {
									$path_chat = "system/messages/".$id_user."_".$get_id_user."/";
								} else if ($count_chat_receptor != 0) {
									$path_chat = "system/messages/".$get_id_user."_".$id_user."/";
								}

								$chat = fopen($path_chat."/handling_message.txt", "r") or die("Internal error, contact the administrator.");	
								$contenido = fread($chat, filesize($path_chat."/handling_message.txt"));
								fclose($chat);
								$delete_last = trim($contenido, "||||_|_||||");
								$contenido_explode = explode("||||_|_||||", $delete_last);
								$count_cont_exp = count($contenido_explode);
								$chat_explode = explode("||_||", $contenido_explode[$count_cont_exp-1]);
								$date = date_create($chat_explode[1]);
								$date_format = date_format($date, 'j/n/y');
								$last_msj = $chat_explode[2];
								$msj_short = "";
								if (strlen($last_msj) <= 8) {
									$msj_short = $last_msj;
								} else {
									$msj_short = substr($last_msj, 0, 8)."...";
								}
								?>
								
								<div class="col-12 pd-0 bg-portada-message <?php if ($active_view == 1 && $tipo!="Send") {echo "bg-ccc"; } ?>">
									<div class="w-100 zi-2 pos-absolute">
										<a href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$dataUsersGetId[$i]['token_user']); ?>">
											<table class="w-100">
												<tr>
													<td class="w-30">
														<div class="m-t-8 img_profile_logo bg-profile-<?php echo $a; ?>">	
															<?php if ($horas_reg < 72): ?>
																<span class="text-new">New</span>
															<?php endif ?>
															<?php if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success circle-point'></i>"; } ?>
														</div>				
													</td>
													<td class="w-70 lh-normal p-t-18 va-baseline">
														<span class="fsize-20 font-weight-bold"><?php echo $dataUsersGetId[$i]['name_user']." (".$dataProfilesGetId[$i]['age'].")"; ?></span><span class="date_msj text-001FFF text-center"><?php echo $date_format; ?><br><i class="fa fa-trash-o show-delete d-none del-message" data-del-message="<?= $id_message_view ?>" style="font-size: 25px !important; color: #004EBB !important"></i></span><br>
														<span class="fsize-18 text-999999"><?php echo $msj_short; ?></span>
													</td>
												</tr>
											</table>
										</a>
									</div>
								</div>

							<?php } else {

								/* Aquí inicia la sección de los anuncios */
								if ($count_users_ad == $count_show_ad) { 
									$ads_show = $this->model_home->ads();
									?>
									<?php if (isset($ads_show[$num_show_ad]['id_ads'])): ?>
										<div class="d-block col-xs-12 d-sm-none pd-0" style="align-items: center;margin: auto;width: 100% !important;padding: 20px !important;">
											<a <?= ($ads_show[$num_show_ad]['url_ads']!="") ? 'href="'.$ads_show[$num_show_ad]['url_ads'].'" target="_blank"' : '' ?> >
												<small style="padding: 0px 10px !important;">Publicidad</small>
												<img style="width: 100% !important;" src="<?= base_url('img/ads/'.$ads_show[$num_show_ad]['banner_ads']) ?>" alt="Banner publicitario - <?= $ads_show[$num_show_ad]['name_ads'] ?> - Mylatindate.com">
											</a>
										</div>
									<?php endif ?>
									<?php 
									$count_show_ad = $count_show_ad + $ads_settings[0]['intensity_settings'];
									$num_show_ad = $num_show_ad + 1;
								} ?>
								<!-- Aquí finaliza la sección de los anuncios -->
                                
								<div class="col-xs-12 col-sm-6 col-md-3 pd-0 bg-portada-index">
									<div class="w-100 zi-2 pos-absolute">
										<a href="<?php echo base_url("Home/Profile/".$id_user."IuV".$dataUsersGetId[$i]['token_user']); ?>">
											<table class="w-100 m-t-15">
												<tr>
													<td class="w-30">
														<div class="img_profile_logo bg-profile-<?php echo $a; ?>">	

															<?php if ($horas_reg < 72){ ?>
																<span class="text-new text-white">New</span>
															<?php } ?>
															<?php if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success circle-point'></i>"; } ?>
														</div>				
													</td>
													<td class="w-50 lh-normal p-t-16 va-baseline">
														<span class="fsize-24"><?php echo substr($dataUsersGetId[$i]['name_user'], 0, 12); ?></span>
														<?php if ($dataUsersGetId[$i]['verify_account']==2) { ?>
															<span class="text-verify text-white"><img src="<?= base_url('img/src/verify-ok.png') ?>" alt="Account verify - Mylatindate.com"></span>
														<?php } ?>
														<br>
														<span class="fsize-12"><?= ($dataProfilesGetId[$i]['age']!="") ? $dataProfilesGetId[$i]['age']." <i class='fa fa-circle point-icon'></i>" : '' ?> 
														<?php 
														if ($dataProfilesGetId[$i]['city_residence']!="") {
															$arr_profile_city = explode(",", $dataProfilesGetId[$i]['city_residence']); echo $arr_profile_city[1].", ";
														}
														if ($dataProfilesGetId[$i]['state_residence']!="") {
															$arr_profile_state = explode(",", $dataProfilesGetId[$i]['state_residence']); echo $arr_profile_state[1]; 
														}
														?>
													</span>
												</td>
												<td class="w-20 lh-normal p-t-16 va-baseline">
													<span class="fsize-16">
														<?php 
														if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success'></i> ".lang('active'); } else { 
															if (lang('ago')=="Hace") {
																echo lang('ago')."<br>".$last_active;
															} else {
																echo $last_active."<br>".lang('ago'); 
															} } ?>
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

												<a 
												class="btn-a-heart <?= ($queryMyInterested==1) ? 'd-none' : '' ?>" 
												id="<?= 'user-secure-'.$a.'AddMlD28092020' ?>" 
												data-token="<?= $id_user."IuF".$dataUsersGetId[$i]['token_user'] ?>">

												<img class="w-65 btn-img-heart" src="<?= base_url('img/src/heart-active-false.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>

												<a 
												class="btn-a-heart <?= ($queryMyInterested==0) ? 'd-none' : '' ?>" 
												id="<?= 'user-secure-'.$a.'DelMlD28092020' ?>" 
												data-token="<?= $id_user."IuF".$dataUsersGetId[$i]['token_user'] ?>">

												<img class="w-65 btn-img-heart" src="<?= base_url('img/src/heart-bar-top.png') ?>" alt="Icon Menu Bar | Mylatindate.com"></a>


												<script type="text/javascript">
													$(document).ready(function() {

														$("<?= '#user-secure-'.$a.'AddMlD28092020' ?>").click(function() {

															var token = $(this).data("token");
															var url   = "<?= base_url('home/AddMyInterested/') ?>"+token;
															
															$.ajax({
																url     : url,
																success : function() {
																	$('<?= '#user-secure-'.$a.'AddMlD28092020' ?>').addClass('d-none');
																	$('<?= '#user-secure-'.$a.'DelMlD28092020' ?>').removeClass('d-none');
																}
															});
														});
														
														$("<?= '#user-secure-'.$a.'DelMlD28092020' ?>").click(function() {

															var token = $(this).data("token");
															var url   = "<?= base_url('home/DelMyInterested/') ?>"+token;
															
															$.ajax({
																url     : url,
																success : function() {
																	$('<?= '#user-secure-'.$a.'AddMlD28092020' ?>').removeClass('d-none');
																	$('<?= '#user-secure-'.$a.'DelMlD28092020' ?>').addClass('d-none');
																}
															});
														});
													});
												</script>

											&nbsp&nbsp</td>
											<td class="w-25 text-left">&nbsp&nbsp<a href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$dataUsersGetId[$i]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a></td>
											<td class="w-25"></td>
										</tr>
									</table>
									<a class="lightbox" href="#photo_cover">
										<div id="carouselExampleIndicators-<?php echo $a; ?>" class="carousel slide carousel-cover w-100 zi-1 pos-absolute" data-interval="false" data-ride="carousel">
											<ol class="carousel-indicators">
												<?php
												if ($count_image > 0) {
													for ($j=0; $j < $count_image; $j++) { 
														if ($j == 0) {
															?>
															<li data-target="#carouselExampleIndicators-<?php echo $a; ?>" data-slide-to="<?php echo $j; ?>" class="active"></li>
															<?php
														} else {
															?>
															<li data-target="#carouselExampleIndicators-<?php echo $a; ?>" data-slide-to="<?php echo $j; ?>"></li>
															<?php
														}
													}
												}
												?>
											</ol>
											<div class="carousel-inner carousel-inner-<?php echo $a; ?>">
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
									<div class="lightbox-target zi-20" id="photo_cover">
										<img id="img_cover_active" alt="Image Cover | Mylatindate.com">
										<a class="lightbox-close" href="#"></a>
									</div>
									<script type="text/javascript">
										$(document).ready(function() {
											$(".carousel-inner-<?php echo $a; ?>").click(function() {
												var img_active_cover = $(".carousel-inner-<?php echo $a; ?> .active img").attr('src');
												$("#img_cover_active").prop("src", img_active_cover);
											})
										})
									</script>
								</div>
								<?php
							}
						}
					}  	
				} 
			}		
		} 
		?>
	</div>
</div>

