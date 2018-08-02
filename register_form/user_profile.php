<?php 

session_start();

if (isset($_SESSION['user_id'])) {
	echo $_SESSION['user_id'].". "."Hello ".$_SESSION['name'];
	echo "<br>";
	?>
		<p align="center"><?php echo "You can see your profile on this page"; ?></p>
	<?php
	
	include_once "user_header.php";
?>

<style>
	table tr th{
		color: red;
		font-size: 25px;
	}
	td{
		text-align: center;
	}
</style>

<form>
	<table border="1" align="center">
	 	<tr>
	 		<!-- <th>S.No</th> -->
	 		<th>Id</th>
	 		<th>User Name</th>
	 		<th>First Name</th>
	 		<th>Last Name</th>
	 		<th>Date of Birth</th>
	 		<th>Email</th>
	 		<th>Contact No</th>
	 		<th>Gender</th>
	 		<th>Country</th>
	 		<th>Language</th>		
	 		<th>Skills</th>		
	 				
	 	</tr>
 			<?php 
				require("dbconnect.php");
				$uid=$_SESSION['user_id'];
				$user_query="select * from register_tbl where id = $uid";
				$user_res=mysql_query($user_query) or die(mysql_error());

				$user_query1="select * from register_lang_tbl where id = $uid";
				$user_res1=mysql_query($user_query1) or die(mysql_error());

				$user_query2="select * from register_skill_tbl where id = $uid";
				$user_res2=mysql_query($user_query2) or die(mysql_error());
				
				$row=mysql_fetch_assoc($user_res);
				
			?>
						<tr>
							
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['uname']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['lname']; ?></td>
							<td><?php echo $row['dob']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['contact']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['country']; ?></td>
							<td><?php while ( $row1=mysql_fetch_assoc($user_res1)) 
							{  
								$lang[]=$row1['lang'];	
							}
							echo implode(",", $lang);  
							?>
							</td>
							<td><?php while ( $row2=mysql_fetch_assoc($user_res2)) 
							{  
								$skill[]=$row2['skills'];	
							}
							echo implode(",", $skill);  
							?></td>					
						</tr>
		
 	</table>
</form>

<?php 
}
else
header("location:register.php");
?>
