<?php
require_once('../function/dbconnect.php');
require_once('../function/helper.php');


session_start();
unset($_SESSION['id']);
unset($_SESSION['role']);

header("Location: " . BASE_URL);
