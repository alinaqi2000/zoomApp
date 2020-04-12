<?php
error_reporting(1);
session_start();
// print_r($_SESSION);
$page = $_REQUEST['page'];
if ($page == 'login') {
    include('codes/login.php');
} else {
    if (!isset($_SESSION['site_id']) && $_SESSION['site_id'] != '1') {
        header('Location: http://localhost/zoomApp/index.php?page=login');
        die();
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>My Zoom App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/my_styles.css">
    <script src="assets/jquery.min.js"></script>
</head>

<body>
    <?php
    if ($page != 'login') {
        include('pages/shared/header.php');
    }

    ?>
    <main class="content">
        <div class="container">
            <div class="row">
                <?php

                if (!empty($page)) {
                    if (include('pages/' . $page . '.php')) {
                        echo '';
                    } else {
                ?>
                        <h4>404 Page not found</h4>
                <?php
                    }
                } else {
                    include('pages/home.php');
                }
                ?>
            </div>
        </div>
    </main>
    <?php
    if ($page != 'login') {
        include('pages/shared/footer.php');
    }
    ?>
    <script src="assets/bootstrap.min.js"></script>
</body>

</html>