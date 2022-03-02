<?php
   $plan_active   = $this->model_home->validate_plan($id_user);
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
   	$queryMyInterested = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_myinterested');
   	$queryMyFavorites = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_myfavorites');
   	$queryMyblocked = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_myblocked');
   }
   if ($count_image == 0) { $img_cover_user = base_url('img/profile/no-upload-image.png'); } else { $img_cover_user = base_url('img/profile/cover/'.$get_id_user.'/'); }
   
   if ($name_img_cover == "no-upload-image" && $get_data_user[0]['account_facebook_id'] != "") {
   	$img_profile_user = "https://graph.facebook.com/".$get_data_user[0]['account_facebook_id']."/picture?type=large"; 
   } else if ($count_image_profile == 0) { 
   	$img_profile_user = base_url('img/profile/no-upload-image.png'); 
   } else { 
   	$img_profile_user = base_url('img/profile/profile/'.$get_id_user.'/'.$name_img_profile); 
   }
   ?>
<style type="text/css">
   .bg-profile { background: url(<?php echo $img_profile_user; ?>), #EC287E; background-position: center; background-repeat: no-repeat; background-size: cover; position: relative; }
</style>
<?php if ($is_Myprofile == "1") { ?>
<div class="container-fluid">
   <div class="row pd-0">
      <div class="col-md-12 pd-0 bg-portada bg-portada-profile">
         <?php if ($is_Myprofile == "1") { ?>
         <i id="cover_upload" class="fa fa-pencil img_cover_user zi-3" aria-hidden="true"></i>
         <?php } 
            if ($uri_segment == "Profile") { ?>
         <table class="w-100 icons-user">
            <tr class="w-100">
               <td class="w-25"></td>
               <td class="w-25 text-right">
                  <?php 	if ($queryMyInterested == "1") {
                     ?>
                  <a href="<?php echo base_url('Home/DelMyInterested/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
                  <?php } else if ($queryMyInterested == "0") {
                     ?>
                  <a href="<?php echo base_url('Home/AddMyInterested/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-active-false.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
                  <?php
                     } ?>
                  &nbsp&nbsp
               </td>
               <td class="w-25 text-left"><a href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$get_data_user[$i]['token_user']); ?>">&nbsp&nbsp<img class="w-65" src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a></td>
               <td class="w-25"></td>
            </tr>
         </table>
         <?php } ?>
         <a class="lightbox" href="#photo_cover">
            <div id="carouselExampleIndicators" class="carousel slide zi-1 pos-absolute w-100 carousel-profile-blur" data-interval="false" data-ride="carousel">
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
                  <div class="carousel-item bg-portada bg-portada-profile active">
                     <img class="d-block w-100" src="<?php echo $img_cover_user.$scandir_cover[$i]; ?>" alt="First slide">
                  </div>
                  <?php
                     } else { 
                     	?>
                  <div class="carousel-item bg-portada bg-portada-profile">
                     <img class="d-block w-100" src="<?php echo $img_cover_user.$scandir_cover[$i]; ?>" alt="First slide">
                  </div>
                  <?php 
                     }
                     $index++;
                     }
                     }
                     
                     } else {
                     ?>
                  <div class="carousel-item bg-portada bg-portada-profile active">
                     <img class="d-block w-100" src="<?php echo $img_cover_user; ?>" alt="First slide">
                  </div>
                  <?php
                     }
                     ?>
               </div>
            </div>
         </a>
         
         <!-- IMAGEN DE PERFIL -->
         
         <div class="img_profile img_profile-prof zi-2 pos-absolute">
            <table class="w-100">
               <tr>
                  <td class="w-20">
                     <a class="lightbox" href="#photo_profile">
                        <div class="img_profile_logo_profile bg-profile m-auto">
                           <?php if ($is_Myprofile == "1"): ?>
                           <i id="profile_upload" class="fa fa-pencil img_profile_user" aria-hidden="true"></i>
                           <?php endif ?>	
                           <?php if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success circle-point'></i>"; } ?>			
                        </div>
                     </a>
                  </td>
               </tr>
               <tr>
                  <td class="w-60 lh-normal text-center">
                     <span class="fsize-22"><strong class="text-white"><?php echo $get_data_user[0]['name_user']; ?></strong></span><br>
                     <small class="text-white"><?php echo $get_profile_user[0]['age']; ?> <i class='fa fa-circle point-icon'></i> 
                     <?php if ($get_profile_user[0]['city_residence']!="") {
                        $arr_profile_city = explode(",", $get_profile_user[0]['city_residence']); echo $arr_profile_city[1].', '; 
                        }
                        if ($get_profile_user[0]['state_residence']!="") {
                        $arr_profile_state = explode(",", $get_profile_user[0]['state_residence']); echo $arr_profile_state[1]; 
                        }
                        ?>
                     </small>
                  </td>
               </tr>
            </table>
         </div>
         
         <!-- FINAL DE IMAGEN DE PERFIL -->
      </div>
      <div class="col-md-12 div_btn_view_my_profile">
         <button class="btn_view_my_profile" style="<?= ($gender_user==1) ? 'background-color: #004EBB !important;' : 'background-color: #fe3078 !important;' ?>"><a href="<?php echo base_url("Home/Profile/".$get_data_user[0]['id_user']."IuV".$get_data_user[0]['token_user']); ?>"><?= lang('view_profile') ?></a></button>
      </div>
   </div>
   <div class="row p-t-40">
      <div class="col-md-12 p-lr-200">
         <ul class="edit-list-profile">
            <a href="<?php echo base_url("Home/Change-Image"); ?>">
               <li><?= lang('photo') ?><i class="fa fa-angle-right"></i></li>
            </a>
            <a href="<?php echo base_url("Home/Change-Profile"); ?>">
               <li><?= lang('profile') ?><i class="fa fa-angle-right"></i></li>
            </a>
            <a href="<?php echo base_url("Home/Verify-Profile"); ?>">
               <li><?= lang('verify_profile') ?><i class="fa fa-angle-right"></i></li>
            </a>
         </ul>
      </div>
      <div class="col-md-12 div-upgrade-profile">
         <div class="w-100">
            <div class="div-img-upgrade w-100">
               <img class="img-upgrade d-block" src="<?php echo base_url('img/src/perfil-bar-false.png'); ?>" alt="Upgrade Now | Mylatindate.com">
            </div>
            <?php if ($plan_active == "active") { ?>
            <p class="text-center"><?= lang('text_membership_platinum') ?></p>
            <button class="btn_view_my_profile bg-lg-blue"><a href="<?php echo base_url("Payment/"); ?>"><?= lang('plan_active') ?></a></button>
            <?php } else { ?>
            <p class="text-center"><?= lang('text_membership_standard') ?></p>
            <button class="btn_view_my_profile bg-lg-blue"><a href="<?php echo base_url("Payment/"); ?>"><?= lang('category_up') ?></a></button>
            <?php } ?>
         </div>
      </div>
   </div>
