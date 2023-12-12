<?php
require_once '../function/dbconnect.php';
require_once '../function/helper.php';
session_start();


if (!in_array("edit_user", $_SESSION['role_permission'])) {
    header("Location: " . BASE_URL . "index.php");
    exit();
}

// fetch data
if (isset($_GET['q'])) {
    if (
        $_GET['q'] == 'edit'
    ) {
        $query = mysqli_query($conn, "SELECT * FROM tnumber WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($query);
        if ($data) {
            $phone_number = $data['nomor_telp'];
            $description = $data['deskripsi'];
            // $status = $data['status'];
            $tanggal_aktif = $data['tanggal_aktif'];
            $tanggal_expired = $data['tanggal_expired'];
        }
    }
}

// save edited data
if (isset($_POST['bsave'])) {
    $number = $_POST['number'];
    $description = $_POST['description'];
    // $status = $_POST['status'];
    $tanggal_aktif = $_POST['tanggal-aktif'];
    $tanggal_expired = $_POST['tanggal-expired'];

    // edit
    if (isset($_GET['q']) == 'edit') {
        $query = mysqli_query($conn, "UPDATE tnumber SET nomor_telp = '$number', tanggal_aktif = '$tanggal_aktif', tanggal_expired = '$tanggal_expired', deskripsi = '$description' WHERE id = '$_GET[id]'");
        if ($query) {
            echo "<script>alert('Data berhasil diubah!');
            document.location='number_list.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal diubah!')
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

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="<?php echo BASE_URL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>

    <title>Dashboard | Edit Number</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('../components/sidebar.php'); ?>

        <!-- Page Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php include('../components/topbar.php'); ?>

            <div id="content">

                <div class="container mt-3">

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card shadow">
                                <h5 class="card-header bg-secondary text-light text-center">Edit Number</h5>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="number" value="<?= $phone_number ?>" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" value="<?= $description ?>" class="form-control" />
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Masa Aktif</label>
                                                    <input type="date" name="tanggal-aktif" value="<?= $tanggal_aktif ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Masa Expired</label>
                                                    <input type="date" name="tanggal-expired" value="<?= $tanggal_expired ?>" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <hr />
                                            <button class="btn w-100 btn-primary text-center" name="bsave" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
</body>

</html>