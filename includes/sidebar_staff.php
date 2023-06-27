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
                  href="staff_index.php"
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
                            <a href="staffview_appointment.php">Check Appointment</a>
                        </li>
                        <li>
                            <a href="staffdone_appointment.php">Finished Appointment</a>
                        </li>
                        <li>
                            <a href="staffpending_appointment.php">Pending Appointment</a>
                        </li>
                        <li>
                            <a href="staffapproved_appointment.php">Approved Appointment</a>
                        </li>
                        <li>
                            <a href="staffcancel_appointment.php">Cancelled Appointment</a>
                        </li>
                         <li>
                            <a href="staffnoshow_appointment.php">No Show</a>
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
                            <a href="staffmanage_patient.php">Manage Patient</a>
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