</div>

<?php } else { ?>
<div class="container-fluid">
   <div class="row p-lr-200 p-t-profile-20" >
      <!--<div class="col-sm-12 col-md-4 pd-0 bg-portada">--><!-- ACAAAAAAAAAAAA -->
      <div class="col-sm-12 col-md-4 pd-0 bg-portada-view-profile"><!-- ACAAAAAAAAAAAA -->
      
         <?php if ($is_Myprofile == "1") { ?>
         <i id="cover_upload" class="fa fa-pencil img_cover_user zi-2" aria-hidden="true"></i>
         <?php } 
            if (isset($id_user)) { if ($id_user != $get_id_user) { ?>
         <table class="w-100 icons-user">
            <tr class="w-100">
               <td class="w-25"></td>
               <td class="w-25 text-right">
                  <?php 	if ($queryMyInterested == "1") {
                     ?>
                  <a href="<?php echo base_url('Home/DelMyInterested/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
                  <?php } else if ($queryMyInterested == "0") {
                     ?>
                  <a href="<?php echo base_url('Home/AddMyInterested/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-active-false.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
                  <?php
                     } ?>
                  &nbsp&nbsp
               </td>
               <td class="w-25 text-left"><a href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>">&nbsp&nbsp<img class="w-65" src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a></td>
               <td class="w-25"></td>
            </tr>
         </table>
         <?php } } ?>
         <a class="lightbox" href="#photo_cover">
             <!-- ACAAAAAAAAAAAAAA -->
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
                  <div class="carousel-item bg-portada active" style="height: 320px;"><!-- ACAAAAAAAAAAAAAA -->
                     <img class="d-block w-100 img_cover_height" src="<?php echo $img_cover_user.$scandir_cover[$i]; ?>" alt="First slide">
                  </div>
                  <?php
                     } else { 
                     	?>
                  <div class="carousel-item bg-portada" style="height: 320px;">
                     <img class="d-block w-100 img_cover_height" src="<?php echo $img_cover_user.$scandir_cover[$i]; ?>" alt="First slide">
                  </div>
                  <?php 
                     }
                     $index++;
                     }
                     }
                     
                     } else {
                     ?>
                  <div class="carousel-item bg-portada active" style="height: 320px;">
                     <img class="d-block w-100 img_cover_height" src="<?php echo $img_cover_user; ?>" alt="First slide">
                  </div>
                  <?php
                     }
                     ?>
               </div>
         <a class="carousel-control-prev dnone-indicators-carousel" href="#carouselExampleIndicators" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next dnone-indicators-carousel" href="#carouselExampleIndicators" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
         </div>
         </a>
         <div class="img_profile zi-2 pos-absolute">
    <!--
    <?php if ($is_Myprofile == "1") { ?>
         <i id="cover_upload" class="fa fa-pencil img_cover_user zi-2 pos-absolute" aria-hidden="true"></i>
         <?php } 
            if (isset($id_user)) { if ($id_user != $get_id_user) { ?>
         <table class="w-100 icons-user">
            <tr class="w-100">
               <td class="w-25"></td>
               <td class="w-25 text-right">
                  <?php 	if ($queryMyInterested == "1") {
                     ?>
                  <a href="<?php echo base_url('Home/DelMyInterested/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
                  <?php } else if ($queryMyInterested == "0") {
                     ?>
                  <a href="<?php echo base_url('Home/AddMyInterested/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>"><img class="w-65" src="<?php echo base_url('img/src/heart-active-false.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a>
                  <?php
                     } ?>
                  &nbsp&nbsp
               </td>
               <td class="w-25 text-left"><a href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>">&nbsp&nbsp<img class="w-65" src="<?php echo base_url('img/src/message-bar-top.png'); ?>" alt="Icon Menu Bar | Mylatindate.com"></a></td>
               <td class="w-25"></td>
            </tr>
         </table>
         <?php } } ?> -->
            <table class="w-100">
               <tr>
                  <td class="w-20">
                     <a class="lightbox" href="#photo_profile">
                        <div class="img_profile_logo_profile bg-profile m-r-15">
                           <?php if ($is_Myprofile == "1"): ?>
                           <i id="profile_upload" class="fa fa-pencil img_profile_user" aria-hidden="true"></i>
                           <?php endif ?>	
                           <?php if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success circle-point'></i>"; } ?>			
                        </div>
                     </a>
                  </td>
                  <!--<td class="w-60 lh-normal p-t-40">-->
                  <td class="w-60 lh-normal" style="padding-top:60px">
                     <span class="fsize-22"><?php echo $get_data_user[0]['name_user']; ?>&nbsp<i class="fa fa-user"></i></span><br>
                     <small><?php echo $get_profile_user[0]['age']; ?> <i class='fa fa-circle point-icon'></i> 
                     <?php 
                        if ($get_profile_user[0]['city_residence'] !="") { $arr_profile_city = explode(",", $get_profile_user[0]['city_residence']); echo $arr_profile_city[1].', '; }
                        if ($get_profile_user[0]['state_residence'] !="") { $arr_profile_state = explode(",", $get_profile_user[0]['state_residence']); echo $arr_profile_state[1]; } 
                        ?>
                     </small><br>
                     <small><?php if ($get_data_user[0]['verify_account']=="2") { if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success'></i> Active"; } else { echo $last_active."<br>ago"; } } ?></small>
                  </td>
                  <td class="w-20 lh-normal p-t-40 dnone-active-pc"><small>
                     <?php 
                        if ($get_data_user[0]['verify_account']=="2") { ?>
                     <img style="width: 60% !important; margin-top: 10px;" src="<?= base_url('img/src/verify-ok.png') ?>" alt="Account verify - Mylatindate.com"><br>Verificado
                     <?php } else if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success'></i> Active"; } else { echo $last_active."<br>ago"; } ?></small>
                  </td>
               </tr>
            </table>
         </div>
      </div>
      <?php
         $data_view = array('logactive_user' => $logactive_user, 'last_active' => $last_active); ?>
      <?php $this->load->view('session_started/view_profile_pc', $data_view);	?>
      <?php $this->load->view('session_started/view_profile_movil', $data_view);	?>
      <div class="col-md-12">
         <div class="row">
            <div class="col-md-12"><br></div>
            <div class="separator"></div>
            <?php if ($get_profile_user[0]['about_yourself']!=""): ?>
            <div class="col-12 p-tb-2 title-about"><strong>Member Overview</strong></div>
            <div class="col-12 p-tb-2"><small><?php echo $get_profile_user[0]['about_yourself']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['looking_partner']!=""): ?>
            <div class="col-12 p-tb-2 title-about"><strong><?php if($get_data_user[0]['gender_user']=="1") { echo "He's"; } else if($get_data_user[0]['gender_user']=="0") { echo "She's"; } ?> Looking For</strong></div>
            <div class="col-12 p-tb-2"><small><?php echo $get_profile_user[0]['looking_partner']; ?></small></div>
            <?php endif ?>
            <?php if (!empty($get_profile_user[0]['penpal']) || !empty($get_profile_user[0]['friendship']) || !empty($get_profile_user[0]['romance_dating']) || !empty($get_profile_user[0]['long_relationship'])): ?>
            <div class="col-6 p-tb-3"><small><strong>Relationship they're looking for:</strong></small></div>
            <div class="col-6 p-tb-3 text-right"><small><?php if ($get_profile_user[0]['penpal'] == "1") { echo "Penpal,";} ; ?> <?php if ($get_profile_user[0]['friendship'] == "1") { echo "Friendship,";} ; ?> <?php if ($get_profile_user[0]['romance_dating'] == "1") { echo "Romance / Dating,";} ; ?> <?php if ($get_profile_user[0]['long_relationship'] == "1") { echo "Long Term Relationship";} ; ?></small></div>
            <?php endif ?>
            <div class="separator"></div>
            <div class="row w-100">
               <?php if (isset($id_user)) { if ($id_user != $get_id_user) { ?>
               <div class="col-md-6">
                  <button class="btn_profile"><a class="tdeco-none" href="<?php echo base_url("Home/Send-Message/".$id_user."IuM".$get_data_user[0]['token_user']); ?>">Send Message</a></button>
               </div>
               <div class="col-md-6">
                  <?php if ($queryMyFavorites == "1") {
                     ?>
                  <button class="btn_profile pro_head"><a class="tdeco-none" href="<?php echo base_url('Home/DelMyFavorites/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>">Remove From Favorites</a></button>
                  <?php } else if ($queryMyFavorites == "0") {
                     ?>
                  <button class="btn_profile"><a class="tdeco-none" href="<?php echo base_url('Home/AddMyFavorites/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>">Add To Favorites</a></button>
                  <?php
                     } ?>
               </div>
               <div class="col-md-6">
                  <?php if ($queryMyblocked == "1") {
                     ?>
                  <button class="btn_profile pro_head"><a class="tdeco-none" href="<?php echo base_url('Home/DelMyBlocked/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>">Unblock User</a></button>
                  <?php } else if ($queryMyblocked == "0") {
                     ?>
                  <button class="btn_profile"><a class="tdeco-none" href="<?php echo base_url('Home/AddMyBlocked/'.$id_user."IuF".$get_data_user[0]['token_user']); ?>">Block User</a></button>
                  <?php
                     } ?>
               </div>
               <div class="col-md-6">
                  <button class="btn_profile" onclick="document.getElementById('reported_user').style.display='block'">Report Abuse</button>
               </div>
               <?php } ?>
            </div>
            <?php } ?>
            <div class="safety-tip">
               <div class="title-safety">Safety Tip - Suspicious about someone?</div>
               <div class="text-safety">Your membership subscription helps us provide world class fraud prevention technology and employ people dedicated to fraud prevention and consumer safety. Help us keep you safe by reporting anything of concern to our dedicated fraud prevention team by clicking the "Report Abuse" icon.</div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php } ?>
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
   $(".carousel-inner").click(function() {
   	var img_active_cover = $(".carousel-inner .active img").attr('src');
   	$("#img_cover_active").prop("src", img_active_cover);
   })
