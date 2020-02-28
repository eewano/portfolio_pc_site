<?php

require_once('../method_php/method.php');
require_once('../method_php/get_user_pass.php');

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
    if (isset($_SESSION['cart']) == true) {
        $cart = $_SESSION['cart'];
        $quantity = $_SESSION['quantity'];
        $cart_max = count($cart);
    } else {
        $cart_max = 0;
    }

    $dsn = getDBServer();
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($cart as $key => $val) {
        $sql = 'SELECT image, name, price FROM shop_product WHERE id=?';
        $stmt = $dbh -> prepare($sql);
        $data[0] = $val;
        $stmt -> execute($data);

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        $product_image[] = $rec['image'];
        $product_name[] = $rec['name'];
        $product_price[] = $rec['price'];
    }

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
            <li><a href="../index.php">トップ</a></li>
            <li><a href="#">ログイン</a></li>
            <li><a href="customer_cart_look.php">カート</a></li>
            <li><a href="../admin_login.php">管理者用</a></li>
        </ul>
    </div>

    <div class="top_image_area">
        <img src="../img/header_image01_01.jpg" class="top_image" alt="">
    </div>

    <div class="title_area">
        <h2>PCショップ eewano</h2>
        <?php if ($cart_max == 0): ?>
        <h3>現在、カートは空です。</h3>
        <?php else: ?>
        <h3>カートに入った商品一覧</h3>
        <?php endif; ?>
    </div>

    <?php if ($cart_max == true): ?>
    <main>
        <div class="cart_list_area">
            <form action="customer_cart_change.php" method="post">
            <?php for ($i = 0; $i < $cart_max; $i++): ?>
                <div class="cart_box">
                <?php if ($product_image[$i] == ''): ?>
                    <img src="../img/no_image.png" class="product_image" alt="">
                <?php else: ?>
                    <img src="../img/<?php echo h01($product_image[$i]); ?>" class="product_image" alt="">
                <?php endif; ?>
                    <p class="product_name"><?php echo h01($product_name[$i]); ?></p>
                    <p class="product_price">¥ <?php echo h_price($product_price[$i]); ?></p>
                </div>
                <div class="calc_area">
                    <p class="txt_quantity">購入数 : </p>
                    <p>
                        <select name="quantity<?php echo $i; ?>" class="select_number" onchange="this.form.submit()">
                        <?php for ($j = 0; $j < 10; $j++): ?>
                            <option value="<?php echo $j; ?>"<?php if ($j == $quantity[$i]) { echo ' selected'; }?>><?php if ($j == 0) { echo $j . '（削除）'; } else { echo $j; }  ?></option>
                        <?php endfor; ?>
                    </select> 個
                    </p>
                    <p class="product_price">¥ <?php echo h_price($quantity[$i] * $product_price[$i]); ?></p>
                    <input type="hidden" name="cart_max" value="<?php echo $cart_max; ?>">
                </div>
            <?php endfor; ?>
            </form>
        </div>
        <div class="other_area">
            <h3>以上の内容で購入手続き致します。宜しいですか？</h3>
            <a href="customer_form.php" class="btn_link btn_long register">ご購入手続きへ進む</a>
            <a href="../index.php" class="btn_link btn_long return">トップに戻る</a>
        </div>
    </main>
    <?php endif; ?>

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