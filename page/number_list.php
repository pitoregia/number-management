<?php
// require_once '../function/check_dates_and_notify.php';
require_once '../function/dbconnect.php';
require_once '../function/helper.php';
// include '../function/date_checker.php';
session_start();

// if (!in_array("edit_number", $_SESSION['role_permission'])) {
//     echo "<h1>Access Denied</h1>";
//     include("inc_footer.php");
//     exit();
// }

if (isset($_POST['bsave'])) {
    $number = $_POST['number'];
    $description = $_POST['description'];
    // $status = $_POST['status'];
    $status = 'HIDUP';
    $tanggal_aktif = $_POST['tanggal-aktif'];
    $tanggal_expired = $_POST['tanggal-expired'];

    $query = mysqli_query($conn, "INSERT INTO tnumber (nomor_telp, status, tanggal_aktif, tanggal_expired, deskripsi) VALUES ('$number', '$status', '$tanggal_aktif', '$tanggal_expired', '$description')");

    if ($query) {
        // echo "<script>alert('Data berhasil disimpan!');
        //         document.location='number_list.php';
        //         </script>";
        header("Location: " . BASE_URL . "page/number_list.php");
    } else {
        echo "<script>alert('Data gagal disimpan!')
                document.location='number_list.php';
                </script>";
    }



    // Fetch PIC dropdown items
    $picSql = "SELECT id, name FROM dropdown_items WHERE category = 'pic'";
    // Execute query and display dropdown items...

    // Fetch current_application dropdown items
    $currentAppSql = "SELECT id, name FROM dropdown_items WHERE category = 'current_application'";
    // Execute query and display dropdown items...
}


$phone_number = '';
$description = '';
$status = '';
$tanggal_aktif = '';
$tanggal_expired = '';

