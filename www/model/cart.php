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

function update_cart_amount($dbh, $cart_id, $update_amount, $now_date) {
    global $err_msg, $result_msg;
    try {
        $sql = 'UPDATE carts SET amount = ?, update_datetime = ?
                WHERE cart_id = ?'; 
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(1, $update_amount, PDO::PARAM_INT);
        $stmt->bindValue(2, $now_date,    PDO::PARAM_STR);
        $stmt->bindValue(3, $cart_id, PDO::PARAM_INT);

        $stmt->execute();
        $result_msg = '購入数を変更しました。';
    } catch(PDOException $e) {
        $err_msg[] = '購入数を変更できませんでした。';
        throw $e;
    } 
}

function delete_cart_product($dbh, $cart_id) {

    try {
        // SQL生成
        $sql = 'DELETE
                FROM carts
                WHERE cart_id = ?';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $cart_id, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
        
    } catch (PDOException $e) {
        throw $e;
    }
}