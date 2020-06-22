<?php
unset($_SESSION['site_id']);
unset($_SESSION['site_user_id']);
header('Location: http://localhost/zoomApp/index.php?page=login');
die();
