<?php
require_once('function/dbconnect.php');
require_once('function/helper.php');

session_start();
if ($_SESSION['role_id'] == null) {
    header("Location: " . BASE_URL);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('components/header.php'); ?>
    <title>Dashboard | Number Management</title>

</head>

<body id="page-top" class="custom-bg">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('components/sidebar.php'); ?>

        <!-- Page Content -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php include('components/topbar.php'); ?>
            <div id="content">
                <div class="container">
                    <!-- Dashboard Cards -->
                    <?php include('components/card_dashboard.php'); ?>
                </div>
            </div>
            <!-- Footer -->
            <?php include('components/footer.php'); ?>
        </div>
    </div>
</body>

</html>