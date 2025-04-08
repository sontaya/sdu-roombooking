<?php

	function get_staff_byroom($room_target){

		$CI = get_instance();
		$CI->load->model('User_model');

		$conditions = array(
			'role'=> 'delegate_admin',
		);
		$user_lists = $CI->User_model->list_admin(array('conditions'=> $conditions));

		$staffs = array();
		foreach ($user_lists as $user) {

			if(in_array($room_target, json_decode($user['control_room_grant'], true))){

				$obj = array(
					'user_id' => $user['user_id'],
					'user_fullname' => $user['name']." ".$user['surname'],
					'mobile' => $user['mobile_phone_default'],
					'control_room' =>  json_decode($user['control_room_grant'], true)
				);
				array_push($staffs, $obj);

			}
		}


		// header('Content-Type: application/json');
		// echo json_encode($staffs);
		return $staffs;

	}

	function get_room_grant($user_id){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('User_model');


		$conditions = array(
			'user_id'=> $user_id,
		);
		$rooms = $CI->User_model->list_room_grant(array('conditions'=>  $conditions));


		return $rooms;

	}



    function get_room_bytype($roomtype){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Room_model');

		$conditions = array(
			'room_type'=>$roomtype,
			'active_in'=> array('Y','C')

		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->Room_model->list(array('conditions'=>  $conditions));

		return $rooms;

	}

    function get_room_all(){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Room_model');

		$conditions = array(
			'active'=> 'Y'
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->Room_model->list(array('conditions'=>  $conditions));

		return $rooms;

    }

    function get_dproom_all(){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('DPRoom_model');

		$conditions = array(
			'active'=> 'Y'
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->DPRoom_model->list(array('conditions'=>  $conditions));

		return $rooms;

    }

    function get_hbroom_all(){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Hybridroom_model');

		$conditions = array(
			'active_in' => array('Y','C')
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->Hybridroom_model->list(array('conditions'=>  $conditions));

		return $rooms;

    }

    function get_hbroom_active(){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Hybridroom_model');

		$conditions = array(
			'active_in' => array('Y')
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->Hybridroom_model->list(array('conditions'=>  $conditions));

		return $rooms;

    }

	function get_mtroom_all(){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Mtroom_model');

		$conditions = array(
			'active_in' => array('Y','C')
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->Mtroom_model->list(array('conditions'=>  $conditions));

		return $rooms;

    }

	function get_mtroom_active(){

		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Mtroom_model');

		$conditions = array(
			'active_in' => array('Y')
		);
		// $data['rooms'] = $this->db->get('room_master')->result_array();
		$rooms = $CI->Mtroom_model->list(array('conditions'=>  $conditions));

		return $rooms;

    }

