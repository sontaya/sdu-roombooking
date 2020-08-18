<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

	function __construct()
	{

		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->load->model('User_model');
		$this->load->model('Api_model');
	}

	public function login()
	{

	 	$this->load->view('user/login');
	}

	public function do_login()
	{
		$username = $this->input->post('username');
		$passwd = $this->input->post('passwd');
		$response = $this->Api_model->login($username,$passwd);

		header('Content-Type: application/json');
		echo json_encode($response);

	}


	public function do_login_session()
	{
		$client_ip = get_client_ip();
		$timestamp = date('Y-m-d H:i:s');

		$uid = $this->input->post("uid");
		$user_id = $this->input->post("user_id");
		$citizencode = $this->input->post("citizencode");
		$name = $this->input->post("name");
		$surname = $this->input->post("surname");
		$staff_type = $this->input->post("staff_type");
		$staff_type_name = $this->input->post("staff_type_name");
		$substaff_type = $this->input->post("substaff_type");
		$substaff_type_name = $this->input->post("substaff_type_name");
		$code_faculty = $this->input->post("code_faculty");
		$name_faculty = $this->input->post("name_faculty");
		$code_department = $this->input->post("code_department");
		$name_department = $this->input->post("name_department");
		$code_site = $this->input->post("code_site");
		$name_site = $this->input->post("name_site");
		$bio_pic_file = $this->input->post("bio_pic_file");

		//--Store local users
		$user = $this->User_model->list(array('conditions'=>array('user_id'=>$user_id)));
		if($user === false){
			$userdata = array(
				'user_id' => $user_id,
				'uid' => $uid,
				'citizencode' => $citizencode,
				'name' => $name,
				'surname' => $surname,
				'staff_type' => $staff_type,
				'staff_type_name' => $staff_type_name,
				'substaff_type' => $substaff_type,
				'substaff_type_name' => $substaff_type_name,
				'code_faculty' => $code_faculty,
				'name_faculty' => $name_faculty,
				'code_department' => $code_department,
				'name_department' => $name_department,
				'code_site' => $code_site,
				'name_site' => $name_site,
				'status' => '1',
				'lastlogin' => $timestamp,
				'lastip' => $client_ip
			);
			$this->User_model->save($userdata);


			//--Store session
			$sessiondata = array(
				'uid' => $uid,
				'hrcode' => $user_id,
				'citizencode' => $citizencode,
				'displayname' => $name." ".$surname,
				'name' => $name,
				'surname' => $surname,
				'name_faculty' => $name_faculty,
				'bio_pic_file' => $bio_pic_file,
				'role' => null,
				'manage_room' => null
			);
		}else{
			$userdata = array(
				'lastlogin' => $timestamp,
				'lastip' => $client_ip
			);
			$this->User_model->update($user_id,$userdata);


			//--Store session
			$sessiondata = array(
				'uid' => $uid,
				'hrcode' => $user_id,
				'citizencode' => $citizencode,
				'displayname' => $name." ".$surname,
				'name' => $name,
				'surname' => $surname,
				'name_faculty' => $name_faculty,
				'bio_pic_file' => $bio_pic_file,
				'role' => $user[0]["role"],
				'manage_room' => json_decode($user[0]["control_room_grant"], true)
			);
		}

		$this->session->set_userdata('auth',$sessiondata);


		header('Content-Type: application/json');
		echo json_encode($sessiondata);

	}

	public function check_local_user()
	{

		$uid = $this->input->post("uid");
		$user_id = $this->input->post("user_id");
		$citizencode = $this->input->post("citizencode");
		$name = $this->input->post("name");
		$surname = $this->input->post("surname");
		$staff_type = $this->input->post("staff_type");
		$staff_type_name = $this->input->post("staff_type_name");
		$substaff_type = $this->input->post("substaff_type");
		$substaff_type_name = $this->input->post("substaff_type_name");
		$code_faculty = $this->input->post("code_faculty");
		$name_faculty = $this->input->post("name_faculty");
		$code_department = $this->input->post("code_department");
		$name_department = $this->input->post("name_department");
		$code_site = $this->input->post("code_site");
		$name_site = $this->input->post("name_site");


		//--Store local users
		$user = $this->User_model->list(array('conditions'=>array('user_id'=>$user_id)));
		if($user === false){
			$userdata = array(
				'user_id' => $user_id,
				'uid' => $uid,
				'citizencode' => $citizencode,
				'name' => $name,
				'surname' => $surname,
				'staff_type' => $staff_type,
				'staff_type_name' => $staff_type_name,
				'substaff_type' => $substaff_type,
				'substaff_type_name' => $substaff_type_name,
				'code_faculty' => $code_faculty,
				'name_faculty' => $name_faculty,
				'code_department' => $code_department,
				'name_department' => $name_department,
				'code_site' => $code_site,
				'name_site' => $name_site,
				'status' => '1',
			);
			$this->User_model->save($userdata);

		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user/login');
	}



}
