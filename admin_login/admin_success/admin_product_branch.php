<?php

require_once('../../method_php/method.php');

session_start();
session_regenerate_id(true);

admin_login_register($_SESSION['admin_login']);

$admin_name = $_SESSION['admin_name'];



$post = sanitize($_POST);
$product_id = $post['product_id'];

if (isset($post['edit']) == true) {
    header('Location: admin_product_edit.php?product_id=' . $product_id);
    exit();
}

if (isset($post['delete']) == true) {
    header('Location: admin_product_delete.php?product_id=' . $product_id);
    exit();
}

?>