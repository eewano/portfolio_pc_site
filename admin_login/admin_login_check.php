<?php

require_once('../method_php/method.php');

try {
    $post = sanitize($_POST);
    $admin_name = $post['admin_name'];
    $admin_pass = $post['admin_pass'];

    $dsn = 'mysql:dbname=portfolio_pc_shop; host=localhost; charset=utf8';
    $user = '';
    $password = '';
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

    if (password_verify($admin_pass, $pass)) {
        session_start();
        $_SESSION['admin_login'] = 1;
        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_name'] = $admin_name;
        header('Location: ./admin_success/admin_top.php');
        exit();

    } else {
        header('Location: ../admin_login.php');
        exit();
    }
    
} catch (Exception $e) {
    header('Location: ../site_err.php');
	exit();
}

?>