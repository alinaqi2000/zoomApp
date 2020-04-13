<?php
$result = '';
if (isset($_POST['dmas_btn'])) {
    $val1 = $_POST['value1'];
    $val2 = $_POST['value2'];
    if ($val1 == '' || $val2 == '') {
        $result = "<p class='alert w-100 alert-danger'> <strong>Error: </strong>Please enter all values</p>";
    } else {
        $sum = $val1 + $val2;
        $result = "<p class='alert w-100 alert-success'>Sum is <strong>" . $sum . "</strong></p>";
    }
}
if (isset($_POST['tempBtn'])) {
    $val = $_POST['value'];
    $type = $_POST['type'];
    if ($type == 'f2c') {
        $ans = ($val - 32) * 5 / 9;
        $result = "<p class='alert w-100 alert-primary'>Answer : <strong>" . $ans . "°C</strong></p>";
    } elseif ($type == 'c2f') {
        $ans = ($val * (9 / 5)) + 32;
        $result = "<p class='alert w-100 alert-secondary'>Answer : <strong>" . $ans . "F</strong></p>";
    } else {
        $result = "<p class='alert w-100 alert-danger'><strong>Error: </strong>Please specify correct type.</p>";
    }
}
?>
<div class="col-md-3 col-xs-12 py-3 bg-light shadow <?= $themeMode == 'light' ? '' : 'bg-dark'; ?>">
    <h3>My SideBar</h3>
    <div class="row">
        <div class="col-12">
            <div class="list-group list-group-flush ">
                <a class="list-group-item <?= $themeMode == 'light' ? '' : 'bg-dark'; ?> <?= $_REQUEST['cal'] == 'dmas' ? 'font-weight-bold' : ''; ?>" href="index.php?page=calculators&cal=dmas">Dmas Calculator</a>
                <a class="list-group-item <?= $themeMode == 'light' ? '' : 'bg-dark'; ?> <?= $_REQUEST['cal'] == 'temp' ? 'font-weight-bold' : ''; ?>" href="index.php?page=calculators&cal=temp">Temperature Calculator</a>
            </div>

        </div>
    </div>
</div>
<div class="col-md-9 col-xs-12">
    <div class="col-12">
        <div class="col-md-6 my-3">
            <div class="row">
                <?php
                echo $result;
                ?>
            </div>

        </div>

        <div class="tab-content" id="nav-tabContent">


            <?php
            $method = $_REQUEST['cal'];
            // echo $method;
            if ($method == 'dmas') {
                include('cals/dmas.php');
            } elseif ($method == 'temp') {
                include('cals/temp.php');
            } else {
            ?>
                <h2>Welcome to Calculators</h2>
            <?php
            }
            ?>



        </div>
    </div>
</div><!--  -->