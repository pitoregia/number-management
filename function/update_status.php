<?php
// update_status.php

// Assuming you have a database connection established
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE tnumber SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
}
