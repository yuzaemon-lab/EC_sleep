<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>熟睡.com</title>

    <style>
        body {
            background: url(../../../Jyukusui/img/view/full_screen.jpg);
            min-height: 800px;
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            padding: 15% 10%;
        }
        .btn {
        border: solid 1px;
        margin-bottom: 10px;
        }
        hr, h2 {
        margin: 10px;
        }
    </style>
  </head>
  <body>
    <header>
      <h2 class="text-center">熟睡.com</h2>
    </header>
    <main>
      <p class="text-center">登録が必要です。</p>
<?php foreach($err_msg as $value) { ?>
      <div class="text-center text-danger"><?php print $value; ?></div>
<?php } ?>
      <form method="post" enctype="multipart/form-data">
        <div class="text-center"><label>ユーザー名: <input type="text" name="user_name" value=""></label></div>
        <div class="text-center"><label>パスワード: <input type="password" name="password" value=""></label></div>
        <input type="hidden" name="sql_kind" value="insert">
        <div class="text-center"><input type="submit" value="新規登録"></div>
      </form>
      <hr>
      <p class="text-center">登録済みの場合は、以下リンクを参照ください。</p>
      <div class="text-center">
        <a href="./login.php" class="my-auto mr-0 ml-3"><button type="button" class="btn btn-outline-dark">ログインページへ</button></a>
      </div>
    </main>


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