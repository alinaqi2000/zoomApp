<header class="mb-3 shadow">
    <nav class="navbar navbar-expand-lg <?= $themeMode == 'light' ? 'navbar-light bg-light' : 'navbar-dark bg-dark';  ?>">
        <a class="navbar-brand" href="index.php"><img src="assets/new_logo.png" height="60px" width="150px" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $_REQUEST['page'] == '' ? 'active' : ''; ?>" href="<?= $path ?>index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $_REQUEST['page'] == 'calculators' ? 'active' : ''; ?>" href="<?= $path ?>index.php?page=calculators">Calculators</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  <?= $_REQUEST['page'] == 'posts' ? 'active' : ''; ?>" href="<?= $path ?>index.php?page=posts">Posts</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  <?= $_REQUEST['page'] == 'users_entry' ? 'active' : ''; ?>" href="<?= $path ?>index.php?page=users_entry">User Entry</a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item">
                    <button class="nav-link btn active" id="theme_btn" data-url="<?= $path . 'codes/switch-theme.php' ?>" name="theme_btn" type="submit"><?= $themeMode == 'light' ? 'Dark Mode' : 'Light Mode';  ?>
                    </button>
                </li>
                <li class="nav-item">
                    <?php
                    if ($_SESSION['site_id'] == '1') {
                    ?>
                        <a class="nav-link active" href="<?= $path ?>index.php?page=logout">Sign Out</a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link active" href="<?= $path ?>index.php?page=login">Sign In</a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</header>