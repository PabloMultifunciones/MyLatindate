<div class="col-sm-12 col-md-8 p-l-80 p-t-profile-100 dnone-movil">
   <div class="row">
      <div class="col-md-12 dnone-name">
         <span class="fsize-22"><?php echo $get_data_user[0]['name_user']; ?>&nbsp<i class="fa fa-user"></i></span><br>
         <small class="fsize-14"><?php echo $get_profile_user[0]['age']; ?> <i class='fa fa-circle point-icon'></i> 
         <?php if ($get_profile_user[0]['city_residence'] !="") {
            $arr_profile_city = explode(",", $get_profile_user[0]['city_residence']); echo $arr_profile_city[1].', '; 
            }
            if ($get_profile_user[0]['state_residence'] !="") {
            $arr_profile_state = explode(",", $get_profile_user[0]['state_residence']); echo $arr_profile_state[1]; 
            }
            ?>
         </small><br>
         <small class="fsize-14"><?php 
            if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success'></i> Active"; } else { echo $last_active." ago"; } ?></small>
         <hr>
      </div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Lives In:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5 text-right">
         <small>
         <?php if ($get_profile_user[0]['city_residence'] !="") {
            $arr_profile_city = explode(",", $get_profile_user[0]['city_residence']); echo $arr_profile_city[1].', '; 
            }
            if ($get_profile_user[0]['state_residence'] !="") {
            $arr_profile_state = explode(",", $get_profile_user[0]['state_residence']); echo $arr_profile_state[1].', '; 
            }
            if ($get_profile_user[0]['country_residence'] !="") {
            $arr_profile_country = explode(",", $get_profile_user[0]['country_residence']); echo $arr_profile_country[1]; 
            } ?>
         </small>
      </div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Age:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee text-right"><small><?php echo $get_profile_user[0]['age']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Education:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5 text-right"><small><?php echo $get_profile_user[0]['education']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Marital status:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee text-right"><small><?php echo $get_profile_user[0]['marital_status']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Have children:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5 text-right"><small><?php echo $get_profile_user[0]['have_children']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Drink:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee text-right"><small><?php echo $get_profile_user[0]['drink']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Smoke:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5 text-right"><small><?php echo $get_profile_user[0]['smoke']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Religion:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee text-right"><small><?php echo $get_profile_user[0]['religious']; ?></small></div>
   </div>
</div>
<div class="col-md-12 p-t-profile-80 dnone-movil">
   <div class="row">
      <div class="col-md-12">
         <hr>
      </div>
      <div class="col-md-12 title-about m-0 p-tb-10"><strong>Personal Information</strong></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Living situacion:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['living_situacion']; ?></small></div>
      <?php if ($get_profile_user[0]['willing_relocate'] != ""): ?>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Willing relocate:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['willing_relocate']; ?></small></div>
      <?php endif ?>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Nationality:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['nationality']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Have children:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['have_children']; ?></small></div>
      <?php if($get_profile_user[0]['have_children'] != "No"){
         ?>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Number children:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['number_children']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Youngest children:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['youngest_children']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Oldest children:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['oldest_children']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Wants children:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['more_children']; ?></small></div>
      <?php
         } ?>	
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Language spoken:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['languageSpoken']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Spanish ability:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['spanish_ability']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>English ability:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['english_ability']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Portuguese ability:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['portuguese_ability']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Ethnicity mostly:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['ethnicity_mostly']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Best feature:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['best_feature']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Body art:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['body_art']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Have pets:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['have_pets']; ?></small></div>
   </div>
</div>
<div class="col-md-12 dnone-movil">
   <div class="row">
      <div class="col-md-12 title-about m-0 p-tb-20"><strong>Appearance</strong></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Appearance:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['appearance']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Hair color:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['hair_color']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Hair length:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['hair_length']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Hair type:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['hair_type']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Eye color:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['eye_color']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Eye wear:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['eye_wear']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Height:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['height']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Weight:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['weight']; ?></small></div>
      <div class="col-4 p-tb-2 bg-f8f8f8"><small>Body type:</small></div>
      <div class="col-8 p-tb-2 bg-eeeeee"><small><?php echo $get_profile_user[0]['body_type']; ?></small></div>
      <div class="col-4 p-tb-2 bg-eeeeee"><small>Star sign:</small></div>
      <div class="col-8 p-tb-2 bg-e5e5e5"><small><?php echo $get_profile_user[0]['star_sign']; ?></small></div>
   </div>
</div>