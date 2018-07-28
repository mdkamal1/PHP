<?php 
session_start();


if (isset($_SESSION['user_id'])) {

	echo "hello ".$_SESSION['name']."00".$_SESSION['user_id'];

include_once "user_header.php"; 

}else{
	header("location:register.php");
}
?>