<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('model_home');
		$this->load->model('model_message');
	}


	//Aqui consulta la ruta, si esta creado por el user o el visitor o si no esta creado, lo crea.
	public function returns_route($id_user_emisor, $id_user_receptor, $filename) {

		$count_chat_emisor = count(glob("system/messages/".$id_user_emisor."_".$id_user_receptor."/{".$filename."}",GLOB_BRACE));
		$count_chat_receptor = count(glob("system/messages/".$id_user_receptor."_".$id_user_emisor."/{".$filename."}",GLOB_BRACE));
		$path_chat = "";

		if ($count_chat_emisor != 0) {
			$path_chat = "system/messages/".$id_user_emisor."_".$id_user_receptor."/";
		} else if ($count_chat_receptor != 0) {
			$path_chat = "system/messages/".$id_user_receptor."_".$id_user_emisor."/";
		} else {
			$path_chat = "system/messages/".$id_user_emisor."_".$id_user_receptor."/";
		}

		return $path_chat;
	}

	public function send_message($token_user="") {

		$txt_message = $this->input->post("txt_message");
		$dateSend = date("Y-m-d H:i:s");
		$token_explode = explode("IuM", $token_user);		

		$token_profile       = $this->model_home->getDataUserxToken($token_explode[1]);
		$id_user_emisor      = $token_explode[0];
		$id_user_receptor    = $token_profile[0]['id_user'];

		$path_message = $this->returns_route($id_user_emisor, $id_user_receptor, "handling_message.txt");
		//Crea la carpeta del chat si no existe.
		if (!file_exists($path_message)) {
			mkdir($path_message, 0777, true);
		}

		//Crea el archivo del chat si no existe y sobreescribe en el.
		$chat = fopen($path_message."handling_message.txt", "a") or die("Internal error, contact the administrator.");	
		fwrite($chat, $id_user_emisor."||_||".$dateSend."||_||".$txt_message."||||_|_||||");
		fclose($chat);

		$num_message = count($this->call_message($token_user, 'handling_message.txt'));
		$num_message_count_user    = count($this->call_message($token_user, 'handling_message_count_user_'.$id_user_emisor.'.txt'));
		$num_message_count_visitor = count($this->call_message($token_user, 'handling_message_count_user_'.$id_user_receptor.'.txt'));

		if ($num_message_count_user == 0 && $num_message_count_visitor == 0) {
			$num_send_chat_user = fopen($path_message."handling_message_count_user_".$id_user_emisor.".txt", "a") or die("Internal error, contact the administrator.");	
			fwrite($num_send_chat_user, $num_message . "||||_|_||||");
			fclose($num_send_chat_user);

			$num_send_chat_visitor = fopen($path_message."handling_message_count_user_".$id_user_receptor.".txt", "a") or die("Internal error, contact the administrator.");	
			fwrite($num_send_chat_visitor, $num_message . "||||_|_||||");
			fclose($num_send_chat_visitor);
		}
		echo "Enviado";

		//Aqui cargamos la view del nuevo mensaje a la BD
		$save_my_message = $this->model_home->save_visitor_myinterested_favorites($id_user_receptor, $id_user_emisor, 'view_mymessages');
	}

	public function recive_message($token_user="") {

		$token_explode = explode("IuM", $token_user);	
		$path_chat = "";	

		$token_profile       = $this->model_home->getDataUserxToken($token_explode[1]);
		$id_user_emisor      = $token_explode[0];
		$id_user_receptor    = $token_profile[0]['id_user'];

		$contenido_explode = $this->call_message($token_user, 'handling_message.txt');
		echo "<br>";
		if ($contenido_explode != "") {
			for ($i=0; $i < count($contenido_explode); $i++) { 
				$chat_explode = explode("||_||", $contenido_explode[$i]);
				$date = date_create($chat_explode[1]);
				$date_format = date_format($date, 'F d, Y, H:i A');

				$img_user = $this->model_home->getDataProfilexId($chat_explode[0]);

				if ($chat_explode[0] == $id_user_emisor) { 
					echo "<table class='w-100'>
					<tr>
					<td colspan='2'>
					<p class='text-right text-center div-date'>" .$date_format."</p>
					</td>
					</tr>
					<tr>
					<td class='w-80'>
					<p class='text-left div-my-messages'>";
					$x = $chat_explode[2];

					$plan_active = $this->model_home->validate_plan($id_user_emisor);

					if ($plan_active != "active") {

						$x = preg_replace('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i','[email removed]',$x);
						$x = preg_replace('/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/','[phone removed]',$x);
					}
					echo $x;
					echo "</p>
					</td>
					<td class='w-20 text-right'>";

					$url_img="";

					if ($img_user[0]['photo_profile_user']=="no-upload-image") {
						$url_img = base_url("img/profile/no-upload-image.png");
					} else {
						$url_img = base_url("img/profile/profile/".$id_user_emisor."/".$img_user[0]['photo_profile_user']);
					}

					echo "<img class='img-chat' src='".$url_img."' alt='Image User | Mylatindate.com'>
					</td>
					</tr>
					</table>";
				} else {
					echo "<table class='w-100'>
					<tr>
					<td colspan='2'>
					<p class='text-right text-center div-date'>" .$date_format."</p>
					</td>
					</tr>
					<tr>
					<td class='w-20'>";

					$url_img="";

					if ($img_user[0]['photo_profile_user']=="no-upload-image") {
						$url_img = base_url("img/profile/no-upload-image.png");
					} else {
						$url_img = base_url("img/profile/profile/".$id_user_receptor."/".$img_user[0]['photo_profile_user']);
					}

					echo "<img class='img-chat' src='".$url_img."' alt='Image User | Mylatindate.com'>
					</td>
					<td class='w-80'>
					<p class='text-right div-you-messages'>"; 
					$x = $chat_explode[2];

					$plan_active = $this->model_home->validate_plan($id_user_emisor);

					if ($plan_active != "active") {

						$x = preg_replace('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i','[email removed]',$x);
						$x = preg_replace('/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/','[phone removed]',$x);
					}
					echo $x;
					echo "</p>
					</td>
					</tr>
					</table>";
				}
			}
		}
		echo "<p id='last'></p>";
		
	}

	function call_message($token_user="", $filename){

		$token_explode = explode("IuM", $token_user);	
		$path_chat = "";	

		$token_profile       = $this->model_home->getDataUserxToken($token_explode[1]);
		$id_user_emisor      = $token_explode[0];
		$id_user_receptor    = $token_profile[0]['id_user'];

		$count_chat_emisor = count(glob("system/messages/".$id_user_emisor."_".$id_user_receptor."/{".$filename."}",GLOB_BRACE));
		$count_chat_receptor = count(glob("system/messages/".$id_user_receptor."_".$id_user_emisor."/{".$filename."}",GLOB_BRACE));

		if ($count_chat_emisor != 0) {
			$path_chat = "system/messages/".$id_user_emisor."_".$id_user_receptor."/";
		} else if ($count_chat_receptor != 0) {
			$path_chat = "system/messages/".$id_user_receptor."_".$id_user_emisor."/";
		}

		if ($count_chat_emisor != 0 or $count_chat_receptor != 0) {
			$chat = fopen($path_chat."/".$filename, "r") or die("Internal error, contact the administrator.");	
			$contenido = fread($chat, filesize($path_chat."/".$filename));
			fclose($chat);
			$delete_last = trim($contenido, "||||_|_||||");
			$contenido_explode = explode("||||_|_||||", $delete_last);
			return $contenido_explode;
		}
	}

	public function validate_message($token_user="") {
		
		$token_explode = explode("IuM", $token_user);		

		$token_profile      = $this->model_home->getDataUserxToken($token_explode[1]);
		$id_user_emisor     = $token_explode[0];
		$id_user_receptor   = $token_profile[0]['id_user'];
		$path_chat_filename = $this->returns_route($id_user_emisor, $id_user_receptor, "handling_message_count_user_".$id_user_emisor.".txt");

		$num_message                = count($this->call_message($token_user, 'handling_message.txt'));
		$num_message_count          = count($this->call_message($token_user, 'handling_message_count_user_'.$id_user_emisor.'.txt'));
		$new_num_message            = $num_message + 1;

		if ($num_message != 0) {
			if ($num_message == $num_message_count) {
				$num_send_chat = fopen($path_chat_filename."handling_message_count_user_".$id_user_emisor.".txt", "a") or die("Internal error, contact the administrator.");
				fwrite($num_send_chat, $new_num_message . "||||_|_||||");
				fclose($num_send_chat);
				echo "new_message_02041996";
			}
		}
	}
}