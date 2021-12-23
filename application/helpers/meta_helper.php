<?php

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

