<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light">
            <img src="../../images/logo_home.png" width="80" alt="Logo" style="margin-bottom: 5px; margin-left: 4px"> | Investor Panel
        </span>
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../investor/dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="##" class="d-block"><?php echo $_SESSION['uname']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <!-- Invoices -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Invoices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="#viewbuyproductinvoice.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Invoice</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- My Levels -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            My Levels
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="view-product.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Levels</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="view-product.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Product List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Plans -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Plans
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="viewbuyproductaccepted.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Purchase Plan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Commission -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Commission
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="../chat/home.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Commission</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Account Settings -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Account Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="#profile.php" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#change-password.php" class="nav-link">
                                <i class="fas fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
