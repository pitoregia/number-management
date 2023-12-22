<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // STATUS UPDATE
    if (isset($_POST['status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $stmt = $conn->prepare("UPDATE tnumber SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }
    // ROLE UPDATE
    elseif (isset($_POST['role_id'])) {
        $id = $_POST['id'];
        $role_id = $_POST['role_id'];

        $stmt = $conn->prepare("UPDATE user SET role_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $role_id, $id);
        $stmt->execute();
        $stmt->close();
    }
    // SCANNED UPDATE
    elseif (isset($_POST['scanned'])) {
        $id = $_POST['id'];
        $scanned = $_POST['scanned'];

        $stmt = $conn->prepare("UPDATE tnumber SET scanned = ? WHERE id = ?");
        $stmt->bind_param("si", $scanned, $id);
        $stmt->execute();
        $stmt->close();
    }
    // WA STATUS UPDATE
    elseif (isset($_POST['wa_status'])) {
        $id = $_POST['id'];
        $wa_status = $_POST['wa_status'];

        $stmt = $conn->prepare("UPDATE tnumber SET wa_status = ? WHERE id = ?");
        $stmt->bind_param("si", $wa_status, $id);
        $stmt->execute();
        $stmt->close();
    }
    // DEVICE UPDATE
    elseif (isset($_POST['device_id'])) {
        $id = $_POST['id'];
        $deviceId = $_POST['device_id'];

        $stmt = $conn->prepare("UPDATE tnumber SET device_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $deviceId, $id);
        $stmt->execute();
        $stmt->close();
    }
    // PIC UPDATE
    elseif (isset($_POST['pic_id'])) {
        $id = $_POST['id'];
        $picId = $_POST['pic_id'];

        $stmt = $conn->prepare("UPDATE tnumber SET pic_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $picId, $id);
        $stmt->execute();
        $stmt->close();
    }
    // current_application UPDATE
    elseif (isset($_POST['current_application_id'])) {
        $id = $_POST['id'];
        $current_application_id = $_POST['current_application_id'];

        $stmt = $conn->prepare("UPDATE tnumber SET current_application_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $current_application_id, $id);
        $stmt->execute();
        $stmt->close();
    }
}
