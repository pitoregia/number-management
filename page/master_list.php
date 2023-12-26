<?php
require_once '../function/dbconnect.php';
require_once '../function/helper.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteItems']) && !empty($_POST['deleteItems'])) {
        confirmDelete($_POST['deleteItems']);
    } elseif (isset($_POST['confirmedDeleteItems']) && !empty($_POST['confirmedDeleteItems'])) {
        deleteItems($_POST['confirmedDeleteItems']);
    }
}

function confirmDelete($itemIds) {
    global $conn;

    echo '<div class="alert alert-warning" role="alert">
            Are you sure you want to delete the selected item(s)?
            <form method="post">
                <input type="hidden" name="confirmedDeleteItems" value="' . implode(',', $itemIds) . '">
                <button type="submit" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="alert" aria-label="Close">No</button>
            </form>
          </div>';
}

function deleteItems($itemIds) {
    global $conn;

    $safeItemIds = array_map('intval', explode(',', $itemIds));
    $deleteIds = implode(',', $safeItemIds);
    $sql = "DELETE FROM dropdown_items WHERE id IN ($deleteIds)";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success" role="alert">
                Items deleted successfully.
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error deleting items.
              </div>';
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

        .action-row {
            height: 30px;
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
                                                        <th>Device</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $deviceSql = "SELECT id, name, category FROM dropdown_items WHERE category = 'device'";
                                                    $deviceQuery = mysqli_query($conn, $deviceSql);
                                                    while ($deviceRow = mysqli_fetch_assoc($deviceQuery)) {
                                                        echo '<tr>
                                                                <td>' . $deviceRow['name'] . '</td>
                                                                <td class="action-row">';
                                                        if ($deviceRow['category'] !== 'nav') {
                                                            echo '<button type="button" class="btn btn-danger" onclick="confirmDelete(' . $deviceRow['id'] . ')">Delete</button>';
                                                        }
                                                        echo '</td>
                                                            </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <form method="post">
                                            <table class="table text-align-center table-responsive-xl table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>PIC</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $picSql = "SELECT id, name, category FROM dropdown_items WHERE category = 'pic'";
                                                    $picQuery = mysqli_query($conn, $picSql);
                                                    while ($picRow = mysqli_fetch_assoc($picQuery)) {
                                                        echo '<tr>
                                                                <td>' . $picRow['name'] . '</td>
                                                                <td class="action-row">';
                                                        if ($picRow['category'] !== 'nav') {
                                                            echo '<button type="button" class="btn btn-danger" onclick="confirmDelete(' . $picRow['id'] . ')">Delete</button>';
                                                        }
                                                        echo '</td>
                                                            </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <form method="post">
                                            <table class="table text-align-center table-responsive-xl table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Current Application</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $appSql = "SELECT id, name, category FROM dropdown_items WHERE category = 'current_application'";
                                                    $appQuery = mysqli_query($conn, $appSql);
                                                    while ($appRow = mysqli_fetch_assoc($appQuery)) {
                                                        echo '<tr>
                                                                <td>' . $appRow['name'] . '</td>
                                                                <td class="action-row">';
                                                        if ($appRow['category'] !== 'nav') {
                                                            echo '<button type="button" class="btn btn-danger" onclick="confirmDelete(' . $appRow['id'] . ')">Delete</button>';
                                                        }
                                                        echo '</td>
                                                            </tr>';
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

</body>

</html>
