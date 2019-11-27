<?php

// 設定ファイル読み込み
require_once '../conf/const.php';
// 関数ファイル読み込み
require_once '../model/common.php';
require_once '../model/userAdmin.php';


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
include_once '../view/userAdmin.php';