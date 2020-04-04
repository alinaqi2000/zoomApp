<?php
error_reporting(1);
$result = '';
if (isset($_POST['dmas_btn'])) {
    $val1 = $_POST['value1'];
    $val2 = $_POST['value2'];
    if ($val1 == '' || $val2 == '') {
        $result = "<span class='alert w-100 alert-danger'> <strong>Error: </strong>Please enter all values</span>";
    } else {
        $sum = $val1 + $val2;
        $result = "<span class='alert w-100 alert-success'>Sum is <strong>" . $sum . "</strong></span>";
    }
}
if (isset($_POST['tempBtn'])) {
    $val = $_POST['value'];
    $type = $_POST['type'];
    if ($type == 'f2c') {
        $ans = ($val - 32) * 5 / 9;
        $result = "<span class='alert w-100 alert-primary'>Answer : <strong>" . $ans . "°C</strong></span>";
    } elseif ($type == 'c2f') {
        $ans = ($val * (9 / 5)) + 32;
        $result = "<span class='alert w-100 alert-secondary'>Answer : <strong>" . $ans . "F</strong></span>";
    } else {
        $result = "<span class='alert w-100 alert-danger'><strong>Error: </strong>Please specify correct type.</span>";
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
    <header class="mb-3 shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php"><img src="assets/new_logo.png" height="60px" width="150px" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $_REQUEST['cal'] == '' ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_REQUEST['cal'] == 'dmas' ? 'active' : ''; ?>" href="index.php?cal=dmas">Dmas</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  <?= $_REQUEST['cal'] == 'temp' ? 'active' : ''; ?>" href="index.php?cal=temp">Temperature</a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12 py-3 bg-light shadow">
                    <h3>My SideBar</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item <?= $_REQUEST['cal'] == 'dmas' ? 'font-weight-bold' : ''; ?>" href="index.php?cal=dmas">Dmas Calculator</a>
                                <a class="list-group-item <?= $_REQUEST['cal'] == 'temp' ? 'font-weight-bold' : ''; ?>" href="index.php?cal=temp">Temperature Calculator</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="col-12">
                        <div class="col-md-6 my-3">
                            <div class="row">
                                <?php
                                echo $result
                                ?>
                            </div>

                        </div>

                        <div class="tab-content" id="nav-tabContent">


                            <?php
                            $method = $_REQUEST['cal'];
                            if ($method == 'dmas') {
                                include_once('dmas.php');
                            } elseif ($method == 'temp') {
                                include_once('temp.php');
                            } else {
                            ?>
                                <h2>Welcome to Home</h2>
                            <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
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