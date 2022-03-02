<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_email extends CI_Model
{

	public function email_management($email_send, $template, $data_mail="", $extra1="") {

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
		$mail->AddAddress($email_send);
		$mail->IsHTML(true);
		$mail->Subject = utf8_decode($data_mail['subject']);
		$body = $this->load->view('view_includes/email/'.$template, $data_mail, true);
		$mail->Body = $body;
		$mail->AltBody = utf8_decode($data_mail['subject']);

		if ($data_mail['event'][0]['attachment_event']!="") {
			$mail->AddAttachment('img/events/'.$data_mail['event'][0]['attachment_event']);
		}

		$exito = $mail->Send(); 
	}
}