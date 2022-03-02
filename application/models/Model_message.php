<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Model_message extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	public function getCountDataMessage($arr_ids) {

		$queryCount = $this->db->get_where('view_my_messages', $arr_ids);
		
		return $queryCount->result_array();
	}
}