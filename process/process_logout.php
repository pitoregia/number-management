<?php
require_once('../function/dbconnect.php');
require_once('../function/helper.php');


session_start();
unset($_SESSION['admin_username']);
unset($_SESSION['role_permission']);
unset($_SESSION['role_id']);


unset($_SESSION['id']);
unset($_SESSION['role']);
unset($_SESSION['name']);


header("Location: " . BASE_URL);
