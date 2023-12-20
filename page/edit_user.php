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

    // Check if a new password is provided
    $hashed_password = $data['password']; // default to the current hashed password

    if (!empty($password)) {
        $hashed_password = md5($password); // MD5 hash the new password
    }

    // Edit
    if (isset($_GET['q']) && $_GET['q'] == 'edit') {
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
    <?php include('../components/header.php'); ?>
    <title>Dashboard | Edit User</title>
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
</body>

</html>