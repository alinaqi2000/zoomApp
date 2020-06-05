<?php
include('includes/init.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Zoom App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= $path ?>assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $path ?>assets/my_styles.css">
    <link rel="stylesheet" href="<?= $path ?>assets/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="<?= $path ?>assets/dark-sheet.css">
    <script src="<?= $path ?>assets/jquery.min.js"></script>
</head>

<body class="<?= $themeMode == 'light' ? '' : 'bg-dark'; ?>">

    <?php

    if ($page != 'authentication') {
        include('pages/shared/header.php');
    }

    ?>
    <main class="content">
        <div class="container">
            <div class="row">
                <?php
                if (!include($includePage)) {
                    include('pages/error-page.php');
                }
                ?>
            </div>
        </div>
    </main>
    <?php
    if ($page != 'authentication') {
        include('pages/shared/footer.php');
    }
    ?>
    <script src="<?= $path ?>assets/bootstrap.min.js"></script>
    <script src="<?= $path ?>assets/my_scripts.js"></script>
</body>

</html>