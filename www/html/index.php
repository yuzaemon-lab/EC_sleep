<?php

// 設定ファイル読み込み
require_once '../../include/Jyukusui/conf/const.php';
// 関数ファイル読み込み
require_once '../../include/Jyukusui/models/common.php';
require_once '../../include/Jyukusui/models/index.php';


$product_id = '';
$result_msg = '';
// 現在日時を取得
$now_date = date('Y-m-d H:i:s');
$data    = array();
$err_msg = array();

try {
    $dbh = get_db_connect();
    if (get_request_method() === 'POST') {
        $product_id = get_post_data('product_id');
        check_product_id($product_id);
        if (count($err_msg) === 0) {
            $data = get_cart_index($dbh, $user_id, $product_id);
// print_r($data);
            if (count($data) > 0) {
                update_amount_index($dbh, $user_id, $product_id, $now_date);
            } else {
                insert_cart_index($dbh, $user_id, $product_id, $now_date);
            }
        
        }
    }
    $data = get_product_list($dbh);
    $data = entity_assoc_array($data);
} catch (PDOException $e) {
    $err_msg[] = 'DB error. Why?: '.$e->getMessage();
}


// テンプレートファイル読み込み
include_once '../../include/Jyukusui/views/index.php';