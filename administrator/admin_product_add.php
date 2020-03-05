<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

session_start();
session_regenerate_id(true);

admin_login_register($_SESSION['admin_login']);

$admin_name = $_SESSION['admin_name'];

$err_message = $_SESSION['err_message'];
$inputted_data = $_SESSION['inputted_data'];

unset($_SESSION['err_message']);
unset($_SESSION['inputted_data']);

?>

<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio PC Site</title>
    <link rel="stylesheet" href="../css/ress.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/admin_common.css">
</head>
<body>

    <header class="admin_mode">
        <h1 class="header_logo">
            <a href="#">PC e2wn</a>
        </h1>
    </header>

    <button type="button" onclick="myfunc_admin()">
        <img src="../img/menu_icon_open.png" class="img_change" alt="">
    </button>

    <div class="menu_area">
        <ul>
            <li><a href="<?php echo get_url(); ?>/administrator/admin_top.php">管理者トップ</a></li>
            <li><a href="<?php echo get_url(); ?>/administrator/admin_product_add.php">商品の追加</a></li>
            <li><a href="<?php echo get_url(); ?>/admin_logout.php">ログアウト</a></li>
        </ul>
    </div>

    <div class="top_image_area">
        <img src="../img/header_image01_01.jpg" class="top_image" alt="">
    </div>

    <div class="admin_mark_area">
        <p>管理者画面（eewano）</p>
    </div>

    <div class="title_area">
        <h2>PCショップ eewano</h2>
        <h3>商品の登録</h3>
    </div>

    <main>
        <form action="<?php echo get_url(); ?>/administrator/admin_product_add_register.php" method="post" enctype="multipart/form-data" class="input_area">
            <p style="margin-bottom: 10px; width: 100%;">商品画像</p>
            <input type="file" name="product_image" style="width: 100%;">
            <p>商品名</p>
            <?php if ($err_message[0] != ''): ?>
                <p class="err_message"><?php echo h01($err_message[0]); ?></p>
            <?php endif; ?>
            <input type="text" name="product_name" class="input_space" style="width: 100%" value="<?php echo h01($inputted_data['inputted_product_name']); ?>">
            <p>販売価格（円）</p>
            <?php if ($err_message[1] != ''): ?>
                <p class="err_message"><?php echo h01($err_message[1]); ?></p>
            <?php endif; ?>
            <input type="text" name="product_price" class="input_space" style="width: 100%" value="<?php echo h01($inputted_data['inputted_product_price']); ?>">
            <p>評価</p>
            <?php if ($err_message[2] != ''): ?>
                <p class="err_message"><?php echo h01($err_message[2]); ?></p>
            <?php endif; ?>
            <input type="text" name="product_evaluation" class="input_space" style="width: 100%" value="<?php echo h01($inputted_data['inputted_product_evaluation']); ?>">
            <p>商品の詳細</p>
            <?php if ($err_message[3] != ''): ?>
                <p class="err_message"><?php echo h01($err_message[3]); ?></p>
            <?php endif; ?>
            <textarea name="product_detail" cols="20" rows="10" class="input_space type_detail" style="width: 100%"><?php echo h01($inputted_data['inputted_product_detail']); ?></textarea>
            <div class="button_area_double">
                <input type="button" onclick="location.href='<?php echo get_url() . '/administrator/admin_top.php'; ?>'" class="btn_link return" value="1つ前に戻る">
                <input type="submit" class="btn_link register" value="確認">
            </div>
        </form>
    </main>

    <footer class="admin_mode">
        <div class="footer_layout">
            <h1>PC e2wn</h1>
            <p class="portfolio_site">eewano Portfolio Site</p>
        </div>
        <p class="copyright">&copy;2020 eewano portfolio</p>
    </footer>


    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>