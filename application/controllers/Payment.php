<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	//"global" items
	var $data;

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('model_home');

		//Recibe las variables de sesión
		$session_register_user = $this->session->userdata('token_user');
		$session_email_user    = $this->session->userdata('email_user');
		$profile_user          = $this->model_home->getDataUserxEmail($session_email_user);
		$logactive_user        = $profile_user[0]['logactive_user'];
		
		//Valida si existe una sesión y envia el resultado a todas las funciones con el array global $data		
		if ($session_register_user == "" or is_null($session_register_user) or $session_email_user == "" or is_null($session_email_user)){  
			$this->data = array('result_validate' => 'no_session_create');
		} else if ($logactive_user==0){  
			$this->data = array('result_validate' => 'no_session_create');
		} else {
			$this->data = array('result_validate' => 'session_exists');
		}
	}

	public function index()	{

		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			$this->load->view('view_includes/view_header');
			$this->load->view('view_index');
			$this->load->view('view_includes/view_footer');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result      = $profile_user[0]['id_user'];
			$data_pay            = $this->model_home->getDataPay();
			$arr_data_pay       = array('get_pay_data' => $data_pay);
			
			if ($profile_user_result == "0") {
				
				redirect('Home/Myprofile', 'location');
			} else if ($profile_user_result == "1") {
				
				$profile_user        = $this->model_home->getDataUserAll();
				
				$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/payment/view_payment', $arr_data_pay);
				$this->load->view('session_started/view_includes/view_footer');
			}
		}
	}


	public function finish_payment() {

		if (isset($_POST['radio-pay']) or isset($_POST['radio-plan'])) {
			
			$datos = $this->model_home->postToValor($_POST);
			$planName = $datos['radio-plan'];
		} else {

			redirect('Payment/', 'location');
		}
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			$this->load->view('view_includes/view_header');
			$this->load->view('view_index');
			$this->load->view('view_includes/view_footer');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result      = $profile_user[0]['id_user'];
			
			if ($profile_user_result == "0") {
				
				redirect('Home/Myprofile', 'location');
			} else if ($profile_user_result == "1") {
				
				$profile_user = $this->model_home->getDataUserAll();
				$data_pay     = $this->model_home->getDataPay($planName);

				$arr_profile_active = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
				$arr_data_pay       = array('get_users_data' => $datos, 'get_pay_data' => $data_pay);
				
				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/payment/view_finish_payment', $arr_data_pay);
				$this->load->view('session_started/view_includes/view_footer');
			}
		}
	}

	public function validate_plan($payment_method="", $payment_id="", $description="") {

		//Datos generados para MercadoPago
		if ($payment_method == "mercadopago") {

			if ($payment_id=="") {

				$resultStatus      = $_POST['status'];
				$resultDescription = $_POST['description']; 
			} else {

				require 'lib/vendor/autoload.php';
				$accessToken = 'TEST-7355514294365358-082305-9fed82beb8542bcf42e51b66c251a384-462754785';
				MercadoPago\SDK::setAccessToken($accessToken);
				$cSession = curl_init();
				curl_setopt($cSession,CURLOPT_URL,"https://api.mercadopago.com/v1/payments/".$payment_id."?access_token=".$accessToken."");
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($cSession,CURLOPT_HEADER, false); 
				$result=curl_exec($cSession);
				curl_close($cSession);
				$resultArray = json_decode($result, true);
				$transaction_id    = $resultArray['id'];
				$resultStatus      = $resultArray['status'];
				$resultDescription = $resultArray['description']; 
				$payment_method    = "MercadoPago"; 
			}

		//Datos generados para PayU
		} else if ($payment_method == "payu") { 

			$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
			$merchant_id = $_REQUEST['merchantId'];
			$referenceCode = $_REQUEST['referenceCode'];
			$TX_VALUE = $_REQUEST['TX_VALUE'];
			$New_value = number_format($TX_VALUE, 1, '.', '');
			$currency = $_REQUEST['currency'];
			$transactionState = $_REQUEST['transactionState'];
			$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
			$firmacreada = md5($firma_cadena);
			$firma = $_REQUEST['signature'];
			$transaction_id = $_REQUEST['transactionId'];
			$resultDescription = $_REQUEST['description'];
			$payment_method    = "PayU";

			if (strtoupper($firma) == strtoupper($firmacreada)) {
				if ($_REQUEST['transactionState'] == 4) { $resultStatus = "approved"; } else { $resultStatus = "no_approved"; }
			} else {
				$resultStatus = "no_approved";
			}
		} else if ($payment_method == "paypal") {

			$resultDescription = str_replace("%20", " ", $description);
			$transaction_id    = $payment_id;
			$payment_method    = "PayPal";
			$resultStatus      = "approved";
		}

		//Verifica si el pago esta aprobado y lo envia a la base de datos
		if ($resultStatus == "approved") {

			$dataResultDescription = explode("-", $resultDescription);
			$id_user    = $dataResultDescription[3];
			$id_user    = trim($id_user);
			$months     = $dataResultDescription[1];
			$months     = trim($months);

			if ($months == "12 Months") { $sumMonths = "+12 month"; } else if ($months == "3 Months") { $sumMonths = "+3 month"; } else if ($months == "1 Months") { $sumMonths = "+1 month"; }

			$date_start = date('Y-m-d 00:00:00');
			$date_end   = date("Y-m-d 00:00:00", strtotime($sumMonths, strtotime($date_start)));
			$arr_plan_active  = array('id_user' => $id_user, 'suscription_name' => 'Platinum', 'months' => $months, 'payment_method' => $payment_method, 'transaction_id' => $transaction_id, 'date_start' => $date_start, 'date_end' => $date_end);

			if ($this->model_home->getDataSubscriptionxId($id_user) == false) {

				$this->model_home->payment_verify($arr_plan_active);
			}
		}
		redirect('Payment/', 'location');
	}
}
?>
