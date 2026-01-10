
<!-- <?php


 // $css = "layout/css"; // path to your CSS folder
?>-->
<?php
$nonavbar='';
$pageTitle='login';
 session_start();

 if(isset($_SESSION['Username'])){

  header("location:dashboard.php");
  
  }

 include "init.php";

//
//check if user coming from HTTP request

if($_SERVER['REQUEST_METHOD']=='POST'){
  $username= $_POST['user'];
  $password= $_POST['pass'];
  $hashedpass=sha1($password);

  //3 echo $username.''.$hashedpass;
  $stmt = $db->prepare("
  SELECT UserID, username, passwords, role
  FROM users
  WHERE username = ?
    AND passwords = ?
    AND role = 'admin'
  LIMIT 1
");

  $stmt->execute(array($username,$hashedpass));

  $count=$stmt->rowCount();
  $data = $stmt->fetch();
 
  //check if count > 0 echo about user information 

  if($count > 0){
    // print_r($data);

    if($data['role'] == 'admin'){

      $_SESSION['Username'] = $username;
      $_SESSION['ID']       = $data['UserID'];
      $_SESSION['role']     = $data['role'];

      header("location: dashboard.php");
      exit();

  } else {
      echo '<p class="alert" style="color:red;">Access Denied! Not Admin.</p>';
  }

} else {
  echo '<p style="color:red;">Incorrect login!</p>';
}


}?>

<div class="login-container">
<form class="login-card"  action="<?php echo $_SERVER['PHP_SELF']?> " method="POST">
<h4 class="sculpture-title">Admin Login</h4>
<div class="input-group mb-3">
    <span class="input-group-text"><i class="fa fa-user"></i></span>
    <input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="off">
  </div>
  <div class="input-group mb-4">
    <span class="input-group-text"><i class="fa fa-lock"></i></span>
    <input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="new-password">
  </div>
  <button class="btn btn-primary w-100 login-btn">Login</button>
</form>
</div>
<?php 

include $tpl."/footer.php";
?>























































