<?php

class Ppsetting_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }

    function Updatepp($data)
    {
        // only update row with id = 1 (if your table has single row for settings)
        $where = ['id' => 1];
        return $this->db->update("banner_cus2mer", $data, $where);
    }

     public function Getpp()
        {

$query = $this->db->query('SELECT ppid,ppname FROM banner_cus2mer');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }


    }