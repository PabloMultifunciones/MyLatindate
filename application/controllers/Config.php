<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

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
			$this->session->set_userdata("site_lang", $profile_user[0]['languaje_user']);
		}
	}  

	public function Emailsettings($option="")	{

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
				
				$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result, 'email' => $session_email_user);

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/config/view_config_index');
				$this->load->view('session_started/view_includes/view_footer');
			}
		}
	}

	public function Passwordsettings($option="")	{

		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create'){  

			$this->load->view('view_includes/view_header');
			$this->load->view('view_index');
			$this->load->view('view_includes/view_footer');
		}
		else if ($data['result_validate'] == 'session_exists'){

			$session_email_user = $this->session->userdata('email_user');
			$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
			$profile_user_result = $profile_user[0]['profactive_user'];
			$gender_user_result  = $profile_user[0]['gender_user'];
			$id_user_result = $profile_user[0]['id_user'];
			
			if ($profile_user_result == "0") {
				
				redirect('Home/Myprofile', 'location');
			} else if ($profile_user_result == "1") {
				
				$arr_profile_active  = array('gender_user' => $gender_user_result, 'id_user' => $id_user_result,'is_active' => $profile_user_result, 'email' => $session_email_user);

				$this->load->view('session_started/view_includes/view_header', $arr_profile_active);
				$this->load->view('session_started/config/view_config_pass');
				$this->load->view('session_started/view_includes/view_footer');
			}
		}
	}

	public function change_email() {
		
		$session_email_user  = $this->session->userdata('email_user');
		$profile_user        = $this->model_home->getDataUserxEmail($session_email_user);
		$id_user_result      = $profile_user[0]['id_user'];
		$txt_email           = htmlspecialchars(htmlentities($this->input->post('txt_email')));

		if ($this->model_home->change_email($txt_email, $id_user_result)) {
			redirect(base_url('Home/Logout'), 'location');
		}
	}

	public function change_password() {
		
		$session_email_user = $this->session->userdata('email_user');
		$profile_user       = $this->model_home->getDataUserxEmail($session_email_user);
		$id_user_result     = $profile_user[0]['id_user'];
		$password_user      = $profile_user[0]['password_user'];
		$current_pass       = htmlspecialchars(htmlentities($this->input->post("current_pass")));
		$new_pass           = htmlspecialchars(htmlentities($this->input->post("new_pass")));
		$renew_pass         = htmlspecialchars(htmlentities($this->input->post("renew_pass")));
		$password_encypt    =  password_hash($new_pass, PASSWORD_DEFAULT);

		if ($new_pass == $renew_pass) {
			
			if(password_verify($current_pass, $password_user)){

				if ($this->model_home->change_pass($password_encypt, $id_user_result)) {
					redirect(base_url('Config/Passwordsettings/Sc12Es34Ce56'), 'location');
				}			
			} else {

				redirect(base_url('Config/Passwordsettings/Nc12En34Ce56'), 'location');
			}
		} else {

			redirect(base_url('Config/Passwordsettings/Ni12En34Ie56'), 'location');
		}
	}


	public function change_lang() {

		$session_email_user = $this->session->userdata('email_user');
		$data_user          = $this->model_home->getDataUserxEmail($session_email_user);

		$id_user_result     = $data_user[0]['id_user'];

		$lang = htmlspecialchars(htmlentities($this->input->post("lang")));

		$this->model_home->updateDataUser('languaje_user', $lang, $id_user_result);
		
		$this->session->set_userdata("site_lang", $lang);
	}
}
?>