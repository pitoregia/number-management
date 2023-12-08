<?php

require_once '../function/dbconnect.php';
require_once '../function/helper.php';
session_start();

// Check if the user is logged in
if ($_SESSION['id'] == null) {
    header("Location: " . BASE_URL);
    exit();
}

// Handle user data insertion
if (isset($_POST['bsave_user'])) {
    $username = $_POST['username'];
    $role = 'USER';
    $password = md5($_POST['password']);
    $name = $_POST['name'];

    $query = mysqli_query($conn, "INSERT INTO user (username, role, password, name) VALUES ('$username', '$role', '$password','$name')");

    if ($query) {
        echo "<script>alert('User data saved successfully!');
                document.location='user_management.php';
                </script>";
    } else {
        echo "<script>alert('Failed to save user data!')
                document.location='user_management.php';
                </script>";
    }
}

// Initialize variables for user data
$user_username = '';
$user_role = '';

// Handle user deletion
if (isset($_GET['q_user'])) {
    if ($_GET['q_user'] == 'delete') {
        // Delete user data from the 'users' table
        $query = mysqli_query($conn, "DELETE FROM user WHERE id = '$_GET[id]'");
        if ($query) {
            header("Location: " . BASE_URL . "page/user_management.php");
        } else {
            echo "<script>alert('Failed to delete user data!')
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

    <link href="<?php echo BASE_URL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/custom.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>

    <title>Dashboard | List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>User Management</title>
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
                <div class="container">
                    <div class="card col-12 mt-4 mx-auto shadow">
                        <div class="card-body">
                            <div class="container">
                                <!-- Search and Add User Form -->
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <form method="POST">
                                            <div class="input-group mb-3">
                                                <input type="text" name="tsearch_user" class="form-control" placeholder="Search" />
                                                <button class="btn btn-primary" name="bsearch_user" type="submit">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal for add User -->
                                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="addUserModalLabel">Add new user</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" name="username" class="form-control" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" name="password" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" name="bsave_user" type="submit">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Table User -->
                                <div class="table-wrap card-shadow mb-4">
                                    <table class="table text-align-center table-responsive-xl table-bordered">
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        $no = 1;

                                        if (isset($_POST['bsearch_user'])) {
                                            $search = $_POST['tsearch_user'];
                                            $query = mysqli_query($conn, "SELECT * FROM user WHERE username LIKE '%$search%' or role LIKE '%$search%' or name LIKE '%$search%'");
                                        } else
                                            $query = mysqli_query($conn, "SELECT * FROM user order by id asc");

                                        while ($row = mysqli_fetch_array($query)) {

                                            $statusClass = '';
                                            switch ($row['role']) {
                                                case 'ADMIN':
                                                    // $statusClass = 'bg-warning';
                                                    $statusClass = 'btn-warning';
                                                    break;
                                                case 'USER':
                                                    $statusClass = 'btn-success';
                                                    break;
                                                    // Add more cases for other statuses if needed

                                                    // Default case if none of the above conditions match
                                                default:
                                                    $statusClass = 'btn-danger';
                                                    break;
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['username'] ?></td>
                                                <td class="row-id" style="display: none;"><?= $row['id'] ?></td> <!-- Hidden row ID -->
                                                <td>
                                                    <button type="button" class="btn <?= $statusClass ?> dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $row['role'] ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item role-item" href="#">ADMIN</a></li>
                                                        <li><a class="dropdown-item role-item" href="#">USER</a></li>
                                                    </ul>
                                                </td>
                                                <td><?= $row['name'] ?></td>
                                                <td>
                                                    <a href="edit_user.php?q=edit&id=<?= $row['id'] ?>" name="bedit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a href="user_management.php?q_user=delete&id=<?= $row['id'] ?>" name="bdelete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
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