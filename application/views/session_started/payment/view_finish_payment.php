<?php

$planName  = "Platinum";
$payMethod = $get_users_data['radio-pay'];
$paymonths = $get_pay_data[0]['months'];
$paytotal  = $get_pay_data[0]['total'];

$data        = json_decode(file_get_contents('http://app.docm.co/prod/Dmservices/Utilities.svc/GetTRM'), true);
$dolarHoy    = number_format($data,0,"","");
$payCol      = $dolarHoy * $paytotal;
$description = 'Update Category - '.$paymonths.' Months - Mylatindate - '.$id_user;

// SDK de Mercado Pago
require 'lib/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7355514294365358-082305-9fed82beb8542bcf42e51b66c251a384-462754785');

$preference = new MercadoPago\Preference();
$item = new MercadoPago\Item();
$item->title = $description;
$item->quantity = 1;
$item->unit_price = $payCol;
$preference->items = array($item);
$preference->back_urls = array(
	"success" => base_url('Payment/'),
	"failure" => base_url('Payment/'),
	"pending" => base_url('Payment/')
);
$preference->save();
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 p-lr-200">
			<p class="bg-lg-blue text-center text-white m-0 fsize-22 title-pay"><?= lang('finish_payment') ?></p>
		</div>
		<div class="col-md-12 p-lr-200">
			<table class="w-100">
				<tr>
					<td class="w-40 pd-30 bg-D2D4FA border_bt_1">
						<strong>Plan</strong>
					</td>
					<td class="w-60 border_bt_1 pd-15">
						<?php echo $planName; ?>
					</td>
				</tr>
				<tr>
					<td class="w-40 pd-30 bg-D2D4FA border_bt_1">
						<strong><?= lang('payment_method') ?></strong>
					</td>
					<td class="w-60 border_bt_1 pd-15">
						<?php echo $payMethod; ?>
					</td>
				</tr>
				<tr>
					<td class="w-40 pd-30 bg-D2D4FA border_bt_1">
						<strong class="text-capitalize"><?= lang('months') ?></strong>
					</td>
					<td class="w-60 border_bt_1 pd-15">
						<?php echo $paymonths." ".lang('months') ?>
					</td>
				</tr>
				<tr>
					<td class="w-40 pd-30 bg-D2D4FA border_bt_1">
						<strong>Total</strong>
					</td>
					<td class="w-60 border_bt_1 pd-15">
						<?php echo "$ ".$paytotal; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-12 p-lr-200">
			<br>
			<?php if ($payMethod == "Mercadopago") { ?>	
				<script	src="https://www.mercadopago.com.co/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>" data-button-label="<?= lang('pay_by') ?> MercadoPago"></script>
			<?php } else  if ($payMethod == "PayU") { ?>
				<form method="POST" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu">
					<input name="merchantId"      type="hidden" value="508029">
					<input name="accountId"       type="hidden" value="512321">
					<input name="description"     type="hidden" value="<?php echo $description; ?>">
					<input name="referenceCode"   type="hidden" value="<?php echo time(); ?>">
					<input name="amount"          type="hidden" value="<?php echo $payCol; ?>" >
					<input name="tax"             type="hidden" value="">
					<input name="taxReturnBase"   type="hidden" value="">
					<input name="signature"       type="hidden" value="<?php echo md5("4Vj8eK4rloUd272L48hsrarnUA~508029~" . time() . "~" . $payCol . "~COP"); ?>">
					<input name="test"            type="hidden" value="1">
					<input name="responseUrl"     type="hidden" value="<?php echo base_url('Payment/validate_plan/payu'); ?>">
					<input name="confirmationUrl" type="hidden" value="<?php echo base_url('Payment/validate_plan/payu'); ?>">
					<input name="Submit"          type="submit" value="<?= lang('pay_by') ?> PayU" class="btn-finish-pay">
				</form>				
			<?php } else if ($payMethod == "Paypal") { ?>
				<script src="https://www.paypal.com/sdk/js?client-id=Aey7j_nvnY3xtKDqiqYQWAzhoyQgNbkf_ypPrL-x52bvg4Y2YUwZo6OAN37WqiK7sqcMBJ3tBMFpnKpn"></script>

				<div id="paypal-button-container"></div>

				<script>
					var description = "<?php echo $description; ?>"; 
					var base_url    = "<?php echo base_url() ?>";

					paypal.Buttons({
						createOrder: function(data, actions) {
							return actions.order.create({
								purchase_units: [{
									amount: {
										value: <?php echo $paytotal; ?>
									},
									description : description
								}]
							});
						},
						onApprove: function(data, actions) {
							return actions.order.capture().then(function(details) {
								window.location.href = base_url+"Payment/validate-plan/paypal/"+details.id+"/"+description;
							});
						}
					}).render('#paypal-button-container');
				</script>
			<?php } ?>
		</div>
	</div>
</div>