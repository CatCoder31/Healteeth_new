<nav class="navbar navbar-expand-md bg-body-tertiary ">
  <div class="container-xl">
    <a class="navbar-brand" onclick="window.location='welcome.php';">
    <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" onclick="window.location='welcome.php';">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="window.location='appointment-book.php';">BOOK AN APPOINTMENT</a>
        </li>
        
       
        <li class="nav-item">
          <a class="nav-link" onclick="window.location='welcome.php#contact';">CONTACT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="window.location='about.php';">ABOUT</a>
        </li>

        
        <li class="nav-item dropdown">
		   <a class="nav-link btn btn-outline-info dropdown_btn" href="#" data-bs-toggle="dropdown">PROFILE</a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="appointment-list.php">APPOINTMENTS</a></li>
			  <li><a class="dropdown-item" href="user-profile.php">EDIT PROFILE</a></li>
			  <li><a class="dropdown-item" href="logout.php">SIGN OUT</a></li>
		    </ul>
		   </li>
      </ul>      
    </div>
  </div>
</nav>