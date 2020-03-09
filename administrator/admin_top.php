<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

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

    $err_message = array_fill(0, 4, '');
    $inputted_data = array_fill(0, 4, '');
    $_SESSION['err_message'] = $err_message;
    $_SESSION['inputted_data'] = $inputted_data;

} catch (Exception $e) {
    header('Location: ' . get_url() . '/site_err.php');
	exit();
}

?>

    <header class="admin_mode">
        <h1 class="header_logo">
            <a href="#">PC e2wn</a>
        </h1>
    </header>

    <button type="button" onclick="myfunc_admin()">
        <img src="../img/menu_icon_open.png" class="img_change" alt="">
    </button>

    <div class="menu_area">
        <ul>
            <li><a href="<?php echo get_url(); ?>/administrator/admin_top.php">管理者トップ</a></li>
            <li><a href="<?php echo get_url(); ?>/administrator/admin_product_add.php">商品の追加</a></li>
            <li><a href="<?php echo get_url(); ?>/admin_logout.php">ログアウト</a></li>
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
        <?php if ($row_count == 0): ?>
        <h3>まだ商品は登録されていません。</h3>
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
            <div class="product_box">
            <?php if ($rec['image'] == ''): ?>
                <img src="../img/no_image.png" alt="">
            <?php else: ?>
                <img src="../img/<?php echo $rec['image']; ?>" alt="">
            <?php endif; ?>
                <div class="name_price_review">
                    <p class="product_name"><?php echo h01($rec['name']); ?></p>
                    <p class="product_price">¥ <?php echo h_price($rec['price']); ?></p>
                    <p class="product_evaluation"><?php echo h_evaluation($rec['evaluation']); ?></p>
                    <p class="product_review txt_hide"><?php echo h01($rec['detail']); ?></p>
                </div>
                <div class="button_area">
                    <form action="<?php echo get_url(); ?>/administrator/admin_product_branch.php" method="post" class="button_area_double">
                        <input type="hidden" name="product_id" value="<?php echo h01($rec['id']); ?>">
                        <input type="submit" name="edit" class="btn_link modify" value="修正">
                        <input type="submit" name="delete" class="btn_link delete" value="削除">
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </main>

    <footer class="admin_mode">
        <div class="footer_layout">
            <h1>PC e2wn</h1>
            <p class="portfolio_site">eewano Portfolio Site</p>
        </div>
        <p class="copyright">&copy;2020 eewano portfolio</p>
    </footer>


    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>