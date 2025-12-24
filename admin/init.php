
<?php
include "connect.php";
$lang="includes/languages";
$tpl ="includes/templates/";
$func="includes/functions/";
$css="layout/css/";
$js="layout/js";
 


include $func."function.php";
 include $lang."/english.php";
// include "includes/languages/Arabic.php";
include $tpl.'/header.php';
if(!isset($nonavbar)){include $tpl.'/navbar.php';
}
?>