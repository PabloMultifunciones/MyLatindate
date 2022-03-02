<?php
$plan_active = $this->model_home->validate_plan($id_user);

if (isset($_GET['collection_id']) && isset($_GET['merchant_order_id']) && isset($_GET['preference_id'])) {
  $payment_id = htmlspecialchars(htmlentities($_GET['collection_id'])); 
  redirect(base_url('Payment/validate-plan/mercadopago/'.$payment_id), 'location');
}
?>

<?php if ($plan_active == "active") {

  $subscription = $this->model_home->validate_plan($id_user, "data");
  ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-lr-200">

      <p class="bg-lg-blue text-center text-white m-0 fsize-22 title-pay">Platinum</p><br>
      <table class="w-100">
        <tr>
          <td class="w-50"><strong class="text-capitalize"><?= lang('months') ?>:</strong></td>
          <td class="w-50"><?php echo $subscription[0]['months']." ".lang('months'); ?></td>
        </tr>
        <tr>
          <td class="w-50"><strong><?= lang('start_date') ?>:</strong></td>
          <td class="w-50"><?php echo date("F j, Y, g:i a", strtotime($subscription[0]['date_start'])); ?></td>
        </tr>
        <tr>
          <td class="w-50"><strong><?= lang('final_date') ?>:</strong></td>
          <td class="w-50"><?php echo date("F j, Y, g:i a", strtotime($subscription[0]['date_end'])); ?></td>
        </tr>
        <tr>
          <td class="w-50"><strong><?= lang('transaction_id') ?>:</strong></td>
          <td class="w-50"><?php echo $subscription[0]['transaction_id']; ?></td>
        </tr>
        <tr>
          <td class="w-50"><strong>Payment method:</strong></td>
          <td class="w-50"><?php echo $subscription[0]['payment_method']; ?></td>
        </tr>
      </table><br>
    </div>
    <div class="col-md-12 div-upgrade-profile">
      <div class="w-100">
        <div class="div-img-upgrade w-100">
          <img class="img-upgrade d-block" src="<?php echo base_url('img/src/perfil-bar-false.png'); ?>"
            alt="Upgrade Now | Mylatindate.com">
        </div>
        <p class="text-center"><?= lang('text_membership_platinum') ?></p>
        <button class="btn_view_my_profile bg-lg-blue"><?= lang('plan_active') ?></button>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="container-fluid">
  <div class="row">
    <form action="<?php echo base_url('Payment/finish-payment'); ?>" method="POST">
      <div class="col-md-12 p-lr-200">
        <p class="text-left text-black font-weight-bold mt-5 fsize-22"> <?= lang('payment_choose_subs'); ?> </p><br>
      </div>
     


      <div class="step-one">
      <div class="">
        <br>
        <div class="p-lr-200">


          <div class="item-price w-100 m-auto row">
            <div class="p-2 p-md-5 bg-D2D4FA col-4">
              <label class="container-price">
                <h2 class="text-black text-center font-weight-bold">12<br>
                  <h6 class="text-center"><?= lang('months') ?></h6>
                </h2>
                <input type="radio" name="radio-plan" value="Plan 12">
                <span class="checkmark-price"></span>
              </label>
            </div>
            <div class="pd-15 col-8">
              <span class="fsize-20">$ 14.17 USD <?= lang('per_months') ?></span><br>
              <small><?= lang('payment_billed_single'); ?> $ 169.99 USD</small>
            </div>
          </div>





          <div class="item-price w-100 m-auto row">
            <div class="p-2 p-md-5 bg-D2D4FA col-4">
              <label class="container-price">
                <h2 class="text-black text-center font-weight-bold">3<br>
                  <h6 class="text-center"><?= lang('months') ?></h6>
                </h2>
                <input type="radio" name="radio-plan" value="Plan 3" checked="checked">
                <span class="checkmark-price"></span>
              </label>
            </div>
            <div class=" pd-15 col-8">
              <span class="fsize-20">$ 26.66 USD <?= lang('per_months') ?></span><br>
              <small><?= lang('billed_payment') ?> <?= lang('payment_billed_single'); ?> $ 79.98 USD</small>
              <p class="bg-lg-blue text-center text-white m-0 fsize-14 best-price"> <?= lang('payment_best_price'); ?> </p>
            </div>
          </div>



          <div class="item-price w-100 m-auto row">
            <div class="p-2 p-md-5 bg-D2D4FA col-4">
              <label class="container-price">
                <h2 class="text-black text-center font-weight-bold">1<br>
                  <h6 class="text-center"><?= lang('months') ?></h6>
                </h2>
                <input type="radio" name="radio-plan" value="Plan 1">
                <span class="checkmark-price"></span>
              </label>
            </div>
            <div class=" pd-15 col-8">
              <span class="fsize-20">$ 39.99 USD</span><br>
            </div>
          </div>


          <div class="item-price w-100 m-auto row">
            <div class="p-2 p-md-5 bg-D2D4FA col-4">
              <label class="container-price">
                <h2 class="text-black text-center font-weight-bold">1<br>
                  <h6 class="text-center"> <?= lang('payment_week'); ?> </h6>
                </h2>
                <input type="radio" name="radio-plan" value="Plan 1">
                <span class="checkmark-price"></span>
              </label>
            </div>
            <div class=" pd-15 col-8">
              <span class="fsize-20">$ 20.00 USD</span><br>
            </div>
          </div>



        </div>



      </div>
      <div class="col-md-12 p-lr-200 payment-methods">
        <br>
        <p class="m-0 fsize-18 font-weight-bold"><?= lang('choose_payment_method') ?></p><br>
        <label class="container-pay w-100">
          Cards
          <input type="radio" name="radio-pay" value="Mercadopago" checked="checked">
          <span class="checkmark-pay"></span>
          <img src="<?php echo base_url('img/icons/payment-cards.png'); ?>" alt="Pay Mercadopago | Mylatindate"
            class="img-pay">
        </label>
        <!-- <label class="container-pay">
          PayPal
          <input type="radio" name="radio-pay" value="Paypal">
          <span class="checkmark-pay"></span>
          <img src="<?php echo base_url('img/src/pay_paypal.png'); ?>" alt="Pay Paypal | Mylatindate" class="img-pay">
        </label>
        <label class="container-pay w-100">
          PayU
          <input type="radio" name="radio-pay" value="PayU">
          <span class="checkmark-pay"></span>
          <img src="<?php echo base_url('img/src/pay_payu.png'); ?>" alt="Pay PayU | Mylatindate" class="img-pay">
        </label> -->

        <!-- Terms -->

      
        
        <!-- ESTA PARTE SON LOS TERMINOS Y CONDICIONES
        <div class="form-check mt-3 m-0">
          <input class="form-check-input" type="checkbox" checked value="" id="one">
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
        -->


        <!-- <input type="submit" disabled="false" name="btn-finish-pay" id="btn-finish-pay" class="btn-disabled mt-4"
          value="<?= lang('update_category_now') ?>"> -->
          <input type="submit" name="btn-finish-pay" id="btn-finish-pay" class="btn-finish-pay"
          value="<?= lang('update_category_now') ?>"> 
        </div>
      </div>

      <div class="step-two">
       
      </div>

      <!-- Terms modal -->
      
      <!--
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

-->     


    </form>
  </div>
</div>
<?php } 


