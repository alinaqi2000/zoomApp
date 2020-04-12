<?php
$admin = 'admin';
$pass = 'admin';
$signal = '';
$msg = "";
if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username != '' || $password != '') {
        if ($username == 'admin') {
            if ($password == $pass) {
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
        header('Location: http://localhost/zoomApp/index.php');
        die();
    }
}
