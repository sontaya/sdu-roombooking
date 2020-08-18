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

	public function list($params = array())
    {
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

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		//   echo $this->db->get_compiled_select();


    }
}

