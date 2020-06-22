<?php
include('includes/init.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Zoom App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= $path ?>assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $path ?>assets/my_styles.css">
    <link rel="stylesheet" href="<?= $path ?>assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= $path ?>assets/dark-sheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />

    <script src="<?= $path ?>assets/jquery.min.js"></script>
    <style>
        .msgBtn {
            border-radius: 50%;
            position: absolute;
            right: 28px;
            bottom: 80px;
            font-size: 22px;

        }

        .msgBtn .btBadge {
            width: 8px;
            height: 8px;
            border-radius: 14px;
            right: 0px;
            top: 3px;
            position: absolute;
            z-index: 11;
            background: #000;

        }

        .msgBox {
            border-radius: 5px;
            padding: 12px;
            position: absolute;
            background: #ddd;
            right: 28px;
            bottom: 70px;
            z-index: 999;
        }

        .msgBox ul {
            width: 100%;
            float: left;
            padding: 0px;

        }

        .msgBox li {
            cursor: pointer;
            list-style: none;
            padding: 12px 18px;

        }

        .makeChat {
            height: 390px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 0px;
            position: absolute;
            background: #ddd;
            right: 28px;
            bottom: 70px;
            z-index: 999;
        }

        .makeChat .chatSingle {
            width: 100%;
            float: left;
        }

        .makeChat .chatSingle p {
            padding: 8px;
            margin: 4px 0px;
            background: #fff;
            box-shadow: 2px 4px 4px rgba(0, 0, 0, .5);
            border-radius: 8px;
            width: max-content;
        }

        .makeChat .allChats {
            width: 100%;
            height: 300px;
            padding: 12px;
            float: left;
            overflow-x: auto;
        }


        .makeChat .inpBody {
            position: absolute;
            bottom: 0;
            border-top: 1px solid rgba(0, 0, 0, .2);
            width: 100%;
        }

        .makeChat .inpBody .chatInp {
            margin-right: 45px;
        }

        .makeChat .inpBody input.writeChat {
            width: 100%;
            border: none;
            border-bottom-left-radius: 5px;
            padding: 8px;
        }

        .makeChat .inpBody input.writeChat:focus {
            outline: none;
        }

        .makeChat .inpBody #sendMsg {
            position: absolute;
            right: 0;
            top: 0px;
            width: 45px;
            border-bottom-right-radius: 5px;
            height: 100%;

        }

        .makeChat .inpBody #sendMsg i {
            transition: all .25s;
        }

        .makeChat .inpBody #sendMsg:hover {
            background: grey;
        }

        .makeChat .inpBody #sendMsg:hover i {
            transform: scale(1.1);
        }

        .makeChat .chatHeader #goBack {
            float: left;
            padding: 9px 17px;
        }

        .makeChat .chatHeader #delMsges {
            float: left;
            padding: 9px 17px;
        }

        .makeChat .chatHeader #editMsges {
            float: left;
            padding: 9px 17px;
        }

        .makeChat .chatHeader h4 {
            float: left;
            padding: 6px 9px
        }

        .makeChat .chatHeader {
            width: 100%;
            float: left;
            border-bottom: 1px solid rgba(0, 0, 0, .2);
        }

        .msgCheckBox {
            margin: 0px 8px;
        }
    </style>
</head>

