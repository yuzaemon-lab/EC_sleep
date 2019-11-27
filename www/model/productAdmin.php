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