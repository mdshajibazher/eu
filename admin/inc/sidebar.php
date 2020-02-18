  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/logo.png"
           alt="Logo"
           class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">AdminPanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['adminName']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>

          <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fa fa-utensils"></i>
              <p>Product</p>
               <i class="right fas fa-angle-left"></i>
            </a>
            
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="add-product.php" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Create Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="product-list.php" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
              
            </ul>
            
                      <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fa fa-tag"></i>
              <p>Category</p>
               <i class="right fas fa-angle-left"></i>
            </a>
            
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="add-category.php" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Create Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="category-list.php" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
              
            </ul>
          </li>
          
        <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i>
              <p>Orders</p>
               <i class="right fas fa-angle-left"></i>
            </a>
            
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="order-list.php" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Order List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pending-order-list.php" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Pending Order List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="canceled-order-list.php" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Canceled Order List</p>
                </a>
              </li>
              
              
              
              
              
              
            </ul>
            
             <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fa  fa-graduation-cap"></i>
              <p>Students</p>
               <i class="right fas fa-angle-left"></i>
            </a>
            
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="student-list.php" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Student List</p>
                </a>
              </li>
            
            
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>