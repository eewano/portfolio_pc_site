<?php

require_once('method_php/method.php');
require_once('method_php/get_user_pass.php');

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
    <link rel="stylesheet" href="css/ress.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php

try {
    $dsn = getDBServer();
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT id, image, name, price, evaluation, detail FROM shop_product WHERE 1';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

    $row_count = $dbh -> query($sql) -> rowCount();

    $dbh = null;

    if (isset($_SESSION['cart']) == true) {
        $cart = $_SESSION['cart'];
        $quantity = $_SESSION['quantity'];
    }

} catch (Exception $e) {
    header('Location: site_err.php');
	exit();
}

?>

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
            <li><a href="index.php">トップ</a></li>
            <li><a href="#">ログイン</a></li>
            <li><a href="customer/customer_cart_look.php">カート</a></li>
            <li><a href="admin_login.php">管理者用</a></li>
        </ul>
    </div>

    <div class="top_image_area">
        <img src="img/header_image01_01.jpg" class="top_image" alt="">
    </div>

    <div class="title_area">
        <p class="caution">※当Webサイトはeewanoのポートフォリオサイトとなっております。商品の選択から購入までの手続きのシミュレーションを行えますが、実際の購入及びメールの送信等は出来ませんのでご了承下さい。</p>
        <h2>PCショップ eewano</h2>
        <?php if ($row_count == 0): ?>
        <h3>現在、商品は取り扱っておりません。</h3>
        <?php else: ?>
        <h3>登録商品一覧</h3>
        <?php endif; ?>
    </div>

    <main>
        <div class="product_list_area">
        <?php while (true): ?>
        <?php $rec = $stmt -> fetch(PDO::FETCH_ASSOC); ?>
        <?php if ($rec == false): ?>
        <?php break; ?>
        <?php endif; ?>
            <a href="customer/customer_product_select.php?product_id=<?php echo $rec['id']; ?>" class="product_box">
            <?php if (in_array($rec['id'], $cart) == true): ?>
                <img src="img/cart_logo01.png" alt="" class="already_cartin">
            <?php endif; ?>
            <?php if ($rec['image'] == ''): ?>
                <img src="img/no_image.png" alt="">
            <?php else: ?>
                <img src="img/<?php echo $rec['image']; ?>" alt="">
            <?php endif; ?>
                <p class="product_name"><?php echo h01($rec['name']); ?></p>
                <p class="product_price">¥ <?php echo h_price($rec['price']); ?></p>
                <p class="product_evaluation"><?php echo h_evaluation($rec['evaluation']); ?></p>
                <p class="product_review txt_hide"><?php echo h01($rec['detail']); ?></p>
            </a>
        <?php endwhile; ?>
        </div>
    </main>

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
