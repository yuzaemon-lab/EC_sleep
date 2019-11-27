<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>熟睡.com</title>

    <style>
        main {
            background: rgb(245, 255, 255);
        }
        .cart_img, .logo_img {
            height: 50px;
            width: auto;
        }
        .product_place {
            width: 200px; /* 変更 */
        }
        .product_img {
            height: 100%;
            width: 100%;
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
            <a href="./index.php" class="p-2">
                <img src="./assets/img/view/EC_logo.png" class="logo_img my-auto mx-2">
            </a>
            <div class="p-2 d-flex flex-row">
                <p class="my-auto mx-2">こんにちわ、<a href=""><?php print $user_name ?></a>さん！</p>
                <a href="./cart.php" class="my-auto">
                    <img src="./assets/img/view/cart.png" class="cart_img" alt="カート画像">
                </a>
                <a href="./logout.php" class="my-auto mx-2">
                    <button type="button" class="btn btn-outline-dark">ログアウト</button>
                </a>
            </div>
        </div>
        <hr class="mt-0 mb-1">
    </header>
    <main class="pb-3">
        <h3 class="text-center py-3">商品一覧</h3>
        <section class="w-75 mx-auto">
<?php if (count($err_msg) === 0) { ?>
            <div class="d-flex justify-content-center">
    <?php foreach ($data as $value) { ?>
        <?php if ($value['status'] === '1') { ?>
                <div class="d-flex flex-column mx-4">
                    <div class="product_place">
                        <img src="<?php print IMG_DIR . $value['img']; ?>" class="product_img">
                    </div>
                    <div class="text-center"><?php print $value['product_name']; ?></div>
                    <div class="text-center"><?php print $value['price']; ?>円</div>
            <?php if ($value['stock'] > 0) { ?>
                    <div class="text-center">
                        <form method="post">
                            <input type="submit" value=" カートに入れる ">
                            <input type="hidden" name="product_id" value="<?php print $value['product_id']; ?>">
                        </form>
                    </div>
            <?php } else { ?>
                    <div class="text-danger text-center">売り切れ</div>
            <?php } ?>
                </div>
        <?php } ?>
    <?php } ?>
            </div>
<?php } else { ?>
    <?php foreach ($err_msg as $value) { ?>
            <p><?php print $value; ?></p>
    <?php } ?>
<?php } ?>
        </section>
    </main>
    
    <footer>
        <hr class="mt-1 mb-3">
        <div class="text-center">©Jyukusui.com</div>
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