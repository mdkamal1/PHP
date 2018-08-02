<?php 
session_start();

require_once "dbconnect.php";

$date=$_SESSION['last_login'];
$uid=$_SESSION['user_id'];

$last_login_update=mysql_query("update register_tbl set last_login='$date' where id=$uid");

session_destroy();
setcookie('password',$password,time()-1);

// unset($_SESSION);

 header("location:register.php?successfully_logged_out");

?>