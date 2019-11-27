<?php

// データベースの接続情報
define('DB_USER', 'testuser');
define('DB_PASSWD', 'password');
define('DB_NAME', 'sample');
define('DSN', 'mysql:dbname='.DB_NAME.';host=localhost;charset=utf8');

// データベースのDNS情報
define('HTML_CHARACTER_SET', 'UTF-8');  // HTML文字エンコーディング
define('DB_CHARACTER_SET',   'UTF8');   // DB文字エンコーディング
define('IMG_DIR', './assets/img/');   // 画像ファイル保存ディレクトリ