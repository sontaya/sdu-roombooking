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
		$this->content = 'home/index-ol';
		$this->render();
	}

	function landing(){
		// $this->set_active_menu('100');
		$data['title'] = "Landing";

		$data['ol_summary'] = $this->db->query("SELECT COUNT(*) AS count_all
															,COUNT(CASE WHEN booking_status = 'approved' THEN 1 END) AS count_approved
															,COUNT(CASE WHEN booking_status = 'pending' THEN 1 END) AS count_pending
															,COUNT(CASE WHEN booking_status = 'rejected' THEN 1 END) AS count_rejected
														FROM rb_booking_info
														WHERE user_id = '". $this->global_data['user_id'] ."'
							")->result();

		$data['dp_summary'] = $this->db->query("SELECT COUNT(*) AS count_all
															,COUNT(CASE WHEN booking_status = 'approved' THEN 1 END) AS count_approved
															,COUNT(CASE WHEN booking_status = 'pending' THEN 1 END) AS count_pending
															,COUNT(CASE WHEN booking_status = 'rejected' THEN 1 END) AS count_rejected
														FROM dp_booking_info
														WHERE user_id = '". $this->global_data['user_id'] ."'
							")->result();

		$this->data = $data;
		$this->content = 'home/landing';
		$this->render_nomenu();
	}

	function set_active_template($template){
		//--Store session
		$session_template = array(
			'template' => $template
		);
		$this->session->set_userdata('template',$session_template);

		if($template == "OL"){
			redirect('booking/list');
		}

		if($template == "DP"){
			redirect('dp/list');
		}

		// echo $template;

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
