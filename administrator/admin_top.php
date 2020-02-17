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
    <link rel="stylesheet" href="/css/ress.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/admin_common.css">
</head>
<body>

<?php

try {
    $dsn = 'mysql:dbname=portfolio_pc_shop; host=localhost; charset=utf8';
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT id, image, name, price, evaluation, detail FROM shop_product WHERE 1';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

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
            <li><a href="./admin_product_add.php">商品の追加</a></li>
            <li><a href="./admin_logout.php">ログアウト</a></li>
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
        <h3>登録商品一覧</h3>
    </div>

    <main>
        <div class="product_area">
        <?php while (true): ?>
        <?php $rec = $stmt -> fetch(PDO::FETCH_ASSOC); ?>
        <?php if ($rec == false): ?>
        <?php break; ?>
        <?php endif; ?>
            <div class="product_box">
            <?php if ($rec['image'] == ''): ?>
                <img src="/img/no_image.jpg" alt="" class="product_image">
            <?php else: ?>
                <img src="/img/<?php echo $rec['image']; ?>" alt="" class="product_image">
            <?php endif; ?>
                <p class="product_name"><?php echo h01($rec['name']); ?></p>
                <p class="product_price">¥ <?php echo h02($rec['price']); ?></p>
                <p class="product_evaluation"><?php echo h01($rec['evaluation']); ?></p>
                <p class="product_review"><?php echo h01($rec['detail']); ?></p>
                <form action="admin_product_branch.php" method="post" class="button_area">
                    <input type="hidden" name="product_id" value="<?php echo h01($rec['id']); ?>">
                    <input type="submit" name="edit" class="btn_link modify" value="修正">
                    <input type="submit" name="delete" class="btn_link delete" value="削除">
                </form>
            </div>
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


    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>