<?php
error_reporting(1);
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
    <header class="mb-3 shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php"><img src="assets/new_logo.png" height="60px" width="150px" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $_REQUEST['page'] == '' ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_REQUEST['page'] == 'calculators' ? 'active' : ''; ?>" href="index.php?page=calculators">Calculators</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  <?= $_REQUEST['page'] == 'user_entry' ? 'active' : ''; ?>" href="index.php?page=user_entry">User Entry</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
    <main class="content">
        <div class="container">
            <div class="row">
                <?php
                $page = $_REQUEST['page'];
                if ($page == 'calculators') {
                    include('pages/calculators.php');
                } elseif ($page == 'user_entry') {
                    include('pages/users_entry.php');
                } else {
                ?>
                    <h1>Welcome To Home</h1>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <span>2020 &copy; zoomApp. All rights reserved.</span>
        </div>

    </footer>
    <script src="assets/bootstrap.min.js"></script>
</body>

</html>