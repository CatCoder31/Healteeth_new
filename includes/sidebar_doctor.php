<?php 
    
    if(isset($_SESSION["id"]))
  $id = $_SESSION["id"];
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav">
              <li>
                <a
                  class="waves-effect waves-dark"
                  href="doctor_index.php"
                  aria-expanded="false"
                  ><i class="fa fa-home"></i
                  ><span class="hide-menu">Dashboard</span></a
                >
              </li>
              <li>
                <a
                  class="waves-effect waves-dark"
                  href="#homeSubmenu"
                  aria-expanded="false"
                  ><i class="fa fa-calendar"></i
                  ><span class="hide-menu">Appointment</span></a
                >
                <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="view_appointment.php">Check Appointment</a>
                        </li>
                        <li>
                            <a href="done_appointment.php">Finished Appointment</a>
                        </li>
                        <li>
                            <a href="pending_appointment.php">Pending Appointment</a>
                        </li>
                        <li>
                            <a href="approved_appointment.php">Approved Appointment</a>
                        </li>
                        <li>
                            <a href="cancel_appointment.php">Cancelled Appointment</a>
                        </li>
                        <li>
                            <a href="noshow_appointment.php">No Show</a>
                        </li>
                        <li>
                            <a href="schedule.php">Manage Schedule</a>
                        </li>
                    </ul>
              </li>
              <li>
                <a
                  class="waves-effect waves-dark"
                  href="#homeSubmenu1"
                  aria-expanded="false"
                  ><i class="fa fa-user-md"></i
                  ><span class="hide-menu">User</span></a
                >
                 <ul class="collapse list-unstyled" id="homeSubmenu1">
                        <li>
                            <a href="add_user.php">Add User</a>
                        </li>
                        <li>
                            <a href="manage_user.php">Manage User</a>
                        </li>
                    </ul>
              </li>
              <li>
                <a
                  class="waves-effect waves-dark"
                  href="#homeSubmenu2"
                  aria-expanded="false"
                  ><i class="fa fa-users"></i
                  ><span class="hide-menu">Patient</span></a
                >
                 <ul class="collapse list-unstyled" id="homeSubmenu2">
                        <li>
                            <a href="manage_patient.php">Manage Patient</a>
                        </li>
                    </ul>
              </li>

              <li>
                <a
                  class="waves-effect waves-dark"
                  href="#homeSubmenu3"
                  aria-expanded="false"
                  ><i class="fa fa-list"></i
                  ><span class="hide-menu">Category</span></a
                >
                 <ul class="collapse list-unstyled" id="homeSubmenu3">
                        <li>
                            <a href="add_category.php">Add Category</a>
                        </li>
                        <li>
                            <a href="manage_category.php">Manage Category</a>
                        </li>
                    </ul>
              </li>
              <li>
                <a
                  class="waves-effect waves-dark"
                  href="#homeSubmenu4"
                  aria-expanded="false"
                  ><i class="fa fa-list-alt"></i
                  ><span class="hide-menu">Services</span></a
                >
                 <ul class="collapse list-unstyled" id="homeSubmenu4">
                        <li>
                            <a href="add_services.php">Add Services</a>
                        </li>
                        <li>
                            <a href="manage_services.php">Manage Services</a>
                        </li>
                    </ul>
              </li>

              <li>
                <a
                  class="waves-effect waves-dark"
                  href="logout.php"
                  aria-expanded="false"
                  ><i class="fa fa-sign-out"></i
                  ><span class="hide-menu">Logout</span></a
                >
              </li>
            </ul>
            
            </div>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
       <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->