// $this->load->library("sendMailer");
// 						$mail = new sendMailer();
// 						$mail->IsSMTP();
// 						$mail->SMTPAuth = true;
// 						$mail->Host = "mail.mylatindate.com"; //"smtp.hostinger.co";
// 						$mail->CharSet = 'UTF-8';
// 						$mail->Username = "info@mylatindate.com";//"adsoft2018@adsoft.com.co";
// 						$mail->Password = "N)qoZ,&Z!VY9"; //"adsoftcamilo1";
// 						$mail->Port = 587;
// 						$mail->From = "info@mylatindate.com"; //"adsoft2018@adsoft.com.co";
// 						$mail->FromName = "Mylatindate.com";
// 						$mail->AddAddress('bellaciaofor@gmail.com');
// 						$mail->IsHTML(true);
// 						$mail->Subject = "Codigo de verificacion | Mylatindate";
// 						$body = $this->load->view('view_includes/templateEmail', 'datamail', true);
// 						$mail->Body = 'bodyMail 00123212';
// 						$mail->AltBody = "Nuevo código de verificacion recibido."; 
// 						$exito = $mail->Send();













?>
<br>

<script>
/**
 $('.payment-methods').on( 'click', function() {
    if($('#one').is(':checked') && $('#two').is(':checked') && $('#three').is(':checked')){
    //if($('#two').is(':checked') && $('#three').is(':checked')){
      $('#btn-finish-pay').attr('disabled', false)
      $('#btn-finish-pay').removeClass('btn-disabled').addClass('btn-finish-pay')
    } else {
      $('#btn-finish-pay').attr('disabled', true)
      $('#btn-finish-pay').addClass('btn-disabled').removeClass('btn-finish-pay')
    }
});
**/
$('.form-check-label').on('click', function() {
  $('.step-one').css('display', 'none')
})
$('.modal').on('click', function() {
  $('.step-one').css('display', 'block')
})

</script>