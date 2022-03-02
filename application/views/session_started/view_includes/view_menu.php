<?php 
$uri_segment = $this->uri->segment(2);
$tipo        = $this->uri->segment(3);

if ($uri_segment == "Messages") {
	?>

	<style type="text/css">
		* {
			font-family: 'arial', sans-serif;
		}
	</style>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center b-bottom-ccc"><br>
				<a href="<?php echo base_url('Home/Messages/Received'); ?>"><button class="btn btn-primary font-weight-bold fsize-18 w-40 <?php if ($tipo=="Received" or $tipo=="") { echo "btn-ctrl-message-active"; } else if ($tipo=="Send") { echo "btn-ctrl-message"; } ?>"><?= lang('received') ?></button></a>
				<a href="<?php echo base_url('Home/Messages/Send'); ?>"><button class="btn btn-primary font-weight-bold fsize-18 w-40 <?php if ($tipo=="Send") { echo "btn-ctrl-message-active"; } else if ($tipo=="Received" or $tipo=="") { echo "btn-ctrl-message"; } ?>"><?= lang('send') ?></button></a>
				<br><br>
			</div>
		</div>
	</div>
	<?php
} else {
	?>
	<div class="container-fluid">
	<div class="row bg-f4f4f4 dnone-menu-pc d-flex justify-content-center">

			<div class="col-2 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/Messages'); ?>"><img src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_mymessages"></span></div>

			<div class="col-2 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/InterestedInMe'); ?>"><img src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_myinterested"></span></div>

			<div class="col-2 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/FavoriteOf'); ?>"><img src="<?php echo base_url('img/src/star-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_myfavorites"></span></div>

			<div class="col-2 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/Viewedmyprofile'); ?>"><img src="<?php echo base_url('img/src/eye-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_myprofile"></span></div>

		</div>
		<div class="row bg-f4f4f4 dnone-menu-movil d-flex justify-content-center">

			<div class="col-1 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/Messages'); ?>"><img src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_mymessages"></span></div>

			<div class="col-1 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/InterestedInMe'); ?>"><img src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_myinterested"></span></div>

			<div class="col-1 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/FavoriteOf'); ?>"><img src="<?php echo base_url('img/src/star-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_myfavorites"></span></div>

			<div class="col-1 text-center menu-top mx-2 mx-md-3"><a href="<?php echo base_url('Home/Viewedmyprofile'); ?>"><img src="<?php echo base_url('img/src/eye-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a><span class="view_myprofile"></span></div>

		</div>
	</div>
	<?php
}
?>

<script type="text/javascript">
	
	setInterval("getCountMenu()", 1000);

	function getCountMenu() {

		var place = new Array("view_mymessages", "view_myinterested", "view_myfavorites", "view_myprofile"); 

		place.forEach(function(place) {

			var url     = "<?php echo base_url('Home/getCountMenu/'); ?>";
			var id_user = "<?php echo $id_user ?>";
			var place   = place;
			var active  = "yes";

			$.ajax({
				url       : url,
				data      : {id_user:id_user, place:place, active:active},
				type      : "POST",
				success   : function(resp) {
					if (resp != "0") {
						$("."+place).html("<span class='circle-point-count'>"+resp+"</span>");
					}
				}
			});
		});
	}
</script>