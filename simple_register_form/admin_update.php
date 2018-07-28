<?php 
session_start();
if (isset($_SESSION['adminname'])) {
	
	if (isset($_GET['uid'])) {
		$uid=$_GET['uid'];
		if (is_numeric($uid)) {
			require_once("dbconnect.php");

			$admin_sel="select * from register_tbl where id=$uid";
			$admin_res=mysql_query($admin_sel) or die(mysql_error());
		}
	}
}
?>