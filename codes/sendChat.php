<?php
include('../includes/init.php');
global $conn;
$output = "";
$user = $_POST['user'];
$chat_id = $_POST['chat_id'];
$content = mysqli_real_escape_string($conn, $_POST['content']);
$recipient = $_POST['recipient'];

$getChat = getListAsObj('tbl_chat', "WHERE chat_user='" . $user . "' AND chat_recipient='" . $recipient . "'");
if (!$getChat) {
    $getChat = getListAsObj('tbl_chat', "WHERE chat_user='" . $recipient . "' AND chat_recipient='" . $user . "'");
}
if ($getChat) {

    $query3 = "UPDATE tbl_chat SET chat_read='1' , chat_typing='0' WHERE chat_id='" .  $chat_id . "'";
    $conn->query($query3);

    $getChat3 = getListAsObj('tbl_chat', "WHERE chat_user='" . $recipient . "' AND chat_recipient='" . $user . "'");
    $query4 = "UPDATE tbl_chat SET chat_read='1' , chat_typing='0' WHERE chat_id='" . $getChat3[0]['chat_id'] . "'";
    $conn->query($query4);


    $date = date("F j, Y, g:i a");
    $query = "INSERT INTO tbl_messages (m_maker, m_chat, m_user, m_recipient, m_content, m_date)
     VALUES ('" . $user . "', '" . $chat_id . "', '" . $user . "', '" . $recipient . "', '" . $content . "', '" . $date . "')";

    $query2 = "INSERT INTO tbl_messages (m_maker, m_chat, m_user, m_recipient, m_content, m_date)
    VALUES ('" . $recipient . "', '" . $getChat3[0]['chat_id'] . "', '" . $user . "', '" . $recipient . "', '" . $content . "', '" . $date . "')";
    $conn->query($query);
    $conn->query($query2);
} else {
    $query3 = "INSERT INTO tbl_chat (chat_user, chat_recipient, chat_date)
     VALUES('" . $user . "','" . $recipient . "','" . $date . "')";
    $conn->query($query3);
    $chat_id1 = mysqli_insert_id($conn);
    $query4 = "INSERT INTO tbl_chat (chat_user, chat_recipient, chat_date)
    VALUES('" . $recipient . "','" . $user . "','" . $date . "')";
    $conn->query($query4);
    $chat_id2 = mysqli_insert_id($conn);



    $date = date("F j, Y, g:i a");
    $query = "INSERT INTO tbl_messages (m_maker, m_chat, m_user, m_recipient, m_content, m_date)
     VALUES ('" . $user . "', '" . $chat_id1 . "', '" . $user . "', '" . $recipient . "', '" . $content . "', '" . $date . "')";
    $query2 = "INSERT INTO tbl_messages (m_maker, m_chat, m_user, m_recipient, m_content, m_date)
    VALUES ('" . $recipient . "', '" . $chat_id2 . "', '" . $user . "', '" . $recipient . "', '" . $content . "', '" . $date . "')";
    $conn->query($query);
    $conn->query($query2);
}






echo json_encode($output);
exit;
