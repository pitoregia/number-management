<?php
// Database connection
require_once('dbconnect.php');

// Query to get the count of users
$sql = "SELECT COUNT(*) as user_count FROM user WHERE role = 'user'";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$user_count = $row['user_count'];

// Query to get the count of admins
$sql = "SELECT COUNT(*) as admin_count FROM user WHERE role = 'admin'";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$admin_count = $row['admin_count'];

// Query to get the total count of users
$sql = "SELECT COUNT(*) as total_count FROM user";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$total_count = $row['total_count'];

