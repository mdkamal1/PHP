<?php 
session_start();

if (isset($_SESSION['adminname'])) {

	echo $_SESSION['adminname'];
	echo "<br>";
?>

<button><a href="logout.php">LOG OUT</a></button>

<form>
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
 		<th>QUERY</th>		
 	</tr>
 			<?php 
 				require("dbconnect.php");
 				$query="select * from register_tbl";
 				$res=mysql_query($query) or die(mysql_error());
 				$count=mysql_num_rows($res);
 				$i=1;
 				if ($count>0) {
 					while ($row=mysql_fetch_assoc($res)) {
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
								<td>
									<button><a href="delete.php?uid=<?php echo $row['id'] ?>">DELETE</a></button>
								</td>
							</tr>
 							<?php
 						}	
 				}
 				else{
 					?>
 					<tr>
 					<td colspan="10" align="center" style="color: red">RECORDS ARE NOT FOUND !!!!!!!</td>
 					</tr>
 					<?php
 				}
 			?>
 		
 	</table>
</form>

<?php 
}
else{
	echo "invalid request";
}

 ?>