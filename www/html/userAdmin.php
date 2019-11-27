<?php

// 設定ファイル読み込み
require_once '../../include/Jyukusui/conf/const.php';
// 関数ファイル読み込み
require_once '../../include/Jyukusui/models/common.php';
require_once '../../include/Jyukusui/models/userAdmin.php';


$data    = array();
$err_msg = array();

try {
    $dbh = get_db_connect();
    
    if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // 現在日時を取得
        $now_date = date('Y-m-d H:i:s');
    }
    
    $data = get_user_list($dbh);
    $data = entity_assoc_array($data);

} catch (PDOException $e) {
    $err_msg[] = 'DBエラーです。理由：'.$e->getMessage();
}

// テンプレートファイル読み込み
include_once '../../include/Jyukusui/views/userAdmin.php';