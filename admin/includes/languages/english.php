<?php 

function lang($phress){
  static $lang=array(
    //homepag
      "DASHBOARD" => "Dashboard",
      "STUDENTS"  => "Students",
      "TEACHERS"  => "Teachers",
      "CLASSES"   => "Classes",
      "SUBJECTS"  => "Subjects",
      "EXAMS"     => "Exams",
      "ATTENDANCE"=> "Attendance",
      "LIBRARY"   => "Library",
      "FINANCE"   => "Finance",
      "CATEGORIES"   => "Categories",
      "USERS"     => "Users",
      "SETTINGS"  => "Settings",
      "LOGOUT"    => "Logout" ,

  );
    
//settings


  return $lang[$phress]; 


}









?>