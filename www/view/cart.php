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
        .input_text_width {
            width: 75px;
        }
        .text_align_right {
            text-align: right;
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
        <h3 class="text-center py-3"><?php print $user_name ?>さんのカート</h3>
        <section class="w-75 mx-auto">
<?php if (count($err_msg) === 0) { ?>
<?php $sum = 0; ?>
        <div class="d-flex flex-column">
    <?php foreach ($data as $value)  { ?>
            <div class="d-flex justify-content-center mb-3">
                <div class="product_place mr-4">
                    <img src="<?php print IMG_DIR . $value['img']; ?>" class="product_img">
                </div>
                <div class="product_info d-flex flex-column">
                    <div class="mb-2"><?php print $value['product_name']; ?></div>
                    <div class="mb-2">単価：<?php print $value['price']; ?>円</div>
                    <form method="post" class="mb-2">
                        <input type="text" class="input_text_width text_align_right"  name="update_amount" value="<?php print $value['amount']; ?>">個&nbsp;&nbsp;
                        <input type="submit" value="変更">
                        <input type="hidden" name="cart_id" value="<?php print $value['cart_id']; ?>">
                        <input type="hidden" name="sql_kind" value="update">
                    </form>
                    <form method="post" class="mb-2">
                        <input type="submit" value="削除">
                        <input type="hidden" name="cart_id" value="<?php print $value['cart_id']; ?>">
                        <input type="hidden" name="sql_kind" value="delete">
                    </form>
                    <div>¥：<?php print $value['price'] * $value['amount']; ?></div>
                </div>
            </div>
<?php $sum += $value['price'] * $value['amount']; ?>
    <?php } ?>
        </div>
<?php } else { ?>
    <?php foreach ($err_msg as $value) { ?>
        <p><?php print $value; ?></p>
    <?php } ?>
<?php } ?>
        <hr>
        <div class="text-center mb-3">合計：<?php print $sum; ?> 円</div>
        <div class="text-center">
            <a href="../html/purchase.php" class="my-auto mx-auto">
                <button type="button" class="btn btn-outline-dark">購入する</button>
            </a>
        </div>
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