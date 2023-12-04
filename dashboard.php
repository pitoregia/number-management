<?php
require_once('function/dbconnect.php');
require_once('function/helper.php');

session_start();
$page = isset($_GET['page']) ? $_GET['page'] : false;
if ($_SESSION['id'] == null) {
    header("Location: " . BASE_URL);
    exit();
}
