<?php
unset($_SESSION['site_id']);
header('Location: http://localhost/zoomApp/index.php?page=login');
die();
