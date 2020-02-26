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

    $product_id = $post['product_id'];
    $product_image = $post['product_image'];

    $dsn = getDBServer();
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'DELETE FROM shop_product WHERE id=?';
    $stmt = $dbh -> prepare($sql);
    $data[] = $product_id;
    $stmt -> execute($data);

    $dbh = null;

    if ($product_image != '') {
        unlink('../img/' . $product_image);
    }
    
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
        <h3>削除しました。</h3>
    </div>

    <main>
        <div class="other_area">
            <a href="admin_top.php" class="btn_link return">管理者トップに戻る</a>
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