if (isset($_GET['q'])) {
    if ($_GET['q'] == 'delete') {
        $query = mysqli_query($conn, "DELETE FROM tnumber WHERE id = '$_GET[id]'");
        if ($query) {
            header("Location: " . BASE_URL . "page/number_list.php");
        } else {
            echo "<script>alert('Data gagal dihapus!')
            document.location='number_list.php';
            </script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icon/favicon-16x16.png">
    <link rel="manifest" href="../assets/icon/site.webmanifest">

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="<?php echo BASE_URL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>

    <title>Dashboard | List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .table td,
        .table th {
            text-align: center;
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('../components/sidebar.php'); ?>

        <!-- Page Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php include('../components/topbar.php'); ?>
            <div id="content">
                <div class="container-fluid">
                    <div class="card col-12 mt-4 mx-auto shadow">
                        <!-- <div class="card-header bg-secondary text-light">Data Phone Number</div> -->
                        <div class="card-body">
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
                                            <form name="notifyForm" method="post">
                                                <button type="submit" id="notifyButton" class="btn btn-warning">
                                                    <i class="fa-brands fa-telegram fa-xl"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-auto">
                                            <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNumberModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="addNumberModal" tabindex="-1" aria-labelledby="addNumberModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="addNumberModalLabel">Add new number</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="number" value="<?= $phone_number ?>" class="form-control" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" name="description" value="<?= $description ?>" class="form-control" required />
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal Masa Aktif</label>
                                                            <input type="date" name="tanggal-aktif" value="<?= $tanggal_aktif ?>" class="form-control" required />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal Masa Expired</label>
                                                            <input type="date" name="tanggal-expired" value="<?= $tanggal_expired ?>" class="form-control" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <hr />

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

                            <div class="table-wrap card-shadow mb-4">
                                <table class="table text-align-center table-responsive-xl table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nomor</th>
                                            <th>Status</th>
                                            <th>Tanggal Aktif</th>
                                            <th>Tanggal Expired</th>
                                            <!-- <th>Deskripsi</th> -->
                                            <th>Current Device</th>
                                            <th>WA Status</th>
                                            <th>PIC</th>
                                            <th>Scan Status</th>
                                            <th>Current Application</th>
                                            <?php if (in_array("edit_number", $_SESSION['role_permission'])) { ?>
                                                <th>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $no = 1;
                                        if (isset($_POST['bsearch'])) {
                                            $search = $_POST['tsearch'];
                                            $query = mysqli_query($conn, "SELECT * FROM tnumber WHERE nomor_telp LIKE '%$search%' or status LIKE '%$search%' or tanggal_aktif LIKE '%$search%' or tanggal_expired LIKE '%$search%' or deskripsi LIKE '%$search%'");
                                        } else {
                                            $query = mysqli_query($conn, "SELECT * FROM tnumber order by id asc");
                                        }
                                        while ($row = mysqli_fetch_array($query)) {
                                            include '../function/class_checker.php';

                                        ?>


                                            <tr>
                                                <td><strong><?= $no++ ?></strong></td>
                                                <td><?= $row['nomor_telp'] ?></td>
                                                <td class="row-id" style="display: none;"><?= $row['id'] ?></td> <!-- Hidden row ID -->
                                                <td>
                                                    <?php if (in_array("edit_user", $_SESSION['role_permission'])) { ?>
                                                        <button type="button" class="btn <?= $statusClass ?> dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <?= $row['status'] ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item status-item" href="#">HIDUP</a></li>
                                                            <li><a class="dropdown-item status-item" href="#">TENGGANG</a></li>
                                                            <li><a class="dropdown-item status-item" href="#">MATI</a></li>
                                                        </ul>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn <?= $statusClass ?> " data-bs-toggle="dropdown" aria-expanded="false">
                                                            <?= $row['status'] ?>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                                <td class="fw-bold <?php echo $activeDateClass ?>"><?= $row['tanggal_aktif'] ?></td>
                                                <td class="fw-bold <?php echo $expiredDateClass ?>"><?= $row['tanggal_expired'] ?></td>
                                                <!-- <td><?= $row['deskripsi'] ?></td> -->



                                                <?php
                                                // Fetch device dropdown items
                                                $deviceSql = "SELECT id, name FROM dropdown_items WHERE category = 'device'";
                                                $deviceQuery = mysqli_query($conn, $deviceSql);

                                                // Fetch the selected device name for the current row
                                                $device_id = $row['device_id'];
                                                $selectedDeviceSql = "SELECT name FROM dropdown_items WHERE id = '$device_id'";
                                                $selectedDeviceQuery = mysqli_query($conn, $selectedDeviceSql);
                                                $selectedDeviceRow = mysqli_fetch_assoc($selectedDeviceQuery);
                                                $selectedDeviceName = $selectedDeviceRow['name'];
                                                ?>

                                                <td>
                                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $selectedDeviceName ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php
                                                        // Display device dropdown items
                                                        while ($deviceRow = mysqli_fetch_assoc($deviceQuery)) {
                                                            echo '<li><a class="dropdown-item status-item" href="#">' . $deviceRow['name'] . '</a></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </td>


                                                <td>
                                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $row['wa_status'] ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item status-item" href="#">AVAILABLE</a></li>
                                                        <li><a class="dropdown-item status-item" href="#">BANNED</a></li>
                                                        <li><a class="dropdown-item status-item" href="#">BANNED PERMANENT</a></li>
                                                        <li><a class="dropdown-item status-item" href="#">UNREGISTERED</a></li>
                                                        <li><a class="dropdown-item status-item" href="#">ERROR OFFICIAL</a></li>
                                                    </ul>
                                                </td>



                                                <?php
                                                // Fetch device dropdown items
                                                $picSql = "SELECT id, name FROM dropdown_items WHERE category = 'pic'";
                                                $picQuery = mysqli_query($conn, $picSql);

                                                // Fetch the selected pic name for the current row
                                                $pic_id = $row['pic_id'];
                                                $selectedPicSql = "SELECT name FROM dropdown_items WHERE id = '$pic_id'";
                                                $selectedPicQuery = mysqli_query($conn, $selectedPicSql);
                                                $selectedPicRow = mysqli_fetch_assoc($selectedPicQuery);
                                                $selectedPicName = $selectedPicRow['name'];
                                                ?>

                                                <td>
                                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $selectedPicName ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php
                                                        // Display pic dropdown items
                                                        while ($picRow = mysqli_fetch_assoc($picQuery)) {
                                                            echo '<li><a class="dropdown-item status-item" href="#">' . $picRow['name'] . '</a></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </td>


                                                <td>
                                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $row['scanned'] ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item status-item" href="#">SCANNED</a></li>
                                                        <li><a class="dropdown-item status-item" href="#">NOT SCANNED</a></li>
                                                    </ul>
                                                </td>


                                                <?php
                                                // Fetch device dropdown items
                                                $currentApplicationSql = "SELECT id, name FROM dropdown_items WHERE category = 'current_application'";
                                                $currentApplicationQuery = mysqli_query($conn, $currentApplicationSql);

                                                // Fetch the selected currentApplication name for the current row
                                                $currentApplication_id = $row['current_application_id'];
                                                $selectedcurrentApplicationSql = "SELECT name FROM dropdown_items WHERE id = '$currentApplication_id'";
                                                $selectedcurrentApplicationQuery = mysqli_query($conn, $selectedcurrentApplicationSql);
                                                $selectedcurrentApplicationRow = mysqli_fetch_assoc($selectedcurrentApplicationQuery);
                                                $selectedcurrentApplicationName = $selectedcurrentApplicationRow['name'];
                                                ?>

                                                <td>
                                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $selectedcurrentApplicationName ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php
                                                        // Display currentApplication dropdown items
                                                        while ($currentApplicationRow = mysqli_fetch_assoc($currentApplicationQuery)) {
                                                            echo '<li><a class="dropdown-item status-item" href="#">' . $currentApplicationRow['name'] . '</a></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </td>


                                                <?php if (in_array("edit_number", $_SESSION['role_permission'])) { ?>
                                                    <td>
                                                        <!-- <a href=" edit_number.php?q=edit&id=<?= $row['id'] ?>" name="bedit" class="btn btn-warning "><i class="fa-solid fa-pen-to-square"></i></a> -->
                                                        <a href="number_list.php?q=delete&id=<?= $row['id'] ?>" name="bdelete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')"><i class="fa-solid fa-trash"></i></a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include('../components/footer.php'); ?>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

    <!-- JavaScript -->
    <script src="<?php echo BASE_URL ?>assets/js/script.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    <script src="<?php echo BASE_URL ?>assets/js/Notif_check.js"></script>

</body>

</html>