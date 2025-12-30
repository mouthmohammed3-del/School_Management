<!-- page Members  -->

<?php
session_start();
$pageTitle = 'Members';

if (!isset($_SESSION['Username']) || $_SESSION['role'] != 'admin') {
  header("location: login.php"); 

  exit();
}
if (isset($_SESSION['Username'])) {

   include "init.php";

  $do = isset($_GET["do"]) ? $_GET["do"] : "Manager";

  if ($do == 'Manager') {

    //follwing function checkItem 

    $querys = '';
    if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

      echo 'hello  panding';

      $querys = 'AND Regstatus = 0 ';
    }







    //select All users Except Admin 

    $stmt = $db->prepare('SELECT * from users where role!="admin"' . $querys);
    //execut the statment     
    $stmt->execute();

    // Assign To varible 
    $rows = $stmt->fetchAll();

?>

    <!-- echo "Manager meper page "; -->
    <h1 class="text-center "> Manage Members </h1>
    <div class="container">
        <table class="main-table text-center  table table-bordered ">
          <tr>
            <th>#ID</th>
            <th>Username</th>
            <th>Passowrd</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Fullname</th>
            <th>Role</th>
            <th>Date</th>
            <th>Grade</th>
            <th>Controle</th>
          </tr>

          <?php

          foreach ($rows as $row) {
            echo "<tr>";
            echo  "<td>" . $row['userID'] . '</td>';

            echo  "<td>" . $row['username'] . '</td>';
            echo  "<td>" . $row['passwords'] . '</td>';
            echo  "<td>" . $row['phone'] . '</td>';
            echo  "<td>" . $row['Email'] . '</td>';
            echo  "<td>" . $row['Fullname'] . '</td>';
            echo  "<td>" . $row['role'] . '</td>';
            echo  "<td>" . $row['Date'] . '</td>';
            echo  "<td>" . $row['grade'] . '</td>';

            echo "<td>

            <div class='btn-group' role='group'>
    <a href='members.php?do=Edit&userid=" . $row['userID'] . "' class='btn btn-success btn-sm'>
        <i class='fa fa-edit fa-fw'></i> Edit
    </a>
    <a href='members.php?do=Delete&userid=" . $row['userID'] . "' class='btn btn-danger btn-sm confirm'>
        <i class='fa fa-trash fa-fw'></i> Delete
    </a>

</div>";
            if ($row['Regstatus'] == 0) {

              echo " <a  href='members.php?do=Activate&userid=" . $row['userID'] . " ' class='btn btn-info btn-sm activate'>
  <i  class='fa fa-power-off fa-fw'></i> Activate
</a>";
            }



           
          }
          ?>




        </table>

      <button class="btn btn-primary">
        <a href="members.php?do=insert" class="text-d">Add Member</a>
        <i class="fa fa-plus"></i>
      </button>
    </div>

    </div>
    <a href="members.php?do=Manager&page=Pending" class="btn btn-info">
      <i class="fas fa-spinner fa-spin d-none"> </i> Member pending 
      <?php echo checkItem("Regstatus","users",0);?> 
    </a>  


    <?php
    
          } elseif ($do == 'insert') {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone    = $_POST['phone'];
            $email    = $_POST['email'];
            $fullname = $_POST['fullname'];
            $role     = $_POST['role'];
            $grade    = ($role == 'student') ? $_POST['grade'] : NULL;


            // التحقق من القيم الفارغة   
            $errors = array();
            if (empty($username)) {
              $errors[] = "Username is required";
            }

            if (strlen($username) < 3) {
              $errors[] = "Username cant be less  than 4 characters";
            }

            if (strlen($username) > 20) {
              $errors[] = "Username cant be more than 20 characters";
            }
            //  password
            if (empty($password)) {
              $errors[] = "Password is required";
            }

            // start check of phone number 
            if (empty($phone)) {
              $errors[] = "Phone number is required";
            }

            if (!preg_match("/^(77|78|71|73)[0-9]{7}$/", $phone)) {
              $errors[] = "Phone must start with 77, 78, 71, or 73 and be 9 digits.";
            }

            if (strlen($phone) != 9) {
              $errors[] = "Phone number must be exactly 9 digits.";
            }

            if (!ctype_digit($phone)) {
              $errors[] = "Phone number must contain only numbers.";
            }
            // end check of phone number 


            if (empty($email)) {
              $errors[] = "Email is required";
            }

            if (empty($fullname)) {
              $errors[] = "Fullname is required";
            }


            if (empty($errors)) {


              $check = checkItem("username", "users", $username);

              if ($check == 1) {
                echo '<div class="alert alert-danger">Sorry this user Is Exist </div>';


                $theMsgs = '<div class="alert alert-danger">Sorry this user Is Exist </div>';


                redirecthome($theMsgs, 'back');
              } else {

                // INSERT
                // can you use this method 
               
                $asdate = date("Y-m-d");
                $stmt = $db->prepare("INSERT INTO users (username, passwords,phone, Email, Fullname, role,Regstatus,Date , grade) VALUES (?, ?, ?, ?, ?, ?,?,?,?)");
                $stmt->execute(array($username, sha1($password), $phone, $email, $fullname, $role, 1, $asdate, $grade));

                echo $stmt->rowCount() . '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
         <i class="fa fa-check-circle"></i> User added successfully!. 
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
       ';
              }
            } else {

              foreach ($errors as $error) {

                echo "<div class='alert alert-danger clos'>$error</div>";
              }
            }
          }
          ?>
            <div class="container">
              <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title text-center">Add Members</h3>
                  </div>

                  <div class="panel-body">

                    <form action="?do=insert" method="POST">

                      <!-- Username -->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-10 col-md-10">
                          <input type="text" name="username" accept=" --" accesskey="" class="form-control" autocomplete="off" required>
                        </div>
                      </div>

                      <!-- Password -->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-5 control-label">Password</label>
                        <div class="col-sm-9 col-md-10">
                          <input type="password" name="password" class="passowrd form-control" autocomplete="new-password" placeholder="Leave blank to keep current password">
                          
                        </div>
                      </div>
                      <!-- phoon number  -->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-5 control-label">Phone</label>
                        <div class="col-sm-9 col-md-10">
                          <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
                        </div>
                      </div>

                      <!-- Email -->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9 col-md-10">
                          <input type="email" name="email" class="form-control" required>
                        </div>
                      </div>

                      <!-- Full Name -->
                      <div class="form-group form-group-lg">
                        <label class="col-sm-3 control-label">Full Name</label>
                        <div class="col-sm-9 col-md-10">
                          <input type="text" name="fullname" class="form-control" required>
                        </div>
                      </div>
                      <!-- Full Name -->
                      <!-- Grade -->
                      <div class="form-group form-group-lg">

                        <select name="role" required>
                          <option value="student">Student</option>
                          <option value="teacher">Teacher</option>
                          <option value="admin">Admin</option>
                        </select>
                        <input type="number" name="grade" min="1" max="6" placeholder="Grade for students only">



                        <!-- Save Button -->
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-success btn-lg">
                              <i class="fa fa-check"></i> Add
                            </button>
                          </div>
                        </div>

                    </form>

                  </div>
                </div>
              </div>
            </div>



            <?php
          } elseif ($do == 'Edit') {

            $user1 = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            // echo $user1;

            $stmt = $db->prepare("SELECT *FROM users where UserID=? LIMIT 1");
            $stmt->execute(array($user1));
            $row = $stmt->fetch();

            $count = $stmt->rowCount();

            if ($count > 0) {

              // echo "goode this is the form ";
              // print_r($row) ;
            ?>


              <div class="container">
                <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title text-center">Edit Member</h3>
                    </div>

                    <div class="panel-body">

                      <form action="?do=Update" method="POST">
                        <input type="hidden" name="userid" value="<?php echo $user1 ?>">

                        <!-- Username -->
                        <div class="form-group form-group-lg">
                          <label class="col-sm-3 control-label">Username</label>
                          <div class="col-sm-10 col-md-10">
                            <input type="text" name="username" value="<?php echo $row['username'] ?>" accept=" --" accesskey="" class="form-control" autocomplete="off" required="true">
                          </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group form-group-lg">
                          <label class="col-sm-5 control-label">Password</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="hidden" name="oldpassword" value="<?php echo $row['passwords'] ?>">
                            <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave blank to keep current password">
                          </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group form-group-lg">
                          <label class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="true">
                          </div>
                        </div>

                        <!-- Full Name -->
                        <div class="form-group form-group-lg">
                          <label class="col-sm-3 control-label">Full Name</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="text" name="fullname" value="<?php echo $row['Fullname'] ?>" class="form-control" required="true">
                          </div>
                        </div>
                        <!-- grade-->
                        <div class="form-group form-group-lg">
                          <label class="col-sm-3 control-label">Grade</label>
                          <div class="col-sm-9 col-md-10">
                            <input type="text" name="grade" value="<?php echo $row['grade'] ?>" class="form-control" required="true">
                          </div>
                        </div>
                        <!-- Save Button -->
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-success btn-lg">
                              <i class="fa fa-check"></i> Save
                            </button>
                          </div>
                        </div>

                      </form>

                    </div>
                  </div>
                </div>
              </div>

              <?php } else {
              $theMsg = "theres no ";

              redirecthome($theMsg, 'back', 6);
            }
          } elseif ($do == 'Update') {


            echo '<h1 class="text-center">Updata Members</h1>';
            echo "<div class='container'>";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              // echo "Welcome to this page in side Update<br> ";

              $id = $_POST['userid'];
              $user = $_POST['username'];
              $emai = $_POST['email'];
              // $pas= $_POST['password'];
              $name = $_POST['fullname'];
              $grade = $_POST['grade'];

              //chek passowerd
              // condtion short
              $chekpass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

              //validate the form   //      //        //  

              $forrarray = array();
              if (strlen($user) < 4) {
                $forrarray[] = "username cant be less than 4 characters ";
              }
              if (strlen($user) > 20) {
                $forrarray[] = "username cant be more than 20 characters ";
              }
              if (empty($user)) {
                $forrarray[] = "Username cant be empty ";
              }
              if (empty($name)) {
                $forrarray[] = "Full name cant be empty ";
              }
              if (empty($emai)) {
                $forrarray[] = "Emile cant be empty ";
              }

              //disply massige error in bootstrap 

              if (!empty($forrarray)) { ?>
                <div class="mt-3">
                  <?php foreach ($forrarray as $error) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="fa fa-exclamation-circle"></i>
                      <?php echo $error; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php


              } else {

                $stmt = $db->prepare("UPDATE users SET username=?,Email=?,fullname=?,passwords=? ,grade=? WHERE UserID=?");
                $stmt->execute(array($user, $emai, $name, $chekpass, $grade, $id));
                $theMsg = $stmt->rowCount() . 'record updated';

              ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="fa fa-check-circle"></i>
                  <strong>OK!</strong> Done. Updated successfully.
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>

        <?php

                redirecthome($theMsg, 'back', 6);
              }
            } else {


              $theMsg = "<div class='alter alter-danger'>Sorry you can't Browse This page direct</div> ";
              redirecthome($theMsg, 'back', 6);
            }

            echo '</div>';
          } elseif ($do == 'Delete') {

            echo '<h1 class="text-center">Delete Members</h1>';
            echo '<div class="container">';

            // echo 'welcom to delete page '; 

            $user1 = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


            $check = checkItem("userID", "users", $user1);



            if ($check > 0) {
              $stmt = $db->prepare("DELETE from users where userID=:zuserid");
              $stmt->bindParam(":zuserid", $user1);
              $stmt->execute();

              $theMsg = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      <i class="fa fa-check-circle"></i>
      <strong>OK!</strong> Done. deleted successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
   </div>';

              redirecthome($theMsg, 5);
            } else {

              $theMsg = "<div class='alter alter-danger'>Sorry you can't Browse This page direct</div> ";
              redirecthome($theMsg, 5);
            }
            echo '</div>'; //closing container in deleted 


          } elseif ($do == 'Activate') {
            echo 'Activate members page ';


            echo '<h1 class="text-center">Activate Members</h1>';
            echo '<div class="container">';

            // echo 'welcom to delete page '; 

            $user1 = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


            $check = checkItem("userID", "users", $user1);



            if ($check > 0) {
              $stmt = $db->prepare("UPDATE  users SET  Regstatus = 1 where userID=?");
              $stmt->execute(array($user1));

              $theMsg = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      <i class="fa fa-check-circle"></i>
      <strong>OK!</strong> Done. Activated successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
   </div>';

              redirecthome($theMsg,  1);
            } else {

              $theMsg = "<div class='alter alter-danger'>Sorry you can't Browse This page direct</div> ";
              redirecthome($theMsg, 5);
            }
            echo '</div>'; //closing container in deleted 

          }


          include $tpl ."footer.php";
        } else {

          header("location:index.php");
        }



        //  echo "Your Are Not Authorized To view This Page";



        ?>

      