<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model
{

	//Valida que el id y el token existan y coincidan entre si
	public function validate_token_session($datos) {

		$this->db->where('token_admin', $datos['token_admin']);
		$this->db->where('id_admin', $datos['id_admin']);
		
		$query = $this->db->get('administrator');
		return $query->result_array();
	}

	//Crea un token cuando cierra sesión o cuando inicia sesión
	public function create_token($datos) {

		$this->db->set('token_admin', $datos['token_admin']);
		$this->db->where('id_admin', $datos['id_admin']);
		$this->db->update('administrator');	
	}
	
	public function user_xemail($datos) {
		
		$this->db->where("email_admin", $datos['email']);
		$query = $this->db->get("administrator");
		return $query->result_array();
	}

	public function settings() {
		
		$query = $this->db->get('settings');
		return $query->result_array();
	}

	public function update_settings($datos)	{

		$this->db->update('settings', $datos);
	}

	public function count_users($where="", $extra1="") {

		if ($where=="Verify") {
			$this->db->where("verify_account", 2);
		}

		if ($where=="Online") {
			$this->db->where("logactive_user", 1);
		}

		if ($where=="Last" or $extra1=="Last") {
			$this->db->order_by("regdate_user", "DESC");
			$this->db->limit(10);
		}
		
		if ($where=="Woman") {
			$this->db->where("gender_user", 2);
		}
		
		if ($where=="Man") {
			$this->db->where("gender_user", 1);
		}
		
		if ($where=="YSubs") {
			$this->db->where("subs_user!=", 0);
		}
		
		if ($where=="NSubs") {
			$this->db->where("subs_user", 0);
		}

		$query = $this->db->get("user");
		return $query->result_array();
	}

	public function user_suscription($id) {
		
		$this->db->where('id_user', $id);
		$query = $this->db->get("subscription");
		return $query->result_array();
	}

	public function reports_users($token_or_place="") {
		
		$this->db->order_by("date_claims", "DESC");

		if ($token_or_place=="claims_active") {

			$this->db->where("status_claims", 1);

		} else if ($token_or_place!="") {

			$this->db->where("token_claims", $token_or_place);
			
		}

		$query = $this->db->get("claims");
		return $query->result_array();
	}

	public function verify_users($token_or_place="") {
		
		$this->db->order_by("date_verify", "DESC");

		if ($token_or_place=="verify_active") {

			$this->db->where("status_verify", 1);

		} else if ($token_or_place!="") {

			$this->db->where("id_verify", $token_or_place);
			
		}

		$query = $this->db->get("verify");
		return $query->result_array();
	}

	public function status_claims($token) {
		
		$this->db->set("status_claims", 0);
		$this->db->where("token_claims", $token);
		$this->db->update("claims");
	}

	public function status_verify($id_verify) {
		
		$this->db->set("status_verify", 0);
		$this->db->where("id_verify", $id_verify);
		$this->db->update("verify");
	}

	public function events($place="", $token="") {
		
		if ($place=="active") {	$this->db->where('status_event', 1); }
		if ($place=="inactive") { $this->db->where('status_event', 2); }
		if ($place=="token") { $this->db->where('token_event', $token); }

		$query = $this->db->get("events");
		return $query->result_array();
	}

	public function events_assistance($place="", $token_event="") {
		
		if ($place=="active") {	$this->db->where('status_assistance', 1); }
		if ($place=="inactive") { $this->db->where('status_assistance', 2); }
		$this->db->where('token_assistance', $token_event);

		$query = $this->db->get("events_assistance");
		return $query->result_array();
	}

	public function ads($place="", $id="") {
		
		if ($place=="id") {
			$this->db->where("id_ads", $id);
		}
		if ($place=="token") {
			$this->db->where("token_ads", $id);
		}

		$query = $this->db->get("ads");
		return $query->result_array();
	}

	public function create_update_ads($data, $place="") {
		
		if ($place=="create") {

			$this->db->insert('ads', $data);
		} else {

			$this->db->where("token_ads", $data['token_ads']);
			$this->db->update("ads", $data);
		}
	}

	public function delete_ads($id) {
		
		$this->db->where("id_ads", $id);
		$this->db->delete("ads");
	}

	public function ads_settings() {

		$query = $this->db->get("ads_settings");
		return $query->result_array();
	}

	public function update_ads_settings($datos) {
		
		$this->db->where("id_settings", 1);
		$this->db->update("ads_settings", $datos);
	}	

	public function create_event($datos) {
		
		$this->db->insert('events', $datos);
	}

	public function user_xid($id_user) {

		$this->db->where("id_user", $id_user);
		$query = $this->db->get("user");
		return $query->result_array();
	}

	public function update_event($datos) {
		
		$this->db->where('id_event', $datos['id_event']);
		$this->db->update('events', $datos);
	}

	public function delete_data($datos) {
		
		$this->db->where($datos['col_where'], $datos['col_valor']);
		$this->db->delete($datos['table']);
	}

	public function update_status($datos) {
		
		$this->db->set($datos['col_update'], $datos['status']);
		$this->db->where($datos['col_where'], $datos['col_valor']);
		$this->db->update($datos['table']);
	}
    
    public function update_subs($datos) {
		$this->db->set($datos['col_update'], $datos['status']);
		$this->db->where($datos['col_where'], $datos['col_valor']);
		$this->db->update($datos['table']);
	}
	
	public function get_data($datos) {
		
		$this->db->where($datos['col_where'], $datos['col_valor']);
		$query = $this->db->get($datos['table']);
		return $query->result_array();
	}
	
    public function recovery($email) {

		$this->db->where('email_admin', $email);
		$query = $this->db->get('administrator');
		$data = $query->result_array();
		if (count($data) > 0) {
			$cod_ver = mt_rand();
			$data['cod_ver'] = $cod_ver;
			
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
			$mail->Subject = "Coóigo de verificación | Mylatindate";
			$body = $this->load->view('view_includes/templateEmail', 'datamail', true);
			$mail->Body = 'Su código de verificación es: '.$cod_ver;
			$mail->AltBody = "Nuevo código de verificación recibido."; 
			$exito = $mail->Send();

			echo json_encode($data);
			
		}else{
			echo json_encode('noval');
		}
	}

	public function newPass($id, $pass) {
		$this->db->set('password_admin', $pass);
		$this->db->where('id_admin', $id);
		if ($this->db->update('administrator')) {
			echo 'val';
		} else {
			echo 'noval';
		}
	}
}