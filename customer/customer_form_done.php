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
    $post = sanitize($_POST);
    
    $customer_name = $post['customer_name'];
    $customer_email = $post['customer_email'];
    $customer_postal_code = $post['customer_postal_code'];
    $customer_address = $post['customer_address'];
    $customer_tel = $post['customer_tel'];

    $cart = $_SESSION['cart'];
    $quantity = $_SESSION['quantity'];
    $cart_max = count($cart);

    $dsn = 'mysql:dbname=portfolio_pc_shop; host=localhost; charset=utf8';
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for ($i = 0; $i < $cart_max; $i++) {
        $sql = 'SELECT image, name, price FROM shop_product WHERE id=?';
        $stmt = $dbh -> prepare($sql);
        $data[0] = $cart[$i];
        $stmt -> execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $product_image = $rec['image'];
        $product_name = $rec['name'];
        $product_price = $rec['price'];
        $total_price[] = $product_price;
        $total_quantity = $quantity[$i];
        $sub_total = $product_price * $total_quantity;
    }

    $sql = 'LOCK TABLES order_from_customer WRITE, order_product WRITE';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

    $sql = 'INSERT INTO order_from_customer (member_id, customer_name, customer_email, customer_postal_code, customer_address, customer_phone_number) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $dbh -> prepare($sql);
    $data = array();
    $data[] = 0;
    $data[] = $customer_name;
    $data[] = $customer_email;
    $data[] = $customer_postal_code;
    $data[] = $customer_address;
    $data[] = $customer_tel;
    $stmt -> execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    $last_id = $rec['LAST_INSERT_ID()'];

    for ($i = 0; $i < $cart_max; $i++) {
        $sql = 'INSERT INTO order_product (order_id, product_id, price, quantity) VALUES (?, ?, ?, ?)';
        $stmt = $dbh -> prepare($sql);
        $data = array();
        $data[] = $last_id;
        $data[] = $cart[$i];
        $data[] = $total_price[$i];
        $data[] = $quantity[$i];
        $stmt -> execute($data);
    }

    $sql = 'UNLOCK TABLES';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

    $dbh = null;

    if (isset($_COOKIE[session_name()]) == true) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    
    session_destroy();

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
        <h3>ご注文ありがとうございます。</h3>
        <p><?php echo h01($customer_email); ?> にメールを送りましたのでご確認下さい。</p>
    </div>

    <main>
        <div class="other_area">
            <a href="../index.php" class="btn_link return">トップに戻る</a>
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