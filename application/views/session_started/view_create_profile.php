<?php
$uri_segment = $this->uri->segment(2);
$var_url = "";
if ($uri_segment == "Myprofile") { 
  $var_url = "create";
} else if ($uri_segment == "Change-Profile") {
  $var_url = "change";
}
?>
<form id="form_myprofile" action="<?php echo base_url('Home/create_profile/'.$var_url); ?>" method="POST" enctype="multipart/form-data">

  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <div class="alert alert-danger display-none" id="carg_error_msg"></div>
      </div>

      <?php if (isset($account_facebook_id) && $account_facebook_id!="") { ?>
        <div class="col-md-6">
          <div class="form-group">
            <label for="gender_user"><?= lang('gender') ?>:</label>
            <select class="form-control" id="gender_user" name="gender_user">
              <option value="2"><?= lang('woman') ?></option>
              <option value="1"><?= lang('man') ?></option>
            </select>
          </div>
        </div>
      <?php } ?>

      <div class="col-md-6">
        <div class="form-group">
          <label for="living_situacion"><?= lang('living_situation') ?>:</label>
          <select class="form-control" id="living_situacion" name="living_situacion">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['living_situacion'].'" selected>'.$get_profile_user[0]['living_situacion'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <option value="<?= lang('live_alone') ?>"><?= lang('live_alone') ?></option>
            <option value="<?= lang('live_friend') ?>"><?= lang('live_friend') ?></option>
            <option value="<?= lang('live_family') ?>"><?= lang('live_family') ?></option>
            <option value="<?= lang('live_kids') ?>"><?= lang('live_kids') ?></option>
            <option value="<?= lang('live_spouse') ?>"><?= lang('live_spouse') ?></option>
            <option value="<?= lang('other') ?>"><?= lang('other') ?></option>
            <option value="<?= lang('prefer_not_say') ?>"><?= lang('prefer_not_say') ?></option>
          </select>
        </div>
      </div>

      <?php if($gender_user == "2") { ?> 
        <div class="col-md-6">
          <div class="form-group">
            <label for="willing_relocate"><?= lang('willing_relocate') ?>:</label>
            <select class="form-control" id="willing_relocate" name="willing_relocate">
              <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['willing_relocate'].'" selected>'.$get_profile_user[0]['willing_relocate'].'</option>'; } ?>
              <option value=""><?= lang('please_select') ?>...</option>
              <option value="<?= lang('Willing_my_country') ?>"><?= lang('Willing_my_country') ?></option>
              <option value="<?= lang('Willing_another_country') ?>"><?= lang('Willing_another_country') ?></option>
              <option value="<?= lang('willing_relocate') ?>"><?= lang('willing_relocate') ?></option>
              <option value="<?= lang('Not_sure_relocating') ?>"><?= lang('Not_sure_relocating') ?></option>
            </select>
          </div>
        </div>
      <?php } ?>

      <div class="col-md-6">
        <div class="form-group">
          <p for="checkbox"><?= lang('relationship_looking') ?>:</p>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div class="form-check m-0" id="msg_penpal_error">
                  <input type="checkbox" class="form-check-input position-static" id="penpal" name="penpal" value="1" <?php if (isset($get_profile_user)) { if ($get_profile_user[0]['penpal'] == 1) { echo "checked"; } } ?>> <span><?= lang('penpal') ?></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check m-0" id="msg_friendship_error">
                  <input type="checkbox" class="form-check-input position-static" id="friendship" name="friendship" value="1" <?php if (isset($get_profile_user)) { if ($get_profile_user[0]['friendship'] == 1) { echo "checked"; } } ?>> <span><?= lang('friendship') ?></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check m-0" id="msg_romance_dating_error">
                  <input type="checkbox" class="form-check-input position-static" id="romance_dating" name="romance_dating" value="1" <?php if (isset($get_profile_user)) { if ($get_profile_user[0]['romance_dating'] == 1) { echo "checked"; } } ?>> <span><?= lang('romance_dating') ?></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check m-0" id="msg_long_relationship_error">
                  <input type="checkbox" class="form-check-input position-static" id="long_relationship" name="long_relationship" value="1" <?php if (isset($get_profile_user)) { if ($get_profile_user[0]['long_relationship'] == 1) { echo "checked"; } } ?>> <span><?= lang('long_term') ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <p for="country_residence" style="color: #565656;"><?= lang('background_culture') ?></p>
          <hr>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="country_residence"><?= lang('country_residence') ?>:</label>
          <select class="form-control" id="country_residence" name="country_residence">
            <?php if (isset($get_profile_user)) { $country = explode(",", $get_profile_user[0]['country_residence']); echo '<option value="'.$get_profile_user[0]['country_residence'].'" selected>'.$country[1].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <?php foreach ($get_place_country->result() as $key) {
              echo "<option value='".$key->id.",".$key->name."'>".$key->name."</option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="state_residence"><?= lang('state_province_residence') ?>:</label>
          <select class="form-control" id="state_residence" name="state_residence">
            <?php if (isset($get_profile_user)) { $state = explode(",", $get_profile_user[0]['state_residence']); echo '<option value="'.$get_profile_user[0]['state_residence'].'" selected>'.$state[1].'</option>'; } ?>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="city_residence"><?= lang('city_residence') ?>:</label>
          <select class="form-control" id="city_residence" name="city_residence">
            <?php if (isset($get_profile_user)) { $city = explode(",", $get_profile_user[0]['city_residence']); echo '<option value="'.$get_profile_user[0]['city_residence'].'" selected>'.$city[1].'</option>'; } ?>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="nationality"><?= lang('nationality') ?>:</label>
          <select class="form-control" id="nationality" name="nationality">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['nationality'].'" selected>'.$get_profile_user[0]['nationality'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <option value="<?= lang('Afghan') ?>"><?= lang('Afghan') ?></option>
            <option value="<?= lang('Albanian') ?>"><?= lang('Albanian') ?></option>
            <option value="<?= lang('Algerian') ?>"><?= lang('Algerian') ?></option>
            <option value="<?= lang('American') ?>"><?= lang('American') ?></option>
            <option value="<?= lang('Andorran') ?>"><?= lang('Andorran') ?></option>
            <option value="<?= lang('Angolan') ?>"><?= lang('Angolan') ?></option>
            <option value="<?= lang('Antiguans') ?>"><?= lang('Antiguans') ?></option>
            <option value="<?= lang('Argentinean') ?>"><?= lang('Argentinean') ?></option>
            <option value="<?= lang('Armenian') ?>"><?= lang('Armenian') ?></option>
            <option value="<?= lang('Australian') ?>"><?= lang('Australian') ?></option>
            <option value="<?= lang('Austrian') ?>"><?= lang('Austrian') ?></option>
            <option value="<?= lang('Azerbaijani') ?>"><?= lang('Azerbaijani') ?></option>
            <option value="<?= lang('Bahamian') ?>"><?= lang('Bahamian') ?></option>
            <option value="<?= lang('Bahraini') ?>"><?= lang('Bahraini') ?></option>
            <option value="<?= lang('Bangladeshi') ?>"><?= lang('Bangladeshi') ?></option>
            <option value="<?= lang('Barbadian') ?>"><?= lang('Barbadian') ?></option>
            <option value="<?= lang('Barbudans') ?>"><?= lang('Barbudans') ?></option>
            <option value="<?= lang('Batswana') ?>"><?= lang('Batswana') ?></option>
            <option value="<?= lang('Belarusian') ?>"><?= lang('Belarusian') ?></option>
            <option value="<?= lang('Belgian') ?>"><?= lang('Belgian') ?></option>
            <option value="<?= lang('Belizean') ?>"><?= lang('Belizean') ?></option>
            <option value="<?= lang('Beninese') ?>"><?= lang('Beninese') ?></option>
            <option value="<?= lang('Bhutanese') ?>"><?= lang('Bhutanese') ?></option>
            <option value="<?= lang('Bolivian') ?>"><?= lang('Bolivian') ?></option>
            <option value="<?= lang('Bosnian') ?>"><?= lang('Bosnian') ?></option>
            <option value="<?= lang('Brazilian') ?>"><?= lang('Brazilian') ?></option>
            <option value="<?= lang('British') ?>"><?= lang('British') ?></option>
            <option value="<?= lang('Bruneian') ?>"><?= lang('Bruneian') ?></option>
            <option value="<?= lang('Bulgarian') ?>"><?= lang('Bulgarian') ?></option>
            <option value="<?= lang('Burkinabe') ?>"><?= lang('Burkinabe') ?></option>
            <option value="<?= lang('Burmese') ?>"><?= lang('Burmese') ?></option>
            <option value="<?= lang('Burundian') ?>"><?= lang('Burundian') ?></option>
            <option value="<?= lang('Cambodian') ?>"><?= lang('Cambodian') ?></option>
            <option value="<?= lang('Cameroonian') ?>"><?= lang('Cameroonian') ?></option>
            <option value="<?= lang('Canadian') ?>"><?= lang('Canadian') ?></option>
            <option value="Cape <?= lang('Verdean') ?>">Cape <?= lang('Verdean') ?></option>
            <option value="Central <?= lang('African') ?>">Central <?= lang('African') ?></option>
            <option value="<?= lang('Chadian') ?>"><?= lang('Chadian') ?></option>
            <option value="<?= lang('Chilean') ?>"><?= lang('Chilean') ?></option>
            <option value="<?= lang('Chinese') ?>"><?= lang('Chinese') ?></option>
            <option value="<?= lang('Colombian') ?>"><?= lang('Colombian') ?></option>
            <option value="<?= lang('Comoran') ?>"><?= lang('Comoran') ?></option>
            <option value="<?= lang('Congolese') ?>"><?= lang('Congolese') ?></option>
            <option value="Costa <?= lang('Rican') ?> rican">Costa <?= lang('Rican') ?></option>
            <option value="<?= lang('Croatian') ?>"><?= lang('Croatian') ?></option>
            <option value="<?= lang('Cuban') ?>"><?= lang('Cuban') ?></option>
            <option value="<?= lang('Cypriot') ?>"><?= lang('Cypriot') ?></option>
            <option value="<?= lang('Czech') ?>"><?= lang('Czech') ?></option>
            <option value="<?= lang('Danish') ?>"><?= lang('Danish') ?></option>
            <option value="<?= lang('Djibouti') ?>"><?= lang('Djibouti') ?></option>
            <option value="<?= lang('Dominican') ?>"><?= lang('Dominican') ?></option>
            <option value="<?= lang('Dutch') ?>"><?= lang('Dutch') ?></option>
            <option value="East <?= lang('Timorese') ?>">East <?= lang('Timorese') ?></option>
            <option value="<?= lang('Ecuadorean') ?>"><?= lang('Ecuadorean') ?></option>
            <option value="<?= lang('Egyptian') ?>"><?= lang('Egyptian') ?></option>
            <option value="<?= lang('Emirian') ?>"><?= lang('Emirian') ?></option>
            <option value="Equatorial <?= lang('Guinean') ?>">Equatorial <?= lang('Guinean') ?></option>
            <option value="<?= lang('Eritrean') ?>"><?= lang('Eritrean') ?></option>
            <option value="<?= lang('Estonian') ?>"><?= lang('Estonian') ?></option>
            <option value="<?= lang('Ethiopian') ?>"><?= lang('Ethiopian') ?></option>
            <option value="<?= lang('Fijian') ?>"><?= lang('Fijian') ?></option>
            <option value="<?= lang('Filipino') ?>"><?= lang('Filipino') ?></option>
            <option value="<?= lang('Finnish') ?>"><?= lang('Finnish') ?></option>
            <option value="<?= lang('French') ?>"><?= lang('French') ?></option>
            <option value="<?= lang('Gabonese') ?>"><?= lang('Gabonese') ?></option>
            <option value="<?= lang('Gambian') ?>"><?= lang('Gambian') ?></option>
            <option value="<?= lang('Georgian') ?>"><?= lang('Georgian') ?></option>
            <option value="<?= lang('German') ?>"><?= lang('German') ?></option>
            <option value="<?= lang('Ghanaian') ?>"><?= lang('Ghanaian') ?></option>
            <option value="<?= lang('Greek') ?>"><?= lang('Greek') ?></option>
            <option value="<?= lang('Grenadian') ?>"><?= lang('Grenadian') ?></option>
            <option value="<?= lang('Guatemalan') ?>"><?= lang('Guatemalan') ?></option>
            <option value="Guinea-<?= lang('Bissauan') ?>">Guinea-<?= lang('Bissauan') ?></option>
            <option value="<?= lang('Guinean') ?>"><?= lang('Guinean') ?></option>
            <option value="<?= lang('Guyanese') ?>"><?= lang('Guyanese') ?></option>
            <option value="<?= lang('Haitian') ?>"><?= lang('Haitian') ?></option>
            <option value="<?= lang('Herzegovinian') ?>"><?= lang('Herzegovinian') ?></option>
            <option value="<?= lang('Honduran') ?>"><?= lang('Honduran') ?></option>
            <option value="<?= lang('Hungarian') ?>"><?= lang('Hungarian') ?></option>
            <option value="<?= lang('Icelander') ?>"><?= lang('Icelander') ?></option>
            <option value="<?= lang('Indian') ?>"><?= lang('Indian') ?></option>
            <option value="<?= lang('Indonesian') ?>"><?= lang('Indonesian') ?></option>
            <option value="<?= lang('Iranian') ?>"><?= lang('Iranian') ?></option>
            <option value="<?= lang('Iraqi') ?>"><?= lang('Iraqi') ?></option>
            <option value="<?= lang('Irish') ?>"><?= lang('Irish') ?></option>
            <option value="<?= lang('Israeli') ?>"><?= lang('Israeli') ?></option>
            <option value="<?= lang('Italian') ?>"><?= lang('Italian') ?></option>
            <option value="<?= lang('Ivorian') ?>"><?= lang('Ivorian') ?></option>
            <option value="<?= lang('Jamaican') ?>"><?= lang('Jamaican') ?></option>
            <option value="<?= lang('Japanese') ?>"><?= lang('Japanese') ?></option>
            <option value="<?= lang('Jordanian') ?>"><?= lang('Jordanian') ?></option>
            <option value="<?= lang('Kazakhstani') ?>"><?= lang('Kazakhstani') ?></option>
            <option value="<?= lang('Kenyan') ?>"><?= lang('Kenyan') ?></option>
            <option value="Kittian and <?= lang('Nevisian') ?>">Kittian and <?= lang('Nevisian') ?></option>
            <option value="<?= lang('Kuwaiti') ?>"><?= lang('Kuwaiti') ?></option>
            <option value="<?= lang('Kyrgyz') ?>"><?= lang('Kyrgyz') ?></option>
            <option value="<?= lang('Laotian') ?>"><?= lang('Laotian') ?></option>
            <option value="<?= lang('Latvian') ?>"><?= lang('Latvian') ?></option>
            <option value="<?= lang('Lebanese') ?>"><?= lang('Lebanese') ?></option>
            <option value="<?= lang('Liberian') ?>"><?= lang('Liberian') ?></option>
            <option value="<?= lang('Libyan') ?>"><?= lang('Libyan') ?></option>
            <option value="<?= lang('Liechtensteiner') ?>"><?= lang('Liechtensteiner') ?></option>
            <option value="<?= lang('Lithuanian') ?>"><?= lang('Lithuanian') ?></option>
            <option value="<?= lang('Luxembourger') ?>"><?= lang('Luxembourger') ?></option>
            <option value="<?= lang('Macedonian') ?>"><?= lang('Macedonian') ?></option>
            <option value="<?= lang('Malagasy') ?>"><?= lang('Malagasy') ?></option>
            <option value="<?= lang('Malawian') ?>"><?= lang('Malawian') ?></option>
            <option value="<?= lang('Malaysian') ?>"><?= lang('Malaysian') ?></option>
            <option value="<?= lang('Maldivan') ?>"><?= lang('Maldivan') ?></option>
            <option value="<?= lang('Malian') ?>"><?= lang('Malian') ?></option>
            <option value="<?= lang('Maltese') ?>"><?= lang('Maltese') ?></option>
            <option value="<?= lang('Marshallese') ?>"><?= lang('Marshallese') ?></option>
            <option value="<?= lang('Mauritanian') ?>"><?= lang('Mauritanian') ?></option>
            <option value="<?= lang('Mauritian') ?>"><?= lang('Mauritian') ?></option>
            <option value="<?= lang('Mexican') ?>"><?= lang('Mexican') ?></option>
            <option value="<?= lang('Micronesian') ?>"><?= lang('Micronesian') ?></option>
            <option value="<?= lang('Moldovan') ?>"><?= lang('Moldovan') ?></option>
            <option value="<?= lang('Monacan') ?>"><?= lang('Monacan') ?></option>
            <option value="<?= lang('Mongolian') ?>"><?= lang('Mongolian') ?></option>
            <option value="<?= lang('Moroccan') ?>"><?= lang('Moroccan') ?></option>
            <option value="<?= lang('Mosotho') ?>"><?= lang('Mosotho') ?></option>
            <option value="<?= lang('Motswana') ?>"><?= lang('Motswana') ?></option>
            <option value="<?= lang('Mozambican') ?>"><?= lang('Mozambican') ?></option>
            <option value="<?= lang('Namibian') ?>"><?= lang('Namibian') ?></option>
            <option value="<?= lang('Nauruan') ?>"><?= lang('Nauruan') ?></option>
            <option value="<?= lang('Nepalese') ?>"><?= lang('Nepalese') ?></option>
            <option value="New <?= lang('Zealander') ?>">New <?= lang('Zealander') ?></option>
            <option value="Ni-<?= lang('Vanuatu') ?>">Ni-<?= lang('Vanuatu') ?></option>
            <option value="<?= lang('Nicaraguan') ?>"><?= lang('Nicaraguan') ?></option>
            <option value="<?= lang('Nigerien') ?>"><?= lang('Nigerien') ?></option>
            <option value="North <?= lang('Korean') ?>">North <?= lang('Korean') ?></option>
            <option value="Northern <?= lang('Irish') ?>">Northern <?= lang('Irish') ?></option>
            <option value="<?= lang('Norwegian') ?>"><?= lang('Norwegian') ?></option>
            <option value="<?= lang('Omani') ?>"><?= lang('Omani') ?></option>
            <option value="<?= lang('Pakistani') ?>"><?= lang('Pakistani') ?></option>
            <option value="<?= lang('Palauan') ?>"><?= lang('Palauan') ?></option>
            <option value="<?= lang('Panamanian') ?>"><?= lang('Panamanian') ?></option>
            <option value="Papua New <?= lang('Guinean') ?>">Papua New <?= lang('Guinean') ?></option>
            <option value="<?= lang('Paraguayan') ?>"><?= lang('Paraguayan') ?></option>
            <option value="<?= lang('Peruvian') ?>"><?= lang('Peruvian') ?></option>
            <option value="<?= lang('Polish') ?>"><?= lang('Polish') ?></option>
            <option value="<?= lang('Portuguese') ?>"><?= lang('Portuguese') ?></option>
            <option value="<?= lang('Qatari') ?>"><?= lang('Qatari') ?></option>
            <option value="<?= lang('Romanian') ?>"><?= lang('Romanian') ?></option>
            <option value="<?= lang('Russian') ?>"><?= lang('Russian') ?></option>
            <option value="<?= lang('Rwandan') ?>"><?= lang('Rwandan') ?></option>
            <option value="Saint <?= lang('Lucian') ?>">Saint <?= lang('Lucian') ?></option>
            <option value="<?= lang('Salvadoran') ?>"><?= lang('Salvadoran') ?></option>
            <option value="<?= lang('Samoan') ?>"><?= lang('Samoan') ?></option>
            <option value="San <?= lang('Marinese') ?>">San <?= lang('Marinese') ?></option>
            <option value="Sao <?= lang('Tomean') ?>">Sao <?= lang('Tomean') ?></option>
            <option value="<?= lang('Saudi') ?>"><?= lang('Saudi') ?></option>
            <option value="<?= lang('Scottish') ?>"><?= lang('Scottish') ?></option>
            <option value="<?= lang('Senegalese') ?>"><?= lang('Senegalese') ?></option>
            <option value="<?= lang('Serbian') ?>"><?= lang('Serbian') ?></option>
            <option value="<?= lang('Seychellois') ?>"><?= lang('Seychellois') ?></option>
            <option value="Sierra <?= lang('Leonean') ?>">Sierra <?= lang('Leonean') ?></option>
            <option value="<?= lang('Singaporean') ?>"><?= lang('Singaporean') ?></option>
            <option value="<?= lang('Slovakian') ?>"><?= lang('Slovakian') ?></option>
            <option value="<?= lang('Slovenian') ?>"><?= lang('Slovenian') ?></option>
            <option value="Solomon <?= lang('Islander') ?>">Solomon <?= lang('Islander') ?></option>
            <option value="<?= lang('Somali') ?>"><?= lang('Somali') ?></option>
            <option value="South <?= lang('African') ?>">South <?= lang('African') ?></option>
            <option value="South <?= lang('Korean') ?>">South <?= lang('Korean') ?></option>
            <option value="<?= lang('Spanish') ?>"><?= lang('Spanish') ?></option>
            <option value="Sri <?= lang('Lankan') ?>">Sri <?= lang('Lankan') ?></option>
            <option value="<?= lang('Sudanese') ?>"><?= lang('Sudanese') ?></option>
            <option value="<?= lang('Surinamer') ?>"><?= lang('Surinamer') ?></option>
            <option value="<?= lang('Swazi') ?>"><?= lang('Swazi') ?></option>
            <option value="<?= lang('Swedish') ?>"><?= lang('Swedish') ?></option>
            <option value="<?= lang('Swiss') ?>"><?= lang('Swiss') ?></option>
            <option value="<?= lang('Syrian') ?>"><?= lang('Syrian') ?></option>
            <option value="<?= lang('Taiwanese') ?>"><?= lang('Taiwanese') ?></option>
            <option value="<?= lang('Tajik') ?>"><?= lang('Tajik') ?></option>
            <option value="<?= lang('Tanzanian') ?>"><?= lang('Tanzanian') ?></option>
            <option value="<?= lang('Thai') ?>"><?= lang('Thai') ?></option>
            <option value="<?= lang('Togolese') ?>"><?= lang('Togolese') ?></option>
            <option value="<?= lang('Tongan') ?>"><?= lang('Tongan') ?></option>
            <option value="Trinidadian or <?= lang('Tobagonian') ?> or tobagonian">Trinidadian or <?= lang('Tobagonian') ?></option>
            <option value="<?= lang('Tunisian') ?>"><?= lang('Tunisian') ?></option>
            <option value="<?= lang('Turkish') ?>"><?= lang('Turkish') ?></option>
            <option value="<?= lang('Tuvaluan') ?>"><?= lang('Tuvaluan') ?></option>
            <option value="<?= lang('Ugandan') ?>"><?= lang('Ugandan') ?></option>
            <option value="<?= lang('Ukrainian') ?>"><?= lang('Ukrainian') ?></option>
            <option value="<?= lang('Uruguayan') ?>"><?= lang('Uruguayan') ?></option>
            <option value="<?= lang('Uzbekistani') ?>"><?= lang('Uzbekistani') ?></option>
            <option value="<?= lang('Venezuelan') ?>"><?= lang('Venezuelan') ?></option>
            <option value="<?= lang('Vietnamese') ?>"><?= lang('Vietnamese') ?></option>
            <option value="<?= lang('Welsh') ?>"><?= lang('Welsh') ?></option>
            <option value="<?= lang('Yemenite') ?>"><?= lang('Yemenite') ?></option>
            <option value="<?= lang('Zambian') ?>"><?= lang('Zambian') ?></option>
            <option value="<?= lang('Zimbabwean') ?>"><?= lang('Zimbabwean') ?></option>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="marital_status"><?= lang('marital_status') ?>?</label>
          <select class="form-control" id="marital_status" name="marital_status">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['marital_status'].'" selected>'.$get_profile_user[0]['marital_status'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <option value="<?= lang('single') ?>"><?= lang('single') ?></option>
            <option value="<?= lang('separated') ?>"><?= lang('separated') ?></option>
            <option value="<?= lang('windowed') ?>"><?= lang('windowed') ?></option>
            <option value="<?= lang('divorced') ?>"><?= lang('divorced') ?></option>
            <option value="<?= lang('other') ?>"><?= lang('other') ?></option>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="have_children"><?= lang('do_you_have_children') ?>?</label>
          <select class="form-control" id="have_children" name="have_children">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['have_children'].'" selected>'.$get_profile_user[0]['have_children'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <option value="<?= lang('no') ?>"><?= lang('no') ?></option>
            <option value="<?= lang('dont_live_home') ?>"><?= lang('dont_live_home') ?></option>
            <option value="<?= lang('sometimes_live_home') ?>"><?= lang('sometimes_live_home') ?></option>
            <option value="<?= lang('live_home') ?>"><?= lang('live_home') ?></option>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="number_children"><?= lang('number_children') ?>?</label>
          <select class="form-control" id="number_children" name="number_children">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['number_children'].'" selected>'.$get_profile_user[0]['number_children'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="height"><?= lang('height') ?>:</label>
          <select class="form-control" id="height" name="height">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['height'].'" selected>'.$get_profile_user[0]['height'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>

            <?php for ($i=140; $i <= 200; $i++) { ?>
              <option value="<?= $i.' cm' ?>"><?= $i.' cm' ?></option>
            <?php } ?>

          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="weight"><?= lang('weight') ?>:</label>
          <select class="form-control" id="weight" name="weight">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['weight'].'" selected>'.$get_profile_user[0]['weight'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>

            <?php for ($i=40; $i <= 150; $i++) { ?>
              <option value="<?= $i.' kg' ?>"><?= $i.' kg' ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="age"><?= lang('age') ?>:</label>
          <select class="form-control" id="age" name="age">
            <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['age'].'" selected>'.$get_profile_user[0]['age'].'</option>'; } ?>
            <option value=""><?= lang('please_select') ?>...</option>
            <?php for ($i=18; $i <= 60; $i++) { ?>
              <option value="<?= $i ?>"><?= $i ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <p for="profile_heading" style="color: #565656;"><?= lang('more_about_me') ?></p>
          <hr>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="profile_heading"><?= lang('your_profile_heading') ?>:</label>
          <textarea class="form-control height-ta" id="profile_heading" name="profile_heading" maxlength="100"><?php if (isset($get_profile_user)) { echo $get_profile_user[0]['profile_heading']; } ?></textarea>
          <small><span id="rcharsPH">100</span> Character(s) Remaining</small>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="about_yourself"><?= lang('little_about_yourself') ?>:</label>
          <textarea class="form-control height-ta" id="about_yourself" name="about_yourself" maxlength="200"><?php if (isset($get_profile_user)) { echo $get_profile_user[0]['about_yourself']; } ?></textarea>
          <small><span id="rcharsAY">200</span> Character(s) Remaining</small>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="looking_partner"><?= lang('looking_partner') ?>:</label>
          <textarea class="form-control height-ta" id="looking_partner" name="looking_partner" maxlength="200"><?php if (isset($get_profile_user)) { echo $get_profile_user[0]['looking_partner']; } ?></textarea>
          <small><span id="rcharsLP">200</span> Character(s) Remaining</small>
        </div>
      </div>

      <div class="col-md-12">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="photo_profile_user"><?= lang('photo_profile_user') ?>:</label><br>

                <img id="ImgProfile" style="width: 50%" src="<?= (isset($get_profile_user) && $get_profile_user[0]['photo_profile_user']!="") ? base_url('img/profile/profile/'.$get_profile_user[0]['id_user'].'/'.$get_profile_user[0]['photo_profile_user']) : base_url('img/profile/no-upload-image.png') ?>" alt="Image User Mylatindate">

                <input type="file" class="w-100" id="photo_profile_user" name="photo_profile_user" onchange="readURLProfile(this);">

                <input type="hidden" id="photo_profile_user_sec" name="photo_profile_user_sec" value="<?= (isset($get_profile_user) && $get_profile_user[0]['photo_profile_user']!="") ? $get_profile_user[0]['photo_profile_user'] : '' ?>">
              </div>
              
            </div>

            <?php if ($this->uri->segment(2) != "Change-Profile") { ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="photo_profile_user"><?= lang('photo_verify_user') ?>:</label><br>
                  <p style="font-size: 14px !important;"><?= lang('verify_account_text_1') ?></p>
                  <p style="font-size: 14px !important;"><?= lang('verify_account_text_2') ?></p><br>
                  <h4><strong><?= lang('charge_file') ?></strong></h4>

                  <img id="ImgVerify"  style="width: 50%" src="<?php echo base_url('img/src/id-card-user.jpg'); ?>" alt="id-card user">

                  <input type='file' class="w-100" name="photo_verify_user" onchange="readURLVerify(this);" accept="image/*">

                  <input type="hidden" id="photo_verify_user_sec" name="photo_verify_user_sec" value="<?= (isset($get_profile_user) && $get_profile_user[0]['photo_verify_user']!="") ? $get_profile_user[0]['photo_verify_user'] : '' ?>"><br><br>

                  <p style="font-size: 14px !important;"><?= lang('verify_account_text_3') ?></p>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div> 


<!-- FORM CHECK -->
            
                
            <div class="col-md-12 text-center" id="terms_service">
                
                <div class="form-check mt-3 m-0">
                  <input class="form-check-input" type="checkbox" id="one">
                  <label class="form-check-label pl-20" for="one" data-toggle="modal" data-target="#oneTerms">
                    <?= lang('payment_terms_service'); ?>
                  </label>
                </div>
                
                 <div class="form-check mt-3 m-0">
                  <input class="form-check-input" type="checkbox" value="" id="two">
                  <label class="form-check-label pl-20" for="two" data-toggle="modal" data-target="#twoTerms">
                    <?= lang('payment_terms_policy_privacy'); ?>
                  </label>
                </div>
                
                <div class="form-check mt-3 m-0">
                  <input class="form-check-input" type="checkbox" value="" id="three">
                  <label class="form-check-label pl-20" for="three"  data-toggle="modal" data-target="#threeTerms">
                    <?= lang('payment_terms_canllation_policy'); ?>
                  </label>
                </div>
                
              </div>
              
              
                

    <div class="modal fade" id="oneTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title title-modal" id="exampleModalLabel"> <?= lang('terms_of_service'); ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body font-weight-bold">
              <?= lang('content_terms_service'); ?>            
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      

      <div class="modal fade" id="twoTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title title-modal" id="exampleModalLabel"> <?= lang('terms_policy_privacy'); ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body font-weight-bold">
              <?= lang('content_terms_policy_pricacy'); ?>           
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="threeTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999999;">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title title-modal" id="exampleModalLabel"> <?= lang('cancellation_policy'); ?> </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body font-weight-bold">
              <?= lang('content_terms_cancellation_policy'); ?>           
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      
      

  <!-- <div class="form-group">
    <label for="ethnicity_mostly"><?= lang('ethnicity_mostly') ?>:</label>
    <select class="form-control" id="ethnicity_mostly" name="ethnicity_mostly">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['ethnicity_mostly'].'" selected>'.$get_profile_user[0]['ethnicity_mostly'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <optgroup label="<?= lang('white') ?>">
        <option value="<?= lang('english') ?>"><?= lang('english') ?></option>
        <option value="<?= lang('welsh') ?>"><?= lang('welsh') ?></option>
        <option value="<?= lang('scottish') ?>"><?= lang('scottish') ?></option>
        <option value="<?= lang('northern_irish') ?>"><?= lang('northern_irish') ?></option>
        <option value="<?= lang('irish') ?>"><?= lang('irish') ?></option>
        <option value="<?= lang('gypsy_raveller') ?>"><?= lang('gypsy_raveller') ?></option>
        <option value="<?= lang('any_background') ?>"><?= lang('any_background') ?></option>
      </optgroup>
      <optgroup label="<?= lang('multiple_ethnic_groups') ?>">
        <option value="<?= lang('white_black_caribbean') ?>"><?= lang('white_black_caribbean') ?></option>
        <option value="<?= lang('white_black_african') ?>"><?= lang('white_black_african') ?></option>
        <option value="<?= lang('any_other_multiple_background') ?>"><?= lang('any_other_multiple_background') ?></option>
      </optgroup>
      <optgroup label="<?= lang('asian') ?>">
        <option value="<?= lang('indian') ?>"><?= lang('indian') ?></option>
        <option value="<?= lang('pakistani') ?>"><?= lang('pakistani') ?></option>
        <option value="<?= lang('bangladeshi') ?>"><?= lang('bangladeshi') ?></option>
        <option value="<?= lang('chinese') ?>"><?= lang('chinese') ?></option>
        <option value="<?= lang('any_other_asian_background') ?>"><?= lang('any_other_asian_background') ?></option>
      </optgroup>
      <optgroup label="<?= lang('black') ?>">
        <option value="<?= lang('african') ?>"><?= lang('african') ?></option>
        <option value="<?= lang('african_american') ?>"><?= lang('african_american') ?></option>
        <option value="<?= lang('caribbean') ?>"><?= lang('caribbean') ?></option>
        <option value="<?= lang('any_other_black_background') ?>"><?= lang('any_other_black_background') ?></option>
      </optgroup>
      <optgroup label="<?= lang('other_ethnic_groups') ?>">
        <option value="<?= lang('arab') ?>"><?= lang('arab') ?></option>
        <option value="<?= lang('hispanic') ?>"><?= lang('hispanic') ?></option>
        <option value="<?= lang('latino') ?>"><?= lang('latino') ?></option>
        <option value="<?= lang('native_merican') ?>"><?= lang('native_merican') ?></option>
        <option value="<?= lang('pacific_islander') ?>"><?= lang('pacific_islander') ?></option>
        <option value="<?= lang('any_other_ethnic_group') ?>"><?= lang('any_other_ethnic_group') ?></option>
      </optgroup>
    </select>
  </div>
  <div class="form-group">
    <label for="best_feature"><?= lang('best_feature') ?>:</label>
    <select class="form-control" id="best_feature" name="best_feature">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['best_feature'].'" selected>'.$get_profile_user[0]['best_feature'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="<?= lang('my_hands') ?>"><?= lang('my_hands') ?></option>
      <option value="<?= lang('my_legs') ?>"><?= lang('my_legs') ?></option>
      <option value="<?= lang('my_lips') ?>"><?= lang('my_lips') ?></option>
      <option value="<?= lang('my_personality') ?>"><?= lang('my_personality') ?></option>
      <option value="<?= lang('my_smile') ?>"><?= lang('my_smile') ?></option>
      <option value="<?= lang('lucky_show') ?>"><?= lang('lucky_show') ?></option>
      <option value="<?= lang('other') ?>"><?= lang('other') ?></option>
      <option value="<?= lang('dont') ?>"><?= lang('dont') ?></option>
      <option value="<?= lang('prefer_not_say') ?>"><?= lang('prefer_not_say') ?></option>
    </select>
  </div>
  <div class="form-group">
    <p for="situacion"><?= lang('lifestyle') ?></p>
    <label for="drink"><?= lang('do_you_drink') ?>?</label>
    <select class="form-control" id="drink" name="drink">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['drink'].'" selected>'.$get_profile_user[0]['drink'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="<?= lang('do_drink') ?>"><?= lang('do_drink') ?></option>
      <option value="<?= lang('dont_drink') ?>"><?= lang('dont_drink') ?></option>
      <option value="<?= lang('occasionally_drink') ?>"><?= lang('occasionally_drink') ?></option>
    </select>
  </div>
  <div class="form-group">
    <label for="smoke"><?= lang('do_you_smoke') ?>?</label>
    <select class="form-control" id="smoke" name="smoke">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['smoke'].'" selected>'.$get_profile_user[0]['smoke'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="<?= lang('do_smoke') ?>"><?= lang('do_smoke') ?></option>
      <option value="<?= lang('dont_smoke') ?>"><?= lang('dont_smoke') ?></option>
      <option value="<?= lang('occasionally_smoke') ?>"><?= lang('occasionally_smoke') ?></option>
    </select>
  </div> -->

  <!-- <div class="form-group">
    <label for="oldest_children"><?= lang('oldest_child') ?>?</label>
    <select class="form-control" id="oldest_children" name="oldest_children">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['oldest_children'].'" selected>'.$get_profile_user[0]['oldest_children'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
    </select>
  </div>
  <div class="form-group">
    <label for="youngest_children"><?= lang('youngest_child') ?>?</label>
    <select class="form-control" id="youngest_children" name="youngest_children">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['youngest_children'].'" selected>'.$get_profile_user[0]['youngest_children'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
    </select>
  </div>
  <div class="form-group">
    <label for="more_children"><?= lang('do_you_want_children') ?>?</label>
    <select class="form-control" id="more_children" name="more_children">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['more_children'].'" selected>'.$get_profile_user[0]['more_children'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="<?= lang('yes') ?>"><?= lang('yes') ?></option>
      <option value="<?= lang('not_sure') ?>"><?= lang('not_sure') ?></option>
      <option value="<?= lang('no') ?>"><?= lang('no') ?></option>
    </select>
  </div> -->

  <!-- 
  <div class="form-group">
    <label for="body_type"><?= lang('body_type') ?>:</label>
    <select class="form-control" id="body_type" name="body_type">
      <?php if (isset($get_profile_user)) { echo '<option value="'.$get_profile_user[0]['body_type'].'" selected>'.$get_profile_user[0]['body_type'].'</option>'; } ?>
      <option value=""><?= lang('please_select') ?>...</option>
      <option value="Petite"><?= lang('petite') ?></option>
      <option value="Slim"><?= lang('slim') ?></option>
      <option value="Athletic"><?= lang('athletic') ?></option>
      <option value="Average"><?= lang('average') ?></option>
      <option value="Few Extra Pounds"><?= lang('few_extra_pounds') ?></option>
      <option value="Full Figured"><?= lang('full_figured') ?></option>
      <option value="Large and lovely"><?= lang('large_lovely') ?></option>
    </select>
  </div> -->

  <input type="hidden" id="photo_cover_user" name="photo_cover_user" value="<?= (isset($get_profile_user) && $get_profile_user[0]['photo_cover_user']!="") ? $get_profile_user[0]['photo_cover_user'] : '' ?>">

  <div class="form-group">
    <input type="submit" disabled="true" class="btn-disabled" id="btn_create_myprofile" value="<?= lang('submit') ?>">
  </div>
</form>

<script type="text/javascript">
 function readURLProfile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#ImgProfile').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function readURLVerify(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#ImgVerify')
      .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>


<script>
 $('#terms_service').on( 'click', function() {
    if($('#one').is(':checked') && $('#two').is(':checked') && $('#three').is(':checked')){
      $('#btn_create_myprofile').attr('disabled', false);
      $('#btn_create_myprofile').removeClass('btn-disabled').addClass('btn-finish-pay');
    } else {
      $('#btn_create_myprofile').attr('disabled', true);
      $('#btn_create_myprofile').addClass('btn-disabled').removeClass('btn-finish-pay');
    }
});

$('.form-check-label').on('click', function() {
  $('.step-one').css('display', 'none')
})
$('.modal').on('click', function() {
  $('.step-one').css('display', 'block')
})



</script>