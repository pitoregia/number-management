<?php
require_once '../function/dbconnect.php';
require_once '../function/helper.php';
session_start();

// Fetch data
if (isset($_GET['q']) && $_GET['q'] == 'edit') {
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$_GET[id]'");
    $data = mysqli_fetch_array($query);
    if ($data) {
        $username = $data['username'];
        $name = $data['name'];
    }
}

// Save edited data
if (isset($_POST['bsave'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Edit
    if (isset($_GET['q']) && $_GET['q'] == 'edit') {
        $hashed_password = md5($password); // MD5 hash the password
        $query = mysqli_query($conn, "UPDATE user SET username = '$username', name = '$name', password = '$hashed_password' WHERE id = '$_GET[id]'");
        if ($query) {
            echo "<script>alert('Data berhasil diubah!');
            document.location='user_management.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal diubah!')
            document.location='user_management.php';
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

    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>

    <title>Dashboard | Edit User</title>
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
                                <h5 class="card-header bg-secondary text-light text-center">Edit User</h5>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" value="<?= $username ?>" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">name</label>
                                            <input type="text" name="name" value="<?= $name ?>" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" />
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
</body>

</html>
