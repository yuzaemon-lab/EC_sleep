<?php

$err_msg = array();

// セッション開始
session_start();
// セッション変数からログイン済みか確認
if (isset($_SESSION['user_id']) === TRUE) {
    // ログイン済みの場合、ホームページへリダイレクト
    header('Location: index.php');
    exit;
}

/*
*  ログイン処理
*/
// リクエストメソッド確認
if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // POST値取得
    $user_name  = get_post_data('user_name');
    $password = get_post_data('password'); // パスワード
    
    try {
        $dbh = get_db_connect();
        $sql = 'SELECT * FROM users WHERE user_name = ? AND password = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
        $stmt->bindValue(2, $password, PDO::PARAM_STR);
        // SQLを実行
        $stmt->execute();
        // レコードの取得
        $data = $stmt->fetchAll();
    } catch (PDOException $e) {
        throw $e;
    }
    
    if (count($data) === 0) {
        $err_msg[] = 'ユーザー名または、パスワードが違います。';
    } else {
        $_SESSION['user_id'] = $data[0]['user_id'];
        $_SESSION['user_name'] = $data[0]['user_name'];
        $user_id = $data[0]['user_id'];
        $user_name = $data[0]['user_name'];
        
        if ($user_id === '1') {
            $location = 'productAdmin.php';
        } else {
            // ログイン済みユーザのホームページへリダイレクト
            $location = 'index.php';
        }
        
        header('Location: ' . $location);
        exit;
    }

}