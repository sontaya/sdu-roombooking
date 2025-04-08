<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
       $result = $this->db->insert('rb_users', $data);
        // $id = $this->db->insert_id();
        // return (isset($id)) ? $id : FALSE;
        return (isset($result)) ? $result : FALSE;
    }

    function update($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $result = $this->db->update('rb_users', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('rb_users');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

	public function list($params = array()){
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}

          $this->db->select('u.*', false);
		  $this->db->from('rb_users u');

          if (!empty($params['conditions']['user_id'])){
            	$this->db->where('u.user_id', $params['conditions']['user_id']);
		  }

          if (!empty($params['conditions']['external_user'])){
			$this->db->group_start();
            	$this->db->where('u.external_user', $params['conditions']['external_user']);
            	$this->db->or_where('u.employee_type', 'Affairs');
			$this->db->group_end();
		  }

		  if (!empty($params['conditions']['search_key'])){
			  $where_like = "(name like '%".$params['conditions']['search_key']."%'
			  	or surname like '%".$params['conditions']['search_key']."%'
			  	or name_faculty like '%".$params['conditions']['search_key']."%'
			  )";
            $this->db->where($where_like);
		  }

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		//   echo $this->db->get_compiled_select();
    }

	public function list_admin($params = array()){
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}

          $this->db->select('u.*', false);
		  $this->db->from('rb_users u');

          if (!empty($params['conditions']['user_id'])){
            	$this->db->where('u.user_id', $params['conditions']['user_id']);
		  }

          if (!empty($params['conditions']['role'])){
            	$this->db->where('u.role', $params['conditions']['role']);
		  }

		  if (!empty($params['conditions']['search_key'])){
			  $where_like = "(name like '%".$params['conditions']['search_key']."%'
			  	or surname like '%".$params['conditions']['search_key']."%'
			  	or name_faculty like '%".$params['conditions']['search_key']."%'
			  	or user_id like '%".$params['conditions']['search_key']."%'
			  )";
            $this->db->where($where_like);
		  }

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		//   echo $this->db->get_compiled_select();
    }


	public function list_room_grant($params = array()){
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}


		// $user = $this->User_model->list_room_grant(array('conditions'=>  $conditions));

		// header('Content-Type: application/json');
		// print_r( json_decode($user[0]["control_room_grant"]));

		$user = $this->db->get_where('rb_users', array('user_id' => $params['conditions']['user_id']))->result_array();


		$rooms = json_decode($user[0]["control_room_grant"],true);
		if($rooms != ""){
			$room_grants_criteria = "AND rm.id in ('" . implode ( "', '", $rooms ) . "')";
		}else{
			$room_grants_criteria = "";
		}

		// $sql = "SELECT rm.id, rm.name, rm.shortname, rm.room_tag, rm.display_order
		// FROM rb_room_master rm
		// WHERE rm.id in (".$room_grants.")
		// ORDER BY rm.display_order
		// ";

		$results = $this->db->query("SELECT 'OL' as room_group, rm.id, rm.name, rm.shortname, rm.room_tag, rm.display_order
											FROM rb_room_master rm
											WHERE 1=1 ". $room_grants_criteria ."
											UNION
											SELECT 'HB' as room_group, rm.id, rm.name, rm.shortname, rm.room_tag, rm.display_order
											FROM hb_room_master rm
											WHERE 1=1 ". $room_grants_criteria ."
											UNION
											SELECT 'MT' as room_group, rm.id, rm.name, rm.shortname, rm.room_tag, rm.display_order
											FROM mt_room_master rm
											WHERE 1=1 ". $room_grants_criteria ."
										")->result_array();


		return $results;

		// echo $results;

        //   if (!empty($params['conditions']['role'])){
        //     	$this->db->where('u.role', $params['conditions']['role']);
		//   }


        //   $query = $this->db->get();
        //   return ($query->num_rows() > 0)?$query->result_array():FALSE;
		//   echo $this->db->get_compiled_select();
    }


	public function new_external_id(){
		$query = $this->db->query("SELECT right(concat('0000',max(CAST(right(user_id,4) as unsigned)) + 1),4) as new_running_code FROM rb_users WHERE external_user = 'Y'");
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}


	public function list_arit_member($params = array()){
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}

          $this->db->select('u.*', false);
		  $this->db->from('rb_users u');

		  $this->db->where('u.staff_arit_grant', 'Y');

          if (!empty($params['conditions']['user_id'])){
            	$this->db->where('u.user_id', $params['conditions']['user_id']);
		  }

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		//   echo $this->db->get_compiled_select();
    }


}

