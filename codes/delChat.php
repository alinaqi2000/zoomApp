<?php
include('../includes/init.php');
global $conn;
$output = "";
$msg_id = $_GET['msg_id'];
$query = "DELETE FROM tbl_messages WHERE m_id='" . $msg_id . "'";
$conn->query($query);

echo json_encode($output);
exit;
