<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

        // if(! $this->session->userdata('auth')['uid'])
        // {
        //   $allowed = array('login','meeting_documents');
        //   if(! in_array($this->router->fetch_method(), $allowed))
        //   {
        //     redirect('auth/index');
        //   }
        // }


	}


	function index(){
		$data['title'] = "Room Booking";

		$this->data = $data;
		$this->content = 'booking/index';
		$this->render();
	}







}
