<?php require_once(__DIR__ . '/../function/user_count.php'); ?>
<?php require_once(__DIR__ . '/../function/number_count.php'); ?>
<?php require_once(__DIR__ . '/../function/date_checker.php'); ?>

<div class="row mt-3">
    <!-- WhatsApp ON Card -->
    <div class="col-12 col-md-6 col-lg-4 col-xl-4 mb-4">
            <div class="card border-left-success shadow h-100 p-3 rounded-3">
                <div class="media d-flex align-items-center card-body text-center">
                    <div class="avatar-sm bg-success">
                        <i class="fa-brands fa-whatsapp fa-4x avatar-title text-white"></i>
                    </div>
                    <h3 class="ml-3">Nomor Manage</h3>
                </div>
                <div class="widget-box-2">
                    <div class="widget-detail-2 d-flex align-items-center">
                        <h5 class="text-muted font-weight-normal mr-auto">Total Nomor</h5>
                        <h2 id="nomor" class="font-weight-normal text-success"><?php echo $number_count; ?></h2>
                    </div>
                </div>
                <hr class="my-1 border-top">
                <div class="row justify-content-between mt-2">
                    <div class="col-sm-4">
                        <div class="media d-flex align-items-center">
                            <div class="avatar-sm bg-soft-secondary">
                                <i class="fas fa-check fa-2x avatar-title text-success"></i>
                            </div>
                            <h3 id="active_nomor" class="ml-auto font-weight-normal">0</h3>
                        </div>
                        <h5 class="text-muted font-weight-normal text-right my-0">Active</h5>
                    </div>
                    <div class="col-sm-4">
                        <div class="media d-flex align-items-center">
                            <div class="avatar-sm bg-soft-secondary">
                                <i class="fas fa-close fa-2x avatar-title text-danger"></i>
                            </div>
                            <h3 id="expired_nomor" class="ml-auto font-weight-normal"><?php echo $expired_number; ?></h3>
                        </div>
                        <h5 class="text-muted font-weight-normal text-right my-0">Expired</h5>
                    </div>
                    <div class="col-sm-4">
                        <div class="media d-flex align-items-center">
                            <div class="avatar-sm bg-soft-info">
                                <i class="fa-solid fa-triangle-exclamation fa-2x avatar-title text-warning "></i>
                            </div>
                            <h3 id="tenggang_nomor" class="ml-auto font-weight-normal"><?php echo $active_date; ?></h3>
                        </div>
                        <h5 class="text-muted font-weight-normal text-right my-0">Tenggang</h5>
                    </div>
                </div>
            </div>
        </div>

    <!-- User Card -->
     <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-danger shadow h-100 p-3 rounded-3">
                    <div class="media d-flex align-items-center card-body text-center">
                        <div class="avatar-sm bg-purple">
                            <i class="fas fa-user fa-3x avatar-title"></i>
                        </div>
                        <h3 class="ml-3">User Manage</h3>
                    </div>
                    <div class="widget-box-2">
                        <div class="widget-detail-2 d-flex align-items-center">
                            <h5 class="text-muted font-weight-normal mr-auto">Total User</h5>
                            <h2 id="all_users" class="font-weight-normal text-success"><?php echo $total_count; ?></h2>
                        </div>
                    </div>
                    <hr class="my-1 border-top">
                    <div class="row justify-content-between mt-2">
                        <div class="col-sm-5">
                            <div class="media d-flex align-items-center">
                                <div class="avatar-sm bg-soft-success">
                                    <i class= "fa-solid fa-user fa-2x avatar-title text-success"></i>
                                </div>
                                <h3 id="active_users" class="ml-auto font-weight-normal"><?php echo $user_count; ?></h3>
                            </div>
                            <h5 class="text-muted font-weight-normal text-right my-0">Users</h5>
                        </div>
                        <div class="col-sm-5">
                            <div class="media d-flex align-items-center">
                                <div class="avatar-sm bg-soft-warning">
                                    <i class="fa-solid fa-screwdriver-wrench fa-2x avatar-title text-warning"></i>
                                </div>
                                <h3 id="admin_users" class="ml-auto font-weight-normal"><?php echo $admin_count; ?></h3>
                            </div>
                            <h5 class="text-muted font-weight-normal text-right my-0">Admin</h5>
                        </div>
                    </div>
                </div>
            </div>
</div>




    <!-- <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col">
                        <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">
                            Tenggang
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                            <?php echo $active_date; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-triangle-exclamation fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col">
                        <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">
                            Expired Number
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                            <?php echo $expired_number; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-close fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->