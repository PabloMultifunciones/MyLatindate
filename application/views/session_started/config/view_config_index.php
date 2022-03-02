<div class="container-fluid">
	<div class="col-12 text-change-email">
		<?php if ($this->uri->segment(3) == "Changecorrect") { ?>

			<div class="email-change-ok bg-70bb46 text-white">
				<i class="fa fa-check fsize-25 text-white"></i><br>
				<?= lang('text_update') ?>
			</div>
		<?php } else {
			?>
			<div class="text-wing bg-ccc">
				<strong><?= lang('attention') ?>!</strong> <br>
					<?= lang('text_status') ?>
			</div>
			<?php
		} ?>

		<br>
		<?= lang('text_change_email') ?> <br><br>
		<form action="<?php echo base_url('Config/change_email'); ?>" method="POST">
			<label for="txt_email"><?= lang('email_address') ?>:</label>
			<input type="email" name="txt_email" id="txt_email" class="input-text pd-20-20" value="<?php echo $email; ?>" required>
			<input type="submit" class="btn_profile text-white bg-main m-20-0" value="<?= lang('save') ?>">
		</form>
	</div>
</div>
</div>