<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppsetting extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('salesetting/ppsetting_model');

     if(!isset($_SESSION['owner_id'])){
            header( "location: ".$this->base_url );
        }
        
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		

$data['tab'] = 'ppsetting';
$data['title'] = 'Promp pay';
		$this->salesettinglayout('salesetting/ppsetting',$data);
}





public function Get()
{
    $list = $this->ppsetting_model->Getpp();
    // echo json_encode(['list' => json_decode($list)]);


    // log raw data
    log_message('debug', 'Ppsetting::Get() raw list = ' . print_r($list, true));

    // try decoding if it's still JSON string
    $decoded = json_decode($list);

    // log after decode
    log_message('debug', 'Ppsetting::Get() decoded = ' . print_r($decoded, true));

    echo json_encode(['list' => $decoded], JSON_UNESCAPED_UNICODE);

}

public function Update()
{
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) exit();

    $success = $this->ppsetting_model->Updatepp($data);
    echo json_encode(['success' => $success]);
}








	}