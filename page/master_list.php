<?php
require_once '../function/dbconnect.php';
require_once '../function/helper.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteItems']) && !empty($_POST['deleteItems'])) {
        deleteItems($_POST['deleteItems']);
    }
}

function deleteItems($itemIds) {
    global $conn;

    $safeItemIds = array_map('intval', $itemIds);
    $deleteIds = implode(',', $safeItemIds);
    $sql = "DELETE FROM dropdown_items WHERE id IN ($deleteIds)";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Items deleted successfully.");</script>';
    } else {
        echo '<script>alert("Error deleting items.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../components/header.php'); ?>
    <title>Dashboard | List</title>
    <style>
        .table td,
        .table th {
            text-align: center;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?php include('../components/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <?php include('../components/topbar.php'); ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card mt-4 shadow">
                            <div class="card-header bg-primary text-white">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item mx-1">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Device</button>
                                    </li>
                                    <li class="nav-item mx-1">
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">PIC</button>
                                    </li>
                                    <li class="nav-item mx-1">
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Current Application</button>
                                    </li>
                                    <form method="post" id="deleteForm">
                                        <button type="button" class="btn btn-danger ms-auto mx-1" onclick="deleteItems()">Delete <i class="fas fa-trash"></i></button>
                                    </form>
                                    <button class="btn btn-success" onclick="addItem()">Add <i class="fas fa-plus"></i></button>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Device Table -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <form method="post">
                                            <table class="table text-align-center table-responsive-xl table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">
                                                        </th>
                                                        <th>Device</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $deviceSql = "SELECT id, name FROM dropdown_items WHERE category = 'device'";
                                                    $deviceQuery = mysqli_query($conn, $deviceSql);
                                                    while ($deviceRow = mysqli_fetch_assoc($deviceQuery)) {
                                                        echo '<tr><td><input type="checkbox" class="deviceCheckbox" name="deleteItems[]" value="' . $deviceRow['id'] . '"></td><td>' . $deviceRow['name'] . '</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- PIC Table -->
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <form method="post">
                                            <table class="table text-align-center table-responsive-xl table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">
                                                        </th>
                                                        <th>PIC</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $picSql = "SELECT id, name FROM dropdown_items WHERE category = 'pic'";
                                                    $picQuery = mysqli_query($conn, $picSql);
                                                    while ($picRow = mysqli_fetch_assoc($picQuery)) {
                                                        echo '<tr><td><input type="checkbox" class="picCheckbox" name="deleteItems[]" value="' . $picRow['id'] . '"></td><td>' . $picRow['name'] . '</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- Current Application Table -->
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <form method="post">
                                            <table class="table text-align-center table-responsive-xl table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">
                                                        </th>
                                                        <th>Current Application</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $appSql = "SELECT id, name FROM dropdown_items WHERE category = 'current_application'";
                                                    $appQuery = mysqli_query($conn, $appSql);
                                                    while ($appRow = mysqli_fetch_assoc($appQuery)) {
                                                        echo '<tr><td><input type="checkbox" class="appCheckbox" name="deleteItems[]" value="' . $appRow['id'] . '"></td><td>' . $appRow['name'] . '</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('../components/footer.php'); ?>
        </div>
    </div>

    <!-- Your existing scripts and closing tags -->

    <script>
        function deleteItems() {
            const confirmation = confirm('Are you sure you want to delete the selected items?');

            if (confirmation) {
                document.getElementById('deleteForm').submit();
            }
        }

        function addItem() {
            // Implement add item logic here
            alert('Add item functionality to be implemented.');
        }
    </script>

</body>

</html>
