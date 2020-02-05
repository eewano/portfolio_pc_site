<?php

require_once('../../method_php/method.php');

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
    $dsn = 'mysql:dbname=portfolio_pc_shop; host=localhost; charset=utf8';
    $user = '';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT id, image, name, price, evaluation, detail FROM shop_product WHERE 1';
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

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
                <div class="col-12">
                    <a href="admin_product_add.php">商品の登録</a>
                </div>
                <h3 class="col-12 text-center">登録商品一覧</h3>

                <?php while (true): ?>
                <?php $rec = $stmt -> fetch(PDO::FETCH_ASSOC); ?>
                <?php if ($rec == false): ?>
                <?php break; ?>
                <?php endif; ?>
                    <div class="pruduct_area col-12 col-sm-6 col-lg-4">
                        <div class="product_area_inner border mb-4 px-3 py-3">
                            <img src="/img/<?php echo $rec['image']; ?>" class="img-fluid" alt="">
                            <p class="product_name pt-3"><?php echo $rec['name']; ?></p>
                            <p class="product_price mb-0 text-danger font-weight-bold"><?php echo $rec['price']; ?></p>
                            <p class="evaluation text-warning"><?php echo $rec['evaluation']; ?></p>
                            <p class="product_review"><?php echo $rec['detail']; ?></p>
                        </div>

                        <form action="admin_product_branch.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $rec['id']; ?>">
                            <input type="submit" name="edit" value="参照及び修正">
                            <input type="submit" name="delete" value="削除">
                        </form>
                    </div>
                <?php endwhile; ?>

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