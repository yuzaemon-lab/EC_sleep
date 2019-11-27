<?php

$err_msg = array();

// セッション開始
session_start();

if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST値取得
    $user_name  = get_post_data('user_name');
    $user_name  = trim_space($user_name);
    $password = get_post_data('password'); // パスワード
    $password = trim_space($password);
    try {
        $dbh = get_db_connect();
        // SQL文を作成
        $sql = 'INSERT INTO users (user_name, password, create_datetime) VALUES (?, ?, now())';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1, $user_name,    PDO::PARAM_STR);
        $stmt->bindValue(2, $password,   PDO::PARAM_INT);
        // $stmt->bindValue(5, $now_date, PDO::PARAM_STR);
        // SQLを実行
        $stmt->execute();
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        // ロールバック処理
        // $dbh->rollback();
        // 例外をスロー
        throw $e;
    }
}



        
?>