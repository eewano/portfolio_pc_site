<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

$post = sanitize($_POST);

$customer_name = $post['customer_name'];
$customer_email = $post['customer_email'];
$customer_postal_code = $post['customer_postal_code'];
$customer_address = $post['customer_address'];
$customer_tel = $post['customer_tel'];

$okFlag = true;

if ($customer_name == '') {
    $okFlag = false;
}

if (preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/', $customer_email) == 0) {
    $okFlag = false;
}

if (preg_match('/^[0-9]+$/', $customer_postal_code) == 0) {
    $okFlag = false;
}

if ($customer_address == '') {
    $okFlag = false;
}

if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/', $customer_tel) == 0) {
    $okFlag = false;
}

if ($okFlag == false) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

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
    <link rel="stylesheet" href="../css/customer_common.css">
</head>
<body>

    <header>
        <h1 class="header_logo">
            <a href="#">PC e2wn</a>
        </h1>
    </header>

    <button type="button" onclick="myfunc_admin()">
        <img src="../img/menu_icon_open.png" class="img_change" alt="">
    </button>

    <div class="menu_area">
        <ul>
            <li><a href="<?php echo get_url(); ?>/index.php">トップ</a></li>
            <li><a href="#">ログイン</a></li>
            <li><a href="<?php echo get_url(); ?>/customer/customer_cart_look.php">カート</a></li>
            <li><a href="<?php echo get_url(); ?>/admin_login.php">管理者用</a></li>
        </ul>
    </div>

    <div class="top_image_area">
        <img src="../img/header_image01_01.jpg" class="top_image" alt="">
    </div>

    <div class="title_area">
        <h2>PCショップ eewano</h2>
        <h3>以下の内容で送信します。宜しいですか？</h3>
    </div>

    <main>
        <div class="register_area">
            <div class="register_box">
                <p class="item">お名前 :</p>
                <p class="input"><?php echo h01($customer_name); ?></p>
                <p class="item">メールアドレス :</p>
                <p class="input"><?php echo h01($customer_email); ?></p>
                <p class="item">郵便番号 :</p>
                <p class="input"><?php echo h01($customer_postal_code); ?></p>
                <p class="item">住所 :</p>
                <p class="input"><?php echo h01($customer_address); ?></p>
                <p class="item">電話番号 :</p>
                <p class="input"><?php echo h01($customer_tel); ?></p>
            </div>
    
            <form action="<?php echo get_url(); ?>/customer/customer_form_done.php" method="post">
                <input type="hidden" name="customer_name" value="<?php echo h01($customer_name); ?>">
                <input type="hidden" name="customer_email" value="<?php echo h01($customer_email); ?>">
                <input type="hidden" name="customer_postal_code" value="<?php echo h01($customer_postal_code); ?>">
                <input type="hidden" name="customer_address" value="<?php echo h01($customer_address); ?>">
                <input type="hidden" name="customer_tel" value="<?php echo h01($customer_tel); ?>">
                <div class="button_area_double">
                    <input type="button" onclick="history.back()" class="btn_link return" value="1つ前に戻る">
                    <input type="submit" class="btn_link register" value="送信">
                </div>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer_layout">
            <h1>PC e2wn</h1>
            <p class="portfolio_site">eewano Portfolio Site</p>
        </div>
        <p class="copyright">&copy;2020 eewano portfolio</p>
    </footer>


<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>