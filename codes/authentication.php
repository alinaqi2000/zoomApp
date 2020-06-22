<?php
if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_id = "";
    $msg = new message();
    if ($username != '' || $password != '') {
        $query = "SELECT * FROM tbl_users WHERE user_name='" . $username . "'";
        $exe = $conn->query($query);
        while ($user = $exe->fetch_array()) {
            $admin = $user['user_name'];
            $pass = $user['user_pass'];
            $user_id = $user['user_id'];
        }
        if ($username == $admin) {
            if (md5($password) == $pass) {
                $msg->signal = "ok";
                $_SESSION['site_id'] = '1';
                $_SESSION['site_user_id'] = $user_id;
                $msg->msg = "Welcome! " . $admin . " to the site.";
            } else {
                $msg->signal = "bad";
                $msg->msg = "Wrong Password.";
            }
        } else {
            $msg->signal = "bad";
            $msg->msg = "Invalid username.";
        }
    } else {
        $msg->signal = "bad";
        $msg->msg = "Please fill in all the fields.";
    }
    $msg->setSession();
    if ($_SESSION['signal'] == 'ok') {
        header('Location: ' . $path);
        die();
    }
}
if (isset($_POST['signup_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $msg = new message();
    $conf_password = $_POST['conf_password'];
    if ($username != '' || $password != '' || $conf_password != '') {
        if ($password == $conf_password) {
            $pass = md5($password);
            $query = "INSERT INTO tbl_users (user_name, user_pass) VALUES ('" . $username . "','" . $pass . "')";
            if ($conn->query($query) == true) {
                $msg->signal = "ok";
                $msg->msg = "User created successfully";
            }
        } else {
            $msg->signal = "bad";
            $msg->msg = "Password confirmation did not match.";
        }
    } else {
        $msg->signal = "bad";
        $msg->msg = "Please fill in all the fields.";
    }
    $_SESSION['signal'] = $msg->signal;
    $_SESSION['msg'] = $msg->msg;
    if ($_SESSION['signal'] == 'ok') {
        header('Location: ' . $path . 'index.php?page=authentication');
        die();
    }
}
