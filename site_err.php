<?php

require_once(__DIR__ . '/method_php/method.php');
require_once(__DIR__ . '/method_php/get_user_pass.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio PC Site</title>
    <link rel="stylesheet" href="css/ress.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/other_page.css">
</head>
<body>

    <header>
        <h1 class="header_logo">
            <a href="#">PC e2wn</a>
        </h1>
    </header>

    <button type="button" onclick="myfunc()">
        <img src="img/menu_icon_open.png" class="img_change" alt="">
    </button>

    <div class="menu_area">
        <ul>
            <li><a href="<?php echo get_url(); ?>/index.php">トップ</a></li>
            <li><a href="#">ログイン</a></li>
            <li><a href="<?php echo get_url(); ?>/customer/customer_cart_look.php">カート</a></li>
            <li><a href="<?php echo get_url(); ?>/admin_login.php">管理者用</a></li>
        </ul>
    </div>

    <nav class="top_image_area">
        <img src="img/header_image01_01.jpg" class="top_image" alt="">
    </nav>

    <div class="title_area">
        <h3>予期せぬエラー</h3>
        <p>ただいま障害により大変ご迷惑をお掛けしております。</p>
        <a href="<?php echo get_url(); ?>/index.php" class="btn_link">サイトトップに戻る</a>
    </div>

    <footer>
        <div class="footer_layout">
            <h1>PC e2wn</h1>
            <p class="portfolio_site">eewano Portfolio Site</p>
        </div>
        <p class="copyright">&copy;2020 eewano portfolio</p>
    </footer>
    

    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>