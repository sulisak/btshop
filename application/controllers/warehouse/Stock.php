<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('warehouse/stock_model');

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
		

$data['tab'] = 'stock';
$data['title'] = 'Product Stock';
		$this->warehouselayout('warehouse/stock',$data);
}


	 function Getstock()
    {


$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}	

echo $list = $this->stock_model->Getstock($data);


      
}






// function Updatematok()
//     {


// $data = json_decode(file_get_contents("php://input"),true);
// if(!isset($data)){
// exit();
// }	

// $text = null;
// //Line notify
// if($_SESSION['line_editstock']=='1'){
// $text = $_SESSION['owner_name']."\n++ແກ້ໄຂສະຕັອກ++\n".$data['product_name']."\nຈາກ: ".number_format($data['product_stock_num'])."\nເປັນ: ".number_format($data['product_stock_num_change'])."\nໂດຍ: ".$_SESSION['name']."\nເວລາ " .date('H:i',time());
// $this->Line_notify($text);

// }
// //Line notify

// // discord notify==============================
// $webhook_url = "https://discordapp.com/api/webhooks/1418977256730132480/VLTv4L2hmO2e45AG-rIR3MOPineXNY5fcDMTkjBVzQSnkGSb0X6Z6NX2efOM6aqoaMaP";

// $text = $_SESSION['owner_name']
//     . "\n++ແກ້ໄຂສະຕັອກ++\n"
//     . $data['product_name']
//     . "\nຈາກ: " . number_format($data['product_stock_num'])
//     . "\nເປັນ: " . number_format($data['product_stock_num_change'])
//     . "\nໂດຍ: " . $_SESSION['name']
//     . "\nເວລາ " . date('H:i', time());

// Discord_notify($text, $webhook_url);
// // discord notify==============================

// $success = $this->stock_model->Updatematok($data);
//  // Always return JSON
//     header('Content-Type: application/json; charset=utf-8');
//     echo json_encode([
//         "success" => $success,
//         "line_message" => $text
//     ]);

      
// }

// function Updatematok()
// {
//     // Make sure errors don't break JSON output
//     ini_set('display_errors', 0);
//     ini_set('log_errors', 1);
//     error_reporting(E_ALL);

//     try {
//         $data = json_decode(file_get_contents("php://input"), true);

//         if (!$data) {
//             header('Content-Type: application/json; charset=utf-8');
//             echo json_encode([
//                 "success" => false,
//                 "error" => "Invalid or missing input data."
//             ]);
//             exit;
//         }

//         $text = null;

//         // Line notify
//         if (!empty($_SESSION['line_editstock']) && $_SESSION['line_editstock'] == '1') {
//             $text = $_SESSION['owner_name']
//                 . "\n++ແກ້ໄຂສະຕັອກ++\n"
//                 . $data['product_name']
//                 . "\nຈາກ: " . number_format($data['product_stock_num'])
//                 . "\nເປັນ: " . number_format($data['product_stock_num_change'])
//                 . "\nໂດຍ: " . $_SESSION['name']
//                 . "\nເວລາ " . date('H:i', time());

//             $this->Line_notify($text);
//         }

//         // Update stock
//         $success = $this->stock_model->Updatematok($data);

//         // JSON response
//         header('Content-Type: application/json; charset=utf-8');
//         echo json_encode([
//             "success" => (bool) $success,
//             "line_message" => $text
//         ]);
//         exit;

//     } catch (Exception $e) {
//         header('Content-Type: application/json; charset=utf-8');
//         echo json_encode([
//             "success" => false,
//             "error" => $e->getMessage()
//         ]);
//         exit;
//     }
// }

function Updatematok()
{
    // Set timezone to avoid PHP warnings
    date_default_timezone_set('Asia/Bangkok');

    // Read JSON input
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            "success" => false,
            "error" => "Invalid or missing input data."
        ]);
        exit;
    }

    // ================= Discord Notify =================
    $discord_webhook_url = "https://discordapp.com/api/webhooks/1418977256730132480/VLTv4L2hmO2e45AG-rIR3MOPineXNY5fcDMTkjBVzQSnkGSb0X6Z6NX2efOM6aqoaMaP";

    $discord_text = $_SESSION['owner_name']
        . "\n++ແກ້ໄຂສະຕັອກ++\n"
        . $data['product_name']
        . "\nຈາກ: " . number_format($data['product_stock_num'])
        . "\nເປັນ: " . number_format($data['product_stock_num_change'])
        . "\nໂດຍ: " . $_SESSION['name']
        . "\nເວລາ " . date('H:i', time());

    $this->Discord_notify($discord_text, $discord_webhook_url);
    // ================= Discord Notify =================

    // Update stock
    $success = $this->stock_model->Updatematok($data);

    // Always return JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "success" => (bool)$success,
        "discord_message" => $discord_text
    ]);
    exit;
}

// ================= Discord Notify Function =================
function Discord_notify($message, $webhook_url)
{
    $data = ["content" => $message];

    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}






	function Product_num_min_noti()
    {

if(!isset($_SESSION['remove_num_min_noti_modal'])){
echo  $this->stock_model->Product_num_min_noti();
}

	}
	
	
	
	
	function Remove_num_min_noti_modal()
    {

$data = array(
           'remove_num_min_noti_modal' => '1'
         );

$this->session->set_userdata($data);
header( "location: ".$this->base_url );

	}
	
	
	



	}