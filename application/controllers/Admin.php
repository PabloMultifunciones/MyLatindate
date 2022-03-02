<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	//"global" items
	var $data;

	function __construct() {
		parent::__construct();

		//Cargamos los models -> $this->load->model('model_admin');
		$this->load->model('model_admin');
		$this->load->model('model_config');
		$this->load->model('model_home');

		//Recibe la variable de sesión
		$data_session['token_admin'] = $this->session->userdata('token_admin');
		$data_session['id_admin']    = $this->session->userdata('id_admin');

		//Valida si existe una sesión y envía el resultado a todas las funciones con el array global $data		
		if (isset($data_session) && $data_session['token_admin'] != "" && $data_session['id_admin'] != "") {  
			
			//valida si el token de usuario existe
			$data_session['validate_token_session'] = $this->model_admin->validate_token_session($data_session);

			if (isset($data_session['validate_token_session']) && count($data_session['validate_token_session']) > 0) {

				$this->data = array('result_validate' => 'session_create');
				
			} else {

				$this->data = array('result_validate' => 'no_session_create');
			}
			
		} else {

			$this->data = array('result_validate' => 'no_session_create');  
		}
	}


	public function index()	{

				//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			$this->Dashboard();

		}
	}

	public function Signin() {

		$datos=$this->model_home->postToValor($_POST);

		$data['result']='OK';
		$data['errorTexto']="";

		//Revisa que los campos esten llenos y que el email sea válido, si no mandara error
		if ($datos['email']==""){

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo email es obligatorio.</p>";
		} else if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>Email incorrecto, introduzca un email válido.</p>";
		}

		if ($datos['password']==""){

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo contraseña es obligatorio.</p>";
		}

		if ($data['result']=="OK") {

			//Si los campos no estan vacios, entonces busca que el email exista en la base de datos
			$data_user = $this->model_admin->user_xemail($datos);

			if (isset($data_user) && count($data_user) > 0) {

				//Validamos si la contraseña es correcta
				if(password_verify($datos['password'], $data_user[0]['password_admin'])) {

					//crea el array para consultar los datos en la base de datos
					$session_userdata['token_admin'] = $this->model_config->generateRandomString();
					$session_userdata['id_admin']    = $data_user[0]['id_admin'];
					$session_userdata['email_admin'] = $data_user[0]['email_admin'];

					//Asigna el nuevo token de inicio de sesión
					$this->model_admin->create_token($session_userdata);
					$this->session->set_userdata($session_userdata);

				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p class='m-0'>Email o contraseña incorrectos, intenta nuevamente.</p>";
				}

			} else {

				$data['result']='KO';
				$data['errorTexto'].="<p class='m-0'>Email o contraseña incorrectos, intenta nuevamente.</p>";
			}
		}

		echo json_encode($data);
	}


	public function Logout() {

		//crea el array para consultar los datos en la base de datos
		$session_userdata['token_admin'] = $this->model_config->generateRandomString();
		$session_userdata['id_admin']    = $this->session->userdata('id_admin');
		$session_userdata['email_admin'] = $this->session->userdata('email_admin');

		//Asigna el nuevo token de inicio de sesión
		$this->model_admin->create_token($session_userdata);

		//Cierra la sesion de usuario | elimina las variables de sesión
		$this->session->unset_userdata('token_admin');
		$this->session->unset_userdata('email_admin');
		$this->session->unset_userdata('id_admin');
		$this->session->sess_destroy();
		redirect(base_url('Admin'), 'location');
	}

	public function Dashboard() {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			
			$data['count_reports_users'] = $this->model_admin->reports_users("claims_active");
			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_index');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function Users($datos="") {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			$datos = htmlspecialchars(htmlentities($datos));
			$data['count_users'] = $this->model_admin->count_users($datos);

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_users');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function Claims($token='') {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			if ($token!="") {
				$this->model_admin->status_claims($token);
				$data['reports_xtoken']  = $this->model_admin->reports_users($token);
			}

			$data['reports_users']       = $this->model_admin->reports_users();
			$data['count_reports_users'] = $this->model_admin->reports_users("claims_active");

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_claims');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function Verify($id_verify="") {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			if ($id_verify!="") {
				$this->model_admin->status_verify($id_verify);
				$data['verify_xid']  = $this->model_admin->verify_users($id_verify);
			}

			$data['verify_users']       = $this->model_admin->verify_users();
			$data['count_verify_users'] = $this->model_admin->verify_users("verify_active");

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_verify');
			$this->load->view('admin/view_includes/view_footer');
		}
	}	

	public function Config() {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			//Enviamos los datos de la base de datos del model a la vista ->$data['data'] = $this->model_admin->data('data');

			$data['settings'] = $this->model_admin->settings();
			//Cargamos las vistas y la variable data en el header, si lleva datos de la BD
			$this->load->view('admin/view_includes/view_header',$data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_settings');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function edit_settings() {
		
		$datos=$this->model_config->postToValor($_POST);

		$data['result']='OK';
		$data['errorTexto']="";

		//Revisa que los campos esten llenos y que el email sea válido, si no mandara error

		if ($datos['name_app']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Nombre de la aplicación es obligatorio.</p>";
		}

		if ($datos['description_app']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Descripción de la aplicación es obligatorio.</p>";
		}

		if ($_FILES['favicon_app']['name']=="") {
			if ($datos['favicon_app_sec']=="") {
				$data['result']='KO';
				$data['errorTexto'].="<p class='m-0'>El campo Favicon de la aplicación es obligatorio.</p>";
			} else {
				$datos['favicon_app'] = $datos['favicon_app_sec'];
			}
		}

		if ($_FILES['logo_app']['name']=="") {
			if ($datos['logo_app_sec']=="") {
				$data['result']='KO';
				$data['errorTexto'].="<p class='m-0'>El campo Logo de la aplicación es obligatorio.</p>";
			} else {
				$datos['logo_app'] = $datos['logo_app_sec'];
			}
		}

		if ($data['result']=="OK") {


			if ($_FILES['favicon_app']['name']!="") {

				//Creamos la ruta donde se guardará la imagen
				$path_profile = './img/settings/';

				//Validamos si la ruta existe, sino la creamos
				if (!file_exists($path_profile)) {
					mkdir($path_profile, 0777, true);
				}

				//Tomamos el name del input del form
				$input_avatar = 'favicon_app';

				//Creamos la configuración de la subida de la imagen
				$config['upload_path']   = $path_profile;
				$config['file_name']     = "favicon_".rand()."_".time();
				$config['allowed_types'] = "jpg|jpeg|png";

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload($input_avatar)) {

					$data   = array('upload_data' => $this->upload->data());
					$name   = $data['upload_data']['file_name'];

					//Agregamos el nombre de la imagen
					$datos['favicon_app'] = $name;

					//Devilvemos un OK
					$data['result']='OK';
					$data['errorTexto']="";
				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
				}
			}

			if ($_FILES['logo_app']['name']!="") {

				//Creamos la ruta donde se guardará la imagen
				$path_profile = './img/settings/';

				//Validamos si la ruta existe, sino la creamos
				if (!file_exists($path_profile)) {
					mkdir($path_profile, 0777, true);
				}

				//Tomamos el name del input del form
				$input_avatar = 'logo_app';

				//Creamos la configuración de la subida de la imagen
				$config['upload_path']   = $path_profile;
				$config['file_name']     = "logo_".rand()."_".time();
				$config['allowed_types'] = "jpg|jpeg|png";

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload($input_avatar)) {

					$data   = array('upload_data' => $this->upload->data());
					$name   = $data['upload_data']['file_name'];

					//Agregamos el nombre de la imagen
					$datos['logo_app'] = $name;

					//Devilvemos un OK
					$data['result']='OK';
					$data['errorTexto']="";
				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
				}
			}

			unset($datos['favicon_app_sec']);
			unset($datos['logo_app_sec']);
			$this->model_admin->update_settings($datos);

		}

		echo json_encode($data);
	}

	public function Events() {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {


			$data['events']          = $this->model_admin->events();
			$data['events_active']   = $this->model_admin->events('active');
			$data['events_inactive'] = $this->model_admin->events('inactive');

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_events');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function Handling_Event($id_event="") {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			if ($id_event!="") { $data['events_xtoken'] = $this->model_admin->events('token', $id_event); }
			$data['country'] = $this->model_home->getDatacountry();

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_create_edit_event');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function create_edit_event() {

		$datos=$this->model_home->postToValor($_POST);

		$data['result']='OK';
		$data['errorTexto']="";


		if ($datos['name_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Nombre del evento es obligatorio.</p>";
		}

		if ($datos['addressedto_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Evento dirijido a es obligatorio.</p>";
		}

		if ($datos['description_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Descripción del evento es obligatorio.</p>";
		}

		if ($datos['date_from_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Fecha de inicio es obligatorio.</p>";
		}

		if ($datos['date_to_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Fecha de finalización es obligatorio.</p>";

		} else if ($datos['date_to_event'] < $datos['date_from_event']) {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Fecha de finalización debe ser mayor o igual al campo Fecha de inicio es obligatorio.</p>";
		}

		if ($datos['country_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo País es obligatorio.</p>";
		}

		if ($datos['state_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Estado/provincia es obligatorio.</p>";
		}

		if ($datos['city_event']=="") {

			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Ciudad es obligatorio.</p>";
		}

		if ($_FILES['attachment_event']['name']=="") {

			if ($datos['attachment_event_sec']!="") {
				$datos['attachment_event'] = $datos['attachment_event_sec'];
			}
		} else {

			//Creamos la ruta donde se guardará la imagen
			$path_profile = './img/events/';

			//Validamos si la ruta existe, sino la creamos
			if (!file_exists($path_profile)) {
				mkdir($path_profile, 0777, true);
			}

			//Tomamos el name del input del form
			$input_avatar = 'attachment_event';

			//Creamos la configuración de la subida de la imagen
			$config['upload_path']   = $path_profile;
			$config['file_name']     = "event_".rand()."_".time();
			$config['allowed_types'] = "pdf";

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload($input_avatar)) {

				$data   = array('upload_data' => $this->upload->data());
				$name   = $data['upload_data']['file_name'];

				//Agregamos el nombre de la imagen
				$datos['attachment_event'] = $name;

				//Devilvemos un OK
				$data['result']='OK';
				$data['errorTexto']="";
			} else {

				$data['result']='KO';
				$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
			}
		}

		if ($data['result']=="OK") {

			if (isset($datos['status_event'])) { $datos['status_event']=1; } else { $datos['status_event']=0; }

			unset($datos['attachment_event_sec']);

			if ($datos['id_event']=="") {

				$datos['token_event'] = $this->generateRandomString(50);
				unset($datos['id_event']);
				//Insertamos el evento
				$this->model_admin->create_event($datos);
			} else {
				//Insertamos el evento
				$this->model_admin->update_event($datos);
			}
		}

		echo json_encode($data);
	}

	public function Event_Assistance($token_event) {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			$data['events']              = $this->model_admin->events($token_event);
			$data['assistance_active']   = $this->model_admin->events_assistance('active', $token_event);
			$data['assistance_inactive'] = $this->model_admin->events_assistance('inactive', $token_event);
			$data['assistance']          = $this->model_admin->events_assistance('', $token_event);

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_event_assistance');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function Ads($place="", $token="") {
		
		//Recibe la validación de sesión y genera la vista dependiendo el resultado | Variable $data creada en el constructor
		$data = $this->data;
		if ($data['result_validate'] == 'no_session_create') {  

			$this->load->view('admin/view_login');

		} else if ($data['result_validate'] == 'session_create') {

			if ($place=="Handling_Ads") {
				if ($token!="") {
					$token = htmlspecialchars(htmlentities($token));
					$data['edit_ads'] = $this->model_admin->ads("token", $token);
				}
			} else if ($place=="Settings") {
				$data['ads_settings'] = $this->model_admin->ads_settings();
			}

			$data['ads'] = $this->model_admin->ads();

			$this->load->view('admin/view_includes/view_header', $data);
			$this->load->view('admin/session_started/view_nav');
			$this->load->view('admin/session_started/view_aside');
			$this->load->view('admin/session_started/view_ads');
			$this->load->view('admin/view_includes/view_footer');
		}
	}

	public function Handling_Ads() {

		$datos=$this->model_home->postToValor($_POST);
		$place = "";

		$data['result']='OK';
		$data['errorTexto']="";
		
		if ($datos['name_ads'] == "") {
			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Nombre del anuncio es obligatorio.</p>";
		}
		
		if ($datos['priority_ads'] == "") {
			$data['result']='KO';
			$data['errorTexto'].="<p class='m-0'>El campo Prioridad del anuncio es obligatorio.</p>";
		}
		
		if ($_FILES['banner_ads']['name'] == "") {
			if ($datos['banner_ads_sec'] == "") {
				$data['result']='KO';
				$data['errorTexto'].="<p class='m-0'>El campo Banner del anuncio es obligatorio.</p>";
			} else {
				$datos['banner_ads'] = $datos['banner_ads_sec'];
			}
		}

		if ($data['result']=="OK") {

			if ($_FILES['banner_ads']['name']!="") {

				//Creamos la ruta donde se guardará la imagen
				$path_profile = './img/ads';

				//Validamos si la ruta existe, sino la creamos
				if (!file_exists($path_profile)) {
					mkdir($path_profile, 0777, true);
				}

				//Tomamos el name del input del form
				$input_image = 'banner_ads';

				//Creamos la configuración de la subida de la imagen
				$config['upload_path']   = $path_profile;
				$config['file_name']     = "banner_ad_".rand()."_".time();
				$config['allowed_types'] = "jpg|jpeg|png";

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload($input_image)) {

					$data   = array('upload_data' => $this->upload->data());

					//Agregamos el nombre de la imagen
					$datos['banner_ads'] = $data['upload_data']['file_name'];

					//Devilvemos un OK
					$data['result']='OK';
					$data['errorTexto']="";

				} else {

					$data['result']='KO';
					$data['errorTexto'].="<p>".$this->upload->display_errors()."</p>";
				}
			}

			//Si el token no existe entonces lo crea
			if ($datos['token_ads']=="") { $datos['token_ads']  = $this->generateRandomString(20); $place = "create"; }

			if (isset($datos['status_ads'])) { $datos['status_ads'] = 1; } else { $datos['status_ads'] = 0; }

			unset($datos['banner_ads_sec']);

			$this->model_admin->create_update_ads($datos, $place);
		}

		echo json_encode($data);
	}

	public function Delete_ads() {
		
		$datos=$this->model_home->postToValor($_POST);

		//Buscamos la imagen a borrar con el id que se envió por POST
		$delete_image = $this->model_admin->ads("id", $datos['id_ads']);

		//Eliminamos la imagen
		unlink("./img/ads/".$delete_image[0]['banner_ads']);

		//Eliminamos el anuncio de la base de datos
		$this->model_admin->delete_ads($datos['id_ads']);
	}


	public function Ads_settings() {

		$datos=$this->model_home->postToValor($_POST);

		$this->model_admin->update_ads_settings($datos);

		redirect(base_url("Admin/Ads/Settings"), "location");
	}

	public function update_status() {

		$datos=$this->model_home->postToValor($_POST);
		$this->model_admin->update_status($datos);
	}
	
	public function update_subs() {
		$datos=$this->model_home->postToValor($_POST);
		$this->model_admin->update_subs($datos);
	}

	public function delete_data() {

		$datos=$this->model_home->postToValor($_POST);

		if ($datos['path_image']!='') {

			$delete_img = $this->model_admin->get_data($datos);
			unlink('img/'.$datos['path_image'].'/'.$delete_img[0][$datos['col_img']]);
		}

		$this->model_admin->delete_data($datos);
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
	
		public function Recovery() {
		$datos = $this->model_home->postToValor($_POST);
		$arr = array_keys($datos);
		$str = $arr[0];
		$find = '_';
		$replace = '.';
		$result = preg_replace(strrev("/$find/"),strrev($replace),strrev($str),1);
		$email = strrev($result);
		$this->model_admin->recovery($email);
	}

	public function NewPass() {
		$datos = $this->model_home->postToValor($_POST);
		$pass = $datos['new_pass'];
		$password_encypt = password_hash($pass, PASSWORD_DEFAULT);  
		$this->model_admin->newPass($datos['id_user'], $password_encypt);
	}
}