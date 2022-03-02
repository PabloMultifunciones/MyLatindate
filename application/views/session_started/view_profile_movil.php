<div class="col-sm-12 col-md-8 p-l-80 dnone-pc">
   <div class="row">
      <div class="col-md-12 p-t-profile-100 zi-1 div_pro_head">
         <?php if ($get_profile_user[0]['profile_heading']!="") { ?>
         <p class="text-center fsize-20 pro_head"><i>"<?php echo $get_profile_user[0]['profile_heading']; ?>"</i></p>
         <?php } ?>
      </div>
      <div class="col-md-12 p-tb-2">
         <p class="title-about m-0"><strong>About Me</strong></p>
      </div>
      <div class="col-6 p-tb-2"><small><strong>Last active:</strong></small></div>
      <div class="col-6 p-tb-2 text-right"><small><?php 
         if ($logactive_user == "1") { echo "<i class='fa fa-circle text-success'></i> Active"; } else { echo $last_active." ago"; } ?></small></div>
      <?php if ($get_profile_user[0]['country_residence']!="" || $get_profile_user[0]['state_residence']!="" || $get_profile_user[0]['city_residence']!="") { ?>
      <div class="col-4 p-tb-2"><small><strong>Lives In:</strong></small></div>
      <div class="col-8 p-tb-2 text-right"><small>
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
      <?php } ?>
      <?php if ($get_profile_user[0]['age'] !=""): ?>
      <div class="col-4 p-tb-2"><small><strong>Age:</strong></small></div>
      <div class="col-8 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['age']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['education'] !=""): ?>
      <div class="col-4 p-tb-2"><small><strong>Education:</strong></small></div>
      <div class="col-8 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['education']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['marital_status'] !=""): ?>
      <div class="col-5 p-tb-2"><small><strong>Marital status:</strong></small></div>
      <div class="col-7 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['marital_status']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['have_children'] !=""): ?>
      <div class="col-5 p-tb-2"><small><strong>Have children:</strong></small></div>
      <div class="col-7 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['have_children']; ?></small></div>
      <?php endif ?>
      <?php if($get_profile_user[0]['have_children'] != "No") { ?>
      <?php if ($get_profile_user[0]['number_children'] !=""): ?>
      <div class="col-6 p-tb-2"><small><strong>Number children:</strong></small></div>
      <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['number_children']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['youngest_children'] !=""): ?>
      <div class="col-6 p-tb-2"><small><strong>Youngest children:</strong></small></div>
      <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['youngest_children']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['oldest_children'] !=""): ?>
      <div class="col-6 p-tb-2"><small><strong>Oldest children:</strong></small></div>
      <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['oldest_children']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['more_children'] !=""): ?>
      <div class="col-6 p-tb-2"><small><strong>Wants children:</strong></small></div>
      <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['more_children']; ?></small></div>
      <?php endif ?>
      <?php } ?>	
      <?php if ($get_profile_user[0]['drink'] !=""): ?>		
      <div class="col-4 p-tb-2"><small><strong>Drink:</strong></small></div>
      <div class="col-8 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['drink']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['smoke'] !=""): ?>
      <div class="col-4 p-tb-2"><small><strong>Smoke:</strong></small></div>
      <div class="col-8 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['smoke']; ?></small></div>
      <?php endif ?>
      <?php if ($get_profile_user[0]['religious'] !=""): ?>
      <div class="col-4 p-tb-2"><small><strong>Religion:</strong></small></div>
      <div class="col-8 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['religious']; ?></small></div>
      <?php endif ?>
      <div id="more-profile" class="col-12 p-tb-2"><i class="fa fa-chevron-down"></i> More</div>
      <div id="show-more" class="col-12 display-none">
         <div class="row">
            <?php if ($get_profile_user[0]['living_situacion'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Living situacion:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['living_situacion']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['willing_relocate'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Willing relocate:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['willing_relocate']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['nationality'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Nationality:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['nationality']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['languageSpoken'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Language spoken:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['languageSpoken']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['spanish_ability'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Spanish ability:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['spanish_ability']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['english_ability'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>English ability:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['english_ability']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['portuguese_ability'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Portuguese ability:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['portuguese_ability']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['ethnicity_mostly'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Ethnicity mostly:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['ethnicity_mostly']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['best_feature'] !=""): ?>
            <div class="col-5 p-tb-2"><small><strong>Best feature:</strong></small></div>
            <div class="col-7 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['best_feature']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['body_art'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Body art:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['body_art']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['appearance'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Appearance:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['appearance']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['have_pets'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Have pets:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['have_pets']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['hair_color'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Hair color:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['hair_color']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['hair_length'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Hair length:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['hair_length']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['hair_type'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Hair type:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['hair_type']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['eye_color'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Eye color:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['eye_color']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['eye_wear'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Eye wear:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['eye_wear']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['height'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Height:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['height']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['weight'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Weight:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['weight']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['body_type'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Body type:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['body_type']; ?></small></div>
            <?php endif ?>
            <?php if ($get_profile_user[0]['star_sign'] !=""): ?>
            <div class="col-6 p-tb-2"><small><strong>Star sign:</strong></small></div>
            <div class="col-6 p-tb-2 text-right"><small><?php echo $get_profile_user[0]['star_sign']; ?></small></div>
            <?php endif ?>
         </div>
      </div>
      <div id="less-profile" class="col-12 p-tb-2 display-none"><i class="fa fa-chevron-up"></i> Less</div>
   </div>
</div>