</script>
<div class="w3-container">
   <div id="reported_user" class="w3-modal">
      <div class="w3-modal-content">
         <div class="w3-container">
            <span onclick="document.getElementById('reported_user').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <form action="<?= base_url('Home/Report_User/'.$id_user.'IuR'.$get_data_user[0]['token_user']) ?>" method="POST" id="add-report">
               <br>
               <p class="fsize-22"><strong>REPORTAR ABUSO</strong></p>
               <div class="form-group alert-danger d-none m-0" style="padding: 10px !important;"></div>
               <div class="form-group m-0">
                  <label for="subject_claims">Escribe tu asunto*</label>
                  <input type="text" class="form-control" name="subject_claims" id="subject_claims">
               </div>
               <br>
               <div class="form-group m-0">
                  <label for="body_claims">Escribe el cuerpo del correo*</label>
                  <textarea class="form-control" id="body_claims" name="body_claims" style="width: 100% !important; height: 200px !important; padding: 10px !important;"></textarea>
               </div>
               <br>
               <div class="form-group m-0">
                  <label for="attachment_claims">Sube tus archivos de prueba</label>
                  <input type="file" style="width: 100% !important;" id="attachment_claims" name="attachment_claims">
               </div>
               <br>
               <div class="form-group m-0">
                  <input type="submit" class="btn-finish-pay" id="btn_add_report" value="Enviar">
               </div>
               <br>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
   
   	$("#add-report").on("submit", function(event) {
   		event.preventDefault();
   
   		var $btn = $('#btn_add_report');
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