<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Donation_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function save($data) {
       $result = $this->db->insert('donations', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
        // return (isset($result)) ? $result : FALSE;
    }

    function update($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('donations', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $result = $this->db->delete('donations');
        if ($result) {
            return true;
        } else {
            return false;
        }
	}

	function view($id){
		$this->db->select('*');
		$this->db->from('donations');
		$this->db->where('id', $id);
		$result = $this->db->get();

		if ($result->num_rows() > 0) {
            return $result->result_array();
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

          $this->db->select('*', false);
          $this->db->from('donations');


          if (!empty($params['conditions']['process_status'])){
            $this->db->where('process_status', $params['conditions']['process_status']);
		  }

		  if (!empty($params['conditions']['generalSearch'])){
			$where_like = "(firstname LIKE '%".$params['conditions']['generalSearch']."%'
							  OR lastname LIKE '%".$params['conditions']['generalSearch']."%'
							  OR email LIKE '%".$params['conditions']['generalSearch']."%'
							)";
			$this->db->where($where_like);

		  }


        //   if (!empty($params['conditions']['CATEGORY'])){
        //     $this->db->where('CATEGORY', $params['conditions']['CATEGORY']);
        //   }

        //   $this->db->order_by('REMARK', 'ASC');
        //   $this->db->order_by('FILENAME_PDF', 'ASC');

          $query = $this->db->get();
          return ($query->num_rows() > 0)?$query->result_array():FALSE;
          // echo $this->db->get_compiled_select();


    }


}

