<?php 
session_start();
if (isset($_SESSION['user_id'])) {
	
	echo "hello ".$_SESSION['name']."00".$_SESSION['user_id'];
	include_once "user_header.php";

extract($_POST);
if (isset($done)) {

	require_once "dbconnect.php";
	
	$uid=$_SESSION['user_id'];
	$pass_sel="select password from register_tbl where id = $uid";

	$pass_qry=mysql_query($pass_sel) or die(mysql_error());

	$pass_row=mysql_fetch_assoc($pass_qry);

	if ($old==$pass_row['password']) {
		if ($new==$confirm) {
			
			$pass_update="update register_tbl set password='$new' where id = $uid";
			$pass_qry=mysql_query($pass_update) or die(mysql_error());

			?>
				<script>alert("succesfully_changed_password");</script>
			<?php
			header("location:logout.php");

		}else{
			?>
				<script>alert("password not matched");</script>
			<?php
		}


	}else{
		?>
			<script>alert("password not matched with database");</script>
		<?php
	}

	}
?>
<form action="" method="post">
	Old Password : <input type="password" name="old"><br><br>
	New Password : <input type="password" name="new"><br><br>
	Confirm Password : <input type="password" name="confirm"><br><br>
	<input type="submit" name="done" value="DONE">
</form>
<?php
}else{
	header("location:register.php");
}  
?>
