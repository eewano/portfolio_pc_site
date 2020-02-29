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

<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

?>

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
        <h3>お客様情報を入力して下さい。</h3>
    </div>

    <main>
        <form action="<?php echo get_url(); ?>/customer/customer_form_check.php" method="post" class="input_area">
            <p>お名前（ペンネーム）</p>
            <input type="text" name="customer_name" class="input_space" style="width: 100%">
            <p>メールアドレス（フィクション）</p>
            <input type="text" name="customer_email" class="input_space" style="width: 100%">
            <p>郵便番号（フィクション）</p>
            <input type="text" name="customer_postal_code" class="input_space" style="width: 100%">
            <p>住所（フィクション）</p>
            <input type="text" name="customer_address" class="input_space" style="width: 100%">
            <p>電話番号（フィクション）</p>
            <input type="text" name="customer_tel" class="input_space" style="width: 100%">
            <div class="button_area_double">
                <input type="button" onclick="history.back()" class="btn_link return" value="1つ前に戻る">
                <input type="submit" class="btn_link register" value="確認">
            </div>
        </form>
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