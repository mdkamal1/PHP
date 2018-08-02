<?php 
session_start();

require_once "dbconnect.php";

if (isset($_SESSION['user_id'])) 
{
	$uid=$_SESSION['user_id'];

	$last_login_query=mysql_query("select * from register_tbl where id=$uid");
	$result=mysql_fetch_assoc($last_login_query) or die(mysql_error());

	echo "Last Login".date("d-m-Y h:i:s A",strtotime($result['last_login']));
	echo "<br>";
	echo $_SESSION['user_id'].". "."Hello ".$_SESSION['name'];
	echo "<br>";
	// echo "Last login".$_SESSION['last_login'];
	include_once "user_header.php"; 

	
}
else
{
	header("location:register.php");
}

?>