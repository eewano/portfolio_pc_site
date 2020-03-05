<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

session_start();
session_regenerate_id(true);

admin_login_register($_SESSION['admin_login']);

$admin_name = $_SESSION['admin_name'];

$err_message = $_SESSION['err_message'];
$inputted_data = $_SESSION['inputted_data'];

$post = sanitize($_POST);
$product_id = $post['product_id'];

if (isset($post['edit']) == true) {
    $_SESSION['err_message'] = $err_message;
    unset($_SESSION['inputted_data']);

    header('Location: ' . get_url() . '/administrator/admin_product_edit.php?product_id=' . $product_id);
    exit();
}

if (isset($post['delete']) == true) {
    header('Location: ' . get_url() . '/administrator/admin_product_delete.php?product_id=' . $product_id);
    exit();
}

?>