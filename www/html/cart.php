<?php

// 設定ファイル読み込み
require_once '../conf/const.php';
// 関数ファイル読み込み
require_once '../model/common.php';
require_once '../model/cart.php';

$result_msg = '';
$product_sum = '';
// 現在日時を取得
$now_date = date('Y-m-d H:i:s');
$data       = array();
$err_msg    = array();

$sql_kind = get_post_data('sql_kind');

if ($sql_kind === 'update') {

    $update_amount = '';
    $cart_id     = '';
    
    $update_amount = get_post_data('update_amount');
    $update_amount = trim_space($update_amount);
    
    $cart_id = get_post_data('cart_id');
    
    if ($update_amount === '') {
        $err_msg[] = '個数を入力してください。';
    } else if (check_number($update_amount) !== TRUE ) {
        $err_msg[] = '個数は半角数字を入力してください';
    }
    
    if (check_number($cart_id) !== TRUE ) {
        $err_msg[] = '不正な処理です';
    }

} else if ($sql_kind === 'delete') {

    // $product_id      = '';
    $cart_id      = get_post_data('cart_id');
    if (check_number($cart_id) !== TRUE ) {
        $err_msg[] = '不正な処理です';
    }
}


try {

    $dbh = get_db_connect();
    
    if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if ($sql_kind === 'update') {
        
            try {
                // var_dump($update_amount);
                update_cart_amount($dbh, $cart_id, $update_amount, $now_date);
                $result_msg = '購入数変更成功';
            
            } catch (PDOException $e) {
                $err_msg[] = '購入数変更失敗';
            }
        
        } else if ($sql_kind === 'delete') {
            
            try {
                delete_cart_product($dbh, $cart_id);
                $result_msg = '削除成功';
                
            } catch (PDOException $e) {
                $err_msg[] = '削除失敗';
            }
        }
    }

    $data = get_cart_list($dbh, $user_id);
    $data = entity_assoc_array($data);
    
} catch (PDOException $e) {
    $err_msg[] = 'DB error. Why?: '.$e->getMessage();
}



// テンプレートファイル読み込み
include_once '../view/cart.php';