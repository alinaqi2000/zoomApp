<?php
include('../includes/init.php');
$result = [];
$theme = $_SESSION['theme'];
if ($theme == 'light') {
    $_SESSION['theme'] = 'dark';
    $result['signal'] = "green";
    $result['ans'] = "Dark mode activated";
} else {
    $_SESSION['theme'] = 'light';
    $result['signal'] = "red";
    $result['ans'] = "Light mode activated";
}
echo json_encode($result);
exit();
