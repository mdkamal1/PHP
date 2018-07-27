<?php 
session_start();
if (isset($_SESSION['user_id'])) {
	

echo "hello ".$_SESSION['user_id'];
echo "<br>";
echo "hello ".$_SESSION['name'];
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
}
  ?>