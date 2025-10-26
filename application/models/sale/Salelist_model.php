<?php

class Salelist_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }


 public function Get($data)
        {


$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;



 $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';
            }


            $start = ($page - 1) * $perpage;


$querynum = $this->db->query('SELECT *, 
from_unixtime(sh.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
from_unixtime(savedate,"%d-%m-%Y %H:%i:%s") as savedate
    FROM sale_list_header  as sh
    LEFT JOIN user_owner as uo on uo.user_id=sh.user_id
	LEFT JOIN branch as b on b.branch_id=sh.branch_id
	LEFT JOIN pay_type as pt on pt.pay_type_id=sh.pay_type
    WHERE sh.adddate
BETWEEN "'.$dayfrom.'"
AND "'.$dayto.'"
AND sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.cus_name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.sale_runno LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND uo.name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND pt.pay_type_name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.saleremark LIKE "%'.$data['searchtext'].'%"
    
   ORDER BY ID DESC ');


$query = $this->db->query('SELECT *, 
from_unixtime(sh.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
from_unixtime(savedate,"%d-%m-%Y %H:%i:%s") as savedate
FROM sale_list_header  as sh
    LEFT JOIN user_owner as uo on uo.user_id=sh.user_id
	LEFT JOIN branch as b on b.branch_id=sh.branch_id
	LEFT JOIN pay_type as pt on pt.pay_type_id=sh.pay_type
    WHERE sh.adddate
BETWEEN "'.$dayfrom.'"
AND "'.$dayto.'"
AND sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.cus_name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.sale_runno LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND uo.name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND b.branch_name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND pt.pay_type_name LIKE "%'.$data['searchtext'].'%"
OR sh.adddate BETWEEN "'.$dayfrom.'" AND "'.$dayto.'" AND sh.saleremark LIKE "%'.$data['searchtext'].'%"

	ORDER BY sh.ID DESC LIMIT '.$start.' , '.$perpage.' ');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);




$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;


        }
		
		
		
		

 public function Get_detail($data)
        {


$dayfrom = strtotime($data['dayfrom']);
$dayto = strtotime($data['dayto'])+86400;

$query = $this->db->query('SELECT *, from_unixtime(sh.adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_datail  as sh
    WHERE sh.adddate
BETWEEN "'.$dayfrom.'"
AND "'.$dayto.'"
ORDER BY sh.ID ASC ');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );




$json = '{"list": '.$encode_data.'}';

return $json;


        }





public function Seemorepay($data)
        {

$query = $this->db->query('SELECT 
pt.pay_type_name,
m.money
    FROM morepay as m 
	LEFT JOIN pay_type as pt on pt.pay_type_id=m.pay_type
    WHERE m.sale_runno="'.$data['sale_runno'].'"
    ORDER BY pt.pay_type_id ASC');
$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
return $encode_data;

        }
		
		
		


// original code =======================

// public function Getone($data)
//         {

// $query = $this->db->query('SELECT sd.*, from_unixtime(sd.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
// wl.product_weight*sd.product_sale_num as product_weight
//     FROM sale_list_datail as sd
// 	LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id

//     WHERE sd.owner_id="'.$_SESSION['owner_id'].'" AND sd.sale_runno="'.$data['sale_runno'].'"
//     ORDER BY sd.ID ASC');
// $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );
// return $encode_data;



//         }
// original code =======================

// new update discord notification (work)=======================
// public function Getone($data)
// {
//     $sql = '
//         SELECT 
//             sd.*, 
//            from_unixtime(sd.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
//             wl.product_name,
//             wl.product_price,
//             (wl.product_weight * sd.product_sale_num) AS product_weight
//         FROM sale_list_datail AS sd
//         LEFT JOIN wh_product_list AS wl ON wl.product_id = sd.product_id
//         WHERE sd.owner_id="'.$_SESSION['owner_id'].'" AND sd.sale_runno="'.$data['sale_runno'].'"
//   ORDER BY sd.ID ASC
//     ';
//     $query = $this->db->query($sql, [$_SESSION["owner_id"], $data["sale_runno"]]);
//     $products_for_discord = $query->result();
//    // --- Prepare Discord message ---
//     $sale_runno = $data['sale_runno'];
//     $owner_name = $_SESSION['owner_name'];
//     $saledate = date('d-m-Y H:i:s');

//     $description = "🧾 **Sale Run No:** `$sale_runno`\n📅 **Sale Date:** $saledate\n\n";

//     if (!empty($products_for_discord)) {
//         foreach ($products_for_discord as $item) {
//             $description .= "🔹 Product ID: **{$item->product_id}**\n";
//             $description .= "🔹 Product Name: **{$item->product_name}**\n";
//             $description .= "   • Qty Sold: {$item->product_sale_num}\n";
//             $description .= "   • Price: {$item->product_price}\n";
//             $description .= "   • Time: {$item->adddate}\n";
//             $description .= "-------------------------\n";
//         }
//     } else {
//         $description .= "❌ No sale details found for this transaction.";
//     }

//     // --- Send Discord alert ---
//     $webhookurl = "https://discord.com/api/webhooks/1418977256730132480/VLTv4L2hmO2e45AG-rIR3MOPineXNY5fcDMTkjBVzQSnkGSb0X6Z6NX2efOM6aqoaMaP";
//     $message = [
//         "username" => $owner_name,
//         "content"  => "🟢 New Sale Notification",
//         "embeds"   => [[
//             "title"       => "Sale Summary",
//             "description" => $description,
//             "color"       => hexdec("00FF00")
//         ]]
//     ];

//     $ch = curl_init($webhookurl);
//     curl_setopt_array($ch, [
//         CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
//         CURLOPT_POST => 1,
//         CURLOPT_POSTFIELDS => json_encode($message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_SSL_VERIFYPEER => false,
//         CURLOPT_SSL_VERIFYHOST => false
//     ]);
//     curl_exec($ch);
//     curl_close($ch);

//     // --- Return JSON to Angular ---
//     return json_encode($products_for_discord, JSON_UNESCAPED_UNICODE);

    
// }

// end new update discord notification =======================


// test telegram notification (work)=======================

public function Getone($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['owner_id'])) {
        return json_encode(['error' => 'owner_id missing in session'], JSON_UNESCAPED_UNICODE);
    }

    if (empty($data['sale_runno'])) {
        return json_encode(['error' => 'sale_runno missing'], JSON_UNESCAPED_UNICODE);
    }

    $owner_id = $_SESSION['owner_id'];
    $sale_runno = $data['sale_runno'];

    // --- Fetch sale data ---
    $sql = '
        SELECT 
            sd.*,
            FROM_UNIXTIME(sd.adddate,"%d-%m-%Y %H:%i:%s") AS adddate,
            wl.product_name,
            wl.product_price,
            (wl.product_weight * sd.product_sale_num) AS product_weight,
            sh.sumsale_price as sumsale_price
        FROM sale_list_datail AS sd 
        left JOIN sale_list_header AS sh ON sh.sale_runno = sd.sale_runno AND sh.owner_id = sd.owner_id
        LEFT JOIN wh_product_list AS wl ON wl.product_id = sd.product_id
        WHERE sd.owner_id = ? AND sd.sale_runno = ?
        ORDER BY sd.ID ASC
    ';
    $query = $this->db->query($sql, [$owner_id, $sale_runno]);
    $products = $query->result();

    // --- Build Telegram message ---
    function escapeTelegramHTML($text) {
        return str_replace(['&', '<', '>'], ['&amp;', '&lt;', '&gt;'], $text);
    }

    $saledate = date('d-m-Y H:i:s');
    $message = "🧾 <b>Sale Run No:</b> " . escapeTelegramHTML($sale_runno) . "\n";
    $message .= "📅 <b>Sale Date:</b> " . $saledate . "\n\n";

    if (!empty($products)) {
        foreach ($products as $item) {
            $product_name = escapeTelegramHTML($item->product_name);
            $message .= "🔹 <b>{$product_name}</b> (ID: {$item->product_id})\n";
            $message .= "• Qty: {$item->product_sale_num}\n";
            $message .= "• Price: {$item->product_price}\n";
            $message .= "• Total Weight: " . number_format($item->product_weight, 2) . " kg\n";
            $message .= "• Total Price: " . number_format($item->sumsale_price, 2) . " KIP\n";
            $message .= "----------------------\n";
        }
    } else {
        $message .= "❌ No sale details found for this transaction.";
    }

    error_log("Telegram message: " . $message);

    // --- Send Telegram ---
    $bot_token = "8238483008:AAEjbdc0OZAIS9TmiN1Vh_gQ916XP9DBaU8";
    $chat_id = "6725507294";

    $url = "https://api.telegram.org/bot$bot_token/sendMessage";
    $data_post = [
        'chat_id' => $chat_id,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data_post),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false, // <--- disable SSL check
    CURLOPT_SSL_VERIFYHOST => false  // <--- disable SSL host check
]);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('Telegram cURL error: ' . curl_error($ch));
    } else {
        error_log('Telegram response: ' . $response);
    }

    curl_close($ch);

    // --- Return products ---
    return json_encode($products, JSON_UNESCAPED_UNICODE);
}

