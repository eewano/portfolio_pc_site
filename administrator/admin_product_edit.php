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

    $product_id = $_GET['product_id'];

try {
    $dsn = 'mysql:dbname=portfolio_pc_shop; host=localhost; charset=utf8';
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT image, name, price, evaluation, detail FROM shop_product WHERE id=?';
    $stmt = $dbh -> prepare($sql);
    $data[] = $product_id;
    $stmt -> execute($data);

    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    $product_image_old = $rec['image'];
    $product_name_old = $rec['name'];
    $product_price_old = $rec['price'];
    $product_evaluation_old = $rec['evaluation'];
    $product_detail_old = $rec['detail'];

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
        <h3>商品ID [ <?php echo h01($product_id); ?> ] の編集</h3>
    </div>

    <main>
        <div class="register_area edit_mode">
            <div class="product_box">
            <?php if ($rec['image'] == ''): ?>
                <img src="../img/no_image.png" alt="">
            <?php else: ?>
                <img src="../img/<?php echo h01($product_image_old); ?>" alt="">
            <?php endif; ?>
                <p class="product_name"><?php echo h01($product_name_old); ?></p>
                <p class="product_price">¥ <?php echo h_price($product_price_old); ?></p>
                <p class="product_evaluation"><?php echo h_evaluation($product_evaluation_old); ?></p>
                <p class="product_review"><?php echo h01($product_detail_old); ?></p>
            </div>
        </div>

        <form action="admin_product_edit_register.php?product_id=<?php echo h01($product_id); ?>" method="post" enctype="multipart/form-data" class="input_area">
            <input type="hidden" name="product_id" value="<?php echo h01($product_id); ?>">
            <input type="hidden" name="product_image_old" value="<?php echo h01($product_image_old); ?>">
            <p style="margin-bottom: 10px; width: 100%;">商品画像</p>
            <input type="file" name="product_image" style="width: 100%">
            <p>商品名</p>
            <input type="text" name="product_name" class="input_space" style="width: 100%" value="<?php echo h01($product_name_old); ?>">
            <p>販売価格（円）</p>
            <input type="text" name="product_price" class="input_space" style="width: 100%" value="<?php echo h01($product_price_old); ?>">
            <p>評価</p>
            <input type="text" name="product_evaluation" class="input_space" style="width: 100%" value="<?php echo h01($product_evaluation_old); ?>">
            <p>商品の詳細</p>
            <textarea name="product_detail" cols="20" rows="10" class="input_space type_detail" style="width: 100%"><?php echo h01($product_detail_old); ?></textarea>
            <div class="button_area">
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