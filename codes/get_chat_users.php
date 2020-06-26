<?php
include('../includes/init.php');

$output = "";
$user_id = $_GET['user_id'];
$getUsers = getList('tbl_users', "WHERE user_id!='" . $user_id . "'");

foreach ($getUsers as $user) {
    $getChat = getList('tbl_chat', "WHERE chat_user='" . $user_id . "'");
    if (!$getChat) {
        $getChat = getList('tbl_chat', "WHERE chat_recipient='" . $user_id . "'");
    }
    $boldClass = "";
    if ($getChat[0]['chat_read'] == '1') {
        $boldClass = "font-weight-bold";
    }
    $output .=  '<li class="makeMsg ' . $boldClass . '" data-url="' . $path . 'codes/getChat.php?user=' . $_SESSION['site_user_id'] . '&recipient=' . $user['user_id'] . '">' . $user['user_name'] . '</li>';
}
echo json_encode($output);
exit;
