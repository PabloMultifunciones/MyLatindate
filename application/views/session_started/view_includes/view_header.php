<?php 
$plan_active   = $this->model_home->validate_plan($id_user);
$count_members = $this->model_home->getCountRowsTable('profile_user');
$uri_seg       = $this->uri->segment(1);
$uri_segment   = $this->uri->segment(2);
$uri_title     = "";
$uri_text_menu = "";

if ($uri_segment == "Myprofile") {
	
	$uri_text_menu = "My Profile";
	$uri_title = "My Profile - Mylatindate";
} else if ($uri_segment == "Profile") {
	
	$uri_text_menu = "Profile";
	$uri_title = "Profile - Mylatindate";
} else if ($uri_segment == "Viewedmyprofile") {
	
	$uri_text_menu = "Viewed my profile";
	$uri_title = "Viewed my profile - Mylatindate";
} else if ($uri_segment == "InterestedInMe") {
	
	$uri_text_menu = "Who's interested in you";
	$uri_title = "Who's interested in you - Mylatindate";
} else if ($uri_segment == "FavoriteOf") {
	
	$uri_text_menu = "Added me as their favorite";
	$uri_title = "Added me as their favorite - Mylatindate";
} else if ($uri_segment == "MyInterest") {
	
	$uri_text_menu = "Who I'm interested in";
	$uri_title = "Who I'm interested in - Mylatindate";
} else if ($uri_segment == "MyFavorites") {
	
	$uri_text_menu = "Your Favorites";
	$uri_title = "Your Favorites - Mylatindate";
} else if ($uri_segment == "ViewedProfile") {
	
	$uri_text_menu = "Profiles I have viewed";
	$uri_title = "Profiles I have viewed - Mylatindate";
} else if ($uri_segment == "Block") {
	
	$uri_text_menu = "Your Blocks";
	$uri_title = "Your Blocks - Mylatindate";
} else if ($uri_segment == "Configuration") {
	
	$uri_text_menu = "Edit Account";
	$uri_title = "Edit Account - Mylatindate";
} else if ($uri_segment == "Search" or $uri_segment == "searching_users") {
	
	$uri_text_menu = "Search";
	$uri_title = "Search - Mylatindate";
} else if ($uri_segment == "finish-payment") {
	
	$uri_text_menu = "Payment Process";
	$uri_title = "Payment Process - Mylatindate";
} else if ($uri_seg == "Payment") {
	
	$uri_text_menu = "My Membership";
	$uri_title = "My Membership - Mylatindate";
} else {

	$uri_text_menu = "Mylatindate.com";
	$uri_title = "Mylatindate";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="description" content="Have the perfect date and find your latin love">
	<meta property="og:site_name" content="Mylatindate">
	<meta property="og:title" content="Mylatindate">
	<meta property="og:description" content="Have the perfect date and find your latin love">
	<meta name="language" content="en">
	<meta name="keywords" content="my, latin, date, have, perfect, date, find, latin, love">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://www.mylatindate.com">
	<meta property="og:image" content="https://www.mylatindate.com/img/src/favicon.png">
	<meta property="og:image:width" content="96">
	<meta property="og:image:height" content="96">
	<meta property="author" content="Duduar Coder">
	<meta name="copyright" content="My Latin Media" />
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	

	<link rel="shorcut icon" href="<?php echo base_url('img/src/favicon.png'); ?>" type="image/png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="<?php echo base_url('css/session_started/main.css?v='.rand()); ?>">	
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
	<title><?php echo $uri_title; ?></title>
	
	<style>
    .item-price {
      border-bottom: 2px solid #333;
	  
    }
	.pl-20 {
		padding: 0 0 0 20px;
		margin: 10px 0 0 0;
	}
	.icon-question {
		cursor: pointer;
		font-size: 10px;
		border-radius: 200px;
		padding: 3px 5px;
	}

	.btn-disabled {
		background: gray;
		color: #ffffff;
		border: 1px solid #2a9fd6;
		border-radius: 5px;
		width: 100%;
		font-size: 18px;
		padding: 10px 0px;
	}
	 .title-modal{
		background: linear-gradient(to left, #004EBB, #00ADEE);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		font-weight: 800;
	}
	
  
  </style>
	
	
</head>
<body>
	<header class="container-fluid">
		<div class="row">
			<div class="col-md-12 pd-0">
				<div class="pos-f-t">
					<nav class="navbar navbar-dark <?= ($gender_user==1) ? 'bg-main-male' : 'bg-main-female' ?>">
						<?php if ($is_active != "0") {
							if ($uri_segment=="Profile" || $uri_segment=="Send-Message") { ?>
								<button class="navbar-toggler zi-2" type="button" id="btn-back-profile">
									<i class='fa fa-arrow-left icon-bar'></i>
								</button>
							<?php } else { ?>
								<button class="navbar-toggler zi-2" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
									<i class="fa fa-bars icon-bar"></i>
								</button>
							<?php } } ?>
							<a class="navbar-brand text-center <?php if ($is_active!=0) { echo 'center-with-absolute'; } ?> zi-1" href="#"><?php echo $uri_text_menu; ?></a>

							<?php if ($uri_segment=="Messages"): ?>
								<a href="#" class="text-white zi-2" id="edit_message">Editar</a>
								<a href="#" class="text-white zi-2 d-none" id="close_edit_message">Cerrar</a>
							<?php endif ?>
						</nav>

						<div class="collapse" id="navbarToggleExternalContent">
							<div class="bg-gay-1">
								<ul class="navbar-nav mr-auto mt-lg-0 p-lr-20">
									<li class="nav-item active">
										<a class="nav-link" href="<?php echo base_url(); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/home-bar.png'); ?>" alt=""><?= lang('home'); ?> <span class="sr-only">(current)</span></a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" href="<?php echo base_url('Home/Messages'); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/message-bar.png'); ?>" alt=""><?= lang('messages'); ?></a>
									</li>
									<li class="nav-item">
										<a class="nav-link"><img class="icon-menu-bar" src="<?php echo base_url('img/src/activies-bar.png'); ?>" alt=""><span id="more-activities"><?= lang('activities'); ?>&nbsp<i class="fa fa-chevron-down p-t-5 pos-right"></i></span>
											<span id="less-activities" class="display-none"><?= lang('activities'); ?>&nbsp<i class="fa fa-chevron-up p-t-5 pos-right"></i></span></a>
										</li>
									</ul>
									<ul id="show-more-activities" class="ul-activities display-none">
										<li class="title-activities"><strong> <?= lang('activity_towards'); ?></strong></li>
										<li><a href="<?php echo base_url('Home/InterestedInMe'); ?>"> <?= lang('interest_me'); ?></a></li>
										<li><a href="<?php echo base_url('Home/Viewedmyprofile'); ?>"> <?= lang('view_my_profile'); ?></a></li>
										<li><a href="<?php echo base_url('Home/FavoriteOf'); ?>"> <?= lang('im_favorite'); ?></a></li>
										<li class="title-activities"><strong> <?= lang('activity_from_me'); ?></strong></li>
										<li><a href="<?php echo base_url('Home/MyInterest'); ?>"> <?= lang('my_interests'); ?></a></li>
										<li><a href="<?php echo base_url('Home/ViewedProfile'); ?>"> <?= lang('profile_viewed'); ?></a></li>
										<li><a href="<?php echo base_url('Home/MyFavorites'); ?>"> <?= lang('mi_favorites'); ?></a></li>
										<li><a href="<?php echo base_url('Home/Block'); ?>"><?= lang('block_list'); ?></a></li>
									</ul>
									<ul class="navbar-nav mr-auto mt-lg-0 p-lr-20">
										<li class="nav-item">
											<a class="nav-link" href="<?php echo base_url('Home/Search'); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/search-bar.png'); ?>" alt=""><?= lang('search') ?></a>
										</li>
										<li class="nav-item">
											<a class="nav-link"><img class="icon-menu-bar" src="<?php echo base_url('img/src/most-popular-bar.png'); ?>" alt=""><span id="more-popular"><?= lang('more_popular') ?>&nbsp<i class="fa fa-chevron-down p-t-5 pos-right"></i></span><span id="less-popular" class="display-none"><?= lang('more_popular') ?>&nbsp<i class="fa fa-chevron-up p-t-5 pos-right"></i></span></a>
										</li>
									</ul>
									<ul id="show-more-popular" class="ul-activities display-none">
										<li><a href="<?php echo base_url(); ?>"><?= lang('members_online') ?></a> <span class="pos-right count-users-menu"><?php echo count($count_members); ?></span></li>
										<li><a href="#"><?= lang('new_members') ?></a></li>
										<li><a href="#"><?= lang('most_popular') ?></a></li>
									</ul>
									<ul class="navbar-nav mr-auto mt-lg-0 p-lr-20">
										<li class="nav-item">
											<a class="nav-link" href="<?php echo base_url('Home/Myprofile'); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/perfil-bar.png'); ?>" alt=""><?= lang('my_profile') ?></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?php echo base_url('Home/Configuration'); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/settings-bar.png'); ?>" alt=""><?= lang('configuration') ?></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="<?php echo base_url('Home/Events'); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/events-bar.png'); ?>" alt=""><?= lang('events') ?>

											<?php 
											$count_events = $this->model_home->get_events($id_user);
											if (isset($count_events) && count($count_events) > 0) {	?>												 
												<span class="m-t-8 count_menu pos-right">
													<?= count($count_events) ?>
												</span>
											<?php } ?>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#" onclick="document.getElementById('claims_user').style.display='block'"><img class="icon-menu-bar" src="<?php echo base_url('img/src/help-bar.png'); ?>" alt=""><?= lang('pqr') ?></a>
									</li>
								</ul>
								<div class="bg-lg-blue" style="padding: 10px !important;">
									<?php if ($plan_active == "active") { ?>
										<a class="text-white" href="<?php echo base_url('Payment/'); ?>"><img class="icon-menu-bar" src="<?php echo base_url('img/src/perfil-bar.png'); ?>" alt=""><?= lang('plan_active'); ?></a>

									<?php } else { ?>
										<a class="text-white" href="<?php echo base_url('Payment/'); ?>">
											<table class="w-100">
												<tr>
													<td style="width: 20%">
														<img class="icon-menu-bar" style="width: 80% !important; margin: 0px 0px 0px 8px;" src="<?php echo base_url('img/src/up-categorie-bar.png'); ?>" alt="">
													</td>
													<td style="width: 80%; padding: 0px 0px 0px 10px;">
														<span style="font-size: 16px; color: #FFF;"><?= lang('category_up'); ?></span><br>
														<span style="color: #FFF; font-size: 13px;"><?= lang('text_category_up'); ?></span>
													</td>
												</tr>
											</table>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="w3-container">
			<div id="claims_user" class="w3-modal" style="z-index: 50;">
				<div class="w3-modal-content">
					<div class="w3-container">
						<span onclick="document.getElementById('claims_user').style.display='none'" class="w3-button w3-display-topright">&times;</span>
						<form action="<?= base_url('Home/Report_User/'.$id_user) ?>" method="POST" id="add-claims">
							<br>
							<p class="fsize-22"><strong>Quejas y reclamos</strong></p>
							<div class="form-group alert-danger d-none m-0" style="padding: 10px !important;"></div>
							<div class="form-group m-0">
								<label for="subject_claims">Escribe tu asunto*</label>
								<input type="text" class="form-control" name="subject_claims" id="subject_claims">
							</div>
							<br>
							<div class="form-group m-0">
								<label for="body_claims">Escribe tu queja o reclamo*</label>
								<textarea class="form-control" id="body_claims" name="body_claims" style="width: 100% !important; height: 200px !important; padding: 10px !important;"></textarea>
							</div>
							<br>
							<div class="form-group m-0">
								<label for="attachment_claims">Sube tus archivos de prueba</label>

								<input type="file" style="width: 100% !important;" id="attachment_claims" name="attachment_claims">
							</div>
							<br>
							<div class="form-group m-0">
								<input type="submit" class="btn-finish-pay" id="btn_add_report_claims" value="Enviar">
							</div>
							<br>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {

				$("#edit_message").click(function() {

					$(".show-delete").removeClass("d-none");
					$(".bg-portada-message").css("margin", "15px 0px");
					$(".bg-portada-message").css("height", "125px");

					$("#edit_message").addClass("d-none");
					$("#close_edit_message").removeClass("d-none");
				});

				$("#close_edit_message").click(function() {
					$(".show-delete").addClass("d-none");
					$(".bg-portada-message").css("margin", "0px");
					$(".bg-portada-message").css("height", "115px");

					$("#edit_message").removeClass("d-none");
					$("#close_edit_message").addClass("d-none");
				});

				$(".del-message").click(function() {
					var id_message = $(this).data("del-message");

					$.ajax({
						type      : "POST",
						url       : "<?= base_url('Home/DeleteMessages') ?>",
						data      : {id_message:id_message},
						success   : function(resp) {

							location.reload();
						}
					});
				});

				$("#btn-back-profile").click(function() {
					//window.history.back();
					$(location).attr('href','https://mylatindate.com/');
				});

				$("#add-claims").on("submit", function(event) {
					event.preventDefault();

					var $btn = $('#btn_add_report_claims');
					var $txt = $btn.val();
					$btn.prop('disabled',true);
					$btn.val('Validando datos...');
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
								$btn.val($txt);

							} else if(obj.result == 'OK') {
								window.location.reload();
							}
						}
					});
				});
			});
		</script>
		
		