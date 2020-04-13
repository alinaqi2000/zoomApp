<?php
error_reporting(1);
session_start();
$path = "http://localhost/zoomApp/";
$themeMode = 'light';
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = $themeMode;
} else {
    $themeMode = $_SESSION['theme'];
}
$page = $_REQUEST['page'];
if ($page == 'login') {
    include('codes/login.php');
} else {
    if (!isset($_SESSION['site_id']) && $_SESSION['site_id'] != '1') {
        header('Location: ' . $path . 'index.php?page=login');
        die();
    }
}
if (!empty($page)) {
    $includePage = "pages/" . $page . '.php';
} else {
    $includePage = 'pages/home.php';
}
if (isset($_POST['theme_btn'])) {
    if ($themeMode == 'light') {
        $_SESSION['theme'] = 'dark';
    } else {
        $_SESSION['theme'] = 'light';
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
}
