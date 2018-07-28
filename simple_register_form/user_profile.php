<?php 

session_start();

if (isset($_SESSION['user_id'])) {


echo "hello ".$_SESSION['name']."00".$_SESSION['user_id'];

include_once "user_header.php";


 ?>
<style>
	table tr th{
		color: red;
		font-size: 25px;
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
 		<th>Contact</th>
 		<th>Gender</th>
 		<th>Country</th>
 		<th>Language</th>		
 				
 	</tr>
 			<?php 
 				require("dbconnect.php");
 				$uid=$_SESSION['user_id'];
 				$user_query="select * from register_tbl where id = $uid";
 				$user_res=mysql_query($user_query) or die(mysql_error());
 				
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
								<td><?php echo $row['language']; ?></td>
								
							</tr>
 		
 	</table>
</form>

<?php 
}else
header("location:register.php");
 ?>
