<?php
class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
			        // Load language files
		$lang_files = array('site');
		$this->lang->load($lang_files,"Spanish");

		}
	}

	?>