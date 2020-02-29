<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

session_start();
session_regenerate_id(true);

$post = sanitize($_POST);

$cart_max = $post['cart_max'];

print '$cart_max = ' . $cart_max;
print '<br>';

for ($i = 0; $i < $cart_max; $i++) {
    $quantity[] = $post['quantity' . $i];
}

$cart = $_SESSION['cart'];

for ($i = $cart_max; 0 <= $i; $i--) {
    if ($quantity[$i] == 0) {
        array_splice($cart, $i, 1);
        array_splice($quantity, $i, 1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['quantity'] = $quantity;

header('Location: ' . get_url() . '/customer/customer_cart_look.php');
exit();

?>