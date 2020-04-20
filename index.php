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
    <script src="<?= $path ?>assets/jquery.min.js"></script>
</head>

<body class="<?= $themeMode == 'light' ? '' : 'bg-dark'; ?>">
    <?php
    if ($page != 'login') {
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
    if ($page != 'login') {
        include('pages/shared/footer.php');
    }
    ?>
    <script src="<?= $path ?>assets/bootstrap.min.js"></script>
</body>

</html>