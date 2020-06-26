<?php
class ChatMessage
{
    public $active_user;
    public $recipient_id;
    public $recipient_name;
    public $chat_id;
    public $isTyping;
    public $data = [];
}
include('../includes/init.php');
$output = "";
$user = $_GET['user'];
$recipient = $_GET['recipient'];
global $conn;

$getChat = getListAsObj('tbl_chat', "WHERE chat_user='" . $user . "' AND chat_recipient='" . $recipient . "'");

$query4 = "UPDATE tbl_chat SET chat_read='0' WHERE chat_id='" . $getChat[0]['chat_id'] . "'";
$conn->query($query4);

if (!$getChat) {
    $getChat = getListAsObj('tbl_chat', "WHERE chat_user='" . $recipient . "' AND chat_recipient='" . $user . "'");
    $query3 = "UPDATE tbl_chat SET chat_read='0' WHERE chat_id='" . $getChat[0]['chat_id'] . "'";
    $conn->query($query3);
}
$getMessages = getListAsObj('tbl_messages', "WHERE m_chat='" . $getChat[0]['chat_id'] . "' AND m_maker='" . $user . "'");

$getChat2 = getList('tbl_chat', "WHERE chat_user='" . $user . "'");

$getChat3 = getList('tbl_chat', "WHERE chat_recipient='" . $user . "'");

$getUser = getList('tbl_users', "WHERE user_id='" . $recipient . "'");;
$output = new ChatMessage;
$output->active_user = $user;
$output->recipient_name = $getUser[0]['user_name'];
$output->recipient_id = $recipient;
$output->chat_id = $getChat[0]['chat_id'];
$output->isTyping = $getChat[0]['chat_typing'];
foreach ($getMessages as $msg) {
    array_push($output->data, $msg);
}
echo json_encode($output);
exit;
