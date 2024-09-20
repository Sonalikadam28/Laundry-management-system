<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
        <span class="brand-text font-weight-light">
            <img src="../../images/logo_home.png" width="80" alt="Logo" style="margin-bottom: 5px; margin-left: 4px"> | Admin Panel
        </span>
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../investor/dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="dashboard.php" class="d-block"><?php echo ucwords($_SESSION['uname']); ?></a>
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

                <!-- Sub-Admins -->
                <?php if ($_SESSION['utype'] == 1): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Sub-Admins<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add-subadmin.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manage-subadmins.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Customers -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add-customer.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manage-customers.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Customer</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Items -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Items<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add-item.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Item</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manage-items.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Item</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Orders -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Orders<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <!-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="add-order.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#view-levels.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Order</p>
                            </a>
                        </li>
                    </ul> -->
                </li>

                <!-- Barcode -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-qrcode"></i>
                        <p>QRcode<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="view-payouts.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Scan Barcode</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="view-payouts.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generate Invoice</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- Billing -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>Billing<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="scan-barcode.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Scan Barcode</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="generate-bill.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generate Invoice</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Report & Analytics -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Report & Analytics<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#manage-support.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Support Tickets</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- Account Settings -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Account Settings<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
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
