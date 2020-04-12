<div class="container">
    <div class="row">
        <!-- <div class="col-md-4">
        </div> -->
        <div class="col-md-4 mx-auto">
            <div class="box shadow">
                <h3 class="box-header">SignIn here</h3>
                <?php
                if (isset($_SESSION['signal'])) {
                    if ($_SESSION['signal'] == 'bad') {
                ?>
                        <p class="alert w-100 alert-danger"><?php echo $_SESSION['msg'] ?></p>
                <?php
                    }
                    unset($_SESSION["signal"]);
                    unset($_SESSION["msg"]);
                }
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
                        <div class="form-group">
                            <input type="submit" name="login_btn" value="Signin" class="btn w-100 btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>