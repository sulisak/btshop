<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        // $this->load->model('warehouse/stock_model');

     if(!isset($_SESSION['owner_id'])){
            header( "location: ".$this->base_url );
        }
        
    }

public function index()
	{
		

$data['tab'] = 'sam';
$data['title'] = 'sam';
		$this->warehouselayout('warehouse/sam',$data);
}
}