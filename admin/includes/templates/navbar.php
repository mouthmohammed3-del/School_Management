

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">


    <!-- Logo / Dashboard -->


    <a class="navbar-brand" href="dashboard.php"><?php echo lang('DASHBOARD'); ?></a>


    <!-- Toggle Button -->    
     
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#app-nav"
      aria-controls="app-nav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Items -->
<div class="collapse navbar-collapse" id="app-nav">

  <!-- Left Menu -->
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-users"></i> <?php echo lang('STUDENTS'); ?>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-user"></i> <?php echo lang('TEACHERS'); ?>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-building"></i> <?php echo lang('CLASSES'); ?>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-book"></i> <?php echo lang('SUBJECTS'); ?>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-pencil"></i> <?php echo lang('EXAMS'); ?>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="attendance.php">  
        <i class="fa fa-check-square-o"></i> <?php echo lang('ATTENDANCE'); ?>
      </a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="indexlabrary.php">
  <i class="fa fa-bookmark"></i> <?php echo lang('LIBRARY'); ?>
</a>


        
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fa fa-money"></i> <?php echo lang('FINANCE'); ?>
      </a>
    </li>

    <!-- category  -->
    
    <li class="nav-item dropdown">
  <a
    class="nav-link dropdown-toggle"
    href="#"
    id="categoriesDropdown"
    role="button"
    data-bs-toggle="dropdown"
    aria-expanded="false"
  >
    <i class="fa fa-sitemap"></i> <?php echo lang('CATEGORIES'); ?>
  </a>

  <ul class="dropdown-menu">
    <li>
      <a class="dropdown-item" href="categories.php">
        <i class="fa fa-list"></i> Manage Categories
      </a>
    </li>

    <li>
      <a class="dropdown-item" href="categories.php?do=Add">
        <i class="fa fa-plus"></i> Add Category
      </a>
    </li>
  </ul>

</li>

<!-- category  -->
    <li class="nav-item">
      <a class="nav-link" href="members.php">
        <i class="fa fa-user-circle"></i> <?php echo lang('USERS'); ?>
      </a>
    </li>

  </ul>

  <!-- Right Side: Account Menu -->
  <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
      <a
        class="nav-link dropdown-toggle"
        href="#"
        id="userDropdown"
        role="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <i class="fa fa-user"></i> Account
      </a>

      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li>
          <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">
            <i class="fa fa-edit"></i> Edit Profile
          </a>
        </li>

        <li>
          <a class="dropdown-item" href="#">
            <i class="fa fa-cog"></i> <?php echo lang('SETTINGS'); ?>
          </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        
        <li>
          <a class="dropdown-item text-danger" href="logout.php">

            <i class="fa fa-sign-out"></i> <?php echo lang('LOGOUT'); ?>

          </a>
        </li>
      </ul>
    </li>
  </ul>
  


  </div>
</nav>


