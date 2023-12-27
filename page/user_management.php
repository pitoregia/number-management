<?php
session_start();
require_once '../function/dbconnect.php';
require_once '../function/helper.php';

if (!in_array("edit_user", $_SESSION['role_permission'])) {
    header("Location: " . BASE_URL . "index.php");
    exit();
}

// Check if the user is logged in
if ($_SESSION['role_id'] == null) {
    header("Location: " . BASE_URL);
    exit();
}

// Handle user data insertion
if (isset($_POST['bsave_user'])) {
    $username = $_POST['username'];
    $role_id = 2;
    $password = md5($_POST['password']);
    $name = $_POST['name'];

    // $query = mysqli_query($conn, "INSERT INTO user (username, role, password, name) VALUES ('$username', '$role', '$password','$name')");
    $query = mysqli_query($conn, "INSERT INTO user (username, role_id, password, name) VALUES ('$username', '$role_id', '$password','$name')");

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
    <?php include('../components/header.php'); ?>
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
                                            switch ($row['role_id']) {
                                                case '1': // admin
                                                    // $statusClass = 'bg-warning';
                                                    $statusClass = 'btn-warning';
                                                    break;
                                                case '2': // user
                                                    $statusClass = 'btn-success';
                                                    break;
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
                                                    <?php
                                                    $roleSql = "SELECT role_id, role_name FROM role";
                                                    $roleQuery = mysqli_query($conn, $roleSql);

                                                    $role_id = $row['role_id'];
                                                    $selectedRoleSql = "SELECT role_name FROM role WHERE role_id = '$role_id'";
                                                    $selectedRoleQuery = mysqli_query($conn, $selectedRoleSql);
                                                    $selectedRoleRow = mysqli_fetch_assoc($selectedRoleQuery);
                                                    $selectedRoleName = $selectedRoleRow['role_name'];
                                                    ?>
                                                    <button type="button" class="btn <?= $statusClass ?> dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?= $selectedRoleName ?>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php
                                                        // Display device dropdown items
                                                        while ($roleRow = mysqli_fetch_assoc($roleQuery)) {
                                                            echo '<li><a class="dropdown-item role-item" data-role-id="' . $roleRow['role_id'] . '"href="#">' . $roleRow['role_name'] . '</a></li>';
                                                        }
                                                        ?>
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

</body>

</html>