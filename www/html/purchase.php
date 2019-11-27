<?php

// 設定ファイル読み込み
require_once '../../include/Jyukusui/conf/const.php';
// 関数ファイル読み込み
require_once '../../include/Jyukusui/models/common.php';
require_once '../../include/Jyukusui/models/purchase.php';

$result_msg = '';
$product_sum = '';
// 現在日時を取得
$now_date = date('Y-m-d H:i:s');
$data       = array();
$err_msg    = array();

try {
    $dbh = get_db_connect();
    
    $data = get_cart_list($dbh, $user_id);
    $data = entity_assoc_array($data);
    
    foreach ($data as $value) {
        $stock = $value['stock'];
        $amount = $value['amount'];
        $status = $value['status'];
    
        // 在庫があるかをチェック
        if ($stock - $amount < '0') {
            $err_msg[] = '在庫が足りません';
        }
        
        // ステータスチェック
        if ($status === '0') {
            $err_msg[] = '販売が終了しました！';
        }
        
        if (count($err_msg) === 0) {
            purchase_product($dbh, $data, $user_id, $stock, $amount, $now_date);
        }
    }
    
} catch (PDOException $e) {
    $err_msg[] = 'DB error. Why?: '.$e->getMessage();
}

// 購入処理でやること
// ・商品ステータスチェック if(isset())
// ・商品の在庫がカートテーブルと比較して足りているかをチェック if(stock - amount => 0)


// ・エラーがなければ if(count($err_msg) === 0)
// another function
// 　商品の数ぶん foreach()
// 　・在庫数を減らす transaction_stock()
// 　・カートから削除する cart_delete()
// ・エラーが１つもなければコミットし、あればロールバックする


// テンプレートファイル読み込み
include_once '../../include/Jyukusui/views/purchase.php';