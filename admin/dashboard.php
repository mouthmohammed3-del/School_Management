<?php

// ob_start();

// $s='includes/templates'; 

  require_once 'config/database.php';

session_start();

$pageTitle="Dashdoard";

if(isset($_SESSION['Username'])){
  include "init.php";
//   echo 'welcom'.'<br>';

  //Start Dashbord Page
  



// echo countstudent();

include $tpl .'header.php';
  ?>
  

<!-- Dashboard Stats -->
<div class="container py-4">
<h2 class="mb-4 text-center fw-bold">Dashboard</h2>

<div class="row g-3">
    <!-- Students -->
    <div class="col-md-3 col-sm-6">
        <div class="card shadow-sm border-0 stat-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-primary text-white rounded-circle p-3 me-3">
                    <i class="fa-solid fa-user-graduate fa-lg"></i>
                </div>
                <div class="position-relative flex-grow-1">
                    <div class="text-muted small">Total Students</div>
                    <h5 class="mb-0"><a href="members.php"><?php echo counts('role','users','student')?></a></h5>
                    <div class="mt-2">
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i> 12% this month
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Teachers -->
    <div class="col-md-3 col-sm-6">
        <div class="card shadow-sm border-0 stat-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-success text-white rounded-circle p-3 me-3">
                    <i class="fa-solid fa-chalkboard-teacher fa-lg"></i>
                </div>
                <div class="position-relative flex-grow-1">
                    <div class="text-muted small">Total Teachers</div>
                    <h5 class="mb-0"><a href="members.php"><?php echo counts('role','users','teacher')?></a></h5>
                    <div class="mt-2">
                        <small class="text-info">
                            <i class="fas fa-user-check me-1"></i> 4 on leave
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance -->
    <div class="col-md-3 col-sm-6"><a style="text-decoration: none;" href="attendance.php">
        <div class="card shadow-sm border-0 stat-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-warning text-white rounded-circle p-3 me-3">
                    <i class="fa-solid fa-user-check fa-lg"></i>
                </div>
                
                       <div class="position-relative flex-grow-1">
                    <div class="text-muted small" >Today's Attendance</div>
                    <h5 class="mb-0"><?php echo getAttendancePercentage('id','attendance','present') ?>%</h5>
                    </a>
                    <div class="mt-2">
                        <small class="text-primary">
                            <i class="fas fa-users me-1"></i> 1,742 present
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings -->
    <div class="col-md-3 col-sm-6">
        <div class="card shadow-sm border-0 stat-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-info text-white rounded-circle p-3 me-3">
                    <i class="fa-solid fa-dollar-sign fa-lg"></i>
                    <i class="fa-solid fa-dollar-sign fa-2x text-info"></i>
                </div>
                <div class="position-relative flex-grow-1">
                    <div class="text-muted small">Monthly Earnings</div>
                    <h5 class="mb-0">$42.8K</h5>
                    <div class="mt-2">
                        <small class="text-success">
                            <i class="fas fa-chart-line me-1"></i> 18.7% growth
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div> 
<div class="container latest">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
      <?php $lastusers = 4 ?>

        <div class="panel-heading">  <!-- تم التصحيح: إزالة class="panel" -->
        <i class="fa fa-line-chart"></i> <?php echo $lastusers ?>  Latest Registered Users
        </div>
        <div class="panel-body">
        <ul class="list-group">
  <?php 

  $thelatest = getlatest("*","users","userID",$lastusers);
  foreach($thelatest as $lastuser){
  ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      <div>
        <strong><?php echo $lastuser['username']; ?></strong>
        <div class="text-muted small"><?php echo $lastuser['Date']; ?></div>
      </div>
      <a href="members.php?do=Edit&userid=<?php echo $lastuser['userID']; ?>" class="btn btn-sm btn-outline-primary ">View</a>
      
     
    </li>   
  <?php } ?>
</ul>
          <!-- إحصائيات -->
        </div>
       
      </div>
    </div>
    <!-- stert  Latest Statistics -->

    <!-- يمكن إضافة أعمدة أخرى -->
    <div class="col-sm-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      <i class="fa fa-line-chart"></i> Latest Statistics
    </div>
    <div class="panel-body">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <i class="fa fa-users fa-fw text-primary me-3"></i>
            <div>
              <strong>Total Members</strong>
              <div class="text-muted small">All registered users</div>
            </div>
          </div>
          <span class="badge bg-primary rounded-pill"><?php echo countUsers();?></span>
        </li>
        
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <i class="fa fa-clock-o fa-fw text-warning me-3"></i>
            <div>
              <strong>Pending Activation</strong>
              <div class="text-muted small">Awaiting approval</div>
            </div>
          </div>
          <span class="badge bg-warning rounded-pill"><?php echo checkItem("Regstatus","users",0);?> </span>
        </li>
        
        <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <i class="fa fa-check-circle fa-fw text-success me-3"></i>
            <div> -->
              <!-- <strong>Active Today</strong>
              <div class="text-muted small">Logged in last 24h</div>
            </div>
          </div>
            <span class="badge bg-success rounded-pill"> -->
         <!--?<php echo countActiveToday(); ?> 
           </span>  
        < </li>  -->
        
        <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <i class="fa fa-file-text-o fa-fw text-info me-3"></i>
            <div>
              <strong>Total Items</strong>
              <div class="text-muted small">All items in store</div>
            </div>
          </div>
          <a href="items.php" class="btn btn-sm btn-outline-info">
            ?<php echo countItems(); ?> 
          Items</a>
        </li> -->
      </ul>
    </div>
  </div>
</div>


    <!-- end  Latest Statistics -->

  </div>
</div>
</div>


  
  
  
  
  <?php
  //End Dashbord page
  
  include "includes/templates/footer.php";
// echo "welcom to ". $_SESSION['Username'];
}else{
  // echo "Your Are Not Authorized To view This Page";
  header( "location:index.php");
}

// ob_end_flush();
?>

  


