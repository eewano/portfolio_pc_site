<?php

require_once('../method_php/method.php');
require_once('../method_php/get_user_pass.php');

session_start();
session_regenerate_id(true);

admin_login_register($_SESSION['admin_login']);

$admin_name = $_SESSION['admin_name'];

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

<?php

try {
    $post = sanitize($_POST);

    $product_image = $post['product_image'];
    $product_name = $post['product_name'];
    $product_price = $post['product_price'];
    $product_evaluation = $post['product_evaluation'];
    $product_detail = $post['product_detail'];

    $dsn = 'mysql:dbname=portfolio_pc_shop; host=localhost; charset=utf8';
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO shop_product (image, name, price, evaluation, detail) VALUES (?, ?, ?, ?, ?)';
    $stmt = $dbh -> prepare($sql);
    $data[] = $product_image;
    $data[] = $product_name;
    $data[] = $product_price;
    $data[] = $product_evaluation;
    $data[] = $product_detail;
    $stmt -> execute($data);

    $dbh = null;

} catch (Exception $e) {
    header('Location: ../site_err.php');
	exit();
}

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
        <h3>下記商品を登録しました。</h3>
    </div>

    <main>
        <div class="register_area">
            <div class="product_box">
                <img src="../img/<?php echo h01($product_image); ?>" alt="" class="product_image">
                <p class="product_name"><?php echo h01($product_name); ?></p>
                <p class="product_price">¥ <?php echo h_price($product_price); ?></p>
                <p class="product_evaluation"><?php echo h_evaluation($product_evaluation); ?></p>
                <p class="product_review"><?php echo h01($product_detail); ?></p>
            </div>
            <a href="admin_top.php" class="btn_link return_to_top">管理者トップに戻る</a>
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