 <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-header">
            <a class="navbar-brand">
              <h2><b>Heal</b>Teeth</h2>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
              <!-- This is  -->
              <li class="nav-item">
                <a
                  class="
                    nav-link nav-toggler
                    hidden-md-up
                    waves-effect waves-dark
                  "
                  href="javascript:void(0)"
                  ><i class="ti-menu"></i
                ></a>
              </li>
            </ul>
           
            <ul class="navbar-nav my-lg-0">
              <b>
              <?php
                  date_default_timezone_set('Asia/Manila');
                  echo date('F j, Y g:i:a  ');
              ?>
              </b>
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->