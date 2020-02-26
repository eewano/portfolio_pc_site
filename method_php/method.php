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

function getEmailTxt01($name, $postal_code, $address) {
    $text = "";
    $text .= $name . "様\n\nこの度は当サイトにてお買い物シミュレーションを実施頂き、誠にありがとうございます。\n\n";
    $text .= "ご注文頂いた商品は、以下の住所に発送させて頂きます。\n\n";
    $text .= "〒 " . $postal_code . "\n";
    $text .= $address . "\n\n";
    $text .= "【ご注文商品】\n";
    $text .= "--------------------------------------------------\n";

    return $text;
}

function getEmailTxt02($name) {
    $text = "\n";
    $text .= "送料は無料です。\n";
    $text .= "--------------------------------------------------\n\n";
    $text .= "以上でシミュレーションは終了です。" . $name . "様、本日はどうもありがとうございました。\n";

    return $text;
}

?>