<?php

require_once(__DIR__ . '/../method_php/method.php');
require_once(__DIR__ . '/../method_php/get_user_pass.php');

try {
    $post = sanitize($_POST);
    $admin_name = $post['admin_name'];
    $admin_pass = $post['admin_pass'];

    $dsn = getDBServer();
    $user = getDBUser();
    $password = getDBPass();
    $dbh = new PDO($dsn, $user, $password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT id, password FROM administrator WHERE name=:name;';
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindParam(':name', $admin_name);
    $stmt -> execute();
    
    while ($row = $stmt -> fetch()) {
        $admin_id = $row['id'];
        $pass = $row['password'];
    }

    $dbh = null;

    session_start();

    if (password_verify($admin_pass, $pass)) {
        $_SESSION['admin_login'] = 1;
        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        header('Location: ' . get_url() . '/administrator/admin_top.php');
        exit();

    } else {
        $_SESSION['err_message'] = '※管理者名もしくはパスワードが間違っています。';
        header('Location: ' . get_url() . '/admin_login.php');
        exit();
    }
    
} catch (Exception $e) {
    header('Location: ' . get_url() . '/site_err.php');
	exit();
}

?>