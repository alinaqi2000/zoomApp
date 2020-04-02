<?php
$result = '';
if (isset($_POST['dmas_btn'])) {
    $val1 = $_POST['value1'];
    $val2 = $_POST['value2'];
    if ($val1 == '' || $val2 == '') {
        $result = "<span class='alert alert-danger'> <strong>Error: </strong>Please enter all values</span>";
    } else {
        $sum = $val1 + $val2;
        $result = "<span class='alert  alert-success'>Sum is <strong>" . $sum . "</strong></span>";
    }
}
if (isset($_POST['temp_btn'])) {
    $val1 = $_POST['value1'];
    $val2 = $_POST['value2'];
    if ($val1 == '' || $val2 == '') {
        $result = "<span class='alert alert-danger'> <strong>Error: </strong>Please enter all values</span>";
    } else {
        $sub = $val1 - $val2;
        $result = "<span class='alert  alert-primary'>Difference is <strong>" . $sub . "</strong></span>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Zoom App</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/my_styles.css">
    <script src="assets/jquery.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Zoom App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Link</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another actions</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
        </nav>
    </header>
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 py-3 bg-light shadow">
                    <h3>My SideBar</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-dmas-list" data-toggle="list" href="#list-dmas" role="tab" aria-controls="dmas">Dmas Calculator</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Temperature Calculator</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="col-12">
                        <div class="col-md-12 my-3">
                            <div class="row">
                                <?php
                                echo $result
                                ?>
                            </div>

                        </div>

                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="list-dmas" role="tabpanel" aria-labelledby="list-dmas-list">
                                <h2>Dmas Calculator</h2>
                                <form class="col-6" method="post" action="index.php">
                                    <div class="form-group">
                                        <label for="Value1">First Value</label>
                                        <input type="text" name="value1" class="form-control" id="Value1">
                                    </div>
                                    <div class="form-group">
                                        <label for="Value2">Second Value</label>
                                        <input type="text" name="value2" class="form-control" id="Value2">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="dmas_btn" value="Dmas Button" class="btn btn-success">
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                                <h2>Temperature Calculator</h2>
                                <form class="col-6" method="post" action="index.php">
                                    <div class="form-group">
                                        <label for="Value1">First Value</label>
                                        <input type="text" name="value1" class="form-control" id="Value1">
                                    </div>
                                    <div class="form-group">
                                        <label for="Value2">Second Value</label>
                                        <input type="text" name="value2" class="form-control" id="Value2">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="temp_btn" value="Temp Button" class="btn btn-success">
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/bootstrap.min.js"></script>
</body>

</html>