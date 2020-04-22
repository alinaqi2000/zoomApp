<div class="col-md-12">
    <div class="row">
        <h4>Manage Posts</h4>
    </div>
    <?php
    if ($_REQUEST['mode'] == 'add') {
    ?>
        <div class="row">
            <form action="" class="col-md-8 my-3">
                <div class="form-group">
                    <label for="">Post Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Post Detail</label>
                    <textarea class="form-control" name="detail" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn <?= $themeMode == 'light' ? 'btn-success' : 'btn-outline-success'; ?>" value="Save" name="save_post">
                    <a href="<?= $path ?>index.php?page=posts" class="btn <?= $themeMode == 'light' ? 'btn-secondary' : 'btn-outline-secondary'; ?>">Back</a>
                </div>
            </form>
        </div>
    <?php
    } else {
    ?>
        <div class="row">
            <a href="<?= $path ?>index.php?page=posts&mode=add" class="btn <?= $themeMode == 'light' ? 'btn-success' : 'btn-outline-success'; ?>">Add new</a>
        </div>
        <div class="row">
            <table class="table table-striped table-hover <?= $themeMode == 'light' ? '' : 'table-dark'; ?>">
                <thead>
                    <tr>
                        <th width="3%">No.</th>
                        <th>Title</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "SELECT * FROM tbl_posts ORDER BY post_id DESC";
                    $exe = $conn->query($query);
                    $count = 0;
                    while ($user =  $exe->fetch_array()) {
                        $count++;
                    ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $user['post_title'] ?></td>
                            <td><?= subString($user['post_detail']) ?></td>
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