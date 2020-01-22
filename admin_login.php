<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="custom_css/index.css">
</head>
<body>

    <header>
        <div class="container header_area">
            <div class="row">
                <div class="header_logo col-12">
                    <div class="header_logo_area mx-auto my-4 px-4 py-4 text-center text-dark">
                        <p class="h1 font-weight-bold">PC SHOP</p>
                        <p class="h2 font-weight-bold">お値段.co.jp</p>
                    </div>
                </div>
                <div class="header_list_area col-12">
                    <ul class="list-inline">
                        <li class="list-inline-item mx-0 text-center">
                            <a href="/index.php" class="nav-link text-dark">トップページ</a>
                        </li>
                        <li class="list-inline-item mx-0 text-center">
                            <a href="" class="nav-link text-dark">管理者画面</a>
                        </li>
                        <li class="list-inline-item mx-0 text-center">
                            <a href="" class="nav-link text-dark">登録ユーザー</a>
                        </li>
                        <li class="list-inline-item mx-0 text-center">
                            <a href="" class="nav-link text-dark">その他</a>
                        </li>
                    </ul>
                </div>
                <div class="header_image_area col-12">
                    <img src="img/header_image01_01.jpg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="warning_area col-12">
                    <p class="mx-3 my-5 text-danger font-weight-bold">※当Webサイトはeewanoのポートフォリオサイトとなっております。商品の選択から購入までの手続きのシミュレーションを行えますが、実際の購入及びメールの送信等は出来ませんのでご了承下さい。</p">
                </div>

                <h3 class="col-12 my-5 text-center">管理者ログインページ</h3>

                <div class="admin_input_area col-12">
                    <div class="admin_input_area_inner">
                        <form action="/admin_login/admin_login_check.php" method="post">
                            <p>管理者名</p>
                            <input type="text" name="admin_name">
                            <p>パスワード</p>
                            <input type="password" name="admin_pass">
                            <input type="submit" value="ログイン">
                        </form>
                    </div>
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
                        <a href="/index.php" class="nav-link text-dark text-center">トップページ</a>
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