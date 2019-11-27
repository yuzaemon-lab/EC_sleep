<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>熟睡.com</title>
    <style>
        section {
            margin-bottom: 20px;
            padding-top: 20px;
            border-top: solid 1px;
        }
        table {
            width: 660px;
            border-collapse: collapse;
        }
        table, tr, th, td {
            border: solid 1px;
            padding: 10px;
            text-align: center;
        }
        caption {
            text-align: left;
        }
        .text_align_right {
            text-align: right;
        }
        .name_width {
            width: 100px;
        }
        .input_text_width {
            width: 60px;
        }
        .status_false {
            background-color: #A9A9A9;
        }
    </style>
</head>
<body>
<?php if (empty($result_msg) !== TRUE) { ?>
    <p><?php print $result_msg; ?></p>
<?php } ?>
<?php foreach ($err_msg as $value) { ?>
    <p><?php print $value; ?></p>
<?php } ?>
    <header>
      <div class="d-flex justify-content-between">
        <h1 class="p-2 col-5 mt-3 ml-3">熟睡.com</h1>
        <a href="../../../Jyukusui/logout.php" class="p-2 my-auto mr-3 ml-auto"><button type="button" class="btn btn-outline-dark">ログアウト</button></a>
      </div>
      <hr>
    </header>
    <h2 class="text-center">商品管理ページ</h2>
    <section>
        <h2 class="text-center">新規商品追加</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="text-center"><label>名前: <input type="text" name="new_name" value=""></label></div>
            <div class="text-center"><label>値段: <input type="text" name="new_price" value=""></label></div>
            <div class="text-center"><label>個数: <input type="text" name="new_stock" value=""></label></div>
            <div class="text-center"><input type="file" name="new_img"></div>
            <div class="text-center">
                <select name="new_status">
                    <option value="0">非公開</option>
                    <option value="1">公開</option>
                </select>
            </div>
            <input type="hidden" name="sql_kind" value="insert">
            <div class="text-center"><input type="submit" value=" 商品追加 "></div>
        </form>
    </section>
    <section>
        <h2 class="text-center">商品情報変更</h2>
        <table class="mx-auto">
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>ステータス</th>
                <th>削除</th>
            </tr>
<?php foreach ($data as $value)  { ?>
    <?php if ($value['status'] === '1') { ?>
            <tr>
    <?php } else { ?>
            <tr class="status_false">
    <?php } ?>
                <td><img src="<?php print IMG_DIR . $value['img']; ?>"></td>
                <td class="name_width"><?php print $value['product_name']; ?></td>
                <td class="text_align_right"><?php print $value['price']; ?>円</td>
                <form method="post">
                    <td><input type="text"  class="input_text_width text_align_right" name="update_stock" value="<?php print $value['stock']; ?>">個&nbsp;&nbsp;<input type="submit" value="変更"></td>
                    <input type="hidden" name="product_id" value="<?php print $value['product_id']; ?>">
                    <input type="hidden" name="sql_kind" value="update">
                </form>
                <form method="post">
    <?php if ($value['status'] === '1') { ?>
                    <td><input type="submit" value="公開 → 非公開"></td>
                    <input type="hidden" name="change_status" value="0">
    <?php } else { ?>
                    <td><input type="submit" value="非公開 → 公開"></td>
                    <input type="hidden" name="change_status" value="1">
    <?php } ?>
                    <input type="hidden" name="product_id" value="<?php print $value['product_id']; ?>">
                    <input type="hidden" name="sql_kind" value="change">
                </form>
                <form method="post">
                    <td><input type="submit" value="削除"></td>
                    <input type="hidden" name="product_id" value="<?php print $value['product_id']; ?>">
                    <input type="hidden" name="sql_kind" value="delete">
                </form>
            </tr>
<?php } ?>
        </table>
    </section>
    <footer class="text-center text-muted py-5">
        <hr>
        <a href="../html/userAdmin.php">ユーザー管理</a>
        <div><p>©Jyukusui.com</p></div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
      $(function() {
        'use strict';
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>
</html>