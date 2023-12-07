<?php
function isPageActive($page)
{
    $currentUrl = $_SERVER['REQUEST_URI'];

    // Check if the current URL contains the specified page
    return strpos($currentUrl, $page) !== false;
}
?>


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASE_URL ?>">
        <div class="sidebar-brand-icon">
            <!-- <img id="brandIcon" src="<?php echo BASE_URL ?>assets/img/logo.png" alt="logo" class="sidebar-logo m-2 p-3" style="min-width: 100px; width: 10%; height: auto;"> -->
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo isPageActive('dashboard.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo BASE_URL ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo isPageActive('user_management.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Management User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management</h6>
                <a class="collapse-item" href="<?php echo BASE_URL ?>page/user_management.php">User Management</a>
                <a class="collapse-item" href="/">Admin Management</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo isPageActive('number_list.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Service Management</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Number Management</h6>
                <a class="collapse-item" href="<?php echo BASE_URL ?>page/number_list.php">Number List</a>
                <a class="collapse-item" href="/">Admin Management</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->