// end test telegram notification work ========================

        public function Getonequotation($data)
                {

        //$this->db->query('TRUNCATE TABLE sale_list_cus2mer');

$this->db->query('DELETE FROM sale_list_cus2mer
        WHERE user_id="'.$_SESSION['user_id'].'"');
			
			
if(!isset($data['show'])){
$this->db->query('INSERT INTO sale_list_cus2mer
     (product_id,product_name,product_image,product_unit_name,product_des,product_code,product_price,product_sale_num,product_price_discount,product_price_discount_percent,product_score,adddate,owner_id,user_id,store_id,sn_code)
    select product_id,product_name,product_image,product_unit_name,product_des,product_code,product_price,product_sale_num,product_price_discount,product_price_discount_percent,product_score,adddate,owner_id,"'.$_SESSION['user_id'].'",store_id,sn_code
    from quotation_list_datail
where owner_id = "'.$_SESSION['owner_id'].'" AND sale_runno="'.$data['sale_runno'].'"
    ');
}



        $query = $this->db->query('SELECT sd.*, 
from_unixtime(sd.adddate,"%d-%m-%Y %H:%i:%s") as adddate,
IFNULL(wu.product_unit_name,"") as product_unit_name,
wl.product_weight*sd.product_sale_num as product_weight
            FROM quotation_list_datail as sd
LEFT JOIN wh_product_list as wl on wl.product_id=sd.product_id
LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id

            WHERE sd.owner_id="'.$_SESSION['owner_id'].'" AND sd.sale_runno="'.$data['sale_runno'].'"
            ORDER BY sd.ID ASC');
        $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );



      if(!isset($data['show'])){
        $this->db->query('DELETE FROM quotation_list_header
                WHERE owner_id="'.$_SESSION['owner_id'].'"
                    AND sale_runno="'.$data['sale_runno'].'"');

                    $this->db->query('DELETE FROM quotation_list_datail
        WHERE owner_id="'.$_SESSION['owner_id'].'"
            AND sale_runno="'.$data['sale_runno'].'"');
}

            
        return $encode_data;


                }





        public function Getone2($data)
        {

$query = $this->db->query('SELECT *, from_unixtime(adddate,"%d-%m-%Y %H:%i:%s") as adddate
    FROM sale_list_datail
    WHERE owner_id="'.$_SESSION['owner_id'].'" AND sale_runno="'.$data['sale_runno'].'"
    ORDER BY ID ASC');

return $query->result();

        }



  public function Deletelist($data)
        {

		if($data['product_score_all'] == null){
    $data['product_score_all'] = '0';
}






$query0 = $this->db->query('INSERT INTO sale_list_header_bak(ID,sale_runno,
cus_name,
cus_id,
whydel,
branch_id,
cus_address_all,
sumsale_discount,
sumsale_num,
sumsale_price,
money_from_customer,
money_changeto_customer,
vat,
product_score_all,
sale_type,
pay_type,
reserv,
discount_last,
adddate,
savedate,
owner_id,
user_id,
store_id,
shift_id,
number_for_cus,
name,
user_name_del,
del_date)
SELECT ID,sale_runno,
cus_name,
cus_id,
"'.$data['whydel'].'",
branch_id,
cus_address_all,
sumsale_discount,
sumsale_num,
sumsale_price,
money_from_customer,
money_changeto_customer,
vat,
product_score_all,
sale_type,
pay_type,
reserv,
discount_last,
adddate,
savedate,
owner_id,
user_id,
store_id,
shift_id,
number_for_cus,
"'.$_SESSION['name'].'",
"'.$data['delname'].'",
"'.time().'"
FROM sale_list_header
WHERE sale_runno="'.$data['sale_runno'].'" and  owner_id="'.$_SESSION['owner_id'].'"');





$query0 = $this->db->query('INSERT INTO sale_list_datail_bak(ID,sale_runno,
product_id,
product_name,
product_image,
product_unit_name,
product_des,
product_code,
product_price,
product_sale_num,
product_price_discount,
product_price_discount_percent,
product_score,
adddate,
owner_id,
user_id,
store_id,
sc_ID,
branch_id,
shift_id)
SELECT ID,sale_runno,
product_id,
product_name,
product_image,
product_unit_name,
product_des,
product_code,
product_price,
product_sale_num,
product_price_discount,
product_price_discount_percent,
product_score,
adddate,
owner_id,
user_id,
store_id,
sc_ID,
branch_id,
shift_id
FROM sale_list_datail
WHERE sale_runno="'.$data['sale_runno'].'" and  owner_id="'.$_SESSION['owner_id'].'"');



//sn into stock for sale
$sl = $this->db->query('SELECT sn_code FROM sale_list_datail WHERE sale_runno="'.$data['sale_runno'].'"');
foreach ( $sl->result_array() as $key => $value) {
$query = $this->db->query('UPDATE serial_number
    SET status="0"
    WHERE sn_code="'.$value['sn_code'].'" ');
  }
//sn into stock for sale
  


$query = $this->db->query('DELETE FROM sale_list_datail  WHERE sale_runno="'.$data['sale_runno'].'" and  owner_id="'.$_SESSION['owner_id'].'"');

if($query){
$query2 = $this->db->query('DELETE FROM sale_list_header  WHERE sale_runno="'.$data['sale_runno'].'" and  owner_id="'.$_SESSION['owner_id'].'"');


$this->db->query('UPDATE customer_owner
    SET product_score_all=product_score_all - '.$data['product_score_all'].' WHERE cus_id="'.$data['cus_id'].'" and  owner_id="'.$_SESSION['owner_id'].'"');
}


$query = $this->db->query('DELETE FROM  log_from_relation_when_sale  WHERE sale_runno="'.$data['sale_runno'].'"');

$query = $this->db->query('DELETE FROM  log_round  WHERE sale_runno="'.$data['sale_runno'].'"');

$query = $this->db->query('DELETE FROM  morepay  WHERE sale_runno="'.$data['sale_runno'].'"');

$query = $this->db->query('DELETE FROM  product_return_header2  WHERE sale_runno="'.$data['sale_runno'].'"');

$query = $this->db->query('DELETE FROM  product_return_datail2  WHERE sale_runno="'.$data['sale_runno'].'"');


return true;

        }





public function Deletelist_pass($data)
        {
		
		
$querypass =  $this->db->get_where('user_owner' , array('user_password' => $data['billpassword']));

    $count_row = $querypass->num_rows();

    if ($count_row > 0) {
$querycheck = $this->db->query('SELECT pg.permission_rule,uo.name
FROM user_owner as uo 
LEFT JOIN permission_group as pg on uo.user_type=pg.group_id
WHERE uo.user_password="'.$data['billpassword'].'" LIMIT 1');
foreach ($querycheck->result() as $row) {

 $arr_permission_rule =  json_decode($row->permission_rule);
 $arr_name =  $row->name;

}




if(!isset($arr_permission_rule) || $arr_permission_rule[19]->status==true){
		return $arr_name;
}else{
	return 'no';
	}



	}else{
	return 'no';
	}
		
		
		}



          public function Deletequotationlist($data)
                {

        		if($data['product_score_all'] == null){
            $data['product_score_all'] = '0';
        }

        $query = $this->db->query('DELETE FROM quotation_list_datail  WHERE sale_runno="'.$data['sale_runno'].'" and  owner_id="'.$_SESSION['owner_id'].'"');

        if($query){
        $query2 = $this->db->query('DELETE FROM quotation_list_header  WHERE sale_runno="'.$data['sale_runno'].'" and  owner_id="'.$_SESSION['owner_id'].'"');

                }


        return true;

                }





 public function Updateproductaddstock($data)
        {


$query = $this->db->query('UPDATE stock
    SET product_stock_num=product_stock_num + '.$data['product_sale_num'].'
    WHERE product_id="'.$data['product_id'].'" and  branch_id="'.$_SESSION['branch_id'].'"');
return true;

        }







  }