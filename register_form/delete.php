<?php  
	if (isset($_GET['uid'])) {
		$uid=$_GET['uid'];
		if (is_numeric($uid)) {
			require_once("dbconnect.php");
			$del_qry="delete from register_tbl where id=$uid";
			$res=mysql_query($del_qry) or die(mysql_error());
			if ($res) {
				header('location:admin.php?admin=deleted_successfully');

			}
			else{
				header('location:admin.php?admin=not_deleted');
			}
		}
	}

?>
