<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sproom_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
       $result = $this->db->insert('dp_room_master', $data);
        // $id = $this->db->insert_id();
        // return (isset($id)) ? $id : FALSE;
        return (isset($result)) ? $result : FALSE;
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('dp_room_master', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('dp_room_master');
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

			$this->db->select('r.*', false);
			$this->db->from('sp_place_master r');

          if (!empty($params['conditions']['id'])){
            $this->db->where('r.id', $params['conditions']['id']);
		  }

          if (!empty($params['conditions']['active'])) {
              $this->db->where('r.active', $params['conditions']['active']);
		  }

      if (!empty($params['conditions']['room_in'])){
            $this->db->where_in('r.id', $params['conditions']['room_in']);
		  }


			$this->db->order_by('r.id', 'ASC');
          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		// echo $this->db->get_compiled_select();


    }

	public function place_list($params = array())
    {
      if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
      }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
      }

          $this->db->select('r.*', false);
		  		$this->db->from('sp_place_master r');
					$this->db->where('r.active', 'Y');

          if (!empty($params['conditions']['id'])){
            $this->db->where('r.id', $params['conditions']['id']);
		  }

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		// echo $this->db->get_compiled_select();


    }

	public function service_list($params = array())
    {
      if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit'],$params['start']);
      }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
        $this->db->limit($params['limit']);
      }

      $this->db->select('sv.*', false);
		  $this->db->from('sp_service_master sv');

          if (!empty($params['conditions']['id'])){
            $this->db->where('sv.id', $params['conditions']['id']);
		  }

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
		// echo $this->db->get_compiled_select();


    }


}

