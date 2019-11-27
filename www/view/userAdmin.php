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
        .user_width, password_width {
            width: 50%;
        }
    </style>

  </head>
  <body>
    <header>
      <div class="d-flex justify-content-between">
        <h1 class="p-2 col-5 mt-3 ml-3">熟睡.com</h1>
        <a href="./logout.php" class="p-2 my-auto mr-3 ml-auto"><button type="button" class="btn btn-outline-dark">ログアウト</button></a>
      </div>
      <hr>
    </header>
    <main>
        <h2 class="text-center">ユーザー管理</h2>
        <section>
        <table class="mx-auto">
            <tr>
                <th>ユーザー名</th>
                <th>パスワード</th>
            </tr>
<?php foreach ($data as $value)  { ?>
            <tr>
                <td class="user_width"><?php print $value['user_name']; ?></td>
                <td class="password_width"><?php print $value['password']; ?></td>
            </tr>
<?php } ?>
        </table>
    </section>
    </main>

    <footer class="text-center text-muted py-5">
        <hr>
        <div>
        <a href="./productAdmin.php">商品管理</a>
        <p>©Jyukusui.com️</p>
        </div>
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