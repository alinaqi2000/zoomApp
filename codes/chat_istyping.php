<?php
include('../includes/init.php');
global $conn;
$output = "";

$user = $_GET['user'];
$recipient = $_GET['recipient'];
$value = $_GET['value'];


$getChat2 = getListAsObj('tbl_chat', "WHERE chat_user='" . $recipient . "' AND chat_recipient='" . $user . "'");
$query3 = "UPDATE tbl_chat SET chat_typing='" . $value . "' WHERE chat_id='" . $getChat2[0]['chat_id'] . "'";
$conn->query($query3);

echo json_encode($output);
exit;
