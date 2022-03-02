<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Model_home extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function user_login($arr_user_login) {

		$queryVerify = $this->db->get_where('user', $arr_user_login);

		if ($queryVerify->num_rows() > 0) {
			return $queryVerify->result();
		} else {
			return false;
		}
	}
	

	public function user_register($arrayRegister) {

		$email_user = $arrayRegister['email_user'];
		$token_user = $arrayRegister['token_user'];

		$this->db->where('email_user', $email_user);
		$this->db->or_where('token_user', $token_user);
		$queryVerify = $this->db->get('user');

		if ($queryVerify->num_rows() > 0) {
			return 'exists_user';
		} else {
			$queryRegister = $this->db->insert('user', $arrayRegister);
			if ($queryRegister) {
				return 'ok_insert';
			} else {
				return false;
			}
		}
	}
	
	public function create_complaint($datos){
	    $this->db->insert('complaintspolicy', $datos);
	}
	
	public function getDataComplaintsPolicy() {

        $query = $this->db->query("SELECT name, email, url, complaint FROM complaintspolicy");

        $results = $query->result();



		//if ($queryVerify->num_rows() > 0) {
			//$envio=$queryVerify->result_array(); 
			//return $envio;
			return $results;
		//} else {
		//	return false;
		//}
	}

	public function create_token($arr_user_login) {

		$email_user = $arr_user_login['email_user'];
		$token_user = $arr_user_login['token_user'];

		$this->db->where('email_user', $email_user);
		$queryVerify = $this->db->get('user');

		if ($queryVerify->num_rows() > 0) {
			
			$this->db->set('token_user', $token_user);
			$this->db->where('email_user', $email_user);
			$this->db->update('user');
			return true;

		} else {
			return false;
		}		
	}

	public function change_status($arr_user_login, $status) {
		
		$email_user = $arr_user_login['email_user'];
		$logdate_user = date("Y-m-d H:i:s");

		$this->db->set('logactive_user', $status);
		if ($status == '1') {
			$this->db->set('logindate_user', $logdate_user);
		}else if ($status == '0') {
			$this->db->set('loguotdate_user', $logdate_user);
		}

		$this->db->where('email_user', $email_user);
		$this->db->update('user');
	}

	public function getDataUserAll() {

		$queryVerify = $this->db->get('user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function getDataProfileAll() {

		$queryVerify = $this->db->get('profile_user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function getDataUserxEmail($session_email_user) {

		$this->db->where('email_user', $session_email_user);
		$queryVerify = $this->db->get('user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function getDataProfilexEmail($session_email_user) {

		$this->db->where('email_user', $session_email_user);
		$queryVerify = $this->db->get('profile_user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function getDataUserxId($id_user) {

		$this->db->where('id_user', $id_user);
		$queryVerify = $this->db->get('user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function getDataProfilexId($id_user) {

		$this->db->where('id_user', $id_user);
		$queryVerify = $this->db->get('profile_user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function user_xid($id_user) {

		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		return $query->result_array();
	}

	public function profile_xid($id_user) {

		$this->db->where('id_user', $id_user);
		$query = $this->db->get('profile_user');
		return $query->result_array();
	}

	public function getDataSubscriptionxId($id_user) {

		$this->db->where('id_user', $id_user);
		$queryVerify = $this->db->get('subscription');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	//Con esta funcion obtenemos los datos de la persona cuando lo buscamos por token
	public function getDataUserxToken($token_user) {

		$this->db->where('token_user', $token_user);
		$queryVerify = $this->db->get('user');

		if ($queryVerify->num_rows() > 0) {
			$envio=$queryVerify->result_array(); 
			return $envio;
		} else {
			return false;
		}
	}

	public function updateImgUser($id_user_result, $name_photo, $colum_db) {
		$this->db->set($colum_db, $name_photo);
		$this->db->where('id_user', $id_user_result);
		$this->db->update('profile_user');
		return true;
	}
	
	public function deleteImgUser($img_name){
	    $this->db->set('photo_cover_user', null);
	    $this->db->set('photo_profile_user', null);
	    $this->db->where('photo_cover_user',$img_name);
	    $this->db->update('profile_user');
	}

	public function insertDataProfile($datos) {

		$queryInsert = $this->db->insert('profile_user', $datos);
		return $this->db->insert_id();
	}

	public function updateDataUser($col, $datos, $id_user) {

		$this->db->where('id_user', $id_user);
		$this->db->set($col, $datos);
		$queryUpdate = $this->db->update('user');
		if ($queryUpdate) {
			return true;
		} else {
			return false;
		}
	}

	public function updateDataProfile($datos, $id_user) {
		
		$this->db->where('id_user', $id_user);
		$queryUpdate = $this->db->update('profile_user', $datos);
		if ($queryUpdate) {
			return true;
		} else {
			return false;
		}
	}


	public function active_profile($email_user_result, $value)	{
		$this->db->set('profactive_user', $value);
		$this->db->where('email_user', $email_user_result);
		$this->db->update('user');
	}

	//Convierte los datos que llegan en $_POST en un array llamado $data
	public function postToValor($post){
		foreach($post as $nombre_campo => $valor){	
			$asignacion = "\$data['" . $nombre_campo . "']= ('" . htmlspecialchars(htmlentities($valor)) . "');";
			eval($asignacion);
		}
		return $data;
	}
	
	#Esta funcion obtiene los paises | Esta siendo usada para el registro de usuario
	public function getDatacountry($location=""){
		
		if ($location!="") {
			$this->db->where('location', $location);
		}

		$queryPaises = $this->db->get('place_country');
		if ($queryPaises->num_rows() > 0) {
			return $queryPaises;
		}
		else
		{
			return false;
		}
	}

	#Esta funcion obtiene los estados o provincias | Esta siendo usada para el registro de usuario
	public function getDataState($country_id){
		
		$arr_id = array('country_id' => $country_id);
		$queryCiudades = $this->db->get_where('place_state', $arr_id);

		if ($queryCiudades->num_rows() > 0) {
			return $queryCiudades->result();
		}
		else
		{
			return false;
		}
	}

	#Esta funcion obtiene los city | Esta siendo usada para el registro de usuario
	public function getDataCity($state_id){
		
		$arr_id = array('state_id' => $state_id);
		$queryCiudades = $this->db->get_where('place_city', $arr_id);

		if ($queryCiudades->num_rows() > 0) {
			return $queryCiudades->result();
		}
		else
		{
			return false;
		}
	}


	public function save_visitor_myinterested_favorites($id_user, $id_visitor, $place) {

		$arr_user_visitor = array('id_user' => $id_user, 'id_visitor' => $id_visitor, 'place_view' => $place);
		$arr_user_visitor_active = array('id_user' => $id_user, 'id_visitor' => $id_visitor, 'active_view' => '1', 'place_view' => $place);
		
		$queryFecVisitor  = $this->db->get_where('view_interaction', $arr_user_visitor);

		if ($queryFecVisitor->num_rows() > 0) {
			
			if($place == "view_mymessages"){
				$this->db->delete('view_interaction', $arr_user_visitor);
				$this->db->insert('view_interaction', $arr_user_visitor_active);
			}


			if ($place == "view_myprofile") {

				$resultFecVisitor = $queryFecVisitor->result_array(); 
				$date_start       = strtotime($resultFecVisitor[0]['fecha_view']);
				$date_end         = strtotime(date("Y-m-d H:i:s"));
				$segundos         = $date_end-$date_start;
				$horas            = $segundos/60/60;
				$horasRound       = round($horas);

				if($horasRound > 23){
					$this->db->delete('view_interaction', $arr_user_visitor);
					$this->db->insert('view_interaction', $arr_user_visitor_active);
				}
			}
		} else {

			$this->db->insert('view_interaction', $arr_user_visitor_active);
		}
	}

	public function active_false_visitors($id_user, $place)	{
		
		$this->db->set('active_view', '0');
		$this->db->where('id_user', $id_user);
		$this->db->where('place_view', $place);
		$this->db->update('view_interaction');
	}


	public function query_visitor_myinterested_favorites($id_user, $get_id_user, $place) {
		$arr_user_visitor = array('id_visitor' => $id_user, 'id_user' => $get_id_user, 'place_view' => $place);
		$query_visitor_myinterested_favorites = $this->db->get_where('view_interaction', $arr_user_visitor);

		if ($query_visitor_myinterested_favorites->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}


	public function delete_visitor_myinterested_favorites($id_user, $get_id_user, $place) {
		$arr_user_visitor = array('id_user' => $id_user, 'id_visitor' => $get_id_user, 'place_view' => $place);
		$this->db->delete('view_interaction', $arr_user_visitor);
	}

	public function getCountRowsTable($table) {

		$queryCount = $this->db->get($table);

		if ($queryCount->num_rows() > 0) {

			return $queryCount->result_array();
		}else{

			return 0;
		}
	}

	public function getCountData($id_user, $place, $active, $tipo="")	{

		$column="";
		if ($tipo=="Received") {
			$column="id_user";
		} else if ($tipo=="Send") {
			$column="id_visitor";
		} else {
			$column="id_user";
		}

		if ($active == "yes") {
			$arr_active = array($column => $id_user, 'active_view' => '1', 'place_view' => $place);
		}else if ($active == "no") {
			$arr_active = array($column => $id_user, 'place_view' => $place);
		}
		$queryCount = $this->db->get_where('view_interaction', $arr_active);

		if ($queryCount->num_rows() > 0) {

			return $queryCount->result_array();
		}else{

			return 0;
		}
	}

	public function getCountDataVisitor($id_user, $place, $active)	{

		if ($active == "yes") {
			$arr_active = array('id_visitor' => $id_user, 'active_view' => '1', 'place_view' => $place);
		}else if ($active == "no") {
			$arr_active = array('id_visitor' => $id_user, 'place_view' => $place);
		}
		$queryCount = $this->db->get_where('view_interaction', $arr_active);

		if ($queryCount->num_rows() > 0) {

			return $queryCount->result_array();
		}else{

			return 0;
		}
	}

	public function change_email($email, $id_user) {
		$this->db->set('email_user', $email);
		$this->db->where('id_user', $id_user);
		$updateEmailUser = $this->db->update('user');

		if ($updateEmailUser) {

			$this->db->set('email_user', $email);
			$this->db->where('id_user', $id_user);
			$updateEmailProf = $this->db->update('profile_user');

			if ($updateEmailProf) {
				return true;
			} else {
				return false;
			}
		} else { 
			return false;
		}
	}

	public function change_pass($pass, $id_user) {

		$this->db->set('password_user', $pass);
		$this->db->where('id_user', $id_user);
		$updatePassUser = $this->db->update('user');
		return true;
	}

	public function searching_users($datos) {
		
		$this->db->select('u.*, p.*');
		$this->db->from('user u');
		$this->db->join('profile_user p', 'u.id_user = p.id_user');

		if ($datos['txt_seeking'] != "") {
			$this->db->where('gender_user', $datos['txt_seeking']);
		}

		$this->db->where("p.age BETWEEN '{$datos['txt_agefrom']}' AND '{$datos['txt_ageto']}'");
		
		if ($datos['country_residence'] != "") {
			$this->db->where('p.country_residence', $datos['country_residence']);
		}

		if (isset($datos['state_residence']) && $datos['state_residence'] != "") {
			$this->db->where('p.state_residence', $datos['state_residence']);
		}
		
		if (isset($datos['city_residence']) && $datos['city_residence'] != "") {
			$this->db->where('p.city_residence', $datos['city_residence']);
		}

		if (isset($datos['penpal']) && $datos['penpal'] != "") {
			$this->db->where('p.penpal', $datos['penpal']);
		}
		
		if (isset($datos['friendship']) && $datos['friendship'] != "") {
			$this->db->where('p.friendship', $datos['friendship']);
		}
		
		if (isset($datos['romance_dating']) && $datos['romance_dating'] != "") {
			$this->db->where('p.romance_dating', $datos['romance_dating']);
		}
		
		if (isset($datos['long_relationship']) && $datos['long_relationship'] != "") {
			$this->db->where('p.long_relationship', $datos['long_relationship']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDataPay($planName="") {
		
		if ($planName != "") {
			$this->db->where('plan_name', $planName);
		}
		$queryPay = $this->db->get('plan');

		if ($queryPay->num_rows() > 0) {
			return $queryPay->result_array();
		} else {
			return false;
		}
	}

	public function payment_verify($arr_plan_active) {
		
		$this->db->insert('subscription', $arr_plan_active);
		return true;
	}

	public function validate_plan($id_user, $place="") {

		$this->db->where('id_user', $id_user);
		$queryValActive = $this->db->get('subscription');

		if ($queryValActive->num_rows() > 0) {

			$date_end_bd  = $queryValActive->result_array()[0]['date_end'];
			$date_current = strtotime(date('Y-m-d 00:00:00'));
			$date_end     = strtotime($date_end_bd);

			if ($place == "data") {
				if($date_current < $date_end) {	return $queryValActive->result_array(); } else { return false; } 
			} else {
				if($date_current < $date_end) { return "active"; } else { return "no_active"; } 
			}
		} else {
			if ($place == "data") { return false; } else { return "no_active"; }
		}
	}


	public function insertCode($arrayCode) {

		$id_user = $arrayCode['id_user'];

		$this->db->where("id_user", $id_user);
		$validaInsert = $this->db->get("code_verify");

		if ($validaInsert->num_rows() > 0) {
			$this->db->where('id_user', $id_user);
			$this->db->update('code_verify', $arrayCode);	 	
		}else{
			$this->db->insert('code_verify', $arrayCode);
		}
	}

	public function verifyCode($arrayCode) {
		
		$validaCode = $this->db->get_where('code_verify', $arrayCode);

		if ($validaCode->num_rows() > 0) {
			return $validaCode->result();
		} else {
			return false;
		}
	}

	public function update_new_pass($id_user, $password_encypt)	{

		$this->db->set('password_user', $password_encypt);
		$this->db->where('id_user', $id_user);
		$this->db->update('user'); 
	}

	public function verify_status($id_user, $status) {
		
		$this->db->set('verify_account', $status);
		$this->db->where('id_user', $id_user);
		$this->db->update('user');
	}

	public function verify($id_user, $name) {
		
		$data_verify = array('id_user' => $id_user, 'status_verify' => 1, 'img_verify' => $name);
		$this->db->insert('verify', $data_verify);
		return $this->db->insert_id();
	}

	public function insert_report($datos) {
		
		$this->db->insert("claims", $datos);
	}

	public function ads() {

		$ads_settings  = $this->ads_settings();

		if ($ads_settings[0]['priority_settings'] == 3) {
			$this->db->order_by("priority_ads", "DESC");
		}

		if ($ads_settings[0]['priority_settings'] == 2) {
			$this->db->order_by("priority_ads", "RANDOM");
		}

		if ($ads_settings[0]['priority_settings'] == 1) {
			$this->db->order_by("id_ads", "ASC");
		}

		if ($ads_settings[0]['priority_settings'] == 0) {
			$this->db->order_by("priority_ads", "ASC");
		}

		$query = $this->db->get("ads");
		return $query->result_array();
	}

	public function ads_settings() {

		$query = $this->db->get("ads_settings");
		return $query->result_array();
	}

	public function get_message($id) {
		
		$this->db->where("id_count", $id);
		$query = $this->db->get("view_interaction");
		return $query->result_array();
	}

	public function del_message($id_message) {
		
		$this->db->where("id_count", $id_message);
		$this->db->delete("view_interaction");
	}

	public function get_events($id_user) {

		$datos['user']    = $this->user_xid($id_user);
		$datos['profile'] = $this->profile_xid($id_user);
		
		$this->db->where("addressedto_event", $datos['user'][0]['gender_user']);
		$this->db->or_where("addressedto_event", 3);

		$this->db->where("country_event", $datos['profile'][0]['country_residence']);
		$this->db->where("state_event", $datos['profile'][0]['state_residence']);
		$this->db->where("city_event", $datos['profile'][0]['city_residence']);
		
		$this->db->where("status_event", 1);
		$this->db->order_by("date_event", "DESC");
		$query = $this->db->get("events");
		return $query->result_array();
	}

	public function events_xtoken($token_event) {
		
		$this->db->where("token_event", $token_event);
		$query = $this->db->get("events");
		return $query->result_array();
	}

	public function event_assistance($datos) {
		
		$this->db->where('id_user', $datos['id_user']);
		$this->db->where('token_assistance', $datos['token_assistance']);
		$query = $this->db->get('events_assistance');

		if ($query->num_rows() > 0) {
			
			$this->db->set('status_assistance', $datos['status_assistance']);
			$this->db->where('id_user', $datos['id_user']);
			$this->db->where('token_assistance', $datos['token_assistance']);
			$this->db->update('events_assistance');

		} else {

			$this->db->insert('events_assistance', $datos);
		}
	}

	public function assitance($id_user, $token_assistance) {
		
		$this->db->where('id_user', $id_user);
		$this->db->where('token_assistance', $token_assistance);
		$query = $this->db->get('events_assistance');
		return $query->result_array();
	}
}