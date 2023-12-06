<?php

require_once('../function/dbconnect.php');
require_once('../function/helper.php');

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) != 0) {
    $row = mysqli_fetch_assoc($query);

    session_start();
    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['name'] = $row['name'];
    if ($row['role'] == 'admin') {
        // header("Location: " . BASE_URL . "dashboard.php?page=admin");
        header("Location: " . BASE_URL . "index.php?page=admin");
    } else if ($row['role'] == 'user') {
        // header("Location: " . BASE_URL . "dashboard.php?page=user");
        header("Location: " . BASE_URL . "index.php?page=user");
    }
} else {
    header("Location: " . BASE_URL . "index.php?error=failed");
}
