<?php
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

function subString($string, $len = 50, $inc = '...')
{
    if (strlen($string) > $len) {
        $newString = substr($string, 0, $len) . $inc;
        return $newString;
    }
    return $string;
}
function sum($a, $b)
{
    return $a + $b;
}
