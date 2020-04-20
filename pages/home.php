<?php
if (isset($_SESSION['signal'])) {
    if ($_SESSION['signal'] == 'ok') {
?>

        <div class="col-md-12">
            <div class="row">
                <p class="alert float-left alert-success"><?php echo $_SESSION['msg'] ?></p>
            </div>
        </div>


<?php
    }
    unset($_SESSION["signal"]);
    unset($_SESSION["msg"]);
}
unset($_SESSION["signal"]);
unset($_SESSION["msg"]);
$message = "Welcome To Home";
?>
<h1><?php
    echo subString($message);
    ?></h1>