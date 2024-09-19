    
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">

      <span class="brand-text font-weight-light"> <img src="../../images/agrolink.png" width="110" alt="" srcset="" style="margin-bottom: 5px; "> | Farmer Panel </span>
    </a>
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="##" class="d-block"><?php  echo $_SESSION['uname'];?></a>
        </div>
      </div>



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
                 <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
             Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                              <p>
                               Invoices
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                          
                
                                  <li class="nav-item">
                                <a href="viewbuyproductacceptedorder.php" class="nav-link">  
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View Invoice</p>
                                </a>
                              </li>
                             
                            </ul>
                          </li>
          
          <li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-box"></i>
        <p>
            Products
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="add-product.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="manage-products.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Product</p>
            </a>
        </li>
    </ul>
</li>

   <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
               Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
          

                  <li class="nav-item">
                <a href="viewbuyproductacceptedorder.php" class="nav-link">  
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Accepted Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="viewbuyproductrejectedorder.php" class="nav-link">  
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Rejected Order</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                              <p>
                               Messages
                                <i class="right fas fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                          
                
                                  <li class="nav-item">
                                <a href="../chat/home.php" class="nav-link">  
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View Message</p>
                                </a>
                              </li>
                             
                            </ul>
                          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
                   <i class="nav-icon fas fa-map"></i>
              <p>Locations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="view-seller_locations.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View List</p>
                </a>
              </li>
            </ul>
          </li>       



<!--Profile--->
   <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i> 
              <p>
               Account Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="profile.php" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>

 <li class="nav-item">
                <a href="change-password.php" class="nav-link">
                  <i class="fas fa-cog nav-icon"></i>
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