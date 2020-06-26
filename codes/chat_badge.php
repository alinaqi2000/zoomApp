<?php
include('../includes/init.php');

$output = "";
$user = $_GET['user'];
$getUsers = getList('tbl_chat', "WHERE chat_recipient!='" . $user . "' AND chat_read='1'");

echo json_encode(count($getUsers));
exit;
