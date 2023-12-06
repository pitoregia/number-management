<?php

require_once('dbconnect.php');

// Query to get the count of users
$currentDate = date('Y-m-d');

$sql = "SELECT COUNT(*) as expired_number FROM tnumber WHERE tanggal_expired < '$currentDate'";
$result = mysqli_query($conn, $sql);

// Fetch the result
$row = mysqli_fetch_assoc($result);
$expired_number = $row['expired_number'];

$active_date = "SELECT COUNT(*) as active_date FROM tnumber WHERE tanggal_aktif = '$currentDate'";
