<?php
$signal = '';
$msg = "";
if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != '' || $password != '') {
        $query = "SELECT * FROM tbl_users WHERE user_name='" . $username . "'";
        $exe = $conn->query($query);
        while ($user = $exe->fetch_array()) {
            $admin = $user['user_name'];
            $pass = $user['user_pass'];
        }
        if ($username == $admin) {
            if (md5($password) == $pass) {
                $signal = "ok";
                $_SESSION['site_id'] = '1';
                $msg = "Welcome! " . $admin . " to the site.";
            } else {
                $signal = "bad";
                $msg = "Wrong Password.";
            }
        } else {
            $signal = "bad";
            $msg = "Invalid username.";
        }
    } else {
        $signal = "bad";
        $msg = "Please fill in all the fields.";
    }
    $_SESSION['signal'] = $signal;
    $_SESSION['msg'] = $msg;
    if ($_SESSION['signal'] == 'ok') {
        header('Location: ' . $path);
        die();
    }
}
if (isset($_POST['signup_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    if ($username != '' || $password != '' || $conf_password != '') {
        if ($password == $conf_password) {
            $pass = md5($password);
            $query = "INSERT INTO tbl_users (user_name, user_pass) VALUES ('" . $username . "','" . $pass . "')";
            if ($conn->query($query) == true) {
                $signal = "ok";
                $msg = "User created successfully";
            }
        } else {
            $signal = "bad";
            $msg = "Password confirmation did not match.";
        }
    } else {
        $signal = "bad";
        $msg = "Please fill in all the fields.";
    }
    $_SESSION['signal'] = $signal;
    $_SESSION['msg'] = $msg;
    if ($_SESSION['signal'] == 'ok') {
        header('Location: ' . $path . 'index.php?page=authentication');
        die();
    }
}
