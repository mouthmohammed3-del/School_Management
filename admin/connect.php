<?php 

$dsn='mysql:host=localhost;dbname=shool_db';
$user='root';
$pass='';

// $option=array(
//   PDO::MYSQL_ATTR_INIT_COMMAND=>"set name utf8 ", if vsrion not support;
// );

try{

  $db=new PDO($dsn,$user,$pass);
  $db->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "conected sucssflly";

  // $ins="INSERT INTO users(username) VALUE('saber')";
  // $db->exec($ins);
  // echo "insert sucssflly ";
}
catch(PDOException $e){

  echo 'falid'.$e->getMessage();

}

// 












?>
