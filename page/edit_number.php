<?php
require_once '../function/dbconnect.php';
require_once '../function/helper.php';


if (isset($_POST['bsave'])) {
    $number = $_POST['number'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $tanggal_aktif = $_POST['tanggal-aktif'];
    $tanggal_expired = $_POST['tanggal-expired'];



    // edit
    if (isset($_GET['q']) == 'edit') {
        $query = mysqli_query($conn, "UPDATE tnumber SET nomor_telp = '$number', status = '$status', tanggal_aktif = '$tanggal_aktif', tanggal_expired = '$tanggal_expired', deskripsi = '$description' WHERE id = '$_GET[id]'");
        if ($query) {
            echo "<script>alert('Data berhasil diubah!');
            document.location='index.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal diubah!')
            document.location='index.php';
            </script>";
        }
    } else {
        // save
        $query = mysqli_query($conn, "INSERT INTO tnumber (nomor_telp, status, tanggal_aktif, tanggal_expired, deskripsi) VALUES ('$number', '$status', '$tanggal_aktif', '$tanggal_expired', '$description')");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan!');
          document.location='index.php';
          </script>";
        } else {
            echo "<script>alert('Data gagal disimpan!')
          document.location='index.php';
          </script>";
        }
    }
}

if (isset($_GET['q'])) {
    if (
        $_GET['q'] == 'edit'
    ) {
        $query = mysqli_query($conn, "SELECT * FROM tnumber WHERE id = '$_GET[id]'");
        $data = mysqli_fetch_array($query);
        if ($data) {
            $phone_number = $data['nomor_telp'];
            $description = $data['deskripsi'];
            $status = $data['status'];
            $tanggal_aktif = $data['tanggal_aktif'];
            $tanggal_expired = $data['tanggal_expired'];
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Number Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Simulation Page</h3>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-light">Input</div>
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
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="<?= $status ?>" selected hidden><?= $status ?></option>
                                    <option value="Hidup">Hidup</option>
                                    <option value="Tenggang">Tenggang</option>
                                    <option value="Mati">Mati</option>
                                </select>
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
                    <div class="card-footer bg-secondary"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>