<?php

use Soap\Url;

function getTitle(){

  global $pageTitle;

  if(isset($pageTitle)){

    echo $pageTitle;

  }else{
    
    echo "Default";

  }
}

function redirecthome($theMsg, $url = null, $seconds =  1) {

  if ($url === null) {
      $url = 'index.php';
      $links='Homepage';
  }else{

    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
          $url = $_SERVER['HTTP_REFERER'];

          $links='Previous privuos';

    }else{
      $url='index.php';
      $links='Homepage';
    }
  
  

  echo '<div class="alert alert-info">You Will Be redirected to '.$links.' After '. $seconds.'</div>';

  header("refresh:$seconds;url=$url");
  exit();

}
}


//checkItem

function checkItem($select , $from,$value){

   global $db;
   $statement= $db->prepare("SELECT $select FROM $from WHERE $select=?");

  $statement->execute(array($value));


  $count = $statement->rowCount();

 return $count;

}


////////////////////
function counts($item,$table,$role){
  global $db;
  $stmt2=$db->prepare("SELECT COUNT($item)  from $table where role = ?");
  $stmt2->execute([$role]);

  return $stmt2->fetchColumn();

}




////////////////////////

// function countPresent($ids,$table,$stat){
//   global $db;
//   $stmt2=$db->prepare("SELECT COUNT($ids)  from $table where status=?");
//   $stmt2->execute([$stat]);
// 
//   return $stmt2->fetchColumn();
// 
// }

function getAttendancePercentage($ids, $table, $presentStatus) {
  global $db;
  
  // عدد الحاضرين
  $stmtPresent = $db->prepare("SELECT COUNT($ids) FROM $table WHERE status = ?");
  $stmtPresent->execute([$presentStatus]);
  $present = $stmtPresent->fetchColumn();
  
  // العدد الإجمالي
  $stmtTotal = $db->prepare("SELECT COUNT($ids) FROM $table");
  $stmtTotal->execute();
  $total = $stmtTotal->fetchColumn();
  
  // حساب النسبة
  if ($total > 0) {
      return round(($present / $total) * 100, 2); // نسبة مئوية مع تقريب
  }else{    
      echo '0%';

  }
  
}

function rowcont($users){
global $db;
$sql = " SELECT * from $users";
$stmt = $db->prepare($sql);
$stmt->execute();
$stmt->rowCount();}
////////////////////////////////////////////////
function getlatest($select,$table,$order,$limit=5){

  global $db;
  $getstmt = $db->prepare("SELECT $select FROM $table ORDER BY $order DESC limit $limit ");
  $getstmt->execute();
  $rows = $getstmt->fetchAll();
  return $rows;

}

//start function Latest Statistics
// 1. عدد جميع الأعضاء
function countUsers() {
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE role != 'admin'");
    $stmt->execute();
    return $stmt->fetchColumn();
}

// 2. الأعضاء المعلقين
function countPending() {
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE RegStatus = 0");
    $stmt->execute();
    return $stmt->fetchColumn();
}

// 3. النشطين اليوم
// function countActiveToday() {
//     global $db;
//     $today = date('Y-m-d');
//     $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE LastLogin >= ?");
//     $stmt->execute([$today]);
//     return $stmt->fetchColumn();
// }

// 4. عدد العناصر (تعدل حسب جدولك)
function countItems() {
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) FROM items");
    $stmt->execute();
    return $stmt->fetchColumn();
}
//end function Latest Statistics
// ?>
<!-- // <select name="number" id="">
// 
// <option value="0"></option> -->
<!-- // <?php  
// $stmt = $db->prepare( "SELECT* from users ");
// $stmt->execute();
// $Users = $stmt->fetchAll();
// 
// foreach($Users as $userss){
//   echo '<option value=" '.$userss['userID'] .'">'.$userss['username'].'</option>';
// 
// }
// 
// 
// 
// ?>
</select>