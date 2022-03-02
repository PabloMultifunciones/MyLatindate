<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	//"global" items
	var $data;

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('model_home');
		$this->load->model('model_email');
		$this->load->library('form_validation');

		//Recibe las variables de sesión
		$session_register_user = $this->session->userdata('token_user');
		$session_email_user    = $this->session->userdata('email_user');
		$profile_user          = $this->model_home->getDataUserxEmail($session_email_user);
		@$logactive_user        = $profile_user[0]['logactive_user'];
		@$verify_account        = $profile_user[0]['verify_account'];
		
		//Valida si existe una sesión y envia el resultado a todas las funciones con el array global $data		
		if ($session_register_user == "" or is_null($session_register_user) or $session_email_user == "" or is_null($session_email_user)){  
			$this->data = array('result_validate' => 'no_session_create');
		} else if ($logactive_user==0){  
			$this->data = array('result_validate' => 'no_session_create');
		} else if ($verify_account==4){  
			$this->data = array('result_validate' => 'no_session_create');
		} else {
			$this->data = array('result_validate' => 'session_exists');
			$this->session->set_userdata("site_lang", $profile_user[0]['languaje_user']);
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
			
			if ($profile_user_result == "0") {
				
				redirect('Home/Myprofile', 'location');
			} else if ($profile_user_result == "1") {
				
				$profile_user        = $this->model_home->getDataUserAll();
				
				$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
				$arr_profile_user    = array('getDataUsers' => $profile_user);

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/view_includes/view_menu');
				$this->load->view('session_started/view_includes/view_data_users', $arr_profile_user);
				$this->load->view('session_started/view_includes/view_footer');
			}
		}
	}
	
	function ComplaintsPolicy(){
	    $name = htmlspecialchars(htmlentities($this->input->post('name')));
	    $email = htmlspecialchars(htmlentities($this->input->post('email')));
	    $url = htmlspecialchars(htmlentities($this->input->post('url')));
	    $complaint = htmlspecialchars(htmlentities($this->input->post('complaint')));
	    
	    $this->form_validation->set_rules('name','Name', 'required');
	    $this->form_validation->set_rules('email','Email', 'required|valid_email');
	    $this->form_validation->set_rules('url','Url', 'required');
	    $this->form_validation->set_rules('complaint','Complaint', 'required');
	    if(!isset($_POST['name'])){
	        $this->load->view('view_complaintspolicy');
	    }
	    else if($this->form_validation->run() == FALSE){
	        $data = array('isValid' => false);
	        $this->load->view('view_complaintspolicy',$data);
	    }else{
	        $datos = array('name' => $name, 'email' => $email, 'url' => $url, 'complaint' => $complaint);
	        $data = array('isValid' => true);
	        $this->model_home->create_complaint($datos);
	        $this->load->view('view_complaintspolicy',$data);
	    }
	}

	public function Login() {

		//Recibe la validación de sesión y genera la vista dependiendo del resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  
			$this->load->view('view_login');
		}
		else if ($data['result_validate'] == 'session_exists'){

			redirect(base_url(), 'location');
		}
	}

	//Esta función obtiene los datos del form de login, crea un token de inicio y hace el login
	public function user_login() {

		//obtiene los datos del form del login y quita los caracteres especiales | Evita inyección SQL
		$email    = htmlspecialchars(htmlentities($this->input->post('txt-email')));
		$password = htmlspecialchars(htmlentities($this->input->post('txt-password')));

		if (isset($_POST['submit_login'])) {
			if ($email != "" and $password != "") {
				$token = $this->generateRandomString();

				//crea el array para consultar los datos en la base de datos
				$arr_user_login = array('token_user' => $token, 'email_user' => $email);

				//Consulta si existe el email ingresado y crea el nuevo token de inicio de sesión
				$token_init = $this->model_home->create_token($arr_user_login);
				if ($token_init) {

					$verify_login = $this->model_home->user_login($arr_user_login);
					if ($verify_login) {

						foreach ($verify_login as $key) {
							$pass_verify = $key->password_user;
							if(password_verify($password, $pass_verify)){

								$verify_account = $key->verify_account;
								if ($verify_account!=4) {
									$this->session->set_userdata($arr_user_login);

								//Crea el estado del usuario en la base de datos | 1: Login - 0: Logout
									$this->model_home->change_status($arr_user_login, '1');

									redirect(base_url(), 'location');
								} else {
									$result_login = '<small style="display: block; border-radius: 10px; background-color:#f8f8f8; color: #888; font-size: 15px; padding: 15px; text-align: center;"><span style="font-size: 20px; color: #888; font-weight:bolder;">'.lang("title_account_block").'!</span><br>'.lang("text_account_block").'</small>';
									$arr_noexists_user = array('noexists_user' => $result_login);

									$this->load->view('view_login', $arr_noexists_user);
								}
							} else {
								$result_login = '<small style="display: block; border-radius: 10px; background-color:#f8f8f8; color: #888; font-size: 15px; padding: 15px; text-align: center;"><span style="font-size: 20px; color: #888; font-weight:bolder;">'.lang("attention").'!</span><br>'.lang("error_attention").'</small>';
								$arr_noexists_user = array('noexists_user' => $result_login);

								$this->load->view('view_login', $arr_noexists_user);
							}
						}

					} else {
						$result_login = '<small style="display: block; border-radius: 10px; background-color:#f8f8f8; color: #888; font-size: 15px; padding: 15px; text-align: center;"><span style="font-size: 20px; color: #888; font-weight:bolder;">'.lang("attention").'!</span><br>'.lang("error_attention").'</small>';
						$arr_noexists_user = array('noexists_user' => $result_login);

						$this->load->view('view_login', $arr_noexists_user);		
					}

				} else {
					$result_login = '<small style="display: block; border-radius: 10px; background-color:#f8f8f8; color: #888; font-size: 15px; padding: 15px; text-align: center;"><span style="font-size: 20px; color: #888; font-weight:bolder;">'.lang("attention").'!</span><br>'.lang("error_attention").'</small>';
					$arr_noexists_user = array('noexists_user' => $result_login);

					$this->load->view('view_login', $arr_noexists_user);	
				}
			}
		}
	}

	public function login_facebook() {

		$lang = $this->session->userdata("site_lang");

		if ($this->input->post()) {

			$facebook_account_id = $this->input->post('facebook_account_id');
			$accessToken         = $this->input->post('accessToken');

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v7.0/'.$facebook_account_id.'?fields=id%2Cname%2Cfirst_name%2Clast_name%2Cemail%2Clink&access_token='.$accessToken);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close($ch);

			$user = json_decode($result, true);

			if ($lang=="") { $lang = "English";	} else { $lang = $lang;	}
			$token =  $this->generateRandomString();

			//crea el array para consultar los datos en la base de datos
			$arr_user_login = array(
				'token_user' => $token,
				'email_user' => $user['email']
			);

			$resultFacebook = $this->model_home->getDataUserxEmail($user['email']);

			//Si el usuario no esta registrado en la tabla de facebook lo inserta
			if ($resultFacebook) {
				
				//Validamos si la contraseña es correcta
				if(password_verify('login_with_facebook_id_'.$user['id'], $resultFacebook[0]['password_user'])) {

					//Consulta si existe el email ingresado y crea el nuevo token de inicio de sesión
					$token_init = $this->model_home->create_token($arr_user_login);

					$this->session->set_userdata($arr_user_login);

					//Crea el estado del usuario en la base de datos | 1: Login - 0: Logout
					$this->model_home->change_status($arr_user_login, '1');

					echo "connect_ok_for_".$user['id'];
				} 
			} else {

				$name = explode(" ", $user['name']);
				//crea el array para enviar los datos a la base de datos
				$arrayRegister = array(
					'name_user'           => $name[0],
					'gender_user'         => '2', 
					'password_user'       => password_hash('login_with_facebook_id_'.$user['id'], PASSWORD_BCRYPT),
					'email_user'          => $user['email'],
					'token_user'          => $token,
					'logactive_user'      => '1',
					'logindate_user'      => date("Y-m-d H:i:s"),
					'loguotdate_user'     => date("Y-m-d H:i:s"),
					'profactive_user'     => '0',
					'languaje_user'       => $lang,
					'account_facebook_id' => $user['id']
				);

				//Envia los datos a la base de  datos y recibe el resultado
				$resultRegister = $this->model_home->user_register($arrayRegister);

				//valida el resultado de la inserción | Resultados => 'ok_insert' = inserción correcta, 'false' = error en la inserción
				if ($resultRegister == "ok_insert") {

					$this->session->set_userdata($arr_user_login);

					//Crea el estado del usuario en la base de datos | 1: Login - 0: Logout
					$this->model_home->change_status($arr_user_login, '1');

					echo "connect_ok_for_".$user['id'];

				} else if ($resultRegister == false) {

					echo "Internal error, contact the administrator.";
				}
			}
		}
	}

	public function ForgotPass($validate_place="") {

		//Recibe la validación de sesión y genera la vista dependiendo del resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			if ($validate_place == "Validate-Email") {
				if ($this->input->post()) {

					$email = $this->input->post("txt-email");

					if ($dataUsers = $this->model_home->getDataUserxEmail($email)) {

				    	//Aqui creamos el codigo aleatorio de 5 digitos
						$length = 6;
						$characters = '0123456789';
						$charactersLength = strlen($characters);
						$randomString = '';
						for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
						}
						$codVerificacion = $randomString;

						$dataMail = array(
							'name_user' => $dataUsers[0]['name_user'],
							'cod_verificacion' => $codVerificacion
						);

						$this->load->library("sendMailer");
						$mail = new sendMailer();
						$mail->IsSMTP();
						$mail->SMTPAuth = true;
						$mail->Host = "mail.mylatindate.com"; //"smtp.hostinger.co";
						$mail->CharSet = 'UTF-8';
						$mail->Username = "info@mylatindate.com";//"adsoft2018@adsoft.com.co";
						$mail->Password = "N)qoZ,&Z!VY9"; //"adsoftcamilo1";
						$mail->Port = 587;
						$mail->From = "info@mylatindate.com"; //"adsoft2018@adsoft.com.co";
						$mail->FromName = "Mylatindate.com";
						$mail->AddAddress($email);
						$mail->IsHTML(true);
						$mail->Subject = "Codigo de verificacion | Mylatindate";
						$body = $this->load->view('view_includes/templateEmail', $dataMail, true);
						$mail->Body = $body;
						$mail->AltBody = "Nuevo código de verificacion recibido."; 
						$exito = $mail->Send();

						if ($exito) {

							$arrayCode = array('via' => "EMAIL", 'id_user' => $dataUsers[0]['id_user'], 'code_verify' => $codVerificacion);
							$saveCodeVerificacion = $this->model_home->insertCode($arrayCode);

							$message = '<br><small class="color-888" style="display: block; border-radius: 10px; background-color:#f8f8f8 !important; font-size: 15px; padding: 15px; text-align: center;"><span class="color-888" style="font-size: 20px; color: #888 !important; font-weight:bolder;">'.lang("success").'!</span><br>'.lang("text_success").'</small>';
							$arr_message = array('message_response' => $message, 'view_step' => 'required_code', 'id_user' => $dataUsers[0]['id_user']);
							$this->load->view('view_includes/view_forgotpass', $arr_message);
						} else {

							$message = '<br><small class="color-888" style="display: block; border-radius: 10px; background-color:#f8f8f8 !important; font-size: 15px; padding: 15px; text-align: center;"><span class="color-888" style="font-size: 20px; color: #888 !important; font-weight:bolder;">'.lang("attention").'!</span><br>'.lang("text_downside").'</small>';
							$arr_message = array('message_response' => $message, 'view_step' => 'required_email');
							$this->load->view('view_includes/view_forgotpass', $arr_message);
						}
					} else {

						$message = '<br><small class="color-888" style="display: block; border-radius: 10px; background-color:#f8f8f8 !important; font-size: 15px; padding: 15px; text-align: center;"><span class="color-888" style="font-size: 20px; color: #888 !important; font-weight:bolder;">'.lang("attention").'!</span><br>'.lang("incorrect_email").'</small>';
						$arr_message = array('message_response' => $message, 'view_step' => 'required_email');
						$this->load->view('view_includes/view_forgotpass', $arr_message);
					}
				} else {

					$arr_message = array('view_step' => 'required_email');
					$this->load->view('view_includes/view_forgotpass', $arr_message);
				}
			} else if ($validate_place == "Validate-Code") {

				$txt_id   = $this->input->post('txt-id');
				$txt_code = $this->input->post('txt-code');

				$arrayCode  = array('id_user' => $txt_id, 'code_verify' => $txt_code);

				if ($verifyCode = $this->model_home->verifyCode($arrayCode)) {

					$message = '<br><small class="color-888" style="display: block; border-radius: 10px; background-color:#f8f8f8 !important; font-size: 15px; padding: 15px; text-align: center;"><span class="color-888" style="font-size: 20px; color: #888 !important; font-weight:bolder;">'.lang("success").'!</span><br>'.lang("enter_new_pass").'</small>';
					$arr_message = array('message_response' => $message, 'view_step' => 'required_pass', 'id_user' => $txt_id);
					$this->load->view('view_includes/view_forgotpass', $arr_message);
				} else {

					$message = '<br><small class="color-888" style="display: block; border-radius: 10px; background-color:#f8f8f8 !important; font-size: 15px; padding: 15px; text-align: center;"><span class="color-888" style="font-size: 20px; color: #888 !important; font-weight:bolder;">'.lang("attention").'!</span><br>'.lang("incorrect_code").'</small>';
					$arr_message = array('message_response' => $message, 'view_step' => 'required_code', 'id_user' => $txt_id);
					$this->load->view('view_includes/view_forgotpass', $arr_message);
				}
			} else if ($validate_place == "Validate-Pass") {

				$pass   = $this->input->post('txt-pass');
				$repass = $this->input->post('txt-repass');
				$txt_id = $this->input->post('txt-id');
				$password_encypt =  password_hash($pass, PASSWORD_DEFAULT);  

				if ($pass == $repass) {

					$this->model_home->update_new_pass($txt_id, $password_encypt);
					redirect(base_url('Home/Login'), 'location');
				} else {
					$message = "<br><small class='color-888' style='display: block; border-radius: 10px; background-color:#f8f8f8 !important; font-size: 15px; padding: 15px; text-align: center;'><span class='color-888' style='font-size: 20px; color: #888 !important; font-weight:bolder;'>".lang("attention")."!</span><br>".lang("pass_nomatch")."</small>";
					$arr_message = array('message_response' => $message, 'view_step' => 'required_pass', 'id_user' => $txt_id);
					$this->load->view('view_includes/view_forgotpass', $arr_message);	
				}
			} else {
				$arr_message = array('view_step' => 'required_email');
				$this->load->view('view_includes/view_forgotpass', $arr_message);
			}
		}else if ($data['result_validate'] == 'session_exists'){

			redirect(base_url(), 'location');
		}		
	}

	public function Myprofile()	{
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$Myprofile_user      = $this->model_home->getDataProfilexEmail($session_email_user);
			$country_user        = $this->model_home->getDatacountry();

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$account_facebook_id = $profile_user[0]['account_facebook_id'];
			$id_user_result      = $profile_user[0]['id_user'];

			$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result, 'is_active' => $profile_user_result);
			$arr_gender_user     = array('get_place_country' => $country_user, 'account_facebook_id' => $account_facebook_id);
			$arr_profile_user    = array('get_data_user' => $profile_user, 'get_profile_user' => $Myprofile_user, 'is_Myprofile' => '1');

			if ($profile_user_result == "0") {


				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/view_create_profile', $arr_gender_user);
				$this->load->view('session_started/view_includes/view_footer');
			} else if ($profile_user_result == "1") {

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/view_my_profile', $arr_profile_user);
				$this->load->view('session_started/view_includes/view_footer');
			}
		}		
	}


	public function Profile($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

    
			//IuV significa ID user Visitor
			$token_explode = explode("IuV", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];
				$gender_user_result  = $profile_user[0]['gender_user'];

				//Aqui cargamos la visita a un perfil
				if ($id_user != $token_explode[0]) {
					$save_visitor = $this->model_home->save_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myprofile');
				}

				$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $token_explode[0], 'is_active' => $profile_user_result);
				$arr_profile_user    = array('get_data_user' => $profile_user, 'get_profile_user' => $Myprofile_user, 'is_Myprofile' => '0');

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/view_my_profile', $arr_profile_user);
				$this->load->view('session_started/view_includes/view_footer');

			} else {
				redirect(base_url(), 'location');
			}
		}		
	}


	public function Search() {

		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$Myprofile_user      = $this->model_home->getDataProfilexEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result      = $profile_user[0]['id_user'];

			$country_user        = $this->model_home->getDatacountry($gender_user_result);
			
			$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result, 'is_active' => $profile_user_result);
			$arr_profile_user    = array('get_place_country' => $country_user, 'get_data_user' => $profile_user, 'get_profile_user' => $Myprofile_user, 'is_Myprofile' => '1');

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_search', $arr_profile_user);
			$this->load->view('session_started/view_includes/view_footer');
		}		
	}

	public function UpdateImageCover() {

		$type_location = $this->input->post('name_location');
		$photo_user    = "";
		$url_photo_user    = "";

		if ($type_location == "cover_image_user") {
			$photo_table_user = "photo_cover_user";
			$url_photo_user   = "cover";
		} else if ($type_location == "profile_image_user") {
			$photo_table_user = "photo_profile_user";
			$url_photo_user   = "profile";
		}

		$session_email_user  = $this->session->userdata('email_user');
		$id_user             = $this->model_home->getDataUserxEmail($session_email_user);
		$id_user_result      = $id_user[0]['id_user'];

		$count_image = count(glob('img/profile/cover/'.$id_user_result.'/{*.jpg,*.jpeg,*.gif,*.png,*.PNG}',GLOB_BRACE));
		$count_image_profile = count(glob('img/profile/profile/'.$id_user_result.'/{*.jpg,*.jpeg,*.gif,*.png,*.PNG}',GLOB_BRACE));

		//Si el usuario es primer vez que carga una imagen, la imagen cargada se mostrara en la foto de perfil y en la foto de portada.
		//Si no, se cargar en la parte que seleccione el usuario | sea de perfil o de portada.		
		if ($count_image == 0 && $count_image_profile == 0) {

			/* -----------------------AAQUÍ INSERTAMOS LA FOTO DE PERFIL-----------------------*/
			$path_profile = './img/profile/profile/'.$id_user_result.'/';
			if (!file_exists($path_profile)) {
				mkdir($path_profile, 0777, true);
			}

			$name_input_img_profile = 'photo_img';
			$config_profile['upload_path'] = $path_profile;
			$config_profile['file_name'] = "photo_profile_user_".$id_user_result."_".rand();
			$config_profile['allowed_types'] = "jpg|jpeg|png";

			$this->load->library('upload', $config_profile);
			$this->upload->initialize($config_profile);

			if ($this->upload->do_upload($name_input_img_profile)) {

				$data = array('upload_data' => $this->upload->data());
				$name_photo = $data['upload_data']['file_name'];
				if ($this->model_home->updateImgUser($id_user_result, $name_photo, "photo_profile_user")) {
				}
			} else {

				echo $this->upload->display_errors();
				return;
			}



			/* -----------------------AAQUÍ INSERTAMOS LA FOTO DE PORTADA-----------------------*/
			$path_cover = './img/profile/cover/'.$id_user_result.'/';
			if (!file_exists($path_cover)) {
				mkdir($path_cover, 0777, true);
			}

			$name_input_img_cover = 'photo_img';
			$config_cover['upload_path'] = $path_cover;
			$config_cover['file_name'] = "photo_cover_user_".$id_user_result."_".rand();
			$config_cover['allowed_types'] = "jpg|jpeg|png";

			$this->load->library('upload', $config_cover);
			$this->upload->initialize($config_cover);

			if ($this->upload->do_upload($name_input_img_cover)) {

				$data = array('upload_data' => $this->upload->data());
				$name_photo = $data['upload_data']['file_name'];
				if ($this->model_home->updateImgUser($id_user_result, $name_photo, "photo_cover_user")) {
				}
			} else {

				echo $this->upload->display_errors();
				return;
			}
			redirect(base_url('Home/Myprofile'), 'location');
		} else {
			$path = './img/profile/'.$url_photo_user.'/'.$id_user_result.'/';
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}

			$name_input_img = 'photo_img';
			$config['upload_path'] = $path;
			$config['file_name'] = "photo_".$url_photo_user."_user_".$id_user_result."_".rand();
			$config['allowed_types'] = "jpg|jpeg|png";

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload($name_input_img)) {

				$data = array('upload_data' => $this->upload->data());
				$name_photo = $data['upload_data']['file_name'];
				if ($this->model_home->updateImgUser($id_user_result, $name_photo, $photo_table_user)) {
					redirect(base_url('Home/Myprofile'), 'location');
				}
			} else {

				echo $this->upload->display_errors();
				return;
			}
		}
	}

	public function Change_Image() {
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$Myprofile_user      = $this->model_home->getDataProfilexEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result      = $profile_user[0]['id_user'];


			$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result, 'is_active' => $profile_user_result);
			$arr_profile_user    = array('get_data_user' => $profile_user, 'get_profile_user' => $Myprofile_user, 'is_Myprofile' => '1');

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_change_images_cover', $arr_profile_user);
			$this->load->view('session_started/view_includes/view_footer');
		}		
	}


	public function Change_Profile() {
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$Myprofile_user      = $this->model_home->getDataProfilexEmail($session_email_user);
			$country_user        = $this->model_home->getDatacountry();

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result      = $profile_user[0]['id_user'];


			$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result, 'is_active' => $profile_user_result);
			$arr_profile_user    = array('get_place_country' => $country_user, 'get_data_user' => $profile_user, 'get_profile_user' => $Myprofile_user, 'is_Myprofile' => '1');

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_create_profile', $arr_profile_user);
			$this->load->view('session_started/view_includes/view_footer');
		}		
	}


	public function Verify_Profile() {
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user  = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$Myprofile_user      = $this->model_home->getDataProfilexEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result      = $profile_user[0]['id_user'];


			$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result, 'is_active' => $profile_user_result, 'verify_status' => $profile_user[0]['verify_account']);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_verify_profile');
			$this->load->view('session_started/view_includes/view_footer');
		}		
	}


	public function delete_image_cover() {
		$img_delete = $this->input->post('img_active');
		
		//$this->model_home->deleteImgUser('photo_cover_user_128_1433971789.jpg');


		if ($_SERVER['SERVER_NAME'] == "localhost") {
			$url_photo_delete = 'http://localhost/Mylatindate';
		} else if ($_SERVER['SERVER_NAME'] == "192.168.1.58") {
			$url_photo_delete = 'http://192.168.1.58/Mylatindate';
		}else{
			$url_photo_delete = 'http://mylatindate.adsoft.com.co';
		}

		$link_image = str_replace($url_photo_delete, "", $img_delete);
		
		
		$img_photo_cover = substr($img_delete,-39);
		$img_name = substr($img_delete,-35);
		
		//unlink("./".$link_image);
		
		//Eliminar si es una foto subida durante la creacion del perfil
		unlink("./img/profile/cover/".$img_photo_cover);
		
		
		$img_photo_cover = substr($img_delete,-37);
		unlink("./img/profile/cover/".$img_photo_cover);
		$img_photo_cover = substr($img_delete,-38);
		unlink("./img/profile/cover/".$img_photo_cover);
		$img_photo_cover = substr($img_delete,-39);
		unlink("./img/profile/cover/".$img_photo_cover);
	    $img_photo_cover = substr($img_delete,-40);
		unlink("./img/profile/cover/".$img_photo_cover);
	    $img_photo_cover = substr($img_delete,-41);
		unlink("./img/profile/cover/".$img_photo_cover);

		
		//Eliminar si es una foto subida despues de crear el perfil
		unlink("./img/profile/cover/".$img_name);
		
		echo "1";
	}

	public function Logout() {

		$token = $this->generateRandomString();
		$email = $this->session->userdata('email_user');

		//crea el array para consultar los datos en la base de datos
		$arr_user_login = array('token_user' => $token, 'email_user' => $email);

		//Consulta si existe el email ingresado y crea el nuevo token de inicio de sesión
		$token_init = $this->model_home->create_token($arr_user_login);

		//Crea el estado del usuario en la base de datos | 1: Login - 0: Logout
		$this->model_home->change_status($arr_user_login, '0');

		//Cierra la sesion de usuario | elimina las variables de sesión
		$this->session->unset_userdata('token_user');
		$this->session->unset_userdata('email_user');
		$this->session->sess_destroy();
		setcookie('lang', '0', time() + (86400 * 30), "/");
		redirect(base_url(), 'location');
	}


	//Esta funcion obtiene los datos del form de registro, crea un token de inicio y envia los datos a la base de datos.
	public function user_register() {

		//obtiene los datos del form de registro y quita los caracteres especiales | Evita inyección SQL
		$username        =  htmlspecialchars(htmlentities($this->input->post('txt-username')));
		$gender          =  htmlspecialchars(htmlentities($this->input->post('txt-gender')));
		$password        =  htmlspecialchars(htmlentities($this->input->post('txt-password')));
		$password_encypt =  password_hash($password, PASSWORD_DEFAULT);  
		$email           =  htmlspecialchars(htmlentities($this->input->post('txt-email')));
		$token           =  $this->generateRandomString();
		$lang            = $this->session->userdata("site_lang");

		if ($lang=="") { $lang = "English";	} else { $lang = $lang;	}


		//crea las variables de sesión
		$array_userdata = array('token_user' => $token, 'email_user' => $email);

		//crea el array para enviar los datos a la base de datos
		$arrayRegister = array(
			'name_user' => $username,
			'gender_user' => $gender, 
			'password_user' => $password_encypt,
			'email_user' => $email,
			'token_user' => $token,
			'logactive_user' => '1',
			'logindate_user' => date("Y-m-d H:i:s"),
			'loguotdate_user' => date("Y-m-d H:i:s"),
			'profactive_user' => '0',
			'languaje_user' => $lang
		);

			//Envia los datos a la base de  datos y recibe el resultado
		$resultRegister = $this->model_home->user_register($arrayRegister);

			//valida el resultado de la inserción | Resultados => 'ok_insert' = inserción correcta, 'exists_user' = usuario existente, 'false' = error en la inserción
		if ($resultRegister == "ok_insert") {

			$this->session->set_userdata($array_userdata);
			redirect('Home/Myprofile', 'location');

		} else if ($resultRegister == "exists_user") {
			$result_insert = '<small style="text-align: center; width: 96%; padding: 10px; margin-top: 10px; background-color:red; color: #FFF; margin: auto; display: block;">'.lang("email_exists").'</small>';
			$arr_exists_user = array('exists_user' => $result_insert);

			$this->load->view('view_includes/view_header', $arr_exists_user);
			$this->load->view('view_index');
			$this->load->view('view_includes/view_footer');
		}
		else if ($resultRegister == false) {
			$result_insert = '<small style="text-align: center; width: 100%; padding: 10px; margin-top: 10px; background-color:red; color: #FFF;">Internal error, contact the administrator.</small>';
			$arr_exists_user = array('exists_user' => $result_insert);

			$this->load->view('view_includes/view_header', $arr_exists_user);
			$this->load->view('view_index');
			$this->load->view('view_includes/view_footer');
		}
	}


	public function create_profile($indication) {

		$session_email_user = $this->session->userdata('email_user');
		$data_user          = $this->model_home->getDataUserxEmail($session_email_user);

		$id_user_result     = $data_user[0]['id_user'];
		$email_user_result  = $data_user[0]['email_user'];
		$gender_user_result = $data_user[0]['gender_user'];

		$datos=$this->model_home->postToValor($_POST);

		$data['result']='OK';
		$data['errorTexto']="";
		$data['error_campos']=array();

		if ($datos['country_residence'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_country_residence').''.lang('text_error_state_residence').''.lang('text_error_city_residence');
			$data['error_campos'][]="country_residence";
		} else {

			if ($datos['state_residence'] == "") {
				$data['result']='KO';
				$data['errorTexto'].=lang('text_error_state_residence').''.lang('text_error_city_residence');
				$data['error_campos'][]="state_residence";
			} else {

				if ($datos['city_residence'] == "") {
					$data['result']='KO';
					$data['errorTexto'].=lang('text_error_city_residence');
					$data['error_campos'][]="city_residence";
				}
			}
		} 

		if ($datos['nationality'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_nationality');
			$data['error_campos'][]="nationality";
		}

		if ($datos['marital_status'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_marital_status');
			$data['error_campos'][]="marital_status";
		}

		if ($datos['have_children'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_have_children');
			$data['error_campos'][]="have_children";
		}

		if ($datos['age'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_age');
			$data['error_campos'][]="age";
		}

		if ($datos['profile_heading'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_profile_heading');
			$data['error_campos'][]="profile_heading";
		}

		if ($datos['about_yourself'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_about_yourself');
			$data['error_campos'][]="about_yourself";
		}

		if ($datos['looking_partner'] == "") {
			$data['result']='KO';
			$data['errorTexto'].=lang('text_error_looking_partner');
			$data['error_campos'][]="looking_partner";
		}

		if ($_FILES['photo_profile_user']['name']=="") {
			if ($datos['photo_profile_user_sec']=="") {
				$data['result']='KO';
				$data['errorTexto'].=lang('text_error_photo_profile_user');
			} else {
				$datos['photo_profile_user'] = $datos['photo_profile_user_sec'];
			}

		}

		if ($_FILES['photo_verify_user']['name']=="") {
			if ($datos['photo_verify_user_sec']=="") {
				$data['result']='KO';
				$data['errorTexto'].=lang('text_error_photo_verify_user');
			} else {
				$datos['photo_verify_user'] = $datos['photo_verify_user_sec'];
			}
		} 

		if ($data['result']=='OK') {


			if ($_FILES['photo_profile_user']['name']!="") {

				//Creamos la ruta donde se guardará la imagen
				$path_profile = './img/profile/profile/'.$id_user_result.'/';

				//Validamos si la ruta existe, sino la creamos
				if (!file_exists($path_profile)) {
					mkdir($path_profile, 0777, true);
				}

				//Tomamos el name del input del form
				$input_avatar = 'photo_profile_user';

				//Creamos la configuración de la subida de la imagen
				$config['upload_path']   = $path_profile;
				$config['file_name']     = "profile_".rand()."_".time();
				$config['allowed_types'] = "jpg|jpeg|png";

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload($input_avatar)) {

					$data   = array('upload_data' => $this->upload->data());
					$name   = $data['upload_data']['file_name'];

					//Agregamos el nombre de la imagen
					$datos['photo_profile_user'] = $name;

					//Devilvemos un OK
					$data['result']='OK';
					$data['errorTexto']="";
				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
				}

				if ($datos['photo_cover_user']=="") {

					//Creamos la ruta donde se guardará la imagen
					$path_profile = './img/profile/cover/'.$id_user_result.'/';

					//Validamos si la ruta existe, sino la creamos
					if (!file_exists($path_profile)) {
						mkdir($path_profile, 0777, true);
					}

					//Tomamos el name del input del form
					$input_avatar = 'photo_profile_user';

					//Creamos la configuración de la subida de la imagen
					$config['upload_path']   = $path_profile;
					$config['file_name']     = "cover_".rand()."_".time();
					$config['allowed_types'] = "jpg|jpeg|png";

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload($input_avatar)) {

						$data   = array('upload_data' => $this->upload->data());
						$name   = $data['upload_data']['file_name'];

						//Agregamos el nombre de la imagen
						$datos['photo_cover_user'] = $name;

						//Devilvemos un OK
						$data['result']='OK';
						$data['errorTexto']="";
					}
				}
			}


			if ($_FILES['photo_verify_user']['name']!="") {

				//Creamos la ruta donde se guardará la imagen
				$path_profile = './img/profile/verify';

				//Tomamos el name del input del form
				$input_img = 'photo_verify_user';

				//Creamos la configuración de la subida de la imagen
				$config['upload_path']   = $path_profile;
				$config['file_name']     = "img_".rand()."_".time();
				$config['allowed_types'] = "jpg|jpeg|png";

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

			    if ($this->upload->do_upload($input_img)) {

					$data = array('upload_data' => $this->upload->data());

					//Agregamos el nombre de la imagen
					$datos['photo_verify_user'] = $data['upload_data']['file_name'];

					//Devilvemos un OK
					$data['result']='OK';
					$data['errorTexto']="";
				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
				}
			}

			if (isset($datos['gender_user'])) {
				$this->model_home->updateDataUser('gender_user', $datos['gender_user'], $id_user_result);
				unset($datos['gender_user']);
			}

			$data_main['id_user']    = $id_user_result;
			$data_main['email_user'] = $email_user_result;

			$datos=array_merge($data_main, $datos);

			unset($datos['photo_verify_user_sec']);
			unset($datos['photo_profile_user_sec']);

			if ($indication == "create") {

				$this->model_home->insertDataProfile($datos);
				$this->model_home->active_profile($email_user_result, '1');

				$this->model_home->verify($data_main['id_user'], $datos['photo_verify_user']);
				$this->model_home->verify_status($data_main['id_user'], 1);

				$data['result']     = 'OK';
				$data['errorTexto'] = '<p>Profile created successfully.</p>';
				$data['retorno']    = base_url('Home/Myprofile');

			} else if ($indication == "change") {

				$this->model_home->updateDataProfile($datos, $id_user_result);
				$data['result']     = 'OK';
				$data['errorTexto'] = '<p>Profile created successfully.</p>';
				$data['retorno']    = base_url('Home/Myprofile');
				$this->model_home->active_profile($email_user_result, '1');
			}
		}

		echo json_encode($data);
	}

	public function getState($country_id) {

		$datos=$this->model_home->postToValor($_POST);
		
		if($getState = $this->model_home->getDataState($country_id)) {
			echo '<option value="">'.lang('please_select').'...</option>';
			foreach ($getState as $key) {
				echo "<option value='".$key->id.",".$key->name."'";
				if (isset($datos['id_state']) && $datos['id_state']==$key->id.",".$key->name) { echo "selected"; } else { echo ""; }
				echo ">".$key->name."</option>";
			}
		}
		else{
			echo 0;
		}  
	}

	public function getCity($state_id) {

		$datos=$this->model_home->postToValor($_POST);

		if($getCity = $this->model_home->getDataCity($state_id)){
			echo '<option value="">'.lang('please_select').'...</option>';
			foreach ($getCity as $key) {
				echo "<option value='".$key->id.",".$key->name."'";
				if (isset($datos['id_city']) && $datos['id_city']==$key->id.",".$key->name) { echo "selected"; } else { echo ""; }
				echo ">".$key->name."</option>";
			}
		}
		else{
			echo 0;
		}  
	}

	public function Viewedmyprofile() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountData($id_user_result, 'view_myprofile', 'no');

			$arr_profile_active    = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_visitor_myprofile = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_visitor_myprofile);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function InterestedInMe() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountData($id_user_result, 'view_myinterested', 'no');

			$arr_profile_active    = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_myinterested = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_myinterested);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function FavoriteOf() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountData($id_user_result, 'view_myfavorites', 'no');

			$arr_profile_active    = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_myfavorites = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_myfavorites);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function Messages($tipo="") {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor       = $this->model_home->getCountData($id_user_result, 'view_mymessages', 'no', $tipo);
			$arr_profile_active = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$count_my_messages  = $this->model_home->getCountData($id_user_result, 'view_mymessages', 'yes', $tipo);
			$arr_myfavorites    = array('getDataUsers' => $data_visitor, 'get_count_messages' => $count_my_messages);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_menu');
			$this->load->view('session_started/view_includes/view_data_users', $arr_myfavorites);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function DeleteMessages() {

		$id_message    = htmlspecialchars_decode(html_entity_decode($this->input->post("id_message")));

		$data_message  = $this->model_home->get_message($id_message);

		$chat_emisor   = "system/messages/".$data_message[0]['id_user']."_".$data_message[0]['id_visitor'];
		$chat_receptor = "system/messages/".$data_message[0]['id_visitor']."_".$data_message[0]['id_user'];

		if (file_exists($chat_emisor)) {

			$files = glob($chat_emisor."/*.txt");

			foreach($files as $file) {
				if(is_file($file)) {
					unlink($file);
					rmdir($chat_emisor);
				}
			}
		}

		if (file_exists($chat_receptor)) {

			$files = glob($chat_receptor."/*.txt");

			foreach($files as $file) {
				if(is_file($file)) {
					unlink($file);
					rmdir($chat_receptor);
				}
			}
		}

		$this->model_home->del_message($id_message);
	}

	public function ViewedProfile() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountDataVisitor($id_user_result, 'view_myprofile', 'no');

			$arr_profile_active    = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_visitor_myprofile = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_visitor_myprofile);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function MyInterest() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountDataVisitor($id_user_result, 'view_myinterested', 'no');

			$arr_profile_active    = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_myinterested = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_myinterested);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function MyFavorites() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountDataVisitor($id_user_result, 'view_myfavorites', 'no');

			$arr_profile_active = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_myfavorites = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_myfavorites);
			$this->load->view('session_started/view_includes/view_footer');			
		}
	}

	public function Block() {

		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);

			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];

			$data_visitor = $this->model_home->getCountDataVisitor($id_user_result, 'view_myblocked', 'no');

			$arr_profile_active = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result);
			$arr_myblocked = array('getDataUsers' => $data_visitor);

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/view_includes/view_data_users', $arr_myblocked);
			$this->load->view('session_started/view_includes/view_footer');
		}
	}

	public function AddMyInterested($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user favorite
			$token_explode = explode("IuF", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$profile_user_result = $profile_user[0]['profactive_user'];

				//Aqui cargamos los que me interesan
				$save_my_interested = $this->model_home->save_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myinterested');
				
				$token_user[5] = 'V';
			    redirect('Home/Profile/'.$token_user);
				
			} else {
				echo 0;
			}
		}		
	}


	public function DelMyInterested($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user Visitor
			$token_explode = explode("IuF", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];

				//Aqui cargamos los que me interesan
				$save_my_interested = $this->model_home->delete_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myinterested');
				
				$token_user[5] = 'V';
			    redirect('Home/Profile/'.$token_user);
			} else {
				echo 0;
			}
		}		
	}

	public function AddMyFavorites($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user Visitor
			$token_explode = explode("IuF", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];

				//Aqui cargamos los que me interesan
				$save_my_interested = $this->model_home->save_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myfavorites');
				echo "<script>window.history.back()</script>";
			} else {
				redirect(base_url(), 'location');
			}
		}		
	}


	public function DelMyFavorites($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user Visitor
			$token_explode = explode("IuF", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];

				//Aqui cargamos los que me interesan
				$save_my_interested = $this->model_home->delete_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myfavorites');
				echo "<script>window.history.back()</script>";
			} else {
				redirect(base_url(), 'location');
			}
		}		
	}


	public function AddMyBlocked($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user Visitor
			$token_explode = explode("IuF", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];

				//Aqui cargamos los que me interesan
				$save_my_interested = $this->model_home->save_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myblocked');
				echo "<script>window.history.back()</script>";
			} else {
				redirect(base_url(), 'location');
			}
		}		
	}


	public function DelMyBlocked($token_user="")	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user Visitor
			$token_explode = explode("IuF", $token_user);


			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {
				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];

				//Aqui cargamos los que me interesan
				$save_my_interested = $this->model_home->delete_visitor_myinterested_favorites($id_user, $token_explode[0], 'view_myblocked');
				echo "<script>window.history.back()</script>";
			} else {
				redirect(base_url(), 'location');
			}
		}		
	}


	public function Send_Message($token_user="") {
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		if ($token_user == "") {
			redirect(base_url(), 'location');
		}

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){


			//IuV significa ID user Visitor
			$token_explode = explode("IuM", $token_user);
			$validate_block = "";
			$get_id_user = $token_explode[0];

			if ($token_profile       = $this->model_home->getDataUserxToken($token_explode[1])) {

				$id_user             = $token_profile[0]['id_user'];
				$email_profile       = $token_profile[0]['email_user'];

				$profile_user        = $this->model_home->getDataUserxEmail($email_profile);
				$Myprofile_user      = $this->model_home->getDataProfilexEmail($email_profile);

				$profile_user_result = $profile_user[0]['profactive_user'];
				$gender_user_result  = $profile_user[0]['gender_user'];

				$arr_user    = $this->model_home->query_visitor_myinterested_favorites($id_user, $get_id_user, 'view_myblocked');
				$arr_visitor = $this->model_home->query_visitor_myinterested_favorites($get_id_user, $id_user, 'view_myblocked');
				if ($arr_user == "1" or $arr_visitor == "1") {
					$validate_block = "1";
				} else {
					$validate_block = "0";
				}

				$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $token_explode[0], 'is_active' => $profile_user_result);
				$arr_profile_user    = array('get_data_user' => $profile_user, 'get_profile_user' => $Myprofile_user, 'is_Myprofile' => '0', 'validate_block' => $validate_block);

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/messages/view_messages', $arr_profile_user);
				$this->load->view('session_started/view_includes/view_footer');
			} else {

				redirect(base_url(), 'location');
			}
		}		
	}

	public function searching_users() {

		$this->session->unset_userdata('ci_search');

		$datos=$this->model_home->postToValor($_POST);

		$data['session_email_user'] = $this->session->userdata('email_user');
		$data['profile_user']       = $this->model_home->getDataUserxEmail($data['session_email_user']);

		$data['is_active']   = $data['profile_user'][0]['profactive_user'];
		$data['gender_user'] = $data['profile_user'][0]['gender_user'];
		$data['id_user']     = $data['profile_user'][0]['id_user'];


		$data['getDataUsers'] = $this->model_home->searching_users($datos);
		
		$this->session->set_userdata('ci_search', $datos);

		$this->load->view('session_started/view_includes/view_header', $data);
		$this->load->view('session_started/view_includes/view_data_users');
		$this->load->view('session_started/view_includes/view_footer');
	}

	public function getCountMenu() {

		$id_user = htmlspecialchars(htmlentities($this->input->post('id_user')));
		$place   = htmlspecialchars(htmlentities($this->input->post('place')));
		$active  = htmlspecialchars(htmlentities($this->input->post('active')));

		if($countResult = $this->model_home->getCountData($id_user, $place, $active)) {
			echo count($countResult);
		} else {
			echo "0";
		}
	}

	//Esta funcion genera string aleatorios para la creación del token
	public function generateRandomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	} 

	public function Configuration()	{
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		$session_email_user  = $this->session->userdata('email_user');
		$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
		$profile_user_result = $profile_user[0]['profactive_user'];
		$id_user_result      = $profile_user[0]['id_user'];
		$gender_user_result  = $profile_user[0]['gender_user'];
		$languaje_user       = $profile_user[0]['languaje_user'];
		$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result, 'languaje_user' => $languaje_user);

		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
			$this->load->view('session_started/config/view_configuration');
			$this->load->view('session_started/view_includes/view_footer');
		}		
	}

	public function Events() {
		
		//Recibe el token y muestra los datos | Variable $data creada en el constructor
		$data = $this->data;

		$session_email_user   = $this->session->userdata('email_user');
		$profile_user         = $this->model_home->getDataUserxEmail($session_email_user);
		
		$data['is_active']    = $profile_user[0]['profactive_user'];
		$data['id_user']      = $profile_user[0]['id_user'];
		$data['gender_user']  = $profile_user[0]['gender_user'];
		$data['events']       = $this->model_home->get_events($data['id_user']);
		
		if ($data['result_validate'] == 'no_session_create'){  

			redirect(base_url(), 'location');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$this->load->view('session_started/view_includes/view_header', $data);
			$this->load->view('session_started/events/view_events');
			$this->load->view('session_started/view_includes/view_footer');
		}		
	}	

	public function set_site_languaje($lang) {

		$url = base_url();

		if($this->agent->referrer()) {
			$url = $this->agent->referrer();
		}

		$this->session->set_userdata("site_lang", $lang);
		redirect($url);
	}


	public function verify_account($place="", $id_user="", $id_verify="") {

		$email = $this->session->userdata('email_user');
		$dataUsers = $this->model_home->getDataUserxEmail($email);

		if ($place=="start" && $_FILES["image-verify"]["name"]!="") {

			//Creamos la ruta donde se guardará la imagen
			$path_profile = './img/profile/verify';

			//Tomamos el name del input del form
			$input_img = 'image-verify';

			//Creamos la configuración de la subida de la imagen
			$config['upload_path']   = $path_profile;
			$config['file_name']     = "img_".rand()."_".time();
			$config['allowed_types'] = "jpg|jpeg|png";

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload($input_img)) {

				$data      = array('upload_data' => $this->upload->data());
				$name      = $data['upload_data']['file_name'];
				$id_verify = $this->model_home->verify($dataUsers[0]['id_user'], $name);

				if ($this->send_verify($name, $id_verify)) {

					$this->model_home->verify_status($dataUsers[0]['id_user'], 1);
					redirect(base_url("Home/Verify-Profile"), "location");
				}
			} else {

				echo $this->upload->display_errors();
				return;
			}

		} else if ($place=="resend") {

			$this->model_home->verify_status($dataUsers[0]['id_user'], 0);
			redirect(base_url("Home/Verify-Profile"), "location");

		}  else if ($place=="accept") {

			$this->model_home->verify_status($id_user, 2);
			redirect(base_url('admin/verify/'.$id_verify."/Sfd34waf34AAs"), "location");

		}  else if ($place=="decline") {

			$this->model_home->verify_status($id_user, 3);
			redirect(base_url('admin/verify/'.$id_verify."/Nfd34waf34AAs"), "location");

		} else {

			redirect(base_url("Home/Verify-Profile"), "location");
		}
	}


	public function send_verify($name, $id_verify) {

		$email = $this->session->userdata('email_user');

		if ($dataUsers = $this->model_home->getDataUserxEmail($email)) {

			$path_img = './img/profile/verify/'.$name;	

			$dataMail = array(
				'id_user'   => $dataUsers[0]['id_user'],
				'id_verify' => $id_verify,
				'name_user' => $dataUsers[0]['name_user']
			);

			$this->load->library("sendMailer");
			$mail = new sendMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = "smtp.hostinger.co";
			$mail->CharSet = 'UTF-8';
			$mail->Username = "adsoft2018@adsoft.com.co";
			$mail->Password = "adsoftcamilo1";
			$mail->Port = 587;
			$mail->From = "adsoft2018@adsoft.com.co";
			$mail->FromName = "Mylatindate.com";
			$mail->AddAddress("jcamilobolivar96@gmail.com");
			$mail->IsHTML(true);
			$mail->Subject = "Verificacion de cuenta | Mylatindate";
			$body = $this->load->view('view_includes/templateVerify', $dataMail, true);
			$mail->Body = $body;
			$mail->AddAttachment($path_img);
			$mail->AltBody = "Nueva solicitud de verificación recibida.";
			$exito = $mail->Send();	
			return true;
		} else {
			return false;
		}
	}

	public function Report_User($token="")	{

		$datos=$this->model_home->postToValor($_POST);

		$data['result']='OK';
		$data['errorTexto']="";

		//Revisa que los campos esten llenos y que el email sea válido, si no mandara error
		if ($datos['subject_claims']==""){

			$data['result']='KO';
			$data['errorTexto'].="<p>El campo asunto es obligatorio.</p>";
		}

		if ($datos['body_claims']==""){

			$data['result']='KO';
			$data['errorTexto'].="<p>El campo cuerpo del correo es obligatorio.</p>";
		}

		//IuR significa ID user Reported

		if (strpos($token, 'IuR') !== false) {

			$token_explode = explode("IuR", $token);
			$token_profile = $this->model_home->getDataUserxToken($token_explode[1]);
			$datos['reporter_claims'] = $token_explode[0];
			$datos['reported_claims'] = $token_profile[0]['id_user'];
		} else {

			$datos['reporter_claims'] = $token;
			$datos['reported_claims'] = 0;
		}

		$datos['token_claims']    = $this->generateRandomString(20);
		$datos['status_claims']   = 1;

		if ($data['result']=="OK") {

			if ($_FILES['attachment_claims']['name']!="") {

				//Creamos la ruta donde se guardará la imagen
				$path_profile = './img/report/';

				//Validamos si la ruta existe, sino la creamos
				if (!file_exists($path_profile)) {
					mkdir($path_profile, 0777, true);
				}

				//Tomamos el name del input del form
				$input_attachment = 'attachment_claims';

				//Creamos la configuración de la subida de la imagen
				$config['upload_path']   = $path_profile;
				$config['file_name']     = "report_".rand()."_".time();
				$config['allowed_types'] = "jpg|jpeg|png";

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload($input_attachment)) {

					$data   = array('upload_data' => $this->upload->data());
					$name   = $data['upload_data']['file_name'];

					//Agregamos el nombre de la imagen
					$datos['attachment_claims'] = $name;

					//Devilvemos un OK
					$data['result']='OK';
					$data['errorTexto']="";
				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
				}
			}

			$this->model_home->insert_report($datos);
		}

		echo json_encode($data);
	}

	public function update_status_event()
	{
		
		$datos=$this->model_home->postToValor($_POST);

		if ($datos['status_assistance']==1) {
			
			$email = $this->session->userdata('email_user');

			$data_mail['user']    = $this->model_home->getDataUserxEmail($email);
			$data_mail['event']   = $this->model_home->events_xtoken($datos['token_assistance']);
			$data_mail['subject'] = 'Confirmaste asistencia al evento | Mylatindate';

			$this->model_email->email_management($email, 'email_confirm_assistance', $data_mail);
		}

		$this->model_home->event_assistance($datos);
	}

	public function view_email($place="") {
		

		if ($place=="email_confirm_assistance") {

			$data_mail['user']  = $this->model_home->getDataUserxEmail('jcamilobolivar96@gmail.com');
			$data_mail['event'] = $this->model_home->events_xtoken('DtMlpySJxKGp7g2kIOiXsEhhVsmKcsnlToEx6s2honT41');
			
			$this->load->view('view_includes/email/email_confirm_assistance', $data_mail);
		}

	}
}