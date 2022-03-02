<div class="container-fluid">
	<div class="col-12 text-change-email">
		<?php if ($this->uri->segment(3) == "Sc12Es34Ce56") { ?>

			<div class="email-change-ok bg-70bb46 text-white">
				<i class="fa fa-check fsize-25 text-white"></i><br>
				<?= lang('text_pass_update') ?>
			</div>
		<br>
		<?php } else if ($this->uri->segment(3) == "Nc12En34Ce56") {
			?>
			<div class="text-wing bg-ccc">
				<strong>Error!</strong> <br>
				<?= lang('pass_incorrect') ?>
			</div>
		<br>
			<?php
		} else if ($this->uri->segment(3) == "Ni12En34Ie56") {
			?>
			<div class="text-wing bg-ccc">
				<strong>Error!</strong> <br>
				<?= lang('pass_dnot_match') ?>
			</div>
		<br>
			<?php
		} ?>
		<?= lang('text_change_pass') ?> <br><br>
		<form action="<?php echo base_url('Config/change_password'); ?>" method="POST">
			<label for="current_pass"><?= lang('current_password') ?>:</label>
			<input type="password" name="current_pass" id="current_pass" class="input-text pd-20-20" required><br><br>
			<label for="new_pass"><?= lang('new_password') ?>:</label>
			<input type="password" name="new_pass" id="new_pass" class="input-text pd-20-20" required><br><br>
			<label for="renew_pass"><?= lang('confirm_password') ?>:</label>
			<input type="password" name="renew_pass" id="renew_pass" class="input-text pd-20-20" required><br><br>
			<input type="submit" class="btn_profile text-white bg-main m-20-0" value="<?= lang('save') ?>">
		</form>
	</div>
</div>
</div>