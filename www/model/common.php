<?php

/**
* 特殊文字をHTMLエンティティに変換する
* @param str  $str 変換前文字
* @return str 変換後文字
*/
function entity_str($str) {
    return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}

/**
* 特殊文字をHTMLエンティティに変換する(2次元配列の値)
* @param array  $assoc_array 変換前配列
* @return array 変換後配列
*/
function entity_assoc_array($assoc_array) {
    foreach ($assoc_array as $key => $value) {
        foreach ($value as $keys => $values) {
            // 特殊文字をHTMLエンティティに変換
            $assoc_array[$key][$keys] = entity_str($values);
        }
    }
    return $assoc_array;
}

/**
* DBハンドルを取得
* @return obj $dbh DBハンドル
*/
function get_db_connect() {
    try {
        // データベースに接続
        $dbh = new PDO(DSN, DB_USER, DB_PASSWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        throw $e;
    }
    return $dbh;
}


/**
* クエリを実行しその結果を配列で取得する
*
* @param obj  $dbh DBハンドル
* @param str  $sql SQL文
* @return array 結果配列データ
*/
function get_as_array($dbh, $sql) {

    try {
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQLを実行
        $stmt->execute();
        // レコードの取得
        $rows = $stmt->fetchAll();
    } catch (PDOException $e) {
        throw $e;
    }
    return $rows;
}

/**
* insertを実行する
*
* @param obj $dbh DBハンドル
* @param str SQL文
* @return bool
*/
function insert_db($dbh, $sql) {
    try {
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQLを実行
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
    return true;
}

/**
* リクエストメソッドを取得
* @return str GET/POST/PUTなど
*/
function get_request_method() {
    return $_SERVER['REQUEST_METHOD'];
}

/**
* POSTデータを取得
* @param str $key 配列キー
* @return str POST値
*/
function get_post_data($key) {
    $str = '';
    if (isset($_POST[$key]) === TRUE) {
        $str = $_POST[$key];
    }
    return $str;
}

/**
* 商品一覧を取得する
*
* @param obj $dbh DBハンドル
* @return array商品一覧配列データ
*/
function get_product_list($dbh) {
    // SQL生成
    $sql = 'SELECT products.product_id, products.product_name, products.price,
             products.img, products.status, stocks.stock
          FROM products JOIN stocks
          ON  products.product_id = stocks.product_id';
    // クエリ実行
    return get_as_array($dbh, $sql);
}

/**
* ユーザー一覧を取得する
*
* @param obj $dbh DBハンドル
* @return array商品一覧配列データ
*/
function get_user_list($dbh) {
    // SQL生成
    $sql = 'SELECT user_name, password FROM users';
    // クエリ実行
    return get_as_array($dbh, $sql);
}

/**
* カート一覧を取得する
*
* @param obj $dbh DBハンドル
* @return array商品一覧配列データ
*/
function get_cart_list($dbh, $user_id) {
    // SQL生成
    $sql = 'SELECT carts.cart_id, carts.amount, p.product_id, p.img, p.product_name, p.price, p.status, stocks.stock
            FROM carts 
            JOIN products AS p
            ON  carts.product_id = p.product_id
            JOIN stocks
            ON carts.product_id = stocks.product_id
            WHERE carts.user_id = ' . $user_id;
    // クエリ実行
    return get_as_array($dbh, $sql);
}


/**
* 特定の商品情報を取得する
*
* @param obj $dbh DBハンドル
* @return array 特定の商品配列データ
*/
function get_product_data($dbh, $product_id) {
    // SQL生成
    $sql = 'SELECT products.product_id, products.product_name, products.price,
                 products.img, stocks.stock, products.status
          FROM products JOIN stocks
          ON  products.product_id = stocks.product_id
          WHERE products.product_id = ' . $product_id;

    // クエリ実行
    return get_as_array($dbh, $sql);
}

/**
* 商品在庫数を変更する
*
* @param obj $dbh DBハンドル
* @param int $product_id 商品ID
* @param int $stock 在庫数
* @param str $date 日付
* @return bool
*/
function update_product_stock($dbh, $product_id, $stock, $now_date) {

    try {
        // SQL生成
        $sql = 'UPDATE stocks SET stock = ?, update_datetime = ? WHERE product_id = ?';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1, $stock,    PDO::PARAM_INT);
        $stmt->bindValue(2, $now_date, PDO::PARAM_STR);
        $stmt->bindValue(3, $product_id, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}


/**
* 商品ステータスを変更する
*
* @param obj $dbh DBハンドル
* @param int $product_id 商品ID
* @param int $change_status ステータス
* @param str $date 日付
* @return bool
*/
function update_product_status($dbh, $product_id, $change_status, $now_date) {
    // SQL生成
    try {
        // SQL生成
        $sql = 'UPDATE products SET status = ?, update_datetime = ? WHERE product_id = ? LIMIT 1';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1, $change_status, PDO::PARAM_INT);
        $stmt->bindValue(2, $now_date, PDO::PARAM_STR);
        $stmt->bindValue(3, $product_id, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
* 商品の在庫を削除する
*
* @param obj $dbh DBハンドル
* @param int $product_id 商品ID
* @return bool
*/
function delete_stock($dbh, $product_id) {

    try {
        // SQL生成
        $sql = 'DELETE
                FROM stocks
                WHERE product_id = ?';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $product_id, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
        
    } catch (PDOException $e) {
        throw $e;
    }
}


/**
* 商品を削除する 
*/
function delete_product($dbh, $product_id) {

    try {
        // SQL生成
        $sql = 'DELETE
                FROM products
                WHERE product_id = ?';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $product_id, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
        
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
* 購入に併せてカートを削除する 
*/
function cart_delete($dbh, $user_id) {

    try {
        // SQL生成
        $sql = 'DELETE
                FROM carts
                WHERE user_id = ' . $user_id;
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQLを実行
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

/*
購入に併せて在庫を減らす
*/
function transaction_stock($dbh, $product_id, $stock, $amount, $now_date) {
    try {
        // SQL生成
        $sql = 'UPDATE stocks 
                SET stock = ?, update_datetime = ?
                WHERE product_id = ' . $product_id;
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $stock - $amount, PDO::PARAM_INT);
        $stmt->bindValue(2, $now_date, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}


/**
* 商品を追加する
*
* @param obj $dbh DBハンドル
* @param str $new_name 商品ID
* @param int $new_price 価格
* @param int $new_stock 在庫数
* @param int $new_img 画像
* @param int $date 日付
* @param int $new_status ステータス
* @return bool
*/
function insert_product_data($dbh, $new_name, $new_price, $new_stock, $new_img, $new_status, $now_date) {

    // トランザクション開始
    $dbh->beginTransaction();

    try {
        // SQL文を作成
        $sql = 'INSERT INTO products (product_name, price, img, status, create_datetime, update_datetime) VALUES (?, ?, ?, ?, now(), now())';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1, $new_name,    PDO::PARAM_STR);
        $stmt->bindValue(2, $new_price,   PDO::PARAM_INT);
        $stmt->bindValue(3, $new_img,     PDO::PARAM_STR);
        $stmt->bindValue(4, $new_status,  PDO::PARAM_INT);
        // $stmt->bindValue(5, $now_date, PDO::PARAM_STR);
        // SQLを実行
        $stmt->execute();
    
        // INSERTされたデータのIDを取得
        $product_id = $dbh->lastInsertId('product_id');
    
        // SQL文を作成
        $sql = 'INSERT INTO stocks (product_id, stock, create_datetime, update_datetime) VALUES (?, ?, now(), now())';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1, $product_id,    PDO::PARAM_INT);
        $stmt->bindValue(2, $new_stock,   PDO::PARAM_STR);
        // SQLを実行
        $stmt->execute();
        // コミット
        $dbh->commit();
    } catch (PDOException $e) {
        // ロールバック処理
        $dbh->rollback();
        // 例外をスロー
        throw $e;
    }
}

/**
* 特定の商品情報を購入する
*
* @param obj $dbh DBハンドル
* @return mix
*/
function purchase_product($dbh, $data, $user_id, $stock, $amount, $now_date) {

    // トランザクション開始
    $dbh->beginTransaction();

    try {
        // product_idがあるだけfor文
        foreach ($data as $value) {
            $product_id = $value['product_id'];
            // 購入したドリンクの在庫を減らす
            transaction_stock($dbh, $product_id, $stock, $amount, $now_date);
        }
        
        // delete
        cart_delete($dbh, $user_id);
        
        // コミット
        $dbh->commit();
    } catch (PDOException $e) {
        // ロールバック処理
        $dbh->rollback();
        // 例外をスロー
        throw $e;
    }
}

/**
* 数値かチェック
* @param int $number 数値
* @return bool
*/
function check_number($number) {

    if (preg_match('/\A\d+\z/', $number) === 1 ) {
        return true;
    } else {
        return false;
    }
}

/**
* 前後の空白を削除
* @param str $str 文字列
* @return str 前後の空白を削除した文字列
*/
function trim_space($str) {
    return preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $str);
}
