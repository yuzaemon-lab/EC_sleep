<?php

/*
*  ログイン済みユーザのホームページ
*/
// セッション開始
session_start();
// セッション変数からuser_id取得
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  // 非ログインの場合、ログインページへリダイレクト
  header('Location: login.php');
  exit;
}

// セッション変数からuser_name取得
if (isset($_SESSION['user_name'])) {
  $user_name = $_SESSION['user_name'];
} else {
  // ユーザ名が取得できない場合、ログアウト処理へリダイレクト
  header('Location: login.php');
  exit;
}



function check_product_id($product_id) {
    if ($product_id === '') {
        $err_msg[] = '商品番号が取得できません';
    } else if (check_number($product_id) !== TRUE ) {
        $err_msg[] = '不正な処理です';
    }
}

function get_cart_index($dbh, $user_id, $product_id) {
    $sql = 'SELECT user_id, product_id
            FROM carts
            WHERE user_id = ' . $user_id . ' AND product_id = ' . $product_id;

    return get_as_array($dbh, $sql);
}


function update_amount_index($dbh, $user_id, $product_id, $now_date) {
    global $err_msg, $result_msg;
    try {
        $sql = 'UPDATE carts SET amount = amount + 1, update_datetime = ?
                WHERE user_id = ? AND product_id = ?'; 
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(1, $now_date,    PDO::PARAM_STR);
        $stmt->bindValue(2, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $product_id, PDO::PARAM_INT);

        $stmt->execute();
        $result_msg = '数量を１追加しました。';
    } catch(PDOException $e) {
        $err_msg[] = '数量を１追加できませんでした。';
        throw $e;
    } 
}

function insert_cart_index($dbh, $user_id, $product_id, $now_date) {
    global $err_msg, $result_msg;
    try {
        
        $sql = 'INSERT INTO carts (user_id, product_id, amount, create_datetime, update_datetime)
                VALUES (?, ?, 1, ?, ?)';
        // $sql = 'INSERT INTO carts (user_id, product_id, amount, create_datetime, update_datetime)
        //         VALUES (' . $user_id . ', ' . $product_id . ', 1, ' . $now_date . ', ' . $now_date';

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $product_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $now_date,    PDO::PARAM_STR);
        $stmt->bindValue(4, $now_date,    PDO::PARAM_STR);
        
        $stmt->execute();
        $result_msg = 'カートに追加しました。';
    } catch(PDOException $e) {
        $err_msg[] = 'カートに追加できませんでした。';
        throw $e;
    }
}



