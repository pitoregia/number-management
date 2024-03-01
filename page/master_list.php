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

function confirmDelete($itemIds)
{
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

function deleteItems($itemIds)
{
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

if (isset($_POST['bsave'])) {
    if (isset($_POST['device'])) {
        $device_name = $_POST['device'];
        // $description = $_POST['description'];
        $category = 'device';

        $query = mysqli_query($conn, "INSERT INTO dropdown_items (name, category) VALUES ('$device_name', '$category')");
    } elseif (isset($_POST['pic'])) {
        $pic_name = $_POST['pic'];
        // $description = $_POST['description'];
        $category = 'pic';

        $query = mysqli_query($conn, "INSERT INTO dropdown_items (name, category) VALUES ('$pic_name', '$category')");
    } elseif (isset($_POST['application'])) {
        $application_name = $_POST['application'];
        // $description = $_POST['description'];
        $category = 'current_application';

        $query = mysqli_query($conn, "INSERT INTO dropdown_items (name, category) VALUES ('$application_name', '$category')");
    }

    if ($query) {
        header("Location: " . BASE_URL . "page/master_list.php");
    } else {
        echo "<script>alert('Data gagal disimpan!')
                document.location='master_list.php';
                </script>";
    }
}

if (isset($_GET['q'])) {
    if ($_GET['q'] == 'delete') {
        $query = mysqli_query($conn, "DELETE FROM dropdown_items WHERE id = '$_GET[id]'");
        if ($query) {
            header("Location: " . BASE_URL . "page/master_list.php");
        } else {
            echo "<script>alert('Data gagal dihapus!')
            document.location='master_list.php';
            </script>";
        }
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
                                    <!-- <button class="btn btn-success" onclick="addItem()">Add <i class="fas fa-plus"></i></button> -->
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- Device Table -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="container">
                                            <div class="row justify-content-between">
                                                <div class="col">
                                                    <form method="POST">
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="tsearch" class="form-control" placeholder="Search" />
                                                            <button class="btn btn-primary" name="bsearch" type="submit">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php if (in_array("edit_number", $_SESSION['role_permission'])) { ?>
                                                    <div class="col-auto">
                                                        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeviceModal">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="addDeviceModalLabel">Add new device</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Device Name</label>
                                                                <input type="text" name="device" value="" class="form-control" required />
                                                            </div>
                                                            <!-- <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="description" value="" class="form-control" required />
                                                    </div> -->
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary" name="bsave" type="submit">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="container">
                                            <div class="row justify-content-between">
                                                <div class="col">
                                                    <form method="POST">
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="tsearch" class="form-control" placeholder="Search" />
                                                            <button class="btn btn-primary" name="bsearch" type="submit">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php if (in_array("edit_number", $_SESSION['role_permission'])) { ?>
                                                    <div class="col-auto">
                                                        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPicModal">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addPicModal" tabindex="-1" aria-labelledby="addPicModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="addPicModalLabel">Add new PIC</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">PIC Name</label>
                                                                <input type="text" name="pic" value="" class="form-control" required />
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary" name="bsave" type="submit">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="container">
                                            <div class="row justify-content-between">
                                                <div class="col">
                                                    <form method="POST">
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="tsearch" class="form-control" placeholder="Search" />
                                                            <button class="btn btn-primary" name="bsearch" type="submit">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php if (in_array("edit_number", $_SESSION['role_permission'])) { ?>
                                                    <div class="col-auto">
                                                        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addApplicationModal">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="addApplicationModal" tabindex="-1" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="addApplicationModalLabel">Add new Application</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Application Name</label>
                                                                <input type="text" name="application" value="" class="form-control" required />
                                                            </div>
                                                            <!-- <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="description" value="" class="form-control" required />
                                                    </div> -->
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary" name="bsave" type="submit">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                                            echo '<a href="master_list.php?q=delete&id=' . $appRow['id'] . '" name="bdelete" class="btn btn-danger""><i class="fa-solid fa-trash"></i></a>';
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