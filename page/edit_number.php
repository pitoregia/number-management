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
    <?php include('../components/header.php'); ?>
    <title>Dashboard | Edit Number</title>
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
</body>

</html>