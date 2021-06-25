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
            $this->db->where('u.external_user', $params['conditions']['external_user']);
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

	public function new_external_id(){
		$query = $this->db->query("SELECT right(concat('0000',max(CAST(right(user_id,4) as unsigned)) + 1),4) as new_running_code FROM rb_users WHERE external_user = 'Y'");
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}
}

