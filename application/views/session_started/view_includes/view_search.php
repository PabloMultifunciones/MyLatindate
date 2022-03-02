<?php
$ci_search = $this->session->userdata('ci_search');
?>

<form action="<?php echo base_url('Home/searching_users'); ?>" method="POST">

	<div class="container">
		<div class="row">
            
            <!--
			<div class="col-md-12">
				<h1 style="font-size: 28px !important; padding-top: 20px; color: #565656;"><i class="fa fa-users" style="color: #565656;"></i> - Encuentra coincidencias</h1>
				<hr>
			</div>
            -->
    
    
			<div class="col-md-12">
				<div class="alert alert-danger display-none" id="carg_error_msg"></div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="txt_iam"><?= lang('iam') ?>:</label>
					<select class="form-control" id="txt_iam" name="txt_iam" required>
						<option value="2" <?= ($gender_user==2) ? 'selected' : '' ?>><?= lang('female') ?></option>
						<option value="1" <?= ($gender_user==1) ? 'selected' : '' ?>><?= lang('male') ?></option>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="txt_seeking"><?= lang('seeking') ?>:</label>
					<select class="form-control" id="txt_seeking" name="txt_seeking">
						<option value="2" <?= ($gender_user==1) ? 'selected' : '' ?>><?= lang('female') ?></option>
						<option value="1" <?= ($gender_user==2) ? 'selected' : '' ?>><?= lang('male') ?></option>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="txt_agefrom"><?= lang('age_between') ?>:</label><br>
					<select class="form-control w-49 d-inline" id="txt_agefrom" name="txt_agefrom">
						<?php for ($i=18; $i <= 60; $i++) { ?>
							<option value="<?= $i ?>" <?= ($ci_search['txt_agefrom']==$i) ? 'selected' : '' ?>><?= $i ?></option>
						<?php } ?>
					</select>
					<select class="form-control w-49 d-inline" id="txt_ageto" name="txt_ageto">
						<?php for ($i=18; $i <= 60; $i++) { ?>
							<option value="<?= $i ?>" <?= ($ci_search['txt_ageto']==$i) ? 'selected' : '' ?>><?= $i ?></option>
						<?php } ?>
					</select>
				</div>	
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="country_residence"><?= lang('country') ?>:</label>
					<select class="form-control" id="country_residence" name="country_residence">
						<option value=""><?= lang('any') ?></option>
						<?php foreach ($get_place_country->result() as $key) { ?>
							<option value="<?= $key->id.",".$key->name ?>" <?= ($ci_search['country_residence']==$key->id.",".$key->name) ? 'selected' : '' ?>><?= $key->name ?></option>
						<?php }	?>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="state_residence"><?= lang('state') ?>:</label>
					<select class="form-control" id="state_residence" name="state_residence">
						<option value=""><?= lang('any') ?></option>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="city_residence"><?= lang('city') ?>:</label>
					<select class="form-control" id="city_residence" name="city_residence">
						<option value=""><?= lang('any') ?></option>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<p for="checkbox"><?= lang('relationship_looking') ?>:</p>
					<div class="form-check">
						<input type="checkbox" class="form-check-input position-static" id="penpal" name="penpal" value="1" <?= (isset($ci_search['penpal']) && $ci_search['penpal']==1) ? 'checked' : '' ?>> <span><?= lang('penpal') ?></span>
					</div>
					<div class="form-check">
						<input type="checkbox" class="form-check-input position-static" id="friendship" name="friendship" value="1" <?= (isset($ci_search['friendship']) && $ci_search['friendship']==1) ? 'checked' : '' ?>> <span><?= lang('friendship') ?></span>
					</div>
					<div class="form-check">
						<input type="checkbox" class="form-check-input position-static" id="romance_dating" name="romance_dating" value="1" <?= (isset($ci_search['romance_dating']) && $ci_search['romance_dating']==1) ? 'checked' : '' ?>> <span><?= lang('romance_dating') ?></span>
					</div>
					<div class="form-check">
						<input type="checkbox" class="form-check-input position-static" id="long_relationship" name="long_relationship" value="1" <?= (isset($ci_search['long_relationship']) && $ci_search['long_relationship']==1) ? 'checked' : '' ?>> <span><?= lang('long_term') ?></span>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<input type="submit" class="btn_create_myprofile" value="<?= lang('submit') ?>">
				</div>
			</div>

		</div>
	</div>
</form>

<script type="text/javascript">

	var id_country = "<?= $ci_search['country_residence'] ?>";
	var id_state   = "<?= $ci_search['state_residence'] ?>";
	var id_city    = "<?= $ci_search['city_residence'] ?>";

	if (id_country!="") {

		var id_country_split = id_country.split(",");

		var url = '<?= (base_url('home/getState/')) ?>' + id_country_split[0];

		$.ajax({
			url     :     url,
			data    :     {id_state,id_state},
			type    :     "POST",
			success :     function(response) {
				$("#state_residence").html(response);
				$("#state_residence").prop('disabled', false);
			}
		});
	}

	if (id_state!="") {

		var id_state_split = id_state.split(",");

		var url = '<?= (base_url('home/getCity/')) ?>' + id_state_split[0];

		$.ajax({
			url     :     url,
			data    :     {id_city,id_city},
			type    :     "POST",
			success :     function(response) {
				$("#city_residence").html(response);
				$("#city_residence").prop('disabled', false);
			}
		})
	}
</script>