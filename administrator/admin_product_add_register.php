<?php

require_once('../method_php/method.php');

session_start();
session_regenerate_id(true);

admin_login_register($_SESSION['admin_login']);

$admin_name = $_SESSION['admin_name'];



$post = sanitize($_POST);

$product_image = $_FILES['product_image'];
$product_name = $post['product_name'];
$product_price = $post['product_price'];
$product_evaluation = $post['product_evaluation'];
$product_detail = $post['product_detail'];

$okFlag = true;

if ($product_image['size'] > 0) {
    if ($product_image['size'] > 1000000) {
        $okFlag = false;
    }
}

if ($product_name == '') {
    $okFlag = false;
}

if (preg_match('/^[0-9]+$/', $product_price) == 0) {
    $okFlag = false;
}

if (preg_match('/^([1-7]{1})$/', $product_evaluation) == 0) {
    $okFlag = false;
}

if ($product_detail == '') {
    $okFlag = false;
}

if ($okFlag == false) {
    header("location: javascript://history.go(-1)");
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
    <link rel="stylesheet" href="../css/admin_common.css">
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
            <li><a href="admin_product_add.php">商品の追加</a></li>
            <li><a href="../admin_logout.php">ログアウト</a></li>
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
        <h3>以下の商品を登録します。<br>
            宜しいですか？</h3>
    </div>

    <main>
        <div class="product_pickup_area">
            <div class="product_box">
            <?php if ($product_image['name'] == ''): ?>
                <img src="../img/no_image.png" alt="">
            <?php else: ?>
                <?php move_uploaded_file($product_image['tmp_name'], '../img/' . $product_image['name']); ?>
                <img src="../img/<?php echo h01($product_image['name']); ?>" alt="">
            <?php endif; ?>
                <p class="product_name"><?php echo h01($product_name); ?></p>
                <p class="product_price">¥ <?php echo h_price($product_price); ?></p>
                <p class="product_evaluation"><?php echo h_evaluation($product_evaluation); ?></p>
                <p class="product_review"><?php echo h01($product_detail); ?></p>
            </div>
            <form action="admin_product_add_done.php" method="post">
                <input type="hidden" name="product_image" value="<?php echo h01($product_image['name']); ?>">
                <input type="hidden" name="product_name" value="<?php echo h01($product_name); ?>">
                <input type="hidden" name="product_price" value="<?php echo h01($product_price); ?>">
                <input type="hidden" name="product_evaluation" value="<?php echo h01($product_evaluation); ?>">
                <input type="hidden" name="product_detail" value="<?php echo h01($product_detail); ?>">
                <div class="button_area_double">
                    <input type="button" onclick="history.back()" class="btn_link return" value="1つ前に戻る">
                    <input type="submit" class="btn_link register" value="登録">
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