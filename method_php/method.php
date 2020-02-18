<?php

function h01($string) {
    return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

function h_price($string) {
    $yen = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
    return number_format($yen);
}

function h_evaluation($val) {
    if ($val > 7 || $val < 1) {
        return '評価エラー';
    }

    $string = '';
    $count = 0;

    for ($i = 0; $i < $val; $i++) {
        $string .= '★';
        $count++;
    }

    for ($j = 0; $j < 7 - $val; $j++) {
        $string .= '☆';
    }

    return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

function sanitize($before) {
    foreach ($before as $key => $value) {
        $after[$key] = htmlspecialchars($value);
    }

    return $after;
}

function admin_login_register($admin_login) {
    if (isset($admin_login) == false) {
        header('Location: /index.php');
        exit();
    }
}

?>