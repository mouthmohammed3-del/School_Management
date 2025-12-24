<?php

session_start();
$pageTitle ='';
if(isset($_session['username'])){
  include 'init.php';
   
  $do = isset($_GET['do'])? $_GET['do']:'Manager';

  if($do =='Manager'){

    echo 'welcome ';

  }elseif($do == 'Add'){

  }elseif($do == 'Edit'){
    
  }elseif($do == 'Update'){
    
  }elseif($do == 'delete'){
    
  }elseif($do == 'delete'){
    
  }    
  
  include $tpl.'footer.php';  

}else{
  header('location:index.php');
  exit();



  }





?>