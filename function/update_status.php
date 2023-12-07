<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['status'])) {
        // Update tnumber table
        $id = $_POST['id'];
        $status = $_POST['status'];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE tnumber SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['role'])) {
        // Update another table (replace 'your_other_table' with the actual table name)
        $id = $_POST['id'];
        $role = $_POST['role'];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE user SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $id);
        $stmt->execute();
        $stmt->close();
    }
}
