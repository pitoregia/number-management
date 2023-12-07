<?php

require_once('dbconnect.php');

// Query to get the count of expired (mati) numbers
$sql = "SELECT COUNT(*) as expired_number FROM tnumber WHERE status = 'Mati'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$expired_number = $row['expired_number'];

// Query to get the count of numbers in the grace period (tenggang)
$sql = "SELECT COUNT(*) as grace_period_number FROM tnumber WHERE status = 'Tenggang'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$grace_period_number = $row['grace_period_number'];

// Query to get the count of active numbers
$sql = "SELECT COUNT(*) as active_number FROM tnumber WHERE status = 'Hidup'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$active_number = $row['active_number'];

