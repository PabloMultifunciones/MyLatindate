<?php
$uri_segment = $this->uri->segment(2);
$get_id_user    = $get_data_user[0]['id_user'];
$logactive_user = $get_data_user[0]['logactive_user'];
$date_start     = strtotime($get_data_user[0]['loguotdate_user']);
$date_end       = strtotime(date("Y-m-d H:i:s"));
$segundos       = $date_end-$date_start;
$minutos        = $segundos/60;
$horas          = $segundos/60/60;
$days           = $segundos/60/60/60;
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

$name_img_cover = $get_profile_user[0]['photo_cover_user'];
$name_img_profile = $get_profile_user[0]['photo_profile_user'];

$count_image = count(glob('img/profile/cover/'.$get_id_user.'/{*.jpg,*.jpeg,*.gif,*.png,*.PNG}',GLOB_BRACE));
$count_image_profile = count(glob('img/profile/profile/'.$get_id_user.'/{*.jpg,*.jpeg,*.gif,*.png,*.PNG}',GLOB_BRACE));

if ($uri_segment == "Profile") {
	$queryMyInterested = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_my_interested');
	$queryMyFavorites = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_my_favorites');
	$queryMyblocked = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_my_blocked');
}
if ($count_image == 0) { $img_cover_user = base_url('img/profile/no-upload-image.png'); } else { $img_cover_user = base_url('img/profile/cover/'.$get_id_user.'/'); }
if ($count_image_profile == 0) { $img_profile_user = base_url('img/profile/no-upload-image.png'); } else { $img_profile_user = base_url('img/profile/profile/'.$get_id_user.'/'.$name_img_profile); }
?>

<style type="text/css">
	.bg-profile { background: url(<?php echo $img_profile_user; ?>), #EC287E; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative; }
</style>

<div class="container-fluid d-block d-sm-none">
	<div class="row pd-0">
		<div class="col-md-12 pd-0 bg-portada">
			<?php if ($count_image != 0): ?>
				<i id="cover_delete" class="fa fa-trash del_cover_user zi-3" aria-hidden="true"></i>
			<?php endif ?>
			<a class="lightbox" href="#photo_cover">
				<div id="carouselExampleIndicators" class="carousel slide zi-1 pos-absolute w-100" data-interval="false" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php
						if ($count_image > 0) {
							for ($i=0; $i < $count_image; $i++) { 
								if ($i == 0) {
									?>
									<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="active"></li>
									<?php
								} else { 
									?>
									<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
									<?php
								}
							}
						}
						?>
					</ol>
					<div class="carousel-inner">
						<?php 
						if ($count_image > 0) {
							$index = 0;
							$directory="img/profile/cover/".$get_id_user."/";
							$scandir_cover  = scandir($directory);

							for ($i=0; $i < count($scandir_cover); $i++) { 
								if ($scandir_cover[$i] != "." && $scandir_cover[$i] != "..") {
									if ($index == 0) {
										?>
										<div class="carousel-item bg-portada active">
											<img class="d-block w-100" src="<?php echo $img_cover_user.$scandir_cover[$i]; ?>" alt="First slide">
										</div>
										<?php
									} else { 
										?>
										<div class="carousel-item bg-portada">
											<img class="d-block w-100" src="<?php echo $img_cover_user.$scandir_cover[$i]; ?>" alt="First slide">
										</div>
										<?php 
									}
									$index++;
								}
							}

						} else {
							?>
							<div class="carousel-item bg-portada active">
								<img class="d-block w-100" src="<?php echo $img_cover_user; ?>" alt="First slide">
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-12 pd-0 bg-ccc">
			<p class="fsize-17 text-center p-t-40"><?= lang('charge_background') ?></p>
			<i id="cover_upload" class="fa fa-plus zi-2" aria-hidden="true"></i>
			<br>
			<br>
		</div>
	</div>
</div>
<div class="w3-container">
	<div id="upload_img" class="zi-20 w3-modal">
		<div class="w3-modal-content">
			<form action="<?php echo base_url('Home/UpdateImageCover'); ?>" method="POST" enctype="multipart/form-data">
				<div class="w3-container">
					<input type="hidden" id="name_location" name="name_location">
					<span onclick="document.getElementById('upload_img').style.display='none'" class="w3-button w3-display-topright">&times;</span>
					<h3 class="text-center">Upload photo to my profile</h3>
					<img id="blah" class="img-register-logo" src="<?php echo base_url('img/profile/no-upload-image.png'); ?>" alt="Image Profile | Mylatindate.com" />
					<input type='file' id="photo_img" name="photo_img" onchange="readURL(this);" required />
				</div>
				<input type="submit" class="btn_create_myprofile btn-charge-imgcover" value="Upload Image"><br>
			</form>
		</div>
	</div>
</div>

<div class="lightbox-target zi-20" id="photo_profile">
	<img src="<?php echo $img_profile_user; ?>"/>
	<a class="lightbox-close" href="#"></a>
</div>
<div class="lightbox-target zi-20" id="photo_cover">
	<img id="img_cover_active" alt="Image Cover | Mylatindate.com">
	<a class="lightbox-close" href="#"></a>
</div>

<script type="text/javascript">
	$("#cover_delete").click(function() {
		var img_active_cover = $(".carousel-inner .active img").attr('src');
		var url = "<?php echo base_url('Home/delete_image_cover'); ?>";
		$.ajax({
			url      : url,
			data     : {img_active: img_active_cover},
			type     : 'POST',
			success  : function(resp) {
				if (resp == 1) {
					location.reload();
				}
			}
		})
	})

	$(".carousel-inner").click(function() {
		var img_active_cover = $(".carousel-inner .active img").attr('src');
		$("#img_cover_active").prop("src", img_active_cover);
	})
</script>