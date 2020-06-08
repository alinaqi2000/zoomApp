<div class="container">
    <div class="row">
        <!-- <div class="col-md-4">
        </div> -->
        <div class="col-md-4 mx-auto">
            <div class="box shadow">
                <?php
                if ($_REQUEST['mode'] != "signup") {
                ?>
                    <h3 class="box-header">SignIn here</h3>
                <?php
                } else {
                ?>
                    <h3 class="box-header">SignUp here</h3>
                <?php
                }
                ?>
                <?php
                showMessage('w-100');
                ?>
                <div class="box-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text" name="username" autocomplete="off" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" autocomplete="off" id="password" class="form-control">
                        </div>

                        <?php
                        if ($_REQUEST['mode'] != "signup") {
                        ?>
                            <div class="form-group">
                                <input type="submit" name="login_btn" value="Signin" class="btn w-100 <?= $themeMode == 'light' ? 'btn-info' : 'btn-outline-info'; ?>">
                            </div>
                            <hr />
                            <div class="form-group">
                                <a href="<?= $path ?>index.php?page=authentication&mode=signup" class="btn w-100 <?= $themeMode == 'light' ? 'btn-info' : 'btn-outline-info'; ?>">Signup</a>
                            </div>

                        <?php
                        } else {
                        ?>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" name="conf_password" autocomplete="off" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="signup_btn" value="Signup" class="btn w-100 <?= $themeMode == 'light' ? 'btn-info' : 'btn-outline-info'; ?>">
                            </div>
                            <hr />
                            <div class="form-group">
                                <a href="<?= $path ?>index.php?page=authentication" class="btn w-100 <?= $themeMode == 'light' ? 'btn-info' : 'btn-outline-info'; ?>">Login</a>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>