  <style type="text/css">
    #blah{
      width:100% !important;
    }
  </style>
  <div class="container-fluid">
  	<div class="row">

      <?php if ($verify_status==0) { ?>
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
         <p class="bg-lg-blue text-center text-white m-0 fsize-22 title-pay"><?= lang('verify_account_title') ?></p><br>
         <p class="text-center"><?= lang('verify_account_text_1') ?></p>
         <p class="text-center"><?= lang('verify_account_text_2') ?></p><br>
         <form action="<?= base_url('Home/verify_account/start') ?>" method="POST" enctype="multipart/form-data">
          <h4><strong><?= lang('charge_file') ?></strong></h4>
          <img style="width: 50% !important; margin: auto; display: block;" id="blah" src="<?php echo base_url('img/src/id-card-user.jpg'); ?>" alt="id-card user">
          <input type='file' name="image-verify" onchange="readURL(this);" accept="image/*" required><br><br>
          <p><?= lang('verify_account_text_3') ?></p>
          <input type="submit" class="btn-finish-pay" value="Solicitar verificación"><br><br>
        </form>
      </div>
      <div class="col-md-3"></div>
    <?php } ?>

    <?php if ($verify_status==1){ ?>
      <div class="col-md-3"></div>
      <div class="col-md-6 text-center">
       <p class="bg-lg-blue text-center text-white m-0 fsize-22 title-pay"><?= lang('verify_account_title') ?></p><br>
       <p class="text-center" style="font-size: 18px"><strong><?= lang('in_review') ?></strong></p>
       <p class="text-center"><?= lang('verify_account_text_4') ?></p><br>
       <img style="width: 40% !important; margin: auto; display: block;" src="<?php echo base_url('img/src/reloj.png'); ?>" alt="id-card user"><br><br>
       <p class="text-center"><?= lang('verify_account_text_5') ?></p><br>
       <a href="<?= base_url('home/verify_account/resend/') ?>" class="btn-finish-pay" style="padding:10px 30px;"><?= lang('new_document') ?></a>
     </div>
     <div class="col-md-3"></div>
   <?php } ?>

   <?php if ($verify_status==2) { ?>
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
     <p class="bg-lg-blue text-center text-white m-0 fsize-22 title-pay"> <?= lang('verified_account') ?></p><br>
     <p class="text-center" style="font-size: 18px"><strong> <?= lang('excellent') ?></strong></p>
     <p class="text-center"> <?= lang('verify_account_text_6') ?></p><br>
     <img style="width: 40% !important; margin: auto; display: block;" src="<?php echo base_url('img/src/account_ok.png'); ?>" alt="id-card user"><br><br>
     <p class="text-center"><?= lang('verify_account_text_7') ?></p><br>
   </div>
   <div class="col-md-3"></div>
 <?php } ?>

 <?php if ($verify_status==3) { ?>
  <div class="col-md-3"></div>
  <div class="col-md-6 text-center">
   <p class="bg-lg-blue text-center text-white m-0 fsize-22 title-pay"><?= lang('verify_account_title') ?></p><br>
   <p class="text-center" style="font-size: 18px"><strong><?= lang('error_account') ?></strong></p>
   <p class="text-center"><?= lang('verify_account_text_8') ?></p><br>
   <img style="width: 40% !important; margin: auto; display: block;" src="<?php echo base_url('img/src/error.png'); ?>" alt="id-card user"><br><br>
   <p class="text-center"><?= lang('verify_account_text_9') ?></p><br>
   <a href="<?= base_url('home/verify_account/resend/') ?>" class="btn-finish-pay" style="padding:10px 30px;"><?= lang('new_document') ?></a>
 </div>
 <div class="col-md-3"></div>
<?php } ?>

</div>
</div>

<script type="text/javascript">
 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah')
      .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>