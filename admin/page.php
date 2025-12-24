<?php 

  $do = isset($_GET["do"])? $_GET["do"] : "Manager";
// this shorting sente
// if(isset($_GET["do"])){
// 
//   $do= $_GET["do"];
// 
// }else{
//   $do = "Manager";
// }



if($do =='Manager'){
  echo "Welcome You are In Manage category page ".'<br>';
  echo '<a href="?do=Add">Add category + </a>'.'<br>';
  echo '<a href="?do=Insert">insert category + </a>'.'<br>';
  echo '<a href="?do=delete">delete category - </a>'.'<br>';
  echo '<a href="?do=Add">Add category + </a>'.'<br>';

}elseif ($do=='Add'){
  echo "Welcome You are In Add   categoty page";
  

}elseif ($do=='Insert'){
  echo "Welcome You are In insert categoty page";

}elseif ($do=='delete'){
  echo "Welcome You are In Delete categoty page";
 
}else{

  echo "Error There\'s No page with this Name ";

}

?>