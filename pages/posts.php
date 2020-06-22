<?php
if (isset($_POST['save_post'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES["image"]["name"];

    if ($_REQUEST['mode'] == 'add') {
        if ($title != "" && $detail != "" && $image != "") {

            $i = strrpos($_FILES['image']["name"], ".");
            $l = strlen($_FILES['image']["name"]) - $i;
            $ext = substr($_FILES['image']["name"], $i + 1, $l);
            if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'svg') {
                $rand_name = time() . rand(1111, 9999);
                $new_name = "image_" . $rand_name . "." . $ext;

                $query = "INSERT INTO tbl_posts (post_title, post_detail, post_image) VALUES ('" . $title . "', '" . $detail . "', '" . $new_name . "')";

                if (move_uploaded_file($_FILES['image']["tmp_name"], "./uploads/" . $new_name)) {
                    if ($conn->query($query) == true) {
                        $signal = "ok";
                        $msg = "Post added successfully.";
                    } else {
                        $signal = "bad";
                        $msg = "Something went wrong.";
                    }
                } else {
                    $signal = "bad";
                    $msg = "Image not uploaded, please try again.";
                }
            } else {
                $signal = "bad";
                $msg = "Please select valid image format.";
            }
        } else {
            $signal = "bad";
            $msg = "Please fill in all the required fields.";
        }
    } elseif ($_REQUEST['mode'] == 'edit') {
        if ($title != "" && $detail != "") {
            if ($_FILES['image']["name"]) {
                $i = strrpos($_FILES['image']["name"], ".");
                $l = strlen($_FILES['image']["name"]) - $i;
                $ext = substr($_FILES['image']["name"], $i + 1, $l);
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'svg') {
                    $rand_name = time() . rand(1111, 9999);
                    $new_name = "image_" . $rand_name . "." . $ext;
                    if (move_uploaded_file($_FILES['image']["tmp_name"], "./uploads/" . $new_name)) {
                        $query = "UPDATE tbl_posts SET post_title='" . $title . "', post_detail='" . $detail . "', post_image='" . $new_name . "' WHERE post_id='" . $_REQUEST['id'] . "'";

                        if ($conn->query($query) == true) {
                            $signal = "ok";
                            $msg = "Post updated successfully.";
                        } else {
                            $signal = "bad";
                            $msg = "Something went wrong.";
                        }
                    } else {
                        $signal = "bad";
                        $msg = "Image not uploaded, please try again.";
                    }
                } else {
                    $signal = "bad";
                    $msg = "Please select valid image format.";
                }
            } else {
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
    }

    $_SESSION['signal'] = $signal;
    $_SESSION['msg'] = $msg;
}
if ($_REQUEST['mode'] == 'delete') {
    $query2 = "SELECT * FROM tbl_posts WHERE post_id='" . $_REQUEST['id'] . "'";
    $exe = $conn->query($query2);
    while ($post =  $exe->fetch_array()) {
        unlink('./uploads/' . $post['post_image']);
    }
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
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb <?= $themeMode == 'light' ? 'bg-white' : 'bg-dark'; ?>">
                <li class="breadcrumb-item"><a href="<?= $path ?>">Home</a></li>
                <?php
                if (isset($_REQUEST['mode'])) {
                ?>
                    <li class="breadcrumb-item"><a href="<?= $path ?>index.php?page=posts">Manage Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $_REQUEST['mode'] ?></li>
                <?php
                } else {
                ?>
                    <li class="breadcrumb-item active" aria-current="page">Manage Posts</li>
                <?php
                }
                ?>
            </ol>
        </nav>
    </div>
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
                $image =  $post['post_image'];
                $detail =  $post['post_detail'];
            }
        }
    ?>
        <div class="row">
            <form action="" enctype="multipart/form-data" method="post" class="col-md-8 my-3">
                <!-- <div class="form-group">
                    <label for="">Test Input</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div id="suggestName" style="cursor: pointer;" class="input-group-text">Suggest me a name</div>
                        </div>
                        <input type="text" maxlength="10" class="inptst form-control" id="testInp" placeholder="Username">
                        <p class="text-secondary w-100" id="inpLen"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="w-100">
                        <button type="button" id="suggest" class="btn w-100 btn-info">
                            Suggest
                        </button>
                    </div>
                    <textarea id="toSuggest" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Test Input 2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div id="startInterval" style="cursor: pointer;" class="input-group-text">Start Interval</div>
                            <div id="stopInterval" style="cursor: pointer;" class="d-none input-group-text">Stop Interval</div>
                        </div>
                        <input type="text" class="form-control" id="testInp2" placeholder="Date">
                        <p class="text-secondary w-100" id="inpLen2"></p>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="">Post Title</label>
                    <input type="text" name="title" value="<?= $title ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Post Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <?php
                if ($image) {
                ?>
                    <div class="form-group">
                        <img src="<?= $path . "uploads/" . $image  ?>" width="250px" alt="">
                    </div>
                <?php
                }
                ?>
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
        <script>
            $(document).ready(function() {
                $('#suggest').click(function() {
                    $('#toSuggest').html('Ali&nbsp;Naqi');
                });
                $('#suggestName').click(function() {
                    $('#testInp').val("Ali Naqi");
                });
                $("#testInp").keyup(function() {
                    if ($(this).val().length > 9) {
                        $('#inpLen').addClass('text-danger');
                        $('#inpLen').html('maximum charaters have been written');
                    } else {
                        $('#inpLen').removeClass('text-danger');
                        $('#inpLen').html($(this).val().length + '/10 charaters have been written');
                    }

                });
                var counter = 10;
                var interval;
                $('#startInterval').click(function() {
                    $('#inpLen2').html('Counter is : ' + counter);
                    interval = setInterval(() => {
                        counter--;
                        if (counter >= 0) {
                            $('#inpLen2').html('Counter is : ' + counter);
                        } else {
                            counter = 10;
                            clearInterval(interval);
                        }
                    }, 250);
                });
            });
        </script>
    <?php
    } else {
    ?>
        <div class="row my-2">
            <div class="col-md-9">
                <a href="<?= $path ?>index.php?page=posts&mode=add" class="btn <?= $themeMode == 'light' ? 'btn-success' : 'btn-outline-success'; ?>"><i class="fa fa-plus"></i> Add new</a>
            </div>
            <div class="col-md-3 pull-right">
                <form>
                    <input type="hidden" name="page" value="posts">
                    <input type="hidden" name="mode" value="search">
                    <div class="form-group">
                        <input type="text" name="searchInp" placeholder="Search..." value="<?= $_REQUEST['searchInp'] ?>" class="form-control">
                    </div>
                </form>
            </div>
        </div>
        <div class="row overflow-auto">
            <table class="table table-striped table-hover <?= $themeMode == 'light' ? '' : 'table-dark'; ?>">
                <thead>
                    <tr>
                        <th width="3%">No.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Detail</th>
                        <th width="18%">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($_REQUEST['mode'] == 'search') {
                        $searchVal = $_GET['searchInp'];
                        $query = "SELECT * FROM tbl_posts WHERE post_title LIKE '%" . $searchVal . "%' OR post_detail LIKE '%" . $searchVal . "%' ORDER BY post_date DESC";
                        // echo $query;
                    } else {
                        $query = "SELECT * FROM tbl_posts ORDER BY post_date DESC";
                    }
                    $exe = $conn->query($query);
                    $count = 0;
                    while ($post =  $exe->fetch_array()) {
                        $count++;
                    ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td>
                                <?php
                                if ($post['post_image']) {
                                ?>
                                    <img src="<?= $path . "uploads/" . $post['post_image'] ?>" height="50px" alt="<?= $post['post_title'] ?>">
                                <?php
                                } else {
                                ?>
                                    <img src="<?= $path . "assets/no_image.jpg" ?>" height="50px" alt="<?= $post['post_title'] ?>">

                                <?php
                                }
                                ?>
                            </td>
                            <td><?= $post['post_title'] ?></td>
                            <td><?= subString($post['post_detail'], 75) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn <?= $themeMode == 'light' ? 'btn-warning' : 'btn-outline-warning'; ?>" href="<?= $path ?>index.php?page=posts&mode=edit&id=<?= $post['post_id'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn <?= $themeMode == 'light' ? 'btn-danger' : 'btn-outline-danger'; ?>" href="<?= $path ?>index.php?page=posts&mode=delete&id=<?= $post['post_id'] ?>"><i class="fa fa-trash"></i> Delete</a>
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