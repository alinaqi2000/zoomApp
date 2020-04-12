<?php
if (isset($_SESSION['signal'])) {
    if ($_SESSION['signal'] == 'ok') {
?>
        <p class="alert w-100 alert-success"><?php echo $_SESSION['msg'] ?></p>
<?php
    }
    unset($_SESSION["signal"]);
    unset($_SESSION["msg"]);
}
unset($_SESSION["signal"]);
unset($_SESSION["msg"]);
?>
<h1>Welcome To Home</h1>