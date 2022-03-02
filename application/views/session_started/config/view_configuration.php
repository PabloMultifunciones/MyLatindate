<div class="container">
	<div class="row p-t-40">
		<div class="col-md-12 p-lr-200">
			<ul class="edit-list-profile">
				<a href="<?php echo base_url("Config/Emailsettings"); ?>"><li><?= lang('email_address') ?><i class="fa fa-angle-right"></i></li></a>
				<a href="<?php echo base_url("Config/Passwordsettings"); ?>"><li><?= lang('password') ?><i class="fa fa-angle-right"></i></li></a>
			</ul>
		</div>
		<div class="col-md-12 p-lr-200">
			<div class="translate_google">
				<label for="lang"><strong><?= lang('select_language') ?>:</strong></label>
				<select class="select-lang w-100 h-35" id="lang">
					<option value=""><?= lang('select_language') ?></option>
					<option value="English" <?= ($languaje_user=='English') ? 'selected' : '' ?> ><?= lang('english') ?></option>
					<option value="Portuguese" <?= ($languaje_user=='Portuguese') ? 'selected' : '' ?> ><?= lang('portuguese') ?></option>
					<option value="Spanish" <?= ($languaje_user=='Spanish') ? 'selected' : '' ?> ><?= lang('spanish') ?></option>
				</select>
				<div id="google_translate_element"></div>
			</div>
			<br>
			<button class="btn_profile m-0"><a class="tdeco-none" href="<?php echo base_url('Home/Logout'); ?>"><?= lang('logout') ?></a></button>
		</div> 
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$("#lang").on("change", function() {

			var lang = $("#lang").val();
			var url  = "<?= base_url('Config/change_lang') ?>";
			if (lang != "") {
				$.ajax({
					url         : url,
					data        : {lang:lang},
					type        : 'POST',
					success     : function(resp) {
						window.location.href="<?= base_url('Home/Configuration') ?>";
					}
				})
			}
		})
	});
</script>