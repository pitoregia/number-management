<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fdb40b4321.js" crossorigin="anonymous"></script>

    <title>Dashboard | Number Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
    .password-group {
        position: relative;
    }

    .password-icon {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
    }

    .center-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Adjust as needed */
    }
   </style>

</head>

<body class="bg-gradient-primary">
      <div class="container center-card">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-3"><b>Aplikasi Number Management</b></h1>
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="process/process_login.php">
                                    <?php if (isset($_GET['error'])) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $_GET['error'] ?>
                                        </div>
                                    <?php } ?>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username..." required>
                                                
                                        </div>
                                        <div class="form-group password-group">
                                            <input type="password" id="exampleInputPassword" class="form-control" name="password" placeholder="Enter Password..." required>                 
                                            <i class="far fa-eye password-icon" id="password-icon" onclick="togglePassword()"></i>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        </a>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
<!-- End of Topbar -->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/chart-area-demo.js"></script>
<script src="assets/js/demo/chart-pie-demo.js"></script>

<!-- JavaScript -->
<script>
    function togglePassword() {
        var passwordField = document.getElementById("exampleInputPassword");
        var eyeIcon = document.getElementById("password-icon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

</html>
</body>
<?php } else {
  header("Location: dashboard.php");
} ?>