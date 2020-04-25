<?php
error_reporting(1);
session_start();
global $conn;
$conn = mysqli_connect('localhost', 'root', '', 'zoomapp_db');
