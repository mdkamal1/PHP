<?php 
session_start();

if (isset($_SESSION['adminname'])) {

	echo $_SESSION['adminname'];
	echo "<br>";

	extract($_POST);
		if (isset($status) && isset($ids))
	 	{
			require "dbconnect.php";
			$uid=implode(",",$_POST['ids']);
			$update_sel="select id,status from register_tbl where id in ($uid)";
			$sel_query=mysql_query($update_sel) or die(mysql_error());
				while ($sel=mysql_fetch_assoc($sel_query)) 
				{
					$id=$sel['id'];	
						if ($sel['status']=='active')
			 		{
						$res=(mysql_query("update register_tbl set status = 'inactive' where id = $id"));
							header("location:admin.php?status_changed");			
					}
					elseif ($sel['status']=='inactive') 
					{
						$res=(mysql_query("update register_tbl set status = 'active' where id = $id"));
							header("location:admin.php?status_changed");
					}
				}	
		}
?>

<button><a href="add_country.php">Add Country Name</a></button>
<button><a href="add_language.php">Add Language</a></button>
<button><a href="add_skills.php">Add Skills</a></button>
<button><a href="logout.php">LOG OUT</a></button>

<form method="post">
	<table border="1" align="center">
 		<tr>
			<th>S.No</th>
			<th>Id</th>
			<th>User Name</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Date of Birth</th>
			<th>Email</th>
			<th>Contact</th>
			<th>Gender</th>
			<th>Country</th>
			<th>Language</th>
			<th>STATUS</th>
			<th></th>		
			<!-- <th colspan="2">ACTION</th>		 -->
 		</tr>
 			<?php 
 				require("dbconnect.php");
 				$query="select * from register_tbl";
 				$res=mysql_query($query) or die(mysql_error());
 				$count=mysql_num_rows($res);
 				$i=1;
 				if ($count>0) 
 				{
 					while ($row=mysql_fetch_assoc($res)) 
 					{
 							?>
							<tr>
								
								<td><?php echo $i; $i++;  ?></td>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['uname']; ?></td>
								<td><?php echo $row['fname']; ?></td>
								<td><?php echo $row['lname']; ?></td>
								<td><?php echo $row['dob']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['contact']; ?></td>
								<td><?php echo $row['gender']; ?></td>
								<td><?php echo $row['country']; ?></td>
								<td><?php echo $row['language']; ?></td>
								<td><?php echo $row['status']; ?></td>
								<td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td>
								<!-- <td>
									<button><a href="admin_delete.php?uid=<?php // echo $row['id']; ?>">DELETE</a></button>
								</td> -->
								<!-- <td>	
									<button><a href="admin_update.php?uid=<?php // echo $row['id']; ?>">UPDATE</a></button>
								</td> -->
							</tr>
 							<?php
 					}	
 				}
 				else
 				{
 					?>
 						<tr>
 							<td colspan="10" align="center" style="color: red">RECORDS ARE NOT FOUND !!!!!!!</td>
 						</tr>
 					<?php
 				}
 			?>
 		
 	</table>
 	<br>
 		<input style="float: right; margin-right: 150px;" type="submit" value="Change Status" name="status">
</form>

<?php
}
else
{
	header("location:register.php");
}

?>