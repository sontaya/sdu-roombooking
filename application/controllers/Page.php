<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Booking_model');
		$this->load->model('Room_model');

        if(! $this->session->userdata('auth')['uid'])
        {
          $allowed = array('view_json');
          if(! in_array($this->router->fetch_method(), $allowed))
          {
            redirect('backoffice');
          }
        }

	}

	function home(){
		$this->set_active_menu('100');

		$data['title'] = "Home";
		$this->data = $data;
		$this->content = 'home/index';
		$this->render();
	}


	function room_info(){

		$this->set_active_menu('200');

		$data['title'] = "Room info";
		$this->data = $data;
		$this->content = 'room/index';
		$this->render();
	}


	function contact_staff(){

		$this->set_active_menu('400');

		$data['title'] = "ติดต่อเจ้าหน้าที่";
		$this->data = $data;
		$this->content = 'backoffice/contact_staff';
		$this->render();
	}







}