<body class="<?= $themeMode == 'light' ? '' : 'bg-dark'; ?>">

    <?php

    if ($page != 'authentication') {
        include('pages/shared/header.php');
    }

    ?>
    <main class="content">
        <div class="container">
            <div class="row">
                <?php
                if (!include($includePage)) {
                    include('pages/error-page.php');
                }
                ?>
            </div>
        </div>
    </main>
    <?php
    if ($page != 'authentication') {
        include('pages/shared/footer.php');
    }
    ?>
    <div class="msgBox d-none col-md-3">
        <div class="w-100 float-left">
            <h3 class="float-left">Users List</h3>
            <button id="closeMsgBox" class="btn btn-danger float-right"><i class="fa fa-times"></i></button>
        </div>
        <ul>
            <?php
            $getUsers = getList('tbl_users', "WHERE user_id!='" . $user_id . "'");
            foreach ($getUsers as $user) {
            ?>
                <li class="makeMsg" data-id="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></li>
            <?php
            }
            ?>

        </ul>
    </div>
    <div class="makeChat d-none col-md-3">
        <div class="chatHeader">
            <button type="button" class="btn" id="goBack"><i class="fa fa-arrow-left"></i></button>
            <h4>Ali Naqi</h4>
            <div class="float-right">
                <button type="button" class="btn d-none" id="delMsges"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn" id="editMsges"><i class="fa fa-edit"></i></button>

            </div>
        </div>
        <div class="allChats">

        </div>

        <div class="inpBody">
            <div class="chatInp">
                <input type="text" id="msgContent" class="writeChat" placeholder="Type a message">
            </div>
            <button type="button" class="btn" id="sendMsg"><i class="fa fa-paper-plane"></i></button>
        </div>
    </div>
    <button type="button" class="btn msgBtn  btn-warning" id="showMsgBox"><span class="btBadge"></span><i class="fa fa-envelope"></i></button>
    <!-- <div class="chatSingle">
        <p>Your mesasge to me</p>
    </div>
    <div class="chatSingle">
        <p class="float-right">My mesasge to you</p>
    </div> -->
    <script>
        $(document).ready(function() {
            var chatsData = {
                active_user: "2",
                isTyping: "0",
                data: [{
                        m_id: "1",
                        m_chat: "1",
                        m_user: "1",
                        m_recipient: "2",
                        m_content: "My mesasge to you",
                        m_date: "21 June, 20, 11:59 am",
                    },
                    {
                        m_id: "2",
                        m_chat: "1",
                        m_user: "2",
                        m_recipient: "1",
                        m_content: "Your mesasge to me",
                        m_date: "21 June, 20, 11:59 am",
                    },
                    {
                        m_id: "3",
                        m_chat: "1",
                        m_user: "1",
                        m_recipient: "2",
                        m_content: "My mesasge to you",
                        m_date: "21 June, 20, 11:59 am",
                    },
                    {
                        m_id: "4",
                        m_chat: "1",
                        m_user: "2",
                        m_recipient: "1",
                        m_content: "Your mesasge to me",
                        m_date: "21 June, 20, 11:59 am",
                    },
                    {
                        m_id: "5",
                        m_chat: "1",
                        m_user: "1",
                        m_recipient: "2",
                        m_content: "My mesasge to you",
                        m_date: "21 June, 20, 11:59 am",
                    },
                    {
                        m_id: "6",
                        m_chat: "1",
                        m_user: "2",
                        m_recipient: "1",
                        m_content: "Your mesasge to me",
                        m_date: "21 June, 20, 11:59 am",
                    }
                ]
            };

            makeMsgList();

            function makeMsgList() {
                var msgList = "";
                $('.msgCheckBox').addClass('d-none');
                $('#delMsges').addClass('d-none');
                chatsData.data.forEach(
                    (m, index) => {
                        var hasClass = "";
                        if (m.m_user === chatsData.active_user) {
                            hasClass = 'class="float-right"';
                        }
                        msgList += '<div class="chatSingle">';
                        msgList += '<p ' + hasClass + '><input type="checkbox" name="msges" id="box_' + m.m_id + '" data-index="' + index + '" class="msgCheckBox  d-none" value="' + m.m_id + '">' + m.m_content + '</p>';
                        msgList += '</div>';
                    }
                );
                if (chatsData.isTyping === 1) {
                    msgList += '<div class="chatSingle">';
                    msgList += '<p>typing...</p>';
                    msgList += '</div>';
                }
                msgList += '<div id="scrollBtm" style="float:left"></div>';
                $('.allChats').html(msgList);
                var elmnt = document.getElementById("scrollBtm");
                elmnt.scrollIntoView();
            }
            $('#delMsges').click(function() {
                // var chkBoxes = $('.msgCheckBox:checked');
                var checkbox = $('.msgCheckBox:checked');
                if (checkbox.length > 0) {
                    var checkbox_value = [];
                    $(checkbox).each(function() {
                        checkbox_value.push($(this).val());
                    });
                    for (let i = 0; i < checkbox_value.length; i++) {
                        removeMsg(checkbox_value[i]);
                    }
                    makeMsgList();
                }

            });

            function removeMsg(id) {
                var index = $('#box_' + id).data('index');
                chatsData.data.splice(index, 1);
            }
            $('#sendMsg').click(function() {
                var msgValue = $('#msgContent').val();
                if (msgValue !== '') {
                    var newMsgObj = {
                        m_id: chatsData.data.length + 1,
                        m_chat: "1",
                        m_user: chatsData.active_user,
                        m_recipient: "2",
                        m_content: msgValue,
                        m_date: "21 June, 20, 11:59 am",
                    };
                    chatsData.isTyping = 0;
                    $('#msgContent').val('');
                    chatsData.data.push(newMsgObj);
                    makeMsgList();
                }
            });
            $('#editMsges').click(function() {
                $('.msgCheckBox').toggleClass('d-none');
                $('#delMsges').toggleClass('d-none');
            });
            $('#msgContent').keyup(function() {
                var msgValue = $(this).val();
                if (msgValue !== '') {
                    chatsData.isTyping = 1;
                    makeMsgList();
                } else {
                    chatsData.isTyping = 0;
                    makeMsgList();
                }
            });
            $('#showMsgBox').click(function() {
                $('.msgBox').toggleClass('d-none');
                $(this).toggleClass('d-none');
            });
            $('#closeMsgBox').click(function() {
                $('#showMsgBox').toggleClass('d-none');
                $('.msgBox').toggleClass('d-none');
            });
            $('#goBack').click(function() {
                $('#showMsgBox').toggleClass('d-none');
                $('.makeChat').toggleClass('d-none');
            });
            $('.makeMsg').click(function() {
                $('#showMsgBox').toggleClass('d-none');
                $('.makeChat').toggleClass('d-none');
            });

        });
    </script>

    <script src="<?= $path ?>assets/bootstrap.min.js"></script>
    <script src="<?= $path ?>assets/my_scripts.js"></script>
</body>

</html>