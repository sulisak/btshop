<?php

class Stockless_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }






         public function Getstockless($data)
        {


 $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';
            }

            $start = ($page - 1) * $perpage;

$querynum = $this->db->query('SELECT
      wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
    wl.product_price_discount as product_price_discount,
	s.product_stock_num as product_stock_num,
	wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    z.zone_name as zone_name,
    wu.product_unit_name as product_unit_name
    FROM wh_product_list  as wl
    LEFT JOIN zone as z on z.zone_id=wl.zone_id
    LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
	LEFT JOIN stock as s on s.product_id=wl.product_id
    WHERE s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3 AND wl.product_code LIKE "%'.$data['searchtext'].'%"
    OR s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3 AND wl.product_name LIKE "%'.$data['searchtext'].'%"
    OR s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3 AND z.zone_name LIKE "%'.$data['searchtext'].'%"
	OR s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3 AND wc.product_category_name LIKE "%'.$data['searchtext'].'%"
ORDER BY wl.product_stock_num ASC');

// In Stockless view =================
$query = $this->db->query('SELECT
    wl.product_id as product_id,
    wl.product_code as product_code,
    wl.product_name as product_name,
    wl.product_price as product_price,
    wl.product_wholesale_price as product_wholesale_price,
    wl.product_price_discount as product_price_discount,
	s.product_stock_num as product_stock_num,
	wl.product_price_value as product_price_value,
    wc.product_category_id as product_category_id,
    wc.product_category_name as product_category_name,
    z.zone_name as zone_name,
    wu.product_unit_name as product_unit_name
    FROM wh_product_list  as wl
    LEFT JOIN zone as z on z.zone_id=wl.zone_id
    LEFT JOIN wh_product_unit as wu on wu.product_unit_id=wl.product_unit_id
    LEFT JOIN wh_product_category as wc on wc.product_category_id=wl.product_category_id
	LEFT JOIN stock as s on s.product_id=wl.product_id
    WHERE s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3  AND wl.product_code LIKE "%'.$data['searchtext'].'%"
    OR s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3  AND wl.product_name LIKE "%'.$data['searchtext'].'%"
    OR s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3 AND z.zone_name LIKE "%'.$data['searchtext'].'%"
	OR s.branch_id="'.$_SESSION['branch_id'].'" AND s.product_stock_num BETWEEN 1 AND 3  AND wc.product_category_name LIKE "%'.$data['searchtext'].'%"

    ORDER BY s.product_stock_num ASC  LIMIT '.$start.' , '.$perpage.'  ');



$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );

// $encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);


$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;


        }


// public function Getstockless($data)
// {
//     $perpage = isset($data['perpage']) ? $data['perpage'] : 100;
//     $page = (isset($data['page']) && $data['page'] != '') ? $data['page'] : 1;
//     $start = ($page - 1) * $perpage;

//     // Base SQL
//     $select_fields = "wl.product_id, wl.product_code, wl.product_name, s.product_stock_num";
//     if (empty($data['dashboard'])) {
//         // Full page: include extra fields
//         $select_fields = "wl.product_id, wl.product_code, wl.product_name, wl.product_price, wl.product_wholesale_price,
//         wl.product_price_discount, s.product_stock_num, wl.product_price_value, wc.product_category_id, 
//         wc.product_category_name, z.zone_name, wu.product_unit_name";
//     }

//     $query = $this->db->query('
//         SELECT '.$select_fields.'
//         FROM wh_product_list AS wl
//         LEFT JOIN zone AS z ON z.zone_id = wl.zone_id
//         LEFT JOIN wh_product_unit AS wu ON wu.product_unit_id = wl.product_unit_id
//         LEFT JOIN wh_product_category AS wc ON wc.product_category_id = wl.product_category_id
//         LEFT JOIN stock AS s ON s.product_id = wl.product_id
//         WHERE s.branch_id = "'.$_SESSION['branch_id'].'"
//         AND s.product_stock_num BETWEEN 1 AND 3
//         AND (
//             wl.product_code LIKE "%'.$data['searchtext'].'%"
//             OR wl.product_name LIKE "%'.$data['searchtext'].'%"
//             OR z.zone_name LIKE "%'.$data['searchtext'].'%"
//             OR wc.product_category_name LIKE "%'.$data['searchtext'].'%"
//         )
//         ORDER BY s.product_stock_num ASC
//         '.(empty($data['dashboard']) ? 'LIMIT '.$start.', '.$perpage : '').'
//     ');

//     $list = $query->result();
//     $num_rows = $query->num_rows();

//     $json = json_encode([
//         'list' => $list,
//         'numall' => $num_rows
//     ], JSON_UNESCAPED_UNICODE);

//     return $json;
// }



    }