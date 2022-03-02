<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_config extends CI_Model
{

	//Convierte los datos que llegan en $_POST en un array llamado $data
	public function postToValor($post) {
		foreach($post as $nombre_campo => $valor){	
			$asignacion = "\$data['" . $nombre_campo . "']= ('" . htmlspecialchars(htmlentities($valor)) . "');";
			eval($asignacion);
		}
		return $data;
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
}
?>
