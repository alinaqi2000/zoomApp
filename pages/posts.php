<?php
if (isset($_POST['save_post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    if ($title != "" && $detail != "") {
        if ($_REQUEST['mode'] == 'add') {
            $query = "INSERT INTO tbl_posts (post_title, post_detail) VALUES ('" . $title . "', '" . $detail . "')";
            if ($conn->query($query) == true) {
                $signal = "ok";
                $msg = "Post added successfully.";
            } else {
                $signal = "bad";
                $msg = "Something went wrong.";
            }
        } elseif ($_REQUEST['mode'] == 'edit') {
            $query = "UPDATE tbl_posts SET post_title='" . $title . "', post_detail='" . $detail . "' WHERE post_id='" . $_REQUEST['id'] . "'";
            if ($conn->query($query) == true) {
                $signal = "ok";
                $msg = "Post updated successfully.";
            } else {
                $signal = "bad";
                $msg = "Something went wrong.";
            }
        }
    } else {
        $signal = "bad";
        $msg = "Please fill in all the required fields.";
    }
    $_SESSION['signal'] = $signal;
    $_SESSION['msg'] = $msg;
}
if ($_REQUEST['mode'] == 'delete') {
    $query = "DELETE FROM tbl_posts WHERE post_id='" . $_REQUEST['id'] . "'";
    if ($conn->query($query) == true) {
        $signal = "ok";
        $msg = "Post deleted successfully.";
    } else {
        $signal = "bad";
        $msg = "Something went wrong.";
    }
    $_SESSION['signal'] = $signal;
    $_SESSION['msg'] = $msg;
    header('Location: ' . $path . 'index.php?page=posts');
    exit;
}

?>
<div class="col-md-12">
    <div class="row my-3">
        <h4>Manage Posts</h4>
    </div>
    <div class="row my-2">
        <?php
        if (isset($_SESSION['signal'])) {
            if ($_SESSION['signal'] == 'bad') {
        ?>
                <p class="alert w-100 alert-danger"><?php echo $_SESSION['msg'] ?></p>
            <?php
            } else {
            ?>
                <p class="alert w-100 alert-success"><?php echo $_SESSION['msg'] ?></p>
        <?php
            }
            unset($_SESSION["signal"]);
            unset($_SESSION["msg"]);
        }
        ?>
    </div>
    <?php
    if ($_REQUEST['mode'] == 'add' || $_REQUEST['mode'] == 'edit') {
        $title = '';
        $detail = '';
        if ($_REQUEST['mode'] == 'edit') {
            $query = "SELECT * FROM tbl_posts WHERE post_id='" . $_REQUEST['id'] . "'";
            $exe = $conn->query($query);
            while ($post =  $exe->fetch_array()) {
                $title =  $post['post_title'];
                $detail =  $post['post_detail'];
            }
        }
    ?>
        <div class="row">
            <form action="" method="post" class="col-md-8 my-3">
                <div class="form-group">
                    <label for="">Post Title</label>
                    <input type="text" name="title" value="<?= $title ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Post Detail</label>
                    <textarea class="form-control" name="detail" rows="5"><?= $detail ?></textarea>
                </div>
                <div class="form-group">
                    <input class="btn <?= $themeMode == 'light' ? 'btn-success' : 'btn-outline-success'; ?>" value="Save" type="submit" name="save_post">
                    <a href="<?= $path ?>index.php?page=posts" class="btn <?= $themeMode == 'light' ? 'btn-secondary' : 'btn-outline-secondary'; ?>">Back</a>
                </div>
            </form>
        </div>
    <?php
    } else {
    ?>
        <div class="row my-2">
            <a href="<?= $path ?>index.php?page=posts&mode=add" class="btn <?= $themeMode == 'light' ? 'btn-success' : 'btn-outline-success'; ?>">Add new</a>
        </div>
        <div class="row">
            <table class="table table-striped table-hover <?= $themeMode == 'light' ? '' : 'table-dark'; ?>">
                <thead>
                    <tr>
                        <th width="3%">No.</th>
                        <th>Title</th>
                        <th>Detail</th>
                        <th width="8%">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT * FROM tbl_posts ORDER BY post_date DESC";
                    $exe = $conn->query($query);
                    $count = 0;
                    while ($post =  $exe->fetch_array()) {
                        $count++;
                    ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $post['post_title'] ?></td>
                            <td><?= subString($post['post_detail'], 75) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn <?= $themeMode == 'light' ? 'btn-warning' : 'btn-outline-warning'; ?>" href="<?= $path ?>index.php?page=posts&mode=edit&id=<?= $post['post_id'] ?>">Edit</a>
                                    <a class="btn <?= $themeMode == 'light' ? 'btn-danger' : 'btn-outline-danger'; ?>" href="<?= $path ?>index.php?page=posts&mode=delete&id=<?= $post['post_id'] ?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>
</div>