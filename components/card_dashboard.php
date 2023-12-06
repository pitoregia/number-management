<?php require_once(__DIR__ . '/../function/user_count.php');?>

<div class="row">
    <!-- WhatsApp ON Card -->
    <div class="col-12 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col">
                        <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                            WhatsApp ON
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-whatsapp fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp OFF Card -->
    <div class="col-12 col-md-4 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col">
                        <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">
                            WhatsApp OFF
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-whatsapp fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Card -->
    <div class="col-12 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body text-center">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col">
                        <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                            User
                        </div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                        <?php echo $user_count; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>