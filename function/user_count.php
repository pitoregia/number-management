<?php
// Database connection
require_once('dbconnect.php');

// Query to get the count of users
$sql = "SELECT COUNT(*) as user_count FROM user";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$user_count = $row['user_count'];