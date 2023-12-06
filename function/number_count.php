<?php
// Database connection
require_once('dbconnect.php');

// Query to get the count of users
$sql = "SELECT COUNT(*) as number_count FROM tnumber";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$number_count = $row['number_count'];