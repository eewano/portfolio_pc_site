<?php

require_once('../../method_php/method.php');
require_once('../../method_php/get_user_pass.php');

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
    <title>管理者ページ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/custom_css/index.css">
</head>
<body>

<?php

try {
    $product_id = $_GET['product_id'];

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
    header('Location: ../../site_err.php');
    exit();
}

?>

    <header>
        <div class="container header_area">
            <div class="row">
                <div class="header_logo col-12">
                    <div class="header_logo_area mx-auto my-4 px-4 py-4 text-center text-dark">
                        <p class="h1 font-weight-bold">PC SHOP</p>
                        <p class="h2 font-weight-bold">お値段.co.jp</p>
                    </div>
                </div>
                <div class="header_image_area col-12">
                    <img src="/img/header_image01_01.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <h2 class="col-12 my-5 text-center">管理者 <?php echo h01($admin_name); ?> のページ</h2>
                <h3 class="col-12 text-center">登録商品の詳細及び変更</h3>
                
                <div class="pruduct_area col-12 col-sm-6 col-lg-4">
                    <div class="product_image_area">
                        <?php if ($product_image_old == ''): ?>
                        <img src="/img/no_image.png" class="img-fluid" alt="">
                        <?php else: ?>
                        <img src="/img/<?php echo h01($product_image_old); ?>" class="img-fluid" alt="">
                        <?php endif; ?>
                    </div>
                    <p><?php echo h01($product_id); ?></p>
                    <p><?php echo h01($product_name_old); ?></p>
                    <p><?php echo h01($product_price_old); ?></p>
                    <p><?php echo h01($product_evaluation_old); ?></p>
                    <p><?php echo h01($product_detail_old); ?></p>
                </div>

                <div class="product_edit_area">
                    <form action="admin_product_edit_check.php?product_id=<?php echo h01($product_id); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?php echo h01($product_id); ?>">
                        <input type="hidden" name="product_image_old" value="<?php echo h01($product_image_old); ?>">
                        <p>商品画像</p>
                        <input type="file" name="product_image">
                        <p>商品名</p>
                        <input type="text" name="product_name" value="<?php echo h01($product_name_old); ?>">
                        <p>価格</p>
                        <input type="text" name="product_price" value="<?php echo h01($product_price_old); ?>">
                        <p>評価</p>
                        <input type="text" name="product_evaluation" value="<?php echo h01($product_evaluation_old); ?>">
                        <p>商品の詳細</p>
                        <textarea name="product_detail" cols="20" rows="10"><?php echo h01($product_detail_old); ?></textarea>
                        <input type="button" onclick="history.back()" value="戻る">
                        <input type="submit" value="OK">
                    </form>
                </div>

                <div class="col-12">
                    <a href="admin_logout.php">ログアウト</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container bg-warning mt-5">
            <div class="row py-4">
                <div class="footer_logo col-12 col-md-4">
                    <div class="footer_logo_area mb-4 text-center text-dark">
                        <p class="h3 font-weight-bold">PC SHOP</p>
                        <p class="h4 font-weight-bold">お値段.co.jp</p>
                    </div>
                </div>

                <div class="footer_link col-12 col-md-8">
                    <ul class="list-inline">
                        <li class="list-inline-item mx-0">
                            <a href="" class="nav-link text-dark text-center">トップページ</a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a href="" class="nav-link text-dark text-center">管理者画面</a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a href="" class="nav-link text-dark text-center">登録ユーザー</a>
                        </li>
                        <li class="list-inline-item mx-0">
                            <a href="" class="nav-link text-dark text-center">その他</a>
                        </li>
                    </ul>
                </div>

                <p class="text-center col-12 mb-0">©2020 eewano portfolio</p>
            </div>
        </div>
    </footer>

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>