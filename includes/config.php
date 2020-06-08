<?php

$path = "http://localhost/zoomApp/";
// Site Theme Mode
// print_r($_SESSION);
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
class message
{
    public $signal;
    public $msg;
    public function __construct()
    {
        $this->msg = "";
        $this->signal = "";
    }
    public function setSession()
    {
        $_SESSION['signal'] = $this->signal;
        $_SESSION['msg'] = $this->msg;
    }
    public function getSession()
    {
        $this->signal =  $_SESSION['signal'];
        $this->msg =  $_SESSION['msg'];
    }
    public function unsetSession()
    {
        unset($_SESSION['signal']);
        unset($_SESSION['msg']);
    }
}
function showMessage($class = "")
{
    $dspMsg = new message();
    $dspMsg->getSession();
    if ($dspMsg->signal != "") {
        if ($dspMsg->signal == 'ok') {
?>
            <div class="col-md-12">
                <div class="row">
                    <p class="alert <?= $class ?> alert-success"><?php echo $dspMsg->msg ?></p>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="col-md-12">
                <div class="row">
                    <p class="alert <?= $class ?> alert-danger"><?php echo $dspMsg->msg ?></p>
                </div>
            </div>
<?php
        }
        $dspMsg->unsetSession();
    }
}
