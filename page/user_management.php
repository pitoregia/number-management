<?php

require_once '../function/dbconnect.php';
require_once '../function/helper.php';

if (isset($_POST['bsave'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $name = $_POST['name'];

    // edit
    if (isset($_GET['q']) == 'edit') {
        $query = mysqli_query($conn, "UPDATE user SET username = '$username', role = '$role', name = '$name' WHERE id = '$_GET[id]'");
        if ($query) {
            echo "<script>alert('Data berhasil diubah!');
            document.location='user_management.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal diubah!')
            document.location='user_management.php';
            </script>";
        }
    } else {
        // save
        $query = mysqli_query($conn, "INSERT INTO user (username, role, name) VALUES ('$username', '$role', '$name')");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan!');
                document.location='user_management.php';
                </script>";
        } else {
            echo "<script>alert('Data gagal disimpan!')
                document.location='user_management.php';
                </script>";
        }
    }
}

$username = '';
$role = '';
$name = '';

if (isset($_GET['q'])) {
    if ($_GET['q'] == 'delete') {
        $query = mysqli_query($conn, "DELETE FROM user WHERE id = '$_GET[id]'");
        if ($query) {
            echo "<script>alert('Data berhasil dihapus!');
            document.location='user_management.php';
            </script>";
        } else {
            echo "<script>alert('Data gagal dihapus!')
            document.location='user_management.php';
            </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>

    <style>
    .table td, .table th {
        text-align: center;
    }
</style>

</head>

<body>

    <div class="card col-8 mt-4 mx-auto shadow">
        <div class="card-header bg-secondary text-light">User Management</div>
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
                    <div class="col-auto">
                        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Add User Modal -->
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
                                    <input type="text" name="username" value="<?= $username ?>" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select" name="role" required>
                                        <option value="<?= $role ?>" selected hidden><?= $role ?></option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value="<?= $name ?>" class="form-control" required />
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

            <!-- User Table -->
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
                $no = 1;

                if (isset($_POST['bsearch'])) {
                    $search = $_POST['tsearch'];
                    $query = mysqli_query($conn, "SELECT * FROM user WHERE username LIKE '%$search%' or role LIKE '%$search%' or name LIKE '%$search%'");
                } else
                    $query = mysqli_query($conn, "SELECT * FROM user order by id asc");

                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td>
                            <a href="edit_user.php?q=edit&id=<?= $row['id'] ?>" name="bedit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="user_management.php?q=delete&id=<?= $row['id'] ?>" name="bdelete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="card-footer bg-secondary"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
