<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

session_start();
session_regenerate_id(true);

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

<?php

try {
    $product_id = $_GET['product_id'];

    if (isset($_SESSION['cart']) == true) {
        $cart = $_SESSION['cart'];
        $quantity = $_SESSION['quantity'];

        if (in_array($product_id, $cart) == true) {
            header('Location: ' . get_url() . '/customer/customer_product_select.php?product_id=' . $product_id . '');
            exit();
        }
    }

    $cart[] = $product_id;
    $quantity[] = 1;
    $_SESSION['cart'] = $cart;
    $_SESSION['quantity'] = $quantity;

    $dsn = getDBServer();
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT image, name, price, evaluation, detail FROM shop_product WHERE id=?';
    $stmt = $dbh -> prepare($sql);
    $data[] = $product_id;
    $stmt -> execute($data);

    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    $product_image = $rec['image'];
    $product_name = $rec['name'];
    $product_price = $rec['price'];
    $product_evaluation = $rec['evaluation'];
    $product_detail = $rec['detail'];

    $dbh = null;

} catch (Exception $e) {
    header('Location: ' . get_url() . '/site_err.php');
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
        <h3>下記商品をカートに追加しました。</h3>
    </div>

    <main>
        <div class="product_pickup_area">
            <div class="product_box">
            <?php if ($product_image == ''): ?>
                <img src="../img/no_image.png" alt="">
            <?php else: ?>
                <img src="../img/<?php echo h01($product_image); ?>" alt="">
            <?php endif; ?>
                <p class="product_name"><?php echo h01($product_name); ?></p>
                <p class="product_price">¥ <?php echo h_price($product_price); ?></p>
                <p class="product_evaluation"><?php echo h_evaluation($product_evaluation); ?></p>
                <p class="product_review"><?php echo h01($product_detail); ?></p>
            </div>
        </div>
        <div class="other_area">
            <a href="<?php echo get_url(); ?>/index.php" class="btn_link return">トップに戻る</a>
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