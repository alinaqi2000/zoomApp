<?php

$path = "http://localhost/zoomApp/";
// Site Theme Mode

$themeMode = 'light';
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = $themeMode;
} else {
    $themeMode = $_SESSION['theme'];
}
// 
$page = $_REQUEST['page'];
if ($page == 'authentication') {
    include('codes/authentication.php');
} else {
    if (!isset($_SESSION['site_id']) && $_SESSION['site_id'] != '1') {
        header('Location: ' . $path . 'index.php?page=authentication');
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
