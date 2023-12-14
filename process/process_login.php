<?php
session_start();
require_once('../function/dbconnect.php');
require_once('../function/helper.php');

$username = $_POST['username'];
$password = md5($_POST['password']);

$q1 = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($q1) != 0) {
    $r1 = mysqli_fetch_assoc($q1);

    $_SESSION['id'] = $r1['id'];
    $_SESSION['role'] = $r1['role'];
    $_SESSION['name'] = $r1['name'];

    $role_id = $r1['role_id'];


    $sql1 = "SELECT * FROM role_permission WHERE role_id = '$role_id'";

    $q2 = mysqli_query($conn, $sql1);

    $access = array();
    while ($r2 = mysqli_fetch_assoc($q2)) {
        $access[] = $r2['permission_id'];
    }

    if (empty($access)) {
        echo "<li>Access not found</li>";
    }

    $_SESSION['admin_username'] = $username;
    $_SESSION['role_permission'] = $access;
    $_SESSION['role_id'] = $role_id;



    header("Location: " . BASE_URL . "index.php");
    exit();
} else {
    header("Location: " . BASE_URL . "index.php?error=failed");
}
