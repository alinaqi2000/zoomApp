<?php
error_reporting(1);
session_start();
global $conn;
$conn = mysqli_connect('localhost', 'root', '', 'zoomapp_db');
$user_id = $_SESSION['site_user_id'];


date_default_timezone_set("Asia/Karachi");
