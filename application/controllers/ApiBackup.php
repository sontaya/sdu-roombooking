<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller
{

	function __construct()
	{

		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->load->model('Subject_model');


        // if(! $this->session->userdata('auth')['uid'])
        // {
        //   $allowed = array();
        //   if(! in_array($this->router->fetch_method(), $allowed))
        //   {
        //     redirect('user/login');
        //   }
		// }

	}

	function get_subject(){

		// if($_POST){

			$conditions = array(
				'search_key' => $this->input->post('search_key')
			);
			$res = $this->Subject_model->list(array('conditions'=>$conditions));

			header('Content-Type: application/json');
			echo json_encode($res);
		// }


	}

	function get_subject_byid(){

		// if($_POST){

			$conditions = array(
				'subject_id' => $this->input->post('subject_id')
			);
			$res = $this->Subject_model->list(array('conditions'=>$conditions));

			header('Content-Type: application/json');
			echo json_encode($res);
		// }


	}

}
