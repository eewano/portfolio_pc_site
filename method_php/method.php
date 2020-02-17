<?php

function h01($string) {
    return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

function h02($string) {
    $yen = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
    return number_format($yen);
}

function sanitize($before) {
    foreach ($before as $key => $value) {
        $after[$key] = htmlspecialchars($value);
    }

    return $after;
}

function admin_login_register($admin_login) {
    if (isset($admin_login) == false) {
        print 'ログインされていません。<br>';
        exit();
    }
}

?>