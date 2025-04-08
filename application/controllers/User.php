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
		$academic_fullname = $this->input->post("academic_fullname");
		$employee_type = $this->input->post("employee_type");
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
				'academic_fullname' => $academic_fullname,
				'employee_type' => $employee_type,
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
				// 'line_id' => null,
				'citizencode' => $citizencode,
				'displayname' => $name." ".$surname,
				'name' => $name,
				'surname' => $surname,
				'academic_fullname' => $academic_fullname,
				'code_faculty' => $code_faculty,
				'name_faculty' => $name_faculty,
				'employee_type' => $employee_type,
				'bio_pic_file' => $bio_pic_file,
				'role' => null,
				'manage_app' => null,
				'manage_room' => null
			);
		}else{
			$userdata = array(
				'name' => $name,
				'surname' => $surname,
				'academic_fullname' => $academic_fullname,
				'employee_type' => $employee_type,
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
				'lastlogin' => $timestamp,
				'lastip' => $client_ip
			);
			$this->User_model->update($user_id,$userdata);


			//--Store session
			$sessiondata = array(
				'uid' => $uid,
				'hrcode' => $user_id,
				// 'line_id' => $user[0]["line_id"],
				'citizencode' => $citizencode,
				'displayname' => $name." ".$surname,
				'name' => $name,
				'surname' => $surname,
				'academic_fullname' => $academic_fullname,
				'code_faculty' => $code_faculty,
				'name_faculty' => $name_faculty,
				'employee_type' => $employee_type,
				'bio_pic_file' => $bio_pic_file,
				'role' => $user[0]["role"],
				'staff_arit' => $user[0]["staff_arit_grant"],
				'manage_app' => json_decode($user[0]["control_app_grant"], true),
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
		$academic_fullname = $this->input->post("academic_fullname");
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
				'academic_fullname' => $academic_fullname,
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


	public function profile()
	{
		$data['title'] = "ข้อมูลช่องทางสำหรับติดต่อ";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			'assets/js/user-profile.js'
		);

		$data['profile'] = $this->User_model->list(array('conditions'=>  array('user_id' => $this->global_data['user_id']) ))[0];

		$this->data = $data;
		$this->content = 'user/profile';
		$this->render_nomenu();
	}


	public function profile_store()
	{

		$user_id = $this->global_data['user_id'];
		$email_default = $this->input->post("email_default");
		$mobile_phone_default = $this->input->post("mobile_phone_default");
		$internal_phone_default = $this->input->post("internal_phone_default");


		//--Store local users
		$user = $this->User_model->list(array('conditions'=>array('user_id'=>$user_id)));
		if($user != false){
			$userdata = array(
				'email_default' => $email_default,
				'mobile_phone_default' => $mobile_phone_default,
				'internal_phone_default' => $internal_phone_default,
				'modified_at' => $this->global_data['timestamp'],
				'modified_by_ip' => $this->global_data['client_ip']
			);
			$this->User_model->update($user_id,$userdata);
		}

		header('Content-Type: application/json');
		echo json_encode($userdata);
	}


	public function external_profile_store()
	{

		// $user_id = $this->input->post("user_id");
		$name = $this->input->post("mod_user_name");
		$surname = $this->input->post("mod_user_surname");
		$name_faculty = $this->input->post("mod_user_faculty");
		$email_default = $this->input->post("mod_email_default");
		$mobile_phone_default = $this->input->post("mod_mobile_phone_default");
		$internal_phone_default = $this->input->post("mod_internal_phone_default_default");


		//--Store new external users
		$new_running_code = $this->User_model->new_external_id();
		$running = $new_running_code["0"];
		$user_id = "dpu-".$running["new_running_code"];

			$userdata = array(
				'user_id' => $user_id,
				'name' => $name,
				'surname' => $surname,
				'name_faculty' => $name_faculty,
				'mobile_phone_default' => $mobile_phone_default,
				'internal_phone_default' => $internal_phone_default,
				'email_default' => $email_default,
				'employee_type' => 'External',
				'external_user' => 'Y',
				'status' => '1'
			);
			$save_result = $this->User_model->save($userdata);

			return $userdata;



	}

	public function demo(){
		$this->load->view('user/login_demo');
	}


	public function list_external_json(){

		$conditions = array(
			'user_id' => $this->input->post('user_id'),
			'search_key'=> $this->input->post('search_key'),
			'external_user' => 'Y'
		);
		$user_lists = $this->User_model->list(array('conditions'=>  $conditions));

		header('Content-Type: application/json');
		echo json_encode($user_lists);

	}

	public function list_internal_json(){

		$conditions = array(
			'user_id' => $this->input->post('user_id'),
			'search_key'=> $this->input->post('search_key'),
			'role' => null,
		);
		$user_lists = $this->User_model->list(array('conditions'=>  $conditions));

		header('Content-Type: application/json');
		echo json_encode($user_lists);

	}

	public function line_disconnect()
	{

		$user_id = $this->global_data['user_id'];

		//--Store local users
		$user = $this->User_model->list(array('conditions'=>array('user_id'=>$user_id)));
		if($user != false){
			$userdata = array(
				'line_sub' => '',
				'line_iat' => '',
				'line_exp' => '',
				'modified_at' => $this->global_data['timestamp'],
				'modified_by_ip' => $this->global_data['client_ip']
			);
			$this->User_model->update($user_id,$userdata);
		}

		redirect('user/profile');


	}

	public function access_grant()
	{
		$data['title'] = "access grant";

		$data['cssSrc'] = array();

		$data['jsSrc'] = array(
			//'assets/js/user-profile.js'
		);

		//$data['profile'] = $this->User_model->list(array('conditions'=>  array('user_id' => $this->global_data['user_id']) ))[0];

		$this->data = $data;
		$this->content = 'user/access_grant';
		$this->render();
	}


}
